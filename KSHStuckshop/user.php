<?php
error_reporting (E_ALL^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
$page = "user";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $username ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="/home/mwest139/KSHStuckshop/script/main.css">
</head>
<body>
<?php
if ($username && $userid) {
	?>
<div class="container-fluid fulllength">
    <?php
include 'navbar.php';
?>
<!-- put stuff between here and -->
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
        <div class="g-recaptcha" data-sitekey="6Ldhwh0TAAAAAKuFwkV_KUZoC3h4jLA1Yq9nHA4u"></div>
        <br/>
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
<!-- here -->
</div>
<script src="/home/mwest139/KSHStuckshop/script/backstretch.js"></script>
<script>
    $.backstretch("/home/mwest139/KSHStuckshop/images/kshsbackground.jpg");
</script>
<?php
}
else
	echo "Please login to access this page! <a href='./login.php'> Login here</a>";
?>
</body>
</html>