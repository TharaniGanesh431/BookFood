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
</head>
<style>
  .navbar{
    color: floralwhite;
    border-radius: 0%;
  }
  .hbold1{
    font-weight:800;
  }
  .col-sm-4{
      margin-bottom:20px;
      margin-top:27px;
      margin-left:70px;

  }

</style>
<body style=" background-color:black;" >
     <div class="container-fluid" style="background-color:black ;" >
       <div class="well well-sm" style="background-color:black; border-color: black;">
         <h1 class="text-center" style="color:floralwhite"><span class="glyphicon glyphicon-cog"></span> ADMIN PANEL</h1>
       </div>
     </div>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="admin.php">ADMIN PANEL</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">FOOD STATISTICS
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="morning.php?cid=C1">F-Block Canteen</a></li>
          <li><a href="morning.php?cid=C2">J-Block Canteen</a></li>
          <li><a href="morning.php?cid=C3">A-Block Canteen</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a  href="admin.php?out=true"><span class="glyphicon glyphicon-log-out"></span>LOG OUT</a></li>
    </ul>

  </div>
</nav>


<!--1,2-->

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <div class="well well-lg">
        <form action="" method="post">
          
        <h4 class="hbold1">MANAGE CANTEEN :</h4>
        <br>
        <div class="row">
           <div class="col-sm-5">
           <div class="form-group">
         <label>CANTEEN:</label>
              
           <?php 

            $query="SELECT * FROM canteen";
            $result=mysqli_query($connect,$query);
            echo "<select class='form-control' name='canteen'>";
            while($row = mysqli_fetch_assoc($result))
              {
                  $id=$row['canteen_name'];
                  echo "<option value='" .$id. "'>" .$id. "</option>";    
              }
            echo "</select>";
            ?>
            </div>
           
           </div>
        </div>
    
         <br>

          <div class="row">
            <div class="col-sm-5">
              <div class="form-group">
              <label for="status">STATUS:</label>
              <select class='form-control' name='status' id='status'>
                <option value=1>Open</option>
                <option value=0>Close</option>
              </select>
            </div>
            </div>
         </div>
      
    
        <?php
            include "php_functions.php";
            if(isset($_POST['change_status']))
            {
              change_canteen_status($_POST['status'],$_POST['canteen']);
            }
          
        ?>
           <br><br>
       <div class="row">
        <div class="col-sm-5">
          <button type="submit" name="change_status" class="btn btn-success">CHANGE STATUS</button><br><br><br><br><br>
       </div>
       </div>

      </form>
      </div>
    </div>

    <div class="col-sm-6">
    <div class="well well-lg">
    <form action="" method="post">
    
      <h4 class="hbold1">MANAGE FOOD AVAILABILTY STATUS:</h4>
      <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label>CANTEEN:</label>         
            <?php 
              $query="SELECT * FROM canteen";
              $result=mysqli_query($connect,$query);
              echo "<select class='form-control' name='canteen2' onchange='check(this.value)'>";
                                      
              while($row = mysqli_fetch_assoc($result))
                {
                  echo "<option value='" .$row['canteen_id']. "'>" .$row['canteen_name']. "</option>"; 
                }
              echo "</select>";
            ?>
        </div>
     </div>
     </div>

     <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label for="session">SESSION:</label>
              <select class='form-control' name='session2' id='session' onchange='foodselect(this.value)'>
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

     <script type="text/javascript">

     check("woking");

        function check(value1){
          // event.preventDefault();
          // document.getElementById("option1").innerHTML = value1;
          alert("sonethinhg");
        }

        function filter(){
          event.preventDefault();
          var filtemp=1;
          var cantemp=<?php echo json_encode($_POST['canteen2']); ?>;
          var sestemp=<?php echo json_encode($_POST['session2']); ?>;
          $.post("filter.php", {filter3: filtemp,canteen1: cantemp,session1: sestemp},function(option){
              $("#option1").html(option);//
          });
        }

        function foodselect(value1){
          document.getElementById("option1").innerHTML = value1;
          // var cantemp=<?php echo json_encode($_POST['canteen2']); ?>;
          // var sestemp=<?php echo json_encode($_POST['session2']); ?>;
          // $.post("filter.php", {canteen1: cantemp,session1: sestemp,foodselect2: value1},function(option){
          //     $("#currentsts").html(option);//
          });

          
        }
    </script>
    
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
    
   <div class="col-sm-6">
      <div class="well well-lg">
       <form action="" method="post">
            
        <h4 class="hbold1">MANAGE FOOD PRICE :</h4>
        <div class="row">
          <div class="col-sm-5">
           <div class="form-group">
             <label>CANTEEN:</label>

          <?php
            $query="SELECT * FROM canteen";
            $result=mysqli_query($connect,$query);
            echo "<select class='form-control' name='cantee'>";
            while($row = mysqli_fetch_assoc($result))
            {
                // $id=$row['canteen_id'];
                echo "<option value='" .$row['canteen_id']. "'>" .$row['canteen_name']. "</option>";    
            }
            echo "</select>";
          ?>
         </div>
        </div>
        </div>
      
       <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label for="session">SESSION:</label>
              <select class='form-control' name='session' id='session'>
                <option value='FN'>Forenoon</option>
                <option value='AF'>Afternoon</option>
                <option value='EV'>Evening</option>
              </select>
        </div>
     </div>
     </div>

      <div class="row">
          <div class="col-sm-4">
            <button type="submit" name="filter1" class="btn btn-primary">FILTER</button>
          </div>
        </div><br>
    
       <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label>FOOD NAME:</label>

        <?php

          $query="SELECT * FROM food";

          if(isset($_POST['filter1']))
          {
            $cid=mysqli_real_escape_string($connect,$_POST['cantee']);
            $ses=mysqli_real_escape_string($connect,$_POST['session']);
            $_SESSION['cid']=$cid;
            $_SESSION['ses']=$ses;
            $query="SELECT * FROM food where canteen_id= '$cid' AND session= '$ses'";
          }

          $result=mysqli_query($connect,$query);
           echo "<select class='form-control' name='food'>";
	           while($row = mysqli_fetch_assoc($result))
                {
                    $id=$row['food_name'];
                    echo "<option value='" .$id. "'>" .$id. "</option>";    
                }
          echo "</select>";
       ?> 
        </div>
    
     </div>
     </div>
     
    
     <div class="row">
      <div class="col-sm-5">
        <div class="form-group">
        <label for="price">FOOD PRICE:</label>
       <input type="text"  class="form-control" name="price" id="price">
      </div>
      </div>
     </div>
        <?php
                
          if(isset($_POST['change_price']))
          {
              change_food_price($_SESSION['cid'],$_SESSION['ses'],$_POST['food'],$_POST['price']);
          }
            
        ?>
      <br>
      <div class="row">
          <div class="col-sm-5">
            <button type="submit" name="change_price" class="btn btn-success">CHANGE PRICE</button>
         </div>
      </div>
  
     
    </form>
    </div>
    </div>
    
  </div>
