<?php
require_once("../includes/form_processing.php");
require_once("../includes/queries.php");
require_once("../includes/dbconnection.php");
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
  isset($_POST['auctionSet']) && isset($_POST['tokenChanged'])) {

  //initialize to empty array
  $auction_set = array();

  /*   Eventually, the token search field should work asynchronously too */
  if($_POST['tokenChanged']) {
    //process search form
    $search_token = trim($_POST['token']);//process_search_form();//uses GET from inside the body
    //if processed search token is not empty
    if($search_token) {
      //query database and modify result set with further queries
      $auction_set = (query_select_auction_search($search_token));
      //extract this for loop TODO (used both here and results.php)
      for($i = 0; $i < sizeof($auction_set); $i++) {
        //enrich with price
        $current_price = get_price($auction_set[$i]['auctionId'],
        $auction_set[$i]['startingPrice']);
        $auction_set[$i]['currentPrice'] = $current_price;
        //once the current price is known, there is no further need for a
        //startingPrice field on the retrieved associative array
        unset($auction_set[$i]['startingPrice']);

        //enrich with rating
        $feedback_array = query_select_user_rating($auction_set[$i]['seller']);
        $auction_set[$i]['stars']         = $feedback_array['stars'];
        $auction_set[$i]['no_of_ratings'] = $feedback_array['occurrences'];
      }
      //print_r($auction_set);
      //encode result in json format
      //this is useless here//  $json_encoded_auction_set = json_encode($auction_set);
    }
  } else {
    $auction_set = $_POST['auctionSet'];
  }

  $auction_set = process_filter_form($auction_set,
                                    ($_POST['bottom']),
                                    ($_POST['top']),
                                    ($_POST['rating']),
                                    ($_POST['category']));


//begin constructing auction set display table, id value used by
//jQuery to replace construct with ajax request response
//begin constructing table
$output = "
<table class=\"search-page-table table-striped\" id=\"results\">
    <col width=\"200px\">
    <col width=\"800px\">";
  //if (filtered if requested) result set is not empty:
  if($auction_set) {

    foreach ($auction_set as $auction) {
      $imageName      = htmlentities($auction['imageName']);
      $title          = htmlentities($auction['title']);
      $auctionId      = htmlentities($auction['auctionId']);
      $currentPrice   = htmlentities($auction['currentPrice']);
      $description    = htmlentities($auction['description']);
      $rating_string  = "The seller has not yet been rated<br/>";

      if($auction['no_of_ratings'] > 0) {
        $rating         = htmlentities($auction['stars']);
        $no_of_ratings  = htmlentities($auction['no_of_ratings']);

        $rating_string = "Rating: {$rating} stars<br/>
                  Based on {$no_of_ratings} ratings<br/>";
      }

      $output .= "
      <tr>
        <td>
            <a href=\"auction.php?auctionId={$auctionId}\">
            <img src=\"img/auctions/{$imageName}\"
                            title=\"{$title}\"
                            class=\"search-result-table\"></a>
        </td>
        <td>
            <div class=\"row\">
                <ul class=\"search-result-list\">
                    <li>
                        <div class=\"col-sm-6\">
                            <a href=\"
                              auction.php?auctionId={$auctionId}\">

                            <h6 class=\"jqAuctionTitle\">
                            {$title}</h6>
                            </a>
                        </div>
                        <div class=\"col-sm-6\">
                            <div><h6 class=\"jqAuctionPrice\">
                            Current Price:
                              £{$currentPrice}</h6>
                              </div>
                              <div>
                              {$rating_string}
                              </div>
                        </div>
                    </li>
                    <li>
                        <div class=\"container-item-description\"
                        style=\"width: 50em; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;\">
                            {$description}
                        </div>
                    </li>

                </ul>
        </td>
    </tr>";

    }
  } else {
      $output .= "<tr></tr><tr><td></td><td><h2>No results</h2></td></tr>";
  }
  //always close div before echo
  $output .= "</table>";
  echo $output;
} else {
  $errorMessage  = "Bad request: missing required POST parameters:<br/>";
  die($errorMessage);
}

 ?>
