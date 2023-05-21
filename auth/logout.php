<?php 
    // delete session
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    // delete cookie
    setcookie("id", "", time() - 3600);
    setcookie("username", "", time() - 3600);

    header("Location: ./../index.php");
    exit;
?>