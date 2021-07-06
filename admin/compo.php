<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <br><br> <br><br>
        <hr>

        <h2>Dashboard</h2>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

        <hr>
        <br>

        <div classname="abc">

            <div class="flex-container">



                <div class="card">
                    <div class="flex-child blue">



                        <div class="containers">

                            <div class="card:hover">
                                <br>
                                <?php

                                $sql = "SELECT * FROM category";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                ?>
                                <h1 class="p1"><?php echo $count; ?></h1>
                                <p class="p1"> Categories</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>



                <div class="card">
                    <div class="flex-child blue">
                        <div class="containers">

                            <div class="card:hover">

                                <br>
                                <?php

                                $sql2 = "SELECT * FROM food";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                ?>
                                <h1 class="p1"><?php echo $count2; ?></h1>
                                <p class="p1">Foods</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="flex-container">
                <div class="card">
                    <div class="flex-child blue">
                        <div class="containers">
                            <div class="card:hover">


                                <br>
                                <?php

                                $sql3 = "SELECT * FROM ordered";
                                $res3 = mysqli_query($conn, $sql3);
                                $count3 = mysqli_num_rows($res3);
                                ?>
                                <h1 class="p1"><?php echo $count3; ?></h1>
                                <p class="p1"> Total orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="flex-child blue">
                        <div class="containers">
                            <div class="card:hover">
                                <br>
                                <?php

                                $sql4 = "SELECT sum(total) AS total FROM ordered WHERE status = 'Delivered'";
                                $res4 = mysqli_query($conn, $sql4);
                                $row = mysqli_fetch_assoc($res4);
                                $total_rev = $row['total'];
                                ?>
                                <h1 class="p1">$<?php echo $total_rev; ?></h1>
                                <p class="p1"> Revenue </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <?php
include('partials/footer.php');

?>