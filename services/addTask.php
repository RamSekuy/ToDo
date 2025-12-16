<?php
require_once "db.php";

$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';

$status = 'ToDo';

$prioSql = "SELECT COALESCE(MAX(priority), 0) + 2 AS next_priority
            FROM tasks
            WHERE status = ?";

$prioStmt = mysqli_prepare($conn, $prioSql);
mysqli_stmt_bind_param($prioStmt, "s", $status);
mysqli_stmt_execute($prioStmt);

$prioResult = mysqli_stmt_get_result($prioStmt);
$priority = mysqli_fetch_assoc($prioResult)['next_priority'];

$sql = "INSERT INTO tasks (title, description, status, priority)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "sssi",
    $title,
    $description,
    $status,
    $priority
);

mysqli_stmt_execute($stmt);

header("Location: ../");
exit;