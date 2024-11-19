<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $sql = "INSERT INTO tasks (title) VALUES ('$title')";
    $conn->query($sql);
}

header('Location: index.php');
exit;
?>
