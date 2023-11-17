<?php
include "article.php";
$articles = getAllArticles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Articles</title>
</head>
<body>
    <h1>All Articles</h1>
    <a href="index.php">Back</a>
    <?php while ($article = mysqli_fetch_array($articles)): ?>
        <div>
            <h2><?php echo $article['article_name']; ?></h2>
            <p><?php echo $article['article_content']; ?></p>
            <img src="<?php echo $article['article_image']; ?>" alt="Article Image">
        </div>
    <?php endwhile; ?>
</body>
</html>