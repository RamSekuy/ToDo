<?php
require_once "db.php";

$sql = "SELECT * FROM task_groups";
$res = mysqli_query($conn, $sql);

if ($res === false) {
    die("Query error: " . mysqli_error($conn));
}

$groups = mysqli_fetch_all($res, MYSQLI_ASSOC);