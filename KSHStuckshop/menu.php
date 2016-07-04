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
include 'navbar.php';
?>
<!-- put stuff between here and -->
<div class="container-fluid">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
    <li><a data-toggle="pill" href="#menumon">Monday</a></li>
    <li><a data-toggle="pill" href="#menutue">Tuesday</a></li>
    <li><a data-toggle="pill" href="#menuwed">Wednesday</a></li>
    <li><a data-toggle="pill" href="#menuthu">Thursday</a></li>
    <li><a data-toggle="pill" href="#menufri">Friday</a></li>
  </ul><br>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Select which day's menu you wish to view!</h3>
      <p></p>
    </div>
    <div id="menumon" class="tab-pane fade">
      <h3>Monday</h3>
      <p></p>
    </div>
    <div id="menutue" class="tab-pane fade">
      <h3>Tuesday</h3>
      <p></p>
    </div>
    <div id="menuwed" class="tab-pane fade">
      <h3>Wednesday</h3>
      <p></p>
    </div>
    <div id="menuthu" class="tab-pane fade">
      <h3>Thursday</h3>
      <p></p>
    </div>
    <div id="menufri" class="tab-pane fade">
      <h3>Friday</h3>
      <p></p>
    </div>
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