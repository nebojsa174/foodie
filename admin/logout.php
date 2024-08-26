<?php 
    include '../app/config/config.php';
    include '../app/classes/User.php';
    ob_start();
    
    $user = new User($conn);
    $user->logout();

    header('location:'.ROOT_URL.'login');
    exit();