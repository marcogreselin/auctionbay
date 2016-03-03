<?php
//Override assert config
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_BAIL, 0);

//Dependencies
require("../includes/session.php");

//@TEST
function is_buyer_success(){

  clear_session();

  $_SESSION['role'] = ROLE_BUYER;

  assert(is_buyer());
}

//@TEST
function is_buyer_failure1(){

    clear_session();

    $_SESSION['role'] = "string";

  assert(!is_buyer());
  // assert("string" == ROLE_BUYER);
  // assert(ROLE_BUYER == 0);
  // assert(ROLE_BUYER == 1);
  // assert(ROLE_BUYER == 5000);
  // assert(ROLE_BUYER == -23);
  // assert(ROLE_BUYER == "another string");
}

//@TEST
function is_buyer_failure2(){

    clear_session();

    $_SESSION['role'] = -5000;

    assert(!is_buyer());
}

//@TEST
function is_seller_success(){

  clear_session();

  $_SESSION['role'] = ROLE_SELLER;

  assert(is_seller());
}

//@TEST
function is_seller_failure1(){

    clear_session();

    $_SESSION['role'] = "string";

  assert(!is_seller());
  // assert("string" == ROLE_BUYER);
  // assert(ROLE_BUYER == 0);
  // assert(ROLE_BUYER == 1);
  // assert(ROLE_BUYER == 5000);
  // assert(ROLE_BUYER == -23);
  // assert(ROLE_BUYER == "another string");
}

//@TEST
function is_seller_failure2(){

    clear_session();

    $_SESSION['role'] = ROLE_BUYER;

    assert(!is_seller());
}


//is_buyer()
is_buyer_success();
is_buyer_failure1();
is_buyer_failure2();

//is_seller()
is_seller_success();
is_seller_failure1();
is_seller_failure2();


$test_outcome = "<h3>All tests completed";
$test_outcome .= "</h3>";

echo $test_outcome;

?>
