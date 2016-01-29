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

<div class="container">
    <h1>Sign Up</h1>
    <form class="sign-up-form form-horizontal" role="form">


        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="firstname"><h4>First Name:</h4></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="firstname" placeholder="Your first name">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="lastname"><h4>Last Name:</h4></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="lastname" placeholder="Your last name">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="email"><h4>Email:</h4></label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="pwd"><h4>Password:</h4></label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password">
            </div>
        </div>

        <div class="form-group form-group-hg">
            <label class="control-label col-sm-4" for="pwdagain"><h4>Password again:</h4></label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="pwdagain" placeholder="Enter password again">
            </div>
        </div>


        <form class="role-check-form">
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
                                           value="yes"/>
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
                                           value="no"/>
                                    <label class="role-check-label" for="role-checkbox-seller">
                                        Seller
                                    </label>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="form-group form-group-hg">
            <div class="col-sm-8 col-sm-offset-4 text-center">
                <button class="btn btn-hg btn-primary btn-block">
                    Sign Up!
                </button>
            </div>
        </div>



        <!--<div class="form-group">-->
        <!--<div class="col-sm-offset-2 col-sm-10">-->
        <!--<div class="checkbox">-->
        <!--<label><input type="checkbox"> Remember me</label>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="form-group">-->
        <!--<div class="col-sm-offset-2 col-sm-10">-->
        <!--<button type="submit" class="btn btn-default">Submit</button>-->
        <!--</div>-->
        <!--</div>-->


        <!--<div class="form-group form-group-hg">-->
        <!--<label class="col-sm-2">-->
        <!--<h4>First Name:</h4>-->
        <!--</label>-->
        <!--<div class="col-sm-10">-->
        <!--<input class="form-control"-->
        <!--type="text"-->
        <!--id="firstname"-->
        <!--placeholder="First Name"/>-->
        <!--</div>-->
        <!--</div>-->

        <!--<div class="form-group form-group-hg">-->
        <!--<label class="col-sm-2">-->
        <!--<h4>Testing:</h4>-->
        <!--</label>-->
        <!--<div class="col-sm-10">-->
        <!--<input class="form-control"-->
        <!--type="text"-->
        <!--id="lastname"-->
        <!--placeholder="Testing"/>-->
        <!--</div>-->
        <!--</div>-->


        <!--<button class="btn-hg" text="Sign Up"/>-->
    </form>
</div>
<!-- /.container -->


<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="../dist/js/vendor/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../dist/js/vendor/video.js"></script>
<script src="../dist/js/flat-ui.min.js"></script>

</body>
</html>
