<?php
//Override assert config
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_BAIL, 0);

//Dependencies
require("../includes/validation_functions.php");
require("../includes/form_processing.php");
require("../includes/dbconnection.php");
require("../includes/session.php");
//require("../includes/queries.php");


function clear_POST() {
  foreach ($_POST as $key => $value) {
    unset($_POST[$key]);
  }
}

//@TEST
function first_form_test_failure() {
  //this must be added within the body of every function
  //using the $errors array from the validation_functions.php module
  global $errors;

  $_POST['test'] = "";
  $_POST['firstname'] = "";
  $_POST['lastname'] = "lastname";
  $_POST['email'] = "email";
  $_POST['password'] = "password";
  $_POST['passwordagain'] = "passwordagain";
  $_POST['role-check'] = "role-check";

  process_first_form();
  //assert(isset($_POST['test']));
  //  Assert that mock input is invalid
  assert(!empty($errors), "Expected \$errors to not be empty");
}

//@TEST
function first_form_test_success() {
  global $errors;

  $_POST['test'] = "";
  $_POST['firstname'] = "firstname";
  $_POST['lastname'] = "lastname";
  $_POST['email'] = "email";
  $_POST['password'] = "password";
  $_POST['passwordagain'] = "password";
  $_POST['role-check'] = "role-check";

  process_first_form();
  //  Assert that mock input is valid
  assert(empty($erros), "Expected \$errors to be empty");
}

//@TEST
function second_form_test_failure() {
  global $errors;

  $_POST['test'] = "";
  $_POST['addresslineone'] = "add";
  $_POST['addresslinetwo'] = "ress";
  $_POST['city'] = "city";
  $_POST['county'] = "";
  $_POST['postcode'] = ""; //!
  $_POST['country'] = ""; //!
  $_POST['phonenumber'] = "12345abcde"; //!

  process_second_form();
  //assert(isset($_POST['test']));
  //  Assert that mock input is invalid
  assert(!empty($errors), "Expected \$errors to not be empty");
}

//@TEST
function second_form_test_success() {
  global $errors;

  $_POST['test'] = "";
  $_POST['addresslineone'] = "add";
  $_POST['addresslinetwo'] = "ress";
  $_POST['city'] = "city";
  $_POST['county'] = "";
  $_POST['postcode'] = "postcode";
  $_POST['country'] = "country";
  $_POST['phonenumber'] = " 1 2   3 4  5 "; //it should trim this

  process_second_form();
  //assert(isset($_POST['test']));
  //  Assert that mock input is valid
  assert(empty($errors), "Expected \$errors to be empty");
  assert($_POST['phonenumber'] == "12345");
  //assert($_SESSION contains all the fields expected);
}

//@TEST
function create_new_user_success() {
  global $connection;

  session_unset();

  $_SESSION['firstname'] = "createnewusertest";
  $_SESSION['lastname'] = "createnewusertest";
  $_SESSION['email'] = "createnewusertestemail";
  $_SESSION['role'] = 1;
  $_SESSION['password'] = 'pw';
  $_POST['address'] = "address";
  $_POST['city'] = "city";
  $_POST['county'] = "county";
  $_POST['postcode'] = "postcode";
  $_POST['country'] = "country";
  $_POST['phonenumber'] = 1234;

  assert(create_new_user());
}

//@TEST
function create_new_user_failure() {
  global $connection;

  session_unset();

  $_SESSION['firstname'] = "createnewusertest";
  $_SESSION['lastname'] = "createnewusertest";
  $_SESSION['email'] = "createnewusertestemail";
  $_SESSION['role'] = "non-numeric-input";
  $_SESSION['password'] = 'pw';
  $_POST['address'] = "address";
  $_POST['city'] = "city";
  $_POST['county'] = "county";
  $_POST['postcode'] = "postcode";
  $_POST['county'] = "county";
  $_POST['phonenumber'] = "non-numeric-input";

  assert(!create_new_user());
}

//@TEST
function process_login_form_failure() {

  $_POST['email'] = "";
  $_POST['password'] = "thispasswordiswaytoolong";

  process_login_form();
  assert(!$_POST['login_details']);
}

//@TEST
function process_login_form_success() {

  $_POST['email'] = "email";
  $_POST['password'] = "password";

  process_login_form();
  assert($_POST['login_details']);
}

//@TEST
function attempt_login_success() {
  global $connection;

  $email = "niccolo.terreri.15@ucl.ac.uk";
  $password = "pw";

  assert(attempt_login($email, $password));
}

//@TEST
function attempt_login_failure() {
  global $connection;

  $email = "niccolo.terreri.15@ucl.ac.uk";
  $password = "wrongpassword";

  assert(!attempt_login($email, $password));
}

