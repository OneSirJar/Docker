<?php 
include_once('connection.php');

$query = $conn->query("SELECT * FROM tag");
$tags = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gogomoa.ai</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<div>
    <?php foreach ($tags as $index => $tag) {
        if (!isset($_POST['_submit'])) {?>
        <form method="post">
            <button name="<?= $id = $tag['id'];?>" value="<?= $tag['id']?>" type="submit"><?= $tag['name']?></button>
        </form>
    <?php }}?>
</div>
<?php foreach ($_POST as $id) {
    $query = $conn->query("SELECT p.content as title, p.description as description FROM prompt_fragment p JOIN prompt_fragment_tag pt ON p.id = pt.prompt_fragment_id JOIN tag t ON t.id = pt.tag_id WHERE t.id =" . $id);
    $tagposts = $query->fetchAll(PDO::FETCH_ASSOC);?>
<div>
    <?php foreach ($tagposts as $index => $posts) {?>
        <h1><?= $posts['title']?></h1>
        <p><?= $posts['description']?></p>
    <?php }?>
</div>
<?php }?>
</body>
</html>