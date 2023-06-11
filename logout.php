<?php

    session_start();
    // session_unset();
    unset($_SESSION['userid']);
    unset($_SESSION['name']);
    unset($_SESSION['mail']);
    print_r($_SESSION);
    session_destroy();
    header('location:login.php');

?>