<?php
include "serverconnect.php";
session_start();

if((isset($_GET['out'])) or (! isset($_SESSION['adminlog'])) or ($_SESSION['adminlog']!='set')){    

    setcookie("login_id", "", time() - 3600);
    setcookie("canteen_id", "", time() - 3600);
    setcookie("items", "", time() - 3600);
    
    session_unset();
    session_destroy();
    
    $_POST = array();

    mysqli_close($connect);

    header("Location: adminlogin.php");
}

?>