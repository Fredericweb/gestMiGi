<?php
    session_start();
    include('../../config.php');

    // en cas de click sur le button sauvegarder
    if(isset($_POST['save'])){

        // recuperation des variables saisis dans les input
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $lieu = $_POST['lieu'];
        $email = $_POST['mail'];
        $tel = $_POST['tel'];
        $telp = $_POST['telp'];
        $imgI = $_POST['imgI'];

        // recupation de id_sex 
        $sexe = $_POST['sexe'];
        $row1 = mysqli_query($con, "SELECT * FROM sexe WHERE libel_sexe = '$sexe'");
        $rst1 = mysqli_fetch_array($row1);
        $idSex = $rst1['id_sexe'];

        // recupation de id_niveau 
        $niveau = $_POST['niveau'];
        $row2 = mysqli_query($con, "SELECT * FROM niveau WHERE libel_niveau = '$niveau'");
        $rst2 = mysqli_fetch_array($row2);
        $idNiv = $rst2['id_niveau'];

        $statut = 1;
        
        // enregistrement du formulaire dans le base de données
        $sql = mysqli_query($con, "INSERT INTO etudiants(nom_etd,Prenom_etd,datNaiss,lieuNaiss,id_niveau,id_sexe,mail,tel_etd,tel_p,photo_etd,id_statut) 
        values ('$nom','$prenom','$date ','$lieu','$idNiv','$idSex','$email','$tel','$telp','$imgI','$statut')");

        echo "<script>alert('Informations enregistées !!!');</script>";
    }
