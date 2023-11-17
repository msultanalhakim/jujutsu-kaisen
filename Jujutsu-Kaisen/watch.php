<?php
    include "connection.php";
    session_start();
    
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
        </style>
    </head>
    <body>
        <nav>
            <a href="index.php"><img src="assets/images/logo.png" class="logo" alt="Logo"></a>
            <ul>
                <li><a href="#">Merchants</a></li>
                <li class="dropdown">
                    <button class="dropbtn" onclick="dropdownNav()">Watch</button>
                    <ul class="dropdown-content" id="myDropdown">
                        <li><a href="">Season 1</a></li>
                        <li><a href="">Season 2</a></li>
                    </ul>
                </li>
                <li>
                <?php
                if(isset($_SESSION['username'])){
                    echo "<a href='account.php' class='nav-account'>Account</a>";
                }else{
                    echo "<a href='login.php' class='nav-account'>Login</a>";
                }
                ?>
                </li>
            </ul>
        </nav>
        <script src="assets/js/script.js"></script>
    </body>
</html>