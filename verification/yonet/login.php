<?php
    session_start(); 
	require '../helpers/loginHelpers.php';
	    $errors = array(1=>'Username or Password is incorrect!', 2=>'Please login before adding user!',
			3=>'Please enter valid username and password!', 4=>'You have successfully logged out!' );
		if($_SERVER['REQUEST_METHOD']=='POST') {
		if(isset($_POST['username'],$_POST['password'])) {
			if(checkUser($_POST['username'],$_POST['password'])) {
				$_SESSION['username'] = $_POST['username'];
				header('Location:index.php'); } else {
				header('Location:login.php?err=1');}
		} else {	header('Location:login.php?err=3'); } }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Certificate Verification - Admin Panel</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
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
  <link rel="stylesheet" type="text/css" href="../static/css/style.css">  
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>    
    <section class="hero">
    	<div class="container text-center">
    		<div class="row">
	        <div class="col-md-12">
	          <a class="hero-brand" href="https://www.istesol.com/verification/yonet/login.php" title="Home"><img alt="Bell Logo" src="../img/logo.png"></a>
	        </div>
	      	</div>
	      	<div class="col-md-12">
	      		<h1 class="text-center text-primary">Admin Panel</h1><br/><br/>
	      		<a href="../index.php">Verification Page</a>
		      	<form class="form-signin" role="form" action="login.php" method="POST">
	          	<h2 class="form-signin-heading text-center text-muted">Sign In</h2><br>
	        	<label for="inputUsername" class="sr-only">Username</label>
	        	<input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus><br>
	        	<label for="inputPassword" class="sr-only">Password</label>
	        	<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
	        	<?php if(isset($_GET['err'])){?><p class="text-danger text-center" style="font-size: 20px; font-weight: bolder;"><?=$errors[$_GET['err']]?></p><?php }?>
	        	<button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Sign in</button><br>
	      		</form> </div>	</div>	
    </section>             
    <a href="www.googleshout.com"></a>
    <script src="../static/js/bootstrap.min.js"></script>
  </body>
</html>
