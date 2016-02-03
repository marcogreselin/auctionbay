<?php
/*Collections of functions pertaining to navigation*/

//see http://www.lynda.com/MySQL-tutorials/Welcome/119003/136910-4.html
function redirect_to($new_location) {
  header("Location: " . $new_location);
  exit;
}


 ?>
