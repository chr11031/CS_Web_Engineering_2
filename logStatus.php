<?php	
	session_start();	
	header('Content-type: application/json');

   	if(!isset($_SESSION["realty_status"])) {
     	       $_SESSION["realty_status"] = "Visitor";
	}
	
	if($_SESSION["realty_status"] != "Member") {
		$msg = array("logged-out");
		echo json_encode($msg);
		return;
	}

	$accept = array("logged-in");
	echo json_encode($accept);
	return;
?>