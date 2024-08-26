<?php 
    include '../app/config/config.php';
    include '../app/classes/User.php';
    ob_start();

    $user = new User($conn);
    $id = $_GET['id'];
    $delete = $user->deleteSubscriber($id);
    $_SESSION['deleteSub'] = '<span class="success">Subscriber deleted successfully!</span>';
    header('location:' .ROOT_URL. 'admin/subscribers.php');
