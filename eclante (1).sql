-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 10:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclante`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(6) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `is_default` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `name`, `address`, `city`, `state`, `zip`, `phone`, `is_default`) VALUES
(22, 14, 'kang', 'gangnapur', 'Debagram', 'West Bengal', 741238, '06295322035', 0),
(34, 14, 'test 1', 'gangnapur', 'Debagram', 'West Bengal', 741238, '06295322035', 0),
(35, 14, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, '06295322035', 0),
(36, 14, 'kang', 'gangnapur', 'Debagram', 'West Bengal', 741238, '06295322035', 1),
(37, 14, 'test 1', 'gangnapur', 'Debagram', 'West Bengal', 741238, '06295322035', 0),
(40, 48, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, '06295322035', 0),
(41, 48, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, '06295322035', 0),
(48, 40, 'kang', 'gangnapur', 'Debagram', 'West Bengal', 741238, '06295322035', 0),
(53, 40, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, '06295322035', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(111) NOT NULL,
  `user_id` int(55) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `time` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `price`, `time`) VALUES
(150, 13, 2, 1, 839.30, 2147483647),
(187, 40, 8, 2, 0.00, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_code` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_verifications`
--

INSERT INTO `email_verifications` (`id`, `user_id`, `verification_code`, `created_at`) VALUES
(1, 20, '144798', '2024-05-30 18:51:35'),
(2, 21, '654307', '2024-05-30 20:09:16'),
(3, 22, '857041', '2024-05-30 20:12:10'),
(4, 23, '767260', '2024-05-30 20:16:16'),
(5, 24, '978829', '2024-05-30 20:27:10'),
(6, 25, '430951', '2024-05-30 20:32:21'),
(7, 26, '602779', '2024-05-30 20:36:19'),
(8, 27, '609364', '2024-05-30 20:40:16'),
(9, 28, '257655', '2024-05-30 20:53:08'),
(10, 29, '589105', '2024-05-30 20:58:13'),
(11, 30, '497098', '2024-05-30 21:00:14'),
(12, 31, '279810', '2024-05-30 21:00:45'),
(13, 32, '362814', '2024-05-30 21:15:36'),
(14, 33, '764733', '2024-05-30 21:17:51'),
(15, 34, '444826', '2024-05-30 21:20:28'),
(16, 35, '944190', '2024-05-30 21:58:52'),
(17, 36, '724701', '2024-05-30 22:01:16'),
(18, 37, '727401', '2024-05-30 22:05:23'),
(19, 38, '400560', '2024-05-30 22:11:39'),
(20, 39, '082956', '2024-05-30 22:14:39'),
(21, 40, '389555', '2024-05-30 22:15:57'),
(22, 41, '704184', '2024-05-30 22:22:33'),
(23, 42, '681793', '2024-05-30 22:25:34'),
(24, 43, '828124', '2024-05-30 22:26:14'),
(25, 44, '013263', '2024-05-31 18:55:46'),
(26, 45, '382069', '2024-05-31 18:56:54'),
(27, 46, '227847', '2024-05-31 19:47:20'),
(28, 47, '376491', '2024-05-31 19:53:46'),
(29, 48, '860326', '2024-05-31 20:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(63, 40, 5, '2024-06-04 15:10:16'),
(64, 40, 7, '2024-06-04 15:10:30'),
(65, 40, 1, '2024-06-04 17:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `ordered-products`
--

CREATE TABLE `ordered-products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered-products`
--

INSERT INTO `ordered-products` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(62, 39, 4, 1),
(63, 40, 4, 3),
(64, 41, 4, 6),
(65, 41, 1, 1),
(66, 42, 2, 1),
(67, 43, 7, 2),
(68, 43, 5, 2),
(69, 44, 2, 4),
(72, 47, 4, 1),
(73, 48, 2, 1),
(74, 48, 1, 1),
(75, 48, 4, 1),
(76, 49, 2, 1),
(77, 50, 4, 1),
(78, 50, 6, 1),
(79, 51, 2, 1),
(80, 51, 5, 1),
(81, 51, 7, 1),
(82, 52, 4, 1),
(83, 53, 6, 1),
(84, 54, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(6) NOT NULL,
  `phone` int(12) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `city`, `state`, `zip`, `phone`, `payment_method`, `created_at`, `user_id`, `total`, `status`) VALUES
(39, 'test 1', 'gangnapur', 'Debagram', 'West Bengal', 0, 2147483647, 'creditCard', '2024-05-24 14:40:56', 13, 806.10, ''),
(40, 'test 1', 'gangnapur', 'Debagram', 'West Bengal', 741238, 2147483647, 'paypal', '2024-05-24 14:42:20', 13, 2424.30, ''),
(41, 'Kangkana Sen', 'Gangnapur,Nadia', 'Debagram', 'West Bengal', 741238, 2147483647, 'cashOnDelivery', '2024-05-25 10:05:37', 13, 5253.80, ''),
(42, 'test 1', 'gangnapur', 'Debagram', 'West Bengal', 741238, 2147483647, 'paypal', '2024-05-27 23:14:13', 19, 839.30, ''),
(43, 'test 1', 'gangnapur', 'Debagram', 'West Bengal', 741238, 2147483647, 'paypal', '2024-05-27 23:15:06', 19, 2076.80, ''),
(47, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, 2147483647, 'PayPal', '2024-05-29 18:52:08', 40, 809.10, ''),
(48, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, 2147483647, 'Venmo', '2024-06-03 17:02:00', 40, 2047.60, 'cancelled'),
(49, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, 2147483647, 'paypal', '2024-06-03 16:47:48', 40, 839.30, 'cancelled'),
(50, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, 2147483647, 'Google Pay', '2024-06-03 19:29:08', 40, 1768.30, 'cancelled'),
(51, 'kangkana sen', 'barasat,genji mill', 'Debagram', 'West Bengal', 741236, 2147483647, 'creditCard', '2024-06-03 19:34:50', 40, 1877.70, 'pending'),
(53, 'kang', 'gangnapur', 'Debagram', 'West Bengal', 741238, 2147483647, 'Google Pay', '2024-06-04 15:11:07', 40, 959.20, 'pending'),
(54, 'kang', 'gangnapur', 'Debagram', 'West Bengal', 741238, 2147483647, 'PayPal', '2024-06-04 17:25:23', 40, 399.20, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `more_image_1` varchar(255) NOT NULL,
  `more_image_2` varchar(255) NOT NULL,
  `more_image_3` varchar(255) NOT NULL,
  `more_image_4` varchar(255) NOT NULL,
  `description_details` varchar(255) NOT NULL,
  `how_to_use` varchar(255) NOT NULL,
  `Ingredients` varchar(255) NOT NULL,
  `who_can_use` varchar(255) NOT NULL,
  `offer` decimal(10,2) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `mrp`, `description`, `image_url`, `more_image_1`, `more_image_2`, `more_image_3`, `more_image_4`, `description_details`, `how_to_use`, `Ingredients`, `who_can_use`, `offer`, `stock`) VALUES
(1, 'Radiance reveal elixir', 499.00, 'Enriched with Hyaluronic Acid & Botanical extracts', 'hero-product1.png', 'a1.png', 'a2.png', 'a3.png', 'a4.png', 'Indulge in the ultimate beauty ritual with our Radiance Reveal Elixir.\r\n This luxurious formula, inspired by the brilliance of éclat and the enchantment of French beauty, unveils a captivating glow within. \r\n Immerse your skin in the exquisite blend of hy', '<b>Cleanse:</b> Start with a clean face using a gentle cleanser.\r\n<b>Dispense:</b> Shake well, then apply a small amount of elixir to fingertips.\r\n<b>Apply:</b> Gently massage onto face in upward motions, avoiding the eye area.\r\n<b>Absorb:</b> Let the eli', 'Curd and Rice extracts.', 'All skin types.\r\nPerform a patch test first if you have sensitive skin.\r\nStore in a cool, dry place away from sunlight.\r\nApply sunscreen during the day for added protection.', 20.00, 100),
(2, 'Brilliance reveal face serum', 1199.00, 'This water-free solution contains a 5% concentration of retinoid.', 'ig5.jpg', 'ig10.jpg', 'ig9.jpg', 'ig12.jpg', 'ig11.jpg', 'Experience luminous beauty with our serum infused with Curd and Rice extracts. Inspired by French beauty secrets, it revitalizes and hydrates for a radiant complexion. Unlock your skin\'s inner glow with each luxurious drop.', '<b>1. Cleanse:</b> Begin with a clean face using a gentle cleanser. <b>2. Dispense:</b> Shake the serum well, then apply a small amount to your fingertips. <b>3. Apply:</b> Gently massage the serum onto your face in upward motions, avoiding the eye area. ', 'Honey and Strawberry extracts.', 'Suitable for all skin types, our Radiance Reveal Face Serum offers a luxurious experience for anyone seeking to enhance their skincare routine. Perform a patch test if you have sensitive skin. Store in a cool, dry place away from sunlight. For daytime use', 30.00, 100),
(4, 'Radiance reveal face cream', 899.00, 'Infused with vitamin C & Hyaluronic Acid for radiant glow', 'ig3.png', 'ig8.jpg', 'ig7.jpg', 'ig14.jpg', 'ig13.jpg', 'Unlock luminous skin with our luxurious cream infused with Curd and Rice extracts. Inspired by French skincare rituals, it deeply hydrates and revitalizes, leaving your complexion smooth and radiant. Embrace timeless beauty with every application.', '<b>1. Cleanse:</b> Begin with a clean face using a gentle cleanser.\r\n<b>2. Dispense:</b> Take a small amount of the cream onto your fingertips.\r\n<b>3. Apply:</b> Gently massage the cream onto your face and neck in upward motions, avoiding the eye area.\r\n<', 'Aqua (Water), Persea Gratissima (Avocado) Oil, Curd Extract, Hyaluronic Acid, Cetyl Alcohol, Glycerin, Stearic Acid, Glyceryl Stearate, Phenoxyethanol, Ethylhexylglycerin, Parfum (Fragrance), Citronellol, Limonene, Linalool.', 'Suitable for all skin types, our Radiance Reveal Face Cream offers a luxurious experience for anyone seeking to enhance their skincare routine.', 10.00, 200),
(5, 'Brilliance reveal elixir', 599.00, 'Illuminate your complexion with Elixir Light,designed to impart a natural glow.', 'rl1.jpg', 'rl2.jpg', 'rl3.jpg', 'rl4.jpg', 'rl5.jpg', 'Effortlessly enhance your natural radiance with our weightless elixir. Enriched with botanical extracts and Hyaluronic Acid, it hydrates and revitalizes for a subtle yet enchanting glow.', '<b>1. Cleanse:</b> Start with a clean face using a gentle cleanser.\r\n<b>2. Dispense:</b> Shake well, then apply a small amount of elixir to fingertips.\r\n<b>3. Apply:</b> Gently pat and massage onto face in upward motions, avoiding the eye area.\r\n<b>4. Abs', 'Aqua (Water), Hyaluronic Acid, Red Bean Extract, Kaolin, Botanical Extracts.', 'Suitable for all skin types, our Radiance Reveal Elixir Light offers a gentle and hydrating experience for those seeking to enhance their natural glow.', 20.00, 200),
(6, 'Radiance Reveal Face Serum', 1199.00, 'Harnessing the power of Red Bean Extract. Illuminate effortlessly.', 'rls1.jpeg', 'rls2.jpg', 'rls3.jpg', 'rls4.jpg', 'rls5.jpg', 'Experience a luminous transformation with our Radiance Reveal Face Serum Light. Enriched with a potent blend of Red Bean Extract, Ginseng, Honey, Niacinamide, Kaolin, and Botanical Extracts, this serum unveils radiant skin like never before. Inspired by F', '<b>1. Cleanse:</b> Start with a freshly cleansed face using a gentle cleanser.\r\n<b>2. Dispense:</b> Shake the serum well, then dispense a small amount onto your fingertips.\r\n<b>3. Apply:</b> Gently massage the serum onto your face in upward motions, avoid', 'Red Bean Extract, Ginseng, Honey, Niacinamide, Kaolin, Botanical Extracts.', 'Suitable for all skin types, our Radiance Reveal Face Serum Light offers a luxurious experience for anyone seeking to enhance their skincare routine.', 20.00, 200),
(7, 'Brilliance reveal face cream', 699.00, 'Radiance Reveal Face Cream Light: Botanical-infused hydration.', 'rfc1.jpeg', 'rfc2.jpg', 'rfc3.jpg', 'rfc4.jpg', 'rfc5.jpg', 'Indulge in the brilliance of our Radiance Reveal Face Cream Light. Crafted with a delicate balance of nourishing botanicals and advanced hydration, this luxurious cream revitalizes your complexion from within. Inspired by French beauty rituals, it leaves ', '<b>1. Cleanse:</b> Begin with a gentle cleanser to prepare your skin.\r\n<b>2. Apply:</b> Take a small amount of the cream and gently massage it onto your face and neck using upward motions.\r\n<b>3. Absorb:</b> Allow the cream to fully absorb into your skin ', 'Red Bean Extract, Ginseng, Honey, Niacinamide, Hyaluronic Acid, Botanical Extracts.', 'Suitable for all skin types, our Radiance Reveal Face Cream Light offers a nourishing experience for anyone seeking to unveil radiant, hydrated skin.', 20.00, 200),
(8, 'Radiance reveal elixir and face cream duo', 1398.00, 'Enriched with Hyaluronic Acid, Vit C & Botanical extracts', 'Outdoor-Cosmetics-Branding-Mockup-vol2 1.png', 'hero-product1.png', 'hero-product2.png', 'ig7.jpg', 'a2.png', 'Indulge in the ultimate beauty ritual with our Radiance Reveal Elixir. This luxurious formula, inspired by the brilliance of éclat and the enchantment of French beauty, unveils a captivating glow within. Immerse your skin in the exquisite duo', 'Cleanse: Start with a clean face using a elixir cleanser. Dispense: Shake well, then apply a small amount of elixir to fingertips. Apply: Gently massage the cream onto face in upward motions, avoiding the eye area.', 'Hyaluronic Acid, Vit C, Curd and Rice extracts.', 'All skin types. Perform a patch test first if you have sensitive skin. Store in a cool, dry place away from sunlight. Apply sunscreen during the day for added protection.', 30.00, 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_title` varchar(55) NOT NULL,
  `review_text` text NOT NULL,
  `review_image` varchar(255) NOT NULL,
  `rating` int(5) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `review_title`, `review_text`, `review_image`, `rating`, `created_at`) VALUES