</div>

<!--3,4-->
<div class="container-fluid">
<div class="row">
  <div class="col-sm-6">
    <div class="well well-lg">
     <form action="" method="post">
        
      <h4 class="hbold1">MANAGE FOOD QUANTITY :</h4>
      <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label>CANTEEN:</label>

          <?php 
          $query="SELECT * FROM canteen";
          $result=mysqli_query($connect,$query);
          echo "<select class='form-control' name='cantee'>";
             
                   
          while($row = mysqli_fetch_assoc($result))
            {
              echo "<option value='" .$row['canteen_id']. "'>" .$row['canteen_name']. "</option>"; 
            }
          echo "</select>";
          ?>
          
        </div>
     </div>
     </div>
     
     <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label for="session">SESSION:</label>
              <select class='form-control' name='session' id='session'>
                <option value='FN'>Forenoon</option>
                <option value='AF'>Afternoon</option>
                <option value='EV'>Evening</option>
              </select>
        </div>
     </div>
     </div>

      <div class="row">
          <div class="col-sm-4">
            <button type="submit" name="filter2" class="btn btn-primary">FILTER</button>
          </div>
        </div><br>

       <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label>FOOD NAME:</label>

        <?php

          $query="SELECT * FROM food";

          if(isset($_POST['filter2']))
          {
            $cid=mysqli_real_escape_string($connect,$_POST['cantee']);
            $ses=mysqli_real_escape_string($connect,$_POST['session']);
            $_SESSION['cid']=$cid;
            $_SESSION['ses']=$ses;
            $query="SELECT * FROM food where canteen_id= '$cid' AND session= '$ses'";
          }

          $result=mysqli_query($connect,$query);
           echo "<select class='form-control' name='food'>";
	           while($row = mysqli_fetch_assoc($result))
                {
                    $id=$row['food_name'];
                    echo "<option value='" .$id. "'>" .$id. "</option>";    
                }
          echo "</select>";
       ?> 
        </div>
      </div>
      </div>

     <div class="row">
      <div class="col-sm-5">
        <div class="form-group">
        <label for="quantity">FOOD QUANTITY:</label>
       <input type="text"  class="form-control" name="quantity" id="quantity">
      </div>
      </div>
     </div>      
      <?php
            
        if(isset($_POST['change_quantity']))
        {
            change_food_quantity($_SESSION['cid'],$_SESSION['ses'],$_POST['food'],$_POST['quantity']);
        }
        
      ?>
     <br>
    <div class="row">
      <div class="col-sm-5">
        <button type="submit" name="change_quantity" class="btn btn-success">CHANGE QUANTITY</button>
     </div>
  </div>

  </form>
  </div>
</div>
 
 


