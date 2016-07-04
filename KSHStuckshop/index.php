<?php
error_reporting (E_ALL^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$admin = $_SESSION['admin'];
$page = "main";
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

<div style="background-color:transparent; padding-top:10px;padding-bottom:10px;margin-bottom:-20px;" class="jumbotron">
<center>
 <h1 style ="font-size: 35px;"> Kenmore State High School Tuckshop </h1>
  <p style="font-size: 25px;">Home Page</p> 
  </center>
</div>
<br>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2 style="font-size:20px;">About the KSHS Tuckshop website:</h2>     
      <p style="font-size: 15px;"> The Kenmore State High School tuckshop is responsible for providing hunndreds of students students with high quality, fairly priced and healthy food everyday.As Kenmore State High School has grown in size the tuckshop staff have been overloaded with work. Because of this, year 10 students who partipated in a digital technologies and web design class used their knowledge to create and interactive web app in which students can quickly and easily order food therfor decresing the tuckshop line, decreasing stree on staff.</p>
    </div>
    <div class="col-sm-4">
     <center> 
     <br>
     <br>
     <img style="width: 80%;" src="">
<center>
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