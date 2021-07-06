<!-- menu  -->



<?php include('../config/connection.php');
include('login_check.php');
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />">
    <title>Foodies</title>
</head>

<body>
    <div class="navbar">
        <div class="navbar-container container">
            <input type="checkbox" name="" id="">
            <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
            <ul class="menu-items">
                <li><a href="index.php">HOME</a></li>
                <li><a href="madmin.php">Admin</a></li>
                <li><a href="mcategory.php">Category</a></li>
                <li><a href="mfood.php">Food</a></li>
                <li><a href="morder.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <h1 class="logo">FW</h1>
        </div>
    </div>
</body>

</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodies</title>
    <link rel="stylesheet" href="../css/adminstyle.css">
    <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />">
</head>

<body>
<br><br><br><br><br>



<!-- add admin  -->


<?php
include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="user_name" placeholder="Enter username"></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>






<?php
include('partials/footer.php');
?>




<?php

if (isset($_POST['submit'])) {
    //button clicked
    // echo "button clicked";

    //GEt data from user or form
    $full_name = $_POST['full_name'];
    $username = $_POST['user_name'];
    $password = md5($_POST['password']); //password is encrypted using md5

    // sql query to insert data into database

    $sql = "INSERT INTO admin SET
            full_name = '$full_name',
            user_name = '$username',
            password = '$password'
    ";


    //Execute query into database

    $res = mysqli_query($conn, $sql) or die('try latter');

    //check data is inserted or not

    if ($res == true) {
        // echo "data inserted";

        // creating session
        $_SESSION['add'] = "Admin Added succesfully";
        //redirect page
        header("location:" . HOMEPAGE . 'admin/madmin.php');
    } else {
        // echo "data is failed to insert";

        $_SESSION['add'] = "Failed to add Admin";
        //redirect page
        header("location:" . HOMEPAGE . 'admin/add_admin.php');
    }
}

?>




<!-- add category  -->


<?php include('partials/menu.php'); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['added'])){
                echo $_SESSION['added'];
                unset($_SESSION['added']);
            }

            if(isset($_SESSION['img_u'])){
                echo $_SESSION['img_u'];
                unset($_SESSION['img_u']);
            }
        ?>

        <br><br>

        <!-- ADd category form -->
        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>Availaible :</td>
                    <td>
                        <input type="radio" name="availaible" value="Yes"> Yes
                        <input type="radio" name="availaible" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name = "submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
        
            if(isset($_POST['submit'])){
                
                $title = $_POST['title'];
                echo $title;
                echo "<br><br>";
                
                //for radio type
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                    // echo "clicked featured"; 
                }else{
                    $featured = "No";
                }


                if(isset($_POST['availaible'])){
                    $availaible = $_POST['availaible'];
                    // echo "clicked availaible";
                }else{
                    $availaible = "No";
                }

                // print_r($_FILES['image']);

                // die();

                if(isset($_FILES['image']['name'])){

                    $image_name = $_FILES['image']['name'];

                    //auto rename image 
                    //get extension first

                    $ext = end(explode('.',$image_name));

                    //renamr image

                    $image_name = "Food_catefory_".rand(000,999).'.'.$ext;

                    


                    $src_path = $_FILES['image']['tmp_name'];

                    $dest_path = "../images/category/".$image_name;

                    $upload = move_uploaded_file($src_path,$dest_path); 
                    if($upload == false){
                        $_SESSION['img_u'] = "<div class = 'error'> Failed to upload image </div>";
                        header('location:'.HOMEPAGE.'admin/add_category.php');
                        die();
                    }

                }else{
                    $image_name = "";
                }

                $sql = "INSERT INTO category SET
                        title = '$title',
                        img_name = '$image_name',
                        featured = '$featured',
                        availaible = '$availaible'
                        ";

                $res = mysqli_query($conn, $sql);

                if($res == true){
                    $_SESSION['added'] = "<div class = 'success'> Category added succesfully</div>";
                    header('location:'.HOMEPAGE.'admin/mcategory.php');
                }else{
                    
                    $_SESSION['added'] = "<div class = 'error'> Failed to add Category </div>";
                    header('location:'.HOMEPAGE.'admin/add_category.php');
                }

                

    
            }

            
        ?>

    </div>
</div>




<?php 
    include('partials/footer.php');

?>




<!-- add food  -->


