<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Register</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
				<h2>Register</h2>
			</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>            
			<label for="firstname">First name</label>
			<br/>
			<input type="text" name="firstname" id="firstname"/>
            <br>
            <label for="lastname">Last name</label>
			<br/>
			<input type="text" name="lastname" id="lastname"/>
            <br>
            <label for="email">Email</label>
			<br/>
			<input type="email" name="email" id="email"/>
			<br/>
			<label for="pass">Password</label>
			<br/>
			<input type="password" name="pass" id="pass"/>
            <br>
            <label for="retypepass">Retype Password</label>
			<br/>
			<input type="password" name="retypepass" id="retypepass"/>
            <br/>
            <center><div class="g-recaptcha" data-sitekey="6Ldhwh0TAAAAAKuFwkV_KUZoC3h4jLA1Yq9nHA4u"></div></center>
			<br/>
			<input type="submit" name="registerbtn" value="Register"/>
            </form>
            
            <div style="color: red">
			<?php
if($_POST['registerbtn']){
	$getfirstname = $_POST['firstname'];
	$getlastname = $_POST['lastname'];
	$getemail = $_POST['email'];
	$getpass = $_POST['pass'];
	$getretypepass = $_POST['retypepass'];
	
	if ($getfirstname){
		if ($getlastname){
			if ($getemail){
				if ($getpass){
					if ($getretypepass){
						if ($getpass === $getretypepass){
							if((strlen($getemail) >= 7) && (strstr($getemail, "@")) && (strstr($getemail, "."))){
								require("connect.php");  
								$sql = "SELECT email FROM users WHERE email = '$getemail'";
								$result = $conn->query($sql);
								if ($result->num_rows == 0) {
									
									$password = md5(md5("UeICpINYQPjMEyse".$getpass."0u5DzN6skyHBHLV0"));
									$date = date("d, M, Y");
									$code = md5(rand());
									
									$sql = "INSERT INTO users (firstname, lastname, password, email, active, code, date, admin, balance)
									VALUES ('$getfirstname', '$getlastname', '$password', '$getemail', '0', '$code', '$date', '0', '0')";
									

									if ($conn->query($sql) === TRUE) {	
										
										$conn->close();							
										$headers = "From: KSHS Tuckshop <mwest139@eq.edu.au>" . "\r\n" .
										$subject = "Activate your account";
										$message = "Thanks for registering $getfirstname $getlastname! Click the link below to activate your account.\n";
										$message .= "http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/activate.php?email=$getemail&code=$code\n";
										$message .= "Please note that you must activate your account to login.";

										if (mail($getemail,$subject,$message,$headers) ){

										echo "Your account has been registered. You must activate your account from the activation link sent to <b>$getemail</b>.";
											$getuser = "";
											$getemail = "";
										}
										else
											echo "An error has occured and your activation email was not sent";
									}
									else
										echo "An error has occured connecting to the database. Your account has not been created";
								}
								else
									echo "There is already a user with that email!";
							}
							else
								echo "You must enter a valid email adress to register!";
						}
						else
							echo "Your passwords did not match!";
					}
					else
						echo "You must retype your password to register!";
				}
				else
					echo "You must enter your password to register!";
			}
			else
				echo "You must enter your email to register!";
		}
		else
			echo "You must enter your last name to register!";
	}
	else
		echo "You must enter your first name to register!";
	}
		
?>
</div>
			<a href="login.php"><p class="small">Already got an account? Login here!</p></a>

		</div>
        <br>
	</div>
</body>
</html>