<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Cancel order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
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
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="container text-center jumbotron">
        <h1 class="display-4">Your Orders</h1>
    </div>

    <div class="container text-center col-lg-6 col-xl-6">
    <?php
        $user = $_COOKIE["user"];
        include "connect.php";
        checkorder();
        function checkorder(){
            global $conn, $user;
            $sql = "SELECT * FROM orders WHERE username='$user'";
            $result1 = $conn->query($sql);
            if($result1->num_rows > 0){
                displayorder($result1);
            }else{
                echo "<p class=lead text-center'>You have not ordered anything</p>";
            }
        }
        function displayorder($result1){
            $total = 0;
            echo "<table class='table table-bordered table-striped table-hover'><thead class='thead-dark'>
                <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Remove</th>
                </thead>
            ";
            while($row = $result1->fetch_assoc()){
                $total = $total + ($row['pr_price'] * $row["pr_quantity"]);
                echo "<tr>
                <td>".$row['pr_name']."</td>
                <td>".$row['pr_price']."</td>
                <td>".$row['pr_quantity']."</td>
                    <td><a class='btn btn-outline-dark' href='cancelorder.php?del=".$row['pr_name']."'>Delete</a></td>
                ";
            }
            echo "<tr>
                <td>Total</td><td>".$total."</td>
            </tr></table>
                <div class='container d-flex justify-content-center'>
                    <form method='POST' action='cancelorder.php'>
                    <input type='submit' value='Cancel Orders' name='cancel' class='form-control'>
                    </form>
                </div>
            ";
        }
        if(isset($_POST["cancel"])){
            cancel();
        }
        function cancel(){
            global $conn, $user;
            $sql = "SELECT * FROM orders WHERE username='$user'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $sql = "DELETE FROM orders WHERE username='$user'";
                $conn->query($sql);
            }
            header("Location: /cancelorder.php");
        }
        if(isset($_GET["del"])){
            $item = $_GET["del"];
            deleteitem($item);
        }
        function deleteitem($item){
            global $user, $conn;
            $sql = "SELECT pr_quantity FROM orders WHERE username='$user' AND pr_name='$item'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if($row["pr_quantity"] > 1){
                $nqu = $row["pr_quantity"] - 1;
                $sql = "UPDATE orders SET pr_quantity='$nqu' WHERE pr_name='$item' AND username='$user'";
                $conn->query($sql);
            }else{
                $sql = "DELETE FROM orders WHERE pr_name='$item' AND username='$user'";
                $conn->query($sql);
            }
            header("Location: cancelorder.php");
        }
    ?>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>