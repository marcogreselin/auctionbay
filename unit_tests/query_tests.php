<?php
//Override assert config
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_BAIL, 0);

//Dependencies
require("../includes/dbconnection.php");
require("../includes/session.php");
require("../includes/queries.php");

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

function query_select_last_user_success() {
  global $connection;

  assert(query_select_last_user()['firstName'] == "testname");
}

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

//query_insert_user()
query_insert_user_test_failure();
query_insert_user_test_success();

//query_select_last_user()
query_select_last_user_success();

//query_insert_address()
query_insert_address_failure();
query_insert_address_success();

echo "<h3>All tests completed</h3>";

?>
