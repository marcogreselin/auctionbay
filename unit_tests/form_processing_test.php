<?php
//Override assert config
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_BAIL, 0);

//Dependencies
require("../includes/validation_functions.php");
require("../includes/form_processing.php");


function clear_errors() {
  global $errors;

  $errors = array();
}

function clear_POST() {
  foreach ($_POST as $key => $value) {
    unset($_POST[$key]);
  }
}

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

echo "<h3>All tests completed</h3>";

?>
