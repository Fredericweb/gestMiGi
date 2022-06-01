<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php 
        session_start();
        include "head.php";
        include('../includes/config.php');
        if(strlen($_SESSION['id_user'])==0)
    { 
        header('location:login.php');
    }else{
        $iduser = $_SESSION['id_user'];
        $query = mysqli_query($con,"SELECT * FROM user WHERE id_user='$iduser'");
        $rst = mysqli_fetch_array($query);
    }
        if(isset($_GET['class'])){
            $codclass = intval($_GET['class']);
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
                                    <h4 class="card-title">Listes des etudiants Classe <?=$codclass?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>id_etud</th>
                                                    <th>nom</th>
                                                    <th>prenom</th>
                                                    <th>Tel</th>
                                                    <th>Tel parent</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = mysqli_query($con,"SELECT * FROM anneescol WHERE codClass='$codclass'");
                                                    while($result = mysqli_fetch_array($sql)){
                                                        $idetud = $result['id_etud'];
                                                        $row1 = mysqli_query($con, "SELECT * FROM etudiants WHERE id_etud = '$idetud'");
                                                        $rst1 = mysqli_fetch_array($row1);

                                                        $idNiv = $rst1['id_niveau'];
                                                        $row2 = mysqli_query($con, "SELECT * FROM niveau WHERE id_niveau = '$idNiv'");
                                                        $rst2 = mysqli_fetch_array($row2);
                                                    
                                                ?>
                                                        <tr>
                                                            <td><?=$idetud?></td>
                                                            <td><?=$rst1['nom_etud']?></td>
                                                            <td><?=$rst1['Prenom_etud']?></td>
                                                            <td><?=$rst1['tel']?></td>
                                                            <td>
                                                            <?=$rst1['tel_parent']?>
                                                            </td>
                                                            <td>

                                                            </td>
                                                        </tr>
                                                <?php } ?>
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
        <!-- plugins:js -->
        <?php include "script.php"?>




    </body>

</html>