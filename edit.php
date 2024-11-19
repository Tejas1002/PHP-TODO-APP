<?php
require 'db.php';

// Get the task ID from the URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid Task ID");
}

// Fetch task data
$sql = "SELECT * FROM tasks WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$task = $result->fetch_assoc();
if (!$task) {
    die("Task not found!");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $status = isset($_POST['status']) ? 1 : 0;

    $update_sql = "UPDATE tasks SET title = ?, status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sii", $title, $status, $id);
    if ($update_stmt->execute()) {
        header("Location: index.php?success=Task updated!");
        exit;
    } else {
        $error = "Error updating task!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Edit Task</title>
</head>
<body>
    <div class="main-container">
        <h1>Edit Task</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="" method="POST" class="edit-form">
            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($task['title']); ?>" required>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="status" <?= $task['status'] ? 'checked' : ''; ?>>
                    Mark as Completed
                </label>
            </div>
            <div class="form-actions">
                <button type="submit">Update Task</button>
                <a href="index.php" class="btn-back">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
