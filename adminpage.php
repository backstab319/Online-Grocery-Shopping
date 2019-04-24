<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
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
                                <a class="nav-link" href="/adminpagestore.php">Manage Store</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="container jumbotron text-center col-lg-6 col-xl-6">
        <h1 class="display-4">Online Grocery Shopping Cpanel</h1>
        <p class="lead text-justify text-center">Please use the tools given below to manage the grocery stores users orders</p>
    </div>

    <div class="container text-center col-lg-6 col-xl-6">
        <h1 class="display-4">View Order's</h1>
        <div class="form-group d-flex justify-content-center">
        <form action="adminpage.php" method="POST">
            <label for="sel">Select user:</label>
            <select name="sel" id="sel" class="form-control mb-2">
                <?php
                    showuser();
                    function showuser(){
                        global $user, $conn;
                        $sql = "SELECT DISTINCT username FROM orders";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                            echo "<option value=".$row['username'].">".$row['username']."</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" class="form-control mb-2 btn btn-outline-primary" name="view" value="View user's order">
        </form>
        </div>
    </div>
    
    <?php
        if(isset($_POST["view"])){
            vieworder();
        }
        function vieworder(){
            global $conn;
            if(isset($_POST["sel"])){
                $user = $_POST["sel"];
            }else{
                exit();
            }
            $sql = "SELECT * FROM orders WHERE username='$user'";
            $result = $conn->query($sql);
            displayorder($result,$user);
        }
        function displayorder($result,$user){
            global $conn;
            $total = 0;
            echo "<div class='container col-lg-6 col-xl-6'>
                <table class='table table-bordered table-striped table-hover'><thead class='thead-dark'>
                <tr>
                <th>Product</th>
                <th>Price</th>
                </thead>
            ";
            while($row = $result->fetch_assoc()){
                $total = $total + $row['pr_price'];
                echo "<tr>
                    <td>".$row['pr_name']."</td>
                    <td>".$row['pr_price']."</td>
                ";
            }
            $sql = "SELECT DISTINCT address FROM login_details WHERE user_id = '$user'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $address = $row["address"];
            echo "<tr>
                <td>Total</td><td>".$total."</td>
            </tr></table>
            <h5 class='display-5'>Customer address</h5>
                <p class='lead'>".$address."</p>
            </div>
            ";
        }
    ?>

    

    <div class="container text-center col-lg-6 col-xl-6">
        <h1 class="display-4">Delete completed orders</h1>
        <div class="form-group d-flex justify-content-center">
        <form action="adminpage.php" method="POST">
            <label for="del">Select user:</label>
            <select name="del-val" id="sel" class="form-control mb-2">
                <?php
                    showuserd();
                    function showuserd(){
                        global $user, $conn;
                        $sql = "SELECT DISTINCT username FROM orders";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                            echo "<option value=".$row['username'].">".$row['username']."</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" class="form-control mb-2 btn btn-outline-primary" name="del" value="Delete user's order">
        </form>
        </div>
    </div>

    <?php
        if(isset($_POST["del"])){
            deleteorder();
        }
        function deleteorder(){
            global $conn;
            $user = $_POST["del-val"];
            $sql = "DELETE FROM orders WHERE username = '$user'";
            $conn->query($sql);
            header("Location: adminpage.php");
        }
    ?>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>