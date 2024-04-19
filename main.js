var clear;
var current = 1;
var height = $(".names").height();
var numNames = $(".names").children().length;
var first = $(".names div:nth-child(1)");
var horror = new Audio("audio/action.mp3");
var suspense = new Audio("audio/suspense.mp3");
var congrats = new Audio("audio/congrats.mp3");
var crowd = new Audio("audio/crowd.mp3");



document.getElementById("start").addEventListener("click", () => {
  document.getElementById("placeholder").style.display = "none";
  document.getElementById("names").style.display = "block";
  clear = setInterval(() => {
    var number = current * -height;
    first.css("margin-top", number + "px");
    if (current == numNames) {
      first.css("margin-top", "0px");
      current = 1;
    } else current++;
  }, 500);
  setTimeout(() => {
    stop();
  }, 20000);
});

document.getElementById("stop").addEventListener("click", () => {
  clearInterval(clear);
  let interval = setInterval(() => {
    var number = current * -height;
    first.css("margin-top", number + "px");
    if (current == numNames) {
      first.css("margin-top", "0px");
      current = 1;
    } else current++;
  }, 1000);
  setTimeout(() => {
    clearInterval(interval);
    suspense.pause();
    suspense.currentTime = 0;
    congrats.play();
    setTimeout(() => {
      crowd.play();
    }, 2000);
  }, 5000);
});

function stop() {
  document.getElementById("stop").click();
  document.querySelector("input").checked = "false";
  horror.pause();
  horror.currentTime = 0;
  suspense.play();
}

document.querySelector("input").addEventListener("click", function () {
  if (this.checked) {
    stop();
  } else {
    document.getElementById("start").click();
    horror.play();
  }
});

