<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <?php 
    session_start();
    include "../includes/config.php";
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
                                <h4 class="card-title">Liste du personnel</h4>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-sm btn-icon-text btn-inverse-success border"
                                        data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm">
                                        <i class="mdi mdi-plus btn-icon-prepend"></i> Ajouter un utilisateur
                                    </button>
                                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier les informations</h5>
                                                    <button type="button" class="btn-close btn" data-bs-dismiss="modal">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../includes/add_persl.php" method="post">
                                                        <input type="text" class="form-control mb-2" name="nom" id=""
                                                            placeholder="Nom"  required>
                                                        <input type="text" class="form-control mb-2" name="prenom" id=""
                                                            placeholder="Prenom"  required>
                                                            <select class="form-control mb-2" name="role" Required>
                                                                <option>
                                                                    Selectionner le role
                                                            </option>
                                                            <?php
                                                                $query= mysqli_query($con,"SELECT * FROM role");

                                                                while($row = mysqli_fetch_array($query)){
                                                                ?>
                                                                 <option>
                                                                 <?= htmlentities($row['libel_role']) ?>
                                                                 </option>

                                                            <?php }?>
                                                            </select>

                                                            <select class="form-control mb-2" name="sexe" Required>
                                                                <option>
                                                                    Selectionner le sexe
                                                            </option>
                                                            <?php
                                                                $query2= mysqli_query($con,"SELECT * FROM sexe");

                                                                while($row2 = mysqli_fetch_array($query2)){
                                                                ?>
                                                                 <option>
                                                                 <?= htmlentities($row2['libel_sex']) ?>
                                                                 </option>

                                                            <?php }?>
                                                            </select>
                                                        <input type="text" class="form-control mb-2" name="password"
                                                            id="" placeholder="Nouveau Mot de passe" required>
                                                        <input type="text" class="form-control mb-2" name="Cpassword"
                                                            id="" placeholder="Confirmer le mot de passe" required>
                                                        <div class="modal-footer">
                                                            <input type="submit" name="save" value="Sauvegarder"
                                                                class="btn btn-success">
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Role</th>
                                                <th>Sexe</th>
                                                <th>Login</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $cpt = 0;
                                                    $sql = mysqli_query($con,"SELECT * FROM user");
                                                    while($result = mysqli_fetch_array($sql)){

                                                        $idrole = $result['id_role'];
                                                        $sql2 = mysqli_query($con,"SELECT * FROM role WHERE id_role='$idrole'");
                                                        $result2 = mysqli_fetch_array($sql2);
                                                         // change les couleurs d'arriere plan 
                                                        if($idrole == 1){
                                                            $color = "badge-warning";
                                                        }elseif($idrole == 2){
                                                            $color = "badge-danger";
                                                        }elseif($idrole == 3){
                                                            $color = "badge-primary";
                                                        }
                                                        $idsexe = $result['id_sexe'];
                                                        $sql3 = mysqli_query($con,"SELECT * FROM sexe WHERE id_sex='$idsexe'");
                                                        $result3 = mysqli_fetch_array($sql3);

                                                ?>
                                            <tr>
                                                <td>
                                                    <?=$result['nom']?>
                                                </td>
                                                <td>
                                                    <?=$result['prenom']?>
                                                </td>
                                                <td>
                                                    <label class="badge <?=$color?>">
                                                        <?=$result2['libel_role']?>
                                                    </label>
                                                </td>
                                                <td>
                                                    <?=$result3['libel_sex']?>
                                                </td>
                                                <td>
                                                    <?=$result['login']?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-icon-text"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".bd-example-modal-sm<?=$cpt?>">
                                                        <i class="mdi mdi-information"></i>
                                                        Modifier
                                                    </button>

                                                    <div class="modal fade bd-example-modal-sm<?=$cpt?>" tabindex="-1"
                                                        role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Modifier les informations
                                                                    </h5>
                                                                    <button type="button" class="btn-close btn"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="mdi mdi-close"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../includes/personnel.php"
                                                                        method="post">
                                                                        <input type="hidden" name="id_user"
                                                                            value="<?=$result['id_user']?>">
                                                                        <input type="text" class="form-control mb-2"
                                                                            name="mdp" id=""
                                                                            placeholder="<?=$result['password']?>">

                                                                        <select class="form-control" name="role">
                                                                            <option>
                                                                                <?=$result2['libel_role']?>
                                                                            </option>
                                                                            <?php
                                                                                $query= mysqli_query($con,"SELECT * FROM role");

                                                                                while($row = mysqli_fetch_array($query)){
                                                                            ?>
                                                                            <option>
                                                                                <?= htmlentities($row['libel_role']) ?>
                                                                            </option>

                                                                            <?php }?>
                                                                        </select>
                                                                        <div class="modal-footer">
                                                                            <input type="submit" name="save"
                                                                                value="Modifier"
                                                                                class="btn btn-primary">
                                                                        </div>
                                                                    </form>
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