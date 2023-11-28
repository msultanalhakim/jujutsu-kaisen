<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $episode = $_POST['episode'];
    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $path = "videos/".$file;
    $uploaded = date('Y-m-d H:i:s');

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO episode (episode, file, file_uploaded) VALUES ('$episode', '$path', '$uploaded')";
        mysqli_query($conn, $query);
        echo "<script>alert('Episode has been uploaded!');</script>";
        header("Location: episode.php");
    } else {
        echo "<script>alert('Failed to upload episode.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Episode</title>
</head>
<body>
    <a href="index.php">Back</a>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="episode">Episode:</label>
        <input type="text" id="episode" name="episode" required>
        <label for="file">File:</label>
        <input type="file" id="file" name="file" required>
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>