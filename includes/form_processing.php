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
        echo "Errors:";
        echo "<pre>";
        echo print_r($errors);
        echo "</pre>";
      }
      else{
        redirect_to("signup.php");
      }
    }
}

 ?>
