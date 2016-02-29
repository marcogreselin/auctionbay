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

  if(isset($_POST["unfavoriteButton"])){
  	unfavoriteAuction();
  }

  $isFavorite = isFavorite();




?>
<div class="container">
	<h1><?php echo $auctionData["title"] ?></h1>
	<p><h6 id="stars-price">Sold by <?php echo $auctionData["firstName"] . " ". $auctionData["lastName"] ?> (<?php echo $auctionData["stars"]?> stars)</h6>
	<h7>Time remaining: <?php 
		$dateInterval=timeRemaining($auctionData["expirationDate"]);
		echo $dateInterval->days." days";
	?></h7>
	</p>

	<div class="row">
	<form action="" method="POST">
		<div class="col-md-3 auction-left">
			<p class="text-center">
			<?php if(!$isFavorite){
			  echo '<button class="btn btn-hg btn-warning" name="favoriteButton">';
			  echo "Favorite!";
			  echo "</button>";
			} else {
			  echo '<button class="btn btn-hg btn-primary" name="unfavoriteButton">';
			  echo "Unfollow";
			  echo "</button>";
			}

			?>
			</p>
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
		<div class="col-md-9">
		<img class="auction_img" src="img/auctions/<?php echo $auctionData["imageName"]?>">

		</div>
	</form>
	</div>
	<p><?php echo $auctionData["description"] ?></p>
</div>
<?php
  include("../includes/layouts/footer.php");
?>