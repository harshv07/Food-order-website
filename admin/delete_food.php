<?php 

    include('../config/connection.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])){

        // echo "detelet";

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        if($image_name  != ""){

            $path = "../images/food/".$image_name;
            $rem = unlink($path);

            if($rem == false){
            
                $_SESSION['upload'] = "<div class = 'success'> Failed to remove Image </div>"; 
                header('location:'.HOMEPAGE.'admin/mfood.php');
                die();
            }
        }

        $sql = "DELETE FROM food WHERE id = $id";

        $res = mysqli_query($conn,$sql);

        if($res == true){

            $_SESSION['delete'] = "<div class = 'success'>  Food Removed!</div>";
            header('location:'.HOMEPAGE.'admin/mfood.php');
        }else{
            $_SESSION['delete'] = "<div class = 'success'> Faild to delete Food! </div>";
            header('location:'.HOMEPAGE.'admin/mfood.php');
        }

    }else{
        $_SESSION['loginfirst'] = "<div class = 'error'> Login First </div>";
        header('location:'.HOMEPAGE.'admin/mfood.php');
    }
?>