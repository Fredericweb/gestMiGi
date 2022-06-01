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
                                    <h4 class="card-title">Verification de reçu</h4>
                                    <center><video id="preview"></video></center> 
                                    
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
    <!-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>	 -->
    <script>
        let scanner = new Instascan.Scanner(
            {
                video: document.getElementById('preview')
            }
        );
        scanner.addListener('scan', function(content) {
            document.location='../html2php/index.php?numrecu='+content;
        });
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error("aucune camera detectée");
            }
        });
    </script>
   
</body>

</html>