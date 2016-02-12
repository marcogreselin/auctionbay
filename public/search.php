<?php
  include("../includes/layouts/header_buyer.php");
?>

<div class="container text-center">
  <div class="login-headline">Search!</div>
  <p><input type="text" class="form-control input-hg search-box" placeholder="What do you want to search?" /></p>
  <p><button onclick="location.href='buyer_account.php'" class="btn btn-hg btn-primary">
      Search
  </button></p>
</div>

<?php
  include("../includes/layouts/footer.php");
?>