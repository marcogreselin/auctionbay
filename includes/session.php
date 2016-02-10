<?php
  //define directives describe values expected in the SESSION
  define("ROLE_BUYER", 0);
  define("ROLE_SELLER", 1);

  session_start();

  function clear_session() {
    $_SESSION = array();
    session_unset();
  }
?>
