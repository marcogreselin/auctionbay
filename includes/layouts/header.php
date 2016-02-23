<?php  

//Dependencies
  require_once("../includes/session.php");
  require_once("../includes/navigation.php");



if(is_buyer()) {
    include("header_buyer.php");
  } elseif(is_seller()) {
    include("header_seller.php");
  } else {
    redirect_to("index.php");
  }
?>