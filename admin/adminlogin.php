<?php
include "serverconnect.php";
session_start();
include "php_functions.php";

if (isset($_SESSION['logsts']))
    session_destroy();
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="style1.css" class="">

    <title>ADMIN_Login</title>
</head>

<body id="body" background="">
    <div class="jumbotron jumbotron-fluid text-center bg-dark pb-2 pt-3">
        <h1 class=" display-3 text-white pt-0">TECH CANTEEN</h1>
        <hr class="m-2 ">
        <small class="text-muted text-center ">beta-version</small>
    </div>
    <!-- <h1 class="display-1 text-danger">WELCOME11</h1> -->
    <br><br><br>

    <div class="container border shadow-lg rounded p-4 py-5 mb-5 bg-white" style="max-width: 400px;">
        <form action="adminlogin.php" method="post">
            <h3 class="text-center  my-4">[ADMIN_LOGIN]</h3>

            <label for="text" class="ml-1">Admin:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                    </span>
                </div>
                <input type="text" name="Admin_name" class="form-control" placeholder="Name">
            </div>
                   
            <label for="password" class="ml-1">Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="password" name="Password" class="form-control" placeholder="Password">
            </div>
            
             <?php
                    if(isset($_POST['submit']))
                    {
                        validateAdmin();
                    }
            ?>
            <!-- <small class=" ml-1 text-muted">Password must be 8 characters</small> -->
            <div class="mt-3">
                <center>
                    <input type="submit" class="p-2 btn btn-block btn-danger" name="submit" value="Sign_in">
                </center>
            </div>
        </form>
    </div>
    
</body>

</html>
