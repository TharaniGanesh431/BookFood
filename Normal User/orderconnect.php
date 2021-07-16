<?php

    $id=$_COOKIE['login_id'];
    $order=mysqli_query($connect, "select * from orders where stud_id='$id'");
 
    if(! $order ) {
       die('Could not access server-ORDER Table');
    }

    if(! $record = mysqli_fetch_assoc($order) ) {
       die('2Could not access server-ORDER Table');
    }
?>