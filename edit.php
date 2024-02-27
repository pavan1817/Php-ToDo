<?php

include 'dbconn.php';

$id = "";
$title = "";
$description = "";
$completed = "";

$error_msg = "";
$success_msg = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET['id'])){
        header("location: /index.php");
        exit;
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /index.php");
        exit;
    }

    $title = $row['title'];
    $description = $row['description'];
    $completed = $row['completed'];
    } else {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $completed = $_POST["completed"];
    
    do {
        if(empty($title) || empty($description)){
            $error_msg = "some fields are empty";
            break;
        }

        $sql = "UPDATE tasks SET title='$title', description='$description', completed='$completed' WHERE id=$id";
        $result = $conn->query($sql);

        if(!$result){
            $error_msg = "Invalid query: " . $conn->error;
            break;
        }

        $success_msg = "task updated successfully";

        header("location: /index.php");
        exit;

    } while (false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Task</h2>

        <?php
        if(!empty($error_msg)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$error_msg</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">completed</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="completed" placeholder="Yes/No" value="<?php echo $completed; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline primary" href="/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
