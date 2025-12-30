<?php
$group = trim($_GET['group'] ?? '');
if ($group === '') {
    header('Location: task-groups.php');
    exit;
}
require_once "db.php";

// get tasks in the group
$sql = "SELECT * FROM tasks WHERE 
        task_group = '$group' ORDER BY status, priority ASC";
$res = mysqli_query($conn, $sql);

// variable to hold tasks grouped by status
$tasks = [
    'ToDo' => [],
    'In Progress' => [],
    'Done' => []
];

if ($res === false) {
    die("Query error: " . mysqli_error($conn));
}

// grouping tasks by status
while ($row = mysqli_fetch_assoc($res)) {
    $status = $row['status'] ?? 'ToDo';
    if (!array_key_exists($status, $tasks)) {
        $status = 'ToDo';
    }
    $tasks[$status][] = $row;
}
