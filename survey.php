<?php
   session_start();
   if(!isset($_SESSION["status"]))
     $_SESSION["status"] = "PENDING";
   else {
     if($_SESSION["status"] == "PENDING") {
       ; // do nothing
     }
     else { // status "SUBMITTED"
       header("Location: results.php"); // go to the results page
     }
   }     
?>

<!DOCTYPE html>
<html>
  <head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <title>Keyboard Cowboys</title>
    <script type="text/javascript" src = "js/links.js">
    </script>
    <!--Check out google fonts for additional styling optiolns-->  
  </head>
  <body id = "heroTexture">
    <div class = "navbar navbar-default"> 
      <div class = "container-fluid"> 
	<!--LOGO-->
	<div class ="navbar-header">
	  <a href ="index.html" class = "navbar-brand">KEYBOARD COWBOYS</a>	
	  <ul class = "nav navbar-nav">
	  <li id="home" onmouseover="on('home','link1')" onmouseout="off('home','link1')">
	    <a id = "link1" href ="index.html">Home</a></li>
	  <li id ="asgns" onmouseover="on('asgns','link2')" onmouseout="off('asgns','link2')">
	    <a id = "link2" href ="assignments.html">Assignments</a></li>
	  </ul>
	</div>
      </div>
    </div>
    <div class = "container-fluid">
      <div class = "jumbotron" id = "opaque">
	<h1>Welcome to a <span style="color:red; font-style:italic;">Super</span> Survey!</h1>
      </div>
    </div>
    <div class = "container-fluid">
      <script type ="text/javascript">
	function checkForm() {
         var numChecked = 0; 
          if(box1.checked) ++numChecked;
          if(box2.checked) ++numChecked;
          if(box3.checked) ++numChecked;
          if(box4.checked) ++numChecked;
          if(box5.checked) ++numChecked;
          if(box6.checked) ++numChecked;
          if(box7.checked) ++numChecked;
          if(box8.checked) ++numChecked;

          if(numChecked == 3)
            return true;
        alert("Please choose exactly three super powers before submitting your survey");
	return false;
      }    
      </script>
      <div class = "jumbotron">
	  <form action ="results.php" onsubmit ="return(checkForm());" method = "post">
	    <h2>Question #1: Who is your favorite superhero?</h2>
	    <table id = "paddedTable"> 
	      <tr>
		<td> <input type = "radio" name = "hero" value ="Batman" checked> Batman </td> 
		<td> <input type = "radio" name = "hero" value ="Superman"> Superman </td> 
		<td> <input type = "radio" name = "hero" value = "Aquaman"> Aquaman </td>
	      </tr>
	      <tr>
		<td> <input type = "radio" name = "hero" value = "Spiderman"> Spiderman </td> 
		<td> <input type = "radio" name = "hero" value = "Iron_Man">Iron Man </td>
		<td> <input type = "radio" name = "hero" value = "The_Punisher"> The Punisher </td>
	      </tr>
	      <tr>
		<td> <input type = "radio" name = "hero" value = "Flash"> Flash </td>
		<td> <input type = "radio" name = "hero" value = "Thor"> Thor </td>
		<td><input type = "radio" name = "hero" value = "Hulk"> Hulk </td>
	      </tr>
	    </table>
	    <br/>

	    <h2>Question #2: Who is your favorite villain?</h2>
	    <table id = "paddedTable"> 
	      <tr>
		<td><input type = "radio" name = "villain" value ="Doctor_Doom" checked> Doctor Doom</td>
		<td><input type = "radio" name = "villain" value ="Whiplash"> Whiplash</td>
		<td><input type = "radio" name = "villain" value ="Lex_Luthor"> Lex Luthor</td>
	      </tr>
	      <tr>
		<td><input type = "radio" name = "villain" value ="Red_Hulk"> Red Hulk </td>
		<td><input type = "radio" name = "villain" value ="Venom">Venom</td>
		<td><input type = "radio" name = "villain" value ="Bane"> Bane</td> 
	      </tr>
	      <tr>
		<td><input type = "radio" name = "villain" value ="Doomsday"> Doomsday</td>
		<td><input type = "radio" name = "villain" value ="Green_Goblin">Green Goblin</td>
		<td><input type = "radio" name = "villain" value ="The_Joker">The Joker</td>
	      </tr>
	    </table>
	    <br/>	    
	    <h2>Question #3: Which 3 powers would you like to have for your own abilities?</h2>
	    <table id = "paddedTable">
	      <tr>
		<td><input type = "checkbox" id = "box1" name = "powers[]" value = "Flying"> Flying </td>
		<td><input type = "checkbox" id = "box2" name = "powers[]" value = "Telekenisis"> Telekenisis </td>
		<td><input type = "checkbox" id = "box3" name = "powers[]" value = "Storm_Powers"> Storm Powers</td>
		<td><input type = "checkbox" id = "box4" name = "powers[]" value = "Time_Regression"> Time Regression </td>  
	      </tr>
	      <tr>
		<td><input type = "checkbox" id = "box5" name = "powers[]" value = "Fire_Powers"> Fire Powers </td>
		<td><input type = "checkbox" id = "box6" name = "powers[]" value = "Ice_Powers"> Ice Powers </td>
		<td><input type = "checkbox" id = "box7" name = "powers[]" value = "Super_Strength"> Super Strength </td> 
		<td><input type = "checkbox" id = "box8" name = "powers[]" value = "Super_Intelligence"> Super Intelligence </td>
	      </tr>
	    </table>
	    <br/>
	    <h2>Question #4: What would you name your original hero?</h2>
	    <input id = "heroField" type = "text" name = "customHero" required>
	    <br/>
	    <h2>Question #5: Your original villain?</h2>
	    <input id = "vilField" type = "text" name = "customVil" required> <br/><br/>
 	    <button type = "submit" class ="btn btn-info">Submit</button>
	    <a href ="results.php"><button type = "button" class ="btn btn-info">See Results</button> </a>
	  </form>		
      </div>
    </div>    
  </body>
</html>
