<?php

/*Constructs a query and sends it to the database connection specified by the
* $connection global variable. Fetches the data to input in the query from the
* $_SESSION super global. Returns 1 if the query succeeded, 0 otherwise.*/
function query_insert_user() {
  global $connection;

  //prep values
  $firstname  = mysqli_real_escape_string($connection, $_SESSION['firstname']);
  $lastname   = mysqli_real_escape_string($connection, $_SESSION['lastname']);
  $email      = mysqli_real_escape_string($connection, $_SESSION['email']);
  $role       = mysqli_real_escape_string($connection, $_SESSION['role']);
  $username   = "";
  //$date = date('Y-m-d');

  $password   = password_hash($_SESSION['password'], PASSWORD_BCRYPT);

  //construct query
  $query  = "INSERT INTO user ";
  $query .= "(role, email, username, password, firstName, lastName) ";
  $query .= "VALUES ";
  $query .= "({$role}, '{$email}', '{$username}', '{$password}', ";
  $query .= "'{$firstname}', '{$lastname}');";

  //execute query
  $result = mysqli_query($connection, $query);

  //check result
  if($result) {
    //Success
    return 1;
  } else {
    //Failure
    return 0;
  }
}


function query_insert_address() {
  global $connection;

  //prep values
  $address      = mysqli_real_escape_string($connection, $_POST['address']);
  $city         = mysqli_real_escape_string($connection, $_POST['city']);
  $county       = mysqli_real_escape_string($connection, $_POST['county']);
  $postcode     = mysqli_real_escape_string($connection, $_POST['postcode']);
  $country      = mysqli_real_escape_string($connection, $_POST['country']);
  $phonenumber  = mysqli_real_escape_string($connection, $_POST['phonenumber']);

  $street       = $address . ", " . $county;
  /*Unfortunately, userId must be fetched through a query to the database.
  * Different methods would involve generating a unique id per user through the
  * php logic, but this would probably produce a hexidecimal string, which would
  * need to be stored as a VARCHAR at the database level. Performance is not
  * critical for this project, so the worst performing solution is opted for.*/
  $userId       = query_select_last_user()['userId'];

  //construct query
  $query  = "INSERT INTO address ";
  $query .= "(user_id, street, zip, city, country, phone) ";
  $query .= "VALUES ";
  $query .= "($userId, '{$street}', '{$postcode}', '{$city}', '{$country}', ";
  $query .= "{$phonenumber});";

  //execute query
  $result = mysqli_query($connection, $query);

  //check result
  if($result) {
    //Success
    return 1;
  } else {
    //Failure
    return 0;
  }
}

/*Fetches the user with the largest userId (the last inserted user)*/
function query_select_last_user() {
  global $connection;

  $query = "SELECT * FROM user ORDER BY userId DESC LIMIT 1;";
  //execute query
  $result_set = mysqli_query($connection, $query);

  return mysqli_fetch_assoc($result_set);
}
?>
