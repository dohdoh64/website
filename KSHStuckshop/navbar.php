<?php
require("../KSHStuckshop/connect.php");  
$sql = "SELECT balance FROM users WHERE id = '$userid'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$balance = $row["balance"];
}
$conn->close();
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/">KSHS Tuckshop</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li <?php if($page == 'main') {echo " class='active'";} ?>><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/">Home</a></li>
        <li <?php if($page == 'menu') {echo " class='active'";} ?>><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/menu.php/">Menu</a></li>
        <li><a href="#">Page 2</a></li> 
        <li><a href="#">Page 3</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href=""><strong><balance style="font-size: 20;"><?php echo "$" .$balance ?></balance></strong></a></li>
        <li <?php if($page == 'user') {echo " class='active'";} ?>><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/user.php"><span class="glyphicon glyphicon-user"></span>&nbsp <?php echo $username ?></a></li>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
