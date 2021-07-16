<?php

    include "serverconnect.php";

    if(isset($_POST['SOLD']))
    {
        echo "ENtered";
        $orderid=mysqli_real_escape_string($connect,$_POST['id']);
        $order=mysqli_query($connect, "select * from transacted where order_id='$orderid'");
        echo $orderid;
        if(! $order ) {
            die('Could not access server-TRANSACT Table');
        }

        if(! $ordertrack = mysqli_fetch_assoc($order) ) {
            die('2Could not access server-TRANSACT Table');
        }

        if(! mysqli_query($connect, "DELETE from transacted where order_id='$orderid'"))
             die('Could not able to delete order... server-TRANSACT Table');

        $id=$orderid[21].$orderid[20].$orderid[8].$orderid[3].$orderid[2].$orderid[1];
        $studenttable=mysqli_query($connect, "select orders from student where stud_id='$id'");

        if(! $studenttable )
            die('Not able to access server-STUDENT Table');
        if(! $student = mysqli_fetch_assoc($studenttable) )
            die('2Not able to access server-STUDENT Table');

        $countoforders=$student['orders']-1;
        if(! mysqli_query($connect, "UPDATE student SET orders=$countoforders WHERE stud_id='$id'"))
            die('Not able to update server-STUDENT Table');
        
        $_SESSION['page']='notstatic';
        session_unset();
        session_destroy();
    
        header("Location:ordersell.php");
    }

