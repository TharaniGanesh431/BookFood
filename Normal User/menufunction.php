<?php

    $cid=$_COOKIE['canteen_id'];
    $food=mysqli_query($connect, "select * from food where food_status=1 AND canteen_id='$cid' AND session='$ss'");
 
    if(! $food ) {
       die('Could not access server-Food Table');
    }
    if (isset($_POST['order']) and $_POST['quantity']!=0 and $_SESSION['menupg']==$_POST['menupg']){

        $_SESSION['menupg']=0;
        $_SESSION['ordered']='no';
        
        $id= mysqli_real_escape_string($connect,$_COOKIE['login_id']);
        $food_id= mysqli_real_escape_string($connect,$_POST['food_id']);
        $quantity= mysqli_real_escape_string($connect,$_POST['quantity']);

        if ($quantity == 0 or $quantity>3)
            die("Multiple Selection");
        $i=1;

        $order=mysqli_query($connect, "select * from orders where stud_id='$id'");
        if(! $order ) {
          die('Could not access server' );
        }

        $row = mysqli_fetch_assoc($order);

        while($i<=5){
          $food_col='food'.$i;
          $quantity_col='Quantity'.$i;
          
          if ($row[$food_col]==$food_id){
            $quantity+=$row[$quantity_col];
            break;
          }

          if ($row[$food_col]==NULL){
            setcookie('items', $i, 0, "/","", 0);
            break;
          }

          ++$i;

          if ($i>5){
            die("Bulk Order is not allowed!!!\nNumber of items at a time is limited to 5 !!!");
          }
        }
        
        $tot_price= $row['order_total_price'] + ($_POST['quantity']*$_POST['food_price']);

        if(! mysqli_query($connect, "UPDATE orders SET $food_col='$food_id',$quantity_col=$quantity,order_total_price=$tot_price WHERE stud_id='$id'"))
            die('Could not Update Order Table');
    }
    else
        $_SESSION['menupg']=mt_rand(1,999);

?>