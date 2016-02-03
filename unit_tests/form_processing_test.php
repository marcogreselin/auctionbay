<?php
//Override assert config
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_BAIL, 0);

//Dependencies
require("../includes/validation_functions.php");
require("../includes/form_processing.php");

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
  assert(empty($erros), array("Expected \$errors to be empty"));
}

//test for success
first_form_test_success();

//test for failure
first_form_test_failure();

echo "<h3>All tests completed</h3>";
 ?>
