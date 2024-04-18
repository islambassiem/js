<?php
include_once 'connect.php';
$stmt = $conn->prepare("SELECT * FROM users ORDER BY rand()");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" href="main.css" />
	<link rel="stylesheet" href="timer.css" />
</head>

<body>
	<div class="upper">
		<div class=round><input type=checkbox id=onoff name=onoff checked />
			<div class=back><label class=but for=onoff><span class=on>Start</span><span class=off>Stop</span></label></div>
		</div>
		<button id="start">Start</button>
		<button id="stop">Stop</button>
	</div>
	<div class="wrapper">
		<div class="name" id="placeholder">Next Lucky Winner</div>
		<div class="names" id="names">
			<?php
			foreach ($rows as $name) {
				echo "<div class='name'>$name->user_name</div>";
			}
			?>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="main.js"></script>
	<!-- <script src="timer.js"></script> -->
	<!-- <script>
		var clear;
		var current = 1;
		var height = $('.names').height();
		var numNames = $('.names').children().length;
		var first = $('.names div:nth-child(1)');
		var horror = new Audio('audio/action.mp3');
		var suspense = new Audio('audio/suspense.mp3');
		var congrats = new Audio('audio/congrats.mp3');
		var crowd = new Audio('audio/crowd.mp3');
		document.getElementById('start').addEventListener('click', () => {
			document.getElementById('placeholder').style.display = 'none';
			document.getElementById('names').style.display = 'block';
			clear = setInterval(() => {
				var number = current * -height;
				first.css('margin-top', number + 'px');
				if (current == numNames) {
					first.css('margin-top', '0px');
					current = 1;
				} else current++;
			}, 100);
			setTimeout(() => {
				stop();
			}, 10000);
		});

		document.getElementById('stop').addEventListener('click', () => {
			clearInterval(clear);
			let interval = setInterval(() => {
				var number = current * -height;
				first.css('margin-top', number + 'px');
				if (current == numNames) {
					first.css('margin-top', '0px');
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
			document.getElementById('stop').click();
			document.querySelector('input').checked = 'false';
			horror.pause();
			horror.currentTime = 0;
			suspense.play();
		}

		let input = document.querySelector('input');
		input.addEventListener('click', function() {
			if (this.checked) {
				stop()
			} else {
				document.getElementById('start').click();
				horror.play();
			}
		});

		var timeleft = 10;
		var downloadTimer = setInterval(function() {
			if (timeleft <= 0) {
				clearInterval(downloadTimer);
			}
			document.getElementById("progressBar").value = 10 - timeleft;
			timeleft -= 1;
		}, 1000);
	</script> -->
</body>

</html>