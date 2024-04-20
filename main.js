var clear;
var current = 1;
var height = $(".names").height();
var numNames = $(".names").children().length;
var first = $(".names div:nth-child(1)");
var horror = new Audio("audio/action.mp3");
var suspense = new Audio("audio/suspense.mp3");
var congrats = new Audio("audio/congrats.mp3");
var crowd = new Audio("audio/crowd.mp3");
var names = $('.names').children();
var box = document.getElementById('box');
var secondsAfterStop = 5;
let timerLoop;
var winnerIndex;
var time = 20;
let timer = document.querySelector('.timer');
timer.innerHTML = time;
const semicircles = document.querySelectorAll('.semicircle');

document.getElementById("start").addEventListener("click", () => {
  document.getElementById("placeholder").style.display = "none";
  document.getElementById("names").style.display = "block";
	timerLoop = setInterval(function() {
		time--;
		console.log(time);
		let angle = (time / 20) * 360;
		if(angle > 180){
			semicircles[0].style.transform = 'rotate(180deg)';
			semicircles[1].style.transform = `rotate(${angle}deg)`;
			semicircles[2].style.display = 'none';
		}else{
			semicircles[0].style.transform = `rotate(${angle}deg)`;
			semicircles[1].style.transform = `rotate(${angle}deg)`;
			semicircles[2].style.display = 'block';
		}
		timer.innerHTML  = `<div>${time.toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false})}</div>`;
		if(time <= 0){
			clearInterval(timerLoop);
			semicircles[0].style.display = 'none';
			semicircles[1].style.display = 'none';
			semicircles[2].style.display = 'none';
		}
		if(time <= 5){
			semicircles[0].style.backgroundColor = "red";
			semicircles[1].style.backgroundColor = "red";
			timer.style.color = "red";
		}
	}, 1000);
  clear = setInterval(() => {
    var number = current * -height;
    first.css("margin-top", number + "px");
    if (current == numNames) {
      first.css("margin-top", "0px");
      current = 1;
    } else current++;
  }, 100);
	setTimeout(() => {
		if(!document.querySelector("input").checked){
			stop();
		}
	}, time * 1000);
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
		setTimeout(() => {
			congrats.play();
		}, 1500);
    setTimeout(() => {
      crowd.play();
    }, 2000);
  }, secondsAfterStop * 1000);
});

function stop() {
  document.getElementById("stop").click();
  document.querySelector("input").checked = "false";
  horror.pause();
  horror.currentTime = 0;
  suspense.play();
	winnerIndex = parseInt(names[0].style.marginTop.substring(1).replace("px", "")) / height + secondsAfterStop;
	box.classList.add('open');
	setTimeout(() => {
		names[winnerIndex].classList.add('winner', 'go-inside');
		for (let winnerIndex = 0; winnerIndex < names.length; winnerIndex++) {
			if(names[winnerIndex].classList.contains('go-inside')) continue;
			names[winnerIndex].style.display = 'none';
		}
	}, 20000);
	setTimeout(() => {
		crowd.pause();
		box.classList.remove('open');
		document.querySelector('.refresh').style.display = 'flex';
		document.querySelector('.board').style.marginTop = '0px';
	}, 22000);
	clearInterval(timerLoop);
	timer.innerHTML  = `<div>00</div>`;
	timer.style.color = 'red';
	semicircles[0].style.display = 'none';
	semicircles[1].style.display = 'none';
	semicircles[2].style.display = 'none';
	console.log(names[winnerIndex]);
}

document.querySelector("input").addEventListener("click", function () {
  if (this.checked) {
    stop();
  } else {
    document.getElementById("start").click();
    horror.play();
  }
});

document.querySelector('.refresh').addEventListener('click', function(){
	location.reload();
});