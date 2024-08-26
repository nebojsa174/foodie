<?php 

    include 'includes/header.php';
    include '../app/classes/Cart.php';
    include '../app/classes/Order.php';

    if(!isset($_SESSION['username'])) {
        header('location:'.ROOT_URL.'index.php');
        exit();
    }

    $orders = new Order($conn);
    $allOrders = $orders->getAllOrders();
?>

    <div class="adminPage flex">

       <?php include './includes/sideMenu.php';?>

        <div class="mainBody">
            <div class="topSection flex">
                <div class="title">
                    <span><strong>Orders</strong> Page</span>
                </div>
                <?php 
                   if (isset($_SESSION['orderUpdated'])) {
                    echo $_SESSION['orderUpdated'];
                    unset($_SESSION['orderUpdated']);
                   }
                ?> 
                
                <?php include 'includes/headerAdmin.php'; ?>
            </div>
            <div class="mainBodyContentContainer">
                <div class="orderDiv">
                    <table class="table">
                        <tr class="tblHeader">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Payments</th>
                            <th>Action</th>
                        </tr>

                        <?php if(empty($allOrders)) : ?>
                            <span class="blank">No Orders have been made yet!</span>
                        <?php else : ?>
                            <?php foreach($allOrders as $order) : ?>


                                <tr class="tblRow orderRow">
                                    <td class="id"><?=$order['order_id'];?></td>
                                    <td class="customerName">
                                    <span class="name"><?=$order['firstname'] .' '. $order['lastname'];?></span>
                                    </td>
            
                                    <td class="contact">
                                        <p><?=$order['phone'];?></p>
                                    </td>
            
                                    <td class="cost">
                                        <p>$<?=number_format($order['total'],2);?></p>
                                    </td>

                                    <?php 
                                        $order_status = $order['status'];
                                        switch ($order_status) {
                                            case 'delivered':
                                                ?>
                                                <td class="status">            
                                                    <p class="delivered"><?=$order_status;?></p>
                                                </td>
                                                <?php
                                                break;
                                            
                                            case 'canceled':
                                                ?>
                                                <td class="status">            
                                                    <p class="canceled"><?=$order_status;?></p>
                                                </td>
                                                <?php
                                                break;

                                            case 'on the way':
                                                ?>
                                                <td class="status">            
                                                    <p class="OTW"><?=$order_status;?></p>
                                                </td>
                                                <?php
                                                break;

                                            default:
                                                ?>
                                                <td class="status" style="text-transform: capitalize;">            
                                                    <p><?=$order_status;?></p>
                                                </td>
                                                <?php
                                                break;
                                        }
                                    ?>
                                    <td class="payments">
                                        <p><?=$order['payment_method'];?></p>
                                    </td>
            
                                    <td class="action">
                                        <a href="<?=ROOT_URL?>admin/orderDetails.php?id=<?=$order['order_id'];?>">
                                            <i class="uil uil-file-info-alt icon"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif?>
                    </table>
                </div>
            </div>
         </div>
    </div>

<?php include 'includes/footer.php'; ?>