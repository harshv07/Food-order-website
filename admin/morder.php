<?php include('partials/menu.php'); ?>




<div class="new">

    <hr>
    <h1>Order Section</h1>

    <?php
    if (isset($_SESSION['order_update'])) {
        echo $_SESSION['order_update'];
        unset($_SESSION['order_update']);
    }

    ?>


    <div class="sec">


        <form action="" method="post" enctype="multipart/form-data">

            <table>

                <thead>

                    <tr>
                        <th>S.NO</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order_Date</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>contact</th>
                        <th>email</th>
                        <th>address</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $sql = "SELECT * FROM ordered";

                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $i = 1;
                    if ($count > 0) {

                        while ($row = mysqli_fetch_assoc($res)) {

                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['quantity'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                    ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>

                                <td>

                                    <?php

                                    if ($status == "Ordered") {
                                        echo "<label> $status </label>";
                                    } else if ($status == "On delivery") {

                                        echo "<label style = 'color : orange'> $status </label>";
                                    } else if ($status == "Delivered") {

                                        echo "<label style = 'color : green'> $status </label>";
                                    } else if ($status == "Cancelled") {
                                        echo "<label style = 'color : red'> $status </label>";
                                    }

                                    ?>

                                </td>

                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo HOMEPAGE; ?>admin/update_order.php?id=<?php echo $id; ?>" class="example_b green">Update Order</a>
                                </td>
                            </tr>

                    <?php
                        }
                    } else {

                        echo "<tr><td colspan ='12' class = 'error'>Orders Not availaible</td></tr>";
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