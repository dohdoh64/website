<?php
error_reporting (E_ALL^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Reset Password</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="script/style.css">
</head>

<body>
	<div class="container-fluid">
		<div class="top">
			<h1 id="title"><span id="logo"><span>KSHS Tuckshop</span></span></h1>
		</div
		><div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Password Reset</h2>
			</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>
			<label for="email">Email</label>
			<br/>
			<input type="text" name="email">
            <br>
            <center><div class="g-recaptcha" data-sitekey="6Ldhwh0TAAAAAKuFwkV_KUZoC3h4jLA1Yq9nHA4u"></div></center>
            <br/>
			<input type="submit" name="resetbtn" value="Reset Password"/>

            
              <div style="color: red">
			<?php
			//checking if already logged in
				if ($username && $userid){
					echo "You are currently logged in as <b>$username</b>! Click <a href='./index.php'> here </a> to continue to the main page. Click <a href='./logout.php'> here </a> to logout.";
				}
				else {
					//takes info from login form
					if ($_POST['resetbtn']){
						$email = $_POST['email'];
						
						if ($email){
							if((strlen($email) >= 7) && (strstr($email, "@")) && (strstr($email, "."))){
								require("connect.php");
								
								$sql = "SELECT id, active FROM users WHERE email='$email'";
								$result = $conn->query($sql);
								$numrows = mysql_num_rows($result);
								if ($result->num_rows == 1) {
									$newpass = rand();
									$newpass = md5($newpass);
									$newpass = substr($newpass, 0, 15);
									$newpassword = $passwordhash = md5(md5("UeICpINYQPjMEyse".$newpass."0u5DzN6skyHBHLV0"));;
									
									$sql = "UPDATE users SET password= '$newpassword' WHERE email='$email'";

									if ($conn->query($sql) === TRUE) {
  									  	$headers = "From: KSHS Tuckshop <mwest139@eq.edu.au>" . "\r\n" .
										$subject = "Password reset";
										$message = "Your password has been reset. Your new password is below: \n";
										$message .= "$newpass\n";
										$message .= "Once you have logged in, you should change your password by clicking on your account on the top right of the screen. \n";
										$message .= "If you didn't request a password reset please contact me at mwest139@eq.edu.au";

										if ( mail($email,$subject,$message,$headers) ){
											echo "Your password has been reset. An email has been sent with your new password.";
											
										}
										else
											echo "An error has occured and the email containing your new password was not sent";
									}
									else
										echo "An error has occured and the password wasn't updated. " . $conn->error;  
								}
								else
									echo "Your email has not been found.";
								
								$conn->close();
							}
							else
								echo "Please enter a valid email address!";
						}
						else
							echo "Please enter your email!";
						
					}
				}
				
            ?>
            <br/>
			<a href="login.php"><p class="small">Remember your password? Login here!</p></a>
           </div>
		</div>
        <br>
	</div>
</body>
</html>