<?php
require "functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>
<body>
    <?php
    view("header.view.php", ["title" => "About Us"]);
    view("nav.view.php");
    ?>

    <h1>About Us</h1>

    <?php view("footer.view.php") ?>

</body>
</html>
