
<?php 

    // include conn here to exxecute the query

    include('../config/connection.php');

    // get id of admin to delete

    $id = $_GET['id'];
    // create query to delete admin
    $sql = "DELETE FROM admin WHERE id = $id";

    //execute query

    $res = mysqli_query($conn,$sql);

    //check whether the query executed succesfull or not

    if($res == true){

        // echo "admin deleted";

        $_SESSION['delete'] = '<div class = "success">Admin Deleted Seccesfully</div>';
        header('location:'.HOMEPAGE.'admin/madmin.php');
    }else{
        $_SESSION['delete'] = '<div class = "error">Failed to Delete admin Try sometime Later</div>';
        header('location:'.HOMEPAGE.'admin/madmin.php');
    }

    //redirect to manage admin page either success or error

?>