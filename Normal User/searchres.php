<?php
  include "serverconnect.php";
  include "session.php";
  if(isset($_POST['search'])){

    $cid=$_COOKIE['canteen_id'];
    $search = mysqli_real_escape_string($connect,$_POST['search']);
    $fsearch=mysqli_query($connect, "SELECT * FROM food WHERE food_status=1 AND canteen_id='$cid' AND session='$ss'AND food_name LIKE '$search%'");
    if(! $fsearch ) {
      die('Could not access server-FOOD Table');
    }
    $count = mysqli_num_rows($fsearch);
    if ($count == 0)
    echo "<div class='container'> <div class='alert alert-warning' role='alert'>No Match Found!</div> </div>";
    else {
    //    $_SESSION['menupg']=mt_rand(1,999);?>
      <div class="container">
        <div class="row pt-3">
            <?php
            while($record = mysqli_fetch_assoc($fsearch)){
            ?> 
                <div class="col-md-5 ">
                    <div class="card mb-5 ">

                        <img src="<?php echo $record['food_img']; ?>" alt="" class="card-img-bottom">
                        <div class="card-body border rounded ">
                            <center><h5 class="card-title"><?php echo $record['food_name'];?></h5></center>
                            <form action="" method="POST">
                                <div>
                                    <label for="Quantity">Quantity:</label>
                                </div>
                                <div>
                                    <div class="input-group-prepend">
                                        <span class="input-group">
                                            <i class="fa fa-cart-plus m-2 mt-3">:</i>
                                            <select name="quantity" class=" form-control">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <input name="menupg" type="hidden" value="<?php echo $_POST['pgloadno']; ?>">
                                    <input name="food_id" type="hidden" value="<?php echo $record['food_id']; ?>"/>
                                    <input name="food_price" type="hidden" value="<?php echo $record['food_price']; ?>"/>
                                </div>
                                <div>
                                    <label for="Price" >Price(per quantity):</label>
                                    <h5>₹ <?php echo $record['food_price'];?></h5>
                                </div>

                                <center>
                                    <input class="btn mt-3 btn-success" type="submit" value="ADD TO CART" name='order'>
                                    <a href="cart.php" class=" btn mt-3 btn-danger"> GO <i class="fa fa-shopping-cart"></i></a>
                                </center>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div><?php
    }
  }
?>