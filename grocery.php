<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Grocery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include "connect.php";
        if(!isset($_COOKIE["user"])){
        echo "<div class='container jumbotron text-center mt-2'>
        <p class='lead'>Please login back in again to continue browsing grocery!</p>
        </div>";
        exit();
        }
    ?>

    <div class="navbar-section home">
        <navbar class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand">OGS</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#toggle"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="toggle">
                    <div class="navbar-menu ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cart.php">Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="fast">
        <h1 class="display-4">Fast Food's</h1>
        <div class="d-flex flex-wrap">
            <?php
                dispfastfoods();
                function dispfastfoods(){
                    global $conn;
                    $sql = "SELECT * FROM fast_foods";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2' id='".$row['pr_name']."'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#fast' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="baked">
        <h1 class="display-4">Baked Food's</h1>
        <div class="d-flex flex-wrap">
            <?php
                dispbakedfoods();
                function dispbakedfoods(){
                    global $conn;
                    $sql = "SELECT * FROM baked_foods";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2' id='".$row['pr_name']."'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#baked' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="dairy">
        <h1 class="display-4">Dairy Product's</h1>
        <div class="d-flex flex-wrap">
            <?php
                dispdairy();
                function dispdairy(){
                    global $conn;
                    $sql = "SELECT * FROM dairy";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2' id='".$row['pr_name']."'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#dairy' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="fresh">
        <h1 class="display-4">Fresh Produce</h1>
        <div class="d-flex flex-wrap">
            <?php
                dispproduce();
                function dispproduce(){
                    global $conn;
                    $sql = "SELECT * FROM fresh_produce";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2' id='".$row['pr_name']."'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#fresh' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="frozen">
        <h1 class="display-4">Frozen Food's</h1>
        <div class="d-flex flex-wrap">
            <?php
                dispfrozen();
                function dispfrozen(){
                    global $conn;
                    $sql = "SELECT * FROM frozen_foods";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2' id='".$row['pr_name']."'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#frozen' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="house">
        <h1 class="display-4">Household Product's</h1>
        <div class="d-flex flex-wrap">
            <?php
                disphousehold();
                function disphousehold(){
                    global $conn;
                    $sql = "SELECT * FROM household";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2' id='".$row['pr_name']."'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#house' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="meat">
        <h1 class="display-4">Meat</h1>
        <div class="d-flex flex-wrap">
            <?php
                dispmeat();
                function dispmeat(){
                    global $conn;
                    $sql = "SELECT * FROM meat";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2' id='".$row['pr_name']."'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#meat' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <div class="container text-center my-4 col-lg-10 col-xl-10" id="staples">
        <h1 class="display-4">Staples</h1>
        <div class="d-flex flex-wrap">
            <?php
                dispstaples();
                function dispstaples(){
                    global $conn;
                    $sql = "SELECT * FROM staples";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "
                            <div class='card col-lg-2 col-xl-2 mr-2 mb-2'>
                            <img class='card-img-top' src='/img/".$row['pr_name'].".jpg' height='150' width='150'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['pr_name']."</h5>
                                    <p class='cart-text'>Quantity ".$row['pr_quantity']." Price ".$row['pr_price']."</p>
                                    <a href='grocery.php?pr_name=".$row['pr_name']."&pr_quantity=".$row["pr_quantity"]."&pr_price=".$row['pr_price']."&/#staples' class='btn btn-outline-primary'>Buy</a>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <?php
        $user = $_COOKIE["user"];
        if(isset($_GET["pr_name"])){
            $pr_name = $_GET["pr_name"];
            $pr_price = $_GET["pr_price"];
            $pr_quantity = $_GET["pr_quantity"];
            cart();
        }
        function cart(){
            global $conn,$pr_name,$user,$pr_quantity,$pr_price;
            $sql = "INSERT INTO cart VALUES('$user','$pr_name','$pr_quantity',$pr_price)";
            $conn->query($sql);
        }
    ?>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>