<?php
if(isset($_GET['id'])){
    $id = $_GET["id"];

    include 'dbconn.php';

    $sql = "DELETE FROM tasks WHERE id=$id";
    $conn->query($sql);
}

header("location: /index.php");
exit;

?>
