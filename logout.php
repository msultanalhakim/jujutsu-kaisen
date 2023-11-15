<?php
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    echo '<script>alert("Logout successful!"); window.location.href="login.php";</script>';
?>