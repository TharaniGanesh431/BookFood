<!DOCTYPE html>
<html lang="en">
<head>
  <title>Food statistics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <style>
    .jcolor{
          background-color:black;
          color: rgb(255, 255, 255);
      }
      body{
        background-color: rgb(250, 250, 250);
      }
      .card1{
          background-color:rgb(238, 238, 238);
          color: rgb(32, 30, 30);
          margin-top:15px;
          margin-bottom: 15px;
      }
      .navbar1
      {
          background-color:black;
        }
        
        .hcol{
          background-color:  rgba(35, 25, 182, 0.952);  
            color:white;
        }
        .btn-primary1{
          background-color: rgba(223, 72, 62, 0.952) ;
          color:white;
        }
        .btn-primary2{
        background-color: rgba(12, 109, 219, 0.952) ;
        color:white;
        }
        .pbar{
          background-color: rgba(119, 12, 219, 0.952);
        }
        .progress1{
          border: 1px solid rgb(255, 255, 255);
          height:25px;

        }
        td{
        background-color:  rgb(255, 255, 255);
        }
        .icon1{
            border:1px solid black;
            padding:10px;
            width:40px;
            color:white;
            background-color:red;
        }
  </style>
</head>
<body>
<?php
// get the q parameter from URL
$search = strtoupper($_GET["q"]);
$session1=$_GET['session1'];
$cid=$_GET['cid'];

// lookup all Gethints from array if $q is different from ""
//  if($q !== ""){
//   $q = strtolower($q);
//   $len=strlen($q);
//  }
  include "serverconnect.php";

  $sql = "SELECT * FROM food where session ='$session1' and canteen_id='$cid' and food_name LIKE '%$search%' ORDER BY food_qty DESC";
  $result = mysqli_query($connect, $sql);
  $c=mysqli_num_rows($result);
  if ($c > 0){
    ?>
    <div class="card card1">
      <div class="card-body">
          <table class="table table-bordered">
              <thead>
              <tr>
                <th class="hcol">Item ID</th>
                <th class="hcol">Food Name</th>
                <th  class="hcol">Quantity Remaining</th>
             </tr>
             </thead>
             <tbody>
  <?php

  while($row = mysqli_fetch_array($result)) {
        
        //  $name=$row['food_name'];
        $percent=($row['food_qty']/$row['initial_qty'])*100;
        $percent=number_format($percent, 1);
  ?>
    <tr>
             
             <td><?php echo $row['food_id'];?></td>
             <td><?php echo $row['food_name'];?></td>
             <td>
              <div class="container ">
                <!-- <h4>Item Remaining:</h4> -->
                <div class="progress progress1">
                  <div class="progress-bar pbar " role="progressbar" aria-valuenow="<?php echo $percent;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent.'%';?>">
                   <?php echo $percent.'%';?>
                  </div>
                </div>
              </div>
              </td>
      </tr>
   <?php
      }
      //  else{   
      //    $percent=($row['food_qty']/$row['initial_qty'])*100;
      //   $percent=number_format($percent, 1);

      // ?>
       <!-- <tr>
             
             <td><?php echo $row['food_id'];?></td>
             <td><?php echo $row['food_name'];?></td>
             <td>
              <div class="container ">
                <h4>Item Remaining:</h4> 
                <div class="progress progress1">
                  <div class="progress-bar pbar " role="progressbar" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent.'%';?>">
                   <?php echo $percent.'%';?>
                  </div>
                </div>
              </div>
              </td>
      </tr> -->
   <?php
      // }
    }
    ?>
    
    </tbody>
   </table>
 <?php
    if($c == 0 ){ ?>
   <h4 class ="text-center"><div class="alert alert-danger">
   <strong>No Items Found!</strong>
   </div></h4>
    <?php
  }

   ?>

      </div>
      </div>
  </body>
  </html>