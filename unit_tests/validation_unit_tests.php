<?php
require_once("../includes/validation_functions.php");
require_once("../includes/queries.php");
require_once("../includes/dbconnection.php");

$errors = array();

//@TEST
function validate_phone_failure1() {
  $_POST['phone'] = "abcd";
  assert(!validate_phone("phone"));
}

//@TEST
function validate_phone_failure2() {
  $_POST['phone'] = "1234b5";
  assert(!validate_phone("phone"));
}

//@TEST
function validate_phone_success() {
  $_POST['phone'] = "12345";
  assert(validate_phone("phone"));
}

//@TEST
function validate_email_success() {
  global $errors;
  clear_errors();

  validate_email("niccolo.terreri.15@ucl.ac.uk");
  assert(!empty($errors));
}

//@TEST
function validate_email_failure() {
  global $errors;
  clear_errors();

  validate_email("bla");
  assert(empty($errors));
}

//@TEST
function validate_presences_general_success() {
  global $errors;
  clear_errors();

  $_POST['presence1'] = "presence1";
  $_POST['presence2'] = "presence2";

  assert(validate_presences_general(array('presence1', 'presence2'), $_POST));

  clear_errors();

  $array = array();
  $array['presence1'] = "presence1";
  $array['presence2'] = "presence2";

  assert(validate_presences_general(array('presence1', 'presence2'), $array));
}

function validate_presences_general_failure() {
  global $errors;
  clear_errors();

  $_POST['presence1'] = "";
  $_POST['presence2'] = "presence2";

  assert(!validate_presences_general(array('presence1', 'presence2'), $_POST));

  clear_errors();

  $array = array();
  $array['presence1'] = "presence1";
//  $array['presence2'] = "presence2";

  assert(!validate_presences_general(array('presence1', 'presence2'), $array));
}

function validate_role_failure() {
  global $errors;
  clear_errors();

  unset($_POST);
  validate_role($_POST['role-check']);
  assert(!empty($errors));

  $_POST['role-check'] = "unacceptable";
  validate_role($_POST['role-check']);
  assert(!empty($errors));
}

function validate_role_success() {
  global $errors;
  clear_errors();

  $_POST['role-check'] = 1;
  validate_role($_POST['role-check']);
  assert(empty($errors));
}

//validate_phone()
validate_phone_failure1();
validate_phone_failure2();
validate_phone_success();

//validate_email()
validate_email_success();
validate_email_failure();

//validate_presences_general()
validate_presences_general_success();
validate_presences_general_failure();

//validate_role()
validate_role_success();
validate_role_failure();

echo "<h3>All tests completed</h3>";
?>
