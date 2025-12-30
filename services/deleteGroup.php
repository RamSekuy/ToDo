<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../task-groups.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
if ($name === '') {
    header('Location: ../task-groups.php?error=invalid');
    exit;
}

// delete tasks in the group
$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM tasks WHERE task_group = ?"
);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

// delete group
$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM task_groups WHERE name = ?"
);

mysqli_stmt_bind_param($stmt, "s", $name);

if (!mysqli_stmt_execute($stmt)) {
    die("Delete error: " . mysqli_error($conn));
}

header('Location: ../task-groups.php');
exit;
