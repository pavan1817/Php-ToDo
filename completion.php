<?php

include 'dbconn.php';

// Get task ID and new completion status
$id = $_GET['id'];
$newCompletionStatus = $_GET['status'];

// Update completion status in the database
$sql = "UPDATE tasks SET status = $newCompletionStatus WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "Error in updating record: " . $conn->error;
}

$conn->close();
?>
