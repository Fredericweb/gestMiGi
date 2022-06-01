<?php
session_start();
include("config.php");
$_SESSION['id_user']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="../pages/login.php";
</script>
