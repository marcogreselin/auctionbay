<?php

require_once('../includes/navigation.php');
require_once('../includes/validation_functions.php');
require_once('../includes/queries.php');
require_once('../includes/mailmanager.php');


/*  Processes the content of the first form, not needed outside of
address.php*/
function process_first_form() {
  global $errors;

  $required_fields = array("firstname", "lastname", "email", "password",
                            "passwordagain");
  validate_presences($required_fields);

  //  Limits provided should correspond to the limits set in the sql database
  $fields_with_max_lengths = array("firstname" => 20, "lastname" => 20,
                                  "email" => 50, "password" => 20);

  validate_max_lengths($fields_with_max_lengths);

  // Check that password == passwordagain
  matches($_POST['password'], $_POST['passwordagain']);

  // check that email has not already been used
  validate_email($_POST['email']);

  // check that role was checked and value is acceptable
  validate_role($_POST['role-check']);

  if(empty($errors)) {
  // Success outcome:
  // Store values entered and wait for user to submit current form

  //  This uses the current session, session should be
  //  destroyed once the registration process ends :NT
    $_SESSION['firstname']  = $_POST['firstname'];
    $_SESSION["lastname"]   = $_POST['lastname'];
    $_SESSION["email"]      = $_POST['email'];
    $_SESSION["password"]   = $_POST['password'];
    $_SESSION["role"]       = $_POST['role-check'];
    $_SESSION['user_details'] = 1; //confirm successful outcome in session


  } else {
  // Failure outcome: one or more elements in $errors

  //  Either display messages from $erros here in address.php or
  //  signup.php

  //Unit-testing only, should be removed and placed into unit tests
    if(!isset($_POST['test'])) {
    //Store what is needed in the session
      $_SESSION['firstname']  = $_POST['firstname'];
      $_SESSION["lastname"]   = $_POST['lastname'];
      $_SESSION["email"]      = $_POST['email'];
      $_SESSION['errors'] = $errors;
      redirect_to("signup.php");
    }

  //Unit-testing only:
    if(isset($_POST['test'])){
      echo "Errors from process_first_form():";
      echo "<pre>";
      echo print_r($errors);
      echo "</pre>";
    }
  }
}

/*  Processes the content of the second form, not needed outside of address.php*/
function process_second_form() {
  global $errors;

  //merge address fields
  $_POST['address'] = $_POST['addresslineone'] . " " . $_POST['addresslinetwo'];

  //validate presences
  $required_fields = array("address",
  "city",
  //"county",
  "postcode",
  "country",
  "phonenumber");
  validate_presences($required_fields);

  //validate max lengths
  $fields_with_max_lengths = array("address" => 30,
  "postcode" => 10,
  "city" => 20);

  //validate phone field
  //trim all whitespaces:
  $_POST['phonenumber'] = preg_replace('/\s+/', "", $_POST['phonenumber']);
  validate_phone("phonenumber");

  if(empty($errors)) {
    //  Success outcome:
    //  Store values in SESSION and proceed to registration.php
    //  on second thought: this better be a fresh post request to a pure php
    //  processing document, so that a user cannot otherwise navigate to the
    //  document with a get request TODO
    $_SESSION['address']      = $_POST['address'];
    $_SESSION['city']         = $_POST['city'];

    $_SESSION['postcode']     = $_POST['postcode'];
    $_SESSION['country']      = $_POST['country'];
    $_SESSION['phonenumber']  = $_POST['phonenumber'];
    $_SESSION['address_details'] = 1; //confirm successful outcome in session

    if(isset($_POST['test'])) {
      echo "SESSION:";
      echo "<pre>";
      echo print_r($_SESSION);
      echo "</pre>";
    }
  } else {


    //Failure outcome
    //Unit-testing only:
    if(isset($_POST['test'])){
      echo "Errors from process_second_form()";
      echo "<pre>";
      echo print_r($errors);
      echo "</pre>";
    }
    else {
      //redirect_to("signup.php");
    }
  }
}

