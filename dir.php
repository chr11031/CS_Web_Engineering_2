<?php
   if($_POST['search'] == '') 
   header("Location: users.php");
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
      <div class = "jumbotron" id="houseBody">	
	<h2><b>Matching Results</b>:</h2>	
 	      <?php
	      try
	      {
	      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

	      $db = new PDO("mysql:host=$host:$port;dbname=housing", $user, $password);

	      $condition = $_POST['method'];
	      $input = $_POST['search'];

	      $queryString = 'SELECT COUNT(*) FROM users WHERE ' . $condition . "='" . $input . "'";
	      $result = $db->prepare($queryString);
	      $result->execute();
	      $firstRow = $result->fetchColumn();	      

	      if($firstRow == 0) {
		echo "<h3 id = \"indent\">No matches found.</h3>";
	      }	      
	      else {
	      	$queryString = 'SELECT * FROM users WHERE ' . $condition . "='" . $input . "'";
		$result = $db->query($queryString);

	      	echo "<table class = \"table\" id = \"houseTable\">";
     	        echo "<thead id = \"houseTable\">
		     <tr id = \"houseTable\">
		     <td>Name</td><td id = \"houseTable\">Username</td>
		     <td id = \"houseTable\">Email</td>
		     <td id = \"houseTable\">Phone</td></tr></thead>
		     <tbody id=\"houseTable\">";
	        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		      echo "<tr id = \"houseTable\"><td id = \"houseTable\">" . 
		       $row['name'] . 
		       "</td><td id = \"houseTable\">" . 
		       $row['username'] . 
		       "</td><td id = \"houseTable\">" . 
		       $row['email'] . 
		       "</td><td id = \"houseTable\">" .
		       $row['phone'] . 
		       "</td></tr>";
		       }
	        echo '</tbody></table>';
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
