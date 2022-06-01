<!DOCTYPE html>
<html lang="en">

<?php 
  session_start();
  include "head.php";
  include "../../includes/config.php";

  if(strlen($_SESSION['id_user'])==0)
  { 
    header('location:../login.php');
  }
else{

  $iduser = $_SESSION['id_user'];
  $query = mysqli_query($con,"SELECT * FROM user WHERE id_user='$iduser'");
  $rst = mysqli_fetch_array($query);

  // calcul de l'année scolaire en cours
  $annee = date('y');
  $annee2 = $annee+1;
  $anneeScol = "$annee-$annee2";

  // calcul nbr etudiant
  $sql = mysqli_query($con,"SELECT * FROM etudiants WHERE anneescol='$anneeScol'");
  $rst1 = mysqli_num_rows($sql);

  // calcul nbr classe
  $sql2 = mysqli_query($con,"SELECT DISTINCT CodClass FROM anneescol");
  $rst2 = mysqli_num_rows($sql2);

  // calcul nbr classe
  $cpt=0;
  $sql3 = mysqli_query($con,"SELECT rest_pay FROM compte_etud");
  while($rst3 = mysqli_fetch_array($sql3)){
    if($rst3['rest_pay'] == 0){
      $cpt++;
    }
  }

  // calcul somme totals des scolarité
  $som = 0;
  for($i=1;$i<6;$i++){
    $nbr = 0;
    $sql4 = mysqli_query($con,"SELECT * FROM etudiants WHERE id_niveau='$i'");
    while($rst4 = mysqli_fetch_array($sql4)){
      $nbr++;
    }
      $sql5 = mysqli_query($con,"SELECT montant FROM scolarite WHERE id_niveau='$i'");
      $rst5 = mysqli_fetch_array($sql5);
      $som = $som + ($nbr*$rst5['montant']);
  }

   // calcul somme totals des scolarité
   $somme = 0;
   $sql6 = mysqli_query($con,"SELECT * FROM compte_etud");
   while ($rst6 = mysqli_fetch_array($sql6)){
     $idetd = $rst6['id_etud'];
     $sql7 = mysqli_query($con,"SELECT * FROM etudiants WHERE id_etud='$idetd'");
     $rst7 = mysqli_fetch_array($sql7);
     $idniv = $rst7['id_niveau'];

     $sql8 = mysqli_query($con,"SELECT * FROM scolarite WHERE id_niveau='$idniv'");
     $rst8 = mysqli_fetch_array($sql8);
     $montant = $rst8['montant'];
     $pay = $montant - $rst6['rest_pay'];
     $somme+=$pay;
   }
   

  if(isset($_POST['save']))
      {
         $uname=$_POST['login'];
         $password=$_POST['password'];
         $cpassword=$_POST['Cpassword'];
         if($password == $cpassword){
            $sql = mysqli_query($con,"Update  user set login='$uname',password='$password' where id_user='$iduser'");
         }else{
            echo "<script>alert('mot de passe ne correspond pas');</script>";
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
    <!-- end sidebar -->

    <div class="container-fluid page-body-wrapper">

      <!-- header top -->
      <?php include "header.php"?>
      <!-- end header -->
     
      <div class="main-panel">
        <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
            <h3 class="mb-0"> Bienvenu <?=$rst['login']?> <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block"></span>
            </h3>
            <div class="d-flex">
              <button type="button" class="btn btn-sm bg-white btn-icon-text border" data-bs-toggle="modal"
                data-bs-target=".bd-example-modal-sm">
                <i class="mdi mdi-tooltip-edit btn-icon-prepend"></i> Modifier les informations du compte
              </button>
              <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modifier les informations</h5>
                      <button type="button" class="btn-close btn" data-bs-dismiss="modal">
                        <i class="mdi mdi-close"></i>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="../../includes/edit_persl.php" method="post">
                        <input type="text" class="form-control mb-2" name="login" id="" placeholder="Login" value="<?=$rst['login']?>" required>
                        <input type="text" class="form-control mb-2" name="password" id=""
                          placeholder="Nouveau Mot de passe" required>
                        <input type="text" class="form-control mb-2" name="Cpassword" id=""
                          placeholder="Confirmer le mot de passe" required>
                        <div class="modal-footer">
                            <input type="submit" name="save" value="Sauvegarder" class="btn btn-primary">
                        </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>
              <?php 
                 if($rst['id_role'] == 1 OR $rst['id_role'] == 2){
                  echo "<a href='../add_etud.php' class='btn btn-sm ml-3 btn-success'> Ajouter un etudiant </a>";
                }
              ?>
            </div>
          </div>
          <div class="row pdf-row">
            <div class="col-xl-3 col-lg-12 stretch-card grid-margin">
              <div class="row">
                <?php 
                  $query = mysqli_query($con,"SELECT * FROM niveau");
                  while($resultat = mysqli_fetch_array($query)){

                    // change les couleurs d'arriere plan 
                    if($resultat['id_niveau'] == 1){
                      $bg = "bg-warning";
                      $ic = "bg-inverse-icon-warning";
                    }elseif($resultat['id_niveau'] == 2){
                      $bg = "bg-danger";
                      $ic = "bg-inverse-icon-danger";
                    }elseif($resultat['id_niveau'] == 3){
                      $bg = "bg-primary";
                      $ic = "bg-inverse-icon-primary";
                    }else{
                      $bg = "bg-success";
                      $ic = "bg-inverse-icon-success";
                    }

                    // compte le nombre de classe par niveau
                    $idniveau = $resultat['id_niveau'];
                    $query1 = mysqli_query($con,"SELECT DISTINCT codClass FROM anneescol WHERE id_niveau='$idniveau'");
                    $resultat1 = mysqli_num_rows($query1);

                    // compte le nombre d'etudiants par niveau
                    $query2 = mysqli_query($con,"SELECT * FROM anneescol WHERE id_niveau='$idniveau'");
                    $resultat2 = mysqli_num_rows($query2);
                ?>
                <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                  <div class="card <?=$bg?>">
                    <div class="card-body px-3 py-4">
                      <div class="d-flex justify-content-between align-items-start">
                        <div class="color-card">
                          <p class="mb-0 color-card-head"><?=$resultat['libel_niveau']?></p>
                          <h2 class="text-white"><?=$resultat1?><span class="h5"> Classe(s)</span>
                          </h2>
                        </div>
                        <i class="card-icon-indicator mdi mdi-account-multiple <?=$ic?>"></i>
                      </div>
                      <h6 class="text-white"><?=$resultat2?> Etudiants</h6>
                    </div>
                  </div>
                </div>
                  <?php }?>
              </div>
            </div>
            <div class="col-xl-9 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-7">
                      <h5>Statistique</h5>
                      <p class="text-muted"><a class="text-muted font-weight-medium pl-2" href="#"><u>
                           </u></a>
                      </p>
                    </div>
                   
                    <div class="col-sm-5 text-md-right">
                      <button type="button" onclick="PDF();"
                        class="btn btn-icon-text mb-3 mb-sm-0 btn-inverse-primary font-weight-normal">
                        <i class="mdi mdi-download btn-icon-prepend"></i>Telecharger le rapport</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="card mb-3 mb-sm-0">
                        <div class="card-body py-3 px-4">
                          <p class="m-0 survey-head">Total etudiant</p>
                          <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                            <div>
                              <h3 class="m-0 survey-value"> <?=$rst1 ?> </h3>
                              <p class="text-success m-0">+31%</p>
                            </div>
                            <div id="earningChart" class="flot-chart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card mb-3 mb-sm-0">
                        <div class="card-body py-3 px-4">
                          <p class="m-0 survey-head">Classes</p>
                          <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                            <div>
                              <h3 class="m-0 survey-value"><?=$rst2?></h3>
                              <p class="text-danger m-0">-10%</p>
                            </div>
                            <div id="productChart" class="flot-chart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                        <div class="card-body py-3 px-4">
                          <p class="m-0 survey-head">Scolarité soldés</p>
                          <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                            <div>
                              <h3 class="m-0 survey-value"><?=$cpt ?></h3>
                              <p class="text-success m-0">+136%</p>
                            </div>
                            <div id="orderChart" class="flot-chart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-sm-12">
                      <div class="flot-chart-wrapper">
                        <div id="flotChart" class="flot-chart">
                          <canvas class="flot-base"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <p class="text-muted mb-0"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore.
                      </p>
                    </div>
                    <div class="col-sm-4">
                      <p class="mb-0 text-muted">Total Montant scolarité payé</p>
                      <h5 class="d-inline-block survey-value mb-0"><?=$somme?> Fcfa</h5>
                      <p class="d-inline-block text-danger mb-0">sur <?=$som ?> fcfa</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © AsteroDesign
              2022</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                href="http://asterodesign.ml/" target="_blank">AsteroDesign</a> pour Miage-Gi.com</span>
          </div>
        </footer>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- script -->
  <?php include "script.php"?>
  <!-- HTML2PDF SOURCE -->
  <script src="../../html2php/html2pdf.bundle.js"></script>
  <script src="../../html2php/html2pdf.bundle.min.js"></script>
  <!-- CUSTOM JS -->
  <script type="text/javascript">

        function PDF() {
            const e = document.querySelector(".pdf-row");

            // OPTIONS
            const opt = {
                filename: 'Rapport.pdf',
                image: {
                    type: "jpeg",
                    quality: 0.99
                },
                margin: 0,
                jsPDF: {
                    unit: "in",
                    format: "letter",
                    orientation: "portrait"
                },
                html2canvas: { scale: 1 },
            };
            html2pdf().set(opt).from(e).save();

            // RESIZE
            setTimeout(() => { e.style.maxWidth = "1400px"; }, 2000);
        }

  </script>
  
</body>

</html>

<?php }?>