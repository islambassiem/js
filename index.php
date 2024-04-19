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
</body>

</html>