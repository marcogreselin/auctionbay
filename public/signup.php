<?php
//  Cookies

 setcookie("test",45, time()+60*60*24*7);
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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

    <!-- Loading Font Awesome Icons -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

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
      </div>
            <p class="navbar-text navbar-right">Return to the <a class="navbar-link" href="index.php">Home Page</a></p>

      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav">

        </ul>

      </div><!-- /.navbar-collapse -->
    </nav><!-- /navbar -->


    <div class="row">
        <div class="col-sm-4 header-signup">
            <h1>Sign Up</h1>
        </div>
        <div class="col-sm-8 pull-left login-box">
            <p>
                <div class="alert alert-danger">
                    <button class="close fui-cross" data-dismiss="alert"></button>
                    <h4>Opps!</h4>
                    <p>The email address has been used, please use another email address.</p>
                </div>
            </p>
        </div>
    </div>




    <form class="sign-up-form form-horizontal" action="address.php" method="post">



        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="firstname"><h4>First Name:</h4></label>
            <div class="col-sm-8">
                <input type="text" class="form-control"
                name="firstname" value=""
                id="firstname" placeholder="Your first name">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="lastname"><h4>Last Name:</h4></label>
            <div class="col-sm-8">
                <input type="text" class="form-control"
                name="lastname" value=""
                id="lastname" placeholder="Your last name">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="email"><h4>Email:</h4></label>
            <div class="col-sm-8">
                <input type="email" class="form-control"
                name="email" value=""
                id="email" placeholder="Enter email">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="pwd"><h4>Password:</h4></label>
            <div class="col-sm-8">
                <input type="password" class="form-control"
                name="password" value=""
                id="pwd" placeholder="Enter password">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="pwdagain"><h4>Password again:</h4></label>
            <div class="col-sm-8">
                <input type="password" class="form-control"
                name="passwordagain" value=""
                id="pwdagain" placeholder="Enter password again">
            </div>
        </div>

        <div class="container text-center">
            <div class="form-group container-survey-radio">
                <div class="row">
                    <div class="col-xs-2 col-xs-offset-4">
                        <label class="radio-inline control-label">
                            <div class="form-group container-survey-yesno">
                                <input class="role-checkbox"
                                       type="radio"
                                       id="role-checkbox-buyer"
                                       name="role-check"
                                       value="0"/>
                                <label class="role-check-label" for="role-checkbox-buyer">
                                    Buyer
                                </label>
                            </div>
                        </label>
                    </div>


                    <div class="col-xs-6">
                        <label class="radio-inline control-label">
                            <div class="form-group container-survey-yesno">
                                <input class="role-checkbox"
                                       type="radio"
                                       id="role-checkbox-seller"
                                       name="role-check"
                                       value="1"/>
                                <label class="role-check-label" for="role-checkbox-seller">
                                    Seller
                                </label>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <!-- Submitting form will post the data to address.php to be used -->
        <div class="form-group form-group-hg">
            <div class="col-sm-8 col-sm-offset-4 text-center">
                <input class="btn btn-hg btn-primary btn-block"
                type="submit" name="submit" value="Continue to enter you address">
            </div>
        </div>
    </form>
</div>
<!-- /.container -->


<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="js/vendor/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/vendor/video.js"></script>
<script src="js/flat-ui-pro.js"></script>

</body>
</html>
