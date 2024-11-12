<?php
include_once('connection.php');

$query = $conn->query("SELECT * FROM author");
$author = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ($author as $authors) {?>
        <h2><?= $authors['name']?></h2>
    <?php }?>
</body>
</html>