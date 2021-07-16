    <?php
        include "serverconnect.php";
        include "php_functions.php";
        include "session.php";
        include "logout.php";
        include "studentfunction.php";
        include "qrfunc.php";
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>TECH CANTEEN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>

    <?php
    if((isset($_GET['submit1'])) or (isset($_GET['submit2'])) or (isset($_GET['submit3']))){
        
        if( $rows['orders']>=3)
            echo "<script>window.alert('You have 3 pending Orders!... You cannot order more!');</script>";
        elseif(isset($_GET['submit1']))
            canteen_login('C1');
        elseif(isset($_GET['submit2']))
            canteen_login('C2');
        elseif(isset($_GET['submit3']))
            canteen_login('C3');
    }

    if((isset($_GET['order1'])) or (isset($_GET['order2'])) or (isset($_GET['order3']))){

        if(! $transact=mysqli_query($connect, "select * from transacted where stud_id='$id'"))
            die('Could not access server-TRANSACTED Table');

        $n= mysqli_affected_rows($connect);

        if((isset($_GET['order1']) and $n<1) or (isset($_GET['order2']) and $n<2) or (isset($_GET['order3']) and $n<3)){
            echo "<script>window.alert('No Order History');</script>";
        }

        if(isset($_GET['order1']) and $n>0){
            //echo "Order1";
            mysqli_data_seek($transact,0);
            include "orderpend1.php";
        }
        elseif(isset($_GET['order2']) and $n>1){
            //echo "Order2";
            mysqli_data_seek($transact,1);
            include "orderpend1.php";
        }
        elseif(isset($_GET['order3']) and $n>2){
            //echo "Order3";
            mysqli_data_seek($transact,2);
            include "orderpend1.php";
        }
    }
    ?>

    <div class="modal fade" tabindex="-1" id="receipt" role="dialog"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="model-header">
                    <h2 class="modal-title text-center" id="title">BILL</h2>
                </div>
                <div class="modal-body">
                    <b>NAME: </b> <?php echo id2name()."    "; ?>
                    <br>
                    <b>ROLL:</b> <?php echo $id; ?>
                    <br>
                    <b>BILL AMOUNT:</b><?php echo " ".$trans['order_total_price']; ?>
                    <hr>
                    <h5 class="text-center">(SHOW THE QR CODE AT THE COUNTER)</h1>
                    <center><img src="<?php echo '/qrcode/'.$qrname; ?>" alt=""></center>

                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>FOOD NAME</th>
                            <th>QUANTITY</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                for ($k = 1; $k <= 5; ++$k){
                                    $food_col='food'.$k;
                                    $quantity_col='Quantity'.$k;
                                    if ($trans[$food_col]!=NULL){
                                        $foodid= mysqli_real_escape_string($connect,$trans[$food_col]);
                                        $food=mysqli_query($connect, "select * from food where food_id='$foodid'");
                                        if(!$food )
                                            die('Could not access server-Food Table');
                                        $row = mysqli_fetch_assoc($food);
                            ?>
                            <tr>
                                <td><?php echo $row['food_name']; ?></td>
                                <td><?php echo $trans[$quantity_col];?></td>
                            </tr>
                        <?php         }
                                }
                            ?>
                        </tbody>
                    </table>
                            
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>     
                </div>
            </div>
        </div>
    </div>