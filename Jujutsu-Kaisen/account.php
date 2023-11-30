<?php
    include "connection.php";
    session_start();

    if(!isset($_SESSION['username']) || !isset($_SESSION['email'])){
        header('Location: login.php?message=validate');
        exit;
    }

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordError = false;

        $sql = "SELECT * FROM user WHERE username='$username'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            if (password_verify($password, $row['password'])){
                if($row['level'] == "Administrator"){
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['level'] = "Administrator";
                    header('Location: index.php');
                    exit;
                }else if($row['level'] == "Member"){
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['level'] = "Member";
                    header('Location: index.php');
                    exit;
                }
            }else{
                $passwordError = true;
            }
        }
    }

    $username = $_SESSION['username'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $user = mysqli_fetch_array($result);

    if (isset($_POST['change_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (password_verify($old_password, $user['password'])) {
            if ($new_password == $confirm_password) {
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE user SET password = '$new_password' WHERE username = '$username'";
                mysqli_query($conn, $query);
                echo "<script>alert('Password has been changed!'); document.location = 'index.php';</script>";
            } else {
                echo "<script>alert('New password and confirm password do not match!');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Jujutsu Kaisen - Shibuya Incident</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="icon" href="assets/icon/jujutsu-kaisen-highschool.ico"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{background-color: rgba(13, 13, 13);}
            nav{margin-top: 28px;}
            nav span{color: white;cursor: default;}
        </style>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.php"><img src="assets/icon/arrow-left-solid.svg" class="arrow-account"></a><span>Homepage</span></li>
            </ul>
        </nav>    
        <div class="account-container">
            <div class="account-section">
                <div class="account-left">
                    <img src="assets/images/logo.png" class="logo" alt="Logo">
                    <ul>
                        <li id="users" class="active"><a onclick="userProfiles();">User Profiles</a></li>
                        <li id="passwords"><a onclick="changePassword();">Change Password</a></li>
                        <!--<li><a onclick="insertArticle();">Insert Article</a></li>
                        <li><a onclick="insertEpisode();">Insert Episode</a></li>-->
                    </ul>
                </div>
                <div class="account-right" id="user-profiles">
                    <h4>User Profiles</h4>
                    <div class="account-content">
                        <form name="account-profiles" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <label>Display Name</label>
                            <input type="text" name="fullname" placeholder="Display name" required>
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" disabled>
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" disabled>
                            <input type="submit" name="update-profile" value="Modify">
                        </form>
                    </div>
                    <a href='logout.php' class='btn-logout'><img src="assets/icon/power-off-solid.svg" class="img-logout" alt="Logout"></a>
                </div>
                <div class="account-right" id="change-password" style="display:none">
                    <h4>Change Password</h4>
                    <div class="account-content">
                        <form name="account-password" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                            <label>Current Password</label>
                            <input type="password" name="old_password" placeholder="Current password" required>
                            <label>New Password</label>
                            <input type="password" name="new_password" placeholder="New password" required>
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" placeholder="Confirm password" required>
                            <input type="submit" name="change_password" value="Change">
                        </form>
                    </div>
                    <a href='logout.php' class='btn-logout'><img src="assets/icon/power-off-solid.svg" class="img-logout" alt="Logout"></a>
                </div>
                <!--<div class="account-right" id="insert-article" style="display:none">
                    <h4>Insert Article</h4>
                    <div class="account-content">
                        <form name="account-password" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <label>Article Title</label>
                            <input type="text" name="article-title" placeholder="Article title" required>
                            <label>Article Content</label>
                            <textarea name="article-content" placeholder="Article content" required></textarea>
                            <label>Article Image</label>
                            <input type="file" name="fullname" value="Muhammad Sultan Alhakim" required>
                            <input type="submit" name="insert-article" value="Modify">
                        </form>
                    </div>
                </div>-->
            </div>
        </div>
        <script src="assets/js/script.js"></script>
    </body>
</html>