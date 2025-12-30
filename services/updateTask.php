<?php
require_once "db.php";

$id        = $_POST['id'] ?? '';
$newStatus = $_POST['status'] ?? '';
$otherId   = $_POST['otherTaskId'] ?? null;

// Update to last priority
if (!$otherId) {
    addToLastPriority($conn, $id, $newStatus);
    header("Location: ../?group=" . urlencode(getTaskByID($conn, $id)['task_group']));
    exit;
}
// get tasks information
$otherTask = getTaskByID($conn, $otherId);
$otherPriority = (int)$otherTask['priority'];
$task = getTaskByID($conn, $id);
$oldStatus = $task['status'];
$isSameStatus = $oldStatus == $newStatus;

// Updating Task to replace priority
mysqli_begin_transaction($conn);
try {
    // geser priority
    $q = $isSameStatus && $task["priority"] < $otherPriority
        ? "UPDATE tasks SET priority=priority-1 WHERE priority <= ? AND status=?"
        : "UPDATE tasks SET priority=priority+1 WHERE priority >= ? AND status=?";

    $stmt1 = mysqli_prepare($conn, $q);
    mysqli_stmt_bind_param($stmt1, "is", $otherPriority, $newStatus);
    // run 2x karena gap prioritynya 2
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_execute($stmt1);

    // set priority task
    if ($isSameStatus) {
        // same status, hanya update priority
        $stmt2 = mysqli_prepare($conn, "UPDATE tasks SET priority=? WHERE id = ?");
        mysqli_stmt_bind_param($stmt2, "is", $otherPriority, $id);
        mysqli_stmt_execute($stmt2);
    } else {
        // different status, update status dan priority
        $stmt3 = mysqli_prepare($conn, "UPDATE tasks SET priority=?,status=? WHERE id = ?");
        mysqli_stmt_bind_param($stmt3, "iss", $otherPriority, $newStatus, $id);
        mysqli_stmt_execute($stmt3);
    }
    // commit
    mysqli_commit($conn);
    header("Location: ../?group=" . urlencode($task['task_group']));
    exit;
} catch (Exception $e) {
    mysqli_rollback($conn);
    http_response_code(500);
}

function addToLastPriority($conn, $id, $status)
{
    // ambil priority terakhir
    $q = mysqli_prepare(
        $conn,
        "SELECT priority FROM tasks WHERE status=? order by priority desc"
    );
    mysqli_stmt_bind_param($q, "s", $status);
    mysqli_stmt_execute($q);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($q));
    $lastPriority = (int)$row['priority'] + 2;

    // update task
    $q = mysqli_prepare(
        $conn,
        "UPDATE tasks SET status=?, priority=? WHERE id=?"
    );
    mysqli_stmt_bind_param($q, "sis", $status, $lastPriority, $id);
    mysqli_stmt_execute($q);
}

function getTaskByID($conn, $id)
{
    $q = mysqli_prepare($conn, "SELECT * FROM tasks WHERE id = ?");
    mysqli_stmt_bind_param($q, "s", $id);
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);
    return mysqli_fetch_assoc($result);
}
