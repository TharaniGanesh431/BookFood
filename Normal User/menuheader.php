<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>TECH CANTEEN</title>

    <!-- <script src="jquery-3.4.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/01b07809e9.js" crossorigin="anonymous"></script>
    <style>
        img {
            width: 350px;
            height: 250px;
        }
        #nav {
            background-color: #FF5A70;

        }
        .navbar-custom {
            background-color: #FF5A70;
        }
        .sticky {
            position: sticky;
            top: 0;
            width: 100%;
            z-index:1;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {

        if (window.history && window.history.pushState) {

            $(window).on('popstate', function() {
            window.location='canteen.php';
            return false;
            });

            window.history.pushState('forward', null);
        }

        });
    </script>
</head>

<body>

    <div class="sticky bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" >
            <a href="#" class="navbar-brand "><?php echo $_COOKIE['canteen_name']; ?></a>
            <form method="POST" >
                <right><input class="btn mt-3 btn-danger" type="submit" value="LOG OUT" name='out'></right>
            </form>
        </nav>
    <br>
        <div class="container p-2">
            <input class="form-control" type="text" name="search" onkeyup="foodsearch()" placeholder="Type your food name ..." >
        </div>
    </div>
    <script type="text/javascript">
        function foodsearch(){
        var value = $("input[name='search']").val();
        var pg=<?php echo json_encode($_SESSION['menupg']); ?>;
        $.post("searchres.php", {search: value,pgloadno: pg},function(option){
            $("#options").html(option);//
        });
        }
    </script>


    <div id ="comment_result"class="container display-4 text-center text-secondary pb-3">
    </div>