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
	<title><?php echo $username ?></title>
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
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/index.php">Home</a></li>
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
         <li class="active"><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/user.php"><span class="glyphicon glyphicon-user"></span>&nbsp <?php echo $username ?></a></li>
         <li><a href="http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp Logout</a></li>
        </ul>
    </div>
  </div>
</nav>

<div class="container-fluid"><h2>Reset Password</h2></div>
<div class="container-fluid">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>                
        <label for="currentpass">Current Password</label>
        <br/>
        <input type="password" name="currentpass">
        <br/>
        <label for="newpass">New Password</label>
        <br/>
        <input type="password" name="newpass">
        <br/>
        <label for="renewpass">Retype New Password</label>
        <br/>
        <input type="password" name="renewpass">
        <br/><br/>
        <input  type="submit" name="resetpassbtn" value="Reset Password"></input>
    </form>
	
    <?php
	if($_POST['resetpassbtn']){
	$currentpass = $_POST['currentpass'];
	$newpass = $_POST['newpass'];
	$renewpass = $_POST['renewpass'];
	
		if($currentpass){
			if($newpass){
				if($renewpass){
					if($newpass === $renewpass){
						$password = md5(md5("UeICpINYQPjMEyse".$currentpass."0u5DzN6skyHBHLV0"));
						
						require("connect.php"); 
						$sql = "SELECT password FROM users WHERE username = '$username' AND password = '$password'";
						$result = $conn->query($sql);
							if ($result->num_rows == 1) {
							
							$newpassword = md5(md5("UeICpINYQPjMEyse".$newpass."0u5DzN6skyHBHLV0"));
							
							$sql = "UPDATE users SET password='$newpassword' WHERE username='$username'";
								if ($conn->query($sql) === TRUE) {
									echo "Your password has been changed!";
								}
							}
							else
								echo "Your current password is incorrect";
						$result = $conn->query($sql);
					}
					else
						echo "Your new passwords dont match!";
				}
				else
					echo "You must retype your new password!";
			}
			else
				echo "You must enter your new password!";
		}
		else
			echo "You must enter your current password!";
	}
	?>
</div>
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
