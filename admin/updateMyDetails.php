<?php 
    ob_start(); // Start output buffering
    include 'includes/header.php';
    include '../app/classes/Cart.php';
    include '../app/classes/Order.php';
    include '../app/classes/User.php'; // Include User class

    if (!isset($_SESSION['username'])) {
        header('location:'.ROOT_URL.'index.php');
        exit();
    }

    $id = $_GET['id'];
    $orders = new Order($conn);
    $user = new User($conn);
    $getAdmin = $user->getAdminById($id);

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Fetch existing image from the hidden input
        $existingImage = $_POST['existing_image'];

        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $imageSource = $_FILES['image']['tmp_name'];
            $imageDestination = "../public/profile_images/".$image;
            
            $uploadImage = move_uploaded_file($imageSource, $imageDestination);

            if ($uploadImage === false) {
                $_SESSION['imgUpload'] = '<span class="fail">Failed to upload image!</span>';
                $image = $existingImage; // Retain existing image if upload fails
            }
        } else {
            $image = $existingImage; // Use the existing image if no new image is uploaded
        }

        $updateAdmin = $user->updateAdmin($username, $email, $name, $phone, $hashed_password, $image, $id);
        $_SESSION['credentialsChanged'] = '<span class="fail" style="color: red;">Login Again!</span>';
        header('location:'.ROOT_URL. 'admin/settings.php');
        exit();
    }
?>

<div class="adminPage flex">
    <?php include 'includes/sideMenu.php' ?>
    <div class="mainBody">
        <div class="topSection flex">
            <div class="title">
                <span><strong>Update</strong> Details</span>
            </div>
            <?php include 'includes/headerAdmin.php'; ?>
        </div>

        <div class="mainBodyContentContainer">
            <div class="settingsPage updateSettings">
                <div class="heading flex">
                    <span>Personal Details</span>
                </div>

                <div class="informationContainer flex">
                    <?php foreach ($getAdmin as $admin) : ?>
                        <form method="post" enctype="multipart/form-data" class="flex">
                            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($admin['image']); ?>">
                            <div class="grid">
                                <span class="flex span">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="<?= htmlspecialchars($admin['name']); ?>">
                                </span>
                                <span class="flex span">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" value="<?= htmlspecialchars($admin['username']); ?>">
                                </span>
                                <span class="flex span">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" value="<?= htmlspecialchars($admin['phone']); ?>">
                                </span>
                            </div>
                            <div class="grid">
                                <span class="flex span">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="<?= htmlspecialchars($admin['email']); ?>">
                                </span>
                                <span class="flex span">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" placeholder="Enter Password">
                                </span>
                                <span class="flex span">
                                    <label for="image">Profile Picture</label>
                                    <?php if (!empty($admin['image'])): ?>
                                        <img src="<?= ROOT_URL ?>public/images/<?= htmlspecialchars($admin['image']); ?>" alt="Profile Image" style="max-width: 150px;">
                                    <?php endif; ?>
                                    <input type="file" name="image">
                                </span>
                                <button class="btn bg" name="submit">Update Admin</button>
                            </div>
                        </form>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
ob_end_flush();
include 'includes/footer.php'; ?>
