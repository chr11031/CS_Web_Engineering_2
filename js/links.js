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
