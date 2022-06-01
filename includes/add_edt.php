<?php
    session_start();
    include('config.php');

    // en cas de click sur le button sauvegarder
    if(isset($_POST['save'])){

        // recuperation des variables saisis dans les input
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $lieu = $_POST['lieu'];
        $nation = $_POST['nation'];

        // recupation de id_sex 
        $sexe = $_POST['sexe'];
        $row1 = mysqli_query($con, "SELECT * FROM sexe WHERE libel_sex = '$sexe'");
        $rst1 = mysqli_fetch_array($row1);
        $idSex = $rst1['id_sex'];

        // recupation de id_niveau 
        $niveau = $_POST['niveau'];
        $row2 = mysqli_query($con, "SELECT * FROM niveau WHERE libel_niveau = '$niveau'");
        $rst2 = mysqli_fetch_array($row2);
        $idNiv = $rst2['id_niveau'];

        // recuperation des variables saisis dans les input
        $email = $_POST['mail'];
        $tel = $_POST['tel'];
        $telp = $_POST['telp'];
        $img = $_POST['img'];

        // calcul de l'année scolaire en cours
        $annee = date('y');
        $annee2 = $annee+1;
        $anneeScol = "$annee-$annee2";
        
        // enregistrement du formulaire dans le base de données
        $sql = mysqli_query($con, "INSERT INTO etudiants(nom_etud,Prenom_etud,Dat_naiss,lieu_naiss,nationalite,id_niveau,id_sexe,photo,email,tel,tel_parent,anneescol) 
        values ('$nom','$prenom','$date ','$lieu','$nation','$idNiv ','$idSex','$img','$email','$tel','$telp','$anneeScol')");

        // selection de id_etud  en fonction du prenom($prenom)
        $row = mysqli_query($con, "SELECT id_etud FROM etudiants WHERE prenom_etud='$prenom'");
        $resl = mysqli_fetch_array($row);
        $idetud = $resl['id_etud'];

        // selection des elements en fonction du niveau
        $row2 = mysqli_query($con, "SELECT * FROM etudiants WHERE id_niveau='$idNiv'");
        $count = mysqli_num_rows($row2);
        
        // generer un code de classe contenant des groupes de 2 etudiants par classe
        for($i=0;$i<($count/3);$i++){
            $codClass = "$idNiv$annee2$i";
        }
        // remplir la table anneescol de 2etudiants avec le meme code classe
        $cpt = 1;
        while($resultat = mysqli_fetch_array($row2)){
            if($cpt<3){
                $sql3 = mysqli_query($con,"INSERT INTO anneescol(id_etud,id_niveau,codClass)
                VALUES ('$idetud','$idNiv','$codClass')");
                $cpt++;
            }
        }

        // creation de compte de versement etudiant

        $query_vers = mysqli_query($con,"SELECT * FROM scolarite WHERE id_niveau='$idNiv'");
        $res_vers = mysqli_fetch_array($query_vers);
        $mt_vers = $res_vers['montant'];
        echo "$mt_vers/$idetud";
        $sql4 = mysqli_query($con, "INSERT INTO compte_etud(id_etud,rest_pay) VALUES ('$idetud','$mt_vers')");

        echo "<script>alert('Informations enregistées !!!');</script>";
    }
?>
<script language="javascript">
document.location="../pages/add_etud.php";
</script>