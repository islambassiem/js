<?php

include_once 'connect.php';

$user_name = $_POST['name'];
$gift = $_POST['gift'];

$stmt = $conn->prepare("UPDATE users SET active = 0, gift = ? WHERE user_name = ?;"); 
$stmt->execute([$gift, $user_name]);