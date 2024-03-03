<?php
// logics
require "database.php";
require "functions.php";

?>

<?php

view("header.view.php", ["title" => "Author"]);
view("nav.view.php");

?>

<!-- HTML here -->
<?php view("footer.view.php"); ?>