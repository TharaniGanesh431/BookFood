<?php 
    include "orderpending.php";
?>

<body>
<div class="jumbotron jumbotron-fluid pt-0 pb-0 mb-0 bg-dark text-white">
    <h1 class="display-3 text-center">CANTEEN</h1>
        <hr class="my-1">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container-fluid">
                <form method="POST" >
                    <input class="btn mt-3 btn-danger my-3" type="submit" value="LOG OUT" name='out'>
                </form>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <br>
                            <h5><?php echo "User: ".id2name();?></h5>
                            <h5 ><?php echo "Current Balance: ₹".id2bal(); ?></h5></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
        <br>
        <form method="GET">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-4 ">
                    <div class="card mb-5 shadow border">
                        <img src="/food_img/tea.jpg" alt="" class="card-img-bottom">
                        <div class="card-body  ">
                            <h5 class="card-title">F-block</h5>
                            <h6 class="card-subtitle text-muted mb-2">Our primary canteen!!</h6>
                            <center>
                                <button name="submit1" type="submit" class="btn btn-block mt-3 btn-success"><i
                                        class="fa fa-cutlery"></i>__EATNOW__<i class="fa fa-cutlery"></i></button>
                            </center>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="col-md-4 ">
                    <div class="card mb-5 shadow border">
                        <img src="/food_img/tea.jpg" alt="" class="card-img-bottom ">
                        <div class="card-body ">
                            <h5 class="card-title">J-block</h5>
                            <h6 class="card-subtitle text-muted mb-2">Hot Chocalate!</h6>
                            <center>
                                <button name="submit2" type="submit" class="btn btn-block mt-3 btn-success"><i
                                        class="fa fa-cutlery"></i>__EATNOW__<i class="fa fa-cutlery"></i></button>
                            </center>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="col-md-4 ">
                    <div class="card mb-5 shadow border">
                        <img src="/food_img/tea.jpg" alt="" class="card-img-bottom">
                        <div class="card-body ">
                            <h5 class="card-title">A-block</h5>
                            <h6 class="card-subtitle text-muted mb-2">Exclusive for i-tech !!</h6>
                            <center>
                                <button name="submit3" type="submit" class="btn btn-block mt-3 btn-success"><i
                                        class="fa fa-cutlery"></i>__EATNOW__<i class="fa fa-cutlery"></i></button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <hr>
        <h5 class="text-primary text-center"><b>PENDING ORDERS</b></h1>
        <hr>

        <div class="container">
            <div class="row pt-3">
                <div class="col-md-4 ">
                    <div class="card mb-5 shadow">
                        <div class="card-body  ">
                            <h5 class="card-title">ORDER 1</h5>
                            <h6 class="card-subtitle text-muted mb-2">Most recent order</h6>
                            <center>
                                <button name="order1" class="p-2 btn btn-block btn-info">OPEN</button>
                            </center>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-4 ">
                    <div class="card mb-5 shadow">
                        <div class="card-body  ">
                            <h5 class="card-title">ORDER 2</h5>
                            <h6 class="card-subtitle text-muted mb-2">Second recent order</h6>
                            <center>
                                <button name="order2" class="p-2 btn btn-block btn-info">OPEN</button>
                            </center>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-4 ">
                    <div class="card mb-5 shadow">
                        <div class="card-body  ">
                            <h5 class="card-title">ORDER 3</h5>
                            <h6 class="card-subtitle text-muted mb-2">Third recent order</h6>
                            <center>
                                <button name="order3" class="p-2 btn btn-block btn-info">OPEN</button>
                            </center>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </form>
</body>

</html>