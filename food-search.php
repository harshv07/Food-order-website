<?php include('front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                $search = mysqli_real_escape_string($conn,$_POST['search']);
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php 

                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                

                if($count > 0){

                    while($row2 = mysqli_fetch_assoc($res)){
                        $id2 = $row2['id'];
                        $title2 = $row2['title'];
                        $price2 = $row2['price'];
                        $description = $row2['description'];

                        $image_name2 = $row2['image_name'];

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php 
                                        if($image_name2 ==""){
                                            echo "<div class = 'error'>Image Not Availaible</div>";
                                        }else{
                                            ?>
                                            <img src="<?php echo HOMEPAGE; ?>images/food/<?php echo $image_name2; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title2; ?></h4>
                                    <p class="food-price">$<?php echo $price2; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo HOMEPAGE; ?>order.php?food_id=<?php echo $id2;  ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>                            

                        <?php
                    }

                }else{
                    echo "<div class = 'error'>Food not availaible</div>";
                }

            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('front/footer.php'); ?>