<?php include('front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo HOMEPAGE; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php 

        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 

                //create sql queries to display category form db

                $sql = "SELECT * FROM category WHERE availaible = 'Yes' and featured = 'Yes'     LIMIT 3";

                //exwcute query

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['img_name'];

                        ?>

                        <a href="<?php echo HOMEPAGE; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php if($image_name == ""){
                                    //check if img is avialaible
                                    echo "<div class = 'error'>Image Not Availaible</div>";
                                } else{
                                    ?>

                                        <img src="<?php echo HOMEPAGE; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                    <?php
                                }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title;  ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                    

                }else{

                    echo "<div class = 'error'> Categories Not availaible! </div ";
                }

            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->






    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                $sql2 = "SELECT * FROM  food WHERE availaible = 'Yes' and featured = 'Yes' LIMIT 6";            
                $res2 = mysqli_query($conn,$sql2);
                
                $count2 = mysqli_num_rows($res2);

                if($count2 > 0){

                    while($row2 = mysqli_fetch_assoc($res2)){
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


                    echo "<div class = 'error'> Food not Availaible! </div>";
                }

            ?>



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('front/footer.php'); ?>