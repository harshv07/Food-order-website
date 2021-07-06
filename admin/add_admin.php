<?php
include('partials/menu.php');
?>



<div class="new">

<hr>
<h1>Add Admin</h1>

<div class="sec">

    <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    ?>  

    <form action="" method="post">

        <table>

            <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="user_name" placeholder="Enter username"></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn third">
                    </td>
                </tr>
        </table>
    </form>
</div>
</div>

<?php 
    include('partials/footer.php');

?>

<?php

if (isset($_POST['submit'])) {
    //button clicked
    // echo "button clicked";

    //GEt data from user or form
    $full_name = $_POST['full_name'];
    $username = $_POST['user_name'];
    $password = md5($_POST['password']); //password is encrypted using md5

    // sql query to insert data into database

    $sql = "INSERT INTO admin SET
            full_name = '$full_name',
            user_name = '$username',
            password = '$password'
    ";


    //Execute query into database

    $res = mysqli_query($conn, $sql) or die('try latter');

    //check data is inserted or not

    if ($res == true) {
        // echo "data inserted";

        // creating session
        $_SESSION['add'] = "<div class = 'success'>Admin Added succesfully</div>";
        //redirect page
        header("location:" . HOMEPAGE . 'admin/madmin.php');
    } else {
        // echo "data is failed to insert";

        $_SESSION['add'] = "<div class = 'error'>Failed to add Admin</div>";
        //redirect page
        header("location:" . HOMEPAGE . 'admin/add_admin.php');
    }
}

?>