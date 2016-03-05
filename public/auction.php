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
    $bidders = bidderList();

?>


<div class="container">
<div class="rating2"></div>
	<h1><?php echo $auctionData["title"] ?></h1>
	<p><h6 id="stars-price">Sold by <?php echo "<a href=\"feedback.php?for_user_id={$auctionData['seller']}&auctionId={$auctionData['auctionId']}\">" . $auctionData["firstName"] . " ". $auctionData["lastName"] . "</a>" ?> (<?php echo $auctionData["stars"]?> stars)</h6>
	<h7>Time remaining: <?php 
		$dateInterval=timeRemaining($auctionData["expirationDate"]);
		if($dateInterval==false){
			echo '<span style="color:#ec7063"> Expired!</span>';
		} else {
			echo $dateInterval->days." days";
		}
	?></h7>
	</p>

	<div class="row">
	<form action="" method="POST">
		<div class="col-md-3 middle">
			<div >

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
				<div class="auction-price"><?php if ($dateInterval==false) {
					echo 'Final Price:';
				} else {
					echo 'Current Price';
				}
					?><br>&pound;<?php echo $auctionData["price"] ?>
				<?php 
					if($_SESSION["userId"]==$auctionData["currentWinner"]){
						echo '<br><div id="this-you">This is you!</div>';
					
					} 
				?>
				</div>
			</p>

			<?php 
				$biddingInterface = '<p><div class="form-group">
			  <div class="input-group">
			    <span class="input-group-addon">&pound;</span>
			    <input type="text" class="form-control" method="POST" name="newBidAmount" placeholder="" />
			  </div>  
			</div></p>
			<p class="text-center"><button class="btn btn-hg btn-primary" name="bidButton">
			  Bid!
			</button></p>';
				if(is_buyer() && $dateInterval!=false)
					echo $biddingInterface;
			?>
			</div>
		</div>
		<div class="col-md-9 middle">
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
		    if(is_buyer())
		    	$tabName = 'Previous Bids';
		    else
		    	$tabName = 'Admin';
		    if($_SESSION["userId"]==$auctionData["seller"] || is_buyer()){
		    	echo '<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">'.$tabName.'</a></li>';
		    }
		    ?>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="home"><?php echo $auctionData["description"] ?></div>
		    <?php

		    if($_SESSION["userId"]==$auctionData["seller"] || is_buyer()){
		    	echo '<div role="tabpanel" class="tab-pane" id="profile">';
		    	if($_SESSION["userId"]==$auctionData["seller"]){
		    		echo '<p>Views: '. $auctionData["views"].'</p>';
				}

		    	if(mysqli_num_rows($bidders)>0){
		    		echo '<table class="table table-striped">
						    <col width="200px">
						    <tr>
						      <th>Bidder</th>
						      <th>Date</th>
						      <th>Amount</th>
						    </tr>';
		    		while($row = mysqli_fetch_array($bidders)){
		    			echo "<tr><td>{$row['bidder']}</td>";
		    			echo "<td>{$row['date']}</td>";
		    			echo "<td>{$row['bidAmount']}</td></tr>";
		    		}
		    		echo '</table>';
		    	} else {
		    		echo 'No bids yet!';
		    	}
		    	echo '</div>';
		    }

		    ?>
		    
		  </div>

		</div>
	</p>
</div>
<?php
  include("../includes/layouts/footer.php");
?>