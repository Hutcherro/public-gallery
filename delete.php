<?php 
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: index.php');
        die();
    }

    include 'dbConfig.php';
    if($_POST['img-id'])
    {
        $query = 'DELETE FROM `images` WHERE `id` = ?';
        $result = $db->execute_query($query, [$_POST['img-id']]);
        if($result)
        {
            header("Location: user-profile.php");
            die();
        }else 
        {
            // echo "deleting error";
        }
    }
?>