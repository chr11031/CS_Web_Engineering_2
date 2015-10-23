<?php
	session_start();
   	if(!isset($_SESSION["realty_status"])) {
     	       $_SESSION["realty_status"] = "Visitor";
	       header('Location: realty.php');
	}

	$userID =($_SESSION['id']);
	$title = $_POST['title'];
	$address=$_POST['address'];
	$town   =$_POST['town'];
	$state  =$_POST['state'];
	$sq_ft  =($_POST['sq_ft']);
	$url    =$_POST['photo'];
	$description=$_POST['description'];

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

	
	$queryString = "INSERT INTO properties (user_id, title, address, town, state, sq_ft, photo_url, description)
	VALUES (?,?,?,?,?,?,?,?)";
	echo $queryString . "<br/>";

	$mysqli = new mysqli("127.0.0.1", $user, $password, "housing");
	$stmt = $mysqli->prepare($queryString);
	$stmt->bind_param("issssiss", $userID, $title, $address, $town, $state, $sq_ft, $url, $description);
	$stmt->execute();
	}
	catch (Exception $e){;}
	header('Location: myPage.php');
?>