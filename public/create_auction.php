<?php
	//  Dependencies
	require_once('../includes/dbconnection.php');
	require_once('../includes/session.php');
	require_once('../includes/navigation.php');
	require_once('../includes/validation_functions.php');
	require_once('../includes/form_processing.php');
	require_once("../includes/output.php");
	if(is_buyer()){
		redirect_to("search.php");
	}
  if(isset($_POST["submitAuction"])){
  	$functionOutput = addAuction();
  	if($functionOutput===true){
  		// from http://www.tutorialspoint.com/php/php_file_uploading.htm
	     if(isset($_FILES['image'])){
		      $errors= array();
		      $file_name = $_FILES['image']['name'];
		      $file_size =$_FILES['image']['size'];
		      $file_tmp =$_FILES['image']['tmp_name'];
		      $file_type=$_FILES['image']['type'];
		      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		      $expensions= array("jpeg","jpg","png");
		      move_uploaded_file($file_tmp,"img/auctions/".$file_name);
	     }
	  	 redirect_to("index.php");
  	} 
  }
  
	include("../includes/layouts/header.php");
?>
<div class="container">
	<h1>Create an Auction</h1>

<?php if(isset($functionOutput)) {
      $output  = "<p>";
      $output .= "<div class=\"alert alert-danger login-box\">";
      $output .= "<button class=\"close fui-cross\" data-dismiss=\"alert\"></button>";
      $output .= "<h4>Something went wrong!</h4>";
      $output .= "<ul>";
      foreach($functionOutput as $value){
      	$output .= "<li>".$value."</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
      $output .= "</p>";

      echo $output;
    }?>
<form action="create_auction.php" method="post" enctype="multipart/form-data">
	<p><input name="title" type="text" class="form-control input-hg auction-form" placeholder="Enter the Title" /></p>
	<p><textarea name="body" class="form-control" rows="15" id="comment" placeholder="Enter the Body"></textarea></p>
	<div class="row">
		<div class="col-md-6">
			<p>Select an image:</p>
			<div class="form-group">
			  <div class="fileinput fileinput-new" data-provides="fileinput">
			    <div class="input-group">
			      <div class="form-control uneditable-input" data-trigger="fileinput">
			        <span class="fui-clip fileinput-exists"></span>
			        <span class="fileinput-filename"></span>
			      </div>
			      <span class="input-group-btn btn-file">
			        <span class="btn btn-default fileinput-new" data-role="select-file">Select file</span>
			        <span class="btn btn-default fileinput-exists" data-role="change"><span class="fui-gear"></span>  Change</span>
			        <input name="image" type="file">
			        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>
			      </span>
			    </div>
			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<p>When should your auction end?</p>
			<div class="form-group">
			  <div class="input-group">
			    <span class="input-group-btn">
			      <button class="btn" type="button"><span class="fui-calendar"></span></button>
			    </span>
			    <input name="endDate" type="text" class="form-control" value="2016-02-24" id="datepicker-01" />
			  </div>
			</div>
		</div>


	</div>
	<div class="row">
		<div class="col-md-6">
		<p>Enter your <b>starting</b> price:</p>
		<div class="form-group">
		  <div class="input-group">
		    <span class="input-group-addon">&pound;</span>
		    <input name="startingPrice" type="text" class="form-control" placeholder="" />
		  </div>
		</div>
		</div>

		<div class="col-md-6">
		<p>Enter your <b>reserve</b> price:</p>
		<div class="form-group">
		  <div class="input-group">
		    <span class="input-group-addon">&pound;</span>
		    <input name="reservePrice" type="text" class="form-control" placeholder="" />
		  </div>
		</div>
		</div>
	</div>

		<div class="row">
		<div class="col-md-6">
  		<p>Category:</p>


  <select class="category-select form-control select select-primary select-sm mbl" id="sel1" name="category">


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

  </select>
  </div>
</div>

	<button name="submitAuction" class="btn btn-hg btn-primary create-button">
	  Create Auction
	</button>

</form>
		<span class="countdown"></span>
</div>





<?php
  include("../includes/layouts/footer.php");
?>