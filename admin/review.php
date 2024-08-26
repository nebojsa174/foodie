<?php
    
    include 'includes/header.php';
    include '../app/classes/Food.php';
    include '../app/classes/Cart.php';
    include '../app/classes/Order.php';
    ob_start();

    if(!isset($_SESSION['username'])) {
        header('location:'.ROOT_URL.'index.php');
        exit();
    }

    $food = new Food($conn);
    $reviews = $food->getReview();

    $orders = new Order($conn);

?>

    <div class="adminPage flex">

        <?php include 'includes/sideMenu.php' ?>


        <div class="mainBody">
            <div class="topSection flex">
                <div class="title">
                    <span><strong>Customer Reviews</strong> Page</span>
                </div>

                <?php include 'includes/headerAdmin.php' ?>
            </div>

            <div class="mainBodyContentContainer">
                <div class="reviews flex">
                    <?php foreach($reviews as $review) : ?>
                        <div class="singleReview">
                            <span class="name" style="text-transform:capitalize"><?=$review['reviewer'];?></span>
                            <p><?=$review['note'];?></p>
                            <i class='bx bxs-quote-alt-right quoteIcon'></i>
                            <span class="dateDiv flex">
                                <span class="date"><?=$review['date'];?>
                                </span>
                                <div class="stars flex">
                                    <i class='bx bxs-star icon'></i>
                                    <i class='bx bxs-star icon'></i>
                                    <i class='bx bxs-star icon'></i>
                                    <i class='bx bxs-star icon'></i>
                                    <i class='bx bxs-star-half icon'></i>
                                </div>
                            </span>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>