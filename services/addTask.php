<?php
require_once "db.php";

$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$group = $_POST['group'] ?? '';

if (empty($title) || empty($group)) {
    exit('Missing required fields');
}
$status = 'ToDo';
// Get last priority in the status (priority gap 2 mempermudah update posisi)
$prioSql = "SELECT COALESCE(MAX(priority), 0) + 2 AS next_priority
            FROM tasks
            WHERE status = ?";

$prioStmt = mysqli_prepare($conn, $prioSql);
mysqli_stmt_bind_param($prioStmt, "s", $status);
mysqli_stmt_execute($prioStmt);

$prioResult = mysqli_stmt_get_result($prioStmt);
$priority = mysqli_fetch_assoc($prioResult)['next_priority'];

// Insert new task
$sql = "INSERT INTO tasks (title, description, status, priority,task_group)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "sssis",
    $title,
    $description,
    $status,
    $priority,
    $group
);

mysqli_stmt_execute($stmt);

header("Location: ../?group=" . urlencode($group));
exit;
