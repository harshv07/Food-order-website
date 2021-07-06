<?php

    session_start();

    define('HOMEPAGE','http://localhost/foodies/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('PASSWORD',"");
    define('DBNAME','food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME,PASSWORD) or die('try letter1');
    $db_select = mysqli_select_db($conn, DBNAME) or die('try letter');
?>