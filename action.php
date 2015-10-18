<?php
	echo "<h1>Welcome to the results page:</h1><br/>";
	echo "Name: " . $_POST['name'] . "<br/>";
	echo "Email: " . $_POST['email']  . "<br/><br/>";	
	echo "You are a " . $_POST['major']  . " major <br/><br/>";
	
	echo "list of places you have been: <br/>";
	if(!empty($_POST['x']))	{	
		foreach($_POST['x'] as $place) {
			if($place != "")
			   echo $place . "<br/>";
		}
	}
	else {	
	echo "You need to get out more... <br/>";
	}
	echo "<br/>" . "And you commented: <br/><br/> " . $_POST['comments'] . "<br/>";

?>