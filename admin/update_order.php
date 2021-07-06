<?php include('partials/menu.php'); ?>




<div class="new">

    <hr>
    <h1>Update order</h1>

    <?php
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $sql = "SELECT * FROM ordered WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if ($count == 1) {

            $row = mysqli_fetch_assoc($res);

            $food = $row['food'];
            $price = $row['price'];
            $qty = $row['quantity'];
            $status = $row['status'];
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email = $row['customer_email'];
            $customer_address = $row['customer_address'];
        } else {
            header('location:' . HOMEPAGE . 'admin/morder.php');
        }
    } else {
        header('location:' . HOMEPAGE . 'admin/morder.php');
    }
    ?>





    <div class="sec">


        <form action="" method="post" enctype="multipart/form-data">

            <table>

                <tr>
                    <td>Food Name :</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>$<?php echo $price; ?></td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <b><input type="number" name="quantity" value="<?php echo $qty; ?>"></b>
                    </td>
                </tr>

                <tr>
                    <td>Customer_name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == 'Ordered') echo "selected"; ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == 'On delivery') echo "selected"; ?> value="On delivery">ON Delivery</option>
                            <option <?php if ($status == 'Delivered') echo "selected"; ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == 'Cancelled') echo "selected"; ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>


                </tr>
                <tr>
                    <td>customer_contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>customer_email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>customer_address</td>
                    <td>
                        <textarea name="customer_address" cols="50" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update" class="btn third">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {


            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['quantity'];

            $total = $price * $qty;

            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_contact = $_POST['customer_contact'];
            $customer_address = $_POST['customer_address'];

            $sql2 = "UPDATE ordered SET
                        quantity = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_address = '$customer_address',
                        customer_email = '$customer_email'
                        WHERE id = $id

                ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {

                $_SESSION['order_update'] = "<div class = 'success' > Order updated </div>";
                header('location:' . HOMEPAGE . 'admin/morder.php');
            } else {

                $_SESSION['order_update'] = "<div class = 'error' > Failed to update order </div>";
                header('location:' . HOMEPAGE . 'admin/morder.php');
            }
        }
        ?>
    </div>
</div>



<?php
include('partials/footer.php');

?>