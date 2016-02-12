<?php
setcookie("test", 45, time() + 60 * 60 * 24 * 7);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Feedback</title>
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
    <h1>Feedback for <?php echo "User1"; ?></h1>


    <h4>User type: <?php echo "seller" ?></h4>


    <table class="feedback-table table table-striped">
        <col width="200px">
        <col width="200px">
        <col width="300px">
        <col width="200px">
        <col width="400px">


        <thead>
        <tr>
            <th align="right"><h4>Image</h4></th>
            <th><h4>Item Name</h4></th>
            <th><h4>Ratings</h4></th>
            <th><h4>Date</h4></th>
            <th><h4>Comment</h4></th>
        </tr>
        </thead>


        <tbody>
        <tr>
            <td>
                <a href="#"><img src="img/user-interface.svg" title="Insert title" class="feedback-table"></a>
            </td>
            <td>
                <a href="#"><h6>Item name</h6></a>
            </td>
            <td>
                <div class="feedback-star" data-steps="2">
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5"/><label for="star5"
                                                                                       title="Rocks!">5
                            stars</label>
                        <input type="radio" id="star4" name="rating" value="4"/><label for="star4"
                                                                                       title="Pretty good">4
                            stars</label>
                        <input type="radio" id="star3" name="rating" value="3"/><label for="star3"
                                                                                       title="Meh">3
                            stars</label>
                        <input type="radio" id="star2" name="rating" value="2"/><label for="star2"
                                                                                       title="Kinda bad">2
                            stars</label>
                        <input type="radio" id="star1" name="rating" value="1"/><label for="star1"
                                                                                       title="Sucks big time">1
                            star</label>
                    </fieldset>
                </div>
            </td>
            <td>
                Date
            </td>

            <td>
                <div class="container-feedback-comment">
                    Reque libris definitionem ne his, solum interesset ea sea. Eu mel enim movet
                    munere. Detracto rationibus instructior his an, ludus malorum docendi an ius.
                    Sadipscing vituperatoribus ei sea, id vix volutpat efficiendi. Eu qui omnes
                    quando accusata, habeo viderer ea duo, brute instructior per ad. Illud exerci at
                    duo, ne z
                </div>
            </td>
        </tr>


        <tr>
            <td>
                <a href="#"><img src="img/user-interface.svg" title="Insert title" class="feedback-table"></a>
            </td>
            <td>
                <a href="#"><h6>Item name</h6></a>
            </td>
            <td>
                <div class="feedback-star" data-steps="2">
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5"/><label for="star5"
                                                                                       title="Rocks!">5
                            stars</label>
                        <input type="radio" id="star4" name="rating" value="4"/><label for="star4"
                                                                                       title="Pretty good">4
                            stars</label>
                        <input type="radio" id="star3" name="rating" value="3"/><label for="star3"
                                                                                       title="Meh">3
                            stars</label>
                        <input type="radio" id="star2" name="rating" value="2"/><label for="star2"
                                                                                       title="Kinda bad">2
                            stars</label>
                        <input type="radio" id="star1" name="rating" value="1"/><label for="star1"
                                                                                       title="Sucks big time">1
                            star</label>
                    </fieldset>
                </div>
            </td>
            <td>
                Date
            </td>

            <td>
                <div class="container-feedback-comment">
                    Reque libris definitionem ne his, solum interesset ea sea. Eu mel enim movet
                    munere. Detracto rationibus instructior his an, ludus malorum docendi an ius.
                    Sadipscing vituperatoribus ei sea, id vix volutpat efficiendi. Eu qui omnes
                    quando accusata, habeo viderer ea duo, brute instructior per ad. Illud exerci at
                    duo, ne z
                </div>
            </td>
        </tr>


        <tr>
            <td>
                <a href="#"><img src="img/user-interface.svg" title="Insert title" class="feedback-table"></a>
            </td>
            <td>
                <a href="#"><h6>Item name</h6></a>
            </td>
            <td>
                <div class="feedback-result-star" data-steps="2">
                    <fieldset class="rating feedback-star-rating">
                        <input type="radio" id="star5" name="rating" value="5"/><label for="star5"
                                                                                       title="Rocks!">5
                            stars</label>
                        <input type="radio" id="star4" name="rating" value="4"/><label for="star4"
                                                                                       title="Pretty good">4
                            stars</label>
                        <input type="radio" id="star3" name="rating" value="3"/><label for="star3"
                                                                                       title="Meh">3
                            stars</label>
                        <input type="radio" id="star2" name="rating" value="2"/><label for="star2"
                                                                                       title="Kinda bad">2
                            stars</label>
                        <input type="radio" id="star1" name="rating" value="1"/><label for="star1"
                                                                                       title="Sucks big time">1
                            star</label>
                    </fieldset>
                </div>
            </td>
            <td>
                Date
            </td>

            <td>
                <div class="container-feedback-comment">
                    Reque libris definitionem ne his, solum interesset ea sea. Eu mel enim movet
                    munere. Detracto rationibus instructior his an, ludus malorum docendi an ius.
                    Sadipscing vituperatoribus ei sea, id vix volutpat efficiendi. Eu qui omnes
                    quando accusata, habeo viderer ea duo, brute instructior per ad. Illud exerci at
                    duo, ne z
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>


<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="js/vendor/jquery.min.js"></script>

<!-- Includes the Boostrap JavaScript plugins) -->
<script src="js/vendor/bootstrap.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="js/vendor/video.js"></script>
<script src="js/flat-ui-pro.js"></script>
<!--<script src="css/glyphicons/js/bootstrap.min.js"></script>-->



</body>
</html>


