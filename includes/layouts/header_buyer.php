<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AuctionBay</title>
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
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-lg" role="navigation">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><div class="logo-small"></div>AuctionBay</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
          <span class="sr-only">Toggle navigation</span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav">
          <li><a href="buyer_account.php">My Account</a></li>
          <li><a href="search.php">Search</a></li>
          </ul>

        <p class="navbar-text navbar-right">
          <a class="navbar-link" href="logout.php">Logout</a>
        </p>
        <form class="navbar-form navbar-right" action="results.php?" method="get">
          <div class="form-group">
            <div class="input-group">
              <input class="form-control" id="navbarInput-01" type="text" name="token" placeholder="Search">
              <span class="input-group-btn">
                <button type="submit" class="btn"><span class="fui-search"></span></button>
              </span>
            </div>
          </div>
        </form>
      </div><!-- /.navbar-collapse -->
    </nav><!-- /navbar -->