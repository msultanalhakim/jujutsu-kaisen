<?php
    session_start();
    session_destroy();

    echo '<script>alert("Logout Berhasil!");</script>';
    echo '<script>setTimeout(function(){window.location.href="login.php";}, 1000);</script>';
?>