<?php
require 'db.php';

// Fetch tasks
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <title>To-Do List</title>
</head>
<body>
    <div class="main-container">
        <h1>To-Do List</h1>
        <form action="add.php" method="POST">
            <input type="text" name="title" placeholder="Enter a new task" required>
            <button class="btn btn-primary">Add Task</button>
        </form>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="<?= $row['status'] ? 'completed' : '' ?>">
                    <span><?= htmlspecialchars($row['title']); ?></span>
                    <div>
                        <a href="complete.php?id=<?= $row['id']; ?>">Mark Complete</a>
                        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="delete-link">Delete</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
        <footer>
            <p>&copy; <?= date('Y'); ?> To-Do List App Created By Tejas Shah</p>
        </footer> 
    </div>

   <script src="scripts.js"></script>
</body>
</html>
