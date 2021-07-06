<?php include('partials/menu.php'); ?>




<div class="new">

<hr>
<h1>Add FooD</h1>

        <?php 

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            

        ?>

<div class="sec">


    <form action="" method="post" enctype="multipart/form-data">

        <table>

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
                        <input type="submit" name="submit" value="submit" class="btn third">
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



<?php 
    include('partials/footer.php');

?>