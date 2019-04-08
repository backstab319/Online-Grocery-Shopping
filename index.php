<?php
    function userinit($username){
        setcookie("user",$username,time()+1800,"/");
    }
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Online Grocery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>
<body>

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
                                <a class="nav-link" href="/signup.php">Sign up!</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </navbar>
    </div>

    <div class="background">
    <div class="overlay">

    <div class="container text-center col-lg-6 col-xl-6 jumbo d-flex justify-content-end">
        <div class="pos">
        <div class="form-group d-sm-flex justify-content-end">
            <div class="pos2 col-lg-8 col-xl-8">
            <h1 class="display-4 text-light">Login</h1>
            <p class="lead text-justify text-center text-light">Please login to OGS to order groceries online</p>
            <form action="/index.php" method="POST">
                <input type="text" class="form-control mb-2 text-light" name="userid" placeholder="Username">
                <input type="password" class="form-control mb-2 text-light" name="pass" placeholder="Password">
                <input type="submit" value="Login" class="form-control btn btn-outline-light mb-2" name="login">
            </form>
            </div>
        </div>
        <?php
            include "connect.php";
            if(isset($_POST["login"])){
                login();
            }
            function login(){
                global $conn, $error;
                $username = $_POST["userid"];
                $password = $_POST["pass"];
                $sql = "SELECT password FROM login_details WHERE user_id='$username'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($password == $row["password"] and $password != NULL){
                    userinit($username);
                    if($username == "admin"){
                        header("Location: adminpage.php");
                        exit();
                    }
                    header("Location: grocery.php");
                    exit();
                }else{
                    echo "<p class='lead'>The entered username or password is incorrect!</p>";
                }
            }
        ?>
        </div>
    </div>
    
    </div>
    </div>

    <div class="container jumbotron text-center col-lg-6 col-xl-6 mt-4">
        <h1 class="display-4">What is OGS?</h1>
        <p class="lead text-justify">It is a web-based project which is made for grocery shopping through Internet. As the technology 
        is being advanced the way of life is changing. Now a day’s we can place the order for anything from our home. There is no need to 
        go the shop of the things we want. The order can be placed online through Internet can be available on the door-step in few hours. 
        With this the user can enjoy hassle free and home delivery at just a click of a button. Wide range of products, including vegetable 
        and fruit can be ordered at low price and great offer.. The payment, the confirmation of purchasing; we can do everything we want. 
        Now we can think that how the days have been changed with time. People had to stand in rows to wait there terms to buy a particular 
        thing from a popular shop. The product can be delivered at a door step.</p>
    </div>

    <div class="container jumbotron text-center col-lg-6 col-xl-6">
        <h1 class="display-4">How does OGS work?</h1>
        <p class="lead text-justify">It’s a grocery shopping system that works by processing secure online ordering or purchasing made through our
        website. The data is then passed onto a backend system which can be accessed by our admin to manage the appointment. Other 
        features may come with it – for example, the automation of order confirmation emails etc.
        An increasing number of customer are relying on online booking in order to take order or purchase, and with this capability, 
        we can grab a significant amount of business as well as help the society to develop.
        </p>
    </div>

    <div class="container jumbotron text-center col-lg-6 col-xl-6">
        <h1 class="display-4">About Developer</h1>
        <p class="lead text-justify text-center">OGS is being actively developed by Vijayshankar of BCA VI Semester 'B' Section
        </p>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>