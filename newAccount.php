<?php
	session_start();
   	if(!isset($_SESSION["realty_status"])) {
     	       $_SESSION["realty_status"] = "Visitor";
	}
	$userInput = $_POST['desiredUsername'];
	$name = strval($_POST['name']);
	$pass = strval($_POST['pass']);
	$email= strval($_POST['email']);
	$phone= strval($_POST['phone']);
	$balance = floatval($_POST['balance']);

	try {
	      $user = "root";
	      $password = "";
	      //$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      //$user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      //$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      //$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      // $db = new PDO("mysql:host=$host:$port;dbname=housing", $user, $password);
	      //$db = new PDO("mysql:127.0.0.1;dbname=housing", $user, $password);

	      
	      $queryString = "SELECT count(*) FROM users WHERE username = (?)";
	      
	      $mysqli = new mysqli("127.0.0.1", $user, $password, "housing");
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("s", $userInput);
	      $stmt->execute();

	      $matches;
	      $successful = false;
	      $stmt->bind_result($matches);
	      
	      if($stmt->fetch()) {
	        if($matches == '0') {
	          echo "<h1> THIS USERNAME IS AVAILABLE.</h1>";	      		  
		  $successful = true;

		  $stmt->close();
		  $queryString = "INSERT INTO users (name, username, password, balance, email, phone) VALUES (?,?,?,?,?,?)";

	      	  if($stmt = $mysqli->prepare($queryString))
		   echo "SUCCESS";
		  else 
		  echo 'failure';
	      	  $stmt->bind_param("sssdss", $name, $userInput, $pass, $balance, $email, $phone);
	      	  $stmt->execute();
		}		  		  
		else
		  echo "<h1> THIS IS A TAKEN USERNAME</h1>";
		}
	      else
	        echo "Database error";

	      $stmt->close();
	      $mysqli->close();
	      if($successful == true) {
	      	$_SESSION["realty_status"] = "Member";
		$_SESSION["username"] = $userInput;
	        header("Location: myPage.php");
	      }
	}
	catch(Exception $e) {
	     echo "EXCEPTION ERROR";
	}	    
?>