<?php include('partials/menu.php'); ?>




<div class="new">

<hr>
<h1>Add Category</h1>

<div class="sec">

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


    <form action="" method="post"  enctype="multipart/form-data">

        <table>

        <tr>
                    <td>Title</td>
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
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>Availaible</td>
                    <td>
                        <input type="radio" name="availaible" value="Yes"> Yes
                        <input type="radio" name="availaible" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name = "submit" value="Add Category" class="btn third">
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