//@TEST
function process_search_form_failure() {
  unset($_GET['token']);

  assert(!process_search_form());

  $_GET['token'] = "";

  assert(!process_search_form());

  $_GET['token'] = "     ";

  assert(!process_search_form());
}

//@TEST
function process_search_form_success() {
  //this will generate a notice, and produce a parsing error when a string with
  //spaces is entered (e.g. "valid token"). This seems to be related to the
  //fact that GET is not supposed to be edited manually, and running this test
  //may cause google to ask you to verify you're not a robot (see http://stackoverflow.com/questions/16086589/how-to-overcome-php-notice-use-of-undefined-constant)
  $_GET['token'] = "valid";

  assert(process_search_form());
}

//@TEST
function get_price_success() {
  global $connection;

  $result_set = (query_select_auction_search("long"));

  foreach ($result_set as $auction) {
    //assert((get_price($auction) == 101));
    assert((get_price($auction['auctionId'], $auction['startingPrice']) == 101));
  }
}

//@TEST
function get_price_failure() {
  global $connection;

  $result_set = (query_select_auction_search("different"));

  foreach ($result_set as $auction) {
    //assert((get_price($auction) == 10));
    assert((get_price($auction['auctionId'], $auction['startingPrice']) == 10));
  }
}

//@TEST
function get_price_with_buyer_id_failure() {
  global $connection;

  $auctionId = 2;
  $startingPrice = 1;

  $result = get_price_with_buyer_id($auctionId, $startingPrice);
  assert($result['value'] == 1);
  assert($result['user_id'] = -1);
}

//@TEST
function get_price_with_buyer_id_success() {
  global $connection;

  $auctionId = 5;
  $startingPrice = 1;

  $result = get_price_with_buyer_id($auctionId, $startingPrice);
  assert($result['value'] == 101);
  assert($result['user_id'] = 38);
}

//@TEST
function process_filter_form_not_empty() {
  $auction_set = array();

  $short = array('auctionId' => 2, "title" => "title",
      "description" => "description", "currentPrice" => 10, "rating" => 1,
      "category_id" => 5);
  $short_spaces = array('auctionId' => 3, "title" => "title with spaces",
      "description" => "description with spaces", "currentPrice" => 10,
      "rating" => 2, "category_id" => 5);
  $different = array('auctionId' => 4, "title" => "different",
      "description" => "same description", "currentPrice" => 10, "rating" => 3,
      "category_id" => 5);
  $costly = array('auctionId' => 5, "title" => "auction with long description",
      "description" => "very long description", "currentPrice" => 100,
      "rating" => 4, "category_id" => 5);

  array_push($auction_set, $short, $short_spaces, $different, $costly);

  $result = process_filter_form($auction_set, 50, 200, -1, 5);

  assert((array_values($result) === array($costly)));

  echo "Auctions list after filtering: ";
  echo "<pre>";
  print_r($result);
  echo "</pre>";
}

//@TEST
function process_filter_form_empty() {
  $auction_set = array();

  $short = array('auctionId' => 2, "title" => "title",
      "description" => "description", "currentPrice" => 10, "rating" => 1,
      "category_id" => 5);
  $short_spaces = array('auctionId' => 3, "title" => "title with spaces",
      "description" => "description with spaces", "currentPrice" => 10,
      "rating" => 2, "category_id" => 5);
  $different = array('auctionId' => 4, "title" => "different",
      "description" => "same description", "currentPrice" => 10, "rating" => 3,
      "category_id" => 5);
  $costly = array('auctionId' => 5, "title" => "auction with long description",
      "description" => "very long description", "currentPrice" => 100,
      "rating" => 4, "category_id" => 5);
  $wrong_category = array('auctionId' => 5, "title" => "auction with long description",
      "description" => "very long description", "currentPrice" => 100,
      "rating" => 4, "category_id" => 1000);

  array_push($auction_set, $short, $short_spaces, $different, $costly);

  $result = process_filter_form($auction_set, 50, 200, 5, 5);

  assert(empty($result));

  echo "Auctions list after filtering: ";
  echo "<pre>";
  echo "Should print null just below: ";
  print_r($result);
  echo "<br/>Should print null just above: ";
  echo "</pre>";
}

//@TEST
function retrieve_seller_auctions_success() {
  $temp = null;

  if(isset($_SESSION['userId']))
    $temp = $_SESSION['userId'];

  $_SESSION['userId'] = 74;
  $result = retrieve_seller_auctions();
  // print_r($result[3]);
  assert($result[3]['auctionId'] == 5);
  assert($result[3]['winning_price'] == 101);
  assert($result[3]['winner_id'] == 38);

  if($temp)
    $_SESSION['userId'] = $temp;
}

