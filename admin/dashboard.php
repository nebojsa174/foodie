<?php 

  include 'includes/header.php';
  include '../app/classes/Cart.php';
  include '../app/classes/Order.php';
  include '../app/classes/TableReservation.php';
  include '../app/classes/Food.php';
  
  if(!isset($_SESSION['username'])) {
    header('location:'.ROOT_URL.'login.php');
    exit();
  }

  $orders = new Order($conn);
  $table = new TableReservation($conn);
  $food = new Food($conn);

  $totalExpenses = $table->totalExpenses();
  $totalDelivered = $orders->sumDelivered();
  $revenue = $totalDelivered + $totalExpenses;

  $orderNumbers = $orders->getNumberOfOrders();
  $deliveredOrderNumbers = $orders->getNumberOfDeliveredOrders();
  $numberOfReservations = $table->numberOfTableReservations();

  $popular = $food->getMostPopular();
?>

    <div class="adminPage flex">

        <?php include 'includes/sideMenu.php';?>

        <div class="mainBody">
            <div class="topSection flex">
                <div class="title">
                    <span><strong>Foodie</strong> Dashboard</span>
                </div>
                <?php include 'includes/headerAdmin.php'; ?>
            </div>

            <div class="mainBodyContentContainer">
                <div class="summarySection grid">
                    <div class="summaryCard">
                      <span class="flex"> 
                          <img src="..public/images/cart.png" alt="">
                          <span class="cardTitle">
                               Total Orders
                          </span>
                      </span>
                      <h1 class="count">
                          <?=$orderNumbers?>
                      </h1>
  
                      <span class="overlayText"><?=$orderNumbers?></span>
                    </div>
  
                    <div class="summaryCard">
                      <span class="flex">
                          <img src="../public/images/clock.png" alt="">
                          <span class="cardTitle">
                            Delivered Orders
                       </span>
                      </span>
                      <h1 class="count">
                           <?=$deliveredOrderNumbers?>
                      </h1>
  
                      <span class="overlayText"><?=$deliveredOrderNumbers?></span>
                    </div>
  
                    <div class="summaryCard">
                      <span class="flex">
                          <img src="../public/images/rating.png" alt="">
                          <span class="cardTitle">
                            Table Bookings
                       </span>
                      </span>
                      <h1 class="count">
                        <?=$numberOfReservations?>
                      </h1>
  
                      <span class="overlayText"><?=$numberOfReservations?></span>
                    </div>
  
                    <div class="summaryCard incomeCard">
                      <span class="flex">
                          <img src="../public/images/customer.png" alt="">
                          <span class="cardTitle">
                            Total Income
                       </span>
                      </span>
                      <h1 class="count">
                          $<?=number_format($revenue,2)?>
                      </h1>
  
                      <span class="overlayTextTotal"><?=number_format($revenue,2)?></span>
                    </div>
              </div>
  
              <div class="categoriesSection ">
                 <div class="secHeader flex">
                  <div class="subTitle">
                      <h3><strong>Food</strong> Categories</h3>
                  </div>
                  <div class="btn">
                      <a href="adminMenu.php">
                        See All <i class="uil uil-angle-right icon"></i>
                      </a>
                  </div>
                 </div>
  
                 <div class="optionMenu flex">
                  <div class=" option">
                    <img src="../public/images/diet.png" alt="Best Online food delivery in Nigeria">
                    <small>Foods</small>
                  </div>
                  <div class=" option">
                    <img src="../public/images/drink.png" alt="Best Online restaurant in Nigeria">
                    <small>Drinks</small>
                  </div>
                  <div class=" option" >
                    <img src="../public/images/pizza.png" alt="Food Image">
                    <small>Fast Food</small>
                  </div>
                  <div class=" option">
                    <img src="../public/images/cake.png" alt="Best Online restaurant in Nigeria">
                    <small>Party</small>
                  </div>
                  <div class=" option">
                    <img src="../public/images/dessert.png" alt="Best Online restaurant in Nigeria">
                    <small>Dessert</small>
                  </div>
              </div>
              </div>
  
              <div class="mostOrdered">
                  <div class="secHeader flex">
                      <div class="subTitle">
                          <h3><strong>Most</strong> Ordered Food</h3>
                      </div>
                  </div>
                  <div class="flex popularItemsContainer">
                    <?php foreach($popular as $popular_food) : ?>
                      <div class="singleItem">
                          <div class="imgDiv">
                              <img src="<?=ROOT_URL?>public/food_images/<?=$popular_food['image'];?>">
                          </div>
                          <div class="itemInfo">
                              <span class="itemName"><?=$popular_food['name'];?></span>
                              <p class="desc"><?=$popular_food['description'];?></p>
                          </div>
                      </div>
                    <?php endforeach ?>
                  </div>
              </div>
            </div>
         </div>
    </div>

<?php include 'includes/footer.php';?>