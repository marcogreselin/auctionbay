<?php

require_once('../includes/navigation.php');
require_once('../includes/validation_functions.php');

/*  Processes the content of the first form, not needed outside of
address.php*/
function process_first_form() {
  global $errors;

  $required_fields = array("firstname",
  "lastname",
  "email",
  "password",
  "passwordagain",
  "role-check");
  validate_presences($required_fields);

  //  Limits provided should correspond to the limits set in the sql database
  $fields_with_max_lengths = array("firstname" => 20,
  "lastname" => 20,
  "email" => 50,
  "password" => 20);
  validate_max_lengths($fields_with_max_lengths);

  // Check that password == passwordagain
  matches($_POST['password'], $_POST['passwordagain']);

  if(empty($errors)) {
    // Success outcome:
    // Store values entered and wait for user to submit current form

    //  This uses the current session, session should be
    //  destroyed once the registration process ends :NT
    $_SESSION['firstname']= $_POST['firstname'];
    $_SESSION["lastname"] = $_POST['lastname'];
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["password"] = $_POST['password'];
    $_SESSION["role"] = $_POST['role-check'];

  } else {
    // Failure outcome: one or more elements in $errors

    //  Either display messages from $erros here in address.php or
    //  signup.php

    //Unit-testing only:
    if(isset($_POST['test'])){
      echo "Errors from process_first_form():";
      echo "<pre>";
      echo print_r($errors);
      echo "</pre>";
    }
    else {
      if(!isset($_POST['test']))
        redirect_to("signup.php");
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
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['county'] = $_POST['county'];
    $_SESSION['postcode'] = $_POST['postcode'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['phonenumber'] = $_POST['phonenumber'];

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
      if(!isset($_POST['test']))
        redirect_to("signup.php");
    }
  }
}

?>
