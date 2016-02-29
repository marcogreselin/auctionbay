<?php
  require_once("../includes/session.php");
  require_once("../includes/navigation.php");
  if(is_seller()) {
      include("../includes/layouts/header.php");
    } else {
      redirect_to("index.php");
    }
?>

<div class="container">
  <h1>My Account</h1>
  <p>Welcome to your personal area. Here you can check your personal details as well as monitor your auctions.</p>

<div class="row">
  <div class="col-md-2 menu-margin">
    <ul class="nav nav-list">
      <li>
        <a href="#address">
          Address
        </a>
      </li>

      <li>
        <a href="#auctions">
          Auctions
        </a>
      </li>

    </ul>
  </div>


  <div class="col-md-10">
  <div class="alert alert-warning" role="alert">

    <button type="button" class="close fui-cross" data-dismiss="alert"></button>
    <h4>Leave Feedback!</h4>
    
    <table class="table" id="table-account-feedback">
      <col width="200px">

      <tr>

        <td><a href="leave_feedback.php?user_id=40&auction_id=2"><img src="img/user-interface.svg" title="Insert title">First Row, first column</a></td>
        <td>First Row, second column</td>
        <td>First Row, third column</td>
      </tr>

      <tr>

        <td><a href="leave_feedback.php?user_id=40&auction_id=2"><img src="img/user-interface.svg" title="Insert title">First Row, first column</a></td>
        <td>First Row, second column</td>
        <td>First Row, third column</td>
      </tr>
      
    </table>



  </div>



  <a name="address"><h3>My Details</h3></a>
  <p><b>My Address:</b><br>
  Alex Vally<br>
  54, Marylebone Street<br>
  W1H 675 London<br>
  email: alex@vally.com</p>

  <a name="auctions"><h3>My Recent Auctions</h3></a>
  <table class="table table-striped">
    <col width="200px">
    <tr>
      <th>Item Name</th>
      <th>Description</th>
      <th>Current Price</th>
    </tr>
    <tr>

      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">First Row, first column</a></td>
      <td>First Row, second column</td>
      <td>First Row, third column</td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Second Row, first column</a></td>
      <td>Second Row, second column</td>
      <td>Second Row, third column</td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
    </tr>
  </table>

  
</div>
</div>

<?php
  include("../includes/layouts/footer.php");
?>

