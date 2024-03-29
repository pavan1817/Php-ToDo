<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>
<body>
    <?php
    // echo "Hii!";
    // phpinfo();
    ?>
    <div class="container my-5">
        <h2>To-Do List</h2>
        <a class="btn btn-primary" href="/addTask.php" role="button" style="margin-bottom: 10px;"><i class="bi bi-plus-lg"></i> Add Task</a>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // database connection
                include 'dbconn.php';
                
                $sql = "SELECT * FROM tasks WHERE deleted = FALSE ORDER BY updated_at DESC";
                $result = $conn->query($sql);

                // initializing the s.no. to 0
                $serial_no = 0;

                // checks if the query execution is successful
                if(!$result){
                    die("Invalid query: " . $conn->error);
                }
                // print_r($result);

                while($row = $result->fetch_assoc()){

                    // button text based on the completion status
                    // default $row['status'] will be 0 -> NULL
                    $completedButtonText = $row['status'] ? 'Completed' : 'Mark as Completed';
                    // action based on the completion status
                    $completedButtonAction = $row['status'] ? 'btn-secondary' : 'btn-success';
                    // link for toggling completion
                    $toggleCompletionLink = $row['status'] ? "/completion.php?id=$row[id]&status=0" : "/completion.php?id=$row[id]&status=1";

                    // incrementing the s.no.
                    $serial_no++;

                    echo "
                    <tr>
                    <td>$serial_no</td>
                    <td>$row[title]</td>
                    <td>$row[description]</td>
                    <td>
                        <a class='btn btn-sm $completedButtonAction' href='$toggleCompletionLink'>$completedButtonText</a>
                    </td>
                    <td>
                        <a href='/edit.php?id=$row[id]'><i class='bi bi-pencil-square' style='color: #3545dc; margin-right: 15px;'></i></a>
                        <a href='/delete.php?id=$row[id]'><i class='bi bi-trash3-fill' style='color: #dc3545;'></i></a>
                    </td>
                    <td>$row[created_at]</td>
                    <td>$row[updated_at]</td>
                </tr>
                    ";
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
