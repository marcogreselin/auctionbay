<?php
/*Constructs a query and sends it to the database connection specified by the
* $connection global variable. Fetches the data to input in the query from the
* $_SESSION super global. Returns 1 if the query succeeded, 0 otherwise.*/
function query_insert_user() {
  global $connection;

  //prep values
  $firstname  = mysqli_real_escape_string($connection, $_SESSION['firstname']);
  $lastname   = mysqli_real_escape_string($connection, $_SESSION['lastname']);
  $email      = mysqli_real_escape_string($connection, $_SESSION['email']);
  $role       = mysqli_real_escape_string($connection, $_SESSION['role']);
  //$username   = "";
  //$date = date('Y-m-d');

  $password   = password_hash($_SESSION['password'], PASSWORD_BCRYPT);

  //construct query
  $query  = "INSERT INTO user ";
  $query .= "(role, email, password, firstName, lastName) ";
  $query .= "VALUES ";
  $query .= "({$role}, '{$email}', '{$password}', ";
  $query .= "'{$firstname}', '{$lastname}');";

  //execute query
  $result = mysqli_query($connection, $query);

  //check result
  if($result) {
    //Success
    return 1;
  } else {
    //Failure
    return 0;
  }
}

/*Constructs a query and sends it to the database connection specified by the
* $connection global variable. Fetches the data to input in the query from the
* $_POST super global. Uses an inefficient futher query to the database in order
* to determine the latest user inserted. This may also cause issues where
* multiple user insertion queries are performed close to each other and their
* complementary address insertion queries are performed asynchronously. Would be
* best to lock the user table until the present procedure returns, so that no
* user can be added to the database while another user's data is being inserted
* into the "user" and "address" tables.
* Returns 1 if the query succeeded, 0 otherwise.*/
function query_insert_address() {
  global $connection;

  //prep values
  $address      = mysqli_real_escape_string($connection, $_POST['address']);
  $city         = mysqli_real_escape_string($connection, $_POST['city']);
  $county       = mysqli_real_escape_string($connection, $_POST['county']);
  $postcode     = mysqli_real_escape_string($connection, $_POST['postcode']);
  $country      = mysqli_real_escape_string($connection, $_POST['country']);
  $phonenumber  = mysqli_real_escape_string($connection, $_POST['phonenumber']);

  $street       = $address . ", " . $county;
  /*Unfortunately, userId must be fetched through a query to the database.
  * Different methods would involve generating a unique id per user through the
  * php logic, but this would probably produce a hexidecimal string, which would
  * need to be stored as a VARCHAR at the database level. Performance is not
  * critical for this project, so the worst performing solution is opted for.*/
  $userId       = query_select_last_user()['userId'];

  //construct query
  $query  = "INSERT INTO address ";
  $query .= "(user_id, street, zip, city, country, phone) ";
  $query .= "VALUES ";
  $query .= "($userId, '{$street}', '{$postcode}', '{$city}', '{$country}', ";
  $query .= "{$phonenumber});";

  //execute query
  $result = mysqli_query($connection, $query);

  //check result
  if($result) {
    //Success
    return 1;
  } else {
    //Failure
    return 0;
  }
}

/*Constructs a query and sends it to the database connection specified by the
* $connection global variable. Fetches user address details from userId. Returns
* an associative array containing the result of the query*/
function query_select_address($userId) {
  global $connection;

 //construct query:
 $query  = "SELECT street, number, zip, city, country FROM address ";
 $query .= "WHERE user_id={$userId}; ";

 $result = mysqli_query($connection, $query);

 if($result) {
   return mysqli_fetch_assoc($result);
 } else {
   return 0;
 }
}

/*Fetches the user with the largest userId (the last inserted user).*/
function query_select_last_user() {
  global $connection;

  $query = "SELECT * FROM user ORDER BY userId DESC LIMIT 1;";
  //execute query
  $result_set = mysqli_query($connection, $query);

  return mysqli_fetch_assoc($result_set);
}

/*<strike>@NEEDS: to also check the type of account</strike>
* Should be used to verify that the user registering has not previously
* registered*/
function query_email_exists(/*$account_type*/) {
  //SELECT count(1) FROM user WHERE email='{$email}';
  global $connection;

  //prep value
  $email = mysqli_real_escape_string($connection, $_SESSION['email']);

  //construct query
  $query = "SELECT count(1) FROM user WHERE email='{$email}'";

  //execute query
  $result = mysqli_query($connection, $query);

  return $result;
}

/*Generic method to return the number of occurrences of $value parameter inside
* the $column of the table specified by $table.*/
function query_count_occurrences($value, $column, $table) {
  global $connection;

  //prep value
  $value = mysqli_real_escape_string($connection, $value);

  //construct query
  $query = "SELECT * FROM {$table} WHERE {$column}='{$value}'";

  //execute query
  $result = mysqli_query($connection, $query);
  $result = mysqli_num_rows($result);

  return $result;
}

