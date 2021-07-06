<?php include('partials/menu.php'); ?>




<div class="new">

    <hr>
    <h1>Food Section</h1>


    <a href="<?php echo HOMEPAGE; ?>admin/add_food.php" class="btn third">Add Food</a>

    <div class="sec">


        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }



        if (isset($_SESSION['loginfirst'])) {
            echo $_SESSION['loginfirst'];
            unset($_SESSION['loginfirst']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }




        ?>
        <form action="" method="post" enctype="multipart/form-data">

            <table>

                <thead>

                    <tr>
                        <th>S.NO</th>
                        <th>Title :</th>
                        <th>Price :</th>
                        <th>Image :</th>
                        <th>Featured :</th>
                        <th>Active :</th>
                        <th>Actions :</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $sql = "SELECT * FROM food";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $i = 1;

                    if ($count > 0) {

                        while ($row = mysqli_fetch_assoc($res)) {
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

                                    if ($image_name == "") {
                                        echo "<div class = 'error'> Image not added</div>";
                                    } else {
                                    ?>
                                        <img src="<?php echo HOMEPAGE; ?>images/food/<?php echo $image_name ?>" width="150px">
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $availaible; ?></td>
                                <td>
                                    <a href="<?php echo HOMEPAGE; ?>admin/update_food.php?id=<?php echo $id; ?>" class="example_b green">Update Food</a>
                                    <a href="<?php echo HOMEPAGE; ?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="example_b red">Delete Food</a>
                                </td>
                            </tr>


                    <?php
                        }
                    } else {

                        echo "<tr><td colspan = '7' clas = 'error'> Food not Added yet.</td> </tr>";
                    }
                    ?>

                </tbody>
            </table>
        </form>
    </div>
</div>



<?php
include('partials/footer.php');

?>