/* Performs the necessary queries against the database in order to create a new
* user and link the new userId to a new row in the "address" table.*/
function create_new_user() {
  global $connection;

  if(!query_insert_user()) {
    return 0;
  } elseif (!query_insert_address()) {
    return 0;
  } else {
    return 1;
  }
}

/*Processes the content of the login form.*/
function process_login_form() {
  global $errors;

  $required_fields = array("email", "password");
  validate_presences($required_fields);

  $fields_with_max_lengths = array("email" => 50, "password" => 20);
  validate_max_lengths($fields_with_max_lengths);

  if(empty($errors)){
    $_POST['login_details'] = 1;
  } else {
    $_POST['login_details'] = 0;
  }
}

/*Confronts input parameters with records, returns 1 if a match is found, 0
* otherwise*/
function attempt_login($email, $password) {
  //select user row from database
  //if row is not empty then compare the hashed passwords
  //return the admin object or false
  $user = query_select_user_by_email($email);

  if($user && (password_verify($password, $user['password']))) {
    //user found in database, and password matches

    //retrieve user address details:
    $address = query_select_address($user['userId']);
    $user = $user + $address;

    return $user;
  } else {
    //email does not match any user (boolean short-circuit),
    //or if it does the passwords does not match
    return 0;
  }
}

/*Returns either the search input token trimmed and encoded or an empty string
in case the input token was blank or absent TODO should be parametrized*/
function process_search_form() {
  $value = "";

  if(isset($_GET['token']) &&
  validate_presences_general(array(0 => "token"), $_GET)){ //if input is not blank/absent
    //if(isset($_GET["token"]))
    $value = rawurlencode(trim($_GET["token"])); // escape characters
  }
  return $value; //returns either 0 or the encoded input token
}

/*Performs the relevant query against the database to get the current auction
* price, returns the price of the auction when the auction is a legitimate row
* of the auction table in the database, its behaviour is otherwise undefined */
function get_price($auctionId, $auctionStartingPrice) {
  $result = query_select_winning_bid($auctionId);

  if(!$result['user_id'])
    return $auctionStartingPrice;//an integer
  else
    return $result['value']; //an integer
}
/* old version: function get_price($auction) {
  $result = query_select_winning_bid($auction['auctionId']);
  if(!$result)
    return $auction['startingPrice'];//an integer
  else
    return $result; //an integer
}*/

/*Performs a query to get both the price and the buyer's id from the database,
* given an auctionId and a startingPrice, returns an associative array containing
* "value" (price) and "user_id" (buyer's id). If the auction has no bids, then
* returns the starting price as "value", and -1 as "user_id"*/
function get_price_with_buyer_id($auctionId, $auctionStartingPrice) {
  $result = query_select_winning_bid($auctionId);

  if(!$result['user_id'])
    return array("value"=>$auctionStartingPrice, "user_id"=>-1 );
  else
    return $result;
}

/*Filters the parameter set of auctions by the price, rating and category id
* parameters, returns a subset of this set*/
function process_filter_form($auction_set, $price_min, $price_max, $rating,
                              $category_id) {

  foreach($auction_set as $auctionKey => $auctionElement) {
      if(($auctionElement['currentPrice'] < $price_min) ||
      ($auctionElement['currentPrice'] > $price_max))
        unset($auction_set[$auctionKey]);

      if($auctionElement['stars'] < $rating)
        unset($auction_set[$auctionKey]);

      if($category_id && ($auctionElement['category_id'] != $category_id))
        unset($auction_set[$auctionKey]);
  }

    return empty($auction_set) ? null : $auction_set;
}

/*Returns a set of <strike>expired</strike> auctions that the user identified in
* the session created, with their final price as 'winning_price', and winner as
* 'winner_id'. Returns 0 if the user has no <strike>expired</strike> auctions*/
function retrieve_seller_auctions() {

  $auction_set = query_select_seller_auctions($_SESSION['userId']);
  for($i=0; $i<sizeof($auction_set); $i++) {
    //append the result of get_price($auctionId, $auctionStartingPrice) to
    //each auction associative array
    $winning_bid = get_price_with_buyer_id($auction_set[$i]['auctionId'],
                      $auction_set[$i]['startingPrice']);

    $auction_set[$i]['winning_price'] = $winning_bid['value'];
    $auction_set[$i]['winner_id']     = $winning_bid['user_id'];
  }

  return $auction_set;
}

