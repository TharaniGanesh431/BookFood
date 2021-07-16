<?php
include "serverconnect.php";
session_start();

if((isset($_POST['out'])) or (! isset($_SESSION['logsts'])) or ($_SESSION['logsts']!='set') or ((isset($_SESSION['ordered'])) and ($_SESSION['ordered']=='yes'))){    

    setcookie("login_id", "", time() - 3600);
    setcookie("canteen_id", "", time() - 3600);
    setcookie("items", "", time() - 3600);
    
    session_unset();
    session_destroy();
    
    $_POST = array();

    mysqli_close($connect);

    header("Location: login.php");
}

?>