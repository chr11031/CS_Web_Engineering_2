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
	<h1><span id = "real-t">REAL-T</span> Marketplace</h1>
      </div>		
    </div>
    <script>
      function formCheck() {

      var boxes = document.getElementsByName('houseBox[]');
      for(var i = 0; i < boxes.length; i++) {
	  if(boxes[i].checked) {
	    return true;
        }
      }
      alert("You must select at least one property to purchase");
      return false;
      }
      </script>
    <div class = "container-fluid">
      <div class = "jumbotron" id="houseBody">	
	<h2><b>YOUR</b> Options:</h2>	
 	      <?php
	      try {
              $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
              $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
              $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
              $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
              //$db = new PDO("mysql:host=$host:$port;dbname=housing", $user, $password);

	      // Delete this for openshift
	      $user = "root";
	      $password = "";	      
	      $db = new PDO("mysql:host=127.0.0.1;dbname=housing", $user, $password);

              $queryString = 'SELECT count(*) FROM market LEFT Join properties on market.prop_id = properties.prop_id left join users on market.user_id = users.user_id';
              $result = $db->prepare($queryString);
              $result->execute();
              $firstRow = $result->fetchColumn();
              if($firstRow == 0) {
                echo "<h1 id = \"indent\">There are no houses on the market at the moment</h1>";
              }	     
	          else {
	           echo "<form action=\"buyHouse.php\" method = \"POST\" onsubmit=\"return formCheck();\">";
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

		  
$statement = $db->query('SELECT market.market_id, properties.title, properties.address, properties.town, properties.state, properties.sq_ft, properties.photo_url, properties.description, users.name, users.username, users.email, users.phone, market.price FROM market LEFT Join properties on market.prop_id = properties.prop_id left join users on market.user_id = users.user_id');
	      	    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
     	    	    echo "<tr id = \"houseTable\"><td id = \"houseTable\">" . $row['title'] . "<br/><br/><input type=\"checkbox\" name =\"houseBox[]\" value = \"" . $row['market_id'] . "\"></td><td>" .  
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
		            $row['phone'] .' / ' . $row['email'] .  "<br/><br/><a href = \"https://www.gmail.com\"><button class =\"btn btn-info\">CONTACT!</a></form>" .
		            "</td></tr>";
	      	      }
		      echo "</tbody></table>";
                      echo "<button type=\"submit\"class = \"btn btn-success\"  name = \"market_choice\">BUY SELECTED HOUSES!</button></form>";
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
