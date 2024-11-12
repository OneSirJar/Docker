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
    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/script.js"></script>
</head>
<body>
    <div class="video-bg">
        <video autoplay loop muted playsinline>
            <source src="https://assets.codepen.io/3364143/7btrrd.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="glass-container">
        <h1>Welcome to gogomoa.ai</h1>
        <div class="search-container">
            <select class="tags" id="tags" name="tags">
                <?php foreach ($tags as $index => $tag) {?> 
                <option value="<?= $tag['id']?>"><button name="<?= $id = $tag['id'];?>" value="<?= $tag['id']?>" type="submit"><?= $tag['name']?></button></option>
                <?php }?>
            </select>
            <input type="text" id="searchInput" class="search-input" placeholder="Search here...">
            <button onclick="performSearch()" class="search-button">Search</button>
        </div>
    </div>

    <div class="prompts">
        <p><strong>Simple prompt:</strong> Example of a simple search prompt.</p>
        <p><strong>Detailed prompt:</strong> Example of a more detailed search prompt, explaining the search criteria in depth.</p>
    </div>
</body>
</html>
