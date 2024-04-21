<?php

$dsn    = 'mysql:host=localhost; dbname=party;charset=utf8';
$user   = 'admin';
$pass   = 'IBA0274#5325i';

// $user   = 'root';
// $pass   = '';

try {
	$conn = new PDO($dsn, $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, true);
} catch (PDOException $e) {
	echo 'Error ' . $e->getMessage();
}