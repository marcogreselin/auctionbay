<?php
  include("../includes/layouts/header.php");
  require_once("../includes/form_processing.php");
  require_once("../includes/dbconnection.php");
    addVisit($_GET["auctionId"]);

  $auctionData = queryAuctionData($_GET["auctionId"]);




  if(isset($_POST["favoriteButton"])){
  	favoriteAuction();
  }

  if(isset($_POST["unfavoriteButton"])){
  	unfavoriteAuction();
  }

  $isFavorite = isFavorite();

  if(isset($_POST["bidButton"])){
  	bid($auctionData);
    $auctionData = queryAuctionData($_GET["auctionId"]);
  }


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
			  echo "Follow!";
			  echo "</button>";
			} else {
			  echo '<button class="btn btn-hg btn-primary" name="unfavoriteButton">';
			  echo "Unfollow";
			  echo "</button>";
			}

			?>
			</p>
			<p>
				<div class="auction-price">Current Price:<br>&pound;<?php echo $auctionData["price"] ?>
				<?php 
					if($_SESSION["userId"]==$auctionData["currentWinner"]){
						echo '<br><div id="this-you">This is you!</div>';
					
					} 
				?>
				</div>
			</p>

			<p><div class="form-group">
			  <div class="input-group">
			    <span class="input-group-addon">&pound;</span>
			    <input type="text" class="form-control" method="POST" name="newBidAmount" placeholder="" />
			  </div>  
			</div></p>
			<p class="text-center"><button class="btn btn-hg btn-primary" name="bidButton">
			  Bid!
			</button></p>
		</div>
		<div class="col-md-9">
		<img class="auction_img" src="img/auctions/<?php echo $auctionData["imageName"]?>">

		</div>
	</form>
	</div>
	<p>
		<div>

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" id="admin-tab" role="tablist">
		    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
		    <?php
		    if($_SESSION["userId"]==$auctionData["seller"]){
		    	echo '<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Admin</a></li>';
		    }
		    ?>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="home"><?php echo $auctionData["description"] ?></div>
		    <?php
		    if($_SESSION["userId"]==$auctionData["seller"]){
		    	echo '<div role="tabpanel" class="tab-pane" id="profile">Views: '. $auctionData["views"] .'</div>';
		    }
		    ?>
		    
		  </div>

		</div>
	</p>
</div>
<?php
  include("../includes/layouts/footer.php");
?>