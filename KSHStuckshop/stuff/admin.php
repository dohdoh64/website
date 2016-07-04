<?php
error_reporting (E_ALL^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
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
<nav class="navbar navbar-inverse navbar-fixed-top">
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
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/index.php">Home</a></li>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/shifts.php">Shifts</a></li>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/runs.php">Runs</a></li> 
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
        if($admin == 1){?> <li class="active"><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/admin.php"><span class="glyphicon glyphicon-tasks"></span>&nbsp Admin</a></li> <?php }?>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/user.php"><span class="glyphicon glyphicon-user"></span>&nbsp <?php echo $username ?></a></li>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp Logout</a></li>
        </ul>
    </div>
  </div>
</nav>

<?php

	if ($admin == 1){
		require "connect.php";
		?>
        
		<div class="container-fluid">
        	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>                
                <label for="comment"><h3>Add Notification</h3></label>
                <br>
                <label for="message">Message</label>
                <br>
                <textarea placeholder="Remember, everyone can see these notifications!" name="message" rows="5" style="width: 40%;"></textarea>
                <br>
                <label for="importance">Color</label>
                <br>
                 <select name="importance">
                 <option value=""></option>
                  <option value="3">Warning</option>
                  <option value="2">Important</option>
                  <option value="1">Success</option>
                </select>
                <br><br>
           	  <input type="submit" name="noticesbtn" value="Add"></input>
            </form>

			<div style="color: red">
			<?php
			  if ($_POST['noticesbtn']){
				  $message = $_POST['message'];
				  $importance = $_POST['importance'];

				  if ($message){
					  if ($importance) {
					  $date = date("d, M, Y");
					  require "connect.php";
					  $sql = "INSERT INTO notifications (createrid, createrusername, message, createdate, expirydate, importance)
							  VALUES ('$userid', '$username', '$message','$date', '0', '$importance')";

						if ($conn->query($sql) === TRUE) {
						  echo "Notification Added";
						  }
						else
						  echo "Error: " . $sql . "<br>" . $conn->error;
					  }
					  else
					  	echo "Please select the color!";
					
			  }
			  else
				  echo "You must enter a message!";
			  }
		  
			  ?>
            </div>
           </div>
            
            
            <?php
			$sql = "SELECT username FROM users";
			$result = $conn->query($sql);
			?>
            
            <div class="container-fluid">
           <?php echo $results; ?>
        	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>    
           		<br>            
                <label for="shift"><h3>Add Shift (WORK IN PROGRESS! DONT USE!)</h3></label>
                <br>
                <label for="user">Employee</label>
                <br>
                <input list="users" name="user">
                 <datalist id="users">
                   <?php
				   if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					?><option value=" <?php echo $row["username"] ?> "><?php }
				   }
				   ?>
                  </datalist>
                <br>
                <label for="shift">Shift</label>
                <br>
                <input type="text" name="shift">
                <br>
                <label for="date">Date</label>
                <br>
                <input type="date" name="date">
                <br>
                <label for="day">Day</label>
                <br>
                <input type="text" name="day">
                <br>
                <label for="starttime">Start Time</label>
                <br>
                <input type="time" name="starttime">
                <br>
                <label for="starttime">End Time</label>
                <br>
                <input type="time" name="endtime">
                <br><br>
           	  <input type="submit" name="addshiftbtn" value="Create"></input>
            </form>

			<div style="color: red">
			<?php
			  if ($_POST['addshiftbtn']){
				  $shiftuser = $_POST['user'];
				  $shift = $_POST['shift'];
				  $shiftdate = $_POST['date'];
				  $shiftday = $_POST['day'];
				  $shiftstarttime = $_POST['starttime'];
				  $shiftendtime = $_POST['endtime'];

				  if ($shiftuser){
					  if ($shiftdate) {
						  if ($shiftstarttime) {
							  if ($shiftendtime) {
								  $date = date("d, M, Y");
								  $day = date("l");
									$sql = "INSERT INTO shifts (username, date, day, starttime, endtime, createdate, shift)
											VALUES ('$shiftuser', '$shiftdate', '$shiftday','$shiftstarttime', 'shiftendtime', '$date', '$shift')";
			  
										if ($conn->query($sql) === TRUE) {
										  echo "Shift Added";
										}
									  else
										echo "Error: " . $sql . "<br>" . $conn->error;
									 }
								  else
									echo "You must select the End time!";
							  }
						  else
							echo "You must select the Start time!";
					  }
					  else
					  	echo "You must select the date!";
					
					$conn->close();

			  }
			  else
				  echo "You must select a user!";
			  }
		  
			  ?>
            </div>
           </div>
            
		<?php
    }
	else
		echo "<br> Your not an admin";
}
else
	echo "Please login to access this page! <a href='./login.php'> Login here</a>";
?>
</body>
</html>