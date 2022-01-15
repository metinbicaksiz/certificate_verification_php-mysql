<?php
session_start();
	require '../helpers/registrationHelpers.php';
if(!isset($_SESSION['username']))
		header('Location:login.php?err=2');
	else $name = $_SESSION['username'];	
if($_SERVER['REQUEST_METHOD']=='POST')
	{ 	if(isset($_POST['name'],$_POST['cert_no'],$_POST['cert_date'],$_POST['course_type'],$_POST['email']))
		{ 	$validCert = validateCert($_POST);
			if($validCert!=0)
				header('Location:index.php?err='.$validUser);
				if(!certExists($_POST['cert_id']))
				{	updateCert($_POST); 
					header('Location:list.php?err=7');}
				else {	header('Location:list.php?err=5'); } }
		else{	header('Location:login.php?err=4');}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Update Certificate</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!--<meta content="" name="keywords">-->
  <meta content="" name="description">
  <!-- Favicon -->
  <link href="../img/fav.ico" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="../static/css/style.css" rel="stylesheet"> 
  <link href="../css/style.css" rel="stylesheet">
  <style type="text/css">
  	td,th {
  	padding: 6px; 
    border: 1px solid #ccc; 
    text-align: left; 
    font-weight: bolder;
    color: black;
  	}
  </style>
</head>
  <body>
    <section class="hero">
    <div class="container text-center">
	      <div class="row">
           	<div class="col-md-1"></div>          	
	           	<div class="col-md-10">
	           		<h1 class="text-center text-primary" style="font-weight: bold;">Hello Admin!</h1>
					<a href="logout.php" class="text-center">Logout</a>	
		<?php	$query = dbConnect()->prepare("SELECT * FROM certificate_details WHERE cert_id='$_GET[cert_id]'");
        	$query->bindParam(':cert_id', $cert_id);	$query->execute();	$row = $query->fetch(PDO::FETCH_LAZY)?>
						<form class="form-signin" role="form" action="update.php" method="POST">
					        <h2 class="form-signin-heading text-center ">Enter Certificate Details</h2><br>
					        <label for="inputUsername" class="sr-only">CertID</label>
					        <input type="text" id="inputUsername" value="<?php echo $row['cert_id'];?>" class="form-control"  name="cert_id" required autofocus><br>
					        <label for="inputUsername" class="sr-only">Name</label>
					        <input type="text" id="inputUsername" value="<?php echo $row['name'];?>" class="form-control"  name="name" required autofocus><br>
					        <label for="inputEmail" class="sr-only">Certificate No </label>
					        <input type="text" id="inputEmail" value="<?php echo $row['cert_no'];?>" class="form-control"  name="cert_no" required> <br>   
							<label for="inputEmail" class="sr-only">Certification Date</label>
					        <input type="date" id="inputEmail" class="form-control" value="<?php echo $row['cert_date'];?>"  name="cert_date" required> <br>   
							<label for="inputCourse_type" value="<?php echo $row['cert_date'];?>" class="sr-only">Course Type </label>
					        <input type="text" id="inputEmail" class="form-control"  name="course_type" value="<?php echo $row['course_type'];?>" required> <br>
					        <label for="inputEmail" value="<?php echo $row['email'];?>" class="sr-only">Email </label>
					        <input type="email" id="inputEmail" class="form-control"  name="email" value="<?php echo $row['email'];?>" required> <br>
							<?php if(isset($_GET['err'])){?><p class="text-danger text-center" style="font-size: 20px; font-weight: bolder;"><?=$errors[$_GET['err']]?></p><?php }?><br>
							<button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Update Certificate</button><br></form>
					    <a href="list.php">BACK</a></div><div class="col-md-1"></div></div></div>        
	</section>
  	<a href="www.googleshout.com"></a>
    <script src="../static/js/jquery.min.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>
	<script src="../static/js/typeahead.js"></script>
	<script src="../static/js/script.js"></script>
  </body>
</html>
