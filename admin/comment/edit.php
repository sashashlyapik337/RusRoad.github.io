<?php

include "../../path.php";
include "../../applicate/control/commentaries.php";
$text1 = isset($text1) ? $text1 : '';
$pub = isset($pub) ? $pub : 0;


if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('comments', $id);
}

header('Location: ' . BASE_URL . 'admin/comment/index.php');


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>



</body>
</html>
<?php
exit();