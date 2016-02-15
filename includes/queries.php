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
  //$username   = "";
  //$date = date('Y-m-d');

  $password   = password_hash($_SESSION['password'], PASSWORD_BCRYPT);

  //construct query
  $query  = "INSERT INTO user ";
  $query .= "(role, email, password, firstName, lastName) ";
  $query .= "VALUES ";
  $query .= "({$role}, '{$email}', '{$password}', ";
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

/*Constructs a query and sends it to the database connection specified by the
* $connection global variable. Fetches the data to input in the query from the
* $_POST super global. Uses an inefficient futher query to the database in order
* to determine the latest user inserted. This may also cause issues where
* multiple user insertion queries are performed close to each other and their
* complementary address insertion queries are performed asynchronously. Would be
* best to lock the user table until the present procedure returns, so that no
* user can be added to the database while another user's data is being inserted
* into the "user" and "address" tables.
* Returns 1 if the query succeeded, 0 otherwise.*/
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

/*Fetches the user with the largest userId (the last inserted user).*/
function query_select_last_user() {
  global $connection;

  $query = "SELECT * FROM user ORDER BY userId DESC LIMIT 1;";
  //execute query
  $result_set = mysqli_query($connection, $query);

  return mysqli_fetch_assoc($result_set);
}

/*<strike>@NEEDS: to also check the type of account</strike>
* Should be used to verify that the user registering has not previously
* registered*/
function query_email_exists(/*$account_type*/) {
  //SELECT count(1) FROM user WHERE email='{$email}';
  global $connection;

  //prep value
  $email = mysqli_real_escape_string($connection, $_SESSION['email']);

  //construct query
  $query = "SELECT count(1) FROM user WHERE email='{$email}'";

  //execute query
  $result = mysqli_query($connection, $query);

  return $result;
}

/*Generic method to return the number of occurrences of $value parameter inside
* the $column of the table specified by $table.*/
function query_count_occurrences($value, $column, $table) {
  global $connection;

  //prep value
  $value = mysqli_real_escape_string($connection, $value);

  //construct query
  $query = "SELECT * FROM {$table} WHERE {$column}='{$value}'";

  //execute query
  $result = mysqli_query($connection, $query);
  $result = mysqli_num_rows($result);

  return $result;
}

/*Returns the row from the user table corresponding to the email parameter
* or 0/false if no match can be found*/
function query_select_user_by_email($email) {
  global $connection;

  //prep values
  $email  = mysqli_real_escape_string($connection, $email);
  //$role   = mysqli_real_escape_string($connection, $role);

  //construct query
  $query = "SELECT * FROM user WHERE email='{$email}' LIMIT 1";

  //execute query
  $result = mysqli_query($connection, $query);

  if($result) {
    return mysqli_fetch_assoc($result);
  } else {
    return 0;
  }
}

/*Returns an associative array containing auction matching search token*/
function query_select_auction_search($token) {
  global $connection;

  //prep input
  $token = mysqli_real_escape_string($connection, $token);

  //prep query
  $query  = "SELECT auctionId, title, description ";
  $query .= "FROM auction ";
  $query .= "WHERE title LIKE '%{$token}%' OR ";
  $query .= "       description LIKE '%{$token}%' ";
  $query .= "LIMIT 50;";

  $result_set = mysqli_query($connection, $query);

  if($result_set)
    $result_set = mysqli_fetch_all($result_set);

  return $result_set;
}

?>
