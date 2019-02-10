<?php
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $product_quantity = 0;
    //calculate total items added to cart based on quantity
    if(isset($_SESSION['shopping_cart'])){
        //echo count($_SESSION);
        for($i = 0; $i < count($_SESSION['shopping_cart']); $i++) {
            $product_quantity += $_SESSION['shopping_cart'][$i]['quantity'];
        }
    }
    $username = '';
    if(isset($_SESSION['authenticated'])){
        $username = $_SESSION['authenticated'][1];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        
       
		<!-- Website CSS style -->
		
        <link href="https://fonts.googleapis.com/css?family=Pacifico&subset=latin-ext,vietnamese" rel="stylesheet">
		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="./styles/main.css" id="maincss">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&subset=latin-ext,vietnamese" rel="stylesheet">
        <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

        <title>PETMART</title>
    

<style>

</style>
	</head>
	<body>
         <!--NAVIGATION -->
         <nav style="border-radius:0px;z-index:500" id="nav" class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><span style="color:red">PET</span><span class="glyphicon glyphicon-heart"></span><span style="color:green">MART</span></a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a id="home" href="./index.php">Home</a></li>
                    <li><a id="cat-link" href="./index.php?category=1">Cat Food</a></li>
                    <li><a id="dog-link" href="./index.php?category=2">Dog Food</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo "  " . $username ?></a></li>
                    <li><a id="login" href="./view/login.php"><span class="glyphicon glyphicon-log-in"></span>
                       <?php 
                          if(isset($username)){
                              echo "Logout";
                          }else {
                              echo "Login";
                          }
                       ?>
                        
                    </a></li>
                    <li><a id="nav-bar" href="view/shopping_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span><span class="badge"><?php echo $product_quantity ?></span></a></li>
                </ul>
            </div>
        </nav>