<div class="col-sm-6">
      <div class="well well-lg">
        <form action="" method="post" enctype="multipart/form-data">
          
        <h4 class="hbold1">ADD FOOD :</h4>
        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
            <label for="canteen_id">CANTEEN ID:</label>
           <?php 
          $query="SELECT * FROM canteen";
          $result=mysqli_query($connect,$query);
          echo "<select class='form-control' name='canteen_id'>";                  
          while($row = mysqli_fetch_assoc($result))
            {
              echo "<option value='" .$row['canteen_id']. "'>" .$row['canteen_name']. "</option>"; 
            }
          echo "</select>";
          ?>
          
        </div>
     </div>
     </div>   
        

         <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
            <label for="food_id">FOOD ID:</label>
           <input type="text"  class="form-control" name="food_id" id="food_id">
          </div>
          </div>
         </div>
        
        

        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
            <label for="food_name">FOOD NAME:</label>
           <input type="text"  class="form-control" name="food_name" id="food_name">
          </div>
          </div>
         </div>
        
        <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label for="session">SESSION:</label>
              <select class='form-control' name='session' id='session'>
                <option value='FN'>Forenoon</option>
                <option value='AF'>Afternoon</option>
                <option value='EV'>Evening</option>
              </select>
        </div>
     </div>
     </div>

        <div class="row">
          <div class="col-sm-5">
            <div class="form-group">
            <label for="food_price">FOOD PRICE:</label>
           <input type="text"  class="form-control" name="food_price" id="food_price">
          </div>
          </div>
         </div>

    <div class="row">
      <div class="col-sm-5">
        <div class="form-group">
        <label for="food_quantity">FOOD QUANTITY:</label>
       <input type="text"  class="form-control" name="food_quantity" id="food_quantity">
      </div>
      </div>
     </div>
  
       
       
       <div class="row">
        <div class="col-sm-5">
            <div class="form-group form-inline">
                <label for="photo_upload">Upload Photo Here</label>
                <input type="file" name="photo_upload">
            </div>
       </div>
    </div>
       
       
        <?php
              if(isset($_POST['add_food']))
              { 
              add_food($_POST['canteen_id'],$_POST['food_id'],$_POST['food_name'],$_POST['session'],$_POST['food_price'],$_POST['food_quantity']); 
              }
          ?>
          
          <br>
      <div class="row">
        <div class="col-sm-5">
          <button type="submit" name="add_food" class="btn btn-success">ADD FOOD</button>
       </div>
    </div>
    
    </form>
    </div>
    </div>


<!--5,6-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <div class="well well-lg">
      
        <form action="" target="_blank" method="post">
          
          
          <h4 class="hbold1" >VIEW FOOD DETAILS :</h4>
          <br>
          <br>
          <div class="row">
            <div class="col-sm-5">
             <div class="form-group">
               <label>CANTEEN:</label>
 
             <?php 
          $query="SELECT * FROM canteen";
          $result=mysqli_query($connect,$query);
          echo "<select class='form-control' name='cantee1'>";                   
          while($row = mysqli_fetch_assoc($result))
            {
              echo "<option value='" .$row['canteen_id']. "'>" .$row['canteen_name']. "</option>"; 
            }
          echo "</select>";
          ?>
          
        </div>
     </div>
     </div>
     
     <br>

     <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label for="session">SESSION:</label>
              <select class='form-control' name='session' id='session'>
                <option value='FN'>Forenoon</option>
                <option value='AF'>Afternoon</option>
                <option value='EV'>Evening</option>
              </select>
        </div>
     </div>
     </div>

      <div class="row">
          <div class="col-sm-4">
            <button type="submit" name="filter4" class="btn btn-primary">FILTER</button>
          </div>
        </div><br>
    
       <div class="row">
        <div class="col-sm-5">
         <div class="form-group">
           <label>FOOD NAME:</label>

        <?php

          $query="SELECT * FROM food";

          if(isset($_POST['filter4']))
          {
            $cid=mysqli_real_escape_string($connect,$_POST['cantee1']);
            $ses=mysqli_real_escape_string($connect,$_POST['session']);
            $_SESSION['cid']=$cid;
            $_SESSION['ses']=$ses;
            $query="SELECT * FROM food where canteen_id= '$cid' AND session= '$ses'";
          }

          $result=mysqli_query($connect,$query);
           echo "<select class='form-control' name='food1'>";
	           while($row = mysqli_fetch_assoc($result))
                {
                    $id=$row['food_name'];
                    echo "<option value='" .$id. "'>" .$id. "</option>";    
                }
          echo "</select>";
       ?> 
        </div>
      </div>
      </div>
       <?php
              
              if(isset($_POST['view_details']))
              {
                  view_food_details($_SESSION['cid'],$_SESSION['ses'],$_POST['food1']);
              }
          
          ?>
          <br>
        <div class="row">
          <div class="col-sm-5">
            <button type="submit" name="view_details" class="btn btn-success">VIEW DETAILS</button>
         </div>
      </div>

        </form>
      </div>
     </div>

    

</div>
</div>
</body>
</html>
