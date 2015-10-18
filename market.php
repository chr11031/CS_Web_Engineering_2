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
	<h1><span id = "real-t">REAL-T</span> Marketplace</h1>
      </div>		
    </div>
    <div class = "container-fluid">
      <div class = "jumbotron" id="houseBody">	
	<h2><b>YOUR</b> Options:</h2>	
 	      <?php
	      try
	      {
	      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      $db = new PDO("mysql:host=$host:$port;dbname=housing", $user, $password);


	      $queryString = 'SELECT count(*) FROM market LEFT Join properties on market.prop_id = properties.prop_id left join users on market.user_id = users.user_id';
	      $result = $db->prepare($queryString);
	      $result->execute();
	      $firstRow = $result->fetchColumn();	      
	      if($firstRow == 0) {
	        echo "<h1 id = \"indent\">There are no houses on the market at the moment</h1>";
	      }
	      else {
	      	   echo "<table class = \"table table-bordered\">";
	      	   echo "<thead id = \"houseTable\"><tr id = \"houseTable\">
	            <td id = \"houseTable\">Title</td>
		    <td id = \"houseTable\">Location</td>
		    <td id = \"houseTable\">Image</td>
		    <td id = \"houseTable\">Price</td>
		    <td id = \"houseTable\">Owner</td>
		    <td id = \"houseTable\">Description</td>
		    <td id = \"houseTable\">Phone/Email</td>
		    </tr></thead><tbody id = \"houseTable\">";

	      	    $statement = $db->query('SELECT properties.title, properties.address, properties.town, properties.state, properties.sq_ft, properties.photo_url, properties.description, users.name, users.username, users.email, users.phone, market.price FROM market LEFT Join properties on market.prop_id = properties.prop_id left join users on market.user_id = users.user_id');
	      	    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { 	
	      	    	    echo "<tr id = \"houseTable\"><td id = \"houseTable\">" . $row['title'] . "<br/><br/><a href = \"purchase.php\"><button class = \"btn btn-success\">BUY NOW!</button></a></td><td>" .  
			    $row['address'] . ', ' . $row['town'] . ', <strong>' . $row['state'] . 
			    "</strong></td><td><img src=\"" . 
		            $row['photo_url'] . "\" width=\"180px\" height=\"120px\">" . 
		            "</td><td>$" . 
		            $row['price'] . 
		            "</td></strong><td id = \"houseTable\">" . 
		            $row['name'] . ' - (user ' . $row['username'] . ')' . 
		            "</td><td id = \"houseTable\">" .
			    $row['description'] .
			    "</td><td id = \"houseTable\">" .
		            $row['phone'] .' / ' . $row['email'] .  "<br/><br/><a href = \"contact.php\"><button class =\"btn btn-info\">CONTACT!</button></a>" .
		            "</td></tr>";
	      	      }
		      echo "</tbody></table>";
		  }
	      }
	      catch (PDOException $ex) 
	      {
	      echo 'Error!: ' . $ex->getMessage();
	      die(); 
	      }
	      ?>
      </div>
    </div>
  </body>
</html>
