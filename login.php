<?php

    include 'includes/header.php';
    include 'app/classes/User.php';
    
    $user = new User($conn);

    if($user->isLogged()) {
        header('location:'.ROOT_URL.'admin/dashboard.php');
        
        exit();
    }

    if(isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

            
        $login = $user->login($username, $password);

        if($login) {
            header('location:'.ROOT_URL.'admin/dashboard.php');
            exit();
        } else {
            $_SESSION['login'] = '<span class="fail" style="color: red;">Incorrect Credentials!</span>';
        }
    }
?>

    <!-- Login -->
    <div class="section container loginPage flex">
        <div class="pageContent">
            <h1 class="title">Login Here!</h1>
            <p>Enter your credentials</p>
            <?php 
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                if(isset($_SESSION['credentialsChanged'])){
                    echo $_SESSION['credentialsChanged'];
                    unset($_SESSION['credentialsChanged']);
                }
            ?>
            <form method="POST">
                <div class="input">
                    <label for="name">Username</label>
                    <input type="text" id="name" name="username" placeholder="Enter Username" required>

                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                </div>
                <button class="btn flex" name="submit"> Login <i class="uil uil-signin icon"></i></button>

            </form>

            <p class="text">Having Trouble Logging In? <br> Contact Admin</p>

            <img src="./public/images/floating2.png" alt="">
        </div>
        <img src="./public/images/floating2.png" alt="" class="designImage1">
        <img src="./public/images/floating1.png" alt="" class="designImage2">
    </div>

<?php include 'includes/footer.php'; ?>