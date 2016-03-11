<?php
  require_once("../includes/session.php");
  require_once("../includes/navigation.php");
  require_once("../includes/dbconnection.php");
  if(is_seller()) {
      include("../includes/layouts/header.php");
    } else {
      redirect_to("index.php");
    }

  $userId = $_SESSION['userId'];

?>

<div class="container">
  <h1>My Account</h1>
  <p>Welcome to your personal area. Here you can check your personal details as well as monitor your auctions.</p>

<div class="row">
  <div class="col-md-2 menu-margin">
    <ul class="nav nav-list">
      <li>
        <a href="#address">
          Address
        </a>
      </li>

      <li>
        <a href="#auctions">
          Auctions
        </a>
      </li>


      <li>
        <a href="#sold-auctions">
          Sold
        </a>
      </li>

    </ul>
  </div>
  <div class="col-md-10">
      <?php
        $auction_set_unfiltered = retrieve_seller_auctions();
        $auction_set = filter_auctions_without_bids($auction_set_unfiltered);
        $auction_set = filter_non_expired_auctions($auction_set);
        $auction_set = filter_auctions_already_rated($auction_set, $_SESSION['role']);

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

            $encoded_winner_id  = urlencode(htmlentities($auction['winner_id']));
            $encoded_auction_id = urlencode(htmlentities($auction['auctionId']));
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
                          <Strong>Sold!</strong><br/>
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
<!--Maybe add an "edit" button here, would require another query to user table-->
  <a name="address"><h3>My Details</h3></a>
  <p><b>My Address:</b><br>
  <?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "<br>"; ?> <!--Alex Vally<br> -->
  <?php echo $_SESSION['number'] . ", " . $_SESSION['street'] . "<br>"; ?><!--54, Marylebone Street<br>-->
  <?php echo $_SESSION['zip'] . " " . $_SESSION['city'] ."<br/>"; ?><!--W1H 675 London<br>-->
  email: <?php echo " " . $_SESSION['email'] . "</p>"; ?> <!--alex@vally.com</p>-->




    <!-- Only displays the My Recent Auctions table when there is really data in the table -->
    <?php
    $auction_set = filter_expired_auctions($auction_set_unfiltered);

    $output1 = "
      <a name=\"auctions\"><h3>My Recent Auctions</h3></a>
  <table class=\"table table-striped\">
    <col width=\"200px\">
    <tr>
      <th>Item Name</th>
      <th>Description</th>
      <th>Current Price</th>
    </tr>
      ";

    if ($auction_set) {
      echo $output1;

      foreach ($auction_set as $auction) {
        $imageName = htmlentities($auction['imageName']);
        $title = htmlentities($auction['title']);
        $description = htmlentities($auction['description']);
        $winning_price = htmlentities($auction['winning_price']);
        $link = "auction.php?auctionId=" .
            urlencode(htmlentities($auction['auctionId']));
        $output2 = "
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
          <Strong>Price:</strong><br/>
          £{$winning_price}
        </td>
      </tr>";

        echo $output2;
      }
    } else {
      echo "";
    }
    ?>
    <!-- <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
    </tr> -->
  </table>


    <?php
    $completedAuction = getCompletedAuctionDetailsForSeller($userId);
    if (mysqli_num_rows($completedAuction) !== 0) {
      $output1 = "
         <a name=\"sold-auctions\"><h3>Items Sold</h3></a>
    <table class=\"table table-striped\">
      <col width=\"200px\">
      <col width=\"auto\">
      <col width=\"auto\">
      <tr>
        <th>Auction Item</th>
        <th>Corresponding Buyer</th>
        <th>Final Price</th>
      </tr>
        ";
      echo $output1;

      while ($row = mysqli_fetch_assoc($completedAuction)) {
        $link = "auction.php?auctionId=" . urlencode($row['auction_id']);

        $output2 = "
       <tr>
        <td><a href=\"{$link}\"><div>{$row['title']}</div><img src=\"img/auctions/{$row['imageName']}\" title=\"{$row['title']}\"></a></td>
        <td>{$row['buyerName']}<br><strong>Address:</strong> {$row['buyerAddress']}<br><strong>Email:</strong> {$row['buyeremail']}</td>
        <td>£{$row['finalAmount']}</td>
      </tr>";
        echo $output2;
      }
    } else {
      echo "";
    }
    ?>
      </table>
</div>
</div>
</div>

<?php
  include("../includes/layouts/footer.php");
?>
