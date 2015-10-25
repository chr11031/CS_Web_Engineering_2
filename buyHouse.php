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
	      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      
	      $queryString = "SELECT * FROM market WHERE market_id = (?)";
	      
	      $mysqli = new mysqli($host, $user, $password, "housing", $port);
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("i", $marketID);
	      $stmt->execute();
	      	     
	      $seller_id;
	      $prop_id;
	      $price;	      
	      $stmt->bind_result($VOID, $price, $user_id, $prop_id);
	      
	      if($stmt->fetch()) {
	        ; // varaibles automatically assigned
	      }
	      else {
	       echo "ERROR BUYING HOME";
	       return;
	      }	      
	      echo "THE FIRST QUERY TO QUERY THE MARKET ID RETURNED: $marketID<br/>";
	      
	      //Get the seller's balance.
	      $queryString = "SELECT balance FROM users WHERE user_id = (?)";
	      $stmt->close();
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("i",$seller_id);
	      $stmt->execute();
	      $sellerBalance;
	      $stmt->bind_result($sellerBalance);
	      echo "<--BEFORE FETCH STATEMENT-->";
	      if($stmt->fetch()) {
	        ;// variables automatically assigned
	      }
	      else {
	       echo "ERROR PARSING SELLER'S INFO";
	      }
	      $newSellerBalance = $sellerBalance + $price;
	      echo "THE SECOND QUERY TO GET THE SELLERBALANCE RETURNED $sellerBalance<br/>";

	      echo $newSellerBalance;
	      //Update the seller's balance
	      $queryString = "UPDATE users SET balance = $newSellerBalance WHERE user_id = (?)";
	      $stmt->prepare($queryString);	      
	      $stmt->bind_param("i",$seller_id);	    
	      $stmt->execute();
	      echo "THE THIRD QUERY TO UPDATE THE SELLER BALANCE<br/>";


	      //Get the buyer's balance.
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
	      echo "THE FOURTH QUERY TO get the user's balance: $buyerBalance<br/>";

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
	      echo "THE FIFTH QUERY TO get the property id ($prop_id) set for user $userID<br/>"; 

	      // Remove this from the market catalogue
	      $queryString = "DELETE FROM market WHERE market_id = (?)";	      
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("i", $marketID);
	      $stmt->execute();	      
	      echo "THE SIXTH QUERY TO REMOVE THE ENTRY FROM THE MARKET<br/>";
	  }
	  catch (Exception $e){;}
	}
	$mysqli->close();
	header("Location: market.php");
?>