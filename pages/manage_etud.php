<!DOCTYPE html>
<html lang="fr">

<head>
    
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
                                <h4 class="card-title">Liste Des Etudiants</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>prenom</th>
                                                <th>niveau</th>
                                                <th>classe</th>
                                                <th>tel parent</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = mysqli_query($con,"SELECT * FROM etudiants");
                                                while($rst = mysqli_fetch_array($sql)){
                                            ?>

                                            <tr>
                                                <td> <?= $rst['nom_etud'] ?> </td>
                                                <td><?= $rst['Prenom_etud'] ?></td>
                                                <?php 
                                                    $idNiv = $rst['id_niveau'];
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

                                                <td><label class="badge <?=$color?>"><?= $rst1['libel_niveau'] ?></label></td>
                                                <td>
                                                    <?php
                                                        $idetd = $rst['id_etud'];
                                                        $query = mysqli_query($con,"SELECT codClass FROM anneescol WHERE id_etud='$idetd'");
                                                        $resultat = mysqli_fetch_array($query);
                                                        echo $resultat['codClass'];
                                                    ?>
                                                </td>
                                                <td><?= $rst['tel_parent'] ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="detail_etud.php?idE=<?= $rst['id_etud'] ?>" class="btn btn-info ">
                                                          <i class="mdi mdi-clock"></i>
                                                        </a>
                                                      </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            
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