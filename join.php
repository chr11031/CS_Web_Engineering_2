<!DOCTYPE html>
<html>
  <head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <title>Sign-up For an account!</title>
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
	<div class = "well" id = "regularText">
	<h1>Sign up today!</h1><br/>
	<script>
	  function formIsValid() {
	  var user= document.getElementById("desiredUsernameVar").value;
	  var name = document.getElementById("nameVar").value;
	  var pass = document.getElementById("passVar").value;
	  var email = document.getElementById("emailVar").value;
	  var phone = document.getElementById("phoneVar").value;
	  var balance = document.getElementById("balanceVar").value;
	  
	  if((user == "") ||
          (name == "") ||
          (pass == "") ||
          (email == "") ||
	  (balance == "") ||
          (phone == "")) {
	  alert(user);
	  alert("Please fill out all fields to sign up for an account");
	  return false;
	  }
	  else
	  return true;
	  }
	</script>
	<form action = "newAccount.php" onsubmit ="return formIsValid();" method = "POST">
	<div class ="pull-right">
	  <img src = "http://static.tumblr.com/f0cc6b63fb57f13b04159393fda34fc2/eb1pxv3/XYDmr7qf3/tumblr_static_fallout_3_vault_boy_by_tylertut.png" width="400px" height="400px"></img>
	</div>
	<div class = "form-group">
	<label for="usr">Username:</label>
	<input id = "desiredUsernameVar" name = "desiredUsername" class ="form-control" style="max-width:250px" type = "text">
	<br/>
	<label for="name">Name:</label>
	<input id = "nameVar" name = "name" class ="form-control" style="max-width:250px" type = "text">
	<br/>
	<label for="email">Email:</label>
	<input id = "emailVar" name = "email" class ="form-control" style="max-width:250px" type = "text">
	<br/>
	<label for="pass">Password:</label>
	<input id = "passVar" name = "pass" class ="form-control" style="max-width:250px" type = "password">
	<br/>
	<label for="phone">Phone:</label>
	<input id = "phoneVar" name = "phone" class ="form-control" style="max-width:250px" type = "text">
	<br/>
	<label for="balance">Account Balance:</label>
	$<input id = "balanceVar" name = "balance" class ="form-control" style="max-width:250px" type = "number">
	<br/>
	<button class = "btn btn-primary">Sign-up!</button>
	</form>	
	</div>
      </div>		
    </div>
  </body>
</html>
