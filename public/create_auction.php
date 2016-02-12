<?php
  include("../includes/layouts/header_buyer.php");
?>

<div class="container">
	<h1>Create an Auction</h1>

	<p><input type="text" class="form-control input-hg auction-form" placeholder="Enter the Title" /></p>
	<p><textarea class="form-control" rows="15" id="comment" placeholder="Enter the Body"></textarea></p>
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
			        <input type="file" name="...">
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
			    <input type="text" class="form-control" value="14 March, 2015" id="datepicker-01" />
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
		    <input type="text" class="form-control" placeholder="" />
		  </div>  
		</div>
		</div>

		<div class="col-md-6">
		<p>Enter your <b>reserve</b> price:</p>
		<div class="form-group">
		  <div class="input-group">
		    <span class="input-group-addon">&pound;</span>
		    <input type="text" class="form-control" placeholder="" />
		  </div>  
		</div>
		</div>
	</div>
	<p>

	<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Select a Category
    <span class="caret"></span>
  </button>
 <ul class="dropdown-menu">
		  <li>
		    <a href="#">Cat I</a>
		  </li>
		  <li>
		    <a href="#">Cat II</a>
		  </li>
		  <li>
		    <a href="#">Cat III</a>
		  </li>
		  <li>
		    <a href="#">Cat IV</a>
		  </li>
		  <li>
		    <a href="#">Cat V</a>
		  </li>
		</ul>
</div>
		<i class="dropdown-arrow"></i>
		
	</p>
	<button onclick="location.href='index.php'" class="btn btn-hg btn-primary create-button">
	  Create Auction
	</button>
	<span class="countdown"></span>
</div>





<?php
  include("../includes/layouts/footer.php");
?>