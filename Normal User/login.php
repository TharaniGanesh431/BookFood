<?php
include "serverconnect.php";
session_start();
include "php_functions.php";

if (isset($_SESSION['logsts']))
    session_destroy();

if (isset($_POST['submit']))
    validate_user();
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="style1.css" class="">
    <style>
        body {
        background-image:
        url('');
        
        background-attachment: fixed;
        background-size: 100% 100%;
        }
        
    </style>

    <title>TECH CANTEEN</title>
</head>


<body id="body" background="">
    <div class="jumbotron jumbotron-fluid text-center bg-dark pb-2 pt-3">
        <h1 class=" display-3 text-white pt-0">TECH CANTEEN</h1>
        <hr class="m-2 ">
        <small class="text-muted text-center ">Login_official</small>
    </div>
    
    <br><br><br>
    
    
    <div class="container border shadow-lg rounded p-4 py-5 mb-5 bg-white" style="max-width: 400px;">
        <form target="_self" method="post" action="login.php">
            
            <h3 class="text-center  my-4  ">LOGIN</h3>

            <label for="text" class="ml-1">User_name:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user-circle"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="id" placeholder="roll_no">
            </div>
            
            <label for="password" class="ml-1">Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <br>
            <div>
               <button name="submit" class="p-2 btn btn-block btn-primary" value="SUBMIT" id="new" >SUBMIT</button>
                <center><p class="text-muted m-2">Forgot Password? <a class="text-info" href="forget_pass.php">Click here</a></p></center>
                <p class="text-center m-2">Not a member? <a class="text-info" href="sign_up.php">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>