(41, 2, 13, 'frtgvre4gr', 'veofjwor3q4ur34r3u49ru39', 'a1.png', 4, '2024-05-12 08:00:36.925698'),
(42, 2, 13, ' gbrswtg', 'rvesdrferfvbrtbrgbtbrtb', 'a1.png', 5, '2024-05-10 22:34:39.182462'),
(43, 2, 13, 'love it', 'thank you so much for this', 'AdobeStock-07XsvRKa4G 1.png', 3, '2024-05-12 08:00:10.043605'),
(44, 2, 13, 'nice', 'loved the product.', 'applying-cream.png', 4, '2024-05-12 08:00:25.383287'),
(45, 2, 13, 'ok', 'cazually fine, does no wonder', 'a2.png', 1, '2024-05-12 08:01:47.178523');

-- --------------------------------------------------------

--
-- Table structure for table `users_signup`
--

CREATE TABLE `users_signup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Select','Male','Female','Others','') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_signup`
--

INSERT INTO `users_signup` (`id`, `name`, `dob`, `gender`, `email`, `password`, `phone`, `is_verified`, `created_at`) VALUES
(13, 'kangkana sen', '2002-10-23', 'Female', 'k@gmail.com', '$2y$10$TmMs1yXVEf6cDtHaQ4Kx2eNH6MKqHeDYAObVNXiF6EwcW9vYxTtXq', '06295322035', 0, '2024-05-30 16:24:17'),
(40, 'kangkana sen', '2002-10-23', 'Female', 'kangkanasenforever333@gmail.com', '$2y$10$iTIbDtzR5fbubTbtBukPmeaFHgHzst3BdikzhEMjSlRnDol5P3Tou', '6295322035', 1, '2024-05-30 22:15:57'),
(45, 'arghu', '2000-07-04', 'Others', 'arkadeb03@gmail.com', '$2y$10$aODutjXInpzxuPmscyGJnuU7exRAvi2E3virf1SvJKoKKmCOhQNyi', '0000000000', 1, '2024-05-31 18:56:54'),
(48, 'kangkana sen bwu', '0000-00-00', 'Select', 'bwubam21054@brainwareuniversity.ac.in', '$2y$10$mheNX36eQj3aHStBe0wT.uzPiQQDTnC0wGePseu9FfXuQ.TCyBdI.', '', 1, '2024-05-31 20:02:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered-products`
--
ALTER TABLE `ordered-products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_signup`
--
ALTER TABLE `users_signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ordered-products`
--
ALTER TABLE `ordered-products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users_signup`
--
ALTER TABLE `users_signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
