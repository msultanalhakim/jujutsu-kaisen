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

        $sql = "SELECT * FROM tbl_user WHERE username='$username'";
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Jujutsu Kaisen - Shibuya Incident</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                            <input type="text" name="email" value="msultanalhakim@gmail.com" disabled>
                            <label>Username</label>
                            <input type="text" name="username" value="msultanalhakim" disabled>
                            <input type="submit" name="update-profile" value="Modify">
                        </form>
                    </div>
                    <a href='logout.php' class='btn-logout'><img src="assets/icon/power-off-solid.svg" class="img-logout" alt="Logout"></a>
                </div>
                <div class="account-right" id="change-password" style="display:none">
                    <h4>Change Password</h4>
                    <div class="account-content">
                        <form name="account-password" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <label>Current Password</label>
                            <input type="password" name="current_password" placeholder="Current password" required>
                            <label>New Password</label>
                            <input type="password" name="fullname" placeholder="New password" required>
                            <label>Confirm Password</label>
                            <input type="password" name="fullname" placeholder="Confirm password" required>
                            <input type="submit" name="update-password" value="Change">
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