<?php 

    include 'includes/header.php';
    include '../app/classes/Cart.php';
    include '../app/classes/Order.php';
    include '../app/classes/Food.php';

    if(!isset($_SESSION['username'])) {
        header('location:'.ROOT_URL.'index.php');
        exit();
    }

    $orders = new Order($conn);
    $order_id = $_GET['id'];
    $orderDetails = $orders->getOrderDetails($order_id);

    $orderStatus = $orders->getOrderStatus($order_id);


    if(isset($_POST['submit'])) {

        $status = $_POST['status'];
        $updated = $_POST['updated'];
        $dateTime = $_POST['dateTime'];

        $updateOrder = $orders->updateOrder($status, $updated, $dateTime, $order_id);
        $_SESSION['orderUpdated'] = '<span class="success">Order Updated Successfully!</span>';
        header('location:'.ROOT_URL.'admin/orders.php');
        exit();
    }
?>

    <div class="adminPage flex">  

        <?php include 'includes/sideMenu.php'; ?>

         <div class="mainBody">
            <div class="topSection flex">
                <div class="title">
                    <span><strong>Single Order</strong> Page</span>
                </div>
                <?php include 'includes/headerAdmin.php'; ?>
            </div>

            <div class="mainBodyContentContainer">
                
                    <div class="heading flex">
                        <span># <?=$order_id?> Order Details</span>
                        <button class="btn">
                            <a href="orderDetails.php" class="flex">All Orders <i class="uil uil-arrow-right icon"></i></a>
                        </button>
                    </div>
                    <div class="orderDetails flex">
                        
                            <div class="cartDiv grid">
                            <?php foreach($orderDetails as $item) : ?>
                                <div class="singleCart flex">
                               
                                    <img src="<?=ROOT_URL?>public/food_images/<?=$item['image'];?>"  alt="Online Food Order">
                                    <div class="foodDetails">
                                        <span class="name_closeIcon flex">    
                                            <?=$item['order_item_name'];?>                           
                                            <i class="uil uil-check-circle icon"></i>
                                        </span>
                                        <span class="qty_price flex">
                                            <span>Quantity: <?=$item['quantity'];?></span>
                                            <span>$<?=$item['item_total_price'];?></span>
                                        </span>
                                    </div>

                                </div>
                                <?php endforeach ?>
                            </div>
                        <div class="amountDiv">
                            <h3 class="title flex">
                            Order Fees: <img src="<?=ROOT_URL?>public/images/order.png" alt="Icon">
                            </h3>
                            <span class="cartList flex">
                                <span class="subTitle">
                                    Total:
                                </span>
                                <span class="gradCost">
                                    $<?=$item['total'];?>
                                </span>
                            </span>

                            <span class="cartList flex">
                                <span class="subTitle">
                                    Payment:
                                </span>
                                <span class="gradCost">
                                    <?=$item['payment_method'];?>
                                </span>
                            </span>

                            <div class="updateOrderDiv">
                                <h3 class="updateOrderTitle flex">
                                    Upadate Order
                                </h3>
        
                                <form method="post">
                                    <div class=" inputDiv flex">
                                        <label>Status</label>
                                        <select name="status">
                                            <option value="ordered" <?= ($orderStatus['status'] == 'ordered') ? 'selected' : ''; ?>>Ordered</option>
                                            <option value="delivered" <?= ($orderStatus['status'] == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                                            <option value="canceled" <?= ($orderStatus['status'] == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                            <option value="on the way" <?= ($orderStatus['status'] == 'on the way') ? 'selected' : ''; ?>>On the way</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="updated" value="<?=$_SESSION['username'];?>">
                                    <input type="hidden" name="dateTime" value="<?=date("Y-m-d H:i:s")?>">
                                    <button name="submit" class="btn">Update Order</button> 
                                </form>
                            </div>
            
                        </div>
                        
                    </div>
                <div class="customerDetails grid">
                    <div class="heading flex">
                        <span>Customer Details</span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Customer First Name:</span>
                        <span class="detail"><?=$item['firstname'];?></span>
                    </div>
                    <div class="singleDetail  flex">
                        <span class="dTitle">Customer Second Name:</span>
                        <span class="detail"><?=$item['lastname'];?></span>
                    </div>
                    <div class="singleDetail  flex">
                        <span class="dTitle">Email:</span>
                        <span class="detail"><?=$item['email'];?></span>
                    </div>
                    <div class="singleDetail  flex">
                        <span class="dTitle">Phone:</span>
                        <span class="detail"><?=$item['phone'];?></span>
                    </div>
                    <div class="singleDetail  flex">
                        <span class="dTitle">Delivery Address:</span>
                        <span class="detail"><?=$item['delivery_address'];?></span>
                    </div>
                    <div class="singleDetail  flex">
                        <span class="dTitle">Message:</span>
                        <span class="detail"><?=$item['message'];?></span>
                    </div>
                </div>

                <div class="customerDetails grid">
                    <div class="heading flex">
                        <span>Order Notes</span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="detail">This order was last updted by;</span>

                    </div>
                    <div class="singleDetail  flex">
                        <span class="dTitle">Admin Name:</span>
                        <span class="detail" style="text-transform: capitalize;"><?=$item['updated_by'];?></span>
                    </div>
                    <div class="singleDetail  flex">
                        <span class="dTitle">Date:</span>
                        <span class="detail"><?=$item['updated_date'];?></span>
                    </div>

                    

                </div>
               
            </div>

         </div>
    </div>



<?php include 'includes/footer.php'; ?>