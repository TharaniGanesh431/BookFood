<?php
    if(! $trans = mysqli_fetch_assoc($transact))
            die('2Could not access server-TRANSACTED Table');
    
    $qrname=qrgenerator($trans['order_id']);
    echo "<script>
            $(document).ready(function(){
                $('#receipt').modal();
            });
            </script>";
    //header("Location: canteen.php");
?>