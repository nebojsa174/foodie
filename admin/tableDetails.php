<?php

    include 'includes/header.php';
    include '../app/classes/TableReservation.php';
    include '../app/classes/Cart.php';
    include '../app/classes/Order.php';
    ob_start();

    if (!isset($_SESSION['username'])) {
        header('location:' . ROOT_URL . 'index.php');
        exit();
    }

    $orders = new Order($conn);

    $id = $_GET['id'];

    $reservation = new TableReservation($conn);
    $new_reservation = $reservation->getDetails($id);
    $reservationStatus = $reservation->getReservationStatus($id);
    
    if(isset($_POST['submit'])) {
        
        $status = $_POST['status'];
        $updated = $_POST['updated'];
        $expenses = $_POST['expenses'];

        $update = $reservation->updateReservation($status, $updated, $expenses, $id);
        $_SESSION['reservationUpdated'] = '<span class="success">Reservation Updated Successfully!</span>';
        header('location:'.ROOT_URL.'admin/table.php');
        exit();
    }
?>

<div class="adminPage flex">

    <?php include 'includes/sideMenu.php'; ?>

    <div class="mainBody">
        <div class="topSection flex">
            <div class="title">
                <span><strong>Table Reservations</strong> Details</span>
            </div>
            <?php include 'includes/headerAdmin.php'; ?>
        </div>

        <div class="mainBodyContentContainer">
            <div class="heading flex">
                <span>#<?=$id?> Reservation Details</span>
                <button class="btn">
                    <a href="table.php" class="flex">All Reservations <i class="uil uil-arrow-right icon"></i></a>
                </button>
            </div>
            <div class="orderDetails flex">
                <div class="amountDiv">
                    <h3 class="title flex">
                        Expenses Fees: <img src="<?=ROOT_URL?>public/images/order.png" alt="Icon">
                    </h3>

                    <span class="cartList flex">
                        <span class="subTitle">
                            Total:
                        </span>
                        <?php foreach($new_reservation as $expenses) : ?>
                        <span class="gradCost">
                            $<?=number_format($expenses['expenses'],2)?>
                        </span>
                        <?php endforeach ?>
                    </span>

                    <div class="updateOrderDiv">
                        <h3 class="updateOrderTitle flex">
                            Upadate Reservation
                        </h3>

                        <form method="post">
                            <div class="inputDiv flex">
                                <label for="tl">Expenses</label>
                                <input type="text" name="expenses" value="<?=number_format($expenses['expenses'],2)?>">
                            </div>
                            <div class=" inputDiv flex">
                                <label>Status</label>
                                <select name="status">
                                    <option value="reserved" <?= ($reservationStatus['status'] == 'reserved') ? 'selected' : ''; ?>>Reserved</option>
                                    <option value="canceled" <?= ($reservationStatus['status'] == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                    <option value="checked-in" <?= ($reservationStatus['status'] == 'checked-in') ? 'selected' : ''; ?>>Checked-in</option>
                                    <option value="closed" <?= ($reservationStatus['status'] == 'closed') ? 'selected' : ''; ?>>Closed</option>
                                </select>
                            </div>
                            <input type="hidden" name="updated" value="<?=$_SESSION['username'];?>">
                            <button name="submit" class="btn">Update Reservation</button>
                        </form>
                    </div>

                </div>

            </div>

            <div class="customerDetails grid">
                <?php foreach($new_reservation as $new_reservation_details) : ?>
                    <div class="heading flex">
                        <span>Guest Information</span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Guest Name:</span>
                        <span class="detail"><?=$new_reservation_details['name'];?></span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Email:</span>
                        <span class="detail"><?=$new_reservation_details['email'];?></span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Phone:</span>
                        <span class="detail"><?=$new_reservation_details['phone'];?></span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Total Guests:-</span>
                        <span class="detail"><?=$new_reservation_details['people'];?></span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Date:</span>
                        <span class="detail"><?=$new_reservation_details['date'];?></span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Time:</span>
                        <span class="detail"><?=$new_reservation_details['time'];?></span>
                    </div>
                    <div class="singleDetail flex">
                        <span class="dTitle">Message:</span>
                        <span class="detail"><?=$new_reservation_details['message'];?></span>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="customerDetails grid">
                <div class="heading flex">
                    <span>Reservation Notes</span>
                </div>
                <div class="singleDetail flex">
                    <span class="detail">This reservation was last updated by;</span>

                </div>
                <div class="singleDetail  flex">
                    <span class="dTitle">Admin Name:</span>
                    <span class="detail" style="text-transform: capitalize;"><?=$new_reservation_details['updated_by'];?></span>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>