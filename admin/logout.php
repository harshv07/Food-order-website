

<?php 

    include('../config/connection.php');
    //destrou session

    session_destroy();  //unset user session 

    header('location:'.HOMEPAGE.'admin/login.php');
?>