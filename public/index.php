<?php
  setcookie("test",45,time()+60*60*24*7);
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
        <p>
          <div class="alert alert-danger login-box">
            <button class="close fui-cross" data-dismiss="alert"></button>
            <h4>Something went wrong!</h4>
            <p>Your email or password was wrong. Please try again.</p>
          </div>
        </p>

        <p><input type="text" class="form-control input-hg login-box" placeholder="Enter your email" /></p>
        <p><input type="password" class="form-control input-hg login-box" placeholder="Enter your password" /></p>
        <p><button onclick="location.href='cookies.php'" class="btn btn-hg btn-primary">
          Enter!
        </button></p>
        <p><h7><a href="">Not yet a member?</a></h7></p>

    </div>
    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/video.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/flat-ui-pro.js"></script>

  </body>
</html>
