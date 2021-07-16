<?php 
  include "serverconnect.php";
  $cid=mysqli_real_escape_string($connect,$_GET['cid']);
?>
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
        .form1{
        display: block;
        width: 80%;
        height:40px;
        padding: 10px ;
        font-weight: 400;
        color: black;
        background-color: rgb(255, 255, 255);
        background-clip: padding-box;
        border: 1px solid rgb(71,71,71);
        border-radius: 4px;
        } 

    </style>
</head>
<body>
<div class="jumbotron jumbotron-fluid jcolor">
    <div class="container">
      <h1 class="text-center">FOOD STATISTICS</h1>     
    </div>
  </div>

   <nav class="navbar navbar-expand-sm navbar1  navbar-dark ">
    <ul class="navbar-nav">
      <li class="nav-item ">
      <a class="nav-link" href="morning.php?cid=<?php echo $cid; ?>">Morning</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="noon.php?cid=<?php echo $cid; ?>">Afternoon</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Evening</a>
      </li>

    </ul>
  </nav>
  <div class="card card1">
    <div class="card-body">
       <div class="row">
           <div class="col-sm-6">
            <div class="input-group mb-3">
                <input  id="search"  class="form1" onkeyup="show(this.value)"   placeholder="Filter food items by name">
                <div class="input-group-append">
                <i class="fas fa-search icon1"></i>
                </div>
              </div>
           </div>

        </div>

   </div>

</div> 
<div id="t1">
<?php
  $sql = "SELECT * FROM food where session='EV' and canteen_id='$cid' ORDER BY food_qty DESC";
  $result = mysqli_query($connect, $sql);
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
  if (mysqli_num_rows($result) > 0){
    
  while($row = mysqli_fetch_array($result)) {
    $percent=($row['food_qty']/$row['initial_qty'])*100;
    $percent=number_format($percent, 1);
  ?>
    <tr>
             
             <td><?php echo $row['food_id'];?></td>
             <td><?php echo $row['food_name'];?></td>
             <td>
              <div class="container ">
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
      }
    ?>
 
</div>
<script>
function show(str) {
  var xhttp;  
  var session ='EV';
  var cid=<?php echo json_encode($cid); ?>;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("t1").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "common.php?session1="+session+"&q="+str+"&cid="+cid, true);
  xhttp.send();
}
</script>


</body>
</html>