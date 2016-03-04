<?php
require_once('../includes/dbconnection.php');
require_once("../includes/session.php");
require_once('../includes/navigation.php');
require_once('../includes/form_processing.php');

// Get the user_id and the auction_id from the screen before
$userId = $_GET['for_user_id'];
$feedbackMainResult = getFeedbackInformation($userId);
?>


<?php
require_once('../includes/layouts/header.php');
?>

<div class="container">


    <?php
        $feedback = mysqli_fetch_assoc($feedbackMainResult);
        ?>

    <h1>Feedback for <?php echo $feedback["firstName"]." ".$feedback["lastName"]; ?></h1>
    <h4>User type: <?php
        if($feedback["role"] == 1) {
            echo "buyer";
        } else {
            echo "seller";
        } ;

        ?></h4>

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
            <th><h4>Feedback</h4></th>
        </tr>
        </thead>

        <tbody>
        <?php

        while($feedback = mysqli_fetch_assoc($feedbackMainResult)) {
                $output1 = "<tr>
            <td>               <a href=\"#\"><img class=\"feedback_img\" src=\"img/auctions/{$feedback['imageName']}\" class=\"feedback-table\"></a>
                </td>
            <td>
            <div class=\"container-feedback-item-title\">
                <h7>{$feedback['title']}</h7>
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

                </div>
            </td>

            <td>
                <div class=\"container-feedback-comment\">`
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