<?php
    include "koneksi.php";
    
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        if ($img != '') {
            $path = "img/".$img;
            $tipe_allowed = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            if ($tipe_allowed != 'jpg' && $tipe_allowed != 'png' && $tipe_allowed != 'jpeg') {
                echo "<script>alert('Sorry, only JPG, JPEG, & PNG files are allowed!');</script>";
            } else {
                move_uploaded_file($tmp, $path);
                $query = "INSERT INTO article (article_name, article_content, article_image) VALUES ('$title', '$content', '$path')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "<script>alert('Article has been added!'); document.location = 'index.php';</script>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Articles</title>
</head>
<body>
    <a href="index.php">Back</a>
    <h1>Add Article</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype='multipart/form-data'>
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <div>
            <label for="img">Image:</label>
            <input type="file" id="img" name="img" required>
        </div>
        <button type="submit" name="submit">Add Article</button>
    </form>
</body>
</html>
