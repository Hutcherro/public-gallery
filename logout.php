<?php 
    session_start();
    if(isset($_SESSION['user'])){
        $_SESSION['user'] = "";
        $_SESSION['userId'] = "";
        session_unset();
        session_destroy();
        header('location: index.php');
        die();
    }
    else{
        header('location: index.php');
        die();
    }
?>