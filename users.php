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
	  <?php
	     require('page.php');
	     headerLogin();
	     ?>
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
