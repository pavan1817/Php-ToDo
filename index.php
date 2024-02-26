<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
    // phpinfo();
    ?>
    <div class="container my-5">
        <h2>To Do List</h2>
        <a class="btn btn-primary" href="/addtask.php" role="button">Add Task</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Completed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db_name = "todolist";
                $conn = new mysqli($servername, $username, $password, $db_name);

                if($conn->connect_error){
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM tasks";
                $result = $conn->query($sql);

                if(!$result){
                    die("Invalid query: " . $conn->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[title]</td>
                    <td>$row[description]</td>
                    <td>$row[completed]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>