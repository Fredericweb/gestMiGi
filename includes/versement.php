<?php
    session_start();
    include('config.php');
    require_once('../phpqrcode/qrlib.php');
    if(isset($_POST['save'])){
        $vers = $_POST['versement'];
        $id = $_POST['ID_etudiant'];
        $numvers = mt_rand(1000,9999);

        $sql = mysqli_query($con,"SELECT * FROM compte_etud WHERE id_etud='$id'");
        $result = mysqli_fetch_array($sql);

        $rest_pay = $result['rest_pay'];
        $rest = ($rest_pay-$vers);

        if($rest >=0 ){

            $sql3 = mysqli_query($con,"INSERT INTO versement(id_etud,date,montant_vers,rest,num_vers)
            VALUES ('$id',now(),'$vers','$rest','$numvers')");

            $cpte = $result['idCompt'];
            $sql4 = mysqli_query($con,"UPDATE compte_etud SET rest_pay='$rest' WHERE idCompt='$cpte'");

            $path = '../assets/images/Qrcode/';
            $file = $path.$numvers.".png";
            QRcode::png($numvers,$file,'L',10,2);
            
            echo "<script>alert('Informations enregistées !!!');</script>";
            echo "<script language='javascript'>document.location='../html2php/index.php?numrecu=$numvers'</script>";

        }else{
            echo"<script>alert('Versement plus elevée que le reste à payer!!!');</script>";
        }
    }
?>
<script language="javascript">
document.location="../pages/listeVersEtud.php";
</script>