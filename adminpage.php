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
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="container jumbotron text-center col-lg-6 col-xl-6">
        <h1 class="display-4">Online Grocery Shopping Cpanel</h1>
        <p class="lead text-justify text-center">Please use the tools given below to manage the grocery store</p>
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

    <div class="container text-center col-lg-6 col-xl-6" id="add">
    <h1 class="display-4">Add new item to the store</h1>
        <div class="form-group d-flex justify-content-center">
            <form action="adminpage.php" method="POST">
                <label for="item_grp">Select the item group to update</label>
                <select name="item_grp" id="item_grp" class="form-control mb-2">
                    <option value="baked_foods">Baked Foods</option>
                    <option value="dairy">Dairy</option>
                    <option value="fast_foods">Fast Foods</option>
                    <option value="fresh_produce">Fresh Produce</option>
                    <option value="frozen_foods">Frozen Foods</option>
                    <option value="household">Household</option>
                    <option value="meat">Meat</option>
                    <option value="staples">Staples</option>
                </select>
                <input type="text" name="name" placeholder="Enter Product Name" class="form-control mb-2">
                <input type="number" name="quantity" placeholder="Enter Product Quantity" class="form-control mb-2">
                <input type="number" name="price" placeholder="Enter Product Price" class="form-control mb-2">
                <input type="text" name="image" placeholder="Enter Product Image Link" class="form-control mb-2">
                <input type="submit" name="add" value="Add Item" class="btn btn-outline-primary">
            </form>
        </div>
        <?php
            if(isset($_POST["add"])){
                additem();
            }
            function additem(){
                global $conn;
                $table = $_POST["item_grp"];
                $name = $_POST["name"];
                $quantity = $_POST["quantity"];
                $price = $_POST["price"];
                $image = $_POST["image"];
                if(($table and $name and $quantity and $price and $image) != NULL){
                    $sql = "INSERT INTO $table VALUES('$name','$quantity','$price','$image')";
                    $conn->query($sql);
                    echo "<p class='lead text-center text-justify'>Item successfully Added!</p>";
                }else{
                    echo "<p class='lead text-center text-justify'>Please check all the fields</p>";
                }
            }
        ?>
    </div>

    <div class="container text-center col-lg-6 col-xl-6">
        <h1 class="display-4">Update Store's Information</h1>
        <div class="form-group d-flex justify-content-center">
        <form action="adminpage.php" method="POST">
            <label for="item_grp">Select the item group to update</label>
            <select name="item_grp" id="item_grp" class="form-control mb-2">
                <option value="baked_foods">Baked Foods</option>
                <option value="dairy">Dairy</option>
                <option value="fast_foods">Fast Foods</option>
                <option value="fresh_produce">Fresh Produce</option>
                <option value="frozen_foods">Frozen Foods</option>
                <option value="household">Household</option>
                <option value="meat">Meat</option>
                <option value="staples">Staples</option>
            </select>
            <label for="cattrib">Select current the item attribute to change</label>
            <select name="cattrib" id="cattrib" class="form-control mb-2">
                <option value="pr_name">Product Name</option>
                <option value="pr_quantity">Product Quantity</option>
                <option value="pr_price">Product Price</option>
                <option value="pr_image">Product Image Link</option>
            </select>
            <input type="text" class="form-control mb-2" placeholder="Current Value" name="cval">
            <label for="attrib">Select the item attribute to change</label>
            <select name="attrib" id="attrib" class="form-control mb-2">
                <option value="pr_name">Product Name</option>
                <option value="pr_quantity">Product Quantity</option>
                <option value="pr_price">Product Price</option>
                <option value="pr_image">Product Image Link</option>
            </select>
            <input type="text" class="form-control mb-2" placeholder="New Value" name="nval">
            <input type="submit" value="Update" name="update" class="btn btn-outline-primary form-control mb-2">
        </form>
        </div>
        </div>
        <?php
            if(isset($_POST["update"])){
                update();
            }
            function update(){
                global $conn;
                $table = $_POST["item_grp"];
                $col = $_POST["attrib"];
                $cval = $_POST["cval"];
                $nval = $_POST["nval"];
                $ccol = $_POST["cattrib"];
                if(($table and $col and $cval and $nval and $ccol) != NULL){
                    $sql = "UPDATE $table SET $col='$nval' WHERE $ccol='$cval'";
                    $conn->query($sql);
                    echo "<p class='lead text-center text-justify'>Item successfully updated!</p>";
                }else{
                    echo "<p class='lead text-center text-justify'>Please check all the input fields</p>";
                }
            }
        ?>
    </div>

    <div class="container text-center col-lg-6 col-xl-6">
        <h1 class="display-4">Delete Store items</h1>
        <div class="form-group d-flex justify-content-center">
            <form action="adminpage.php" method="POST">
                <label for="item_grp">Select the item group to update</label>
                <select name="item_grp" id="item_grp" class="form-control mb-2">
                    <option value="baked_foods">Baked Foods</option>
                    <option value="dairy">Dairy</option>
                    <option value="fast_foods">Fast Foods</option>
                    <option value="fresh_produce">Fresh Produce</option>
                    <option value="frozen_foods">Frozen Foods</option>
                    <option value="household">Household</option>
                    <option value="meat">Meat</option>
                    <option value="staples">Staples</option>
                </select>
                <input type="text" name="name" placeholder="Product name" class="form-control mb-2">
                <input type="submit" name="delete_item" value="Delete Item" class="btn btn-primary">
            </form>
        </div>
        <?php
            if(isset($_POST["delete_item"])){
                delete_item();
            }
            function delete_item(){
                global $conn;
                $table = $_POST["item_grp"];
                $name = $_POST["name"];
                if(($table and $name)!= NULL){
                    $sql = "DELETE FROM $table WHERE pr_name='$name'";
                    $conn->query($sql);
                    echo "<p class='lead text-center text-justify'>Item successfully Deleted!</p>";
                }else{
                    echo "<p class='lead text-center text-justify'>Item Not Deleted. Please check your inputs.</p>";
                }
            }
        ?>
    </div>

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