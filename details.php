<?php

    include 'includes/header.php';
    include 'app/classes/Food.php';
    $food = new Food($conn);
    $name_url = isset($_GET['name_url']) ? $_GET['name_url'] : '';
    $foodDetails = $food->getFoodByNameUrl($name_url);
    if (!$foodDetails) {
        echo '<p>Food details not found.</p>';
        include 'includes/footer.php';
        exit();
    }
    $category = $foodDetails['category'];
    $poepleAlsoLike = $food->getFoodCategory($category);

    if(isset($_POST['submit'])) {

        $food_id = $_POST['food_id'];
        $session_id = $_POST['session_id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $total_cost = $quantity * $price;

        if($quantity > 0) {

            // $cart = new Cart($conn);
            $cart->addToCart($food_id, $session_id, $quantity, $total_cost);

            $_SESSION['addedToCart'] = '
                <div class="messageConatainer flex">
                    <span class="messageCard">
                        <img src="./public/images/shopping-cart.png" class="checkIcon">
                        <small>Item Added to <strong>Cart</strong>, <br>
                        Continue shopping or check-out now!</small>
                        <br><br>
                        - Thank you! -
                    </span>
                </div>';
            
                header('location:'.ROOT_URL. 'menu');
                exit();
        } else {
            echo '<script>alert("Item Quantity Cannot be Zero")</script>';
        }
    }

?>

    <!-- Details Section -->
    <section class="details container section">
        <div class="secContent">

            <div class="sectionIntro">
                <h1 class="secTitle">Details Page</h1>
                <p class="subTitle">All about this item.</p>

                <img src="<?=ROOT_URL?>public/images/titleDesign.png" alt="Design Image">
            </div>

            <div class="mainContent grid">
               <div class="imgDiv_InfoDiv grid">
                <div class="imgDiv">
                    <img src="<?=ROOT_URL?>public/food_images/<?=$foodDetails['image'];?>">
                </div>
                   <div class="itemInfo">
    
                    <h2 class="itemTitle"><?=$foodDetails['name'];?></h2>
    
                    <div class="status flex">
                       <span class="availability">
                         In stock
                       </span>
                       <span class="delivery">
                        Delivery In: 30 Min
                       </span>
                    </div>
                       
                     <div class="composition">
                        <span class="flex">
                            <small>Food Type:</small>
                            <small style="text-transform:capitalize"><?=$foodDetails['category'];?></small>
                        </span>
                        <span class="flex">
                            <small>Temperature:</small>
                            <small style="text-transform:capitalize"><?=$foodDetails['temperature'];?></small>
                        </span>
                     </div>
   
                     <div class="actionBtn flex">
                          <span class="price flex">
                            <span>$ <?=$foodDetails['price'];?></span>
                          </span>

                          <form action="" method="POST" class="flex" style="gap: .5rem;">
                            <input type="number" name="quantity" value="1">
                            <input type="hidden" name="session_id" value="<?=session_id();?>">
                            <input type="hidden" name="food_id" value="<?=$foodDetails['food_id'];?>">
                            <input type="hidden" name="price" value="<?=$foodDetails['price'];?>">
                            <button class="btn flex" name="submit">
                                Add to cart <i class="uil uil-shopping-bag icon"></i>
                            </button>
                          </form>
                     </div>
                      
                   </div>
               </div>

               <div class="itemReview_Desc grid">
                
                <div class="itemDescription">
                    <h3 class="title">Description</h3>
                    <p><?=$foodDetails['description'];?></p>
                </div>

               </div>
            </div>

            <div class="otherItems">
                <h3 class="title flex">People also like <i class='bx bxs-heart icon' ></i></h3>
                <div class="swiper secContainer">
                        
                            <div class="swiper-wrapper">
                            <?php foreach($poepleAlsoLike as $popularFood) : ?>
                                <div class="swiper-slide singleItem">
                                    <div class="rating">
                                        <i class='bx bxs-star icon'></i>
                                        4.5
                                    </div>
                                    <div class="imgDiv flex">
                                        <a href="<?=ROOT_URL?>details.php?id=<?=$popularFood['food_id'];?>">
                                        <img src="<?=ROOT_URL?>public/food_images/<?=$popularFood['image'];?>">
                                        </a>
                                    </div>
                                    <h2 class="foodTitle"><?=$popularFood['name'];?></h2>
                                    <p><?=$popularFood['description'];?></p>
                                    <h4 class="price flex">
                                        <span>$ <?=$popularFood['price'];?></span>
                                        <a href="<?=ROOT_URL?>details.php?id=<?=$popularFood['food_id'];?>" class="btn flex">View Details <i class="uil uil-shopping-bag icon"></i> </a>
                                    </h4>
                                </div>
                                <?php endforeach ?>
                            </div>

                </div>
            </div>
        </div>

       
    </section>
    <!-- Details Section Ends -->

<?php include 'includes/footer.php'; ?>