<?php
 session_start();
//Database Configuration File
include('../includes/config.php');
//error_reporting(0);
if(isset($_POST['connexion']))
  {
 
    // Getting username/ email and password
     $uname=$_POST['login'];
     $password=$_POST['password'];

    // Fetch data from database on the basis of username/email and password
$sql = mysqli_query($con,"SELECT * FROM user WHERE (login='$uname')");
 $num=mysqli_fetch_array($sql);
if($num>0)
{
; // Hashed password fething from database
//verifying Password
if ($password == $num['password']) {
    $_SESSION['id_user']=$num['id_user'];
    echo "<script type='text/javascript'> document.location = 'dashAdmin/index.php'; </script>";
} else {
    echo "<script>alert('mot de passe incorrect');</script>";
  }
}
//if username or email not found in database
else{
echo "<script>alert('nom d'utilisateur incorrect');</script>";
  }
 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"?>
</head>

<body class="bg-transparent">

    <!-- HOME -->
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                   
                                    <h4 class="text-center mb-4 mt-4">login</h4>
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Login</strong></label>
                                            <input type="text" class="form-control" placeholder="hello@example.com" name="login">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="connexion" class="btn btn-primary btn-block">Connexion</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "script.php"?>
</body>

</html>