/*Filters out from the parameter auction set the auctions that have no bids
* over the reserve price. Returns 0 (an empty array) in case all auctions
* in the parameter set were filtered out */
function filter_auctions_without_bids($auction_set) {
  $result = array();

  for($i=0; $i<sizeof($auction_set); $i++) {

    if($auction_set[$i]['winner_id'] > 0)
      array_push($result, $auction_set[$i]);

  }

  return $result;
}

/*Filters out from the parameter auction set the live auctions (the auctions
* that are NOT past their expiration date). Returns an array of auctions or 0
* (an empty array)*/
function filter_non_expired_auctions($auction_set) {
  $result = array();

  for($i=0; $i<sizeof($auction_set); $i++) {

    // echo time() - strtotime($auction_set[$i]['expirationDate']);
    // echo "<br/>";
    //time() - strtotime($auction_set[$i]['expirationDate'])
    //returns a negative number if expirationDate is in the future

    if((time() - strtotime($auction_set[$i]['expirationDate'])) > 0) {
      array_push($result, $auction_set[$i]);
    }
  }

  return $result;
}

/*Filters out from the parameter auction set the expired auctions (the auctions
* that are past their expiration date). Returns an array of auctions or 0
* (an empty array)*/
function filter_expired_auctions($auction_set) {
  $result = array();

  for($i=0; $i<sizeof($auction_set); $i++) {

    // echo time() - strtotime($auction_set[$i]['expirationDate']);
    // echo "<br/>";
    //time() - strtotime($auction_set[$i]['expirationDate'])
    //returns a negative number if expirationDate is in the future

    if((time() - strtotime($auction_set[$i]['expirationDate'])) < 0) {
      array_push($result, $auction_set[$i]);
    }
  }

  return $result;
}

/*Returns a set of auctions that the user identified in the session bid on at
* some point. Returns 0 if the user has not bid on any auctions*/
function retrieve_buyer_auctions() {

  $auction_set = query_select_buyer_auctions($_SESSION['userId']);
  for($i=0; $i<sizeof($auction_set); $i++) {
    //append the result of get_price($auctionId, $auctionStartingPrice) to
    //each auction associative array
    $winning_bid = get_price_with_buyer_id($auction_set[$i]['auctionId'],
                      $auction_set[$i]['startingPrice']);

    $auction_set[$i]['winning_price'] = $winning_bid['value'];
    $auction_set[$i]['winner_id']     = $winning_bid['user_id'];
    // $temp = queryAuctionData($auction_set[$i]['auctionId']);
    // $auction_set[$i]['winner_id']     = $temp['currentWinner'];//$winning_bid['user_id'];

  }

  return $auction_set;
}

/*Reduces the auction set parameter excluding auctions based on whether the
* user won the auction*/
function filter_auctions_not_won($auction_set, $userId) {

  $filtered_auction_set = array();

  for($i=0; $i<sizeof($auction_set); $i++) {
    if($userId == $auction_set[$i]['winner_id'])
      array_push($filtered_auction_set, $auction_set[$i]);
  }

  return $filtered_auction_set;
}

/*Returns a set of auctions corresponding to the auctions the user identified in
* the session is following.*/
function retrieve_followed_by_user() {

  $auction_set = query_select_followed_by_user($_SESSION['userId']);
  for($i=0; $i<sizeof($auction_set); $i++) {
    //append the result of get_price($auctionId, $auctionStartingPrice) to
    //each auction associative array
    $winning_bid = get_price_with_buyer_id($auction_set[$i]['auctionId'],
                      $auction_set[$i]['startingPrice']);

    $auction_set[$i]['winning_price'] = $winning_bid['value'];
    $auction_set[$i]['winner_id']     = $winning_bid['user_id'];
  }

  return $auction_set;
}

