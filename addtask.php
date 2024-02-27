<?php

include 'dbconn.php';

$title = "";
$description = "";
$completed = "";

$error_msg = "";
$success_msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $completed = $_POST["completed"];

    do {
        if(empty($title) || empty($description)){
            $error_msg = "some fields are empty";
            break;
        }

        // add new tasks to the database
        $sql = "INSERT INTO tasks(title, description, completed) VALUES('$title','$description','$completed')";
        $result = $conn->query($sql);

        if(!$result){
            $error_msg = "Invalid query: " . $conn->error;
            break;
        }

        $title = "";
        $description = "";
        $completed = "";

        $success_msg = "tasks added successfully";

        // it re-directs the user to the index file
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
        <h2>Add Task</h2>

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

            <?php
            if(!empty($success_msg)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$success_msg</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div> 
                ";
            }
            ?>


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
