<?php

include 'dbconn.php';

$title = "";
$description = "";

$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST["title"]); // Trim title
    $description = trim($_POST["description"]); // Trim description

    $error_msg = "";

    // Validate title
    if (empty($title)) {
        $error_msg .= "Title cannot be empty. ";
    }

    // Validate description
    if (empty($description)) {
        $error_msg .= "Description cannot be empty. ";
    }

    // Check if there are any validation errors
    if (empty($error_msg)) {
        // If no validation errors, proceed to insert into the database
        $sql = "INSERT INTO tasks(title, description) VALUES('$title', '$description')";
        $result = $conn->query($sql);

        if ($result) {
            // If insertion or query is successful, redirect to the index page
            header("location: /index.php");
            exit;
        } else {
            // If insertion fails, set error message
            $error_msg = "Error in inserting task: " . $conn->error;
        }
    }
}

// $sql = "SELECT * FROM tasks ORDER BY updated_at DESC";
// $result = $conn->query($sql); 

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
        if(!empty($error_msg)){  // If the error_msg is not empty it executes echo
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
                    <textarea name="description" cols="30" rows="5" class="form-control" value="<?php echo $description; ?>"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-secondary" href="/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
