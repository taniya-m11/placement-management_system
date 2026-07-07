<?php
// config.php - DB connection and common helpers
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'pms';

$conn = mysqli_connect($host, $user, $pass);
if (!$conn) { die('MySQL connection failed: '.mysqli_connect_error()); }
mysqli_set_charset($conn, 'utf8mb4');
// create DB if not exists and select
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db`");


// simple helper to sanitize output
function e($v){ return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
?>
