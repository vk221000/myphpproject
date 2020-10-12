<?php
session_start();
if (sizeof($_SESSION['admin']) == 0) {
    header('Location:login.php');
}
include "config.php";
$success = array();
if (isset($_POST['submit'])) {
    $pdtid    = $_POST['pdtid'];
    $pdtname  = $_POST['pdtname'];
    $pdtprice = $_POST['pdtprice'];
    $pdtimage = $_POST['pdtimage'];
    $sql      = "INSERT INTO `products` (`pdtid`,`pdtname`,`pdtprice`,`pdtimage`) VALUES ('$pdtid','$pdtname','$pdtprice','$pdtimage')" ;
    if ($conn->query($sql) === true) {
        $success['success'] = array(
            'Product Added Successfully'
        );
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>addproduct</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="wrapper1">
            <form method='POST' action='addproducts.php'>
                <label for='pdtid'>Product Id: <input type='text' name='pdtid'></label><br>
                <label for='pdtname'>Product Name: <input type='text' name='pdtname'></label><br>
                <label for="pdtprice">Product Price: <input type='text' name='pdtprice'></label><br>
                <label for="pdtimage">Product Image: <input type='text' name='pdtimage'></label><br>
                <input type="submit" value='submit' name='submit' id='submit'>
            </form>
            <div id='success'>
                <?php
                sizeof($success) > 0 ? print_r($success['success'][0]) : "";
                ?>
           </div>
        </div>
    </body>
</html>