<?php
include "koneksi.php";

session_start();
if (!isset($_SESSION['username'])) {
    die('User not logged in');
}

$username = $_SESSION['username'];

$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
$user = mysqli_fetch_array($result);

if (isset($_POST['update'])) {
    $new_username = $_POST['username'];
    $email = $_POST['email'];
    $query = "UPDATE user SET username = '$new_username', email = '$email' WHERE username = '$username'";
    mysqli_query($conn, $query);
    $_SESSION['username'] = $new_username;
    echo "<script>alert('Profile has been updated!'); document.location = 'index.php';</script>";
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username</label>
        <input id="username" type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <input type="submit" name="update" value="Update">
    </form>
    <a href="changePass.php">Change Password</a>
</body>
</html>