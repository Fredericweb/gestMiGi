<?php
    session_start();
    
    include('config.php');

    if(isset($_POST['save']))
      {
         $nom = $_POST['nom'];
         $prenom = $_POST['prenom'];
         $password=$_POST['password'];
         $cpassword=$_POST['Cpassword']; 

        //  recuperation de id_role
         $role = $_POST['role'];
         $row2 = mysqli_query($con, "SELECT * FROM role WHERE libel_role='$role'");
         $rst2 = mysqli_fetch_array($row2);
         $idr = $rst2['id_role'];

         //  recuperation de id_sex
         $sexe = $_POST['sexe'];
         $row0 = mysqli_query($con, "SELECT * FROM sexe WHERE libel_sex='$sexe'");
         $rst0 = mysqli_fetch_array($row0);
         $ids = $rst0['id_sex'];

        //  creation du login 
         $loginBrut= "$nom$prenom";
         $login = substr( $loginBrut, 0, 8 );

         if($password == $cpassword){
            $sql = mysqli_query($con,"INSERT INTO user(nom,prenom,id_role,login,password,id_sexe) VALUES
            ('$nom','$prenom','$idr','$login','$password','$ids')");

            echo "<script>alert('modifications enregistrées');</script>";
         }else{
            echo "<script>alert('mot de passe ne correspond pas');</script>";
         }
         
      }
    
?>
<script language="javascript">
document.location="../pages/List_persl.php";
</script>