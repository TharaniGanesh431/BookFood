<?php 
  include "logout.php"; 
  // session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ADMIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">

        function check(value1){
          // event.preventDefault();
          // document.getElementById("option1").innerHTML = value1;
          alert("sonethinhg");
        }

        function filter(){
          // event.preventDefault();
          // var filtemp=1;
          // var cantemp=<?php echo json_encode($_POST['canteen2']); ?>;
          // var sestemp=<?php echo json_encode($_POST['session2']); ?>;
          // $.post("filter.php", {filter3: filtemp,canteen1: cantemp,session1: sestemp},function(option){
          //     $("#option1").html(option);//
          // });
        }

        function foodselect(value1){
          document.getElementById("option1").innerHTML = value1;
          // var cantemp=<?php echo json_encode($_POST['canteen2']); ?>;
          // var sestemp=<?php echo json_encode($_POST['session2']); ?>;
          // $.post("filter.php", {canteen1: cantemp,session1: sestemp,foodselect2: value1},function(option){
          //     $("#currentsts").html(option);//
          // });
        }
    </script>
</head>

<body style=" background-color:black;" >
     <div class="container-fluid" style="background-color:black ;" >
       <div class="well well-sm" style="background-color:black; border-color: black;">
         <h1 class="text-center" style="color:floralwhite"><span class="glyphicon glyphicon-cog"></span> ADMIN PANEL</h1>
       </div>
     </div>


    <div class="col-sm-6">
    <div class="well well-lg">
  <!-- <form method="post"> -->
     <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label for="session">SESSION:</label>
              <select onchange='alert(this.value)'>
                <option value='FN'>Forenoon</option>
                <option value='AF'>Afternoon</option>
                <option value='EV'>Evening</option>
              </select>
          </div>
        </div>
        <div class="col-sm-4">
        <!-- <button id="button" type="button" value="send" class="btn btn-primary">Submit</button> -->
            <button id="button" onclick="filter()" class="btn btn-primary h">FILTER</button>
        </div>
        <br>
     </div>
    
      <div id='option1'></div>
    
       <!-- <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label>FOOD NAME:</label>

        <?php

          // if(isset($_POST['filter3']))
          // {
          //   $cid=mysqli_real_escape_string($connect,$_POST['cantee']);
          //   $ses=mysqli_real_escape_string($connect,$_POST['session']);
          //   $_SESSION['cid']=$cid;
          //   $_SESSION['ses']=$ses;
          //   $query="SELECT * FROM food where canteen_id= '$cid' AND session= '$ses'";

          //   $result=mysqli_query($connect,$query);
          //   echo "<select class='form-control' name='food'>";
          //   while($row = mysqli_fetch_assoc($result))
          //     {
          //         $id=$row['food_name'];
          //         echo "<option value='" .$id. "'>" .$id. "</option>";    
          //     }
          //   echo "</select>";
          // }
          // else
          // {
          //   echo "<div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Please do Filter </div>";
          // }

          
       ?> 
        </div>
      </div>
      </div>
      <?php 
      
      // if(isset($_POST['filter3']))
      // {
      //   echo"    <div class='row'>
      //             <div class='col-sm-5'>
      //               <div class='form-group'>
      //               <label for='status'>FOOD AVAILABILTY:</label>
      //               <select class='form-control' name='status1' id='status'>
      //                 <option value=1>Available</option>
      //                 <option value=0>Not Available</option>
      //               </select>
      //             </div>
      //             </div>
      //         </div>";
      // }
      ?> -->

    <?php
        
        if(isset($_POST['status_change']))
        {
          change_food_status($_POST['canteen2'],$_POST['session2'],$_POST['food2'],$_POST['status1']);
        }
    
    ?>
    <!-- <br>
    <div class="row">
      <div class="col-sm-5">
        <button type="submit" name="status_change" class="btn btn-success">Change Status</button>
     </div>
  </div> -->

  </form>
  </div>
  </div>

</div>
</div>
    
   

    

</div>
</div>
</body>
</html>
