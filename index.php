<?php 
include_once('connection.php');


$query = $conn->query("SELECT * FROM `composite_prompt`");
$prompts = $query->fetchAll(PDO::FETCH_ASSOC);
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

<div class="search-container">
    <input type="text" id="searchInput" class="search-input" placeholder="Search here...">
    <button onclick="performSearch()" class="search-button">Search</button>
</div>
<div>
    <?php foreach ($prompts as $index => $prompt) {?>
        <h1><?= $prompt['title']?></h1>
        <p><?= $prompt['description']?></p>
    <?php }?>
</div>
</body>
</html>