//@TEST
function retrieve_seller_auctions_failure() {
  $temp = null;
  if(isset($_SESSION['userId']))
    $temp = $_SESSION['userId'];

  $_SESSION['userId'] = 1;
  assert(!retrieve_seller_auctions());

  if($temp)
    $_SESSION['userId'] = $temp;
}

//@TEST
function filter_auctions_without_bids_success() {
  $temp = null;

  if(isset($_SESSION['userId']))
    $temp = $_SESSION['userId'];
  $_SESSION['userId'] = 74;

  $result = retrieve_seller_auctions();
  $result = filter_auctions_without_bids($result);

  assert($result[0]['auctionId'] == 5);

  if($temp)
    $_SESSION['userId'] = $temp;
}

//@TEST
function filter_auctions_without_bids_failure() {
  $temp = null;

  if(isset($_SESSION['userId']))
    $temp = $_SESSION['userId'];
  $_SESSION['userId'] = 74;

  $result = retrieve_seller_auctions();
  $result = filter_auctions_without_bids($result);

  assert($result[0]['auctionId'] == 5);

  if($temp)
    $_SESSION['userId'] = $temp;
}

//@TEST
function filter_non_expired_auctions_success() {
  $temp = null;

  if(isset($_SESSION['userId']))
    $temp = $_SESSION['userId'];
  $_SESSION['userId'] = 74;

  $result = retrieve_seller_auctions();
  $result = filter_non_expired_auctions($result);

  // echo "<pre>";
  // print_r($result);
  // echo "</pre>";

  assert($result[3]['auctionId'] == 5);

  foreach ($result as $auction) {
    assert(!($auction['auctionId'] == 7));
  }

  if($temp)
    $_SESSION['userId'] = $temp;
}

//@TEST
function filter_non_expired_auctions_failure() {

}

//@TEST
function filter_expired_auctions_success() {
  $temp = null;

  if(isset($_SESSION['userId']))
    $temp = $_SESSION['userId'];
  $_SESSION['userId'] = 74;

  $result = retrieve_seller_auctions();
  $result = filter_expired_auctions($result);

  echo "<pre>";
  print_r($result);
  echo "</pre>";

  // assert($result[3]['auctionId'] == 5);
  assert($result);
  foreach ($result as $auction) {
    assert(!($auction['auctionId'] == 5));
  }

  if($temp)
    $_SESSION['userId'] = $temp;
}

//@TEST
function filter_expired_auctions_failure() {

}

//@TEST
function retrieve_buyer_auctions_success() {
  $temp = null;

  if(isset($_SESSION['userId']))
    $temp = $_SESSION['userId'];

  $_SESSION['userId'] = 38;
  $result = retrieve_buyer_auctions();

  assert($result[0]['auctionId'] == 5);

  if($temp)
    $_SESSION['userId'] = $temp;
}

//@TEST
function retrieve_buyer_auctions_failure() {

}

//test for failure first post
first_form_test_failure();
//$errors = array();
clear_errors();
//test for success first post
first_form_test_success();
//$errors = array();
clear_errors();

//clear_errors();

//test for failure second post
second_form_test_failure();
//$errors = array();
clear_errors();
//test for success second post
second_form_test_success();
//$errors = array();
clear_errors();

//create_new_user()
create_new_user_success();
create_new_user_failure();

//process_login_form()
process_login_form_failure();
clear_errors();
process_login_form_success();
clear_errors();

//attempt_login()
attempt_login_success();
attempt_login_failure();

//process_search_form()
process_search_form_success();
process_search_form_failure();

//get_price()
get_price_success();
get_price_failure();

//process_filter_form()
process_filter_form_not_empty();
process_filter_form_empty();

//retrieve_seller_auctions()
retrieve_seller_auctions_success();
retrieve_seller_auctions_failure();

//get_price_with_buyer_id()
get_price_with_buyer_id_failure();
get_price_with_buyer_id_success();

//filter_auctions_without_bids()
filter_auctions_without_bids_success();
filter_auctions_without_bids_failure();

//filter_non_expired_auctions()
filter_non_expired_auctions_success();
filter_non_expired_auctions_failure();

//filter_expired_auctions()
filter_expired_auctions_success();
filter_expired_auctions_failure();

//retrieve_buyer_auctions()
retrieve_buyer_auctions_success();
retrieve_buyer_auctions_failure();

$test_outcome = "<h3>All tests completed";
$test_outcome .= "</h3>";

echo $test_outcome;

?>
