<?php
ob_start(); // Start output buffering
include 'includes/header.php';
include '../app/classes/Food.php';
include '../app/classes/Cart.php';
include '../app/classes/Order.php';

if (!isset($_SESSION['username'])) {
    header('location:' . ROOT_URL . 'index.php');
    exit();
}

$orders = new Order($conn);
$food = new Food($conn);
$food_id = $_GET['id'];

$currentFood = $food->getFoodId($food_id);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = (float) preg_replace('/[^\d.]/', '', $_POST['price']);
    $category = $_POST['category'];

    // Fetch the existing image if a new image is not uploaded
    $existingImage = $_POST['existing_image'];

    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $imageSource = $_FILES['image']['tmp_name'];
        $imageDestination = "../public/food_images/" . $image;

        $uploadImage = move_uploaded_file($imageSource, $imageDestination);

        if ($uploadImage === false) {
            $_SESSION['imgUpload'] = '<span class="fail">Failed to upload image!</span>';
        }
    } else {
        $image = $existingImage; // Use the existing image if no new image is uploaded
    }

    $updateFood = $food->update($name, $description, $price, $image, $category, $food_id);

    $_SESSION['updatedFood'] = '<span class="success">Food Details Updated Successfully!</span>';
    header('location:' . ROOT_URL . 'admin/adminMenu.php');
    exit();
}
?>

<div class="adminPage flex">
    <?php include 'includes/sideMenu.php'; ?>
    <div class="mainBody">
        <div class="topSection flex">
            <div class="title">
                <span><strong>Update Food</strong> Item</span>
            </div>
            <?php include 'includes/headerAdmin.php'; ?>
        </div>

        <div class="mainBodyContentContainer">
            <div class="settingsPage updateSettings">
                <div class="heading flex">
                    <span>Fill the form below</span>
                    <button class="btn">
                        <a href="adminMenu.php" class="flex">All Food <i class="uil uil-arrow-right icon"></i></a>
                    </button>
                </div>

                <div class="informationContainer flex">
                    <?php foreach ($currentFood as $food) : ?>
                        <form method="post" enctype="multipart/form-data" class="flex">
                            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($food['image']); ?>">
                            <div class="grid">
                                <span class="flex span">
                                    <label for="name">Food Name</label>
                                    <input type="text" name="name" value="<?= htmlspecialchars($food['name']); ?>">
                                </span>
                                <span class="flex span">
                                    <label for="description">Description</label>
                                    <textarea name="description"><?= htmlspecialchars($food['description']); ?></textarea>
                                </span>
                                <span class="flex span">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" value="<?= htmlspecialchars('$' . $food['price']); ?>">
                                </span>
                            </div>
                            <div class="grid">
                                <span class="flex span">
                                    <label for="image">Food Image</label>
                                    <?php if (!empty($food['image'])): ?>
                                        <img src="<?= ROOT_URL ?>public/food_images/<?= htmlspecialchars($food['image']); ?>" alt="Food Image" style="max-width: 150px;">
                                    <?php endif; ?>
                                    <input type="file" name="image">
                                </span>

                                <span class="flex span">
                                    <label for="category">Food Category</label>
                                    <select name="category">
                                        <option value="localfood" <?= ($food['category'] == 'localfood') ? 'selected' : ''; ?>>Local Food</option>
                                        <option value="drinks" <?= ($food['category'] == 'drinks') ? 'selected' : ''; ?>>Drinks</option>
                                        <option value="fastfood" <?= ($food['category'] == 'fastfood') ? 'selected' : ''; ?>>Fast Food</option>
                                        <option value="cakes" <?= ($food['category'] == 'cakes') ? 'selected' : ''; ?>>Cakes</option>
                                        <option value="dessert" <?= ($food['category'] == 'dessert') ? 'selected' : ''; ?>>Dessert</option>
                                    </select>
                                </span>
                                <button class="btn bg" name="submit">Update Food</button>
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
include 'includes/footer.php'; 
?>