/*Returns the row from the user table corresponding to the email parameter
* or 0/false if no match can be found*/
function query_select_user_by_email($email) {
  global $connection;

  //prep values
  $email  = mysqli_real_escape_string($connection, $email);
  //$role   = mysqli_real_escape_string($connection, $role);

  //construct query
  $query = "SELECT * FROM user WHERE email='{$email}' LIMIT 1";

  //execute query
  $result = mysqli_query($connection, $query);

  if($result) {
    return mysqli_fetch_assoc($result);
  } else {
    return 0;
  }
}

/*Returns an associative array containing auction matching search token*/
function query_select_auction_search($token) {
  global $connection;

  //prep input
  $token = mysqli_real_escape_string($connection, $token);

  //prep query
  $query  = "SELECT auctionId, title, description, startingPrice, category_id, ";
  $query .= "imageName, seller ";
  $query .= "FROM auction ";
  $query .= "WHERE NOW()<expirationDate AND ";
  $query .= "(title LIKE '%{$token}%' OR description LIKE '%{$token}%')";
 //  $query .= "LIMIT 50;"; //limit?

  $result_set = mysqli_query($connection, $query);

  if($result_set)
    $result_set = mysqli_fetch_all($result_set, MYSQLI_ASSOC);

  return $result_set;
}

/*Returns the current price (the value of the highest bid<strike>, i.e. the
* second highest bid + 1</strike>), also returns the bid_id of the winning bid
* from the bid table. Returns 0 if no bids have been made on the auction*/
function query_select_winning_bid($auctionId) {
  global $connection;

  //no need to prep input as input comes from another query
  $auctionId = mysqli_real_escape_string($connection, $auctionId);

  //prep query:
  $query  = "SELECT user_id, MAX(bidAmount) AS value ";
  $query .= "FROM bid WHERE auction_id={$auctionId}";
  /*//old logic, queried a "current_price" table for the data
  $subquery_select_max_bid_for_auction  = "SELECT MAX(bidAmount) ";
  $subquery_select_max_bid_for_auction .= "FROM bid WHERE auction_id={$auctionId}";

  $subquery_select_from_bids  = "SELECT bidId FROM bid WHERE ";
  $subquery_select_from_bids .= "bidAmount=({$subquery_select_max_bid_for_auction})";

  $query  = "SELECT current_price.value, bid.user_id FROM current_price ";
  $query .= "INNER JOIN bid ON current_price.bid_id=bid.bidId ";
  $query .= "WHERE bid_id=({$subquery_select_from_bids})";*/

  //do query:
  $result = mysqli_query($connection, $query);

  if($result)
    $result = mysqli_fetch_assoc($result);

  return $result;
}

/*Returns the set of <strike><strong>not-expired</strong></strike> auctions
* created by the seller specified in the parameter*/
function query_select_seller_auctions($sellerUserId) {
  global $connection;

  //escape input
  $sellerUserId = mysqli_real_escape_string($connection, $sellerUserId);

  //prepare query
  $query  = "SELECT auctionId, title, imageName, description, startingPrice, ";
  $query .= "expirationDate ";
  $query .= "FROM auction ";
  $query .= "WHERE seller={$sellerUserId} ";
  // $query .= "AND NOW()>expirationDate";

  //forward query to database
  $result = mysqli_query($connection, $query);

  //If set is not empty, return a number-indexed array, return 0 otherwise
  if($result)
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

  return $result;
}

/*Returns the set of auctions that the buyer specified in the parameter bid on
* at some point*/
function query_select_buyer_auctions($buyerUserId) {
  global $connection;

  //escape input
  $buyerUserId = mysqli_real_escape_string($connection, $buyerUserId);

  //prepare queries
  $subquery_select_from_bids  = "SELECT auction_id FROM bid ";
  $subquery_select_from_bids .= "WHERE user_id='{$buyerUserId}'";

  $query  = "SELECT auctionId, title, imageName, description, startingPrice, ";
  $query .= "expirationDate ";
  $query .= "FROM auction ";
  $query .= "WHERE auctionId IN ($subquery_select_from_bids)";

  //forward query to database
  $result = mysqli_query($connection, $query);

  //If set is not empty, return a number-indexed array, return 0 otherwise
  if($result)
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

  return $result;
}

/*Returns the average rating for the user and the number of times the user has
* been left feedback (the number of occurrences of the user's id) */
function query_select_user_rating($user_id) {
  global $connection;

  //should be safe but escape:
  $user_id = mysqli_real_escape_string($connection, $user_id);

  //construct query
  $query  = "SELECT IF(FLOOR(AVG(stars)) IS NULL, 0, FLOOR(AVG(stars))) AS stars, ";
  $query .= "COUNT(user_id) AS occurrences ";
  $query .= "FROM feedback WHERE user_id='{$user_id}'";

  $result = mysqli_query($connection, $query);

  if($result)
    $result = mysqli_fetch_assoc($result);

  return $result;
}
?>
