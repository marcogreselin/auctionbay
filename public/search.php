<?php

  include("../includes/layouts/header_buyer.php");

//Dependencies

require_once("../includes/session.php");
require_once("../includes/form_processing.php");



?>

<div class="container text-center">
  <div class="login-headline">Search!</div>
  <form action="results.php?token="<?php echo process_search_form(); ?>
    method="get">
    <p><input type="text" name="token" class="form-control input-hg search-box"
      placeholder="What do you want to search?"></p>
    <p><input class="btn btn-hg btn-primary" type="submit"
      value="Search"></p>
  </form>

</div>


<?php
  include("../includes/layouts/footer.php");
?>
