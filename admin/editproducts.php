<?php
session_start();
if (sizeof($_SESSION['admin'])==0) {
    header('Location:login.php');
}
include "config.php";
$success=array();
if (isset($_POST['submit'])) {
    $pdtid=$_POST['pdtid'];
    $pdtname=$_POST['pdtname'];
    $pdtprice=$_POST['pdtprice'];
    $pdtimage=$_POST['pdtimage'];
    $sql="UPDATE  `products` SET `pdtid`='$pdtid',`pdtname`='$pdtname',`pdtprice`='$pdtprice',`pdtimage`='$pdtimage' WHERE `pdtid`=$pdtid ";
    if ($conn->query($sql)===true) {
        $success['success']=array('Product Updated Successfully'); 
        header('Location:manageproducts.php'); 
    }
    
}
$productid=$productname=$productprice=$productimage="";
if (isset($_GET['id'])) {
    $productid=$_GET['id'];
    $sql= "SELECT * FROM products WHERE `pdtid`=" . $productid."";
    $get_data = $conn->query($sql);
    if ($get_data->num_rows > 0) {
        while ($row = $get_data->fetch_assoc()) {
            $productid=$row['pdtid'];
            $productname=$row['pdtname'];
            $productprice=$row['pdtprice'];
            $productimage=$row['pdtimage'];
        }
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
        <?php
            echo "<form method='POST' action='editproduct.php'>
                <label for='pdtid'>Product Id: <input type='text' name='pdtid' value='".$productid."'></label><br>
                <label for='pdtname'>Product Name: <input type='text' name='pdtname' value='".$productname."'></label><br>
                <label for='pdtprice'>Product Price: <input type='text' name='pdtprice' value='".$productprice."'></label><br>
                <label for='pdtimage'>Product Price: <input type='text' name='pdtimage' value='".$productimage."'></label><br>
                <input type='submit' value='submit' name='submit' id='submit'>
            </form>";
        ?>
            <div id='success'>
                <?php 
                sizeof($success) > 0 ? print_r($success['success'][0]) : "";
                ?>
            </div>
        </div>
    </body>
</html>