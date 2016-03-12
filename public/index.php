<?php
  //Dependencies
  require_once("../includes/session.php");
  require_once("../includes/navigation.php");
  header("Location: login.php");
  if(is_buyer()) {
    redirect_to("buyer_account.php");
  } elseif(is_seller()) {
    redirect_to("seller_account.php");
  } else {
    redirect_to("login.php");
  }
?>