<?php
session_start();
	require '../helpers/registrationHelpers.php';
$cert_id = $_GET['cert_id'];
	if($_GET['cert_id']){
		$query = dbConnect()->prepare("DELETE FROM certificate_details WHERE cert_id = :cert_id");
		$delete = $query->execute(array('cert_id' => $_GET['cert_id']));
		header('Location:list.php?err=8'); }
?>