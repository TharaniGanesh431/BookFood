<?php 
include "Php_functions.php"; 
session_start();
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
    <style>
        body {
            background-image:
                url('');

            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>

    <title>FORGOT PASWWORD</title>
</head>

<body id="body" background="">
    <div class="jumbotron jumbotron-fluid text-center bg-dark pb-2 pt-3">
        <h1 class=" display-3 text-white pt-0">TECH CANTEEN</h1>
        <hr class="m-2 ">
        <small class="text-muted text-center ">FORGOT_PASSWORD_official</small>
    </div>
    <!-- <h1 class="display-1 text-danger">WELCOME11</h1> -->
    <br><br><br>

    <div class="container border shadow-lg rounded p-4 py-5 bg-white" style="max-width: 400px;">
        <form action="forget_pass.php" method="post">
            <h3 class="text-center my-4">Forget_password</h3>
            <label for="text" class="ml-1">Roll_NO:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user-circle"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="username" placeholder="roll_no">
            </div>
            <div class="container">
               <input type="submit" class="btn btn-bloc btn-info px-4" name="gen_otp" value="Generate OTP">
               <input type="submit" class="btn btn-bloc btn-info px-4" name="gen_otp" value="Resend OTP">
            </div>
            
            <?php
    
            if(isset($_POST['gen_otp']))
            {   
                $_SESSION['username']=$_POST['username'];
                echo $_POST['username'];
                generateOTP();
            }
            ?>  
           
           
            <?php
            if(isset($_POST['gen_new_pass']))
            {
                validateOTP($_SESSION['username']);
            }
                ?>
            <br>
            <label for="otp" class="ml-1">OTP:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="text" class="form-control" name="otp" placeholder="Generated OTP">
            </div>
            <!-- <small class=" ml-1 text-muted">Password must be 8 characters</small> -->
            <br>
            <center>
                <div class="dropdown">
                    <button class="btn btn-lg dropdown-toggle btn-info" data-toggle="dropdown">
                        Change Password
                    </button>
                    <div class="container dropdown-menu m-3 p-3 border shadow-lg">
                        <form class="m-3 px-2 py-2">
                            <div class="form-group">
                                <label for="new_pwd">New Password</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="new_pass" class="form-control" name="" id="new_pwd"
                                    placeholder="New password">
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="confirm_pwd">Confirm Password</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                <input type="password" name="new1_pass" class="form-control" name="" id="confirm_pwd"
                                    placeholder="confirm password">
                            
                                </div>
                            </div>
                            <!--<button type="submit" class="btn btn-block btn-info">Done</button>-->
                             <input type="submit" name="gen_new_pass" value="Done" class="btn btn-block btn-info">
                        </form>
                    </div>
                </div>
                <br><span>Changed Password?<a href="login.php">Login</a></span>
            </center>
        </form>
    </div>
</body>

</html>
