<?php
  require_once("../includes/session.php");
  require_once("../includes/navigation.php");
  require_once("../includes/form_processing.php");
  require_once("../includes/dbconnection.php");
  if(is_buyer()) {
      include("../includes/layouts/header.php");
    } else {
      redirect_to("index.php");
    }
?>

<div class="container">
  <h1>My Account</h1>
  <p>Welcome to your personal area. Here you can check your personal details as well as monitor auctions you have bid for.</p>

<div class="row">
  <div class="col-md-2 menu-margin">
    <ul class="nav nav-list">
      <li>
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
    <?php
      $auction_set_unfiltered = retrieve_buyer_auctions();
      $auction_set = filter_non_expired_auctions($auction_set_unfiltered);
      $auction_set = filter_auctions_not_won($auction_set);

      if($auction_set) {

        $output = "
        <div class=\"alert alert-warning\" role=\"alert\">

          <button type=\"button\" class=\"close fui-cross\"
              data-dismiss=\"alert\">
          </button>
          <h4>Leave Feedback!</h4>

          <table class=\"table\" id=\"table-account-feedback\">
            <col width=\"200px\">";

        foreach ($auction_set as $auction) {

          $encoded_winner_id  = urlencode($auction['winner_id']);
          $encoded_auction_id = urlencode($auction['auctionId']);
          $imageName      = htmlentities($auction['imageName']);
          $title          = htmlentities($auction['title']);
          $description    = htmlentities($auction['description']);
          $winning_price  = htmlentities($auction['winning_price']);
          $link  = "leave_feedback.php?user_id={$encoded_winner_id}";
          $link .= "&auction_id={$encoded_auction_id}";
          $output .= "<tr>

                      <td><a href=\"{$link}\"><h7>{$title}</h7>
                      <img src=\"img/auctions/{$imageName}\"
                      title=\"{$title}\">
                      </a></td>
                      <td>
                        <strong>Description:</strong><br/>
                        {$auction['description']}
                      </td>
                      <td>
                        <Strong>Bought!</strong><br/>
                        £{$auction['winning_price']}
                      </td>
                    </tr>";
        }

        // <!--  <tr>
        //
        //     <td><a href="leave_feedback.php?user_id=40&auction_id=2"><img src="img/user-interface.svg" title="Insert title">First Row, first column</a></td>
        //     <td>First Row, second column</td>
        //     <td>First Row, third column</td>
        //   </tr> -->

        $output .= "</table></div>";

        echo $output;
      }

     ?>

   <a name="address"><h3>My Details</h3></a>
   <p><b>My Address:</b><br>
   <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "<br>"; ?> <!--Alex Vally<br> -->
   <?php echo $_SESSION['number'] . ", " . $_SESSION['street'] . "<br>"; ?><!--54, Marylebone Street<br>-->
   <?php echo $_SESSION['zip'] . " " . $_SESSION['city'] ."<br/>"; ?><!--W1H 675 London<br>-->
   email: <?php echo " " . $_SESSION['email'] . "<p>"; ?> <!--alex@vally.com</p>-->


  <a name="bids"><h3>My Recent Bids</h3></a>
  <table class="table table-striped">
    <col width="200px">
    <tr>
      <th>Item Name</th>
      <th>Description</th>
      <th>Status</th>
    </tr>
    <?php
    $auction_set = filter_expired_auctions($auction_set_unfiltered);

    foreach ($auction_set as $auction) {
      $imageName      = htmlentities($auction['imageName']);
      $title          = htmlentities($auction['title']);
      $description    = htmlentities($auction['description']);
      $winning_price  = htmlentities($auction['winning_price']);

      if($_SESSION['userId'] == $auction['winner_id'])
        $is_this_buyer = "<br><div id=\"this-you\">This is you!</div>";
      else
        $is_this_buyer = "
        <br><div id=\"this-you\">Your bid is not the winning bid!</div>";

      $link = "auction.php?auctionId=" . urlencode($auction['auctionId']);
      $output = "
      <tr>
        <td><a href=\"{$link}\"><h7>{$title}</h7>
        <img src=\"img/auctions/{$imageName}\"
        title=\"{$title}\">
        </a></td>
        <td>
          <strong>Description:</strong><br/>
          {$description}
        </td>
        <td>
          <Strong>Winning bid:</strong><br/>
          £{$winning_price}
          {$is_this_buyer}
        </td>
      </tr>";

      echo $output;
    }

    ?>
    <!-- <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
    </tr> -->
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
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">First Row, first column</a></td>
      <td>First Row, second column</td>
      <td>First Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Second Row, first column</a></td>
      <td>Second Row, second column</td>
      <td>Second Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
  </table>
</div>
</div>

<?php
  include("../includes/layouts/footer.php");
?>
