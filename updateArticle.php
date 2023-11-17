<?php
    include "koneksi.php";

    $id_update = $_GET['id'];
    if (isset($id_update)) {
        $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM article WHERE id = '$id_update'"));
        $id = $row['id'];
        $title = $row['article_name'];
        $content = $row['article_content'];
        $img = $row['article_image'];
    }

    $tipe_foto = 0;

    if (isset($_POST['update'])) {  
        $id_update = $_POST['id'];
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];

        if ($img != '') {
            $path = "img/".$img;
            $tipe_allowed = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            if ($tipe_allowed != 'jpg' && $tipe_allowed != 'png' && $tipe_allowed != 'jpeg') {
                $tipe_foto = 1;
            } else {
                move_uploaded_file($tmp, $path);
                $update = "UPDATE article SET article_name = '$title', article_content = '$content', article_image = '$path' WHERE id = '$id_update'";
                $query = mysqli_query($conn, $update);
            }
        }

        if ($tipe_foto == 1) {
            echo "<script>alert('Sorry, only JPG, JPEG, & PNG files are allowed!');</script>";
        } else {
            $update = "UPDATE article SET article_name = '$title', article_content = '$content' WHERE id = '$id_update'";
            $query = mysqli_query($conn, $update);
        }

        if ($query) {
            echo "<script>alert('Article has been updated!'); document.location = 'allArticles.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
</head>
<body>
    <h1>Update Article</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype='multipart/form-data'>
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= $title ?>" required>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?= $content ?></textarea>
    </div>
    <div>
        <label for="img">Image:</label>
        <img src="<?= $img ?>" alt="article-img-update" width="200px">
    </div>
    <div>
    <div>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="file" name="img">
    </div>
        <br><button type="submit" name="update">Update</button>
    </form>
</body>
</html>