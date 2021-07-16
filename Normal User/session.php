<?php
    date_default_timezone_set('Asia/Kolkata');

    $h=16;$m=0;$s=0;

    // $h=date("H");
    // $m=date("i");
    // $s=date("s");
    // echo "$h:$m:$s";

    if (($h>18) or ($h==18 and $m>=30) or ($h<8) or ($h==8 and $m<=30))
        exit("CANTEEN CLOSED!!!");

    if (($h>13) or ($h==13 and $m>=40))
        $ss='EV';
    elseif (($h>10) or ($h==10 and $m>=30))
        $ss='AF';
    elseif (($h>8) or ($h==8 and $m>=30))
        $ss='FN';    

?>