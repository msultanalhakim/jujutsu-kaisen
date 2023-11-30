<?php
include "koneksi.php";

$id = $_GET['id'];

$query = "SELECT * FROM article WHERE id = $id";
$result = mysqli_query($conn, $query);
$article = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article['article_name']; ?></title>
</head>
<body>
    <a href="allArticles.php">Back</a>
    <h2><?php echo $article['article_name']; ?></h2>
    <p><?php echo date('F j, Y', strtotime($article['article_release'])); ?></p>
    <p><?php echo $article['article_content']; ?></p>
    <img src="<?php echo $article['article_image']; ?>" alt="Article Image" width="200px"><br>
</body>
</html>