<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            

        ?>

        <br><br>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl">
                
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Title">
                    </td>
                </tr>

                <tr>
                    <td>Description :</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Image :</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">


                            <?php 

                                $sql = "SELECT * FROM category WHERE availaible = 'Yes'";

                                $res = mysqli_query($conn,$sql);
                                
                                $count = mysqli_num_rows($res);

                                if($count > 0){

                                    while($row = mysqli_fetch_assoc($res)){

                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }

                                }else{

                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }
                            ?>  
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Availaible :</td>
                    <td>
                        <input type="radio" name="availaible" value="Yes">Yes
                        <input type="radio" name="availaible" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

            if(isset($_POST['submit'])){
                
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                if(isset($_POST['featured'])){

                    $featured = $_POST['featured'];
                }else{
                    $featured  = 'No';
                }

                if(isset($_POST['availaible'])){

                    $availaible = $_POST['availaible'];
                }else{
                    $availaible  = 'No';
                }

                if(isset($_FILES['image']['name'])){

                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){

                        $ext = end(explode('.',$image_name)); 

                        $image_name = "Food_Name_".rand(0000,9999).".".$ext;

                        $src = $_FILES['image']['tmp_name'];
                        $dest = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src,$dest);

                        if($upload == false){

                            $_SESSION['upload'] = "<div class = 'error' > Failed to upload Image </div>";
                            header('location:'.HOMEPAGE.'/admin/add_food.php');
                            die();
                        }
                    }

                }else{
                    $image_name = "";

                }
                $sql2 =  "INSERT INTO food SET title = '$title', description = '$description', price = $price, image_name = '$image_name' ,category_id = '$category', featured = '$featured',availaible = '$availaible'";

                $res2 = mysqli_query($conn,$sql2);
                
                if($res2==true){

                    $_SESSION['add'] = "<div class = 'success'> Food added succesfully!</div>";
                    header('location:'.HOMEPAGE.'admin/mfood.php');
                }else{
                    $_SESSION['add'] = "<div class = 'error'> Failed to add food!</div>";
                    header('location:'.HOMEPAGE.'admin/mfood.php');
                }
            }
        ?>
    </div>
</div>



<?php include('partials/footer.php');
?>


<!-- change password  -->


<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl2">
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
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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

<!-- madmin  -->

<?php
include('partials/menu.php');
?>


<!-- main section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Admin Panel</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){

                echo $_SESSION['add']; //desplaying session
                echo "<br><br><br>";
                unset($_SESSION['add']); //removing session
            }
            if(isset($_SESSION['delete'])){

                echo $_SESSION['delete']; //desplaying session
                echo "<br><br><br>";
                unset($_SESSION['delete']); //removing session
            } 
             
            
            if(isset($_SESSION['update'])){

                echo $_SESSION['update']; //desplaying session
                echo "<br><br><br>";
                unset($_SESSION['update']); //removing session
            }

            if(isset($_SESSION['notfound'])){

                echo $_SESSION['notfound']; //desplaying session
                echo "<br><br><br>";
                unset($_SESSION['notfound']); //removing session
            } 
            if(isset($_SESSION['pwd-not-match'])){
                echo $_SESSION['pwd-not-match'];
                echo "<br><br><br>";
                unset( $_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['changepass'])){
                echo $_SESSION['changepass'];
                echo "<br><br><br>";
                unset( $_SESSION['changepass']);
            }
            
            

        ?>

        <a href="add_admin.php" class="btn-primary">Add Admin</a>
        <br><br>
        <br>
        <table class="tbl">
            <tr id="header">
                <th>S.NO</th>
                <th>Full Name</th>
                <th>Username</th>   
                <th>Action</th>
            </tr>


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
                                    <a href="<?php echo HOMEPAGE;  ?>admin/change_password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo HOMEPAGE;  ?>admin/update_admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo HOMEPAGE;  ?>admin/delete_admin.php?id=<?php echo $id;?>" class="btn-red">Delete Admin</a>
                                </td>
                            </tr>

                            <?php 
                        }
                        
                    }else{

                    }
                }

            ?>
        </table>
    </div>
</div>
<!-- footer section -->


<?php
include('partials/footer.php');
?>


<!-- mfood  -->