/*Filters the parameter set by whether the user indicated by the role parameter
* (for each auction in the set) has left feedback on the auction. If role
* parameter is invalid, the auction set is returned unmodified*/
function filter_auctions_already_rated($auction_set, $role) {
  $result = array();

  if($role == ROLE_SELLER) {
    foreach ($auction_set as $auction) {
      if(!query_feedback_left($auction['winner_id'], $auction['auctionId']))
        array_push($result, $auction);
    }
  } elseif($role == ROLE_BUYER) {
    //$auction_set must already be only the ones the buyer won
    foreach ($auction_set as $auction) {
      if(!query_feedback_left($auction['seller'], $auction['auctionId'])) {

          array_push($result, $auction);
          // echo "<br/>Session id: ".$_SESSION['userId']."<br/> Seller id: ".$auction['seller'];
      }
    }
  } else {
    $result = $auction_set;
  }

  return $result;
}

function addAuction() {
  global $connection;

  $errors = array();

  if($_POST["title"] != null)
    $title = $_POST["title"];
  else
    $errors[] = 'Enter a valid title.';

  if($_POST["body"] != null)
    $body = $_POST["body"];
  else
    $errors[] = 'Enter a body.';
  if($_POST["endDate"] != null && strtotime($_POST["endDate"]) > time())
    $endDate = $_POST["endDate"];
  else
    $errors[] = 'Enter a valid end date.';
  if(ctype_digit($_POST["reservePrice"]) && $_POST["reservePrice"] > $_POST["startingPrice"])
    $reservePrice = $_POST["reservePrice"];
  else
    $errors[] = 'Enter a valid reserve price.';
  if(ctype_digit($_POST["startingPrice"]))
    $startingPrice = $_POST["startingPrice"];
  else
    $errors[] = 'Enter a valid starting price.';
  $category_Id =$_POST["category"];
  $seller=$_SESSION['userId'];
  if($_FILES['image']['name'] != null && in_array(strtolower(end(explode('.',$_FILES['image']['name']))),array("jpg", "jpeg", "gif", "png", "bmp")))
    $imageName = $_FILES['image']['name'];
  else
    $errors[] = 'Enter a valid image.';

  if(empty($errors)){

    $query = "INSERT INTO auction (title, description, seller, startingPrice, reservePrice,
            expirationDate, category_Id, views, imageName)
            VALUES ('{$title}', '{$body}','{$seller}','{$startingPrice}','{$reservePrice}',
            '{$endDate}','{$category_Id}',0,'{$imageName}');";

    $result = mysqli_query($connection,$query);
    if($result){
      return true;
    } else {
      return false;
    }

  } else {
    return $errors;
  }

}

function queryCatArray(){
  global $connection;

  $query = "SELECT * FROM category ORDER BY categoryId ASC;";

  return  mysqli_query($connection,$query);

}

function queryAuctionData($auctionId){
  global $connection;

  $query = "SELECT auction.title, seller, description, views, imageName, firstName, lastName, date(expirationDate) as expirationDate,";
  $query .= "IF(j.Amount IS NULL, startingPrice, j.Amount) AS price, ";
  $query .= "IF(FLOOR(AVG(stars)) IS NULL, 0, FLOOR(AVG(stars))) as stars , j.user_Id AS currentWinner, j.email AS currentWinnerEmail ";
  $query .= "FROM auction ";
  $query .= "JOIN user ON auction.seller = user.userid ";
  $query .= "LEFT JOIN feedback ON feedback.user_Id = user.userId ";
  $query .= "LEFT JOIN ( ";
    $query .= "SELECT bidamount AS amount, user_id , auction_id, email ";
    $query .= "FROM bid JOIN user ON user.userId = bid.user_id ";
    $query .= "WHERE auction_Id=".$auctionId." ";
    $query .= "ORDER BY amount DESC ";
    $query .= "LIMIT 1 ";
  $query .= ") AS j ON j.auction_id = auction.auctionId ";
  $query .= "WHERE auctionId=".$auctionId." ";
  $query .= "GROUP BY auction.title, seller, description, views, imageName, firstName, lastName, expirationDate, price, currentWinner, currentWinnerEmail";

  $results = mysqli_query($connection, $query);
  if (!$results) {
    die("Database query failed. " . mysqli_error($connection));
  } else {
    return  mysqli_fetch_assoc(mysqli_query($connection,$query));
  }
}

