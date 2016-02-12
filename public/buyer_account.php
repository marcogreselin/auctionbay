<?php
  include("../includes/layouts/header_buyer.php");

?>

<div class="container">
  <h1>My Account</h1>
  <p>Welcome to your personal area. Here you can check your personal details as well as monitor auctions you have bid for.</p>

<div class="row">
  <div class="col-md-2 menu-margin">
    <ul class="nav nav-list">
      <li>
        <a href="#address">
          Address
        </a>
      </li>

      <li>
        <a href="#bids">
          Bids
        </a>
      </li>

      <li>
        <a href="#following">
          Following
        </a>
      </li>
    </ul>
  </div>


  <div class="col-md-10">
  <a name="address"><h3>My Details</h3></a>
  <p><b>My Address:</b><br>
  Alex Vally<br>
  54, Marylebone Street<br>
  W1H 675 London<br>
  email: alex@vally.com</p>

  <a name="bids"><h3>My Recent Bids</h3></a>
  <table class="table table-striped">
    <col width="200px">
    <tr>
      <th>Item Name</th>
      <th>Description</th>
      <th>Status</th>
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

  <a name="following"><h3>Following</h3></a>
  <table class="table table-striped">
    <col width="200px">
    <col width="auto">
    <col width="auto">
    <col width="50px">
    <tr>
      <th>Item Name</th>
      <th>Description</th>
      <th>Current Price</th>
      <th>Unfollow</th>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">First Row, first column</a></td>
      <td>First Row, second column</td>
      <td>First Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Second Row, first column</a></td>
      <td>Second Row, second column</td>
      <td>Second Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
    <tr>
      <td><a href="#"><img src="img/user-interface.svg" title="Insert title">Third Row, first column</a></td>
      <td>Third Row, second column</td>
      <td>Third Row, third column</td>
      <td class="trash"><a href="#"><img src="img/trash.svg" class="trash-icon" title="Unollow"></a></td>
    </tr>
  </table>
</div>
</div>

<?php
  include("../includes/layouts/footer.php");
?>

