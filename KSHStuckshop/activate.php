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
<title>Activate Account</title>
</head>
<body>
<?php

	$getemail = $_GET['email'];
	$getcode = $_GET['code'];
?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>                
        <label for="email">Email</label>
        <br/>
        <input type="email" name="email" autocomplete="off" value='<?php echo $getemail ?>'>
        <br/>
        <label for="password">Code</label>
        <br/>
        <input type="password" name="code" autocomplete="off" value='<?php echo $getcode ?>'>
        <br/><br/>
        <input type="submit" name="activatebtn" value="Activate"></input>
    </form>	
<?php
	
	if ($_POST['activatebtn']){
	$getemail = $_POST['email'];
	$getcode = $_POST['code'];
			
		if ($getemail){
			if ($getcode){
				require("connect.php");
					$sql = "SELECT active, code FROM users WHERE email = '$getemail'";
					$result = $conn->query($sql);

					if ($result->num_rows == 1) {
						while($row = $result->fetch_assoc()) {
						$dbactive = $row["active"];
						$dbcode = $row["code"];
						}
								if ($dbactive == 0){
									if ($dbcode == $getcode){
										$sql = "UPDATE users SET active='1' WHERE email='$getemail'";
										if ($conn->query($sql) === TRUE) {
										$getemail = "";
										$getcode = "";
										header('Location: http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/login.php');
										
										}
										else 
											echo "An error has occured and your account has not been activated" . $conn->error;
									}
									else
										echo"The code you entered was not correct";
							}
							else
								echo "This account has already been activated. Click <a href='./login.php'> here </a> to login!";
					}
					else
						echo "The email you entered was not found.";
			}
			else
				echo "You must enter the activation code.";
		}
		else
			echo "You must enter your email.";
	}
?>
</body>
</html>