<?php
    include "serverconnect.php";
    include "session.php";
    include "logout.php";

    include "cartfunction.php";
    include "qrfunc.php";
    include "orderconnect.php";

    include "cartheader.php";
    include "confirmorder.php";
?>

  <form action="" method="POST">
    <table class="table table-striped table-hover table-responsive">
    <thead>
      <tr>
        <th>ITEM ID</th>
        <th>FOOD NAME</th>
        <th>PRICE</th>
        <th>QUANTITY</th>
        <th>TOTAL PRICE</th>
      </tr>
    </thead>
    <tbody>
        <?php
            while($i<=5){
                $food_col='food'.$i;
        
                if ($record[$food_col]!=NULL){
                    $foodid= mysqli_real_escape_string($connect,$record[$food_col]);
                    $food=mysqli_query($connect, "select * from food where food_status=1 AND food_id='$foodid' AND session='$ss'");
                    if(!$food )
                        die('Could not access server-Food Table');
                    $row = mysqli_fetch_assoc($food);
        ?>
                  <tr>
                    <td><?php echo $row['food_id'];?></td>
                    <td><?php echo $row['food_name'];?></td>
                    <td><?php echo $row['food_price'];?></td>
                    <td><?php echo $record['Quantity'.$i];?></td>
                    <td><?php echo $record['Quantity'.$i]*$row['food_price'];?></td>
                  </tr>
        <?php
                }
                ++$i;
              }
        ?>
    </tbody>
  </table>
</div>
<div class="text-right" style="width:350px">
    <h3 class="pull-right text-danger"><b><?php echo $record['order_total_price']; ?></b></h3>
    <h3 class="pull-right">GRAND TOTAL : &nbsp</h3>
    <div class="clearfix"></div>
    </div>
        <br><br>
<div class="container-fluid">
    <div class="jumbotron ">
        <div class="text-center m-2">
          <a href="cart-upd.php" class=" btn mt-3 btn-danger">UPDATE</a>
          <input class="btn btn-success mt-3 mx-4 px-4 rounded" type="submit" name="confirm_order" value='CONFIRM ORDER' id='confirm'>
        </div>
    </div>
  </div>

  <?php
      include "studentfunction.php";
      // include "qrfunc.php";
  ?>
  <div class="modal fade" tabindex="-1" id="receipt" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="model-header">
                    <h2 class="modal-title text-center" id="title">BILL</h2>
                </div>
                <div class="modal-body">
                    <!--actual contents of the bill-->
                    <hr>
                    <h5 class="text-success text-center"><b>ORDER SUCCESSFULL!</b></h1>
                    <hr>
                    <div class="pull-left">
                      <b>NAME: </b> <?php echo id2name()."    "; ?>
                    </div>
                    <div class="pull-right" m-3><b>DATE:</b><?php echo " ".date("d/m/Y") ?></div>
                    <div class="clearfix"></div>
                    <div class="pull-left">
                      <b>ROLL:</b> <?php echo $id; ?>
                    </div>
                    <div class="pull-right" m-3><b>TIME:</b><?php echo " ".date("h:i:s a") ?></div>
                    <div class="clearfix"></div>
                    <b>BILL AMOUNT:</b><?php echo " ".$record['order_total_price']; ?>
                    <br>
                    <b>REMAINING BALANCE:</b><?php echo " ".id2bal(); ?>
                    <br>
                    <hr>
                    <h5 class="text-center">(SHOW THE QR CODE AT THE COUNTER)</h1>

                    <center><img src="<?php echo '/qrcode/'.$qrname2;?>" alt=""></center>  
                </div> 
                <div class="modal-footer">
                    <input class="btn mt-3 btn-danger" type="submit" value="LOG OUT" name='out'>     
                </div>
            </div>
        </div>
    </div>
  </form>
</body>
</html>