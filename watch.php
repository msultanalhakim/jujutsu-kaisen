<?php
session_start();
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM episode WHERE id_episode = '$id'"));
    $video = $row['file'];
}

if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];
    $user = $_SESSION['username'];
    $query = "INSERT INTO comment (username, comment, id_episode) VALUES ('$user', '$comment', '$id')";
    mysqli_query($conn, $query);
}

$editing = false;
$edit_comment = '';
if (isset($_POST['edit'])) {
    $editing = true;
    $id_comment = $_POST['id_comment'];
    $result = mysqli_query($conn, "SELECT comment FROM comment WHERE id_comment = $id_comment");
    $row = mysqli_fetch_array($result);
    $edit_comment = $row['comment'];
}

if (isset($_POST['update'])) {
    $id_comment = $_POST['id_comment'];
    $comment = $_POST['comment'];
    $query = "UPDATE comment SET comment = '$comment' WHERE id_comment = $id_comment";
    mysqli_query($conn, $query);
    $editing = false;
}

if (isset($_POST['delete'])) {
    $id_comment = $_POST['id_comment'];
    $query = "DELETE FROM comment WHERE id_comment = $id_comment";
    mysqli_query($conn, $query);
}

$result = mysqli_query($conn, "SELECT id_episode FROM episode WHERE id_episode < $id ORDER BY id_episode DESC LIMIT 1");
$prev_id = mysqli_fetch_array($result)['id_episode'];
$result = mysqli_query($conn, "SELECT id_episode FROM episode WHERE id_episode > $id ORDER BY id_episode ASC LIMIT 1");
$next_id = mysqli_fetch_array($result)['id_episode'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Video</title>
</head>
<body>
    <video width="320" height="240" controls>
        <source src="videos/<?php echo $video; ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div>
    <?php if ($prev_id): ?>
        <a href="watch.php?id=<?php echo $prev_id; ?>">Previous Episode</a>
    <?php endif; ?>
    <?php if ($next_id): ?>
        <a href="watch.php?id=<?php echo $next_id; ?>">Next Episode</a>
    <?php endif; ?>
    </div>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM comment WHERE id_episode = '$id' ORDER BY id_comment DESC");
    while ($row = mysqli_fetch_array($result)):
    ?>
        <div>
            <h3><?php echo $row['username']; ?></h3>
            <p><?php echo $row['comment']; ?></p>
            <?php if ($_SESSION['username'] == $row['username']): ?>
                <?php if ($editing && $_POST['id_comment'] == $row['id_comment']): ?>
                    <!-- Form for editing comment -->
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <input type="hidden" name="id_comment" value="<?php echo $row['id_comment']; ?>">
                        <!-- Pre-fill the textarea with the existing comment for editing -->
                        <textarea id="comment" name="comment" required><?php echo $edit_comment; ?></textarea>
                        <input type="submit" name="update" value="Save Edit">
                    </form>
                <?php else: ?>
                    <!-- Form for initiating edit -->
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <input type="hidden" name="id_comment" value="<?php echo $row['id_comment']; ?>">
                        <input type="submit" name="edit" value="Edit">
                    </form>
                <?php endif; ?>
                <!-- Form for deleting comment -->
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                    <input type="hidden" name="id_comment" value="<?php echo $row['id_comment']; ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <!-- Form for submitting new comments -->
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <label for="comment"><h2>Comment:</h2></label>
            <p><?php echo $_SESSION['username']; ?></p>
            <textarea id="comment" name="comment" required></textarea>
            <button type="submit" name="submit">Send</button>
        </form>
    <?php endif; ?>
    <a href="episode.php">Back</a>
</body>
</html>