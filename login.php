<?php
    include "koneksi.php";
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $submit = $_POST['submit'];

    if (isset($_POST['submit'])) {
        $select = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $query = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($query);

        if ($row['email'] == $email) {

            if ($row['password'] == $password) {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('Location: index.php');
            } else {
                echo "<script>alert('Password is incorrect!');</script>";
            }

        } else {
            echo "<script>alert('Email is incorrect!');</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="submit">Login</button>
            <div class="login-register">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>