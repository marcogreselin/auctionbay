<?php
// Cookies
setcookie("test", 45, time() + 60 * 60 * 24 * 7);

define("buyer", 1);
define("seller", 2);
?>


<?php
require_once('../includes/dbconnection.php');
require_once("../includes/session.php");
require_once('../includes/navigation.php');
require_once('../includes/form_processing.php');

$userId = $_GET['user_id'];
$auctionId = $_GET['auction_id'];

$feedbackMainResult = getFeedbackInformation($userId);

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
<!-- /* For querying the data and showing the result from the database and show it on the screen */-->
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


    <?php
        $feedback = mysqli_fetch_assoc($feedbackMainResult);
        ?>

    <h1>Feedback for <?php echo $feedback["firstName"]; ?></h1>
    <h4>User type: <?php echo $feedback["role"]; ?></h4>



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
        <?php
        while($feedback = mysqli_fetch_assoc($feedbackMainResult)) {
                $output1 = "<tr>
            <td>               <a href=\"#\"><img src=\"img/user-interface.svg\" title=\"Insert title\" class=\"feedback-table\"></a>
                </td>
            <td>
            <div class=\"container-feedback-item-title\">
                <a href=\"#\"><h7>{$feedback['title']}</h7></a>
                </div>
            </td>
            <td>
            <div class=\"feedback-result-rating\">";

            // Get the number of stars fom the database first and pass it into the function called returnStarRating to echo the number of stars accordingly.
            $starNumber = $feedback['stars'];
            $output2 = returnStarRating($starNumber);

            $output3="
            </div>
            </td>
            <td>
                <div class=\"container-feedback-date\">
                    {$feedback['date']}
                </div>
            </td>

            <td>
                <div class=\"container-feedback-comment\">
                     {$feedback['comment']}
                </div>
            </td>
                </tr>";


            $output = $output1 . $output2 . $output3;
            echo $output;
            }

            ?>

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