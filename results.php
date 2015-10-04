<?php
	// Handle Session data/conditions
	session_start();
	if(!isset($_SESSION["status"])) {
	  $_SESSION["status"] = "PENDING";
	}
	else {
       	  if($_SESSION["status"] == "PENDING") {
	    if($_POST['hero'] != "") {
	      $_SESSION["status"] = "SUBMITTING";
	    }
	  }
	}   
	if($_SESSION["status"] == "SUBMITTING") {
		// User input data
		$heroVar = $_POST['hero'];
		$villainVar = $_POST['villain'];
		$powersVar = "";
		$customHeroVar = $_POST['customHero'];
		$customVillainVar = $_POST['customVil'];
		$customHeroVar = str_replace(" ", "_", $customHeroVar);
		$customVillainVar = str_replace(" ","_", $customVillainVar);	

		foreach($_POST['powers'] as $p) {
		  if(($powersVar == "") && ($p != ""))	
		    $powersVar = $p; 	  	
		  else	 
		    $powersVar = $powersVar . " " . $p;
		}
		$surveyString = $heroVar . " " . $villainVar . " " . $powersVar . " " . $customHeroVar . " " . $customVillainVar ." \n";
		
		// Add our string to the file
		$myFile = fopen("data.txt", "a+");
		fwrite($myFile, $surveyString);			
		fclose($myFile);
	        $_SESSION["status"] = "SUBMITTED";
	}

	// Parse and compile our statistics	
	$surveyData = array(
		"hero" => array(),
		"vil"      => array(),
		"powerOne" => array(),
		"powerTwo" => array(),
		"powerThr" => array(),
		"cHero"    => array(),
		"cVil"     => array());

	$heroStats = array(0,0,0,0,0,0,0,0,0);
	$vilStats = array(0,0,0,0,0,0,0,0,0);
	$powStats = array(0,0,0,0,0,0,0,0);

	$tempHero = "";
	$tempVil = "";
	$tempPowers = array("", "", "");
	$tempCustomHero = "";
	$tempCustomVil = "";
	$myFile = fopen("data.txt", "r");
	$line;
	$count = 0;
	while(!feof($myFile)) {
       		$line = fgets($myFile);    				
		if($line != "") {
        	  sscanf($line, "%s %s %s %s %s %s %s", $tempHero, $tempVil, 
		      	$tempPowers[0], $tempPowers[1], $tempPowers[2], $tempCustomHero, $tempCustomVil);			

		  $tempHero = str_replace("_", " ", $tempHero);
		  $tempVil = str_replace("_", " ", $tempVil);
		  $tempPowers[0] = str_replace("_", " ", $tempPowers[0]);
		  $tempPowers[1] = str_replace("_", " ", $tempPowers[1]);
		  $tempPowers[2] = str_replace("_", " ", $tempPowers[2]);
		  $tempCustomHero = str_replace("_", " ", $tempCustomHero);
		  $tempCustomVil = str_replace("_", " ", $tempCustomVil);


		  switch($tempHero) {
		    case "Batman":
		      ++$heroStats[0];
		      break;
		    case "Superman":
		      ++$heroStats[1];
		      break;
		    case "Aquaman":
		      ++$heroStats[2];
		      break;
		    case "Spiderman":
		      ++$heroStats[3];
		      break;
		    case "Iron Man":
		      ++$heroStats[4];
		      break;
		    case "The Punisher":
		      ++$heroStats[5];
		      break;
		    case "Flash":
		      ++$heroStats[6];
		      break;
		    case "Thor":
		      ++$heroStats[7];
		      break;
		    case "Hulk":
		      ++$heroStats[8];
		      break;		    
		  }

		  switch($tempVil) {
		    case "Doctor Doom":
		      ++$vilStats[0];
		      break;
		    case "Whiplash":
		      ++$vilStats[1];
		      break;
		    case "Lex Luthor":
		      ++$vilStats[2];
		      break;
		    case "Red Hulk":
		      ++$vilStats[3];
		      break;
		    case "Venom":
		      ++$vilStats[4];
		      break;
		    case "Bane":
		      ++$vilStats[5];
		      break;
		    case "Doomsday":
		      ++$vilStats[6];
		      break;
		    case "Green Goblin":
		      ++$vilStats[7];
		      break;
		    case "The Joker":
		      ++$vilStats[8];
		      break;		    
		  }
		  
		  for($i = 0; $i < 3; $i++) {
		   switch($tempPowers[$i]) {
		    case "Flying":
		      ++$powStats[0];
		      break;
		    case "Telekenisis":
		      ++$powStats[1];
		      break;
		    case "Storm Powers":
		      ++$powStats[2];
		      break;
		    case "Time Regression":
		      ++$powStats[3];
		      break;
		    case "Fire Powers":
		      ++$powStats[4];
		      break;
		    case "Ice Powers":
		      ++$powStats[5];
		      break;
		    case "Super Strength":
		      ++$powStats[6];
		      break;
		    case "Super Intelligence":
		      ++$powStats[7];
		      break;
		   }
		  }

		  
		  array_push($surveyData["hero"], $tempHero);
		  array_push($surveyData["vil"], $tempVil);
		  array_push($surveyData["powerOne"], $tempPowers[0]);
		  array_push($surveyData["powerTwo"], $tempPowers[1]);
		  array_push($surveyData["powerThr"], $tempPowers[2]);
		  array_push($surveyData["cHero"], $tempCustomHero);
		  array_push($surveyData["cVil"],  $tempCustomVil);
		  ++$count;
	 	}
	}	
	fclose($myFile);

 	// Calculate our relative pi portions of the user's inputs
	for($i = 0; $i < 9; $i++) {
	  $heroStats[$i] = (($heroStats[$i] / $count)) * 360.0;
	  $vilStats[$i]  = (($vilStats[$i]  / $count)) * 360.0;
	}
	for($i = 0; $i < 8; $i++) {
	  $powStats[$i] = (($powStats[$i] / ($count * 3)) * 360.0);
	}

	require("format.php");	
	printHeroHeader();
	echo "<div class = \"container-fluid\"><div class = \"jumbotron\">";

	// Display pi charts of the survey
	echo "<h1>Statistical Analysis Tell us:</h1>";
	printPieCharts($heroStats, $vilStats, $powStats);	

	// Display the statistics of the survey
	echo "<h2>Here is what the surveyers have said:</h2><table class =\"table table-bordered table-striped\">";
	echo "<thead><tr><td>Favorite Hero</td><td>Favorite Villain</td><td>Favorite Powers</td><td>Original Hero</td>";
	echo "<td>Original Villain</td></tr></thead>";
	for($sub = 0; $sub < count($surveyData["hero"]); $sub++) {		   
		 echo "<tr>";
		 echo "<td>" . $surveyData["hero"][$sub]     . "</td>" .
		      "<td>" . $surveyData["vil"][$sub]      . "</td>" .
		      "<td>" . $surveyData["powerOne"][$sub] . ", " .
		      $surveyData["powerTwo"][$sub] . ", " .
		      $surveyData["powerThr"][$sub] . "</td>" .
		      "<td>" . $surveyData["cHero"][$sub]    . "</td>" .
		      "<td>" . $surveyData["cVil"][$sub]     . "</td>";
		      echo "</tr>";
	}
	echo "</table>";
	echo "</div></div>";
	printHeroFooter();
?>