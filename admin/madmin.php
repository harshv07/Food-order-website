<?php include('partials/menu.php'); ?>




<div class="new">

    <hr>
    <h1>Admin Panel</h1>

    <?php
    if (isset($_SESSION['add'])) {

        echo $_SESSION['add']; //desplaying session
        echo "<br><br><br>";
        unset($_SESSION['add']); //removing session
    }
    if (isset($_SESSION['delete'])) {

        echo $_SESSION['delete']; //desplaying session
        echo "<br><br><br>";
        unset($_SESSION['delete']); //removing session
    }


    if (isset($_SESSION['update'])) {

        echo $_SESSION['update']; //desplaying session
        echo "<br><br><br>";
        unset($_SESSION['update']); //removing session
    }

    if (isset($_SESSION['notfound'])) {

        echo $_SESSION['notfound']; //desplaying session
        echo "<br><br><br>";
        unset($_SESSION['notfound']); //removing session
    }
    if (isset($_SESSION['pwd-not-match'])) {
        echo $_SESSION['pwd-not-match'];
        echo "<br><br><br>";
        unset($_SESSION['pwd-not-match']);
    }

    if (isset($_SESSION['changepass'])) {
        echo $_SESSION['changepass'];
        echo "<br><br><br>";
        unset($_SESSION['changepass']);
    }



    ?>


    <a href="add_admin.php" class="btn third">Add Admin</a>

    <div class="sec">


        <form action="" method="post" enctype="multipart/form-data">

            <table>

                <thead>

                    <th>S.NO</th>
                    <th>Full Name</th>
                    <th>Username</th>   
                    <th>Action</th>
                </thead>

                <?php 

                $sql = "SELECT * FROM admin";

                $res = mysqli_query($conn,$sql);

                //check if query is executed or not
                if($res == true){
                    //count to check if data is availaible or not
                    $count = mysqli_num_rows($res); //function to get all rows in database
                    $i=1;

                    if($count>0){

                        while($rows = mysqli_fetch_assoc($res)){

                            
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['user_name'];
                            // display values
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td> <?php echo $full_name; ?> </td>
                                <td> <?php echo $username; ?> </td>
                                <td>
                                    <a href="<?php echo HOMEPAGE;  ?>admin/update_admin.php?id=<?php echo $id;?>" class="example_b green">Update Admin</a>
                                    <a href="<?php echo HOMEPAGE;  ?>admin/delete_admin.php?id=<?php echo $id;?>" class="example_b red">Delete Admin</a>
                                    <a href="<?php echo HOMEPAGE;  ?>admin/change_password.php?id=<?php echo $id;?>" class="btn third">Change Password</a>
                                </td>
                            </tr>

                            <?php 
                        }
                        
                    }else{

                    }
                }

            ?>
            </table>
        </form>
    </div>
</div>



<?php
include('partials/footer.php');

?>