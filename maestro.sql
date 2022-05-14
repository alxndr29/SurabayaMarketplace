-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2022 at 05:17 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maestro`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `idalamat` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `telepon` varchar(45) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`idalamat`, `users_id`, `alamat`, `telepon`, `latitude`, `longitude`) VALUES
(2, 2, 'Jln Kokos Raya No. 34', '123', '-8.842405868735971', '121.65452397397462');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `idbooking` int(11) NOT NULL,
  `name_customer` varchar(45) NOT NULL,
  `name_product` varchar(45) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` double NOT NULL,
  `metode_payment` varchar(45) NOT NULL,
  `metode_pengiriman` varchar(45) NOT NULL,
  `date_booking` date NOT NULL,
  `date_pengambilan` date NOT NULL,
  `time_pengambilan` varchar(45) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `product_idproduct` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `nama_usaha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`idbooking`, `name_customer`, `name_product`, `jumlah`, `total_harga`, `metode_payment`, `metode_pengiriman`, `date_booking`, `date_pengambilan`, `time_pengambilan`, `alamat`, `status`, `shop_idshop`, `users_id`, `product_idproduct`, `note`, `harga`, `nama_usaha`) VALUES
(2, 'Aditya edit', 'Semen gresik', 2, 250000, 'Bayar Ditempat', 'Di ambil di tempat', '2022-04-25', '2022-04-26', '20:00', 'Pesona Surya Milenia No. 55 Edit', 'Selesai', 1, 2, 7, 'mntp', 125000, 'Gusti Shop Edit');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `product_idproduct` int(11) NOT NULL,
  `qty` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`users_id`, `product_idproduct`, `qty`) VALUES
(2, 8, '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idcategory`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mouse', NULL, NULL),
(2, 'Keyboard', NULL, NULL),
(3, 'Speaker', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `isi_chat` varchar(45) DEFAULT NULL,
  `sender` varchar(45) DEFAULT NULL,
  `shop_idshop` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`idchat`, `time`, `isi_chat`, `sender`, `shop_idshop`, `users_id`) VALUES
(3, '2022-05-05 22:51:51', 'j', 'user', 1, 2),
(4, '2022-05-05 22:55:14', 'j8', 'user', 1, 2),
(5, '2022-05-07 09:19:19', 'sss', 'user', 3, 2),
(6, '2022-05-07 10:30:44', 'p', 'user', 3, 2),
(7, '2022-05-07 10:48:50', 'm', 'seller', 1, 2),
(8, '2022-05-07 10:57:58', 'p', 'seller', 1, 2),
(9, '2022-05-07 10:58:12', ';', 'seller', 1, 2),
(10, '2022-05-07 10:59:14', 'p', 'seller', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `idjadwal` int(11) NOT NULL,
  `tanggal` varchar(45) NOT NULL,
  `title` varchar(255) NOT NULL,
  `jam_mulai` varchar(45) NOT NULL,
  `jam_akhir` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`idjadwal`, `tanggal`, `title`, `jam_mulai`, `jam_akhir`, `status`, `shop_idshop`, `users_id`, `catatan`, `time`) VALUES
