<?php

include 'dbconn.php';

// id to be deleted
$delete_id = $_GET['id'];

$current_datetime = date('Y-m-d H:i:s');

// updating the row from the table
$sql_update = "UPDATE tasks SET deleted = TRUE, deleted_at = '$current_datetime' WHERE id = $delete_id";

if ($conn->query($sql_update) === TRUE) {
    header("location: /index.php");
    exit;
} else {
    echo "Error:" . $conn->error;
}

// $sql = "SELECT * FROM tasks WHERE deleted = FALSE";
// $result = $conn->query($sql);

$conn->close();
?> 
