<?php
    include "connection.php";
    session_start();
    if(isset($_SESSION['username']) || isset($_SESSION['email'])){
        header('Location: index.php');
        exit;
    }
    
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            header('Location: register.php?message=exists');
        } else {
            if ($password == $confirm_password) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $insert = "INSERT INTO user (username, email, password, level) VALUES ('$username', '$email', '$password', 'Member')";
                $query = mysqli_query($conn, $insert);
                if ($query) {
                    header('Location: login.php?message=registered');
                } else {
                    header('Location: register.php?message=failure');
                }

            } else {
                header('Location: register.php?message=unsynchronized');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Jujutsu Kaisen - Shibuya Incident</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="icon" href="assets/icon/jujutsu-kaisen-highschool.ico">
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{background-color: rgba(13, 13, 13);}
        </style>
    </head>
    <body>
        <div class="register-container">
            <h1><a href="javascript:history.back()"><img src="assets/icon/arrow-left-solid.svg" class="arrow-register"></a> Register Account</h1>
            <div class="account-content">
             <?php
             if($_GET['message'] == "failure"){
                echo "<div class='register-notification' id='register-notification'><span>Registration was unsuccessfully!</span><a class='close-notification' onclick='notificationRegister();'>&times;</a></div>";
             }else if($_GET['message'] == "unsynchronized"){
                echo "<div class='register-notification' id='register-notification'><span>Registration password doesn't match!</span><a class='close-notification' onclick='notificationRegister();'>&times;</a></div>";
             }else if($_GET['message'] == "exists"){
                echo "<div class='register-notification' id='register-notification'><span>Username or email already exists!</span><a class='close-notification' onclick='notificationRegister();'>&times;</a></div>";
             }
             ?>
                <form name="register-form" class="account-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                    <label for="username">Email</label>
                    <input type="email" name="email" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                    <label for="password">Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                    <span>Already have an account? <a href="login.php"> Login</a></span>
                    <input type="submit" name="submit" value="Register" class="register-button">
                </form>
            </div>
        </div>
        <script src="assets/js/script.js"></script>
    </body>
</html>