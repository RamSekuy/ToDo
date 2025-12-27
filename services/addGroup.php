<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../task-groups.php');
    exit;
}

$name = trim($_POST['name'] ?? '');

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO task_groups (name) VALUES (?)"
);
mysqli_stmt_bind_param($stmt, "s", $name);

if (!mysqli_stmt_execute($stmt)) {
    die("Insert error: " . mysqli_error($conn));
}

header('Location: ../task-groups.php?success=1');
exit;
