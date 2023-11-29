<?php
include "koneksi.php";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM user WHERE id = $id";
    mysqli_query($conn, $query);
}

$users = mysqli_query($conn, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <a href="index.php">Back</a>
    <h1>User Management</h1>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php while ($user = mysqli_fetch_array($users)): ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['password']; ?></td>
                <td>
                <a href="updateUser.php?id=<?php echo $user['id']; ?>">Update |</a>
                <a href="manageUser.php?delete=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>