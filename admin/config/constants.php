<?php
    session_start();
    define('SITEURL', 'http://localhost/web-design-course-restaurant-master/');
    define('LOCALHOST', 'localhost');
    define('DBUSERNAME','root');
    define('DBPASSWORD','');
    define('DBNAME','food-order');
    $conn = mysqli_connect(LOCALHOST,DBUSERNAME,DBPASSWORD) or die(mysql_error());
    $db_select = mysqli_select_db($conn,DBNAME) or die(mysql_error());
?>