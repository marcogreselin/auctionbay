<?php
setcookie("test", 45, time() + 60 * 60 * 24 * 7);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search Page</title>
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


<div class="container-search-page" id="wrapper">
    <div class="row">
    <div id="sticker">
    <div class="search-page-header"><h5>Show results for</h5></div>

        <div class="col-sm-3">
            <div class="search-side-panel">
                <ul class="nav nav-list divider-vertical">
                    <li class="nav-header"><select
                            class="category-select form-control select select-primary select-sm mbl">
                            <option value="">Category...</option>
                            <option value="BOK">Book</option>
                            <option value="FAS">Fashion</option>
                            <option value="FOO">Food</option>
                            <option value="FUR">Furniture</option>
                            <option value="ACS">Accessories</option>
                        </select></li>

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

                <?php
                /*
                FIXME: The dependency for the stars will affect the css for the general themes
                */
                ?>

                <div class="star-ctr center" data-steps="2">

                    <a href="#">
                        <ul>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                        </ul>
                    </a>


                    <a href="#">
                        <ul>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                        </ul>
                    </a>


                    <a href="#">
                        <ul>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                        </ul>
                    </a>


                    <a href="#">
                        <ul>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                        </ul>
                    </a>


                    <a href="#">
                        <ul>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-active"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                            <li><span class="glyphicon glyphicon-star glyphicon-star-inactive"></span></li>
                        </ul>
                    </a>

                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <input class="btn-filter btn-hg btn-primary btn-wide" type="submit" name="btn-filter" value="Filter">
                    </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="mainContent col-sm-9">
            <table class="search-page-table table-striped">
                <col width="200px">
                <col width="auto">
                <col width="auto">
                <col width="50px">

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a href="#"><img src="img/user-interface.svg" title="Insert title" class="search-result-table"></a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#"><h6>Item name</h6></a>
                            </div>
                            <div class="col-sm-6">
                                <div><h6>Price</h6></div>
                            </div>
                        </div>
                        <div>Item description: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                            ligula eget dolor. Aenean massa. Cum sociis natoqu
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div> <!-- /row -->
</div> <!-- /container -->


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
    $(document).ready(function() {
        var s = $("#sticker");
        var pos = s.position();
        $(window).scroll(function() {
            var windowpos = $(window).scrollTop();
            if (windowpos >= pos.top) {
                s.addClass("stick");
            } else {
                s.removeClass("stick");
            }
        });
    });
</script>


</body>
</html>
