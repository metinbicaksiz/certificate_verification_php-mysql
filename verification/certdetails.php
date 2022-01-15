<?php	
require 'helpers/dbHelpers.php';
	function certDetails($cert_no)
	{ $sql = "SELECT * FROM certificate_details WHERE cert_no=:cert_no";
		$query = dbConnect()->prepare($sql); $query->bindParam(':cert_no', $cert_no); $query->execute();
	if($row = $query->fetch())
		{ return array(
				'name' => $row['name'],
				'cert_no' => $row['cert_no'],
				'cert_date' => $row['cert_date']
			);	} else {
			return null; } }
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
	          <a class="hero-brand" href="index.html" title="Home"><img alt="Bell Logo" src="img/logo.png"></a>
	        </div>
	      </div>
	<div class="col-md-12">
     <!-- <h1> Hello <?php certDetails($cert_no); print $cert_date;?> </h1>-->
        <div class="col-md-12">
       		<a href="www.googleshout.com"></a>
            <form class="form-signin" role="form" action="index.php" method="POST">
          	<h2 class="form-signin-heading text-center">Enter Certificate Details</h2><br>
       		<label for="inputEmail" class="sr-only">Certificate No</label>
        	<input type="text" id="inputEmail" class="form-control" placeholder="Certificate No" name="cert_no" required>    
			<button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Validate Certificate</button><br>
		    </form>
	  	</div>
		</div>
    </div> 
</section>
    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
	<script src="static/js/typeahead.js"></script>
	<script src="static/js/script.js"></script>
  </body>
</html>
