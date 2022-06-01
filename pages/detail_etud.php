<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <?php
   session_start();
   include "head.php";
   include ('../includes/config.php');
   if(strlen($_SESSION['id_user'])==0)
    { 
        header('location:login.php');
    }else{
      $iduser = $_SESSION['id_user'];
      $query1 = mysqli_query($con,"SELECT * FROM user WHERE id_user='$iduser'");
      $rst = mysqli_fetch_array($query1);
    }

   if(isset($_GET['idE'])){

     $idEtd = intval($_GET['idE']);
     $sql = mysqli_query($con, "SELECT * FROM etudiants WHERE id_etud='$idEtd'");
     $rst0 = mysqli_fetch_array($sql);

     $idSex = $rst0['id_sexe'];
     $row1 = mysqli_query($con, "SELECT * FROM sexe WHERE id_sex = '$idSex'");
     $rst1 = mysqli_fetch_array($row1);

     $idNiv = $rst0['id_niveau'];
     $row2 = mysqli_query($con, "SELECT * FROM niveau WHERE id_niveau = '$idNiv'");
     $rst2 = mysqli_fetch_array($row2);

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

     $query = mysqli_query($con,"SELECT codClass FROM anneescol WHERE id_etud='$idEtd'");
     $resultat = mysqli_fetch_array($query);
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
          <div class="row">
            <div class="row">
              <div class="col-xl-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-7">
                        <h5>Details Profil</h5>
                      </div>
                      <div class="col-sm-5 text-md-right">
                        <a href="edit_etud.php?edit=<?= $idEtd ?>" class="btn btn-icon-text mb-3 mb-sm-0 btn-inverse-success font-weight-normal ">
                          <i class="mdi mdi-tooltip-edit btn-icon-prepend"></i>Modifier</a>
                      </div>

                    </div>
                    <div class="row align-items-center">

                      <div class="col-sm-4">
                        <img src="../assets/images/faces/<?= $rst0['photo'] ?>" alt="" width="250px">
                      </div>
                      <div class="col-sm-4">
                        <h3 class="mt-3 mt-sm-0"><?= $rst0['nom_etud'] ?><br><?= $rst0['Prenom_etud'] ?></h3>
                        <div class="d-sm-flex">
                          <p class=""> <strong>date de naissance:</strong> <?= $rst0['Dat_naiss'] ?> </p>
                        </div>
                        <p class=""> <strong>Lieu naissance: </strong><?= $rst0['lieu_naiss'] ?></p>
                        <p class=""> <strong>Mail: </strong><?= $rst0['email'] ?></p>
                        <p class=""> <strong>nationalité: </strong><?= $rst0['nationalite'] ?></p>
                        <p class=""> <strong>sexe: </strong><?= $rst1['libel_sex'] ?></p>
                        <strong>niveau: </strong>
                        <p class="badge <?=$color?>"> <?= $rst2['libel_niveau'] ?></p>
                        <p class=""> <strong>Classe: </strong>n°<?=$resultat['codClass']?></p>
                        <p class=""> <strong>Tel: </strong><?= $rst0['tel'] ?></p>
                        <p class=""> <strong>Tel parent: </strong><?= $rst0['tel_parent'] ?></p>
                      </div>
                    </div>
                    <div class="row my-3">
                      <div class="col-sm-12">
                        <div class="card">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <p class=""> <b> Description</b></p>
                        <p class="text-muted mb-0">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                          labore et dolore.
                          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat, enim ratione. Praesentium
                          saepe officia excepturi eius.
                          Veniam aliquam quis distinctio quaerat aperiam minima deserunt beatae pariatur quibusdam
                          commodi, debitis earum.

                        </p>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                  bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from
                  Bootstrapdash.com</span>
              </div>
            </footer>
          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>

      <?php include "script.php"?>

</body>

</html>