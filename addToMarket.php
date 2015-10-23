<?php
	session_start();
   	if(!isset($_SESSION["realty_status"])) {
     	       $_SESSION["realty_status"] = "Visitor";
	       echo "<h1>You must be logged in to use this feature.</h1>";
	       return;
	}

 	$userID =($_SESSION['id']);
	$mysqli;
	$x = 0;
	foreach($_POST['myHousesBox'] as $propertyID) {
	  try {
	      $user = "root";
	      $password = "";
	      //$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      //$user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      //$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      //$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      // $db = new PDO("mysql:host=$host:$port;dbname=housing", $user, $password);
	      //$db = new PDO("mysql:127.0.0.1;dbname=housing", $user, $password);

	      $queryString = "SELECT count(*) FROM market WHERE prop_id = (?)";
	      
	      $mysqli = new mysqli("127.0.0.1", $user, $password, "housing");
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("i", $propertyID);
	      $stmt->execute();
	      $stmt->bind_result($matches);
	      	     
	      if($stmt->fetch()) {
	        if($matches != 0) {
	        echo "One or more of the houses you have selected is already on the market. You must refine your changes.";
		return;		
		}
	      }
	      else {
	       echo "ERROR MARKETING HOME";
	       return;
	      }	      
	      echo "MARKER...";	      

	      // Put the house on the market
	      $stmt->close();
	      $userID = $_SESSION['id'];
	      $price = $_POST['salePrice'];
	      $queryString = "INSERT INTO market (user_id, prop_id, price) VALUES (?,?,?)";
	      $stmt = $mysqli->prepare($queryString);

	      $stmt->bind_param("iid",$userID, $propertyID, $price);
	      $stmt->execute();
	  }
	  catch (Exception $e){;}
	++$x;	
	}
	$mysqli->close();
	header("Location: market.php");
?>