<?php include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Food Section</h1>
        <br><br>


        <a href="<?php echo HOMEPAGE; ?>admin/add_food.php" class="btn-primary">Add Food</a>
        <br><br>
        <br>

        <?php 
        
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            

            if(isset($_SESSION['loginfirst'])){
                echo $_SESSION['loginfirst'];
                unset($_SESSION['loginfirst']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            

            
        ?>

        <table class="tbl">
            <tr>
                <th>S.NO</th>
                <th>Title :</th>
                <th>Price :</th>
                <th>Image :</th>
                <th>Featured :</th>
                <th>Active :</th>
                <th>Actions :</th>
            </tr>

            <?php
                $sql = "SELECT * FROM food";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                $i = 1;

                if($count > 0){

                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $availaible = $row['availaible'];
                        ?>
                        
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>$<?php echo $price; ?></td>
                                <td>
                                    <?php 
                                    
                                        if($image_name == ""){
                                            echo "<div class = 'error'> Image not added</div>";
                                        }else{
                                            ?>
                                            <img src="<?php echo HOMEPAGE; ?>images/food/<?php echo $image_name ?>" width="150px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $availaible; ?></td>
                                <td>
                                    <a href="<?php echo HOMEPAGE; ?>admin/update_food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo HOMEPAGE; ?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-red">Delete Food</a>
                                </td>
                            </tr>


                        <?php
                    }

                }else{

                    echo "<tr><td colspan = '7' clas = 'error'> Food not Added yet.</td> </tr>";
                }
            ?>

            

            
        </table>
    </div>
</div>

<?php include('partials/footer.php');
?>





<!-- morder  -->

<?php include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Order Section</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['order_update'])){
                echo $_SESSION['order_update'];
                unset($_SESSION['order_update']);
            }

        ?>
        <br><br>
        <div class="res">

            <table class="tbl">
                <tr>
                    <th>S.NO</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order_Date</th>
                    <th>Status</th>
                    <th>Customer</th>
                    <th>contact</th>
                    <th>email</th>
                    <th>address</th>
                    <th>Action</th>
                </tr>
    
                <?php
    
                    $sql = "SELECT * FROM ordered";
    
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    $i = 1;
                    if($count > 0){
    
                        while($row = mysqli_fetch_assoc($res)){
    
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['quantity'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email= $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>

                                    <td>
                                        
                                    <?php 
                                    
                                        if($status == "Ordered"){
                                            echo "<label> $status </label>";
                                        }else if($status == "On delivery"){
                                            
                                            echo "<label style = 'color : orange'> $status </label>";
                                        }else if($status == "Delivered"){
                                            
                                            echo "<label style = 'color : green'> $status </label>";
                                        }else if($status == "Cancelled"){
                                            echo "<label style = 'color : red'> $status </label>";
                                        }
                                    
                                    ?>
                                
                                    </td>
                                    
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo HOMEPAGE; ?>admin/update_order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                    </td>
                                </tr>
    
                            <?php
                        }
                    }else{
    
                        echo "<tr><td colspan ='12' class = 'error'>Orders Not availaible</td></tr>";
                    }
    
                ?>
    
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php');
?>



<!-- update_admin  -->


<?php
include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1> 
        <br><br>
        <br>

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

        <form action="" method="post">
            <table class="tbl2">
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
                        <input type="submit" name = "submit" value="Update Admin" class="btn-secondary">
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



<!-- update cate  -->


<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br /><br />

        <?php 
            if(isset($_GET['id'])){
                // 
                
                $id = $_GET['id'];

                $sql = "SELECT * FROM category WHERE id = $id";

                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                
                if($count == 1){

                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_img = $row['img_name'];
                    $featured = $row['featured'];
                    $availaible = $row['availaible'];
                    
                }else{
                    
                    $_SESSION['no-cat'] = "<div class = 'error'> Category not Found</div>";

                    header('location:'.HOMEPAGE.'admin/mcategory.php');
                }


            }else{

                header('location:'.HOMEPAGE.'admin/mcategory.php');
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <img src="<?php echo HOMEPAGE; ?>images/category/<?php echo $current_img;?>" width="200px">
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No") {echo "checked";} ?>  type="radio" name="featured" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>Availaible :</td>
                    <td>
                        <input <?php if($availaible == "Yes") {echo "checked";} ?> type="radio" name="availaible" value="Yes"> Yes
                        <input <?php if($availaible == "No") {echo "checked";} ?> type="radio" name="availaible" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name = "submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


        <?php 

                if(isset($_POST['submit'])){
                    
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_img = $_POST['current_img'];

                    $featured = $_POST['featured'];
                    $availaible  = $_POST['availaible'];


                    if(isset($_FILES['image']['name'])){
                        
                        $image_name = $_FILES['image']['name'];

                        if($image_name != ""){


                            
                            $ext = end(explode('.',$image_name));

                            //renamr image
        
                            $image_name = "Food_catefory_".rand(000,999).'.'.$ext;
        
        
                            $src_path = $_FILES['image']['tmp_name'];
        
                            $dest_path = "../images/category/".$image_name;
        
                            $upload = move_uploaded_file($src_path,$dest_path); 
                            if($upload == false){
                                $_SESSION['img_u'] = "<div class = 'error'> Failed to upload image </div>";
                                header('location:'.HOMEPAGE.'admin/mcategory.php');
                                die();
                            }

                            $rm_path = "../images/category/".$current_img;
                            $remove = unlink($rm_path);

                            if($remove == false){

                                $_SESSION['failed_rm'] = "<div class = 'error'> Failed to remove current image</div>";
                                header('location:'.HOMEPAGE.'admin/mcategory.php');
                                die();
                            }

                        }else{
                            $image_name = $current_img;
                        }

                    }else{
                        $image_name = $current_img;
                    }


                    $sql2 = "UPDATE category SET
                            title = '$title',
                            img_name = '$image_name',
                            featured = '$featured',
                            availaible = '$availaible'
                            where id = $id
                    ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res == true){

                        $_SESSION['updated'] = "<div class = 'success'> Category updated !</div>";
                        header('location:'.HOMEPAGE.'admin/mcategory.php');

                    }else{
                        $_SESSION['updated'] = "<div class = 'success'> Failed to update Category !</div>";
                        header('location:'.HOMEPAGE.'admin/mcategory.php');
                    }
                }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>


<!-- update food  -->



<?php include('partials/menu.php'); ?>
<?php 
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $sql2 = "SELECT * FROM food WHERE id = $id"; 

        $res2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($res2);
        
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $availaible = $row2['availaible'];


    }else{
        header('location:'.HOMEPAGE.'admin/mfood.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" >
                    </td>
                </tr>
                    
                <tr>
                    <td>Description :</td>
                    <td>
                        <textarea name="description" cols="30" rows="5">
                        <?php echo $description; ?>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Current image</td>
                    <td>
                        <?php 
                        
                            if($current_image == ""){
                                echo "<div class = 'error'> Image not availaible</div>";
                            }else{
                                ?>
                                <img src="<?php echo HOMEPAGE; ?>images/food/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image" value="">
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">


                            <?php 

                                $sql = "SELECT * FROM category WHERE availaible = 'Yes'";

                                $res = mysqli_query($conn,$sql);
                                
                                $count = mysqli_num_rows($res);

                                if($count > 0){

                                    while($row = mysqli_fetch_assoc($res)){

                                        $category_id = $row['id'];
                                        $category_title = $row['title'];
                                        ?>
                                        <option <?php if($current_category == $category_id) { echo "selected";} ?>  value="<?php echo $category_id ; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }

                                }else{

                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }
                            ?>  
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured == "Yes") { echo "checked";} ?>  type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No") { echo "checked";} ?>  type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Availaible :</td>
                    <td>
                        <input <?php if($availaible == "Yes") { echo "checked";} ?> type="radio" name="availaible" value="Yes">Yes
                        <input <?php if($availaible == "No") { echo "checked";} ?> type="radio" name="availaible" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>



            </table>    
        </form>

        <?php 
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $availaible = $_POST['availaible'];


                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];

                    if($image_name != ""){

                        $ext = end(explode('.',$image_name)); 

                        $image_name = "Food_Name_".rand(0000,9999).".".$ext;

                        $src = $_FILES['image']['tmp_name'];
                        $dest = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src,$dest);

                        if($upload == false){

                            $_SESSION['upload'] = "<div class = 'error' > Failed to upload Image </div>";
                            header('location:'.HOMEPAGE.'/admin/mfood.php');
                            die();
                        }


                        $remove_path ="../images/food/".$current_image; 
                        $remove = unlink($remove_path);

                        if($remove == false){
                            $_SESSION['remove-failed'] = "<div class = 'error'> Failed to remove image </div>";
                            header('location:'.HOMEPAGE.'admin/mfood.php');
                            die();
                        }
                        
                    }
                    else{
                        $image_name = $current_image;
                    }
                }else{
                    $image_name = $current_image;
                }

                $sql3 = "UPDATE food SET title = '$title',description = '$description',price = $price,image_name = '$image_name',category_id = $category, featured = '$featured',availaible = '$availaible' WHERE id = $id;";

                

                $res3 = mysqli_query($conn,$sql3);

                if($res3 == true){
                    $_SESSION['update'] = "<div class = 'success' > Food updated succesfully!</div>";
                    header('location:'.HOMEPAGE.'admin/mfood.php');
                }else{
                    $_SESSION['update'] = "<div class = 'error' > Failed to update food!</div>";
                    header('location:'.HOMEPAGE.'admin/mfood.php');
                }
            }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>




