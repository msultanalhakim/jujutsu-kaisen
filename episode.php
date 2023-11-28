<?php
include "koneksi.php";

$result = mysqli_query($conn, "SELECT * FROM episode ORDER BY id_episode DESC");

if (isset($_POST['delete'])) {
    $id_episode = $_POST['id_episode'];
    $query = "DELETE FROM episode WHERE id_episode = $id_episode";
    mysqli_query($conn, $query);
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Episodes</title>
</head>
<body>
    <a href="index.php">Back</a>
    <?php while ($row = mysqli_fetch_array($result)): ?>
        <div>
            <h2><?php echo $row['episode']; ?></h2>
            <video width="320" height="240" poster="<?php echo $row['thumbnail']; ?>">
                <source src="videos/<?php echo $row['file']; ?>" type="video/mp4">
                Your browser does not support the thumbnail tag.
            </video>
            <p><?php echo date('F j, Y', strtotime($row['file_uploaded'])); ?></p>
            <a href="watch.php?id=<?php echo $row['id_episode']; ?>">Watch Video</a>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <input type="hidden" name="id_episode" value="<?php echo $row['id_episode']; ?>">
                <input type="submit" name="delete" value="Delete Episode">
            </form>
            <hr>
        </div>
    <?php endwhile; ?>
</body>
</html>