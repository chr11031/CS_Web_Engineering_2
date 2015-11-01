<?php
	session_start();
	header('Content-type: application/json');
     	$_SESSION["realty_status"] = "Visitor";
	$arr = array("Successfully Logged out");
	echo json_encode($arr);
?>