<?php
include_once 'connect.php';


$stmt = $conn->prepare("SELECT * FROM users where active = 1 ORDER BY rand()");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_OBJ);


$n = 1;

if(isset($_GET['gift'])){
	$n = $_GET['gift'];
}

$g = $conn->prepare("SELECT * FROM gifts where id = ?");
$g->execute([$n]);
$gift = $g->fetch(PDO::FETCH_OBJ);


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Lucky Draw</title>
	<link rel="stylesheet" href="main.css" />
	<link rel="stylesheet" href="box/box.css" />
	<link rel="stylesheet" href="timer/timer.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
	<div id="matrix"></div>
	<div id="container"></div>
	<div class="upper">
		<div class="button">
			<div class=round><input type=checkbox id=onoff name=onoff checked />
				<div class=back><label class=but for=onoff><span class=on>Start</span><span class=off>Stop</span></label></div>
			</div>
			<button id="start">Start</button>
			<button id="stop">Stop</button>
		</div>
		<div class="main-container center">
			<!-- progress indicator -->
			<div class="circle-container center ">
				<div class="semicircle"></div>
				<div class="semicircle"></div>
				<div class="semicircle"></div>
				<div class="outermost-circle"></div>
			</div>
			<!-- timer -->
			<div class="timer-container center">
				<div class="timer center"></div>
			</div>
		</div>
	</div>
	<div class="refresh">
	<a href="index?gift=<?= ($n + 1)?>"><i class="fa-regular fa-hand-point-right"></i></a>
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
	<div class="board">
		<div class="box" id="box">
			<div class="lid"><span class="ribbon"></span>&nbsp;</div>
			<div class="body">&nbsp;</div>
			<div class="contents"></div>
			<img class="img" src="<?= $gift->link ?>" alt="<?= $gift->gift ?>">
		</div>
		<!-- <button id="button">Open</button> -->
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="main.js"></script>
</body>

</html>