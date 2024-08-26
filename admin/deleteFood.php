<?php 
    include '../app/config/config.php';
    include '../app/classes/Food.php';
    ob_start();

    $food = new Food($conn);
    $food_id = $_GET['id'];
    $deleteFood = $food->delete($food_id);
    $_SESSION['deletedFood'] = '<span class="success">Food Item deleted successfully!</span>';
    header('location:' .ROOT_URL. 'admin/adminMenu.php');
