-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 30 2024 г., 02:36
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crossworlddb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Adidas'),
(2, 'Fila'),
(3, 'Nike'),
(4, 'Puma'),
(5, 'Skechers'),
(6, 'Reebok');

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cart_has_products`
--

CREATE TABLE `cart_has_products` (
  `product_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `gender` enum('м','ж') DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `price`, `name`, `brand_id`, `gender`, `image_path`) VALUES
(1, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(2, 5000.00, 'Кроссовки AIR MAX SC', 3, 'ж', '/MVC-site/public/images/photos/NIKE_AIR_MAX_SC.webp'),
(3, 5000.00, 'Кроссовки CLASSIC LEATHER', 6, 'ж', '/MVC-site/public/images/photos/REEBOOK_CLASSIC _LEATHER.webp'),
(4, 7999.00, 'Кроссовки TRACE LOW', 2, 'ж', '/MVC-site/public/images/photos/FILA_TRACE_LOW.webp'),
(5, 14999.00, 'Кроссовки Exclusive Pure Luxe Wns', 4, 'ж', '/MVC-site/public/images/photos/PUMA_Pure_Luxe_Wns.webp'),
(6, 5000.00, 'Кроссовки STRUTTER', 1, 'ж', '/MVC-site/public/images/photos/ADIDAS_STRUTTER.webp'),
(7, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(8, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(9, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(10, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(11, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(12, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(13, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(14, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp'),
(15, 5000.00, 'Кроссовок', 1, 'ж', '/MVC-site/public/images/photos/testProduct.webp');

-- --------------------------------------------------------

--
-- Структура таблицы `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`) VALUES
(1, 1, 1),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Администратор'),
(2, 'Покупатель');

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `scale` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `scale`) VALUES
(1, 35),
(2, 36),
(3, 37),
(4, 38),
(5, 39),
(6, 40),
(7, 41),
(8, 42),
(9, 43),
(10, 44),
(11, 45);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT 2,
  `gender` enum('м','ж') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `birthdate`, `registration_date`, `password`, `email`, `role_id`, `gender`) VALUES
(1, 'fsf', '1992-03-05', '2024-03-16 19:04:27', '$2y$10$16DFINn/vJrUJjX/0g9GN.6N4GZVOuVyixD8IbGblRT7QtywK2X0.', 'fdf@www.ru', 2, 'ж'),
(3, 'wefwef', '2001-01-12', '2024-03-16 19:10:46', '$2y$10$H1etebRZK3aoJ22.vqlGnuVzTDsgbRfB1TDD10yPd38.5Ir1mpsZ.', 'wgwgwg@mail.ce', 2, 'ж'),
(4, 'dfsf', '1990-02-01', '2024-03-16 19:19:37', '$2y$10$1lzXv9nWoBcIldtPF803UuabHFk5yxauppVLgEuFxl/KP.CtOB5t.', 'sfsefse@aaa.du', 2, 'ж'),
(5, 'dfsdf', '1990-03-12', '2024-03-16 19:24:31', '$2y$10$8YiUNyc0f9jNuTCRV2mNtOrZDOqLb9GBppcQqNQPPMRRBS0a///1y', 'sdfsdf@kk.do', 2, 'ж'),
(6, 'ацыуацау', '1990-12-12', '2024-03-16 19:27:44', '$2y$10$svMaMUn6oTmAETrzrVn3I.p4PpeZaEAhM2ZFlg5fKbl7yFJuT3ie6', '123123@mma.dd', 2, 'м'),
(7, 'ыуацау', '1990-03-12', '2024-03-16 19:28:41', '$2y$10$SitsIdZKKRXdHqa9dKXOvu9LCbRGZxEwOBGcLLuo2quhlOGkv9ap2', '12123@ios.qw', 2, 'м'),
(8, 'ацуацуа', '1990-01-01', '2024-03-16 19:31:43', '$2y$10$i4fV./YvdRi.cPcMVFqdhuC2VkOFmCjqybQU/6XojZzSi.1neh4aa', 'dwedw@mails.we', 2, 'м'),
(10, 'Катя', '2003-04-10', '2024-03-17 12:15:50', '$2y$10$2p.pf1q2fXAoVkgAodnsheGepJC4/Siy02.Deh4mI7lKQhikgT1DG', 'kate@mail.ru', 2, 'ж'),
(11, 'Вася', '1970-05-07', '2024-03-17 12:48:13', '$2y$10$m55RLz14WiHM.0amt0ovru4r0VtpUo9xdnb0h4bUQN/hBGw8AfzHe', 'vas@mal.sq', 2, 'м'),
(12, 'ivanAufчик', '2002-07-30', '2024-03-19 15:27:25', '$2y$10$P6yFEWZIe03Yefn/ERc43uPucbODp5mPzny4ZGYyqBPB8fapgOiqy', 'ivanpozdeev2015@gmail.com', 2, 'м'),
(16, 'yan', '1999-02-12', '2024-03-19 17:23:38', '$2y$10$ZEdPZchdb.OYCXH4kTbwB.SZb5JXBSA0zW.WM56Zz6DnSVG.gfqQO', 'yan2015@gmail.com', 2, 'м');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `cart_has_products`
--
ALTER TABLE `cart_has_products`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Индексы таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `cart_has_products`
--
ALTER TABLE `cart_has_products`
  ADD CONSTRAINT `cart_has_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_has_products_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_sizes_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