<!-- ---- update order ------  -->

<?php include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update order</h1>

        <br><br><br>

        <?php 
            if(isset($_GET['id'])){

                $id = $_GET['id'];

                $sql = "SELECT * FROM ordered WHERE id = $id"; 

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                if($count == 1){

                    $row = mysqli_fetch_assoc($res);
                    
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['quantity'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }else{
                    header('location:'.HOMEPAGE.'admin/morder.php');
                }


            }else{
                header('location:'.HOMEPAGE.'admin/morder.php');
            }
        ?>







        <form action="" method="post">
            <table class="tbl">
                <tr>
                    <td>Food Name :</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>$<?php echo $price; ?></td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <b><input type="number" name="quantity" value="<?php echo $qty; ?>"></b>
                    </td>
                </tr>

                <tr>
                    <td>Customer_name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status == 'Ordered') echo "selected"; ?> value="Ordered">Ordered</option>
                            <option <?php if($status == 'On delivery') echo "selected"; ?> value="On delivery">ON Delivery</option>
                            <option <?php if($status == 'Delivered') echo "selected"; ?> value="Delivered">Delivered</option>
                            <option <?php if($status == 'Cancelled') echo "selected"; ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>

                    
                </tr>
                <tr>
                    <td>customer_contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>customer_email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>customer_address</td>
                    <td>
                        <textarea name="customer_address"  cols="50" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>





            </table>

        </form>



        <?php 
            if(isset($_POST['submit'])){


                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['quantity'];

                $total = $price * $qty;

                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_email = $_POST['customer_email'];
                $customer_contact = $_POST['customer_contact'];
                $customer_address = $_POST['customer_address'];

                $sql2 = "UPDATE ordered SET
                        quantity = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_address = '$customer_address',
                        customer_email = '$customer_email'
                        WHERE id = $id

                ";

                $res2 = mysqli_query($conn,$sql2);

                if($res2 == true){

                    $_SESSION['order_update'] = "<div class = 'success' > Order updated </div>";
                    header('location:'.HOMEPAGE.'admin/morder.php');
                }else{

                    $_SESSION['order_update'] = "<div class = 'error' > Failed to update order </div>";
                    header('location:'.HOMEPAGE.'admin/morder.php');
                }


                
            }
        ?>
    </div>
