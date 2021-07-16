<!DOCTYPE html>
<html lang="en">
<head>
  <title>TECH CANTEEN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    jQuery(document).ready(function($) {

      if (window.history && window.history.pushState) {

        $(window).on('popstate', function() {
          window.location='menu.php';
          return false;
        });

        window.history.pushState('forward', null);
      }

    });
  </script>
</head>
<body>
  <div class="jumbotron" style=" background-color: black; color: white;">
    <div >
      <h1 class="text-center ">FOOD CART<span class="glyphicon glyphicon-shopping-cart"></span></h1>
    </div>
  </div>
<div class="container-fluid">
  <h3 class="text-center" >YOUR CART<span class="glyphicon glyphicon-shopping-cart"></span></h3>