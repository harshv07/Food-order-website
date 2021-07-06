<?php 

        include('../config/connection.php');

        if(isset($_GET['id']) && isset($_GET['image_name'])){

            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            $path = "../images/category/".$image_name;

            $rem = unlink($path);
            
            if($rem == false){
            
                $_SESSION['removed'] = "<div class = 'success'> Failed to remove Image </div>"; 
                header('location:'.HOMEPAGE.'admin/mcategory.php');
                die();
            }


            $sql = "DELETE FROM category WHERE id = $id";

            $res = mysqli_query($conn,$sql);

            if($res == true){

                $_SESSION['delete'] = "<div class = 'success'>  Category Removed!</div>";
                header('location:'.HOMEPAGE.'admin/mcategory.php');
            }else{
                $_SESSION['delete'] = "<div class = 'success'> Faild to delete category! </div>";
                header('location:'.HOMEPAGE.'admin/mcategory.php');
            }
            
        }else{

            header('location:'.HOMEPAGE.'admin/mcategory.php');
        }

?>