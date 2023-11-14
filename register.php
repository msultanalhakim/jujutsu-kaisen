<?php
    include "koneksi.php";
    session_start();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cofirm_password = $_POST['confirm_password'];
    $submit = $_POST['submit'];

    if (isset($_POST['submit'])) {
        if ($password == $cofirm_password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
            $query = mysqli_query($conn, $insert);

            if ($query) {
                echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Registration failed!');</script>";
            }

        } else {
            echo "<script>alert('Password does not match!');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="register-box">
        <h2>Create your account</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="submit">Register</button>
            <div class="login-register">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>