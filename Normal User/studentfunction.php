<?php

    global $connect;
    $id=$_COOKIE['login_id'];
    $student=mysqli_query($connect, "select * from student where stud_id='$id'");

    if(! $student )
        die('Could not access server-STUDENT Table');

    if(! $rows = mysqli_fetch_assoc($student))
        die('2Could not access server-STUDENT Table');

    function id2name(){
        global $rows;
        return $rows['stud_name']; 
    }

    function id2bal(){
        global $rows;
        return $rows['balance_amt'];
    }
?>
