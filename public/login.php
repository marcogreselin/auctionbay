<?php
// Dependencies
require_once('../includes/dbconnection.php');
require_once('../includes/session.php');
require_once('../includes/form_processing.php');

// Cookies
setcookie("test",45,time()+60*60*24*7);

//if user is logged in, log out first:
if(is_buyer() || is_seller()) {
  clear_session();
}

if(isset($_POST['submit'])) {
  //store form data to display back to the user:
  $email = $_POST['email'];

  //  Process form from login.php

  process_login_form();
  if($_POST['login_details']) {
    $user = attempt_login($_POST['email'], $_POST['password']);
    if($user) {
      //login successful

      //restart the session
      clear_session();
      //$_SESSION['logged_in'] = 1;
      $_SESSION['role'] = $user['role'];
      $_SESSION['userId'] = $user['userId'];

      redirect_to("buyer_account.php");
    } else {
      $errors['login'] = "No database match";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AuctionBay - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Loading Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Loading Flat UI -->
  <link href="css/flat-ui.css" rel="stylesheet">

  <!-- Loading AB CSS -->
  <link href="css/auctionbay.css" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon.ico">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="js/vendor/html5shiv.js"></script>
  <script src="js/vendor/respond.min.js"></script>
  <![endif]-->
</head>
<body class="logout">
  <!-- Navbar -->
  <nav class="navbar navbar-default navbar-lg" role="navigation">
    <div class="navbar-header">
      <a class="navbar-brand"><div class="logo-small"></div>AuctionBay</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">
      <ul class="nav navbar-nav">

      </ul>

    </div><!-- /.navbar-collapse -->
  </nav><!-- /navbar -->


  <div class="container text-center">
    <div class="login-headline">Welcome!</div>

    <!-- Alert if wrong credentials -->
    <?php if(isset($errors) && !empty($errors)) {
      $output  = "<p>";
      $output .= "<div class=\"alert alert-danger login-box\">";
      $output .= "<button class=\"close fui-cross\" data-dismiss=\"alert\"></button>";
      $output .= "<h4>Something went wrong!</h4>";
      $output .= "<p>Your email or password was wrong. Please try again.</p>";
      $output .= "</div>";
      $output .= "</p>";

      echo $output;
    }?>

    <form action="login.php" method="post">
      <p><input type="email" class="form-control input-hg login-box"
        name="email" placeholder="Enter your email"
        value=<?php echo ((isset($_POST['submit'])) ? $email : "") ?> ></p>
        <p><input type="password" class="form-control input-hg login-box"
          name="password" placeholder="Enter your password" /></p>
          <p><input class="btn btn-hg btn-primary"
            type="submit" name="submit" value="Enter!"></p>
          </form>
          <!--<p><button onclick="location.href='buyer_account.php'" class="btn btn-hg btn-primary">
          Enter!
        </button></p>-->

        <p><h7><a href="signup.php">Not yet a member?</a></h7></p>

      </div>
      <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
      <script src="js/vendor/jquery.min.js"></script>
      <script src="js/vendor/video.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/flat-ui-pro.js"></script>

    </body>
    </html>
