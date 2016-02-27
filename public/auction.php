<?php
session_start();
  include("../includes/layouts/header_buyer.php");
  require_once("../includes/form_processing.php");
  require_once("../includes/dbconnection.php");

  $auctionData = queryAuctionData($_GET["auctionId"]);
  addVisit($_GET["auctionId"]);

  if(isset($_POST["favoriteButton"])){
  	favoriteAuction();
  }



?>
<div class="container">
	<h1><?php echo $auctionData["title"] ?></h1>
	<p><h6>Sold by <?php echo $auctionData["firstName"] . " ". $auctionData["lastName"] ?> (<?php echo $auctionData["stars"]?> stars)</h6></p>
	<div class="row">
	<form action="" method="POST">
		<div class="col-md-2 auction-left">
			<p class="text-center"><button class="btn btn-hg btn-warning" name="favoriteButton">
			  Favorite!
			</button></p>
			<p>
				<div class="auction-price">Current Price:<br>&pound;75.6</div>
			</p>

			<p><div class="form-group">
			  <div class="input-group">
			    <span class="input-group-addon">&pound;</span>
			    <input type="text" class="form-control" placeholder="" />
			  </div>  
			</div></p>
			<p class="text-center"><button class="btn btn-hg btn-primary" name="favoriteButton">
			  Bid!
			</button></p>
		</div>
		<div class="col-md-10">
		<img class="auction_img" src="img/auctions/<?php echo $auctionData["imageName"]?>">

		</div>
	</form>
	</div>
	<p><?php echo $auctionData["description"] ?></p>
</div>
<?php
  include("../includes/layouts/footer.php");
?>