function addVisit($auctionId){
  global $connection;

  $query = "UPDATE auction SET views = views + 1 WHERE auctionId = " . $auctionId;


  return  mysqli_query($connection,$query);

}
function favoriteAuction(){
  global $connection;
  $userId = $_SESSION["userId"];
  $auctionId = $_GET["auctionId"];

  $query = "INSERT INTO follower (`auction_id`, `user_id`) VALUES ('".$auctionId."','".$userId."')";


  return  mysqli_query($connection,$query);
}

function timeRemaining($expiryTime){
  $today = new DateTime();
  $interval = date_diff($today,new DateTime($expiryTime));
  if($today<new DateTime($expiryTime)){
    return $interval;
  } else {
    return null;
  }
}

function isFavorite(){
  global $connection;
  $userId = $_SESSION["userId"];
  $auctionId = $_GET["auctionId"];
  $query = "SELECT * FROM follower WHERE auction_id =".$auctionId." AND user_id = ".$userId;
  $result =  mysqli_num_rows(mysqli_query($connection,$query));
  if( $result==0){
    return false;
  } else {
    return true;
  }
}

function unfavoriteAuction(){
  global $connection;
  $userId = $_SESSION["userId"];
  $auctionId = $_GET["auctionId"];

  $query  = "DELETE FROM follower WHERE `user_id`='".$userId."' AND ";
  $query .= "auction_id='{$auctionId}';";


  mysqli_query($connection,$query);
}


function bid($auctionData){
  global $connection;
  $userId = $_SESSION["userId"];
  $auctionId = $_GET["auctionId"];
  $query="INSERT INTO `auction_site`.`bid` (`auction_id`, `user_id`, `bidAmount`) VALUES ('".$auctionId."', '".$userId."', '".$_POST["newBidAmount"]."');";
  if($_POST["newBidAmount"]>$auctionData["price"] && $auctionData['currentWinner']!=$userId){

      mysqli_query($connection,$query);
      $to      = $auctionData['currentWinnerEmail'];
      $subject = 'Your bid for '.$auctionData['title'];

      $message = "Hello there, \n We are writing you to inform you that your bid has been outbid by another user. The new price is set to GBP".$_POST["newBidAmount"].".\n Please visit AuctionBay and keep bidding!\n \n Your AuctionBay Team";
      sendMail($to, $subject, $message);

    return true;
  } else {
    return false;
  }
}
// function bid($auctionData){
//   global $connection;
//   $userId = $_SESSION["userId"];
//   $auctionId = $_GET["auctionId"];
//   $query="INSERT INTO `auction_site`.`bid` (`auction_id`, `user_id`, `bidAmount`) VALUES ('".$auctionId."', '".$userId."', '".$_POST["newBidAmount"]."');";
//   if($_POST["newBidAmount"]>$auctionData["price"]){
//     mysqli_query($connection,$query);
//     if($auctionData['currentWinner']!=$userId){
//       $to      = $auctionData['currentWinnerEmail'];
//       $subject = 'Your bid for '.$auctionData['title'];
//       $message = "Hello there, \n We are writing you to inform you that your bid has been outbid by another user. The new price is set to £".$_POST["newBidAmount"].".\n Please visit AuctionBay and keep bidding!\n \n Your AuctionBay Team";
//       $headers = 'From: auctiobay.ucl@gmail.com' . "\r\n" .
//         'X-Mailer: PHP/' . phpversion();
//       echo mail($to, $subject, $message, $headers);
//     }
//     return true;
//   } else {
//     return false;
//       }
// }