</div>



<?php include('partials/footer.php');
?>


<!-- ---login g--- -->

<?php include('../config/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login FOODIES</title>
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>
<body>
    <div class="login text-center">
        <h1 >Login</h1>
        <br>

        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no_login'])){
                echo $_SESSION['no_login'];
                unset($_SESSION['no-login']);
            }
        ?>
        <br><br>
        <form action="" method="POST">
            Username:
            <input type="text" name="username" placeholder="Username">
            <br><br>
            Password:
            <input type="password" name="password" placeholder="Password">
            <br><br>
            <input type="submit" name = "submit" value="Login" class="btn-primary">
            <br><br>
            <p class="text-center">Created BY - Harsh Shingade</p>
        </form> 
    </div>
</body>
</html>


<?php 

    if(isset($_POST['submit'])){

        // $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        // $password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));

        $sql = "SELECT * FROM admin WHERE user_name = '$username' and password = '$password'";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count == 1){

            $_SESSION['login'] = '<div class="success"> Login Succesful! </div>';
            $_SESSION['user'] = $username;
            header('location:'.HOMEPAGE.'admin/index.php');
        }else{
            $_SESSION['login'] = '<div class="error"> Login Failed! Check Username/Password </div>';
            header('location:'.HOMEPAGE.'admin/login.php');
        }
    }
?>



<!-- css --- -->

@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,800;1,900&display=swap");

html {
  font-size: small;

}

body {
  font-family: "Poppins", sans-serif;
}
/* ################# utility classes ################ */

.container {
  max-width: 1200px;
  width: 90%;
  margin: auto;
}

/* ######################## navbar styline ########### */

/* for desktop mode  */

.navbar input[type="checkbox"],
.navbar .hamburger-lines {
  display: none;
}

.navbar {
  box-shadow: 0px 5px 10px 0px #aaa;
  position: fixed;
  width: 100%;
  background: #fff;
  opacity: 0.85;
  z-index: 999;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  height: 64px;
  align-items: center;
}

