<?php
const BASE_PATH = __DIR__ . '';

require("functions.php");
require("database.php");
?>

<?php view("header.view.php", [
    "title" => "Home"
]);?>
<?php view("nav.view.php");?>
<h1>Home</h1>
<?php view("footer.view.php");?>
