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
    $localfood = $food->getFoodCategory('localfood');
    $drinks = $food->getFoodCategory('drinks');
    $fastfood = $food->getFoodCategory('fastfood');
    $cakes = $food->getFoodCategory('cakes');
    $desserts = $food->getFoodCategory('dessert');

    $orders = new Order($conn);
?>

<div class="adminPage flex">
    <?php include './includes/sideMenu.php';?>

    <div class="mainBody">
        <div class="topSection flex">
            <div class="title">
                <span><strong>Food Menu</strong> Page</span>
            </div>

            <?php
            if (isset($_SESSION['addedFood'])) {
                echo $_SESSION['addedFood'];
                unset($_SESSION['addedFood']);
            }

            if (isset($_SESSION['deletedFood'])) {
                echo $_SESSION['deletedFood'];
                unset($_SESSION['deletedFood']);
            }

            if (isset($_SESSION['updatedFood'])) {
                echo $_SESSION['updatedFood'];
                unset($_SESSION['updatedFood']);
            }

            ?>

            <?php include 'includes/headerAdmin.php'; ?>
        </div>


        <div class="mainBodyContentContainer">
            <div class="menuContainer grid">
                <!-- Food Category -->
                <div class="foodCategoryDiv">
                    <div class="heading flex">
                        <span class="">Food Category</span>
                        <button class="btn">
                            <a href="addFood.php" class="flex">Add Food <i class="uil uil-plus icon"></i></a>
                        </button>
                    </div>
                   
                        <div class="itemsContainer flex">
                            <?php foreach ($localfood as $food) : ?>
                                <div class="singleItem">
                                    <div class="imgDiv">
                                        <img src="<?=ROOT_URL?>public/food_images/<?=$food['image'];?>">
                                    </div>
                                    <div class="itemInfo">
                                        <div>
                                        <span class="itemName"><?=$food['name'];?></span>
                                        <p class="desc"><?=$food['description'];?></p>
                                        </div>
                                    </div>
                                    <div class="itemBottom flex">
                                            <span class="price">$<?=$food['price'];?></span>
                                            <div class="flex" style="gap: 5px; justify-content: space-between;">
                                                <a href="<?=ROOT_URL?>admin/updateFood.php?id=<?=$food['food_id'];?>"><i class="uil uil-edit icon"></i></a>
                                                <a href="<?=ROOT_URL?>admin/deleteFood.php?id=<?=$food['food_id'];?>"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                                            </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                </div>

                <!-- Drinks Category -->
                <div class="drinksCategoryDiv">
                    <div class="heading flex">
                        <span class="">Drinks Category</span>
                        <button class="btn">
                            <a href="addFood.php" class="flex">Add Food <i class="uil uil-plus icon"></i></a>
                        </button>
                    </div>

                    <div class="itemsContainer flex">
                        <?php foreach ($drinks as $drink) : ?>
                            <div class="singleItem">
                                <div class="imgDiv">
                                    <img src="<?=ROOT_URL?>public/food_images/<?=$drink['image'];?>">
                                </div>
                                <div class="itemInfo">
                                    <span class="itemName"><?=$drink['name'];?></span>
                                    <p class="desc"><?=$drink['description'];?></p>
                                </div>
                                <div class="itemBottom flex">
                                        <span class="price">$<?=$drink['price'];?></span>
                                        <div>
                                            <a href="<?=ROOT_URL?>admin/updateFood.php?id=<?=$drink['food_id'];?>"><i class="uil uil-edit icon"></i></a>
                                            <a href="<?=ROOT_URL?>admin/deleteFood.php?id=<?=$drink['food_id'];?>"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                                        </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <!-- Fast Food Category -->
                <div class="fastFoodCategoryDiv foodCategoryDiv">
                    <div class="heading flex">
                        <span class="">Fast Food Category</span>
                        <button class="btn">
                            <a href="addFood.php" class="flex">Add Food <i class="uil uil-plus icon"></i></a>
                        </button>
                    </div>

                    <div class="itemsContainer flex">
                        <?php foreach ($fastfood as $ffood) : ?>
                            <div class="singleItem">
                                <div class="imgDiv">
                                    <img src="<?=ROOT_URL?>public/food_images/<?=$ffood['image'];?>">
                                </div>
                                <div class="itemInfo">
                                    <span class="itemName"><?=$ffood['name'];?></span>
                                    <p class="desc"><?=$ffood['description'];?></p>
                                </div>
                                <div class="itemBottom flex">
                                        <span class="price">$<?=$ffood['price'];?></span>
                                        <div>
                                            <a href="<?=ROOT_URL?>admin/updateFood.php?id=<?=$ffood['food_id'];?>"><i class="uil uil-edit icon"></i></a>
                                            <a href="<?=ROOT_URL?>admin/deleteFood.php?id=<?=$ffood['food_id'];?>"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                                        </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <!-- Cakes Category -->
                <div class="cakesCategoryDiv foodCategoryDiv">
                    <div class="heading flex">
                        <span class="">Cakes Category</span>
                        <button class="btn">
                            <a href="addFood.php" class="flex">Add Food <i class="uil uil-plus icon"></i></a>
                        </button>
                    </div>

                    <div class="itemsContainer flex">
                        <?php foreach ($cakes as $cake) : ?>
                            <div class="singleItem">
                                <div class="imgDiv">
                                    <img src="<?=ROOT_URL?>public/food_images/<?=$cake['image'];?>">
                                </div>
                                <div class="itemInfo">
                                    <span class="itemName"><?=$cake['name'];?></span>
                                    <p class="desc"><?=$cake['description'];?></p>
                                </div>
                                <div class="itemBottom flex">
                                        <span class="price">$<?=$cake['price'];?></span>
                                        <div>
                                            <a href="<?=ROOT_URL?>admin/updateFood.php?id=<?=$cake['food_id'];?>"><i class="uil uil-edit icon"></i></a>
                                            <a href="<?=ROOT_URL?>admin/deleteFood.php?id=<?=$cake['food_id'];?>"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                                        </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <!-- Dessert Category -->
                <div class="dessertCategoryDiv foodCategoryDiv">
                    <div class="heading flex">
                        <span class="">Dessert Category</span>
                        <button class="btn">
                            <a href="addFood.php" class="flex">Add Food <i class="uil uil-plus icon"></i></a>
                        </button>
                    </div>

                    <div class="itemsContainer flex">
                        <?php foreach ($desserts as $dessert) : ?>
                            <div class="singleItem">
                                <div class="imgDiv">
                                    <img src="<?=ROOT_URL?>public/food_images/<?=$dessert['image'];?>">
                                </div>
                                <div class="itemInfo">
                                    <span class="itemName"><?=$dessert['name'];?></span>
                                    <p class="desc"><?=$dessert['description'];?></p>
                                </div>
                                <div class="itemBottom flex">
                                        <span class="price">$<?=$dessert['price'];?></span>
                                        <div>
                                            <a href="<?=ROOT_URL?>admin/updateFood.php?id=<?=$dessert['food_id'];?>"><i class="uil uil-edit icon"></i></a>
                                            <a href="<?=ROOT_URL?>admin/deleteFood.php?id=<?=$dessert['food_id'];?>"><i class="uil uil-times-circle deleteIcon icon"></i></a>
                                        </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>