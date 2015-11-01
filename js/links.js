function on(box, text) {
    document.getElementById(box).style.backgroundColor = "#555555";
    document.getElementById(text).style.color = "#D9D9D9";
}
function off(box, text) {
    document.getElementById(box).style.backgroundColor = "#E7E7E7";
    document.getElementById(text).style.color = "#555";
}

function onHouse(box, text) {
    on(box,text);
}
function offHouse(box, text) {
    document.getElementById(box).style.backgroundColor = "#1F1F1F";
    document.getElementById(text).style.color = "white";
}

function loggedIn() {
    $rv;
    $.post("logStatus.php", function(data, status) {
	if(data == "logged-in") {
	    $rv = "yes";
	}
	else {
	    $rv = "no";
	}
    });    
    return $rv;
}

// Under maintenance...
function available() {
    var userInput = $("#desiredUsernameVar").val();
    var arr = {}; 
    $available_rv = "no"; 
    arr['username'] = userInput;
    $.post("available.php", arr, function(data, status) {
	if(data == "yes") {
	    $available_rv = "yes";
	}
	else {
	    $available_rv = "no";
	}
    });
    return $available_rv;
}


function outJ() {
    $.post("logout.php", function(data, status) {
	history.go(0);
    });    
}

function loginJ_function() {
    var userInput = $("#username").val();
    var passInput = $("#password").val();
    var arr = {};
    arr['username'] = userInput;
    arr['password'] = passInput;
    $.post("http://php-dwc3993.rhcloud.com/login.php", arr, function(data, status) {
	var logoutBox = '<div class="input-group"><span id = "houseLinkWelcome">Welome back ' + data + '</span></li></div><span  style="padding-left:0.8cm;" ></span><button id = "logout" class = "btn btn-danger" id ="logout" onclick="outJ()">Sign Out</button>';
	if(data == "Invalid Login") {
	    alert("ERROR: Please try a different password/email");
	    return;
	}
	else if(status == "success" && location.pathname.substring(1) == "join.php")
	    window.location = "http://php-dwc3993.rhcloud.com/myPage.php";
	else if(status == "success") {
	    $("#logStatus").html(logoutBox);
	}
	else
	    alert("Invalid username/password");
    });
}

