<?php

    include 'includes/header.php';
    include '../app/classes/Food.php';
    ob_start();

    if(!isset($_SESSION['username'])) {
        header('location:'.ROOT_URL.'index.php');
        exit();
    }

    $food = new Food($conn);


    if(isset($_POST['submit'])) {

        $name = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $temperature = $_POST['temperature'];
        $price = $_POST['price'];
        $name_url = $food->createUrl($name);

        if(isset($_FILES['image']['name'])) {

            $image = $_FILES['image']['name'];
            $imageSource = $_FILES['image']['tmp_name'];
            $imageDestination = "../public/food_images/".$image;
            
            $uploadImage = move_uploaded_file($imageSource, $imageDestination);

            if($uploadImage == false) {
                $_SESSION['imgUpload']  = '<span class="fail">Failed to upload image!</span>';
            }
        } else {
            $image = "";
        }

        $addFood = $food->add($name, $name_url, $description, $category, $temperature, $price, $image);
        $_SESSION['addedFood'] = '<span class="success">Food Added Successfully!</span>';
        header('location:'.ROOT_URL. 'admin/adminMenu.php');
        exit();
    }

?>

    <div class="adminPage flex">
        <?php include 'includes/sideMenu.php' ?>

        <div class="mainBody">
            <div class="topSection flex">
                <div class="title">
                    <span><strong>Add Food</strong> Item</span>
                </div>

                <?php include 'includes/headerAdmin.php' ?>
            </div>

            <div class="mainBodyContentContainer">
                <div class="settingsPage updateSettings">
                    <div class="heading flex">
                        <span>Fill the form below</span>
                        <?php
                        if (isset($_SESSION['addedFood'])) {
                            echo $_SESSION['addedFood'];
                            unset($_SESSION['addedFood']);
                        }
                        ?>
                        <button class="btn">
                            <a href="adminMenu.php" class="flex">All Food <i class="uil uil-arrow-right icon"></i></a>
                        </button>
                    </div>

                    <div class="informationContainer flex">
                        <form method="post" enctype="multipart/form-data" class="flex">
                            <div class="grid">
                                <span class="flex span">
                                    <label for="name">Food Name</label>
                                    <input type="text" name="name" placeholder="Item Name" required>
                                </span>
                                <span class="flex span ">
                                    <label for="Username">Description</label>
                                    <textarea name="description" placeholder="Describe the item" required></textarea>
                                </span>
                                <span class="flex span">
                                    <label for="temperature">Temperature</label>
                                    <input type="text" name="temperature" placeholder="Item Temperature" required>
                                </span>
                                <span class="flex span">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" placeholder="Item price" required>
                                </span>

                            </div>

                            <div class="grid">
                                <span class="flex span">
                                    <label for="Picture">Food Image</label>
                                    <input type="file" name="image" required>
                                </span>
                                <span class="flex span">
                                    <label for="Picture">Food Category</label>
                                    <select name="category" required>
                                        <option value="localfood"> Local Food</option>
                                        <option value="drinks">Drinks</option>
                                        <option value="fastfood">Fast Food</option>
                                        <option value="cakes">Cakes</option>
                                        <option value="dessert">Dessert</option>

                                    </select>
                                </span>
                                <button class="btn bg" name="submit">Add Item</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php include 'includes/footer.php'; ?>