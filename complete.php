<?php
require 'db.php';

$id = $_GET['id'];
$sql = "UPDATE tasks SET status = 1 WHERE id = $id";
$conn->query($sql);

header('Location: index.php');
exit;
?>
