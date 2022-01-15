<?php
  session_start(); 
  require 'helpers/registrationHelpers.php';
    $errors = array(1=>'Please enter a valid username', 2=>'Please enter a valid password',
        3=>'Please enter a valid email address', 4=>'Please Enter a Certificate No.',
        5=>'This is a Valid Certificate!', 6=>'Certificate does not Exist!');
  $name = 'GUEST';
  $cert_no='';
  if($_SERVER['REQUEST_METHOD']=='POST')
  {	if(isset($_POST['cert_no']))
    {	$validCert = validateCert($_POST);
      if($validCert!=0)
        header('Location:index.php?err='.$validCert);
      if(!certExists($_POST['cert_no']))
      {	header('Location:index.php?err=6'); }	else {
        certDetails($_POST['cert_no']);
        header('Location:index.php?err=5');  } } else { 
      header('Location:index.php?err=4');	}	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Certificate Verification</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!-- Favicon -->
  <link href="img/fav.ico" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link rel="stylesheet" type="text/css" href="static/css/style.css">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <section class="hero">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
    	    <a class="hero-brand" href="https://www.istesol.com" title="Home"><img alt="Bell Logo" src="img/logo.png"></a><br/>
	  		<a href="yonet">Admin Panel</a></div></div>
            <div class="col-md-12">
            <div class="col-md-12">
        <form class="form-signin" role="form" action="cert.php" method="POST">
        <h2 class="form-signin-heading text-center text-primary" style="font-weight: bold;">Enter Certificate Verification Number</h2><br>
        <label for="inputEmail" class="sr-only">Certificate No</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Certificate No" name="cert_no" required>    
        <?php if(isset($_GET['err'])){?><p class="text-danger text-center" style="font-size: 20px; font-weight: bolder;"><?=$errors[$_GET['err']]?></p><?php }?><br>
        <button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Verify Certificate</button><br>
        </form></div></div></div> </section>
  <!-- /Hero -->  
  <!-- Required JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/lockfixed/lockfixed.min.js"></script>
  <!-- Template Specisifc Custom Javascript File -->
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>
</body>
</html>
