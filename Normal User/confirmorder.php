<?php

    global $connect;
    $student=mysqli_query($connect, "select * from student where stud_id='$id'");

    if(! $student )
        die('Could not access server-STUDENT Table');

    if(! $rows = mysqli_fetch_assoc($student))
        die('2Could not access server-STUDENT Table');


    if ((isset($_POST['confirm_order'])) and ($rows['balance_amt']>=$record['order_total_price'])){
        
        if (isset($_SESSION['ordered']) and $_SESSION['ordered']!='yes'){
            $_SESSION['ordered']='yes';
            
            if($rows['orders']<=3){
                if($record['order_total_price']!=0){

                    $tot_price=$record['order_total_price'];
                    $uid=mysqli_real_escape_string($connect,getName());

                    if(! mysqli_query($connect, "INSERT INTO transacted (order_id,stud_id,order_total_price) VALUES ('$uid','$id',$tot_price)"))
                        die('Ordering Failed - Server Error');

                    for ($k = 1; $k <= 5; ++$k){
                        $food_col='food'.$k;
                        $quantity='Quantity'.$k;

                        if($record[$food_col]!=NULL){
                            
                            $f=mysqli_real_escape_string($connect,$record[$food_col]);
                            $q=mysqli_real_escape_string($connect,$record[$quantity]);

                            if(! mysqli_query($connect, "UPDATE transacted SET $food_col='$f',$quantity=$q WHERE order_id='$uid'")){
                                if(! mysqli_query($connect, "DELETE FROM transacted WHERE order_id='$uid'"))
                                    die('2Unable to history of your order - Server Error');
                                die('Unable to update transacted Table');
                            }

                            $food=mysqli_query($connect, "select * from food where food_id='$f' AND food_status=1 AND session='$ss'");
    
                            if(! $food){
                                if(! mysqli_query($connect, "DELETE FROM transacted WHERE order_id='$uid'"))
                                    die('2Unable to history of your order - Server Error');
                                die('Could not access server-Food Table');
                            }
                            if(! $rq = mysqli_fetch_assoc($food))
                                die('2Could not access server-STUDENT Table');
                            
                            $quanavail=$rq['food_qty']-$q;

                            if(! mysqli_query($connect, "UPDATE food SET food_qty=$quanavail WHERE food_id='$f'")){
                                if(! mysqli_query($connect, "DELETE FROM transacted WHERE order_id='$uid'"))
                                    die('2Unable to history of your order - Server Error');
                                die('Could not access server-Food Table');
                            }
                        }
                    }
                
                    $tot_price=$rows['balance_amt']-$record['order_total_price'];
                    $count=$rows['orders']+1;
                    if(! mysqli_query($connect, "UPDATE student SET balance_amt=$tot_price,orders=$count WHERE stud_id='$id'")){
                        if(! mysqli_query($connect, "DELETE FROM transacted WHERE order_id='$uid'"))
                            die('2Unable to history of your order - Server Error');
                        die('Ordering Failed - Server Error');
                    }

                    $qrname2=qrgenerator($uid);

                    if(! mysqli_query($connect, "DELETE FROM orders WHERE orders.stud_id = '$id'"))
                        die('Unable to history of your order - Server Error');
                }
                else
                    die("You have 3 pending Orders!... You can't order more!");
            }
            else
                die("No zero price Order!!!");
        }

        echo "<script>
                $(document).ready(function(){
                    $('#receipt').modal('show');
                });
            </script>";
    }
?>