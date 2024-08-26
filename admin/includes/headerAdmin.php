<?php 

    include_once '../app/config/config.php';
    include_once '../app/classes/User.php';
    include_once '../app/classes/Cart.php';
    include_once '../app/classes/Order.php';
    ob_start();

    $user = new User($conn);
    $order = new Order($conn);
    $admin = $user->adminHeader($_SESSION['username']);

    $numberOfOrders = $order->getNumberOfOrderedOrders();

?>

<div class="adminDiv flex">
    <div class="notDiv">
    <a href="<?=ROOT_URL?>admin/orders.php"><i class='bx bxs-bell icon' title="New Food Order" style="color: black;"></i></a>
        <?php if($numberOfOrders == 0) : ?>
            <span style="display: none"></span>
        <?php else : ?>
            <span class="count"><?=$numberOfOrders?></span>
        <?php endif ?>
    </div>
        <div class="imgDiv flex">

                <img src="<?=ROOT_URL?>public/images/<?=$admin['image'];?>" alt="Account Admin Image">
                <span class="name"><?=$admin['name'];?></small></span>

        </div>
    <a href="logout.php" title="Log Out" ><img src="<?=ROOT_URL?>public/images/logout.png" alt="" style="width: 40px; transform: translateY(5px);"></a>
</div>