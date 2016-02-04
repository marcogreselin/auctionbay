<?php
require_once("../includes/validation_functions.php");

$_POST['phone'] = "";

$_POST['phone'] = "abcd";
assert(!validate_phone("phone"));
$_POST['phone'] = "12345";
assert(validate_phone("phone"));
$_POST['phone'] = "1234b5";
assert(!validate_phone("phone"));

echo "<h3>All tests completed</h3>";
?>
