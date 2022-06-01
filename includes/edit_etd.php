<?php
    session_start();
    include('config.php');
    if(isset($_POST['save'])){

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $lieu = $_POST['lieu'];
        $nation = $_POST['nation'];

        $sexe = $_POST['sexe'];
        $row1 = mysqli_query($con, "SELECT * FROM sexe WHERE libel_sex = '$sexe'");
        $rst1 = mysqli_fetch_array($row1);
        $idSex = $rst1['id_sex'];
        
        $niveau = $_POST['niveau'];
        $row2 = mysqli_query($con, "SELECT * FROM niveau WHERE libel_niveau = '$niveau'");
        $rst2 = mysqli_fetch_array($row2);
        $idNiv = $rst2['id_niveau'];

        $email = $_POST['mail'];
        $tel = $_POST['tel'];
        $telp = $_POST['telp'];
        $img = $_POST['img'];

        $query = mysqli_query($con,"update etudiants set nom_etud='$nom',Prenom_etud='$prenom',Dat_naiss='$date ',lieu_naiss='$lieu',nationalite='$nation',id_niveau='$idNiv',id_sexe='$idSex',photo='$img',email='$email',tel='$tel',tel_parent='$telp'
        where id_etud='$idEtud'");
        echo "<script>alert('Informations modifiées !!!');</script>";
    }
?>
<script language="javascript">
document.location="../pages/manage_etud.php";
</script>