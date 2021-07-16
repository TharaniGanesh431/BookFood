<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TECH CANTEEN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
    #preview{
        max-width:280px;
        width:280px;
        height:auto;
        top:0;
        left:10;
        margin-top:20px;
        margin-left:15px;
        border: 2px solid white;
        outline: rgba(66, 140, 224, 0.925) solid 10px;;
        z-index:1;
    }
    .jcolr{
    background-color: black;
    color:rgb(255, 255, 255); 
    }
    body{
        background-color:rgb(206, 206, 206);
    }
    .cd1{
        margin-left:5px;
        margin-right:5px;
        padding-right:0;    
    }
    .alert1{
        margin-top:50px;
    }
    .bg1{
        background-color: rgb(255, 255, 255);
        color: rgb(32, 30, 30);
    }
    .cd2
    {
        margin-left:20px;
        margin-right:20px;
    }
    .hcol{
        background-color: rgba(66, 140, 224, 0.925) ;  
        color:white;
    }
    </style>
</head>

<body >
      <div class="jumbotron jumbotron-fluid  jcolr" >
        <div class="container">
          <h1 class="text-center">ORDERS</h1>     
        </div>
      </div>
      
      <div class="card bg1-danger  cd1">
                <div class="card-body">
                   <div class="row">
                       <div class="col-sm-6">
                             <video id="preview"></video>
                       </div>

                       <div class="col-sm-4">
                              <div class="alert alert-primary alert1">
                                 <h3>Scan your QR code here!</h3> 
                             </div>
                       </div>

                    </div>

               </div>
     </div> 

    <br>

<div id="result"></div>

<!-- <video id="preview"></video> -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
    scanner.addListener('scan',function(content){
        $.post("orders.php", {id: content},function(option){
            $("#result").html(option);
        });
    });
    Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length>0){
            scanner.start(cameras[0]);
            $('[name="options"]').on('change',function(){
                if($(this).val()==1){
                    if(cameras[0]!=""){
                        scanner.start(cameras[0]);
                    }else{
                        alert('No Front camera found!');
                    }
                }else if($(this).val()==2){
                    if(cameras[1]!=""){
                        scanner.start(cameras[1]);
                    }else{
                        alert('No Back camera found!');
                    }
                }
            });
        }else{
            console.error('No cameras found.');
            alert('No cameras found.');
        }
    }).catch(function(e){
        console.error(e);
        alert(e);
    });
</script>
