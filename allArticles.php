<?php
    include "functionArticle.php";
    include "koneksi.php";

    $articles = getAllArticles();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM article WHERE id = '$id'"));
        $filefoto = $row['article_image'];
        unlink($filefoto);
        $delete = "DELETE FROM article WHERE id = '$id'";
        $query = mysqli_query($conn, $delete);
        
        if ($query) {
            echo "<script>alert('Article has been deleted!'); document.location = 'allArticles.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Articles</title>
</head>
<body>
    <a href="index.php">Back</a>
    <h1>All Articles</h1>
    <form action="addArticle.php" method="post">
        <button type="submit" name="submit">Add Article</button>
    </form>
    <?php while ($article = mysqli_fetch_array($articles)): ?>
        <div>
            <h2><?php echo $article['article_name']; ?></h2>
            <p><?php echo $article['article_content']; ?></p>
            <img src="<?php echo $article['article_image']; ?>" alt="Article Image" width="200px"><br>
            <a href="updateArticle.php?id=<?php echo $article['id']; ?>">Update</a>
            <a href="allArticles.php?id=<?php echo $article['id']; ?>">Delete</a>
            <hr>
        </div>
    <?php endwhile; ?>
</body>
</html>