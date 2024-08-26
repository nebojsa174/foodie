<?php
    include 'includes/header.php';
    include 'app/classes/Food.php';
    include 'app/classes/User.php';

    $foods = new Food($conn);
    $foods = $foods->getAllFood();

    $user = new User($conn);
    

    if(isset($_POST['submit'])) {

        $email = $_POST['email'];
        $date = $_POST['date'];

        $subscribe = $user->addSubscriber($email, $date);
        $_SESSION['subscribed'] = '<script>alert("Subscribed successfully!");</script>';
        header('location:'.ROOT_URL);
        exit();
    }
?>

    <!-- Home Section -->
    <?php 
        if(isset($_SESSION['TableReserved'])){
            echo $_SESSION['TableReserved'];
            unset($_SESSION['TableReserved']);
        }
    ?>
    <?php 
        if(isset($_SESSION['OrderAdded'])){
            echo $_SESSION['OrderAdded'];
            unset($_SESSION['OrderAdded']);
        }
    ?>
    <?php 
        if(isset($_SESSION['subscribed'])){
            echo $_SESSION['subscribed'];
            unset($_SESSION['subscribed']);
        }
    ?>
    <section id="#home" class="home container">
        <div class="sectionContent grid">
            <div data-aos="fade-right" data-aos-duration="1500" data-aos-once="true" class="homeText">
                <h1 class="title">
                    Enjoy <span>Delicious Food</span> At Your Door Step
                </h1>

                <p>We offer the best online portal that allows customers to order food online without visiting the restaurant.
                </p>

                <a href="#popular">
                    <button class="btn flex">
                        Order Now  <i class="uil uil-arrow-right icon"></i>
                    </button>
                </a>
            </div>
            <div class="homeImage">
                <img src="<?=ROOT_URL?>public/images/home.png" alt="Online Food Image">
            </div>

            <img src="<?=ROOT_URL?>public/images/floating1.png" alt="" class="floatingImg1">
            <img src="<?=ROOT_URL?>public/images/floating2.png" alt="" class="floatingImg2">
            <img src="<?=ROOT_URL?>public/images/floating3.png" alt="" class="floatingImg3">
        </div>
    </section>
    <!-- Home Section Ends -->

    <!-- Category Section -->
    <div class="categoriesDiv container">
        <div class="sectionContent grid">

            <!-- Single Category -->
            <div data-aos="fade-right" data-aos-once="true" data-aos-easing="ease-in-sine" data-aos-duration="1000" class="singleCat">
                <img src="<?=ROOT_URL?>public/images/diet.png" alt="Food Website">
                <h2 class="catTitle">Tasty Foods</h2>
                <p>Taste the difference in our town's cuisine, where every dish offers a unique flavor burst.</p>
                <a class="btn" href="menu">See Menu</a>
            </div>

            <!-- Single Category -->
            <div data-aos="fade-right" data-aos-once="true" data-aos-easing="ease-in-sine" data-aos-duration="1000" class="singleCat">
                <img src="<?=ROOT_URL?>public/images/drink.png" alt="Food Website">
                <h2 class="catTitle">Drinks</h2>
                <p>Sip on our town's unique drinks, each offering a refreshing and unforgettable taste.</p>
                <a class="btn" href="menu">See Menu</a>
            </div>

            <!-- Single Category -->
            <div data-aos="fade-right"data-aos-once="true" data-aos-easing="ease-in-sine" data-aos-duration="1000" class="singleCat">
                <img src="<?=ROOT_URL?>public/images/cake.png" alt="Food Website">
                <h2 class="catTitle">Cakes</h2>
                <p>Delight in our cakes, each slice brimming with unique flavors and irresistible charm.</p>
                <a class="btn" href="menu">See Menu</a>
            </div>

            <!-- Single Category -->
            <div data-aos="fade-right" data-aos-once="true" data-aos-easing="ease-in-sine" data-aos-duration="1000" class="singleCat">
                <img src="<?=ROOT_URL?>public/images/dessert.png" alt="Food Website">
                <h2 class="catTitle">Dessert</h2>
                <p>Satisfy your sweet tooth with our desserts, each one a flavorful masterpiece waiting to be savored.</p>
                <a class="btn" href="menu">See Menu</a>
            </div>

        </div>
    </div>
    <!-- Category Section Ends -->

    <!-- About Section -->
    <section id="about" class="about section container">
        <div class="sectionContent grid"> 

            <div class="aboutImage">
                <img src="<?=ROOT_URL?>public/images/aboutImage.png" alt="Online food Image">
            </div>

            <div data-aos="fade-left" data-aos-duration="2000" data-aos-once="true" class="aboutText">
                <h1 class="title">Why People Choose Us!</h1>
                <div class="aboutList grid">

                    <div class="singleInfo flex">
                        <div class="smallImage">
                            <img src="<?=ROOT_URL?>public/images/hamburger.png" alt="Food delivery">
                        </div>
                        <div class="desc">
                            <h5>Choose Your Favourite</h5>
                            <p>Explore our diverse menu, where each dish is crafted to suit your unique palate.</p>
                        </div>
                    </div>

                    <div class="singleInfo flex">
                        <div class="smallImage">
                            <img src="<?=ROOT_URL?>public/images/delivery-man.png" alt="Food delivery">
                        </div>
                        <div class="desc">
                            <h5>We Deliver Your Meals</h5>
                            <p>Experience convenience at its finest as we bring your meal directly to your doorstep.</p>
                        </div>
                    </div>

                    <div class="singleInfo flex">
                        <div class="smallImage">
                            <img src="<?=ROOT_URL?>public/images/dish.png" alt="Food delivery">
                        </div>
                        <div class="desc">
                            <h5>Grab Your Delicious</h5>
                            <p>Indulge in mouthwatering delights, ready to satisfy your cravings at every bite.</p>
                        </div>               
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- About Section Ends -->


    <!-- Popular Food Items -->
    <section class="section popular container" id="popular">
        <div class="sectionContent">
            <div data-aos="fade-down" data-aos-duration="1500" data-aos-once="true" class="sectionIntro">
                <h2>Our Popular Food Item</h2>
                <p>You don't need a silver fork to eat good food.</p>
            </div>

            <div class="contentWrapper">
                <div class="content swiper">
                    <div class="swiper-wrapper">
                        
                        <?php foreach($foods as $food) : ?>
                            <div class="swiper-slide singleItem">
                                <div class="rating">
                                    <i class='bx bxs-star icon'></i>4.5
                                </div>
                                <div class="imgDiv flex">
                                    <a href="<?=ROOT_URL?><?= $food['name_url']; ?>">
                                        <img src="<?=ROOT_URL?>public/food_images/<?=$food['image'];?>">
                                    </a>
                                </div>
                                <h2 class="foodTitle"><?=$food['name'];?></h2>
                                <p><?=$food['description'];?></p>
                                <h4 class="priceDiv flex">
                                    <span class="price">$<?=$food['price'];?></span>
                                    <a href="<?=ROOT_URL?><?= $food['name_url']; ?>">
                                        <span class="detailsLink"> Details <i class="uil uil-external-link-alt "></i></span>
                                    </a>
                                </h4>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Food Items Ends -->

    <!-- Customer Feedback -->
    <section class="section container review">
        <div class="sectionContent grid">

                <div class="secText">
                    <div data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" class="secTitle">
                        <h2>Customer <span>Feedback</span></h2>
                    </div>
                    <div class="content">      
                        <div data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" class="singleCustomer">
                            <p>
                                This cozy restaurant has left the best impressions! Hospitable hosts, delicious dishes, beautiful presentation, wide wine list and wonderful dessert. I recommend to everyone! I would like to come back here again and again.
                            </p>
                            <div class="customerDetails flex">
                                <div class="img">
                                    <img src="<?=ROOT_URL?>public/images/jamie_oliver.png" alt="Online food ordering">
                                </div>
                                <div class="name">
                                    <small>Jamie Oliver</small> <br>
                                    <span>
                                        Celebrity Chef
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" class="records flex">
                            <div class="leftDiv flex">
                                <img src="<?=ROOT_URL?>public/images/chef1.png" alt="Online restaurant">
                                <h1>50</h1>
                                <span>Chef <br> Professionals</span>
                            </div>

                            <div class="leftDiv flex">
                                <img src="<?=ROOT_URL?>public/images/medal.png" alt="Online restaurant">
                                <h1>140</h1>
                                <span>Customer <br> Satisfaction</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div  class="secImage">
                    <img src="<?=ROOT_URL?>public/images/chef2.png" alt="Food chef" data-aos="fade-left" data-aos-duration="2000" data-aos-once="true">
                </div>
        </div>
    </section>
    <!-- Customer Feedback Ends-->

    <!-- Subscription Section -->
    <section class="section container newsLetter">
        <div data-aos="fade-right" data-aos-duration="2000" data-aos-once="true" class="sectionContent flex">
            <h1>Subscribe <span>Newsletter</span></h1>
            <form  method="POST">
                <div class="input flex">
                    <input type="email" name="email" placeholder="Enter your email address">
                    <input type="hidden" name="date" value="<?php echo date("Y-m-d")?>">
                    <button name="submit" class="btn">
                        Subscribe Now
                    </button>
                </div>
            </form>
        </div>
    </section>
    <!-- Subscription Section End -->
<?php include 'includes/footer.php';