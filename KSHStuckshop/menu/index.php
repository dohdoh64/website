<?php
error_reporting (E_ALL^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
$page = "menu";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>KSHS Tuckshop</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/home/mwest139/KSHStuckshop/script/main.css">
</head>
<body>
<?php
if ($username && $userid) {
	?>
<div class="container-fluid fulllength">
    <?php
include '/home/mwest139/KSHSTuckshop/navbar.php';
?>
<!-- put stuff between here and -->
<h1>This is the Menu</h1>
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