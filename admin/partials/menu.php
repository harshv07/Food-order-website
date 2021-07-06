<?php include('../config/connection.php');
include('login_check.php');
?>

<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="../css/style2.css">
        <title>FooDieS</title>
    </head>

    <body>

    <div class="navbar">
        <div class="navbar-container container">
            <input type="checkbox" name="" id="">
            <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
            <ul class="menu-items">
                <li><a href="index.php">HOME</a></li>
                <li><a href="madmin.php">Admin</a></li>
                <li><a href="mcategory.php">Category</a></li>
                <li><a href="mfood.php">Food</a></li>
                <li><a href="morder.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            <h1 class="logo">FooDieS</h1>
        </div>
    </div>