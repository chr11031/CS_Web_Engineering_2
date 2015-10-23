<!DOCTYPE html>
<html>
  <head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <title>Your Account</title>
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
	     if($_SESSION["realty_status"] == "Visitor")
	       header("Location: realty.php");
	     update();
	     ?>
</div>
    </div>
    <div class = "container-fluid">
      <div class = "jumbotron" id="houseBodyOpaque">
	    <script>
	      function formCheck() {
	        if(document.getElementById("salePriceVar").value < 1.00) {
		 alert("Selling value must be a least 1 dollar");
	         return false;
		}
	        var boxes = document.getElementsByName('myHousesBox[]');
	        for(var i = 0; i < boxes.length; i++) {
		  if(boxes[i].checked) {
		    return true;
		  }
	        }
	        alert("You must select at least one property to purchase");
	        return false;
	      }
	</script>
	<h1><?php echo $_SESSION["name"];?>'s Page </h1>
	<h1><span style="color:#62DA1D; text-align:right;">Balance: $
	  <?php echo $_SESSION["balance"] ?>
	  </span></h1>
	<h2>Your Properties include</h2>
	<?php
	      try
	      {
	      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	      $user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	      $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

	      // Delete this for openshift
	      $user = "root";
	      $password = "";	      

	      $db = new PDO("mysql:host=127.0.0.1;dbname=housing", $user, $password);

	      $input = $_SESSION['username'];
	      
	      // Get the user_id of the user we are querying for
	      $queryString = 'SELECT user_id FROM users WHERE username ' . "='" . $input . "'";
	      $result = $db->query($queryString);
	      $temp = $result->fetch(PDO::FETCH_ASSOC);
	      $input = $temp['user_id'];	      	    
	      if($input == "")
	      {
		echo "<h3 id = \"indent\">No matches found.</h3>";	       
	      }

	      //Querying the database
	      $queryString = 'SELECT COUNT(*) FROM properties WHERE user_id ' . "='" . $input . "'";
	      $result = $db->prepare($queryString);
	      $result->execute();
	      $firstRow = $result->fetchColumn();	      
	      $USD = '$USD';
	      if($firstRow == 0) {
		echo "<h3 id = \"indent\">This user owns no properties.</h3>";
	      }	      
	      else {
	      	$queryString = 'SELECT * FROM properties WHERE user_id ' . "='" . $input . "'";
		$result = $db->query($queryString);
	      	echo "<form method=\"POST\" onsubmit=\"return formCheck();\" action =\"addToMarket.php\"><table class = \"table table-bordered\"  id = \"houseTable\"";
     	        echo "<thead><tr id = \"houseTable\"><td  id = \"houseTable\">Title</td><td  id = \"houseTable\">Address, Town, & State</td><td id = \"houseTable\">SQ FT</td><td id = \"houseTable\">Photo</td><td id = \"houseTable\">Description</td></tr></thead>";
	        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		      echo "<tr id = \"houseTable\"><td id = \"houseTable\">" .  $row['title'] . "<br/><br/>For Sale? (yes): <input name =\"myHousesBox[]\" type = \"radio\"value = \"" . $row['prop_id'] . "\">" .
		       "</td><td id = \"houseTable\">" .
		       $row['address'] . ', ' . $row['town'] .', ' . $row['state'] . 
		       "</td><td id = \"houseTable\">" .
		       $row['sq_ft'] .
		       "</td><td id = \"houseTable\"><img src=\"" .
                       $row['photo_url'] . "\" width=\"180px\" height=\"120px\">" .
		       "</td><td id = \"houseTable\">" .
		       $row['description'] . 
		       "</td></tr>";
		       }
	        echo '</table>';
		echo "Selling price of house <input type = \"number\" style=\"color: black\" id=\"salePriceVar\" name = \"salePrice\"><br/><br/>";
                echo "<button type=\"submit\"class = \"btn btn-primary\"  name = \"market_choice\">Put the selected house on the market</button></form><br/>";

	        }
              }
	      catch (PDOException $ex) 
	      {
	      alert("EXCEPTION ERROR");
	      die(); 
	      }
	      ?>
	<br/>
	<h2>Add another property</h2>
	<div class = "well" id = "regularText">
	<script>
	  function formIsValid() {
	  var title= document.getElementById("titleVar").value;
	  var addr = document.getElementById("addressVar").value;
	  var town = document.getElementById("townVar").value;
	  var state = document.getElementById("stateVar").value;
	  var sq_ft = document.getElementById("photoVar").value;
	  var photo = document.getElementById("photoVar").value;
	  var description = document.getElementById("descriptionVar").value;	  

	  if((title == "") ||
          (addr == "") ||
          (town == "") ||
          (state == "") ||
	  (sq_ft == "") ||
	  (photo == "") ||
          (description == "")) {
	    alert("Please fill out all fields to sign up for an account");
	  return false;
	  }
	  else {
	  return true;
	  }
	  }
	</script>
	<div class="row" style="margin-left: 0.3cm">
	</div>
	<div class ="pull-right">
	  <img src = "https://cdn2.iconfinder.com/data/icons/pittogrammi/142/65-512.png" style="margin-top:1cm"width="270px" height="270px"></img>
	  </div>
	<form action = "addProperty.php" class ="form-inline" onsubmit ="return formIsValid();" method = "POST">
	<div style="margin-left: 0.3cm">
	  <div>
	<label for="title">Title:</label>
	<input id = "titleVar" name = "title" class ="form-control" style="width:450px" type = "text">
	  </div>
	<br/>
	<div>
	<label for="address">Address:</label>
	<input id = "addressVar" name = "address" class ="form-control" style="max-width:120px" type = "text">
	<label for="town">Town:</label>
	<input id = "townVar" name = "town" class ="form-control" style="max-width:120px" type = "text">

	<label for="state">State:</label>
	<select id = "stateVar" name = "state" class ="form-control" style = "max-width: 65px"> 
	  <option value = "AL">AL</option>
	  <option value = "AK">AK</option>
	  <option value = "AZ">AZ</option>
	  <option value = "AR">AR</option>
	  <option value = "CA">CA</option>
	  <option value = "CO">CO</option>
	  <option value = "CT">CT</option>
	  <option value = "DE">DE</option>
	  <option value = "FL">FL</option>
	  <option value = "GA">GA</option>
	  <option value = "HI">HI</option>
	  <option value = "ID">ID</option>
	  <option value = "IL">IL</option>
	  <option value = "IN">IN</option>
	  <option value = "IA">IA</option>
	  <option value = "KS">KS</option>
	  <option value = "KY">KY</option>
	  <option value = "LA">LA</option>
	  <option value = "ME">ME</option>
	  <option value = "MD">MD</option>
	  <option value = "MA">MA</option>
	  <option value = "MI">MI</option>
	  <option value = "MN">MN</option>
	  <option value = "MS">MS</option>
	  <option value = "MO">MO</option>
	  <option value = "MT">MT</option>
	  <option value = "NE">NE</option>
	  <option value = "NV">NV</option>
	  <option value = "NH">NH</option>
	  <option value = "NJ">NJ</option>
	  <option value = "NM">NM</option>
	  <option value = "NY">NY</option>
	  <option value = "NC">NC</option>
	  <option value = "ND">ND</option>
	  <option value = "OH">OH</option>
	  <option value = "OK">OK</option>
	  <option value = "OR">OR</option>
	  <option value = "PA">PA</option>
	  <option value = "RI">RI</option>
	  <option value = "SC">SC</option>
	  <option value = "SD">SD</option>
	  <option value = "TN">TN</option>
	  <option value = "TX">TX</option>
	  <option value = "UT">UT</option>
	  <option value = "VT">VT</option>
	  <option value = "VA">VA</option>
	  <option value = "WA">WA</option>
	  <option value = "WV">WV</option>
	  <option value = "WI">WI</option>
	  <option value = "WY">WY</option>	  
	</select>
	</div>
	<br/>
	<div>
	<label for="sq_ft">Square Feet:</label>
	<input id = "sq_ftVar" name = "sq_ft" class ="form-control" style="max-width:120px" type = "number">
	<label for="photo">Photo URL:</label>
	<input id = "photoVar" name = "photo" class ="form-control" style="max-width:200px" type = "text">
	</div>
	<br/>
	<div>
	<label for="description">Tell us about your realty</label><br/>
	<textarea id = "descriptionVar" style="width: 500px"name = "description" class ="form-control"></textarea>
	</div><br/>
	<button class = "btn btn-primary">Add Property!</button>
	</form>	
	</div>
      </div>		
      </div>		
    </div>
  </body>
</html>
