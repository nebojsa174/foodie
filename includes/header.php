<?php 

    include './app/config/config.php';
    include './app/classes/Cart.php';
    
    $current_session = session_id();

    $cart = new Cart($conn);
    $cart_items = $cart->getCartItems($current_session);
    $number_of_items = count($cart_items)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title>Foodie</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=ROOT_URL?>public/images/favicon.png">
    <!-- Link to css -->
    <link rel="stylesheet" href="<?=ROOT_URL?>public/css/styles.css">

    <!-- Link to swiper css -->
    <link rel="stylesheet" href="<?=ROOT_URL?>public/css/swiper-bundle.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Link to icons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/c93511b22d.js" crossorigin="anonymous"></script>

</head>
<body>

    <!-- Header/NavBar -->
    <header class="header flex" id="header">
        <div class="logoDiv">
            <a href="<?=ROOT_URL?>" class="logo">
                FOODIE
            </a>
        </div>

        <!-- Navbar -->
        <div class="navBar" id="navBar">
            <ul class="navLists flex">
                <li class="navItem">
                    <a href="<?=ROOT_URL?>" class="navLink">Home</a>
                </li>

                <li class="navItem">
                    <a href="menu" class="navLink">Menu</a>
                </li>

                <li class="navItem">
                    <a href="tableReservation" class="navLink">Table Reservations
                    </a>
                </li>


                <div class="navBarText">
                    <p>Eat Anything, At anywhere, By Anytime.</p>
                </div>

                <!-- Toggle-Off navBar Icon -->
                <div class="closeNavbar" id="closeBtn">
                    <i class='bx bxs-x-circle icon'></i>
                </div>
            </ul>
        </div>



        <!-- HeaderIcons -->
        <div class="headerIcons flex">

        <div class="notDiv">
            <a href="cart"><i class="uil uil-shopping-bag icon"></i></a>
        <span class="count"><?=$number_of_items?></span>
        </div>
            
            
             <div class="contactNumber">
                <i class="uil uil-phone icon phoneIcon"></i>
                <div class="phoneCard flex">
                    <i class='bx bxs-phone'></i>
                    <h3> +444 789 445 67</h3>
                </div>
             </div>

        </div>

        <!-- Toggle-On navBar Icon -->
        <div class="toggleNavbar" id="toggler">
            <i class="uil uil-align-justify icon"></i>
        </div>
    </header>
    <!-- Header/NavBar Ends -->