.menu-items {
  order: 2;
  display: flex;
}

.menu-items li {
  list-style: none;
  margin-left: 1.5rem;
  font-size: 2.1rem;
}

.logo {
  order: 1;
  font-size: 2.3rem;
}

.navbar a {
  color: #444;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease-in-out;
  font-size: 65%;
}

.navbar a:hover {
  color: #117964;
  text-decoration: underline;
}

.new {
  width: 100%;
  height: 100%;
  display: grid;
  place-items: center;
  
}

.sec {
  width: 100%;
  height: 100%;
  display: grid;
  place-items: center;
  overflow: auto;
}

.sec table {
  border-collapse: collapse;
  width: 90vw;
  height: 100vh;
  border: 1px solid #bdc3c7;
  box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
}

th {
  background: #16a085;
  color: #fff;
  position: sticky;
  top: 0px;
}

tbody td {
  z-index: 0;
}

td {
  z-index: 0;
}

tr {
  transition: all 0.2s ease-in;
}

th,
td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.red {
  display: inline-block;
  font-weight: 600;
  text-align: center;
  color: rgb(30, 255, 0);
  padding: 10px 0px;

  padding: 0.6em 2.5em;
  text-decoration: none;
  border-radius: 50px;
  outline: none;

  margin-bottom: 0rem;
  text-transform: uppercase;
}

.new h1,
.btn-primary {
  display: inline-block;
  font-weight: 600;
  text-align: center;
  background-color: #16a085;
  color: #fff;
  padding: 10px 0px;

  padding: 0.6em 2.5em;
  text-decoration: none;
  border-radius: 50px;
  outline: none;
  margin-top: 3em;

  margin-bottom: 3rem;
  text-transform: uppercase;
}

tr:hover {
  background-color: #f5f5f5;
  transform: scale(1.02);
  box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
}

#footer h2 {
  text-align: center;
  font-size: 1rem;
  padding: 3rem;
  font-weight: 500;
  color: #fff;
  background: rgb(65, 65, 65);
}

@media only screen and (max-width: 768px) {
  table {
    width: 90%;
  }
}

/* --------------------btn------------------------- */

.example_b {
  color: #fff !important;
  font-size: xx-small;
  text-transform: uppercase;
  text-decoration: none;
  padding: 12px;
  border-radius: 40px;
  display: inline-block;
  border: none;
  transition: all 0.4s ease 0s;
}

.red {
  background: red;
}

.green {
  background: green;
}

.blue {
  background: rgb(13, 1, 121);
}

.example_b:hover {
  text-shadow: 0px 0px 6px rgba(255, 255, 255, 1);
  transition: all 0.4s ease 0s;
}

.btn {
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: transparent;
  border: 2px solid #e74c3c;
  border-radius: 0.6em;
  color: #e74c3c;
  cursor: pointer;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  justify-content: left;
  flex-direction: column;
  -webkit-align-self: center;
  -ms-flex-item-align: center;
  align-self: center;
  font-size: 0.9rem;
  font-weight: 400;
  line-height: 1;
  margin: 20px;
  padding: 1em 2.5em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: "Montserrat", sans-serif;
  font-weight: 700;
}
.btn:hover,
.btn:focus {
  color: #fff;
  outline: 0;
}

.third {
  -webkit-transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
  transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
}
.third:hover {
  box-shadow: 0 0 40px 40px #e74c3c inset;
}

.success {
  font-size: medium;
  color: #08f83c;
  font-weight: 600;
}

.error {
  color: #a70808;
}

.login {
  border: 1px solid gray;
  width: 30%;
  margin: 10% auto;
}


<!-- index -->


<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <div class="col-4 text-center">

            <?php

            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">

            <?php

            $sql2 = "SELECT * FROM food";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
        </div>
        <div class="col-4 text-center">

            <?php

            $sql3 = "SELECT * FROM ordered";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br>
            Total orders
        </div>
        <div class="col-4 text-center">

            <?php

            $sql4 = "SELECT sum(total) AS total FROM ordered WHERE status = 'Delivered'";
            $res4 = mysqli_query($conn, $sql4);
            $row = mysqli_fetch_assoc($res4);
            $total_rev = $row['total'];
            ?>
            <h1>$<?php echo $total_rev; ?></h1>
            <br>
            Revenue Generated
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- footer section -->

<?php
include('partials/footer.php');

?>


