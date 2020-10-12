<?php
session_start();
if (sizeof($_SESSION['admin'])==0) {
    header('Location:login.php');
}
include "config.php";
if (isset($_GET['id'])) {
    $userid=$_GET['id'];
    $sql="DELETE FROM `users` WHERE userid=$userid";
    if ($conn->query($sql)===true) {
        header('Location:manageusers.php');
    }
}

?>