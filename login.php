<?php
    include "koneksi.php";
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $submit = $_POST['submit'];

    $passwordError = false;

    if (isset($_POST['submit'])) {
        $select = "SELECT * FROM user WHERE email='$email'";
        $query = mysqli_query($conn, $select);

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $row['username'];
                header('Location: index.php');
                exit;
            } else {
                $passwordError = true;
            }
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
        <?php if ($passwordError) : ?>
            <p style="color: red; font-style: italic;">Password is incorrect</p>
        <?php endif; ?>
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