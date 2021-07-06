<?php include('partials/menu.php'); ?>




<div class="new">

<hr>
<h1>Change Password</h1>

        <?php   
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        

<div class="sec">


    <form action="" method="post" enctype="multipart/form-data">

        <table>

        <tr>
                    <td>current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn third">
                    </td>
                </tr>
        </table>
    </form>
</div>
</div>

<?php

            if (isset($_POST['submit'])) {
                // echo "clicked";

                $id = $_POST['id'];

                $current_password = md5($_POST['current_password']);
                // echo "<br>";

                $new_password = $_POST['new_password'];

                $confirm_password = $_POST['confirm_password'];

                $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";

                $res = mysqli_query($conn, $sql);

                if ($res == true) {

                    $count = mysqli_num_rows($res);
                    
                    if ($count == 1) {
                        // echo "user found";
                            
                        if($new_password==$confirm_password){

                            $sql2 = "UPDATE admin SET
                                    password = '$new_password'
                                    WHERE id = $id";

                            $res2 = mysqli_query($conn,$sql2);

                            if($res2 == true){
                                $_SESSION['changepass'] = '<div class = "success"> Password Changed Sucessfully</div>';
                                header("location:" . HOMEPAGE . 'admin/madmin.php');
                            }else{
                                $_SESSION['changepass'] = '<div class = "error"> Failed to change pass try after some time</div>';
                                header("location:" . HOMEPAGE . 'admin/madmin.php');
                            }

                        }else
                        {
                            $_SESSION['pwd-not-match'] = '<div class = "error"> pass not matched</div>';
                            header("location:" . HOMEPAGE . 'admin/madmin.php');
                        }

                    }
                    else
                    {

                        $_SESSION['notfound'] = '<div class = "error"> User not found</div>';
                        header("location:".HOMEPAGE.'admin/madmin.php');
                    }
                }
}
?>



<?php 
    include('partials/footer.php');

?>