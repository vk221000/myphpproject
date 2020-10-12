<?php
session_start();
if (sizeof($_SESSION['admin'])==0) {
    header('Location:login.php');
}
include "config.php";
$success=array();
if (isset($_POST['submit'])) {
    $userid=$_POST['userid'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $enc_password=md5($password);
    $email=$_POST['email'];
    $role=$_POST['role'];
    $sql="UPDATE  `users` SET `username`='$username',`password`='$enc_password',`email`='$email',`role`='$role' WHERE `userid`=$userid ";
    if ($conn->query($sql)===true) {
        $success['success']=array('User Updated Successfully'); 
        header('Location:manageusers.php'); 
    }
    
}
$userid=$username=$password=$email=$role="";
if (isset($_GET['id'])) {
    $userid=$_GET['id'];
    $sql= "SELECT * FROM users WHERE `userid`=" . $userid."";
    $get_data = $conn->query($sql);
    if ($get_data->num_rows > 0) {
        while ($row = $get_data->fetch_assoc()) {
            $userid=$row['userid'];
            $username=$row['username'];
            $password=$row['password'];
            $email=$row['email'];
            $role=$row['role'];
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
            echo "<form method='POST' action='edituser.php'>
                <label for='userid'>User Id: <input type='text' name='userid' value='".$userid."'></label><br>
                <label for='username'>User Name: <input type='text' name='username' value='".$username."'></label><br>
                <label for='pssword'>Password: <input type='password' name='password' value='".$password."'></label><br>
                <label for='email'>Email: <input type='text' name='email' value='".$email."'></label><br>
                <label for='role'>Role: <input type='text' name='role' value='".$role."'></label><br>
                <input type='submit' value='submit' name='submit' id='submit'>
            </form>";
        ?>
        </div>
    </body>
</html>