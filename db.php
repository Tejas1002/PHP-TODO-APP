<?php
$host = "localhost";
$user = "root";
$password = ""; // Leave empty if there's no password
$database = "todo_app";
$port = 3307; // Use your MySQL port

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