(33, '2022-04-29', '08:00 08:15/Slot Penuh', '2022-04-29 08:00', '2022-04-29 08:15', 'terisi', 1, 2, 'www', '2022-04-29 08:00:00'),
(34, '2022-04-29', '08:15 08:30/Pertemuan Seller', '2022-04-29 08:15', '2022-04-29 08:30', 'kosong', 1, NULL, NULL, '2022-04-29 08:30:00'),
(35, '2022-04-29', '08:30 08:45/Slot Penuh', '2022-04-29 08:30', '2022-04-29 08:45', 'terisi', 1, 2, NULL, '2022-04-29 08:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `idnotification` int(11) NOT NULL,
  `notification_message` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notificationcol` varchar(45) DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `idorder` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `alamat_idalamat` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` varchar(45) NOT NULL,
  `status_order` varchar(45) NOT NULL,
  `is_review` varchar(45) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idorder`, `users_id`, `shop_idshop`, `alamat_idalamat`, `tanggal`, `total`, `status_order`, `is_review`) VALUES
(2, 2, 1, 2, '2022-05-08 13:44:19', '400000', 'Selesai', 'true'),
(3, 2, 3, 2, '2022-05-08 13:56:55', '60000', 'Menunggu Verifikasi Pembayaran', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `order_has_product`
--

CREATE TABLE `order_has_product` (
  `order_idorder` int(11) NOT NULL,
  `product_idproduct` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_has_product`
--

INSERT INTO `order_has_product` (`order_idorder`, `product_idproduct`, `qty`, `subtotal`) VALUES
(2, 7, 3, 375000),
(2, 8, 5, 25000),
(3, 11, 1, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `idpayment` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(45) NOT NULL,
  `verified_at` datetime DEFAULT NULL,
  `order_idorder` int(11) NOT NULL,
  `nama_rekening_pemilik` varchar(45) DEFAULT NULL,
  `nomor_rekening_pemilik` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idpayment`, `date`, `image`, `verified_at`, `order_idorder`, `nama_rekening_pemilik`, `nomor_rekening_pemilik`) VALUES
(2, '2022-05-11 23:05:55', '2.jpg', '2022-05-11 15:10:44', 2, 'Q1im1a', '12312');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `category_idcategory` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_product_category_idshop_product_category` int(11) NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `berat` double NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `name`, `price`, `desc`, `category_idcategory`, `created_at`, `updated_at`, `shop_product_category_idshop_product_category`, `shop_idshop`, `berat`, `stok`) VALUES
(7, 'Semen gresik', 125000, 'wtf', 2, NULL, NULL, 3, 1, 1, 100),
(8, 'Sayu', 5000, 'fgdfgdf', 2, NULL, NULL, 3, 1, 2, 200),
(9, 'Tuturu', 99000, 'dfgdfg', 2, NULL, NULL, 3, 1, 3, 300),
(10, 'Kaguya', 23000, 'Nona Kaguya', 1, NULL, NULL, 1, 1, 87, 77),
(11, 'Edelynlin', 60000, 'mantap', 1, NULL, NULL, 5, 3, 1000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_bookmark`
--

CREATE TABLE `product_bookmark` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `product_idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_bookmark`
--

INSERT INTO `product_bookmark` (`users_id`, `product_idproduct`) VALUES
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `idproduct_image` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_idproduct` int(11) NOT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`idproduct_image`, `name`, `product_idproduct`, `created_at`, `updated_at`) VALUES
(3, '7.jpg', 7, NULL, NULL),
(4, '8.jpg', 8, NULL, NULL),
(5, '9.jpg', 9, NULL, NULL),
(6, '10.jpg', 10, NULL, NULL),
(7, '11.jpg', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `product_idproduct` int(11) NOT NULL,
  `order_idorder` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `star` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idreview` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`users_id`, `product_idproduct`, `order_idorder`, `date`, `star`, `message`, `idreview`) VALUES
(2, 7, 2, '2022-05-14 10:58:13', '2', 'dua', 3),
(2, 8, 2, '2022-05-14 10:58:13', '3', 'tiga', 4);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `idshop` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `open_hours` varchar(45) DEFAULT NULL,
  `close_hours` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`idshop`, `name`, `description`, `address`, `phone`, `latitude`, `longitude`, `created_at`, `updated_at`, `users_id`, `open_hours`, `close_hours`) VALUES
(1, 'Gusti Shop Edit', 'Jual HEwan Buas Edit', 'Pesona Surya Milenia No. 55 Edit', '1234', '-8.8441759', '121.6677641', '2022-02-11 05:47:20', '2022-02-11 05:47:20', 1, '07:00', '17:00'),
(3, 'Modifie', 'jual sparepart motor', 'jln tenggilis mejoyo', '321321', '-8.83277722117093', '121.67778827039523', '2022-04-24 04:52:43', '2022-04-24 04:52:43', 3, '07:00', '13:00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_category`
--

CREATE TABLE `shop_product_category` (
  `idshop_product_category` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_product_category`
--

INSERT INTO `shop_product_category` (`idshop_product_category`, `name`, `created_at`, `updated_at`, `shop_idshop`) VALUES
(1, 'Mouse Gaming Logitech Edit', NULL, NULL, 1),
(3, 'Keyboard Gaming Logitech', NULL, NULL, 1),
(4, 'Speaker Portable', NULL, NULL, 1),
(5, 'Cb Nando', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `profile_picture`) VALUES
(1, 'Gusti Tidak Bagus', 'gusti@gmail.com', NULL, '$2y$10$Fah1KVyRLp4cvxAxPorPv.WvuaSAOVXUOENy.osElgOtBHRHNs9YK', 'pemilik_usaha', NULL, '2022-02-08 03:56:10', '2022-02-08 03:56:10', NULL),
(2, 'Aditya edit', 'adit@gmail.com', NULL, '$2y$10$QvDJAczEYta2QTh4l6Zpk.N12Jyxanp7YwN4JyAzZ36WGcABd0Vke', 'user_umum', NULL, '2022-02-11 08:20:43', '2022-02-11 08:20:43', NULL),
(3, 'nando', 'nando@gmail.com', NULL, '$2y$10$GElPVU4yggMhGi7PwSM8qe3cKszMzVrsyXucdC0NrKJnUPLUzkZi6', 'pemilik_usaha', NULL, '2022-04-24 04:51:56', '2022-04-24 04:51:56', NULL),
(4, 'evan', 'evan@gmail.com', NULL, '$2y$10$Er.mXbKwfsZA5ICW6hHtmOiMs5azLLOMBoG/DYMJralLbFXO/clNq', 'user_umum', NULL, '2022-04-25 05:05:46', '2022-04-25 05:05:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`idalamat`),
  ADD KEY `fk_alamat_users1_idx` (`users_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idbooking`),
  ADD KEY `fk_booking_shop1_idx` (`shop_idshop`),
  ADD KEY `fk_booking_users1_idx` (`users_id`),
  ADD KEY `fk_booking_product1_idx` (`product_idproduct`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`users_id`,`product_idproduct`),
  ADD KEY `fk_users_has_product_product1_idx` (`product_idproduct`),
  ADD KEY `fk_users_has_product_users1_idx` (`users_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idcategory`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `fk_chat_shop1_idx` (`shop_idshop`),
  ADD KEY `fk_chat_users1_idx` (`users_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`idjadwal`),
  ADD KEY `fk_jadwal_shop1_idx` (`shop_idshop`),
  ADD KEY `fk_jadwal_users1_idx` (`users_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idnotification`),
  ADD KEY `fk_notification_users1_idx` (`users_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `fk_order_users1_idx` (`users_id`),
  ADD KEY `fk_order_shop1_idx` (`shop_idshop`),
  ADD KEY `fk_order_alamat1_idx` (`alamat_idalamat`);

--
-- Indexes for table `order_has_product`
--
ALTER TABLE `order_has_product`
  ADD PRIMARY KEY (`order_idorder`,`product_idproduct`),
  ADD KEY `fk_order_has_product_product1_idx` (`product_idproduct`),
  ADD KEY `fk_order_has_product_order1_idx` (`order_idorder`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idpayment`),
  ADD KEY `fk_payment_order1_idx` (`order_idorder`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`),
  ADD KEY `fk_product_category1_idx` (`category_idcategory`),
  ADD KEY `fk_product_shop_product_category1_idx` (`shop_product_category_idshop_product_category`),
  ADD KEY `fk_product_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `product_bookmark`
--
ALTER TABLE `product_bookmark`
  ADD PRIMARY KEY (`users_id`,`product_idproduct`),
  ADD KEY `fk_users_has_product1_product1_idx` (`product_idproduct`),
  ADD KEY `fk_users_has_product1_users1_idx` (`users_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`idproduct_image`),
  ADD KEY `fk_product_image_product1_idx` (`product_idproduct`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idreview`),
  ADD KEY `fk_users_has_product_product2_idx` (`product_idproduct`),
  ADD KEY `fk_users_has_product_users2_idx` (`users_id`),
  ADD KEY `fk_users_has_product_order1_idx` (`order_idorder`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`idshop`),
  ADD KEY `fk_shop_users_idx` (`users_id`);

--
-- Indexes for table `shop_product_category`
--
ALTER TABLE `shop_product_category`
  ADD PRIMARY KEY (`idshop_product_category`),
  ADD KEY `fk_shop_product_category_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `idalamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `idbooking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `idjadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `idnotification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `idpayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `idproduct_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `idreview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `idshop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_product_category`
--
ALTER TABLE `shop_product_category`
  MODIFY `idshop_product_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `fk_alamat_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_product1` FOREIGN KEY (`product_idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_users_has_product_product1` FOREIGN KEY (`product_idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_product_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chat_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jadwal_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_alamat1` FOREIGN KEY (`alamat_idalamat`) REFERENCES `alamat` (`idalamat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_has_product`
--
ALTER TABLE `order_has_product`
  ADD CONSTRAINT `fk_order_has_product_order1` FOREIGN KEY (`order_idorder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_has_product_product1` FOREIGN KEY (`product_idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_order1` FOREIGN KEY (`order_idorder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_idcategory`) REFERENCES `category` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_shop_product_category1` FOREIGN KEY (`shop_product_category_idshop_product_category`) REFERENCES `shop_product_category` (`idshop_product_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_bookmark`
--
ALTER TABLE `product_bookmark`
  ADD CONSTRAINT `fk_users_has_product1_product1` FOREIGN KEY (`product_idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_product1_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_product_image_product1` FOREIGN KEY (`product_idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_users_has_product_order1` FOREIGN KEY (`order_idorder`) REFERENCES `order` (`idorder`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_product_product2` FOREIGN KEY (`product_idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_product_users2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `fk_shop_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_product_category`
--
ALTER TABLE `shop_product_category`
  ADD CONSTRAINT `fk_shop_product_category_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
