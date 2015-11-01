<?php
	function outputJQUERY() {
	echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>";
	}

	function update() {
	  	try {
	      $user = "root";
	      $password = "";
	      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      
	      $userInput = $_SESSION['username'];
	      $queryString = "SELECT * FROM users WHERE username = (?)";
	      
	      $mysqli = new mysqli($host, $user, $password, "housing", $port);
	      $stmt = $mysqli->prepare($queryString);
	      $stmt->bind_param("s", $userInput);
	      $stmt->execute();
	      
	      $stmt->bind_result($var1, $var2, $var3, $var4, $var5, $var6, $var7);
	      if($stmt->fetch()) {
	      $_SESSION['name'] = $var2;
	      $_SESSION['balance'] = $var5;
	      }
	      else
		  echo "There was an unidentified user error";
	      }
	      catch(Exception $e) {
	        echo "There was an unidentified database error";
	      }

	      $stmt->close();
	      $mysqli->close();
	}
	function headerLogin() {
	     outputJQUERY();
	     session_start();
   	     if(!isset($_SESSION["realty_status"])) {
     	       $_SESSION["realty_status"] = "Visitor";
	     }
	     else {	
     	       if($_SESSION["realty_status"] != "Member") {
	       echo "	<div class =\"navbar-header\">
	       	  <a href =\"realty.php\" class = \"navbar-brand\" id=\"real-t\">REAL-T</a>	
	  	  <ul class = \"nav navbar-nav\">
	  	  <li id=\"news\" onmouseover=\"onHouse('news','houseLink1')\" onmouseout=\"offHouse('news','houseLink1')\">
	    	  <a id = \"houseLink1\" href =\"realty.php\">News</a></li>
	  <li id=\"marketplace\" onmouseover=\"onHouse('marketplace','houseLink2')\" onmouseout=\"offHouse('marketplace','houseLink2')\">
	        <a id = \"houseLink2\" href =\"market.php\">Marketplace</a></li>
	  	<li id =\"users\" onmouseover=\"onHouse('users','houseLink3')\" onmouseout=\"offHouse('users','houseLink3')\">
	    	<a id = \"houseLink3\" href =\"users.php\">Users</a></li>
	  	<li id =\"join\" onmouseover=\"onHouse('join','houseLink4')\" onmouseout=\"offHouse('join','houseLink4')\">
	    	<a id = \"houseLink4\" href =\"join.php\">Join</a></li>
	  	</ul>
	  	</div>";	       
		echo '<span id = "logStatus" style = "white-space: nowrap;" class = "navbar-form pull-right" role = "form">';
	        echo '	<div class="input-group"> 
		<span class="input-group-addon"><i class = "glyphicon glyphicon-user"></i></span>
		<input id="username" type="text" class ="form-control" name ="username">
		</div>		
	  	<div class="input-group"> 
		<span class="input-group-addon"><i class = "glyphicon glyphicon-lock"></i></span>
		<input id="password" type="password" class ="form-control" name ="password">		
		</div>
	  	<div class="input-group"> 
		<button id = "login" class = "btn btn-danger" onclick = "loginJ_function()">Sign In</button>
		</div>
		</span>'; 
	     }
	     else {
	       echo "	<div class =\"navbar-header\">
	       	  <a href =\"realty.php\" class = \"navbar-brand\" id=\"real-t\">REAL-T</a>	
	  	  <ul class = \"nav navbar-nav\">
  	  <li id=\"news\" onmouseover=\"onHouse('news','houseLink1')\" onmouseout=\"offHouse('news','houseLink1')\">
	    	  <a id = \"houseLink1\" href =\"realty.php\">News</a></li>

	  <li id=\"marketplace\" onmouseover=\"onHouse('marketplace','houseLink2')\" onmouseout=\"offHouse('marketplace','houseLink2')\">
	        <a id = \"houseLink2\" href =\"market.php\">Marketplace</a></li>

	  	<li id =\"users\" onmouseover=\"onHouse('users','houseLink3')\" onmouseout=\"offHouse('users','houseLink3')\">
	    	<a id = \"houseLink3\" href =\"users.php\">Users</a></li>

	  	<li id =\"join\" onmouseover=\"onHouse('join','houseLink4')\" onmouseout=\"offHouse('join','houseLink4')\">
	    	<a id = \"houseLink4\" href =\"myPage.php\">My Page</a></li></div>";


		echo '<span id = "logStatus" class = "navbar-form pull-right role= \"form\">';
		echo "
	  	<div class=\"input-group\"> 
	    	<span id = \"houseLinkWelcome\">Welome back " . $_SESSION["username"] . "</span></li></div>	
		<span  style=\"padding-left:0.8cm;\" ></span><button class = \"btn btn-danger\" id =\"logout\" onclick =\"outJ()\">Sign Out</button>
		</div></span>";		

		echo "
			  	</ul>
	  	</div>";	       
		echo "</div>";
	     }
	   }     
}

?>