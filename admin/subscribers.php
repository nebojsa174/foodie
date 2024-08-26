<?php
    
    include 'includes/header.php';
    include '../app/classes/Cart.php';
    include '../app/classes/Order.php';
    ob_start();


    if(!isset($_SESSION['username'])) {
        header('location:'.ROOT_URL.'index.php');
        exit();
    }

    $orders = new Order($conn);
?>

    <div class="adminPage flex">
        <?php include 'includes/sideMenu.php' ?>


         <div class="mainBody">
            <div class="topSection flex">
                <div class="title">
                    <span><strong>Subscribers</strong> Page</span>
                </div>

                <?php 
                   if (isset($_SESSION['deleteSub'])) {
                    echo $_SESSION['deleteSub'];
                    unset($_SESSION['deleteSub']);
                   }
                ?>  

                <?php include 'includes/headerAdmin.php' ?>

            </div>

            <div class="mainBodyContentContainer">
                
                <?php
                    $user = new User($conn);
                    $subscribers = $user->getSubscribers();
                ?>
                
                    <div class="subscribers">
                        <table class="table">
                        <?php foreach ($subscribers as $subscriber) : ?>
                            <tr class="tblHeader">
                                <th>Subscriber ID</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <tr class="tblRow orderRow">
                                <td class="id"><p><?=$subscriber['id'];?></p></td>

                                <td class="contact">
                                    <p><?=$subscriber['email'];?></p>
                                </td>
        
                                <td class="date">            
                                    <p><?=$subscriber['date'];?></p>
                                </td>

                                <td class="action">
                                    <a href="<?=ROOT_URL?>admin/deleteSubscriber.php?id=<?=$subscriber['id'];?>">
                                        <i class="uil uil-times-circle icon"></i>
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