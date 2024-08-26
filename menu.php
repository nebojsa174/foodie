<?php

include 'includes/header.php';
include 'app/classes/Food.php';

$food = new Food($conn);

$localFoods = $food->getFoodCategory("localfood");
$drinks = $food->getFoodCategory("drinks");
$fastfoods = $food->getFoodCategory("fastfood");
$cakes = $food->getFoodCategory("cakes");
$desserts = $food->getFoodCategory("dessert");

?>
<!-- Menu Section -->
<?php
if (isset($_SESSION['addedToCart'])) {
    echo $_SESSION['addedToCart'];
    unset($_SESSION['addedToCart']);
}
?>
<section class="container section menuPage">
    <div class="secContent">

        <div class="sectionIntro">
            <h1 class="secTitle">All Menu</h1>
            <p class="subTitle">Welcome to our chefs' listing.</p>
            <img src="<?= ROOT_URL ?>public/images/titleDesign.png" alt="Design Image">
        </div>

        <div class="optionMenu flex">
            <div class=" option" data-filter="food">
                <img src="<?= ROOT_URL ?>public/images/diet.png" alt="Best Online food delivery in Nigeria">
                <small>Foods</small>
            </div>
            <div class=" option" data-filter="drinks">
                <img src="<?= ROOT_URL ?>public/images/drink.png" alt="Best Online restaurant in Nigeria">
                <small>Drinks</small>
            </div>
            <div class=" option categoryActive" data-filter="fastfood">
                <img src="<?= ROOT_URL ?>public/images/pizza.png" alt="Food Image">
                <small>Fast</small>
            </div>
            <div class=" option" data-filter="cakes">
                <img src="<?= ROOT_URL ?>public/images/cake.png" alt="Best Online restaurant in Nigeria">
                <small>Cakes</small>
            </div>
            <div class=" option" data-filter="dessert">
                <img src="<?= ROOT_URL ?>public/images/dessert.png" alt="Best Online restaurant in Nigeria">
                <small>Dessert</small>
            </div>
        </div>

        <div class="allItems">
            <div class="categoryWrapper grid hide" data-target="food">

                <!-- SingleItem -->
                <?php foreach ($localFoods as $localFood) : ?>
                    <div class="singleItem">
                        <div class="rating">
                            <i class='bx bxs-star icon'></i>
                            4.5
                        </div>
                        <div class="imgDiv">
                            <img src="<?= ROOT_URL ?>public/food_images/<?= $localFood['image']; ?>">
                        </div>
                        <h2 class="foodTitle"><?= $localFood['name']; ?></h2>
                        <p><?= $localFood['description']; ?></p>
                        <h4 class="price flex">
                            <span>$<?= $localFood['price']; ?></span>
                            <a href="<?= ROOT_URL ?><?= $localFood['name_url']; ?>" class="btn flex">View Details <i class="uil uil-shopping-bag icon"></i></a>
                        </h4>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="categoryWrapper grid hide" data-target="drinks">

                <!-- SingleItem -->
                <?php foreach ($drinks as $drink) : ?>
                    <div class="singleItem">
                        <div class="rating">
                            <i class='bx bxs-star icon'></i>
                            4.5
                        </div>
                        <div class="imgDiv">
                            <img src="<?= ROOT_URL ?>public/food_images/<?= $drink['image']; ?>">
                        </div>
                        <h2 class="foodTitle"><?= $drink['name']; ?></h2>
                        <p><?= $drink['description']; ?></p>
                        <h4 class="price flex">
                            <span>$<?= $drink['price']; ?></span>
                            <a href="<?= ROOT_URL ?><?= $drink['name_url']; ?>" class="btn flex">View Details <i class="uil uil-shopping-bag icon"></i></a>
                        </h4>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="categoryWrapper grid" data-target="fastfood">

                <!-- SingleItem -->
                <?php foreach ($fastfoods as $fastfood) : ?>
                    <div class="singleItem">
                        <div class="rating">
                            <i class='bx bxs-star icon'></i>
                            4.5
                        </div>
                        <div class="imgDiv">
                            <img src="<?= ROOT_URL ?>public/food_images/<?= $fastfood['image']; ?>">
                        </div>
                        <h2 class="foodTitle"><?= $fastfood['name']; ?></h2>
                        <p><?= $fastfood['description']; ?></p>
                        <h4 class="price flex">
                            <span>$<?= $fastfood['price']; ?></span>
                            <a href="<?= ROOT_URL ?><?= $fastfood['name_url']; ?>" class="btn flex">View Details <i class="uil uil-shopping-bag icon"></i></a>
                        </h4>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="categoryWrapper grid hide" data-target="cakes">

                <!-- SingleItem -->
                <?php foreach ($cakes as $cake) : ?>
                    <div class="singleItem">
                        <div class="rating">
                            <i class='bx bxs-star icon'></i>
                            4.5
                        </div>
                        <div class="imgDiv">
                            <img src="<?= ROOT_URL ?>public/food_images/<?= $cake['image']; ?>">
                        </div>
                        <h2 class="foodTitle"><?= $cake['name']; ?></h2>
                        <p><?= $cake['description']; ?></p>
                        <h4 class="price flex">
                            <span>$<?= $cake['price']; ?></span>
                            <a href="<?= ROOT_URL ?><?= $cake['name_url']; ?>" class="btn flex">View Details <i class="uil uil-shopping-bag icon"></i></a>
                        </h4>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="categoryWrapper grid hide" data-target="dessert">

                <!-- SingleItem -->
                <?php foreach ($desserts as $dessert) : ?>
                    <div class="singleItem">
                        <div class="rating">
                            <i class='bx bxs-star icon'></i>
                            4.5
                        </div>
                        <div class="imgDiv">
                            <img src="<?= ROOT_URL ?>public/food_images/<?= $dessert['image']; ?>">
                        </div>
                        <h2 class="foodTitle"><?= $dessert['name']; ?></h2>
                        <p><?= $dessert['description']; ?></p>
                        <h4 class="price flex">
                            <span>$<?= $dessert['price']; ?></span>
                            <a href="<?= ROOT_URL ?><?= $dessert['name_url']; ?>" class="btn flex">View Details <i class="uil uil-shopping-bag icon"></i></a>
                        </h4>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<!-- Menu Top Section Ends -->

<?php include 'includes/footer.php'; ?>