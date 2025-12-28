-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 27, 2025 lúc 06:12 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ftzfxboe_flowershop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 10, '2025-12-15 16:04:07', '2025-12-15 16:04:07'),
(11, 5, '2025-12-21 21:19:36', '2025-12-21 21:19:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cate_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cate_id`, `name`, `description`) VALUES
(1, 'Hoa Tình Yêu', 'Các loại hoa hồng, tulip, cẩm chướng dùng cho dịp lãng mạn.'),
(2, 'Hoa Khai Trương', 'Kệ hoa, lẵng hoa lớn dùng cho sự kiện và khai trương.'),
(3, 'Hoa Sinh Nhật', 'Bó hoa, hộp hoa nhỏ xinh dùng để chúc mừng sinh nhật.'),
(4, 'Hoa Chia Buồn', 'Vòng hoa, hoa trắng dùng trong các dịp tang lễ.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(5, '2025_11_30_151444_add_timestamps_to_products_table', 2),
(10, '2025_12_13_031423_add_foreign_key_to_stocks_table', 3),
(12, '2025_12_12_124648_create_payments_table', 4),
(13, '2025_12_13_054611_fix_stocks_id', 5),
(15, '2025_12_16_162626_add_timestamps_to_orderdts_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdts`
--

CREATE TABLE `orderdts` (
  `orderdt_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdts`
--

INSERT INTO `orderdts` (`orderdt_id`, `order_id`, `product_id`, `name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(25, 22, 12, 'hoa hong', 1, 15000.00, '2025-12-19 05:23:24', '2025-12-19 05:23:24'),
(26, 23, 11, 'sen đá', 1, 12000.00, '2025-12-21 07:27:36', '2025-12-21 07:27:36'),
(27, 24, 11, 'sen đá', 1, 12000.00, '2025-12-21 07:48:25', '2025-12-21 07:48:25'),
(28, 25, 11, 'sen đá', 1, 12000.00, '2025-12-21 07:49:51', '2025-12-21 07:49:51'),
(29, 26, 11, 'sen đá', 1, 12000.00, '2025-12-21 07:53:41', '2025-12-21 07:53:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_tables`
--

CREATE TABLE `order_tables` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shipping_fee` decimal(10,2) DEFAULT 0.00,
  `final_total` decimal(10,2) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `method_pay` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_tables`
--

INSERT INTO `order_tables` (`order_id`, `user_id`, `total_amount`, `status`, `created_at`, `updated_at`, `shipping_fee`, `final_total`, `fullname`, `phone`, `address`, `note`, `method_pay`) VALUES
(21, 10, 12.00, 'Hoàn Thành', '2025-12-16 16:36:10', '2025-12-16 10:35:04', 35000.00, 35012.00, 'Vo Thai Anh', '0948342040', '14 duong 25 a', NULL, 'COD'),
(22, 10, 15000.00, 'pending', '2025-12-19 12:23:24', '2025-12-19 05:23:24', 10000.00, 25000.00, 'Vo Thai Anh', '0948342040', '14 duong 25 a', 'hoa dep', 'COD'),
(23, 5, 12000.00, 'pending', '2025-12-21 14:27:36', '2025-12-21 07:27:36', 9000.00, 21000.00, 'Võ Thái Anh', '0123456789', '123 Đường ABC, Quận XYZ, TP.HCM', NULL, 'Bank Transfer'),
(24, 5, 12000.00, 'pending', '2025-12-21 14:48:25', '2025-12-21 07:48:25', 15000.00, 27000.00, 'Võ Thái Anh', '0123456789', '123 Đường ABC, Quận XYZ, TP.HCM', NULL, 'Bank Transfer'),
(25, 5, 12000.00, 'pending', '2025-12-21 14:49:51', '2025-12-21 07:49:51', 0.00, 12000.00, 'Võ Thái Anh', '0123456789', '123 Đường ABC, Quận XYZ, TP.HCM', NULL, 'Bank Transfer'),
(26, 5, 12000.00, 'pending', '2025-12-21 14:53:41', '2025-12-21 07:53:41', 13000.00, 25000.00, 'Võ Thái Anh', '0123456789', '123 Đường ABC, Quận XYZ, TP.HCM', NULL, 'Bank Transfer');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(6, 21, 10, 12.00, 'COD', 'Đã Thanh Toán', '2025-12-16 09:36:10', '2025-12-16 10:35:04'),
(7, 22, 10, 15000.00, 'COD', 'chua thanh toan', '2025-12-19 05:23:24', '2025-12-19 05:23:24'),
(8, 23, 5, 21000.00, 'Bank Transfer', 'unpaid', '2025-12-21 07:27:36', '2025-12-21 07:27:36'),
(9, 24, 5, 27000.00, 'Bank Transfer', 'unpaid', '2025-12-21 07:48:25', '2025-12-21 07:48:25'),
(10, 25, 5, 12000.00, 'Bank Transfer', 'unpaid', '2025-12-21 07:49:51', '2025-12-21 07:49:51'),
(11, 26, 5, 25000.00, 'Bank Transfer', 'unpaid', '2025-12-21 07:53:41', '2025-12-21 07:53:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `price`, `name`, `description`, `created_at`, `updated_at`) VALUES
(11, 2, 12000.00, 'sen đá', 'sen đá', '2025-12-19 03:53:32', '2025-12-19 03:53:32'),
(12, 1, 15000.00, 'hoa hong', 'hoa hong', '2025-12-19 05:09:27', '2025-12-19 05:09:27'),
(13, 2, 20000.00, 'hoa luc linh', 'hoa giay', '2025-12-19 05:24:48', '2025-12-19 05:25:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `min_stock` int(11) NOT NULL DEFAULT 0,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `quantity`, `min_stock`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 12, 3, 1, 'Võ Thái Anh', '2025-12-19 05:09:27', '2025-12-19 05:23:24'),
(5, 11, 1, 0, NULL, '2025-12-19 05:15:27', '2025-12-21 07:53:41'),
(6, 13, 5, 1, 'Võ Thái Anh', '2025-12-19 05:24:48', '2025-12-19 05:24:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `fullname`, `phone_number`, `address`, `role`, `created_at`, `updated_at`) VALUES
(5, 'admin', '$2y$12$jLXJmPAzHFVjVprag1wQb.jrGHdNqr0wa4PBAoU8RLNMC2mEtPIra', 'vothaianh137@gmail.com', 'Võ Thái Anh', '0123456789', '123 Đường ABC, Quận XYZ, TP.HCM', 'admin', '2025-11-28 23:00:50', '2025-11-28 23:00:50'),
(10, 'thaianh', '$2y$12$Sqviar8746PPNofnAXl6HOJoo4s3jilFMFR0F8DBfQ.xKLdqaJkWy', 'vothaianh46@gmail.com', 'Vo Thai Anh', '0948342040', '14 duong 25 a', 'user', '2025-12-15 02:03:54', '2025-12-16 07:56:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orderdts`
--
ALTER TABLE `orderdts`
  ADD PRIMARY KEY (`orderdt_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order_tables`
--
ALTER TABLE `order_tables`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orderdts`
--
ALTER TABLE `orderdts`
  MODIFY `orderdt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `order_tables`
--
ALTER TABLE `order_tables`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `orderdts`
--
ALTER TABLE `orderdts`
  ADD CONSTRAINT `orderdts_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_tables` (`order_id`),
  ADD CONSTRAINT `orderdts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `order_tables`
--
ALTER TABLE `order_tables`
  ADD CONSTRAINT `order_tables_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order_tables` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cate_id`);

--
-- Các ràng buộc cho bảng `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
