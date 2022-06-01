<?php
    session_start();
    
    include('config.php');
    //error_reporting(0);
    if(isset($_POST['save']))
      {
     
         $iduser=$_SESSION['id_user'];
         $uname=$_POST['login'];
         $password=$_POST['password'];
         $cpassword=$_POST['Cpassword'];

         if($password == $cpassword){
            $sql = mysqli_query($con,"Update  user set login='$uname',password='$password' where id_user='$iduser'");
            echo "<script>alert('modifications enregistrées');</script>";
         }else{
            echo "<script>alert('mot de passe ne correspond pas');</script>";
         }
         
      }
    
?>
<script language="javascript">
document.location="../pages/dashAdmin";
</script>
