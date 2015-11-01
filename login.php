<?php	
	session_start();	
	header('Content-type: application/json');

   	if(!isset($_SESSION["realty_status"])) {
     	       $_SESSION["realty_status"] = "Visitor";
	}

	$userInput = $_POST['username'];
	$pass = $_POST['password'];

	try {
	      $user = "root";
	      $password = "";
	      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');

	      $queryString = "SELECT * FROM users WHERE (username, password) = (?, ?)";
	      
	      $mysqli = new mysqli("$host", $user, $password, "housing", $port);
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("ss", $userInput, $pass);
	      $stmt->execute();

	      $matches;
	      $successful = false;


	      $stmt->bind_result($var1, $var2, $var3, $var4, $var5, $var6, $var7);
	      if($row = $stmt->fetch()) {

	          $_SESSION["realty_status"] = "Member";
		  $_SESSION["username"] = $var3;
		  $_SESSION["name"] = $var2;
		  $_SESSION["email"] = $var6;
		  $_SESSION["balance"] = $var5;
		  $_SESSION["phone"] = $var7;
		  $_SESSION["id"] = $var1;
		  $successful = true;
	      }		  		  

	      $stmt->close();
	      $mysqli->close();

	      if($successful == true) {
	      	$data = array($var3);
	        echo json_encode($data);
		return;
		}
	      else {
	        $err = array("Invalid Login");
     	        echo json_encode($err);
		return;
		}
	}
	catch(Exception $e) {
	  echo "UNKOWN EXCEPTION";
	  $err = array("Invalid Login");
	  echo json_encode($err);
	  return;
	}
	
	$err = array("Invalid Login");
	echo json_encode($err);
	return;
?>