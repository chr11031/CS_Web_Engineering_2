<?php
	session_start();
     	$_SESSION["realty_status"] = "Visitor";
	header('location: realty.php');
?>