<?php
require_once('../includes/dbconnection.php');
require_once('../includes/session.php');
require_once('../includes/navigation.php');
require_once('../includes/form_processing.php');

// Get the user_id and the auction_id from the screen before
$userId = $_GET['for_user_id'];
$feedbackMainResult = getFeedbackInformation($userId);
$feedbackMainResultForAverageStars = getAverageStarsForUser($userId);
?>


<?php
require_once('../includes/layouts/header.php');
?>

<div class="container">


    <?php
        $feedback = mysqli_fetch_assoc(getFeedbackInformation($userId));
        ?>




        <?php
        if ($feedback['comment'] !== null) {

        $outputIntroduction = "<h1>" . "Feedback for" . " " . "{$feedback["firstName"]}" . " " . "{$feedback["lastName"]}" . " " . "(" . "{$feedbackMainResultForAverageStars["stars"]}" . " stars" . ")" . "</h1>";$outputIntroduction .= "<h4>" . "</h4>";
            echo $outputIntroduction;

            if($feedback["role"] == 1) {
                echo "<h4>" . "User Type:" . " Buyer" . "</h4>";
            } else {
                echo "<h4>" . "User Type:" . " Seller" . "</h4>";
            } ;


            $outputTableHeader = "
 <table class=\"feedback-table table table-striped\">
        <col width=\"300px\">
        <col width=\"200px\">
        <col width=\"200px\">
        <col width=\"400px\">

<thead>
        <tr>
            <th><h4>Auction Item</h4></th>
            <th><h4>Ratings</h4></th>
            <th><h4>Date</h4></th>
            <th><h4>Feedback</h4></th>
        </tr>
        </thead>





        <tbody>";

            echo $outputTableHeader;

            while($row = mysqli_fetch_assoc($feedbackMainResult)) {

                $link = "auction.php?auctionId=" . urlencode($row['auctionId']);

                $output1 = "<tr>
            <td>
            <a href=\"{$link}\"><h6>{$row['auctionTitle']}</h6></a>
            <a href=\"{$link}\"><img class=\"feedback_img\" src=\"img/auctions/{$row['imageName']}\" class=\"feedback-table\"></a>

                </td>


            <td>
            <div class=\"feedback-result-rating\">";

                // Get the number of stars fom the database first and pass it into the function called returnStarRating to echo the number of stars accordingly.
                $starNumber = $row['stars'];
                $output2 = returnStarRating($starNumber);

                $output3="
            </div>
            </td>
            <td>
                <div class=\"container-feedback-date\">
                    {$row['date(date)']}
                </div>
            </td>

            <td id=\"row-for-ul\">
                <ul>
                <li>
                <u>
                    <div class=\"container-feedback-comment-title\">{$row['feedbackTitle']}<div>
                </li>
                </u>

                <li>
                <div class=\"container-feedback-comment\">
                     {$row['comment']}
                </li>
                </ul>
            </td>
                </tr>";


                $output = $output1 . $output2 . $output3;
                echo $output;
            }
        } else {
            echo "<h2>No feedback left for " . "{$feedback['firstName']}" . " " . "{$feedback['lastName']}" . " " . "yet" . "</h2>";
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