/** Leave feedback after clicking the leave feedback pictures in the buyer_account or seller_account*/
function leaveFeedback() {
  global $connection;



  $stars = (int)$_POST['stars'];
  $comment = $_POST['comment'];
  $title = $_POST['title'];
  $auction_id = isset($_GET['auction_id']) ? $_GET['auction_id'] : $_SESSION['auction_id'];
  $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['user_id'];
  $date = new DateTime('now');

  // construct query
  $query = "INSERT INTO feedback (auction_id, user_id, stars, comment, title) VALUES ({$auction_id}, {$user_id}, {$stars}, '{$comment}', '{$title}')";

  $feedbackResult = mysqli_query($connection, $query);


  // Test if there was a query error, if no error, redirect to the index.php page
  if (!$feedbackResult) {
    die("Database query failed. " . mysqli_error($connection));
  } else {
    redirect_to('index.php');
  }
}

/** Search from the database the user's firstname to be displayed on the screen for leave_feedback.php*/
function searchFeedbackUser($userId) {
  global $connection;

  $query = "SELECT * FROM user WHERE userId = $userId";

  $userFeedbackQueryResult = mysqli_query($connection, $query);

  if (!$userFeedbackQueryResult) {
    die("Database query failed. " . mysqli_error($connection));
  } else {
    $userFeedback = mysqli_fetch_assoc($userFeedbackQueryResult);
  }
  return $userFeedback['firstName'];
}

/** Query the information from a combination of different tables */
function getFeedbackInformation($userId) {
  global $connection;

 // query to retrieve the current all the relevant feedback information
  $query = "SELECT firstName, lastName, imageName, auction.title as auctionTitle, stars, comment, role,  date(date), auctionId, feedback.title as feedbackTitle
  FROM user
  LEFT JOIN feedback ON user.userid = feedback.user_id
  LEFT JOIN auction ON auction.auctionId = feedback.auction_id
  WHERE user.userId = $userId";


  $feedbackMainResult = mysqli_query($connection, $query);

  // Test if there was a query error
  if (!$feedbackMainResult) {
    die("Database query failed");
  }
  return $feedbackMainResult;
}

/** Returns the number of stars in the feedback.php depending on the number of stars queried from the database */
function returnStarRating($starNumber) {
  $finalOutput = null;
  for ($x = 1; $x <= $starNumber; $x++) {
    $output = '<fieldset class="rating rating-feedback-result"><input type="text" id="star1" name="rating" value="1"/><label for="star1"
                                                                                       title="">
                            star</label></fieldset>';
    $finalOutput .= $output;
  }
  return $finalOutput;
}

function bidderList(){
  global $connection;
  $query = 'SELECT CONCAT(firstName, " ", lastName) AS bidder, bidAmount, date(bid.createdDate) as date ';
  $query .= 'FROM user JOIN bid ON bid.user_id = user.userid WHERE auction_id = '.$_GET["auctionId"] . ' ORDER BY date DESC';
  return mysqli_query($connection, $query);
}

/** Form processing for the feedback form */
function process_feedback_form() {
  global $errors;

  $required_fields = array("stars", "comment", "title");
  validate_presences($required_fields);

  $fields_with_max_lengths = array("title" => 20);
  validate_max_lengths($fields_with_max_lengths);

  if (empty($errors)) {
    leaveFeedback();
  }
}

/** Get details for the leave_feedback.php */
function getAuctionForFeedback($auction_id) {
  global $connection;

  // query to retrieve the current all the relevant feedback information
  $query = "SELECT imageName, title
  FROM auction
  WHERE auctionId = $auction_id";


  $auctionFeedbackQueryResult = mysqli_query($connection, $query);

  if (!$auctionFeedbackQueryResult) {
    die("Database query failed. " . mysqli_error($connection));
  } else {
    return mysqli_fetch_assoc($auctionFeedbackQueryResult);
  }
}


/** Get details for awarded auctions for buyer*/

