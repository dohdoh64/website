 <?php
error_reporting (E_ALL^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>KSHS Tuckshop</title>
	<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="script/sorttable.js"></script>
    <link rel="stylesheet" href="script/main.css">
</head>
<body>
<?php
if ($username && $userid) {
	?>
<div class="container-fluid hellopeeps">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">	
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/index.php">Time<b>Shift</b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav">
         <li class="active"><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/index.php">Home</a></li>
         <li><a href="#">Shifts</a></li>
         <li><a href="#">Runs</a></li> 
             <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Other stuff
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Story Time</a></li> 
            </ul>
          </li>
      </ul>
       <ul class="nav navbar-nav navbar-right">
       	<?php
        if($admin == 1){?> <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/admin.php"><span class="glyphicon glyphicon-tasks"></span>&nbsp Admin</a></li> <?php }?>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/user.php"><span class="glyphicon glyphicon-user"></span>&nbsp <?php echo $username ?></a></li>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp Logout</a></li>
        </ul>
    </div>
  </div>
</nav>

<?php
require "connect.php";
$sql = "SELECT createrusername, message, importance FROM notifications";
$result = $conn->query($sql);
?> <div class="container-fluid"><h2>Notifications</h2></div> <?php

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
        	?>
            <div class="container-fluid">
                 <div class="alert <?php if($row["importance"] == 3) {echo "alert-danger"; } else if($row["importance"] == 2) {echo "alert-warning"; } else if($row["importance"] == 1) {echo "alert-success"; } else ?> fade in">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <?php echo htmlspecialchars($row["message"]) ?>
                </div>
            </div>
			<?php
   		}
	}

$user = $username;
$sql = "SELECT date, day, starttime, endtime, shift FROM shifts";
$result = $conn->query($sql);

?> <div class="container-fluid">
<h2>Shifts</h2> <?php
if ($result->num_rows > 0) { ?>
	<div style="overflow-x:auto;">
    <table class="table table-striped table-bordered sortable">
	<tr>
	<th>Date</th>
    <th>Day</th>
	<th>Start time</th>
	<th>End Time</th>
    <th>Shift</th>
	</tr> <?php
	
    while($row = $result->fetch_assoc()) {
        echo "<tr>
		<td>".$row["date"]."</td>
		<td>".$row["day"]."</td>
		<td>".$row["starttime"]."</td>
		<td>".$row["endtime"]."</td>
		<td>".$row["shift"]."</td>
		</tr>";
    }
    ?> </table>
	</div> <?php
} else {
    echo "No shifts currently scheduled!";
}
$conn->close();

?> </div>
</div>
<script src="script/backstretch.js"></script>
<script>
    $.backstretch("images/background2.jpg");
</script>
</script>
<?php
	}
	else
		echo "Please login to access this page! <a href='./login.php'> Login here</a>";
	
	?>

</body>
</html>
