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
                    <span><strong>Settings</strong> Page</span>
                </div>

            <?php 
                include 'includes/headerAdmin.php';
                $user = new User($conn);
                $admins = $user->getAdmin();
            ?>

            </div>

           <div class="mainBodyContentContainer">
                <div class="settingsPage">
                    <div class="heading flex">
                        <span>Personal Details</span>
                       
                        <!-- <span class="flex" style="gap: 1rem;">
                            <button class="btn">
                                <a href="addAdmin.php" class="flex">Add Admin <i class="uil uil-plus icon"></i></a>
                            </button>
                            <button class="btn">
                                <a href="addDb.php" class="flex">Add Delivery Boy <i class="uil uil-plus icon"></i></a>
                            </button>
                            <button class="btn">
                                <a href="administrators.php" class="flex">All Administrators <i class="uil uil-arrow-right icon"></i></a>
                            </button>
                        </span>
                         -->
                    </div>

                    <div class="informationContainer flex">
                    <?php foreach($admins as $admin ) :?>
                        <div class="imgDiv flex">
                            <img src="<?=ROOT_URL?>public/images/<?=$admin['image'];?>" alt="Account Admin Image">
                        </div>
                        <div class="detailsDiv grid">
                            
                                <span class="flex span id">
                                    <span>ID Number:</span>
                                    <span><?=$admin['admin_id'];?></span>
                                </span>
                                <span class="flex span">
                                    <span>Name:</span>
                                    <span><?=$admin['name'];?></span>
                                </span>
                                <span class="flex span">
                                    <span>User Name:</span>
                                    <span><?=$admin['username'];?></span>
                                </span>
                                <span class="flex span">
                                    <span>Phone:</span>
                                    <span><?=$admin['phone'];?></span>
                                </span>
                                <span class="flex span">
                                    <span>Email:</span>
                                    <span><?=$admin['email'];?></span>
                                </span>

                                <button class="btn" style="width: max-content;" >
                                    <a href="<?=ROOT_URL?>admin/updateMyDetails.php?id=<?=$admin['admin_id']?>" class="flex">Update Details<i class="uil uil-arrow-right icon"></i></a>
                                    </button>

                        </div>
                    <?php endforeach ?>
                    </div>

                </div>
           </div>

         </div>
    </div>


<?php include 'includes/footer.php'; ?>