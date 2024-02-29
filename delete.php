<?php

include 'dbconn.php';

// Determine the ID to be deleted
$delete_id = $_GET['id'];

// Delete the row from the table
$sql_delete_id = "DELETE FROM tasks WHERE id = $delete_id";

if ($conn->query($sql_delete_id) === TRUE) {
    // Fetch the IDs of all rows in the table
    $sql_select = "SELECT id FROM tasks ORDER BY id";
    $result = $conn->query($sql_select);

    // Update the IDs of the rows that come after the deleted row
    $new_id = 1;
    while ($row = $result->fetch_assoc()) {
        $current_id = $row['id'];
        $sql_update = "UPDATE tasks SET id = $new_id WHERE id = $current_id";
        $conn->query($sql_update);
        $new_id++;
    }

    header("location: /index.php");
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
