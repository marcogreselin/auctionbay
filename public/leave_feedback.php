<?php
setcookie("test", 45, time() + 60 * 60 * 24 * 7);
require_once('../includes/dbconnection.php');
require_once('../includes/session.php');
require_once('../includes/navigation.php');
require_once('../includes/form_processing.php');
require_once('../includes/validation_functions.php');
require_once('../includes/output.php');
require_once('../includes/layouts/header.php');
$user_id = $_GET['user_id'];
$auction_id = $_GET['auction_id'];
$auctionFeedbackDetails = getAuctionForFeedback($auction_id);
if (isset($_SESSION['errors']))
    $errors = $_SESSION['errors'];
?>

<div class="container">
    <p>
        <?php
        if (isset($_POST["submitFeedback"])) {
            process_feedback_form($user_id, $auction_id);
            if (isset($errors) && !empty($errors)) {
                echo
                "<div class=\"alert alert-danger\">
                          <button class=\"close fui-cross\" data-dismiss=\"alert\"></button>
                          <h4>Oops!</h4>";
                output_errors();
                echo "</div>";
                clear_errors();
            }
        }
        ?>
    </p>

    <h1>Leave Feedback for: <?php echo searchFeedbackUser($user_id) ?></h1>
    <div class="jumbotron">
        <form class="feedback-form"
              action="leave_feedback.php?user_id=<?php echo $user_id ?>&auction_id=<?php echo $auction_id ?>"
              method="post">
            <div class="form-group form-group-lg">
                <div class="row">
                    <div class="col-sm-6 leave-feedback-item-container">
                        <p><h4><?php echo $auctionFeedbackDetails["title"] ?></h4></p>
                        <a href="#"><img class="feedback_img"
                                         src="img/auctions/<?php echo $auctionFeedbackDetails["imageName"] ?>"
                                         title="Insert title" class="leave-feedback-image"></a>
                    </div>

                    <div class="col-sm-6">
                        <div class="feedback-star-rating" data-steps="2">
                            <fieldset class="rating rating-leave-feedback">
                                <input type="radio" id="star5" name="stars" value="5"/><label for="star5" title="Rocks!">5 stars</label>
                                <input type="radio" id="star4" name="stars" value="4"/><label for="star4" title="Pretty good">4 stars</label>
                                <input type="radio" id="star3" name="stars" value="3"/><label for="star3" title="Meh">3 stars</label>
                                <input type="radio" id="star2" name="stars" value="2"/><label for="star2" title="Kinda bad">2 stars</label>
                                <input type="radio" id="star1" name="stars" value="1"/><label for="star1" title="Sucks big time">1 star</label>
                            </fieldset>
                        </div>
                    </div>


                    <div class="input-comment">
                        <input class="form-control input-comment-title" id="input-comment-title" name="title"
                               placeholder="Please give a title"
                               maxlength="140">
                    </div>

                <textarea class="form-control textarea-comment" id="textarea-comment" name="comment"
                          placeholder="What do you think?"
                          maxlength="500"></textarea>
                    <div id="textarea-characters-remaining"></div>
                    <input class="btn-submit-comment btn-hg btn-primary btn-block"
                           type="submit" name="submitFeedback" value="Submit your feedback">
                    <input class="previous-auctionId" type="hidden" name="auction_id"
                           value="<?= htmlentities($_GET['auction_id']) ?>"/>
                    <input class="previous-userId" type="hidden" name="user_id"
                           value="<?= htmlentities($_GET['user_id']) ?>"/>
                </div>
        </form>
    </div>
</div>

<?php
include("../includes/layouts/footer.php");
?>
