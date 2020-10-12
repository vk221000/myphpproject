
<?php 
session_start();
if (isset($_GET['signout'])) {
	session_unset();
	session_destroy();
	header('Location:login.php');
}
if (isset($_POST['submit'])) {
    $username  = $_POST['username'];
    $password1 = $_POST['password'];
    $enc_password=md5($password1);
    include "config.php";
    $sql        = "SELECT * FROM users WHERE `username`='" . $username . "'AND `password`='" . $enc_password. "'";
    $login_data = $conn->query($sql);
    if ($login_data->num_rows > 0) {
        while ($row = $login_data->fetch_assoc()) {
            if ($row['role']=='admin') {
                $_SESSION['admin']=array($row['username']);
                header('Location:index.php');
            }
            else {$_SESSION['user'] = array(
                    'username' => $row['username'],
                    'userid'=>$row['userid']
                );
                include 'config.php';
                $_SESSION['cart']=array();
                $_SESSION['products']=array();
                $sql="SELECT * FROM `products`";
                $product=$conn->query($sql);
                if ($product->num_rows >0) {
                    while ($row=$product->fetch_assoc()) {
                        array_push($_SESSION['products'], $row);
                        
                    }
                }
                header('Location:index1.php');
            }
            
        }
    } else {
        echo "login detail is invalid";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simpla Admin | Sign In</title>
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
</head>
  
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>Simpla Admin</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="login.php" method="POST">
				
					<div class="notification information png_bg">
						<div>
							please enter username and password to sign in
						</div>
					</div>
					
					<p>
						<label>Username</label>
						<input class="text-input" type="text" name='username' required/>
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password" name='password' required/>
					</p>
					<div class="clear"></div>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" value="submit" name="submit"/>
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
  </body>
</html>
