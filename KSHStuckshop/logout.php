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
<title>Logout</title>
</head>
<body>
<?php

if ($username && $userid){
	session_unset();
	session_destroy();
	header('Location: http://resources.kenmoreshs.eq.edu.au/home/mwest139/KSHStuckshop/login.php');
}
else
	echo "You aren't logged in!"

?>
</body>
</html>