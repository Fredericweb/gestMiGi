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
                                    <h4 class="card-title">Historique de versement</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>prenom</th>
                                                    <th>Niveau</th>
                                                    <th>Montant</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $cpt = 0;
                                                $sql = mysqli_query($con,"SELECT * FROM versement");
                                                while($result = mysqli_fetch_array($sql)){
                                            ?>
                                                <tr>
                                                    <?php
                                                        $idetud = $result['id_etud'];
                                                        $sql2 = mysqli_query($con,"SELECT * FROM etudiants WHERE id_etud='$idetud'");
                                                        $result2 = mysqli_fetch_array($sql2);
                                                    ?>
                                                    <td><?=$result2['nom_etud'] ?></td>
                                                    <td><?=$result2['Prenom_etud'] ?></td>
                                                    <td>
                                                        <?php 
                                                            $idNiv = $result2['id_niveau'];
                                                            $sql1 = mysqli_query($con, "SELECT * FROM niveau WHERE id_niveau ='$idNiv'");
                                                            $rst1 = mysqli_fetch_array($sql1);
                                                        ?>
                                                        <label class="badge badge-warning"><?=$rst1['libel_niveau'] ?></label>
                                                    </td>
                                                    <td><?=$result['montant_vers']?></td>
                                                    <td>
                                                        <?=$result['date']?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-icon btn-icon-text"
                                                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm<?=$cpt?>">
                                                            <i class="mdi mdi-information"></i>

                                                        </button>

                                                        <div class="modal fade bd-example-modal-sm<?=$cpt?>" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">QrCode reçu</h5>
                                                                        <button type="button" class="btn-close btn"
                                                                            data-bs-dismiss="modal">
                                                                            <i class="mdi mdi-close"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="d-flex justify-content-center ">
                                                                            <img class=""
                                                                                src="../assets/images/Qrcode/<?=$result['num_vers']?>.png"
                                                                                width="90px" alt="">
                                                                        </div>
                                                                        <div class="mt-4">
                                                                            <p class=""> <strong>idVersement:
                                                                                </strong><?=$result['num_vers']?></p>
                                                                            <p class=""> <strong>Nom:
                                                                                </strong><?=$result2['nom_etud'] ?></p>
                                                                            <p class=""> <strong>Prénom:
                                                                                </strong><?=$result2['Prenom_etud'] ?></p>
                                                                            <p class=""> <strong>Montant:
                                                                                </strong><?=$result['montant_vers']?> Fcfa</p>
                                                                            <p class=""> <strong>Reste à payer:
                                                                                </strong><?=$result['rest']?> Fcfa</p>
                                                                            <p class=""> <strong>Date:
                                                                                </strong><?=$result['date']?></p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="../html2php/index.php?numrecu=<?=$result['num_vers']?>"  class="btn btn-success">
                                                                            <i class="mdi mdi-download"></i>
                                                                            Telecharger le reçu
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            <?php 
                                            $cpt++;
                                            } ?> 
                                            </tbody>
                                            <tfoot>
                                                <tr>

                                                </tr>
                                            </tfoot>
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
        <?php include "script.php"?>




    </body>

</html>