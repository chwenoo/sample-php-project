<?php
    require "../database.php";
    require "../functions.php";
    // const BASE_PATH = __DIR__ . '/';

    $select_query = "SELECT title, notes.id AS note_id, body, users.id AS user_id, username FROM notes LEFT JOIN users ON notes.user_id = users.id ORDER BY notes.id DESC";
    $results = mysqli_query($conn, $select_query);
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

    <a href="note-create.php" class="btn btn-primary my-5">Write Note</a>

    <h1>Notes</h1>

    <div>
        <?php while($row = mysqli_fetch_assoc($results)) : ?>
            <h3><a href="/sample-php-project/notes/note-edit.php?id=<?=$row["note_id"]?>"><?= $row["title"] ?></a></h3>
            <p>
                Author - <a href="../author.php?id=<?= $row['user_id']?>"><?= $row["username"] ?? "Unknown" ?></a>
            </p>
            <p>
                <?= substr(htmlentities($row["body"]), 0, 200) . '...' ?>
            </p>
        <?php endwhile; ?>
    </div>
    <?php view("footer.view.php");?>
</body>
</html>
