<?php include('partials/menu.php'); ?>




<div class="new">

    <hr>
    <h1>Update Category</h1>

    <?php
    if (isset($_GET['id'])) {
        // 

        $id = $_GET['id'];

        $sql = "SELECT * FROM category WHERE id = $id";

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1) {

            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_img = $row['img_name'];
            $featured = $row['featured'];
            $availaible = $row['availaible'];
        } else {

            $_SESSION['no-cat'] = "<div class = 'error'> Category not Found</div>";

            header('location:' . HOMEPAGE . 'admin/mcategory.php');
        }
    } else {

        header('location:' . HOMEPAGE . 'admin/mcategory.php');
    }
    ?>



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
                    <td>Current Image</td>
                    <td>
                        <img src="<?php echo HOMEPAGE; ?>images/category/<?php echo $current_img; ?>" width="200px">
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
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>Availaible :</td>
                    <td>
                        <input <?php if ($availaible == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="availaible" value="Yes"> Yes
                        <input <?php if ($availaible == "No") {
                                    echo "checked";
                                } ?> type="radio" name="availaible" value="No"> NO
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn third">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {

            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_img = $_POST['current_img'];

            $featured = $_POST['featured'];
            $availaible  = $_POST['availaible'];


            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {



                    $ext = end(explode('.', $image_name));

                    //renamr image

                    $image_name = "Food_catefory_" . rand(000, 999) . '.' . $ext;


                    $src_path = $_FILES['image']['tmp_name'];

                    $dest_path = "../images/category/" . $image_name;

                    $upload = move_uploaded_file($src_path, $dest_path);
                    if ($upload == false) {
                        $_SESSION['img_u'] = "<div class = 'error'> Failed to upload image </div>";
                        header('location:' . HOMEPAGE . 'admin/mcategory.php');
                        die();
                    }

                    $rm_path = "../images/category/" . $current_img;
                    $remove = unlink($rm_path);

                    if ($remove == false) {

                        $_SESSION['failed_rm'] = "<div class = 'error'> Failed to remove current image</div>";
                        header('location:' . HOMEPAGE . 'admin/mcategory.php');
                        die();
                    }
                } else {
                    $image_name = $current_img;
                }
            } else {
                $image_name = $current_img;
            }


            $sql2 = "UPDATE category SET
                            title = '$title',
                            img_name = '$image_name',
                            featured = '$featured',
                            availaible = '$availaible'
                            where id = $id
                    ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res == true) {

                $_SESSION['updated'] = "<div class = 'success'> Category updated !</div>";
                header('location:' . HOMEPAGE . 'admin/mcategory.php');
            } else {
                $_SESSION['updated'] = "<div class = 'success'> Failed to update Category !</div>";
                header('location:' . HOMEPAGE . 'admin/mcategory.php');
            }
        }
        ?>
    </div>
</div>



<?php
include('partials/footer.php');

?>