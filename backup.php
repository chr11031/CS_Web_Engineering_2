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

	$tempHero = "";
	$tempVil = "";
	$tempPowers = array("", "", "");
	$tempCustomHero = "";
	$tempCustomVil = "";

	$heroStats = array(
	      "batman"   => 0,
	      "superman" => 0,
	      "aquaman"  => 0,
	      "spiderman"=> 0,
	      "iron man" => 0,
	      "punisher" => 0,
	      "flash"    => 0,
	      "thor"     => 0,
	      "hulk"     => 0);
	$vilStats = array(
	      "doctor doom" => 0,
	      "whiplash"    => 0,
	      "lex luthor"  => 0,
	      "red hulk"    => 0,
	      "venom"       => 0,
	      "bane"        => 0,
	      "doomsday"    => 0,
	      "green goblin"=> 0,
	      "the joker"   => 0);
	$powStats = array(
	      "flying"      => 0,
	      "telekenisis" => 0,
	      "storm powers"=> 0,
	      "time regression" =>0,
	      "fire powers" => 0,
	      "ice powers"  => 0,
	      "s strength" => 0,
	      "s intelligence"=>0);

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
		  
		  /*
		  switch($tempHero) {
		    case "Batman":
		      ++$heroStats["batman"];
		      break;
		    case "Superman":
		      ++$heroStats["superman"];
		      break;
		    case "Aquaman":
		      ++$heroStats["aquaman"];
		      break;
		    case "Spiderman":
		      ++$heroStats["spiderman"];
		      break;
		    case "Iron Man":
		      ++$heroStats["iron man"];
		      break;
		    case "The Punisher":
		      ++$heroStats["punisher"];
		      break;
		    case "Flash":
		      ++$heroStats["flash"];
		      break;
		    case "Thor":
		      ++$heroStats["thor"];
		      break;
		    case "Hulk":
		      ++$heroStats["hulk"];
		      break;		    
		  }

		  switch($tempVil) {
		    case "Doctor Doom":
		      ++$vilStats["doctor doom"];
		      break;
		    case "Whiplash":
		      ++$vilStats["whiplash"];
		      break;
		    case "Lex Luthor":
		      ++$vilStats["lex luthor"];
		      break;
		    case "Red Hulk":
		      ++$vilStats["red hulk"];
		      break;
		    case "Venom":
		      ++$vilStats["venom"];
		      break;
		    case "Bane":
		      ++$vilStats["Bane"];
		      break;
		    case "Doomsday":
		      ++$vilStats["doomsday"];
		      break;
		    case "Green Goblin":
		      ++$vilStats["green goblin"];
		      break;
		    case "The Joker":
		      ++$vilStats["the joker"];
		      break;		    
		  }
		  
		  for($i = 0; $i < 3; $i++) {
		   switch($tempPowers[i]) {
		    case "Flying":
		      ++$powStats["flying"];
		      break;
		    case "Telekenisis":
		      ++$powStats["telekenisis"];
		      break;
		    case "Storm Powers":
		      ++$powStats["storm powers"];
		      break;
		    case "Time Regression":
		      ++$powStats["time regression"];
		      break;
		    case "Fire Powers":
		      ++$powStats["fire powers"];
		      break;
		    case "Ice Powers":
		      ++$powStats["ice powers"];
		      break;
		    case "Super Strength":
		      ++$powStats["s strength"];
		      break;
		    case "Super Intelligence":
		      ++$powStats["s intelligence"];
		      break;
		   }
		  } */
 
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
	// Calculate our relative pi portions of the user's inputs
	for($i = 0; $i < 9; $i++) {
	  $heroStats[$i] = ($heroStats[$i] / $count) * 360.0;
	  $vilStats[$i]  = ($vilStats[$i]  / $count) * 360.0;
	  echo "<h1>" . $heroStats[$i]. "</h1>";	
	}

	for($i = 0; i < 8; $i++) {
	  $powStats[$i] = ($powStats[$i] / ($count * 3)) * 360.0;
	}

	fclose($myFile);
	require("format.php");	
	printHeroHeader();
	echo "<div class = \"container-fluid\"><div class = \"jumbotron\">";

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