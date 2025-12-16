<?php
require_once "db.php";

$sql = "SELECT * FROM tasks ORDER BY status, priority ASC";
$res = mysqli_query($conn, $sql);

$tasks = [
    'ToDo' => [],
    'In Progress' => [],
    'Done' => []
];

if ($res === false) {
    die("Query error: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($res)) {
    $status = $row['status'] ?? 'ToDo';
    if (!array_key_exists($status, $tasks)) {
        $status = 'ToDo';
    }

    $tasks[$status][] = $row;
}
