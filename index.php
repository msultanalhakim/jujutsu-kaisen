<?php
    session_start();
    include 'article.php';

    $articles = getTopArticles();

    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Hello, <?php echo $_SESSION['username']; ?> !</h1>
    <a href="logout.php">Logout</a>
    <h1>Top 3 Articles</h1>
    <?php while ($article = mysqli_fetch_array($articles)): ?>
        <h2><?php echo $article['article_name']; ?></h2>
        <p><?php echo $article['article_content']; ?></p>
        <img src="<?php echo $article['article_image']; ?>" alt="article-img">
    <?php endwhile; ?>
    <br><br>
    <a href="tampilkan.php">View All</a>
</body>
</html>