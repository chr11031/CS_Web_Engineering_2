<?php
	session_start();
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
		  echo "DATA: " . $_SESSION['username'];
		  $successful = true;
	      }		  		  
	      else {
		echo "<h1>Invalid username/password</h1>";
	      }

	      $stmt->close();
	      $mysqli->close();

	      if($successful == true)
	        header('location: realty.php');
	}
	catch(Exception $e) {
	  echo "UNKOWN EXCEPTION";
	}
?>