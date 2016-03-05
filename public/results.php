<?php
//Dependencies
require_once("../includes/navigation.php");
require_once("../includes/session.php");
require_once("../includes/dbconnection.php");
require_once("../includes/queries.php");
require_once("../includes/form_processing.php");


if(!is_buyer() && !is_seller()) {
  redirect_to("index.php");
}

if(isset($_POST) && !empty($_POST)) {
  if(!isset($_POST['stars']))
    $_POST['stars'] = -1;
}

if(isset($_GET['token'])) {
  //process search form
  $search_token = process_search_form();
  //if processed search token is not empty
  if($search_token) {

    //query database and modify result set with further queries
    $auction_set = (query_select_auction_search($search_token));
    for($i = 0; $i < sizeof($auction_set); $i++) {
      $current_price = get_price($auction_set[$i]['auctionId'],
                                  $auction_set[$i]['startingPrice']);

      $auction_set[$i]['currentPrice'] = $current_price;


      // $auction_set[$i]['rating'] = 4;
      //TODO: this happens with every new get request, with a fresh query
      //for the token being made on the database, whereas no new query should
      //occurr for filtering purposes
      $feedback_array = query_select_user_rating($auction_set[$i]['seller']);

      $auction_set[$i]['stars']         = $feedback_array['stars'];
      $auction_set[$i]['no_of_ratings'] = $feedback_array['occurrences'];

      //once the current price is known, there is no further need for a
      //startingPrice field on the retrieved associative array
      unset($auction_set[$i]['startingPrice']);
    }
    //print_r($auction_set);
  }
} else {
  redirect_to("search.php");
}

//process filtering if set as part of the get request, this modifies the
//auction_set
if(isset($_GET['bottom']) && isset($_GET['top']) &&
  isset($_GET['rating']) && isset($_GET['category'])) {
  $auction_set = process_filter_form($auction_set,
                                    urldecode($_GET['bottom']),
                                    urldecode($_GET['top']),
                                    urldecode($_GET['rating']),
                                    urldecode($_GET['category']));

}


include("../includes/layouts/header.php");
?>



