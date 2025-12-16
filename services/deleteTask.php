<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../");
    exit;
}

$id = $_POST['id'] ?? null;

if (!$id) {
    header("Location: ../");
    exit;
}

$sql = "DELETE FROM tasks WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: ../");
exit;
