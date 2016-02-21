<?php
setcookie("test", 45, time() + 60 * 60 * 24 * 7);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Leave_Feedback</title>
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

    <!-- Select 2 -->
    <link href="css/select-two/css/select2.min.css" rel="stylesheet"/>
    <script src="css/select-two/js/select2.min.js"></script>


    <!-- Loading Glyphicons -->
    <!--    <link href="css/glyphicons/css/bootstrap.min.css" rel="stylesheet"/>-->


    <link rel="shortcut icon" href="img/favicon.ico">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>

    <script src="js/vendor/html5shiv.js"></script>
    <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
</head>


<body>
<!-- Navbar -->
<nav class="navbar navbar-default navbar-lg" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand">
            <div class="logo-small"></div>
            AuctionBay</a>
    </div>
    <p class="navbar-text navbar-right">Return to the <a class="navbar-link" href="index.php">Home Page</a></p>

    <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav">
        </ul>
    </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->

<div class="container">

        <h1>Leave Feedback for: <?php echo "Jeffrey Yong"; ?></h1>
    <div class="jumbotron">
        <form class="feedback-form" action="" method="post">
            <div class="form-group form-group-lg">

                <div class="row">
                <div class="col-sm-6 leave-feedback-item-container">
                    <p><h4>Item title</h4></p>
                    <a href="#"><img src="img/user-interface.svg" title="Insert title" class="leave-feedback-image"></a>
                </div>


                <div class="col-sm-6">
                    <div class="feedback-star-rating" data-steps="2">
                        <fieldset class="rating rating-leave-feedback">
                            <input type="radio" id="star5" name="rating" value="5"/><label for="star5" title="Rocks!">5
                                stars</label>
                            <input type="radio" id="star4" name="rating" value="4"/><label for="star4"
                                                                                           title="Pretty good">4
                                stars</label>
                            <input type="radio" id="star3" name="rating" value="3"/><label for="star3" title="Meh">3
                                stars</label>
                            <input type="radio" id="star2" name="rating" value="2"/><label for="star2"
                                                                                           title="Kinda bad">2
                                stars</label>
                            <input type="radio" id="star1" name="rating" value="1"/><label for="star1"
                                                                                           title="Sucks big time">1
                                star</label>
                        </fieldset>
                    </div>
                </div>
                </div>

                <div class="input-comment">
                    <input class="form-control input-comment-title" id="input-title" placeholder="Please give a title"
                           maxlength="140">
                </div>

                <textarea class="form-control textarea-comment" id="textarea-comment" placeholder="What do you think?"
                          maxlength="500"></textarea>
                <div id="textarea-characters-remaining"></div>

                <input class="btn-submit-comment btn-hg btn-primary btn-block"
                       type="submit" name="submit" value="Submit your comment">
            </div>
        </form>
    </div>
</div>


    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="js/vendor/jquery.min.js"></script>

    <!-- Includes the Boostrap JavaScript plugins) -->
    <script src="js/vendor/bootstrap.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="js/vendor/video.js"></script>
    <script src="js/flat-ui-pro.js"></script>
    <!--<script src="css/glyphicons/js/bootstrap.min.js"></script>-->


    <!-- Counting down the number of characters left in the comment textarea -->
    <script type="text/javascript">
        $(document).ready(function() {
            var maxText = 500;
            $('#textarea-characters-remaining').html(maxText + ' characters remaining');

            $('#textarea-comment').keyup(function() {
                var textLength = $('#textarea-comment').val().length;
                var remainingText = maxText - textLength;

                $('#textarea-characters-remaining').html(remainingText + ' characters remaining');
            });
        });
    </script>
</body>
</html>