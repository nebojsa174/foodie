<?php 
    
    include 'includes/header.php';
    include 'app/classes/Order.php';

    $cart_items = $cart->getCartItems($current_session);
    $total = $cart->getTotal($current_session);

   

    if(isset($_POST['submit'])) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $delivery_address = $_POST['city']. ", ".$_POST['street']. ", ".$_POST['building_number'];
        $message = $_POST['message'];
        $status = $_POST['order_status'];
        $payment_method = $_POST['payment'];

        $total = $_POST['total'];

        $order = new Order($conn);
        $new_order = $order->create($current_session, $firstname, $lastname, $phone, $email, $delivery_address, $total, $message, $status, $payment_method);

        $_SESSION['OrderAdded'] = '
        <div class="messageConatainerHome flex">
            <span class="messageCard">
                <img src="./public/images/checkIcon.png" class="checkIconHome">
                <small>Your order has been submitted successfully! <br>So glad to serve you!</small>
            <br><br>
            - Thank you! -
            </span>
        </div>';
        session_regenerate_id();
        header('location:'.ROOT_URL);
        exit();
    }

?>

        <!-- Check Out Page -->
        <section class="section container checkOut">
        <div class="secTitle">
            <h2 class="title flex">
                Checkout <img src="<?=ROOT_URL?>public/images/trolley.png" alt="Icon">
            </h2>
        </div>

        <div class="secContent">
        <form method="POST">
            <div class="mainContent grid">
 
                <div class="rightDiv grid">
                    <div class="personalInfo">
                        <h3 class="title flex">Personal Information: <img src="<?=ROOT_URL?>public/images/details.png" alt="Icon"></h3>
        
                        
                            <div class="inputDiv ">
    
                                <div class="input">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" placeholder="Enter First Name" required>
                                </div>
    
                                <div class="input">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" placeholder="Enter Last Name" required>
                                </div>
    
                                <div class="input">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" placeholder="Enter Phone Number" required>
                                </div>
    
                                <div class="input">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" placeholder="Enter Your Email" required>
                                </div>
                            </div>
                        
                    </div>
        
                    <div class="deliveryAddress">
                        <h3 class="title flex">Delivery Details: <img src="<?=ROOT_URL?>public/images/house.png" alt="Icon"></h3>
                        
                            <div class="inputDiv">

                                    <div class="input">
                                        <label for="city">City</label>
                                        <input type="text" name="city" placeholder="Enter Your City" required>
                                    </div>
                
                                    <div class="input">
                                        <label for="street">Street</label>
                                        <input type="text" name="street" placeholder="Enter Your Street" required>
                                    </div>
                
                                    <div class="input">
                                        <label for="building_number">Building Number</label>
                                        <input type="text" name="building_number" placeholder="Enter Building Number" required>
                                        <input type="hidden" name="order_status" value="ordered">
                                    </div>
                                    
                                    <div class="input">
                                        <label for="message">Message (Optional)</label>
                                        <textarea name="message" placeholder="Any Message"></textarea>
                                    </div>
                            </div>
                        
                    </div>
        
                    <div class="paymentOption">
                        <h3 class="title flex">Payment: <img src="<?= ROOT_URL ?>public/images/debit-card.png" alt="Icon"></h3>
                        <div class="optionDiv">
                            <div class="input flex">
                                <div class="radio">
                                    <input type="radio" id="cod" name="payment" value="C.O.D" onclick="updateTotal()" required>
                                </div>
                                <label for="cod">Pay On Delivery: (Delivery fees: $5)</label>
                            </div>

                            <div class="input flex">
                                <div class="radio">
                                    <input type="radio" id="mobile" name="payment" value="Dining" onclick="updateTotal()">
                                </div>
                                <label for="mobile">Restaurant Dining</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="leftDiv grid">
                    <div class="cartDiv grid">
                        <h3 class="title flex">
                            Your order: <img src="<?=ROOT_URL?>public/images/cart.png" alt="Icon">
                        </h3>
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
                    </div>
    
                    <div class="amountDiv">
                        <h3 class="title flex">
                            Order Fees: <img src="<?= ROOT_URL ?>public/images/order.png" alt="Icon">
                        </h3>

                        <span class="cartList flex">
                            <span class="subTitle">
                                Subtotal:
                            </span>
                            <span class="cost" id="subtotal">
                                $ <?= $total ?>
                            </span>
                        </span>

                        <span class="cartList flex">
                            <span class="subTitle">
                                Total:
                            </span>
                            <span class="gradCost" id="total">
                                <input type="hidden" name="cartID" value="">
                                <input type="hidden" name="subTotal" value="">
                                $ <?= $total ?>
                            </span>
                        </span>

                        <!-- Hidden input field to store the total -->
                        <input type="hidden" name="total" id="hiddenTotal" value="<?= $total ?>">
                        <button type="submit" name="submit" class="btn">Order Now</button>
                    </div>
                </div>
            </div>
        </form>


         
       
        </div>
    </section>
    <!-- Check Out Page End -->

    <script>
        function updateTotal() {
            const codRadio = document.getElementById('cod');
            const totalElement = document.getElementById('total');
            const hiddenTotalInput = document.getElementById('hiddenTotal');

            let total = <?= $total ?>;

            if (codRadio.checked) {
                total += 5;
            }

            totalElement.textContent = '$ ' + total.toFixed(2);

            // Update the hidden input field with the updated total
            hiddenTotalInput.value = total.toFixed(2);
    }
</script>

<?php include 'includes/footer.php';