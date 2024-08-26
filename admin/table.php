<?php 

    include 'includes/header.php';
    include '../app/classes/TableReservation.php';
    include '../app/classes/Cart.php';
    include '../app/classes/Order.php';

    ob_start();

    if(!isset($_SESSION['username'])) {
        header('location:'.ROOT_URL.'index.php');
        exit();
    }

    $orders = new Order($conn);
    $tableRservation = new TableReservation($conn);

    $allReservations = $tableRservation->getAll();
?>

    <div class="adminPage flex">  

        <?php include 'includes/sideMenu.php'; ?>

         <div class="mainBody">
            <div class="topSection flex">
                <div class="title">
                    <span><strong>Table Reservations</strong> Page</span>
                </div>
                <?php 
                   if (isset($_SESSION['reservationUpdated'])) {
                    echo $_SESSION['reservationUpdated'];
                    unset($_SESSION['reservationUpdated']);
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
                            <th>Date</th>
                            <th>Time</th>
                            <th>People</th>
                            <th>Billed</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($allReservations as $reservation) : ?>
                            <tr class="tblRow orderRow">
                                <td class="id"><?=$reservation['tablereservation_id'];?></td>
                                <td class="customerName">
                                <span class="name" style="text-transform:capitalize"><?=$reservation['name'];?></span>
                                </td>

                                <td class="contact">
                                    <p><?=$reservation['phone'];?></p>
                                </td>

                                <td class="date">
                                    <p><?=$reservation['date'];?></p>
                                </td>
                                <td class="date">
                                    <p><?=$reservation['time'];?></p>
                                </td>

                                <td class="occupancy">
                                    <p><?=$reservation['people'];?></p>
                                </td>

                                <td class="billedAmount">
                                    <p>$<?=number_format($reservation['expenses'],2)?></p>
                                </td>
                                
                                <?php 
                                        $tableReservationStatus = $reservation['status'];
                                        switch ($tableReservationStatus) {
                                            case 'checked-in':
                                                ?>
                                                <td class="status">            
                                                    <p class="delivered"><?=$tableReservationStatus;?></p>
                                                </td>
                                                <?php
                                                break;
                                            
                                            case 'canceled':
                                                ?>
                                                <td class="status">            
                                                    <p class="canceled"><?=$tableReservationStatus;?></p>
                                                </td>
                                                <?php
                                                break;

                                            case 'closed':
                                                ?>
                                                <td class="status">            
                                                    <p class="OTW"><?=$tableReservationStatus;?></p>
                                                </td>
                                                <?php
                                                break;

                                            default:
                                                ?>
                                                <td class="status" style="text-transform: capitalize;">            
                                                    <p><?=$tableReservationStatus;?></p>
                                                </td>
                                                <?php
                                                break;
                                        }
                                    ?>

                                    <td class="action">
                                        <a href="<?=ROOT_URL?>admin/tableDetails.php?id=<?=$reservation['tablereservation_id'];?>">
                                            <i class="uil uil-file-info-alt icon"></i>
                                        </a>
                                    </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
         </div>
    </div>



<?php include 'includes/footer.php'; ?>