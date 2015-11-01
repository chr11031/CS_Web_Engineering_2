<?php	
	session_start();	
	header('Content-type: application/json');
	$desired_username = $_POST['username'];

	try {
	      $user = "root";
	      $password = "";
	      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');

	      $queryString = "SELECT * FROM users WHERE (username) = (?)";
	      
	      $mysqli = new mysqli("$host", $user, $password, "housing", $port);
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("s", $desired_username);
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
	      	$av = array("no");
	        echo json_encode($av);
		return;
		}
	      else {
	        $response = array("yes");
     	        echo json_encode($response);
		return;
		}
	}
	catch(Exception $e) {
	  $err = array("undefined");
	  echo json_encode($err);
	  return;
	}
	$err = array("undefined");
	echo json_encode($err);
	return;
?>