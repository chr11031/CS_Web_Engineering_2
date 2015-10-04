<?php
function printHeroHeader() {
	 echo "<!DOCTYPE html> <html>
	 <head>
	 <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">
	 <link href=\"css/custom.css\" rel=\"stylesheet\">
	 <title>Keyboard Cowboys</title>
	 <script type=\"text/javascript\" src = \"js/links.js\"></script>
	 <!--Check out google fonts for additional styling optiolns-->  
	 </head>
	 <body id = \"heroTexture\">
	 <div class = \"navbar navbar-default\"> 
	 <div class = \"container-fluid\"> 
	 <!--LOGO-->
	 <div class =\"navbar-header\">
	 <a href =\"index.html\" class = \"navbar-brand\">KEYBOARD COWBOYS</a>	
	 <ul class = \"nav navbar-nav\">
	 <li id=\"home\" onmouseover=\"on('home','link1')\" onmouseout=\"off('home','link1')\">
	 <a id = \"link1\" href =\"index.html\">Home</a></li>
	 <li id =\"asgns\" onmouseover=\"on('asgns','link2')\" onmouseout=\"off('asgns','link2')\">
	 <a id = \"link2\" href =\"assignments.html\">Assignments</a></li>
	 </ul>
	 </div>
	 </div>
	 </div>
	 <div class = \"container-fluid\">
	 <div class = \"jumbotron\" id = \"opaque\">
	 <h1><span style=\"color:green;\"> Hero Survey Results</span></h1>
	 </div>
	 </div>";
}	 

function printPieCharts($hData, $vData, $pData) {
echo "
  <table id = \"paddedTable\" align =\"center\">
    <tr>
      <td id =\"titleCell\"><h2>Favorite Hero</h2></td>
      <td id =\"titleCell\"><h2>Favorite Villain</h2></td>
      <td id =\"titleCell\"><h2>Favorite Power</h2></td>
    </tr>
    <tr>
      <td><canvas id =\"piechart1\" class = \"spacious\" width = \"250\" height = \"250\"></canvas> </td> 
      <td><canvas id =\"piechart2\" class = \"spacious\" width = \"250\" height = \"250\"></canvas> </td>
      <td><canvas id =\"piechart3\" class = \"spacious\" width = \"250\" height = \"250\"></canvas> </td>
    </tr>
  </table>
  <script type =\"text/javascript\">
    var heroLabels = [\"Batman\", \"Superman\", \"Aquaman\",\"Spiderman\", \"Iron Man\", \"Punisher\", \"Flash\", \"Thor\", \"Hulk\"];
    var vilLabels = [\"Doctor Doom\", \"Whiplash\", \"Lex Luthor\",\"Red Hulk\", \"Venom\", \"Bane\", \"Doomsday\", \"Green Goblin\", \"The Joker\"];
    var powLabels = [\"Flying\", \"Telekenisis\", \"Storm Powers\", \"Time Regression\", 
    \"Fire Powers\", \"Ice Powers\", \"Super Strength\", \"Super Intelligence\"];
    var colors = [\"grey\", \"red\", \"blue\", \"green\", \"tan\", \"pink\", \"yellow\", \"orange\", \"aqua\"];";

    echo "var heroData = [";
    for($i = 0; $i < 8; $i++) {
      echo $hData[$i] . ", ";      
    }
    echo $hData[8] . "];";

    echo "var vilData = [";
    for($i = 0; $i < 8; $i++) {
      echo $vData[$i] . ", ";      
    }
    echo $vData[8] . "];";

    echo "var powData = [";
    for($i = 0; $i < 7; $i++) {
      echo $pData[$i] . ", ";      
    }
    echo $pData[7] . "];";
    echo "
    function degreesToRadians(degrees) {
      return(degrees * Math.PI)/180;
    }
    
    function sumTo(a, i) {
      var sum = 0;
      for(var j = 0; j < i; j++) {
	sum += a[j];
      }
      return sum;
    }

    function drawSegment(canvas, context, data, i) {
      context.save();
      var centerX = Math.floor(canvas.width/2);
      var centerY = Math.floor(canvas.height/2);
      radius = Math.floor(canvas.width/2);
    
      var startAngle = degreesToRadians(sumTo(data,i));
      var arcSize = degreesToRadians(data[i]);
      var endingAngle = startAngle + arcSize; 
      context.beginPath();
      context.moveTo(centerX, centerY);
      context.arc(centerX, centerY, radius, 
                  startAngle, endingAngle, false);
      context.closePath();
      context.fillStyle = colors[i];
      context.fill();
      context.restore();
      //drawSegmentLabel(canvas, context, labels, data, i);
    }

    function drawSegmentLabel(canvas, context, labels, data, i) {
      context.save();
      var x = Math.floor(canvas.width/2);
      var y = Math.floor(canvas.height/2);
      var angle = degreesToRadians(sumTo(data,i));
      
      context.translate(x,y);
      context.rotate(angle);
      var dx = Math.floor(canvas.width * 0.4);
      var dy = Math.floor(canvas.height* 0.4);
			 
      context.textAlign = \"right\";
      var fontSize = Math.floor(canvas.height / 25);
      context.font = fontSize + \"pt Helvetica\";      
      context.fillText(labels[i],120,15);
      context.restore();      
    }

    //First Circle
    canvas = document.getElementById(\"piechart1\");
    var context = canvas.getContext(\"2d\");
    for(var i = 0; i < heroData.length; i++) {
      drawSegment(canvas, context, heroData, i);
    }		   
    for(var i = 0; i < heroData.length; i++) {
      drawSegmentLabel(canvas, context, heroLabels, heroData, i);
    }		   
 
    //Second Circle
    canvas = document.getElementById(\"piechart2\");
    var context = canvas.getContext(\"2d\");
    for(var i = 0; i < vilData.length; i++) {
      drawSegment(canvas, context, vilData, i);
    }
    for(var i = 0; i < vilData.length; i++) {
      drawSegmentLabel(canvas, context, vilLabels, vilData, i);
    }


    //Third Circle 
    canvas = document.getElementById(\"piechart3\");
    var context = canvas.getContext(\"2d\");
    for(var i = 0; i < powData.length; i++) {
      drawSegment(canvas, context, powData, i);
    }
    for(var i = 0; i < powData.length; i++) {
      drawSegmentLabel(canvas, context, powLabels, powData, i);
    }

  </script>";
}

function printHeroFooter() {
     echo "</body></html>";
}

?>