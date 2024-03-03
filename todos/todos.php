<?php
    require "../database.php";
    require "../functions.php";

    if(!isLoggedIn()) {
        header('location: ../auth/login.php');
        exit();
    }
    $user_id = $_SESSION['user']['id'];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if ($_POST["action"] ?? '' === "DELETE") {
            $id = $_POST['id'];
            $delete_query = sprintf("DELETE FROM `todos` WHERE id = %d AND user_id=%d", 
                mysqli_real_escape_string($conn, $id),
                mysqli_real_escape_string($conn, $user_id)
            );

            $result = mysqli_query($conn, $delete_query);
        } else {
            $body = $_POST['body'];

            $insert = sprintf("INSERT INTO `todos` (`body`, `user_id`) VALUES ('%s', %d)",
                mysqli_real_escape_string($conn, $body),
                mysqli_real_escape_string($conn, $user_id)
            );

            $result = mysqli_query($conn, $insert);
        }
    }

    $query_string = sprintf("SELECT * FROM todos WHERE user_id = %d ORDER BY id DESC",
        mysqli_real_escape_string($conn, $user_id)
    );

    $result = mysqli_query($conn, $query_string);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php view("header.view.php");?>
    <?php view("nav.view.php");?>
    
    <div class="mt-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="form w-50">
            <div class="input-group">
                <input type="text" name="body" class="form-control" />
                <button name="add-todo-btn" type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
    
    <div class="w-50">
        <h3 class="text-primary mt-5">Todo List</h3>
        <ul class="list-group">
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <li class="list-group-item d-flex align-items-center justify-content-between">
                    <?= htmlentities($row['body']) ?>
                    <form action="/todos/" method="POST">
                        <input type="hidden" name="id" value=<?= $row['id'] ?> />
                        <input type="hidden" name="action" value="DELETE"/>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php view("footer.view.php");?>
</body>
</html>