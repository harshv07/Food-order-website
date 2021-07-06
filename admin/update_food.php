<?php include('partials/menu.php'); ?>



<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql2 = "SELECT * FROM food WHERE id = $id";

    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $availaible = $row2['availaible'];
} else {
    header('location:' . HOMEPAGE . 'admin/mfood.php');
}
?>


<div class="new">

    <hr>
    <h1>Update Food</h1>


    <a href="<?php echo HOMEPAGE; ?>admin/add_category.php" class="btn third">Add Category</a>

    <div class="sec">


        <form action="" method="post" enctype="multipart/form-data">

            <table>

                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
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
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image</td>
                    <td>
                        <?php

                        if ($current_image == "") {
                            echo "<div class = 'error'> Image not availaible</div>";
                        } else {
                        ?>
                            <img src="<?php echo HOMEPAGE; ?>images/food/<?php echo $current_image; ?>" width="150px">
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

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {

                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {

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
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Availaible :</td>
                    <td>
                        <input <?php if ($availaible == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="availaible" value="Yes">Yes
                        <input <?php if ($availaible == "No") {
                                    echo "checked";
                                } ?> type="radio" name="availaible" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update" class="btn third">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $availaible = $_POST['availaible'];


            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {

                    $ext = end(explode('.', $image_name));

                    $image_name = "Food_Name_" . rand(0000, 9999) . "." . $ext;

                    $src = $_FILES['image']['tmp_name'];
                    $dest = "../images/food/" . $image_name;

                    $upload = move_uploaded_file($src, $dest);

                    if ($upload == false) {

                        $_SESSION['upload'] = "<div class = 'error' > Failed to upload Image </div>";
                        header('location:' . HOMEPAGE . '/admin/mfood.php');
                        die();
                    }


                    $remove_path = "../images/food/" . $current_image;
                    $remove = unlink($remove_path);

                    if ($remove == false) {
                        $_SESSION['remove-failed'] = "<div class = 'error'> Failed to remove image </div>";
                        header('location:' . HOMEPAGE . 'admin/mfood.php');
                        die();
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql3 = "UPDATE food SET title = '$title',description = '$description',price = $price,image_name = '$image_name',category_id = $category, featured = '$featured',availaible = '$availaible' WHERE id = $id;";



            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == true) {
                $_SESSION['update'] = "<div class = 'success' > Food updated succesfully!</div>";
                header('location:' . HOMEPAGE . 'admin/mfood.php');
            } else {
                $_SESSION['update'] = "<div class = 'error' > Failed to update food!</div>";
                header('location:' . HOMEPAGE . 'admin/mfood.php');
            }
        }
        ?>
    </div>
</div>



<?php
include('partials/footer.php');

?>