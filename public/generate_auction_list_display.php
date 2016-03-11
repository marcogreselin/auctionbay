<?php
//DEUBG
// foreach ($_GET['auctionSet'] as $json_auction) {
// foreach ($_POST['auctionSet'] as $auction) {
//   echo "<pre>";
//   print_r($auction);
//   echo "</pre>";
// }

//process filtering if set as part of the get request, this modifies the
//auction_set
if(isset($_POST['bottom']) && isset($_POST['top']) &&
  isset($_POST['rating']) && isset($_POST['category']) &&
  isset($_POST['auctionSet'])) {
  $auction_set = process_filter_form(urldecode($_POST['auctionSet']),
                                    urldecode($_POST['bottom']),
                                    urldecode($_POST['top']),
                                    urldecode($_POST['rating']),
                                    urldecode($_POST['category']));

} else {
  die("Bad request: missing required POST parameters");
}

 ?>
