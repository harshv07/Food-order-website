<?php include('front/menu.php'); ?>


<?php 

    if(isset($_GET['category_id'])){
        
        $cat_id = $_GET['category_id'];

        $sql = "SELECT * FROM category WHERE id = $cat_id";

        $res = mysqli_query($conn,$sql);

        $row = mysqli_fetch_assoc($res);

        $cat_title = $row['title'];


    }else{

        header('location:'.HOMEPAGE);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $cat_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php

                $sql2 = "SELECT * FROM food WHERE category_id = $cat_id"; 

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

                    echo "<div class = 'error'> Food not availaible </div>";
                }

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('front/footer.php'); ?>