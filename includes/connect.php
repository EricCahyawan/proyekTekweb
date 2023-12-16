<?php
try {
    $connect = new PDO('mysql:host=localhost;dbname=postpulse', 'root', '');
} catch (PDOException $e) {
    die('Tidak berhasil terkoneksi ke database<br/>Error: ' . $e);
}
include 'postpulse.class.php';
$postpulse = new PostPulse($connect);
