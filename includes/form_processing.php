<?php

require_once('../includes/navigation.php');
require_once('../includes/validation_functions.php');
require_once('../includes/queries.php');

/*  Processes the content of the first form, not needed outside of
address.php*/
function process_first_form() {
  global $errors;

  $required_fields = array("firstname",
  "lastname",
  "email",
  "password",
  "passwordagain",
  //"role-check"
);
  validate_presences($required_fields);

  //  Limits provided should correspond to the limits set in the sql database
  $fields_with_max_lengths = array("firstname" => 20,
  "lastname" => 20,
  "email" => 50,
  "password" => 20);
  validate_max_lengths($fields_with_max_lengths);

  // Check that password == passwordagain
  matches($_POST['password'], $_POST['passwordagain']);

  // check that email has not already been used
  validate_email($_POST['email']);

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
    $_SESSION['county']       = $_POST['county'];
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
    return $user;
  } else {
    //email does not match any user (boolean short-circuit),
    //or if it does the passwords does not match
    return 0;
  }
}

function process_search_form() {
  $value = "";

  if(isset($_GET['token']) &&
      validate_presences_general(array(0 => "token"), $_GET)) //if input is not blank/absent
  //if(isset($_GET["token"]))
    $value = rawurlencode(trim($_GET["token"])); // escape characters

  return $value; //returns either 0 or the encoded input token
}



?>
