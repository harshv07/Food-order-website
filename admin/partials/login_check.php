<?php 
    // validate authorization
    //whether user is logged in or not
    if(!isset($_SESSION['user'])){

        $_SESSION['nologin'] = 'Please Log in to access admin Panel';
        header('location:'.HOMEPAGE.'admin/login.php');
    }
?>