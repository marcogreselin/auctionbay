<?php
//Override assert config
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_BAIL, 0);

//Dependencies
require("../includes/dbconnection.php");
require("../includes/session.php");
require("../includes/queries.php");

//@TEST
function query_insert_user_test_failure() {
  global $connection;

  session_unset();

  $_SESSION['firstname'] = "testname";
  $_SESSION['lastname'] = "testname";
  $_SESSION['email'] = "testemail";
  //$_SESSION['role'] = 1; //commenting this out causes failure
  $_SESSION['password'] = 'pw';
  $_POST['address'] = "address";
  $_POST['city'] = "city";
  $_POST['county'] = "county";
  $_POST['postcode'] = "postcode";
  $_POST['country'] = "country";
  $_POST['phonenumber'] = "notanumber";

  assert(!query_insert_user());
}

//@TEST
function query_insert_user_test_success() {
  //good connection
  global $connection;

  session_unset();

  $_SESSION['firstname'] = "testname";
  $_SESSION['lastname'] = "testname";
  $_SESSION['email'] = "testemail";
  $_SESSION['role'] = 1;
  $_SESSION['password'] = 'pw';
  $_POST['address'] = "address";
  $_POST['city'] = "city";
  $_POST['county'] = "county";
  $_POST['postcode'] = "postcode";
  $_POST['country'] = "country";
  $_POST['phonenumber'] = "notanumber";

  assert(query_insert_user());
}

//@TEST
function query_select_last_user_success() {
  global $connection;

  assert(query_select_last_user()['firstName'] == "testname");
}

//@TEST
function query_insert_address_failure() {
  global $connection;

  //$_POST['address'] = "address";
  $_POST['city'] = "city";
  //$_POST['county'] = "county";
  $_POST['postcode'] = "postcode";
  $_POST['county'] = "county";
  //$_POST['phonenumber'] = "phonenumber";

  assert(!query_insert_address());
}

//@TEST
function query_insert_address_success() {
  global $connection;

  $_POST['address'] = "address";
  $_POST['city'] = "city";
  $_POST['county'] = "county";
  $_POST['postcode'] = "postcode";
  $_POST['county'] = "county";
  $_POST['phonenumber'] = 1234;

  assert(query_insert_address());
}

//@TEST
function query_email_exists_failure() {
  global $connection;

  $_SESSION['email'] = "thisisnotanemail";

  assert(!query_email_exists());
}

//@TEST
function query_email_exists_success() {
  global $connection;

  $_SESSION['email'] = "testemail";

  assert(query_email_exists());
};

//@TEST
function query_count_occurrences_success() {
  global $connection;

  $value = "testemail";
  $column = "email";
  $table = "user";

  assert(query_count_occurrences($value, $column, $table));
}

//@TEST
function query_count_occurrences_failure() {
  global $connection;

  $value = 22;
  $column = "email";
  $table = "user";

  assert(!query_count_occurrences($value, $column, $table));
}

//@TEST
function query_select_user_by_email_failure() {
  global $connection;

  $email = "notused";
  //$role = "notanumber";
  assert(!query_select_user_by_email($email));
}

//@TEST
function query_select_user_by_email_success() {
  global $connection;

  $email = "niccolo.terreri.15@ucl.ac.uk";
  //$role = 0;

  assert(query_select_user_by_email($email));
}

//@TEST
function query_select_auction_search_failure() {
  $token = "5454652ab"; //hopefully doesn't match anything
  assert(!query_select_auction_search($token));

}

//@TEST
function query_select_auction_search_success() {
  $token = "title";
  assert(query_select_auction_search($token));

  $token = "itl";
  assert(query_select_auction_search($token));

  $token = "TITLE";
  assert(query_select_auction_search($token));

  $token = "tItLe";
  assert(query_select_auction_search($token));

  $token = "descr";
  assert(query_select_auction_search($token));

  //warning: does it match on empty?
  //should be caught by form processing
  $token = "";
  assert(query_select_auction_search($token));

  $token = " ";
  assert(query_select_auction_search($token));
}

//@TEST
function query_select_current_price_success() {
  $auctionId = 5;

  $result = query_select_current_price($auctionId);

  assert($result['value'] == 101 && $result['user_id'] == 38);
 //print_r(query_select_current_price($auctionId));
 // echo query_select_current_price($auctionId) . "<br/>";
}

//@TEST
function query_select_current_price_failure() {
  $auctionId = 2;

  assert(!query_select_current_price($auctionId));
}

//@TEST
function query_select_address_failure() {

  //precondition:
  $userId = 9999999;

  //postcondition: returns 0
  assert(!query_select_address($userId));
}

//@TEST
function query_select_address_success() {

  $userId = 78;

  //postcondition: zip for user 78 is "postcode"
  assert(query_select_address($userId)['zip'] == "postcode");
}

//@TEST
function query_select_seller_auctions_failure() {
  $userId = 1;

  assert(!query_select_seller_auctions($userId));
}

//@TEST
function query_select_seller_auctions_success() {
  $userId = 74;

  //echo query_select_seller_auctions($userId)[0]['auctionId'];
  //print_r(query_select_seller_auctions($userId));
  assert(query_select_seller_auctions($userId)[0]['auctionId'] == 2);
}

//query_insert_user()
//query_insert_user_test_failure();
//query_insert_user_test_success();

//query_select_last_user()
query_select_last_user_success();

//query_insert_address()
//query_insert_address_failure();
//query_insert_address_success();

//query_email_exists()
query_select_user_by_email_failure();
query_select_user_by_email_success();

//query_count_occurrences()
query_count_occurrences_success();
query_count_occurrences_failure();

//query_select_auction_search()
query_select_auction_search_failure();
query_select_auction_search_success();

//query_select_current_price()
query_select_current_price_success();
query_select_current_price_failure();

//query_select_address()
query_select_address_failure();
query_select_address_success();

//query_select_seller_auctions()
query_select_seller_auctions_failure();
query_select_seller_auctions_success();

echo "<h3>All tests completed</h3>";

?>
