<?php

  include "orderconnect.php";
  $i=1;

  if(isset($_POST['change'])){
    
    $n=$_COOKIE['items'];
    for ($k = 1; $k <= 5; ++$k){

      include "orderconnect.php";

      $food_col='food'.$k;
      $quantity='Quantity'.$k;

      if($record[$food_col]==NULL){
          continue;
      }

      if($_POST['item'.$k]=="0"){
        $tot_price= $record['order_total_price'] - ($record[$quantity]*$_POST['food_price'.$k]);

        if(! mysqli_query($connect, "UPDATE orders SET $food_col=NULL,$quantity=NULL,order_total_price=$tot_price WHERE stud_id='$id'"))
            die('Unable to update Order Table');
        
        // --$_COOKIE['items'];
        // echo $_COOKIE['items'];
      }

      elseif($_POST['updqn'.$k]!=$record['Quantity'.$k]){

        $qn= mysqli_real_escape_string($connect,$_POST['updqn'.$k]);

        $old_tot_price=$record['order_total_price']-($record[$quantity]*$_POST['food_price'.$k]);
        $tot_price= $old_tot_price + ($qn*$_POST['food_price'.$k]);

        if(! mysqli_query($connect, "UPDATE orders SET $quantity=$qn,order_total_price=$tot_price WHERE stud_id='$id'"))
            die('Unable to update Order Table');
      }
    }
  }

?>