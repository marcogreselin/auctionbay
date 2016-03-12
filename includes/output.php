<?php
/*  Outputs the content of the $errors array, precondition: $errors variable
* is an array*/
function output_errors(){
  global $errors;

  foreach ($errors as $error) {
    echo "<li> {$error} </li>";
  }
}

/*Returns the value in the SESSION of the relevant field, or "" if it is not set*/
function repeat_input($field) {
  if(isset($_SESSION[$field])) {
    return $_SESSION[$field];
  } else {
    return "";
  }
}

function repeat_input_POST($field) {
  if(isset($_POST[$field])) {
    return $_POST[$field];
  } else {
    return "";
  }
}
?>
