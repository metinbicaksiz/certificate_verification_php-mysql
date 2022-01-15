<?php
session_start();	
	require '../helpers/registrationHelpers.php';
    $errors = array(
        1=>'Please enter a valid username',
        2=>'Please enter a valid password',
        3=>'Please enter a valid email address',
		4=>'Please complete the form',
		5=>'Certificate already exists',
		6=>'Certificate added successfully!',
		7=>'Certificate Updated successfully!',
		8=>'Certificate has been deleted!' );
	if(!isset($_SESSION['username'])) header('Location:login.php?err=2');
	else $name = $_SESSION['username'];
	if($_SERVER['REQUEST_METHOD']=='POST')
	{ 	if(isset($_POST['name'],$_POST['cert_no'],$_POST['cert_date'],$_POST['course_type'],$_POST['email']))
		{	$validCert = validateCert($_POST);
			if($validCert!=0) header('Location:index.php?err='.$validUser);	
			if(!certExists($_POST['cert_id'])) {	updateCert($_POST);  header('Location:list.php?err=7'); }
			else {	header('Location:list.php?err=5'); } } else   {	header('Location:login.php?err=4'); } }
	// Pagination code goes here
	$numperpage = 20; $countquery = dbConnect()->prepare("SELECT COUNT(cert_id) FROM certificate_details");
	$countquery->execute(); $sira = $countquery->fetch(); $numrecords = $sira[0];
	$numlinks = ceil($numrecords/$numperpage); $page = $_GET['start'];
	if (!$page) { $page = 0; }
	$start = $page * $numperpage;
	$counter = 1; if ($_GET['start'] > 0) { $counter = $_GET['start'] * $numperpage +1; }
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
  <link href="../static/css/style.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <style type="text/css">
  	td,th {
  	padding: 6px; 
    border: 1px solid #ccc; 
    text-align: left; 
    font-weight: bolder;
    color: black;
  	} </style>
</head>
  <body>
    <section class="hero">
    <div class="container text-center">
	      <div class="row">
	           	<div class="col-md-12">
					<a href="index.php" class="text-center">Add a certificate</a> |
					<a href="logout.php" class="text-center">Logout</a>	
	           	</div>
			    <div class="col-md-1"></div>    
		        <div class="col-md-10">
           		<h2 class="form-signin-heading text-center text-primary "><b>Certificate List</b></h2><br><div> 
				  		<table class="table table-stripped">	
				  		<thead><tr>
				  		<th><font color="#fff">No</th>
						<th><font color="#fff">Full Name</th>
						<th><font color="#fff">Certificate No</th>
						<th><font color="#fff">Date</th>
						<th><font color="#fff">Course Type</th>
						<th><font color="#fff">Email</th>
						<th><font color="#fff">Del</th>
						</tr></thead>
						<tbody class="tb_text">
			<?php 
			$query = dbConnect()->prepare("SELECT * FROM certificate_details ORDER BY cert_date ASC limit $start,$numperpage");
        	$query->bindParam(':cert_id', $cert_id);	
			$query->execute();
		        while($row = $query->fetch(PDO::FETCH_LAZY)){
				echo "<tr>";	echo "<td>"; echo $counter; $counter++; echo "</td>";		
				echo "<td>";	echo "<a href=\"update.php?cert_id={$row['cert_id']}\">{$row['name']}</a>";
				echo "</td>";	echo "<td>";	echo $row['cert_no'];	echo "</td>";	
				echo "<td>";	echo $row['cert_date'];	echo "</td>";	echo "<td>";	
				echo $row['course_type'];	echo "</td>";	echo "<td>";	echo $row['email'];	
				echo "</td>";
				echo "<td><a href=\"delete.php?cert_id={$row['cert_id']}\"><img src=\"../img/del24.png\"/></a></td>";	echo "</tr>"; } 	?>
				<br><?php if(isset($_GET['err'])){?><p class="text-danger text-center" style="font-size: 20px; font-weight: bolder;"><?=$errors[$_GET['err']]?></p><?php }?><br>
			</tbody></table></div>
			<nav> <ul class="pagination pagination-sm justify-content-center">
				<li class="page-item"><a class="page-link" href="list.php?start=0">First</a></li>
				<?php if ($page > 0) { ?>
				<li class="page-item"><a class="page-link" href="list.php?start=<?=$page-1;?>">Previous</a></li>
				<?php } ?> <?php for ($i=0; $i < $numlinks ; $i++) { $y = $i+1;
				echo '<li class="page-item"> <a class="page-link" href="list.php?start='.$i.'">'.$y.'</a></li>';
				}  ?> <?php if ($start != $numlinks) { ?>
			 	<li class="page-item"><a class="page-link" href="list.php?start=<?=$page+1 ?>">Next</a></li> 
    	   		<?php } ?>
    	   		<li class="page-item"><a class="page-link" href="list.php?start=<?=$numlinks-1 ?>">Last</a></li>
    	   	</ul> </nav></div>
       	<div class="col-md-1"></div></div></div>        
	</section>
  	<a href="www.googleshout.com"></a>
    <script src="../static/js/jquery.min.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>
	<script src="../static/js/typeahead.js"></script>
	<script src="../static/js/script.js"></script>
  </body>
</html>

