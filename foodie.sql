-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 12:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodie`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `name`, `phone`, `password`, `image`) VALUES
(1, 'admin', 'admin@admin.com', 'Admin', '+4421257', '$2y$10$n0kMz/1FZ019U4ucJ.3zAeQi.QOhv5dQYOG8G1CYjxSPK4JB9OGzq', 'jamie_oliver.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `quantity` decimal(6,2) NOT NULL,
  `total_cost` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(20) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `name`, `description`, `category`, `temperature`, `price`, `image`, `created_at`, `deleted`) VALUES
(1, 'Strawberry Cornflakes', 'Crunchy cornflakes infused with the sweet taste of strawberries.', 'dessert', 'cold', 6.00, 'CornflakesWithStrawberry.png', '2024-06-11 12:54:02', 0),
(2, 'Beef Steak', 'Juicy, tender beef steak grilled to perfection, seasoned with a blend of herbs and spices for an irresistible flavor.', 'localfood', 'warm', 15.60, 'BeefSteak.png', '2024-06-11 13:17:34', 0),
(3, 'Italian Pasta', 'Italian pasta is a versatile, durum wheat staple of Italian cuisine, often paired with savory sauces.', 'localfood', 'warm', 12.00, 'ItalianPasta.png', '2024-06-11 13:20:45', 0),
(4, 'Caridean Shrimp ', 'Caridean shrimp are small, diverse crustaceans found in both freshwater and marine environments.', 'localfood', 'warm', 25.00, 'Caridean Shrimp.png', '2024-06-11 13:24:43', 0),
(5, 'Orange Juice', 'Vitamin C-packed beverage squeezed from fresh oranges and refreshing taste.', 'drinks', 'cold', 4.30, 'OrangeJuice.png', '2024-06-12 10:15:39', 0),
(6, 'Lemon Water', 'Enjoy the simple blend of fresh lemon juice and water. Stay hydrated during summer days.', 'drinks', 'cold', 3.20, 'LemonWater.png', '2024-06-12 10:18:18', 0),
(7, 'Smoothie', 'Refreshing blend of strawberries, creamy goodness.', 'dessert', 'cold', 6.50, 'Smoothie.png', '2024-06-12 10:52:31', 0),
(8, 'Brownie', 'Chocolate heaven in a single square. Rich indulgence in every bite.', 'cakes', 'warm', 5.20, 'Brownie.png', '2024-06-12 10:53:14', 0),
(9, 'Fruit Cake', 'Bursting with fruity goodness and slice of joy and delight.', 'cakes', 'cold', 14.80, 'FruitCake.png', '2024-06-12 10:57:54', 0),
(10, 'Kiwi Smoothie', 'Indulge in the refreshing tang of our Kiwi Smoothie!', 'dessert', 'cold', 6.00, 'KiwiSmoothie.png', '2024-06-12 11:00:48', 0),
(11, 'Gyros', 'A delicious blend of seasoned meat, such as lamb, beef, or chicken, roasted to perfection and thinly sliced.', 'fastfood', 'warm', 3.10, 'Gyros.png', '2024-06-12 11:06:10', 0),
(12, 'Ice Cream', 'Creamy and cold. Cool off with our irresistible ice cream.', 'dessert', 'cold', 2.60, 'IceCream.png', '2024-06-12 11:08:38', 0),
(13, 'Fruit Brownie', 'A fusion of rich chocolate and succulent fruit flavors.', 'cakes', 'warm', 5.50, 'FruitBrownie.png', '2024-06-12 11:10:53', 0),
(14, 'Blueberry Cake', 'Dive into a sumptuous symphony of fresh blueberries.', 'cakes', 'cold', 8.60, 'BlueberryCake.png', '2024-06-12 11:15:30', 0),
(15, 'Coctail Blue Hawai', 'A tropical escape in a glass, blending rum, blue curaçao and pineapple juice.', 'drinks', 'cold', 7.00, 'CoctailBlueHawai.png', '2024-06-12 11:26:57', 0),
(16, 'Coca-Cola', 'The iconic fizzy beverage loved worldwide for its crisp, refreshing taste.', 'drinks', 'cold', 2.80, 'CocaCola.png', '2024-06-12 11:28:29', 0),
(17, 'Sprite', 'The iconic fizzy beverage loved worldwide for its crisp, refreshing taste.', 'drinks', 'cold', 2.80, 'Sprite.png', '2024-06-12 11:29:10', 0),
(18, 'Fanta', 'The iconic fizzy beverage loved worldwide for its crisp, refreshing taste.', 'drinks', 'cold', 2.80, 'Fanta.png', '2024-06-12 11:29:32', 0),
(19, 'test', 'test', 'drinks', 'warm', 5.00, 'new (9).png', '2024-06-19 14:14:53', 1),
(20, 'Pepsi', 'The iconic fizzy beverage loved worldwide for its crisp, refreshing taste.', 'drinks', 'cold', 2.80, 'Pepsi.png', '2024-06-21 08:53:58', 0),
(21, 'Salmon', 'Savor our succulent salmon, expertly cooked and paired with your choice of seasonal vegetables.', 'localfood', 'warm', 25.00, 'salmon.png', '2024-06-21 09:00:01', 0),
(22, 'Pizza', 'Deliciously topped and freshly baked, our pizza offers a perfect blend of savory tomato sauce and melted cheese.', 'fastfood', 'warm', 8.40, 'pizza.png', '2024-06-21 09:08:21', 0),
(23, 'Burger', 'Juicy beef patty topped with melted cheese, fresh lettuce, tomato slices, and tangy pickles between soft seed buns.', 'fastfood', 'warm', 9.35, 'burger.png', '2024-06-21 09:14:24', 0),
(24, 'French Fries', 'Crispy golden fries, perfectly salted and served hot for a deliciously satisfying snack or side dish.', 'fastfood', 'warm', 4.50, 'frenchFries.png', '2024-06-21 09:19:50', 0),
(25, 'Burrito', 'A flour tortilla wrapped around a savory combination of beans, rice, chicken meat, cheese, and salsa.', 'fastfood', 'warm', 5.00, 'burrito.png', '2024-06-21 09:24:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `total` double(6,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) NOT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `session_id`, `firstname`, `lastname`, `phone`, `email`, `delivery_address`, `message`, `total`, `status`, `payment_method`, `created_at`, `updated_by`, `updated_date`) VALUES
(39, 'ieo1r7kh376188fp2g7rib90lf', 'Nebojsa', 'Mihajilovic', '+381611445984', 'n.mihajilovic@hotmail.com', 'Beograd, Trgovacka 12, 15', 'asap', 43.00, 'delivered', 'Dining', '2024-06-16 19:22:55', 'admin', '2024-06-18 14:27:39'),
(40, 'gn2tt7jdo3ce7eu4e58eg6m73e', 'Sinisa', 'Petrovic', '+3812421457', 'sinisa@petrovic.com', 'Resnik, Heroji 12, 5b', 'lorem2552m3o95m2953m9250m ', 11.20, 'on the way', 'C.O.D', '2024-06-17 15:24:04', 'admin', '2024-06-21 16:02:29'),
(41, 'fh0bk1rv1p2reuob0jeeh98miq', 'Novak', 'Djokovic', '09529494823', 'djoker@nole.com', 'Monaco, Kings 234, 5b', '', 14.80, 'ordered', 'Dining', '2024-06-18 11:37:54', 'admin', '2024-06-22 12:35:32'),
(42, 'c4qm7cj29v9nhlg2f14m5j6s3e', 'Test', 'Test', '442012345678', 'test@test.com', 'test, test, 2', 'test', 14.35, 'delivered', 'C.O.D', '2024-06-21 16:00:36', 'admin', '2024-06-22 12:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `food_id`, `name`, `quantity`) VALUES
(67, 39, 1, 'Strawberry Cornflakes', 1),
(68, 39, 10, 'Kiwi Smoothie', 2),
(69, 39, 4, 'Caridean Shrimp ', 1),
(70, 40, 11, 'Gyros', 2),
(71, 41, 9, 'Fruit Cake', 1),
(72, 42, 23, 'Burger', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `reviewer` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `reviewer`, `note`, `date`) VALUES
(1, 'Jane Smith', 'Absolutely loved the spicy tuna rolls at Sushi Haven! Fresh ingredients, perfect balance of flavors, and a nice kick of heat. Will definitely be coming back for more.', '2024-06-20'),
(2, 'Emily Johnson', 'The barbecue ribs at Smokey\'s Grill are out of this world! Tender, juicy, and packed with flavor. The smoky sauce is the perfect complement. Will definitely visit again soon.', '2024-06-20'),
(3, 'Mark Thompson', 'The chocolate lava cake at Sweet Delights is heavenly! The rich, gooey center and the perfect balance of sweetness make it a must-try dessert.', '2024-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `date`) VALUES
(1, 'rafael@gmail.com', '2024-06-20'),
(2, 'sipetrov@gmail.com', '2024-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `tablereservations`
--

CREATE TABLE `tablereservations` (
  `tablereservation_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `people` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `message` varchar(255) NOT NULL,
  `expenses` double(6,2) NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablereservations`
--

INSERT INTO `tablereservations` (`tablereservation_id`, `name`, `email`, `phone`, `people`, `date`, `time`, `message`, `expenses`, `updated_by`, `status`) VALUES
(1, 'Nebojsa Mihajilovic', 'n.mihajilovic@hotmail.com', '+381611445984', 4, '2024-06-14', '15:10:00', '123', 150.20, 'admin', 'closed'),
(2, 'Nebojsa Mihajilovic', 'n.mihajilovic@hotmail.com', '+381611445984', 4, '2024-06-14', '15:10:00', '123', 32.00, 'admin', 'closed'),
(3, 'Emily Johnson', 'test@test.com', '+381611445984', 1, '2024-06-14', '10:29:00', '', 25.00, 'admin', 'checked-in'),
(4, '123', 'admin@admin.com', '123', 4, '2024-11-19', '20:29:00', '244', 0.00, 'admin', 'reserved'),
(5, 'Aleksandar Mitrovic', 'mitrovic@gmail.com', '+448875117', 3, '2024-06-22', '11:00:00', '', 62.00, 'admin', 'reserved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tablereservations`
--
ALTER TABLE `tablereservations`
  ADD PRIMARY KEY (`tablereservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tablereservations`
--
ALTER TABLE `tablereservations`
  MODIFY `tablereservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
