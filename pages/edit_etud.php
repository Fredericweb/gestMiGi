<!DOCTYPE html>
<html lang="en">
    
    <?php 
        session_start();
        include('../includes/config.php');
        include "head.php";
        if(strlen($_SESSION['id_user'])==0)
    { 
        header('location:login.php');
    }else{
        $iduser = $_SESSION['id_user'];
        $query = mysqli_query($con,"SELECT * FROM user WHERE id_user='$iduser'");
        $rst = mysqli_fetch_array($query);
    }

        if(isset($_GET['edit'])){
            $idEtud = intval($_GET['edit']);
            $sql = mysqli_query($con, "SELECT * FROM etudiants WHERE id_etud='$idEtud'");
            $rst0 = mysqli_fetch_array($sql);

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
        }
        
    ?>

<body>
    <div class="container-scroller">
        <!-- side bar -->
        <?php
            if($rst['id_role'] == 2){
            include "sidebarSec.php";
            }elseif($rst['id_role'] == 3){
            include "sidebarCompt.php";
            }else{
            include "sidebar.php";
            }
        ?>
        <!-- end -->
        <div class="container-fluid page-body-wrapper">
            <!-- header -->
            <?php include "header.php"?>
            <!-- end header -->
            <div class="main-panel">
                <div class="content-wrapper pb-0">

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Inscrition etudiant</h4>
                                    <form action="" method="post" class="form-sample ">
                                        <p class="card-description">infos personnels</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nom</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nom" value="<?= $rst0['nom_etud'] ?>" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Prenom</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="prenom" value="<?= $rst0['Prenom_etud'] ?>" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Sexe</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="sexe" required>
                                                            <option>Selectionner le genre</option>
                                                        <?php
                                                            $sql= mysqli_query($con,"SELECT * FROM sexe");

                                                            while($row = mysqli_fetch_array($sql)){
                                                        ?>
                                                            <option><?= htmlentities($row['libel_sex']) ?> </option>

                                                           <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Date de naissance</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control"
                                                            name="date" value="<?= $rst0['Dat_naiss'] ?>" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nationalité</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="Nationalité" value="<?= $rst0['nationalite'] ?>" name="nation" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Lieu de naissance</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="lieu de naissance" value="<?= $rst0['lieu_naiss'] ?>" name="lieu" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-description">info supplementaire</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Niveau</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="niveau" required>
                                                            <option>Selectionner le niveau</option>
                                                        <?php
                                                            $sql= mysqli_query($con,"SELECT * FROM niveau");

                                                            while($row = mysqli_fetch_array($sql)){
                                                        ?>
                                                            <option><?= htmlentities($row['libel_niveau']) ?> </option>

                                                           <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" value="<?= $rst0['email'] ?>" name="mail" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Tel</label>
                                                    <div class="col-sm-9">
                                                        <input type="tel" class="form-control" name="tel" value="<?= $rst0['tel'] ?>" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Tel parent</label>
                                                    <div class="col-sm-9">
                                                        <input type="tel" class="form-control" name="telp" value="<?= $rst0['tel_parent'] ?>" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>File upload</label>
                                                    <input type="file" name="img" class="" value="<?= $rst0['photo'] ?>" required/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="save" class="btn btn-primary mr-2"> Sauvegarder </button>
                                        <button class="btn btn-light">annuler</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            AsteroDesign 2022</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                href="http://asterodesign.ml/" target="_blank">AsteroDesign</a> pour Miage-Gi.com</span>
                    </div>
                </footer>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include "script.php"?>

</body>

</html>