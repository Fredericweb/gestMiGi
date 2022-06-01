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
                                    <form action="../includes/add_edt.php" method="post" class="form-sample ">
                                        <p class="card-description">infos personnels</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Nom</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nom" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Prenom</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="prenom" required/>
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
                                                        <input type="date" class="form-control" placeholder="dd/mm/yyyy"
                                                            name="date" required/>
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
                                                            placeholder="Nationalité" name="nation" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Lieu de naissance</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            placeholder="lieu de naissance" name="lieu" required/>
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
                                                        <input type="email" class="form-control" name="mail" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Tel</label>
                                                    <div class="col-sm-9">
                                                        <input type="tel" class="form-control" name="tel" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Tel parent</label>
                                                    <div class="col-sm-9">
                                                        <input type="tel" class="form-control" name="telp" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>File upload</label>
                                                    <input type="file" name="img" class="" required/>
                                                    
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