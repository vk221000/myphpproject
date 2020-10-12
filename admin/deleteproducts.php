<?php
session_start();
if (sizeof($_SESSION['admin'])==0) {
    header('Location:login.php');
}
include "config.php";
if (isset($_GET['id'])) {
    $pdtid=$_GET['id'];
    $sql="DELETE FROM `products` WHERE pdtid='$pdtid'";
    if ($conn->query($sql)===true) {
        header('Location:manageproducts.php');
    }
}

?>