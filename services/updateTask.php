<?php
require_once "db.php";

$id        = $_POST['id'] ?? '';
$newStatus = $_POST['status'] ?? '';
$otherId   = $_POST['otherTaskId'] ?? null;
    if (!$otherId) {
        addToLastPriority($conn,$id,$newStatus);
        header("Location: ../");
        exit;
    }
    $otherTask =getTaskByID($conn,$otherId);
    $otherPriority = (int)$otherTask['priority'];
    $task =getTaskByID($conn,$id);
    $oldStatus = $task['status'];
    $isSameStatus = $oldStatus == $newStatus;
    mysqli_begin_transaction($conn);
    try{
   // geser priority
    $q = "UPDATE tasks SET priority=priority+1 WHERE priority >= ? AND status=?";
    if($isSameStatus && $task["priority"]<$otherPriority) {
        $q = "UPDATE tasks SET priority=priority-1 WHERE priority <= ? AND status=?";
        echo "drag dari atas ke bawah";
        echo "<br/>";
    }

    $stmt1 = mysqli_prepare($conn, $q);
    echo $otherPriority;
    mysqli_stmt_bind_param($stmt1, "is", $otherPriority,$newStatus); //28
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_execute($stmt1);
    echo "execute geeser";
    echo "<br/>";

    // set priority task
    if($isSameStatus){
        $stmt2 = mysqli_prepare($conn, "UPDATE tasks SET priority=? WHERE id = ?");
        echo $otherPriority;
        mysqli_stmt_bind_param($stmt2, "is", $otherPriority, $id);
        mysqli_stmt_execute($stmt2);
        echo "execute2";
    }else{
        $stmt3 = mysqli_prepare($conn, "UPDATE tasks SET priority=?,status=? WHERE id = ?");
        mysqli_stmt_bind_param($stmt3, "iss", $otherPriority,$newStatus, $id);
        mysqli_stmt_execute($stmt3);
        echo "execute3";
    }
    mysqli_commit($conn);
    header("Location: ../");
    exit;
} catch (Exception $e) {
    mysqli_rollback($conn);
    http_response_code(500);
    print_r("Internal Server Error");
}

function addToLastPriority($conn,$id,$status){
    // ambil priority terakhir
    $q = mysqli_prepare($conn,
        "SELECT priority FROM tasks WHERE status=? order by priority desc"
    );
    mysqli_stmt_bind_param($q, "s", $status);
    mysqli_stmt_execute($q);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($q));

    $lastPriority = (int)$row['priority'] + 2;
    echo $lastPriority;
    // update task
    $q = mysqli_prepare($conn,
        "UPDATE tasks SET status=?, priority=? WHERE id=?"
    );
    mysqli_stmt_bind_param($q, "sis", $status, $lastPriority, $id);
    mysqli_stmt_execute($q);
}

function getTaskByID($conn,$id){
    $q = mysqli_prepare($conn, "SELECT * FROM tasks WHERE id = ?");
    mysqli_stmt_bind_param($q, "s", $id);
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);
    return mysqli_fetch_assoc($result);
}