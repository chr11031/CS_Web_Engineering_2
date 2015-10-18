<?php
   session_start();
   if(!isset($_SESSION["realty_status"]))
     $_SESSION["realty_status"] = "Visitor";
   else {
     if($_SESSION["realty_status"] == "Member") {
        //header("Location: results.php"); // DO SOMEThing else...
     }
   }     
?>

<!DOCTYPE html>
<html>
  <head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <title>REAL-T Market</title>
    <script type="text/javascript" src = "js/links.js">
    </script>
    <!--Check out google fonts for additional styling optiolns-->  
  </head>
  <body id = "houseTexture">
    <div class = "navbar navbar-default" id="houseBar">  
      <div class = "container-fluid"  id="housecontainer"> 
	<!--LOGO-->
	<div class ="navbar-header">
	  <a href ="realty.php" class = "navbar-brand" id="real-t">REAL-T</a>	
	  <ul class = "nav navbar-nav">
	  <li id="news" onmouseover="onHouse('news','houseLink1')" onmouseout="offHouse('news','houseLink1')">
	    <a id = "houseLink1" href ="realty.php">News</a></li>
	  <li id="marketplace" onmouseover="onHouse('marketplace','houseLink2')" onmouseout="offHouse('marketplace','houseLink2')">
	    <a id = "houseLink2" href ="market.php">Marketplace</a></li>
	  <li id ="users" onmouseover="onHouse('users','houseLink3')" onmouseout="offHouse('users','houseLink3')">
	    <a id = "houseLink3" href ="users.php">Users</a></li>
	  <li id ="join" onmouseover="onHouse('join','houseLink4')" onmouseout="offHouse('join','houseLink4')">
	    <a id = "houseLink4" href ="join.php">Join</a></li>
	  </ul>
	</div>
      </div>
    </div>
    <div class = "container-fluid">
      <div class = "jumbotron" id="houseBodyOpaque">
	<h1><span id = "real-t">REAL-T</span> Look-Ups</h1>
	<h2>User Information</h2>
	<p>Search the directory below to find users by name, username, or email.</P>
	<form action = "dir.php" method = "POST">
	<input name = "search" id = "regularText" type = "text">
	<select name = "method" id = "regularText">
	<option value="username">username</option>
	<option value="name">name</option>
	<option value="email">email</option>
	<option value="phone">phone</option>
	</select>
	<button class = "btn btn-primary" type="submit">Search</button>
	</form>	
	<br/>
	<br/>
	<h2>User Properties</h2>
	<p>Look up a user's realty property by their username</P>
	<form action = "prop.php" method = "POST">
	<input name = "searchById" id = "regularText" type = "text">
	<button class = "btn btn-primary" type="submit">Search</button>
	</form>	
	<div id = "results"></div>
      </div>		
    </div>
  </body>
</html>
