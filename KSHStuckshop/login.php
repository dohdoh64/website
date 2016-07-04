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
	<title>Login</title>
    <link rel="icon" type="image/png" href="../KSHStuckshop/images/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="../KSHStuckshop/images/favicon-16x16.png" sizes="16x16" />
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../KSHStuckshop/script/style.css">
</head>

<body>
	<div class="container-fluid">
		<div class="top">
			<h1 id="title"><span id="logo"><span>KSHS Tuckshop</span></span></h1>
		</div>
        <div class="login-box">
			<div class="box-header">
				<h2>Login</h2>
                </div>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>                
                <label for="email">Email</label>
                <br/>
                <input type="email" name="email" id="email">
                <br/>
                <label for="password">Password</label>
                <br/>
                <input type="password" name="password" id="password">
                <br/>
               	<input  type="submit" name="loginbtn" value="Login"></input>
            </form>
            	
             <div style="color: red">
			<?php
			//checking if already logged in
				if ($username && $userid){
					echo "You are currently logged in as <b>$username</b>! Click <a href='./'> here </a> to continue to the main page. Click <a href='./logout.php'> here </a> to logout.";
				}
				else {
					//takes info from login form
					if ($_POST['loginbtn']){
						$email = $_POST['email'];
						$password = $_POST['password'];
						
						if ($email){
							if ($password){
								//hashes password for comparasion
								$passwordhash = md5(md5("UeICpINYQPjMEyse".$password."0u5DzN6skyHBHLV0"));
								//connects to DB
								require("../KSHStuckshop/connect.php");  
								//selects data from DB
								$sql = "SELECT id, active, firstname, lastname, password, email, admin FROM users WHERE email = '$email'";
								$result = $conn->query($sql);
								$conn->close();

								
									if ($result->num_rows == 1) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$dbid = $row["id"];
											$dbfirstname = $row["firstname"];
											$dblastname = $row["lastname"];
											$dbpassword = $row["password"];
											$dbemail = $row["email"];
											$dbactive = $row["active"];
											$dbadmin = $row["admin"];
											}
											//checks DB info
											if ($passwordhash == $dbpassword){
												if ($dbactive == 1){
													//set session info
													$_SESSION['userid'] = $dbid;
													$_SESSION['username'] = $dbfirstname;
													$_SESSION['admin'] = $dbadmin;
													//redirects user
													header('Location: http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/');
										}
										else
											echo "You must activate your account via the email sent to <b>$dbemail</b> in order to login!";
											
									}
									else 
										echo "You did not enter the correct password!";
										
								}
								 else 
								 	echo "The email you entered was not found";
									
							}
							else
								echo "You must enter your password!";
								
						}
						else
							echo "You must enter your email!";
						}  
				}
							?>
            </div>
               
			<a href="../KSHStuckshop/passwordreset.php"><p class="small">Forgot your password?</p></a>
            <a href="../KSHStuckshop/register.php"><p class="small">Need an account? Register here!</p></a>
            
		</div>
        <br>
	</div>
</body>
</html>