<?php
include "koneksi.php";

$id_update = $_GET['id'];
if (isset($id_update)) {
    $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE id = '$id_update'"));
    $id = $row['id'];
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "UPDATE user SET username = '$username', email = '$email', password = '$password' WHERE id = $id";
    mysqli_query($conn, $query);
    if ($query) {
        echo "<script>alert('User has been updated!'); document.location = 'manageUser.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="username">Username</label>
        <input id="username" type="text" name="username" value="<?php echo $row['username']; ?>" required><br>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" value="<?php echo $row['password']; ?>" required><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>