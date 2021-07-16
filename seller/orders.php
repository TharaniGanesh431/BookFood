<?php include "serverconnect.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- <title>SELLER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
  <style>
/* #preview{
   max-width:280px;
   width:280px;
   height:auto;
   top:0;
   left:10;
   margin-top:20px;
   margin-left:15px;
  border: 2px solid white;
  outline: rgba(66, 140, 224, 0.925) solid 10px;;

} */
.jcolr{
    background-color: black;
    color:rgb(255, 255, 255);
    
}
body{
    background-color:rgb(206, 206, 206);
}
.cd1{
   margin-left:5px;
   margin-right:5px;
   padding-right:0;
  
}
.alert1{
    margin-top:50px;

}
.bg1{
    background-color: rgb(255, 255, 255);
    color: rgb(32, 30, 30);
}
.cd2
{
    margin-left:20px;
    margin-right:20px;
}
.hcol{
    background-color: rgba(66, 140, 224, 0.925) ;  
    color:white;
}
 </style>
</head>

<?php
    
    echo isset($_SESSION['page']);
    if(isset($_SESSION['page']))
        echo $_SESSION['page'];
    if(isset($_POST['id']) and ((!isset($_SESSION['page'])) or ($_SESSION['page']!='static')))
    {
        $orderid=mysqli_real_escape_string($connect,$_POST['id']);
        $order=mysqli_query($connect, "select * from transacted where order_id='$orderid'");
        
        if(! $order ) {
            echo "<div class='container'> <div class='alert alert-warning text-center' role='alert'>No Match Found!</div> </div>";
        }

        if(! $ordertrack = mysqli_fetch_assoc($order) ) {
            die('2Could not access server-TRANSACT Table');
        }
        
        $_SESSION['page']='static';
        ?>

        <!-- <body>
            <div class="jumbotron jumbotron-fluid  jcolr" >
                <div class="container">
                    <h1 class="text-center">ORDERS</h1>     
                </div>
            </div> -->

            <br><br><br>
            <!-- <form action="" method="POST"> -->
            <div class="card bg1-danger cd2">
             <div class="card-body">
                <div class="alert alert-success">
                   <h3 class="text-center">Displaying Ordered Items!</h3> 
                </div>

                  <br>

                <table class="table table-bordered">
                <thead>
                <tr>
                  <th class="hcol">Item ID</th>
                  <th class="hcol">Food Name</th>
                  <th  class="hcol">Quantity</th>
               </tr>
               </thead>
               <tbody>

                    <?php for ($k = 1; $k <= 5; ++$k){
                        $food_col='food'.$k;
                        $quantity='Quantity'.$k;

                        if($ordertrack[$food_col]!=NULL){
                            
                            $f=mysqli_real_escape_string($connect,$ordertrack[$food_col]);
                            $q=mysqli_real_escape_string($connect,$ordertrack[$quantity]);

                            if(! $order1=mysqli_query($connect, "select * from food where food_id='$f'")) 
                                die('Could not access server-FOOD Table');

                            if(! $record = mysqli_fetch_assoc($order1))
                                die('2Could not access server-FOOD Table');
                    ?>
                            <tr>
                            <td><?php echo $record['food_id'];?></td>
                            <td><?php echo $record['food_name'];?></td>
                            <td><?php echo $ordertrack[$quantity];?></td>

    <?php   }
        }
        echo"         </tbody>
                    </thead>
                </table>
            </div>
            <br><br>
            <div class='container'>
                <div class='jumbotron'>
                    <form action='delete.php' method='POST'>
                        <div class='text-center'>
                            <input type='hidden' value='$orderid' name='id'>
                            <input class='btn mt-3 btn-danger' type='submit' value='SOLD' name='SOLD'>
                        </div>
                    </form>
                </div>
            </div>";
    }
?>
                   