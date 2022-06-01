<?php
    session_start();
    include('config.php');

    if(isset($_POST['save'])){

        $role = $_POST['role'];
        $mdp = $_POST['mdp'];

        // recuperation des informations de l'utilisateur
        $id = $_POST['id_user'];
        $row1 = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id'");
        $rst1 = mysqli_fetch_array($row1);

        
        $row2 = mysqli_query($con, "SELECT * FROM role WHERE libel_role='$role'");
        $rst2 = mysqli_fetch_array($row2);
        $idr = $rst2['id_role'];

        $query = mysqli_query($con,"update user set password='$mdp',id_role='$idr'
        where id_user='$id'");
        echo "<script>alert('Informations modifiées !!!');</script>";
    }
?>
<script language="javascript">
document.location="../pages/List_persl.php";
</script>