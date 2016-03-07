<?php
  //define directives describe values expected in the SESSION
  define("ROLE_BUYER", 1);
  define("ROLE_SELLER", 2);

  session_start();

/*Resets the SESSION*/
  function clear_session() {
    $_SESSION = array();
    session_unset();
    //destroy cookie session name TODO
  }

/*Returns true if the session stores the value ROLE_BUYER under the 'role' key,
* false otherwise*/
function is_buyer() {
  return (isset($_SESSION['role']) && ($_SESSION['role'] == ROLE_BUYER));

}

/*Returns true if the session stores the value ROLE_SELLER under the 'role' key,
* false otherwise*/
function is_seller() {
  return (isset($_SESSION['role']) && ($_SESSION['role'] == ROLE_SELLER));

}

?>
