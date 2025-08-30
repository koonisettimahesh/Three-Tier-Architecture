<?php
$host = '172.31.71.179';
$dbname = 'user_db';
$username = 'root';
$password = '12345';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