function getCompletedAuctionDetailsForBuyer($userId)
{
  global $connection;

  $query = "SELECT a.auction_id, title, imageName, a.bidamount finalAmount, buyerEmail, buyerAddress, buyerName,
a.userid winner, expirationDate, sellerEmail, sellerName, sellerAddress, seller
FROM (
    SELECT bidamount AS bidamount, user.userid userId, auction_id, email buyeremail, CONCAT(firstName, ' ', lastName) buyerName,
    CONCAT(number,', ', street, ' - ', city) buyerAddress
	FROM bid
	JOIN user ON user.userId = bid.user_id
    JOIN address ON address.user_id = user.userId
	ORDER BY bidamount DESC
) as a
INNER JOIN (
      SELECT auction_ID, MAX(bidAmount) bidAmount
    FROM (
        SELECT bidamount AS bidAmount, user_id , auction_id, email
		FROM bid
		JOIN user ON user.userId = bid.user_id
		ORDER BY bidamount DESC
  ) as c
    GROUP BY auction_ID
) AS b ON a.auction_id = b.auction_id AND a.bidAmount = b.bidAmount
JOIN (
    SELECT auctionId, imageName, expirationDate, title, email sellerEmail, CONCAT(firstName, ' ', lastName) sellerName,
    CONCAT(number,', ', street, ' - ', city) sellerAddress, seller
    FROM auction
    JOIN user ON auction.seller=user.userId
    JOIN address ON address.user_id = user.userId
) auction ON auction.auctionId = a.auction_id
WHERE expirationDate<NOW() AND a.userid = $userId";

  $completedAuctionResult = mysqli_query($connection, $query);

  if (!$completedAuctionResult) {
    die("Database query failed. " . mysqli_error($connection));
  } else {
    return $completedAuctionResult;
  }
}



/** Get details for items sold for seller*/

function getCompletedAuctionDetailsForSeller($userId)
{
  global $connection;

  $query = "SELECT a.auction_id, title, imageName, a.bidamount finalAmount, buyerEmail, buyerAddress, buyerName,
a.userid winner, expirationDate, sellerEmail, sellerName, sellerAddress, seller
FROM (
    SELECT bidamount AS bidamount, user.userid userId, auction_id, email buyeremail, CONCAT(firstName, ' ', lastName) buyerName,
    CONCAT(number,', ', street, ' - ', city) buyerAddress
	FROM bid
	JOIN user ON user.userId = bid.user_id
    JOIN address ON address.user_id = user.userId
	ORDER BY bidamount DESC
  ) as a
  INNER JOIN (
      SELECT auction_ID, MAX(bidAmount) bidAmount
    FROM (
        SELECT bidamount AS bidAmount, user_id , auction_id, email
		FROM bid
		JOIN user ON user.userId = bid.user_id
		ORDER BY bidamount DESC
  ) as c
    GROUP BY auction_ID
  ) AS b ON a.auction_id = b.auction_id AND a.bidAmount = b.bidAmount
  JOIN (
    SELECT auctionId, imageName, expirationDate, title, email sellerEmail, CONCAT(firstName, ' ', lastName) sellerName,
    CONCAT(number,', ', street, ' - ', city) sellerAddress, seller
    FROM auction
    JOIN user ON auction.seller=user.userId
    JOIN address ON address.user_id = user.userId
  ) auction ON auction.auctionId = a.auction_id
  WHERE expirationDate<NOW() AND seller = $userId";

  $completedAuctionResult = mysqli_query($connection, $query);

  if (!$completedAuctionResult) {
    die("Database query failed. " . mysqli_error($connection));
  } else {
    return $completedAuctionResult;
  }
}

/** Get the average stars for a particular user */
function getAverageStarsForUser($userId) {
  global $connection;

  //query to get the average stars for a user
  $query = "SELECT IF(FLOOR(AVG(stars)) IS NULL, 0, FLOOR(AVG(stars))) as stars from feedback where user_id = $userId";

  $averageStarForUser = mysqli_query($connection, $query);

  if (!$averageStarForUser) {
    die("Database query failed");
  }
  return mysqli_fetch_assoc($averageStarForUser);
}
?>