<div class="container-search-page" id="wrapper">

  <div class="search-page-header"><h5>Show results for <?php
                                            if(isset($_GET['token']))
                                            { echo urldecode($_GET['token']); }
                                                    ?></h5></div>
  <div class="row">
    <div class="col-sm-3">
      <div class="search-side-panel" style="margin-top: 30px;">
        <!-- php-based GET form submission, used jQuery instead because of front
        end components. :NT
          <form class="" action="results.php?" method="get"> -->
          <ul class="nav nav-list divider-vertical">
            <li class="nav-header">
              <input class="form-control input-hg" type="text"
              name="token" id="token" value="<?php
                                          if(isset($_GET['token']))
                                            { echo urldecode($_GET['token']); }
                                                    ?>">
            </li>
            <li class="divider"></li>
            <li class="nav-header" id="cat-list"><select
              class="category-select form-control select select-primary select-sm mbl">
              <option value="">Category...</option>
              <?php
                $catArray = queryCatArray();
                while($row = mysqli_fetch_assoc($catArray)){

                  echo "<option value=\"";
                  echo $row["categoryId"];
                  echo "\">";
                  echo $row["name"];
                  echo "</option>";

                }
                ?>
            </select></li>
            <!--  subcategories commented out
            <li class="list-subcategory">
              <a href="#fakelink">
                Computing & Internet
              </a>
            </li>

            <li class="list-subcategory">
              <a href="#fakelink">
                UML Programming
              </a>
            </li>

            <li class="list-subcategory">
              <a href="#fakelink">
                Design Pattern Programming
              </a>
            </li>

            <li class="list-subcategory">
              <a href="#fakelink">
                Programming Languages & Tools
              </a>
            </li>

            <li class="list-subcategory">
              <a href="#fakelink">
                Computing & Internet Programming
              </a>
            </li>

            <li class="list-subcategory">
              <a href="#fakelink">
                Design Pattern Programming
              </a>
            </li>
          -->
            <li class="divider"></li>

            <li class="nav-header">Price</li>
            <div id="slider3">
              <span class="ui-slider-value first"></span>
              <span class="ui-slider-value last"></span>
            </div>
          </li>
          <li class="divider"></li>
          <li class="nav-header">Avg. Customer Reviews</li>
        </ul>

        <div class="star-ctr center" data-steps="2">
          <fieldset class="rating rating-search-result">
            <input class="jqSelectRating" type="radio" id="star5" name="rating"
            value="5"/><label for="star5" title="Rocks!">5
              stars</label>
              <input class="jqSelectRating" type="radio" id="star4" name="rating"
              value="4"/><label for="star4"
              title="Pretty good">4
              stars</label>
              <input class="jqSelectRating" type="radio" id="star3" name="rating"
              value="3"/><label for="star3" title="Meh">3
                stars</label>
                <input class="jqSelectRating" type="radio" id="star2" name="rating"
                value="2"/><label for="star2"
                title="Kinda bad">2
                stars</label>
                <input class="jqSelectRating" type="radio" id="star1" name="rating"
                value="1"/><label for="star1"
                title="Awful">1
                star</label>
              </fieldset>
              <!-- <div class="col-sm-8 col-sm-offset-2"> -->
                <div class="text-center">
                <input class="btn-filter btn-hg btn-primary btn-wide "
                type="submit" name="btn-filter" value="Filter" onclick="filter();">
              </div>
            </div>
          <!--</form>-->
        </div>
      </div>

            <div class="col-sm-9">
                <table class="search-page-table table-striped">
                    <col width="200px">
                    <col width="800px">

                  <?php

                //if (filtered if requested) result set is not empty:
                if($auction_set) {

                  foreach ($auction_set as $auction) {
                    $imageName      = htmlentities($auction['imageName']);
                    $title          = htmlentities($auction['title']);
                    $auctionId      = htmlentities($auction['auctionId']);
                    $currentPrice   = htmlentities($auction['currentPrice']);
                    $description    = htmlentities($auction['description']);
                    $rating_string  = "";
                    if($auction['no_of_ratings'] > 0) {
                      $rating         = htmlentities($auction['stars']);
                      $no_of_ratings  = htmlentities($auction['no_of_ratings']);

                      $rating = "Rating:{$rating}<br/>
                                Based on {$no_of_ratings} ratings<br/>";
                    }

                    $output = "
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
                                            {$rating_string} </div>
                                      </div>
                                  </li>
                                  <li>
                                      <div class=\"container-item-description\">
                                          {$description}
                                      </div>
                                  </li>

                              </ul>
                      </td>
                  </tr>";

                  echo $output;
                  }
                } //else {
                //     redirect_to("search.php");
                // }
                  ?>

                      <!--
                      <tr>
                        <td>
                            <a href="#"><img src="img/user-interface.svg" title="Insert title"
                                             class="search-result-table"></a>
                        </td>
                        <td>
                            <div class="row">
                                <ul class="search-result-list">
                                    <li>
                                        <div class="col-sm-6">
                                            <a href="#"><h6>Item name</h6></a>
                                        </div>
                                        <div class="col-sm-6">
                                            <div><h6>Price</h6></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="container-item-description">
                                            Reque libris definitionem ne his, solum interesset ea sea. Eu mel enim
                                            movet
                                            munere. Detracto rationibus instructior his an, ludus malorum docendi an
                                            ius.
                                            Sadipscing vituperatoribus ei sea, id vix volutpat efficiendi. Eu qui
                                            omnes
                                            quando accusata, habeo viderer ea duo, brute instructior per ad. Illud
                                            exerci at
                                            duo, ne z
                                        </div>
                                    </li>
                                    <li>
                                        <div class="container-item-description">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input class="btn-bid btn-lg btn-primary btn-wide" type="submit"
                                                           name="btn-bid" value="Bid">
                                                </div>

                                                <div class="col-sm-6">
                                                    <input class="btn-follow btn-lg btn-primary btn-wide"
                                                           type="submit"
                                                           name="btn-follow" value="Follow">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                        </td>
                    </tr>-->

                </table>
                </div>
        </div>
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


