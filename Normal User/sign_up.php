<?php include "Php_functions.php"; ?> 


<!DOCTYPE html>
<html lang="en">
<head>
<title>TECH CANTEEN</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body id="body">
    <div class="jumbotron jumbotron-fluid text-center bg-dark pb-2 pt-3">
        <h1 class=" display-3 text-white pt-0">TECH CANTEEN</h1>
        <hr class="m-2 ">
        <small class="text-muted text-center ">sign_in_page</small>
    </div>
    <!-- <h1 class="display-1 text-danger">WELCOME11</h1> -->
    <br><br><br>
    
    
    <div class="container border border shadow-lg rounded p-4 mb-4 bg-white" style="max-width: 400px;">
        <form method="post" action="sign_up.php">
            <h3 class="text-center  my-4">SIGN_UP</h3>

            <label for="text" class="ml-1">Roll_no:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-id-badge"></i>
                    </span>
                </div>
                <input type="text" name="id" class="form-control" placeholder="roll_no">
            </div>
            <div id='roll_number' class='alert alert-warning' role='alert' style="display:none">No Match Found!</div>
            
            
            
            <label for="text" class="ml-1">Student_name:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user-circle"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="name" name="username">
            </div>
            
            
            
            <label for="password" class="ml-1">Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <small class=" ml-1 text-muted">Password must be 8 characters</small>
            <br>
            
            
            
            <label for="password" class="ml-1 mt-1 ">Confirm_Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                <input type="password" name="c_password" class="form-control" placeholder="Password">
            </div>
            
            
            <label for="Mobile_Number" class="ml-1 mt-1 ">Mobile_Number:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-phone"></i>
                    </span>
                </div>
                <input type="number" name=" m_no" class="form-control" placeholder="current_number">
            </div>
            <div class="mt-4">
                <?php 
                if(isset($_POST['submit'])){
                    
                    createRows(); 
                    }
                ?>
              
               <input type="submit" name="submit" value="CREATE ACCOUNT" class="btn btn-block btn-info">
                <p class="pt-2">Already have a account? <a href="login.php">Sign in</a></p>
               <!-- </center>-->

            </div>
        </form>
    </div>    

</body>

</html>
