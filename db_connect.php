<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "PostPulse"; // bikin database di phpmyadmin namanay disesuaikan
$conn = null;

try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	die;
}