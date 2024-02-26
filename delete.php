<?php
if(isset($_GET['id'])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "todolist";
    $conn = new mysqli($servername, $username, $password, $db_name);

    $sql = "DELETE FROM tasks WHERE id=$id";
    $conn->query($sql);
}

header("location: /index.php");
exit;

?>