<script type="text/javascript">
    // Price slider rating
    var $slider3 = $("#slider3")
        , slider3ValueMultiplier = 1
        , slider3Options;

    if ($slider3.length > 0) {
        $slider3.slider({
            min: 1,
            max: 1000,
            values: [1, 1000],
            orientation: "horizontal",
            range: true,
            slide: function (event, ui) {
                $slider3.find(".ui-slider-value:first")
                    .text("£" + ui.values[0] * slider3ValueMultiplier)
                    .end()
                    .find(".ui-slider-value:last")
                    .text("£" + ui.values[1] * slider3ValueMultiplier);
            }
        });

        slider3Options = $slider3.slider("option");
        $slider3.addSliderSegments(slider3Options.max)
            .find(".ui-slider-value:first")
            .text("$" + slider3Options.values[0] * slider3ValueMultiplier)
            .end()
            .find(".ui-slider-value:last")
            .text("$" + slider3Options.values[1] * slider3ValueMultiplier);
    }
</script>

<!-- Select-two javascript for getting the select to work -->
<script type="text/javascript">
    $('select').select2();
</script>

<!-- Still yet to implement-->
<script type="text/javascript">
    $(document).ready(function () {
        var s = $("#sticker");
        var pos = s.position();
        $(window).scroll(function () {
            var windowpos = $(window).scrollTop();
            if (windowpos >= pos.top) {
                s.addClass("stick");
            } else {
                s.removeClass("stick");
            }
        });
    });
</script>
<script type="text/javascript">
  /*adds click listener to stars to change their class, so that their value can
  * later be retrieved to be used as GET data*/
  $('.jqSelectRating').click(function handler () {
    $('.jqSelectedRatingChoice').attr('class', 'jqSelectRating');
    $(this).attr('class', 'jqSelectedRatingChoice');
  });
</script>

<script type="text/javascript">
function filter() {
  var rating, price, token, category;

  if($('.jqSelectedRatingChoice').length == 0)
  rating = -1;
  else
  rating = $('.jqSelectedRatingChoice').val();

  price = $( "#slider3" ).slider( "values" );
  token = $('#token').val();


  category = $( '.category-select' ).find('option:selected').val();

  /*//debug:
  alert("Rating: " + rating + "\n" +
  "Slider bottom: " + price[0] + "\n" +
  "Slider top: " + price[1] + "\n" +
  "Token: " + token);*/


  var reload_url = "results.php?";
  reload_url +="token=" + token;
  reload_url += "&bottom=" + price[0];
  reload_url += "&top=" + price[1];
  reload_url += "&rating=" + rating;
  reload_url += "&category=" + category;

  window.location = reload_url;

  /*a better solution would be to send some request to the server (to some
  * generate_auction_list.php page for example), which is also responsible for the
  * generation of the html code that displays the auctions resulting from the
  * search, this page could use the data in the $_GET or $_POST superglobal to
  * filter the results of the initial query: if the token does not change, then
  * this page should receive a record of the items resulting from the database
  * query (stored perhaps in the $_SESSION), and then selectively filter this data
  * without further database queries. This request could also be carried out
  * asynchronously (ajax), the JQuery in this page could use the html response
  * from generate_auction_list.php to manipulate the DOM and substitute the
  * initial search results with the filtered results it received. This would make
  * for a better user experience as it would not require a page refresh, and since
  * the page would not have been refreshed, the user would still see their
  * selection in terms of stars rating and price without these having to be set
  * through php or JS logic after the reload. :NT*/
  //   $.ajax({
  //    type:'GET',
  //    url:'generate_auction_list.php',
  //    data: {
  //      rating: rating,
  //      bottom: price[0],
  //      top: price[1],
  //      token: token
  //    },
  //    success: function (jqXHR, statusText) {
  //      console.log(status);
  //      console.log(jqXHR);
  //    }
  //  });
}
</script>
</body>
</html>
