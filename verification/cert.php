<?php
	session_start(); 
	require 'helpers/registrationHelpers.php';
    
	
	$name = 'GUEST';
	$cert_no='';
	
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(isset($_POST['cert_no']))
		{
			$validCert = validateCert($_POST);

			if($validCert!=0)
				header('Location:index.php?err='.$validCert);
				
			if(!certExists($_POST['cert_no']))
			{
				header('Location:index.php?err=6');
			}
			else {
        $cert_no = $_POST['cert_no'];
}
		
		
	/*	else
		{
			return null;
		}*/
			
		}
		else
		{	
			header('Location:index.php?err=4');
		}
		
	}

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

  <!-- =======================================================
    Theme Name: Bell
    Theme URL: https://bootstrapmade.com/bell-free-bootstrap-4-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
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
              <!-- <h1> Hello <?php print $name;?> </h1> -->
            <div class="col-md-12">
	          <h2 class="form-signin-heading text-center text-primary" style="font-size: 40px"><b>Certificate Details</b></h2>
	          <table align="center"> 
	          	<thead>
	          		<tr>
							<th>Full Name</th>
							<th>Certificate No</th>
							<th>Date</th>
							</tr>
	          	</thead>
	          	<tbody>
	          			<h3 class="form-signin-heading text-center" style="text-transform: uppercase;">
			  <?php	  $query = dbConnect()->prepare("SELECT * FROM certificate_details WHERE cert_no=:cert_no");
			
	        	$query->bindParam(':cert_no', $cert_no);	
			
				$query->execute();
					
			        /*	if($row = $query->fetch())
					{
						return array(
							'name' => $row['name'],
							'cert_no' => $row['cert_no'],
							'cert_date' => $row['cert_date']
						);
					}*/
					while($row = $query->fetch(PDO::FETCH_LAZY)){
				echo "<td font-weight: bold;>";	
				echo $row['name'];	
				echo "</td>";	
				echo "<td>";	
				echo $row['cert_no'];	
				echo "</td>";	
				echo "<td>";	
				echo $row['cert_date'];	
				echo "</td>";	
						
			    //echo '<div>';
			    //echo $row['name'];
				//echo '<br/>';echo '<br/>';
			    //echo $row['cert_no'];
				//echo '<br/>';echo '<br/>';
			    //echo $row['cert_date'];
				//echo '<br/>';echo '<br/>';
			    //echo '</div>';
					} ?>
					  </h3><br>
			   <!-- <label for="inputEmail" class="sr-only">Certificate No</label><label for="inputEmail" class="sr-only"></label>
			   <label for="inputEmail" class="sr-only">Name</label><label for="inputEmail" class="sr-only"><?php print $name;?></label>-->
	          	</tbody>
	          </table><br>
			    <form class="form-signin" role="form" action="cert.php" method="POST">
				<button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Validate Another Certificate</button><br>
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
