<?php
  setcookie("test",45,time()+60*60*24*7);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>My Account</title>
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
        <a class="navbar-brand"><div class="logo-small"></div>AuctionBay</a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
          <span class="sr-only">Toggle navigation</span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#fakelink">My Account</a></li>
          <li><a href="#fakelink">Search</a></li>
        </ul>
        <p class="navbar-text navbar-right">
          <a class="navbar-link" href="index.php">Logout</a>
        </p>
        <form class="navbar-form navbar-right" action="#" role="search">
          <div class="form-group">
            <div class="input-group">
              <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">
              <span class="input-group-btn">
                <button type="submit" class="btn"><span class="fui-search"></span></button>
              </span>
            </div>
          </div>
        </form>
      </div><!-- /.navbar-collapse -->
    </nav><!-- /navbar -->


    <div class="container">
      <h1>My Account</h1>
      <p>Welcome to your personal area. Here you can check your personal details as well as monitor auctions you have bid for.</p>
    
    <div class="row">
      <div class="col-md-2 menu-margin">
        <ul class="nav nav-list">
          <li class="active">
            <a href="#address">
              Address
            </a>
          </li>

          <li>
            <a href="#bids">
              Bids
            </a>
          </li>

          <li>
            <a href="#following">
              Following
            </a>
          </li>
        </ul>
      </div>


      <div class="col-md-10">
      <a name="address"><h3>My Details</h3></a>
      <p><b>My Address:</b><br>
      Alex Vally<br>
      54, Marylebone Street<br>
      W1H 675 London<br>
      email: alex@vally.com</p>

      <a name="bids"><h3>My Recent Bids</h3></a>
      <table class="table table-striped">
        <col width="200px">
        <tr>
          <th>Item Name</th>
          <th>Description</th>
          <th>Status</th>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">First Row, first column</a></td>
          <td>First Row, second column</td>
          <td>First Row, third column</td>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">Second Row, first column</a></td>
          <td>Second Row, second column</td>
          <td>Second Row, third column</td>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">Third Row, first column</a></td>
          <td>Third Row, second column</td>
          <td>Third Row, third column</td>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">Third Row, first column</a></td>
          <td>Third Row, second column</td>
          <td>Third Row, third column</td>
        </tr>
      </table>

      <a name="following"><h3>Following</h3></a>
      <table class="table table-striped">
        <col width="200px">
        <col width="auto">
        <col width="auto">
        <col width="50px">
        <tr>
          <th>Item Name</th>
          <th>Description</th>
          <th>Current Price</th>
          <th>Unfollow</th>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">First Row, first column</a></td>
          <td>First Row, second column</td>
          <td>First Row, third column</td>
          <td><a href="#"><img src="img/trash.svg" class="trash-icon" title="CUnollow"></a></td>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">Second Row, first column</a></td>
          <td>Second Row, second column</td>
          <td>Second Row, third column</td>
          <td><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">Third Row, first column</a></td>
          <td>Third Row, second column</td>
          <td>Third Row, third column</td>
          <td><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
        </tr>
        <tr>
          <td><a href="#"><img src="img/user-interface.svg" title="Insert title" class="image-table">Third Row, first column</a></td>
          <td>Third Row, second column</td>
          <td>Third Row, third column</td>
          <td><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
        </tr>
      </table>
    </div>
    </div>


    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/video.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/flat-ui-pro.js"></script>
    <!-- This is for the smooth scrolling. See http://stackoverflow.com/questions/7717527/jquery-smooth-scrolling-when-clicking-an-anchor-link -->
    <script type="text/javascript">
      $('a').click(function(){
          $('html, body').animate({
              scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
          }, 500);
          return false;
      });
    </script>

  </body>
</html>