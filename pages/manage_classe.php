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
                                <h4 class="card-title">Listes des classes</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>N°Classe</th>
                                                <th>niveau</th>
                                                <th>Nbr etudiant</th>
                                                <th>Action</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            for($i=1;$i<6;$i++){
                                            $sql = mysqli_query($con,"SELECT DISTINCT codClass FROM anneescol WHERE id_niveau='$i'");
                                            while($result = mysqli_fetch_array($sql)){
                                                // $idNiv = $result['id_niveau'];
                                                $row = mysqli_query($con, "SELECT * FROM niveau WHERE id_niveau = '$i'");
                                                $rst = mysqli_fetch_array($row);
                                        ?>
                                            <tr>
                                                <?php
                                                    $codClass=$result['codClass'];
                                                    $cpt = 0;
                                                    $sql2 = mysqli_query($con,"SELECT * FROM anneescol WHERE codClass='$codClass'");
                                                    while($result = mysqli_fetch_array($sql2)){
                                                        $cpt++;
                                                    } 
                                                ?>
                                                <td><?=$codClass?></td>
                                                <?php 
                                                      // change les couleurs d'arriere plan 
                                                        if($i == 1){
                                                            $color = "badge-warning";
                                                        }elseif($i == 2){
                                                            $color = "badge-danger";
                                                        }elseif($i == 3){
                                                            $color = "badge-primary";
                                                        }else{
                                                            $color = "badge-success";
                                                        }
                                                ?>
                                                <td><label class="badge <?=$color?>"> <?=$rst['libel_niveau']?> </label></td>
                                                <td><?=$cpt?></td>
                                                <td><div class="dropdown">
                                                    <a href="./manage_classeList.php?class=<?=$codClass?>" class="btn btn-info btn-icon " >
                                                      <i class="mdi mdi-information"></i>
                                                    </a>
                                                  </div></td>
                                                <td></td>
                                                <td>
                                                    
                                                </td>
                                                
                                            </tr>
                                        <?php }} ?>
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