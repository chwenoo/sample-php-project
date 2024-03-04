<?php

require "../database.php";
require "../functions.php";
// const BASE_PATH = __DIR__ . '/';

if (isLoggedIn()) {

    if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    
        $user_id = $_SESSION['user']['id'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        $stmt = $conn->prepare("INSERT INTO notes (user_id, title, body) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $body);
        $stmt->execute();
    
        $info = "a note is created successfully!";
    }
} else {
    header("Location: ../auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
</head>
<body>

<?php view("header.view.php");?>
<?php view("nav.view.php");?>

<div class="container">
        <?php if (isset($info)) : ?>
            <div class="alert alert-info mt-3">
                <?= $info ?>
            </div>
        <?php endif ?>

        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" class="form w-50 mx-auto mb-5 mt-3 ">
            <h1 class="text-primary">Form</h1>
            <input type="text" name="title" class="form-control mb-2" placeholder="your title" required>
            <textarea name="body" id="" cols="30" rows="10" class="form-control" placeholder="type your text ..." required></textarea> <br>
            
            <button class="btn btn-primary w-25">Add</button>
        </form>
    </div>
</body>
</html>