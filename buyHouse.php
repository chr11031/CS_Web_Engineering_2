<?php
	session_start();
   	if(!isset($_SESSION["realty_status"])) {
     	       $_SESSION["realty_status"] = "Visitor";
	       echo "<h1>You must be logged in to use this feature.</h1>";
	       return;
	}

 	$userID =($_SESSION['id']);
	$mysqli;
	foreach($_POST['houseBox'] as $marketID) {
	  try
	  {
	      $user = "root";
	      $password = "";
	      //$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      //$user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      //$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      //$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      // $db = new PDO("mysql:host=$host:$port;dbname=housing", $user, $password);
	      //$db = new PDO("mysql:127.0.0.1;dbname=housing", $user, $password);

	      
	      $queryString = "SELECT * FROM market WHERE market_id = (?)";
	      
	      $mysqli = new mysqli("127.0.0.1", $user, $password, "housing");
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("i", $marketID);
	      $stmt->execute();
	      	     
	      $seller_id;
	      $prop_id;
	      $price;	      
	      $stmt->bind_result($VOID, $seller_id, $prop_id, $price);
	      
	      if($stmt->fetch()) {
	        ; // varaibles automatically assigned
	      }
	      else {
	       echo "ERROR BUYING HOME";
	       return;
	      }	      
	      
	      //Get the seller's balance.
	      $stmt->close();
	      $queryString = "SELECT balance FROM users WHERE user_id = (?)";
	      $stmt = $mysqli->prepare($queryString);

	      $stmt->bind_param("i",$seller_id);
	      $stmt->execute();
	      $sellerBalance;
	      $stmt->bind_result($sellerBalance);
	      if($stmt->fetch()) {
	        ;// variables automatically assigned
	      }
	      else {
	       echo "ERROR PARSING SELLER'S INFO";
	       return;
	      }
	      $newSellerBalance = $sellerBalance + $price;


	      echo $newSellerBalance;
	      //Update the seller's balance
	      $queryString = "UPDATE users SET balance = $newSellerBalance WHERE user_id = (?)";
	      $stmt->prepare($queryString);	      
	      $stmt->bind_param("i",$seller_id);	    
	      $stmt->execute();


	      //Get the buyer's balance.
	      $stmt->close();
	      $queryString = "SELECT balance FROM users WHERE user_id = (?)";
	      $stmt = $mysqli->prepare($queryString);

	      $stmt->bind_param("i",$userID);
	      $stmt->execute();
	      $sellerBalance;
	      $stmt->bind_result($buyerBalance);
	      if($stmt->fetch()) {
	        ;// variables automatically assigned
	      }
	      else {
	       echo "ERROR PARSING BUYER'S INFO";
	       return;
	      }
	      $newBuyerBalance = $buyerBalance - $price;

	      echo $newBuyerBalance;
	      //Update the seller's balance
	      $queryString = "UPDATE users SET balance = $newBuyerBalance WHERE user_id = (?)";
	      $stmt->prepare($queryString);	      
	      $stmt->bind_param("i",$userID);	    
	      $stmt->execute();

	      // Update the ownership of the home
	      $queryString = "UPDATE properties SET user_id=$userID WHERE prop_id = $prop_id";
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->execute();

	      // Remove this from the market catalogue
	      $queryString = "DELETE FROM market WHERE market_id = (?)";	      
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("i", $marketID);
	      $stmt->execute();	      
	  }
	  catch (Exception $e){;}
	}
	$mysqli->close();
	header("Location: market.php");
?>