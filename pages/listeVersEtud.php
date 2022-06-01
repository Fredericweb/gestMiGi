<!DOCTYPE html>
<html lang="fr">

    <head>
        <!-- Required meta tags -->
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
        
        
    </head>

    <body>
        <div class="container-scroller">
        <?php
            if($rst['id_role'] == 2){
            include "sidebarSec.php";
            }elseif($rst['id_role'] == 3){
            include "sidebarCompt.php";
            }else{
            include "sidebar.php";
            }
        ?>

            <div class="container-fluid page-body-wrapper">
                <?php include "header.php"?>

                <div class="main-panel">
                    <div class="content-wrapper pb-0">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Listes versement</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prenom</th>
                                                    <th>Niveau</th>
                                                    <th>reste à payer</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cpt = 0;
                                                    $sql = mysqli_query($con,"SELECT * FROM compte_etud");
                                                    while($result = mysqli_fetch_array($sql)){
                                                        $idetud = $result['id_etud'];
                                                        $sql2 = mysqli_query($con,"SELECT * FROM etudiants WHERE id_etud='$idetud'");
                                                        $result2 = mysqli_fetch_array($sql2);
                                                        
                                                       
                                                ?>
                                                <tr>
                                                <?php
                                               
                                                ?>
                                                    <td><?=$result2['nom_etud'] ?></td>
                                                    <td><?=$result2['Prenom_etud'] ?></td>

                                                    <?php 
                                                        $idNiv = $result2['id_niveau'];
                                                        $sql1 = mysqli_query($con, "SELECT * FROM niveau WHERE id_niveau ='$idNiv'");
                                                        $rst1 = mysqli_fetch_array($sql1);

                                                         // change les couleurs d'arriere plan 
                                                        if($idNiv == 1){
                                                            $color = "badge-warning";
                                                        }elseif($idNiv == 2){
                                                            $color = "badge-danger";
                                                        }elseif($idNiv == 3){
                                                            $color = "badge-primary";
                                                        }else{
                                                            $color = "badge-success";
                                                        }
                                                    ?>

                                                    <td><label class="badge <?=$color?>"><?=$rst1['libel_niveau'] ?></label></td>
                                                    <td><?=$result['rest_pay'] ?> Fcfa</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-icon-text mb-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-sm<?=$cpt?>">
                                                            <i class="mdi mdi-plus"></i>
                                                            versement
                                                        </button>

                                                        <?php
                                                        
                                                        ?>
                                                        
                                                        <div class="modal fade bd-example-modal-sm<?=$cpt?>" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Versement</h5>
                                                                        <button type="button" class="btn-close btn"
                                                                            data-bs-dismiss="modal">
                                                                            <i class="mdi mdi-close"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="../includes/versement.php" method="post">
                                                                        
                                                                            <input type="hidden" class="form-control" name="ID_etudiant" id="" value="<?=$idetud?>">
                                                                            <input type="number" class="form-control" name="versement" id="" placeholder="Montant du versement">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger light"
                                                                                data-bs-dismiss="modal">Annuler</button>
                                                                                <input type="submit" name="save" value="valider" class="btn btn-primary">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>

                                            <?php 
                                             $cpt++;
                                            } ?>
                                        </table>
                                        
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
        <?php include "script.php";?>
    
    </body>

</html>