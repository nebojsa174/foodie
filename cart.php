<?php

    include 'includes/header.php';

    $current_session = session_id();

    // $cart = new Cart($conn);
    $cart_items = $cart->getCartItems($current_session);
    $total = $cart->getTotal($current_session);

    if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];
        $cart->removeFromCart($food_id, $current_session);
        $_SESSION['deletedCartItem'] = '<span class="success">Food Item deleted successfully!</span>';
        header('location: cart.php');
        exit();
    }

?>

    <!-- Cart Section -->
    <section class="section container cart">

        <div class="secTitle">
            <h2 class="title flex">
                Cart <img src="<?=ROOT_URL?>public/images/cart.png" alt="Icon">
            </h2>
        </div>

        <div class="secContent">

               <div class="gridDiv grid">
                    <div class="cartDiv grid">
                        <h3 class="title" >
                            Dear <span style="text-transform: capitalize;">Customer</span>, below is your cart details: 
                        </h3>
                        <?php 
                        if (isset($_SESSION['deletedCartItem'])) {
                            echo $_SESSION['deletedCartItem'];
                            unset($_SESSION['deletedCartItem']);
                        }
                        ?> 
                        <?php if(count($cart_items) > 0) : ?>
                            <?php foreach($cart_items as $cart_item) : ?>
                                <div class="singleCart flex">
                                            <img src="<?=ROOT_URL?>public/food_images/<?=$cart_item['image'];?>"  alt="Online Food Order">
                                    <div class="foodDetails">
                                        <span class="name_closeIcon flex">
                                            <?=$cart_item['name'];?>
                                            <a href="cart.php?action=remove&food_id=<?=$cart_item['food_id'];?>" class="deleteCartItem"><i class='bx bx-x icon'></i></a>
                                        </span>
                                        <span class="qty_price flex">
                                            <span>Quantity: <?=$cart_item['quantity'];?></span>
                                            <span>$ <?=$cart_item['price'];?></span>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <span class="blank">No item in the cart yet!</span>
                        <?php endif ?>
                    </div>
                    <div class="amountDiv">
                        <h3 class="title flex">
                        Order Fees: <img src="<?=ROOT_URL?>public/images/order.png" alt="Icon">
                        </h3>
                
                        <span class="cartList flex">
                            <span class="subTitle">
                                Subtotal:
                            </span>
                            <span class="cost">
                               $ <?=$total?>
                            </span>
                        
                        </span>
            
                        <span class="cartList flex">
                            <span class="subTitle">
                                Total:
                            </span>
                            <span class="gradCost">
                            $ <?=$total?>
                            </span>
                        </span>
            
                        <a href="menu" class="btn shopping">Continue Shopping</a>
                        <?php if($total > 0) : ?> 
                            <a href="checkout" class="btn">Check Out</a> 
                        <?php else : ?>
                            <script>alert("Your cart is empty")</script>
                        <?php endif ?>
                    </div>
                    
               </div>

        </div>
       
    </section>
    <!-- Cart Section End -->

<?php include 'includes/footer.php';