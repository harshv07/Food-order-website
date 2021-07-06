<?php include('partials/menu.php'); ?>




<div class="new">

    <h1>Update Admin</h1>


    <div class="sec">

    <?php 
            //get id from page
            $id = $_GET['id'];
            //crete query

            $sql = "SELECT * FROM admin WHERE id = $id ";

            //execute query
            $res = mysqli_query($conn,$sql);

            //check if qury is executed or not

            if($res == true){

                $count = mysqli_num_rows($res);
                //check count whether data is availaible or not
                if($count == 1){
                    // echo "admin available";
                    $row = mysqli_fetch_assoc($res);
                    
                    $full_name = $row['full_name'];
                    $user_name = $row['user_name'];
                }else{
                    header('location:'.HOMEPAGE.'admin/madmin.php');
                }

            }
        ?>


        <form action="" method="post" enctype="multipart/form-data">

            <table>

            <tr>
                    <td> Full Name :</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="user_name" value="<?php echo $user_name;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name = "submit" value="Update Admin" class="btn third">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

        if(isset($_POST['submit'])){
            
           $id = $_POST['id'];
           $full_name = $_POST['full_name'];
           $user_name = $_POST['user_name'];
        
           //create query to update admin
           $sql = "UPDATE admin SET 
                full_name = '$full_name',
                user_name = '$user_name'
                WHERE id = '$id'
                ";

            $res = mysqli_query($conn,$sql);

            if($res == true){

                $_SESSION['update'] = '<div class = "success"> Admin information updated</div>';
                header('location:'.HOMEPAGE.'admin/madmin.php');
            }else{
                $_SESSION['update'] = '<div class = "error">Admin information updation Failed</div>';
                header('location:'.HOMEPAGE.'admin/madmin.php');
            }
        }
?>

<?php
include('partials/footer.php');

?>