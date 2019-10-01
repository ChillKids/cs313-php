function Clicked(){
    alert("Clicked!");
}

function changeColor(){
    var color = document.getElementById("color").value;
    $("#first").css("background-color", color);
}

$(document).ready(function(){
    $("#fade").click(function(){
      $("#third").fadeToggle();
    });
  });