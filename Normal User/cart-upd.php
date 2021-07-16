<?php
    include "serverconnect.php";
    include "session.php";
    
    include "orderconnect.php";
    include "cartheader.php";
?>

  <form action="cart.php" method="POST">     
  <table class="table table-striped table-responsive table-hover table-condensed">
    <thead>
      <tr>
        <th>CHECK BOX</th>
        <th>ITEM ID</th>
        <th>FOOD NAME</th>
        <th>PRICE</th>
        <th>QUANTITY</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $i=1;
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
                    <input type="hidden" name="item<?php echo $i; ?>" value="0" />
                    <td><input name="item<?php echo $i; ?>" type="checkbox" value="1" checked></td>
                    <td><?php echo $row['food_id'];?></td>
                    <td><?php echo $row['food_name'];?></td>
                    <td><?php echo $row['food_price'];?></td>
                    <input name="food_price<?php echo $i; ?>" type="hidden" value="<?php echo $row['food_price'];?>">
                    <div>
                      <td><input name= 'updqn<?php echo $i; ?>' type="number" value="<?php echo $record['Quantity'.$i]?>" min="1" max="3"></td>
                    </div>
                  </tr>
        <?php
                  }
                  ++$i;
              }
        ?>
    </tbody>
  </table>
</div>
<div class="container-fluid">
    <div class="jumbotron">
        <div class="text-center">
        <input class="btn mt-3 btn-success" type="submit" value="CHANGE" name='change'>
        </div>
    </div>
  </div>
  </form>

</body>
</html>
