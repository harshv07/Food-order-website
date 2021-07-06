<?php include('partials/menu.php'); ?>




<div class="new">

    <hr>
    <h1>Category Section</h1>

    <?php 

        if(isset($_SESSION['added'])){
            echo $_SESSION['added'];
            unset($_SESSION['added']);
        }

        if(isset($_SESSION['removed'])){
            echo $_SESSION['removed'];
            unset($_SESSION['removed']);
        }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no-cat'])){
            echo $_SESSION['no-cat'];
            unset($_SESSION['no-cat']);
        }


        if(isset($_SESSION['updated'])){
            echo $_SESSION['updated'];
            unset($_SESSION['updated']);
        }

        if(isset($_SESSION['img_u'])){
            echo $_SESSION['img_u'];
            unset($_SESSION['img_u']);
        }


        if(isset($_SESSION['failed_rm'])){
            echo $_SESSION['failed_rm'];
            unset($_SESSION['failed_rm']);
        }

    ?>


    <a href="<?php echo HOMEPAGE; ?>admin/add_category.php" class="btn third">Add Category</a>

    <div class="sec">


        <form action="" method="post" enctype="multipart/form-data">

            <table>

                <thead>

                    <tr>
                        <th>S.NO</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Availaible</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php    
                //query to get all category
                $sql = "SELECT * FROM category";
                //exe query
                $res = mysqli_query($conn,$sql);
                //cnt rouws

                $count = mysqli_num_rows($res);
                $i = 1;
                //check for data in db

                if($count > 0){

                    //we have data in db
                    while($row = mysqli_fetch_assoc($res)){

                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name =  $row['img_name'];
                        $featured = $row['featured'];
                        $availaible = $row['availaible'];

                        ?>

                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    <?php 

                                        if($image_name != ""){
                                            
                                            ?>
                                                <img src="<?php echo HOMEPAGE; ?>images/category/<?php echo $image_name ?>" width="100px">
                                            <?php
                                        }else{
                                            echo "<div class = 'error'> Image not added <div>";
                                        }

                                    ?>
                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $availaible; ?></td>
                                <td>
                                    <a href="<?php echo HOMEPAGE; ?>admin/update_cat.php?id=<?php echo $id; ?>" class="example_b green">Update Category</a>
                                    <a href="<?php echo HOMEPAGE; ?>admin/delete_cat.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class="example_b red">Delete Category</a>
                                </td>
                            </tr>


                        <?php
                    }

                }else{

                    // db is empty
                    ?>
                    <tr>
                        <td>
                            <div colspan = "6" class="error">NO category Added</div>
                        </td>
                    </tr>

                    <?php 
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