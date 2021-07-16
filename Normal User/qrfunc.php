<?php  

include 'phpqrcode/qrlib.php';

function randomgen()
{
    $characters = '!~`#$@%^&*()-_++{}[];,<.>/0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    return $characters[rand(0, strlen($characters) - 1)];
}


function getName() {

    $id=$_COOKIE['login_id'];
    $randomString = '';

    $randomString .= randomgen();
    $randomString .= $id[5];
    $randomString .= $id[4];
    $randomString .= $id[3]; 
    $randomString .= date("s");
    $randomString .= date("m");
    $randomString .= $id[2];
    $randomString .= randomgen();
    $randomString .= date("H");
    $Year=date("Y");
    while ($Year > 0)
    {
        $randomString .= $Year%10;
        $randomString .= randomgen();
        $Year=(int)($Year/10);
    }
    $randomString .= $id[1];
    $randomString .= $id[0];
    $randomString .= date("i");
    $randomString .= date("d");

    //echo $randomString;
    
    // QRcode::png($randomString,$path,'Q',10,3);
    // sleep(1);

    return $randomString; 
} 

function qrgenerator($name)
{
    $filename="qr".mt_rand(1,999).".png";
    QRcode::png($name,"C:/xampp/htdocs/qrcode/".$filename ,'Q',10,3);
    // sleep(1);
    return $filename;
}

?> 