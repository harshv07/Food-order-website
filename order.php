<?php include('front/menu.php'); ?>

<?php echo $price; ?>



<?php 

    if(isset($_GET['food_id'])){
        
        $food_id = $_GET['food_id'];

        $sql = "SELECT * FROM food WHERE id = $food_id";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count == 1){

            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $image_name = $row['image_name'];
            $price = $row['price'];

            

        }else{

            echo "<div class = 'error'> Food not Availaible! </div>";
        }

    }else{

        header('location:'.HOMEPAGE);
    }

?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php 
                            if($image_name ==""){
                                echo "<div class = 'error'>Image Not Availaible</div>";
                            }else{
                                ?>
                                <img src="<?php echo HOMEPAGE; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>            
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Eren yeager" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9561******" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            
            <?php 

                if(isset($_POST['submit'])){

                   $food = $_POST['food'];
                   $price = $_POST['price'];
                   $qty = $_POST['qty'];
                   $total = $qty * $price;

                   $order_date = date("Y-m-d h:i:s");
                   $status = "Order_placed";
                   $customer_name = $_POST['full-name'];
                   $customer_contact = $_POST['contact'];
                   $customer_email = $_POST['email'];
                   $customer_address = $_POST['address'];


                   $sql2 = "INSERT INTO ordered SET
                            food = '$food',
                            price = $price,
                            quantity =  $qty,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                    ";


                    $res2 = mysqli_query($conn,$sql2);

                    if($res2 == true){

                        $_SESSION['order'] = "<div class = 'success text-center'> Order placed </div>";
                        header('location:'.HOMEPAGE);

                    }else{

                        $_SESSION['order'] = "<div class = 'error text-center'> Failed to place order  </div>";
                        header('location:'.HOMEPAGE);
                    }
                   
                }
            ?>



        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('front/footer.php'); ?>