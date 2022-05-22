-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 22 2022 г., 20:35
-- Версия сервера: 8.0.24
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `scandiweb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attributes`
--

CREATE TABLE `attributes` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `unit`) VALUES
(1, 'Size', 'MB'),
(2, 'Weight', 'KG'),
(3, 'Dimension', 'CM');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` tinyint NOT NULL,
  `name` varchar(30) NOT NULL,
  `main_attribute_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `main_attribute_id`) VALUES
(1, 'DVD', 1),
(2, 'Book', 2),
(3, 'Furniture', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `sku` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `category_id` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `category_id`) VALUES
(3, 'JVC200123', 'Acme DISC', 1, 1),
(4, 'GGWP0007', 'War and Peace', 20, 2),
(5, 'TR120555', 'Chair', 40, 3),
(6, 'TR120556', 'Table', 60.54, 3),
(7, 'GGWP0008', 'Harry Potter', 30, 2),
(13, 'VER15263', 'Verbatim DISC', 1.5, 1),
(14, 'SFF15236', 'Sofa', 743, 3),
(15, 'KBZ00134', 'Kobzar', 26.56, 2),
(16, 'LNH11233', 'Lion Heart', 15.4, 2),
(17, 'DSK5678', 'Desk', 240, 3),
(18, 'JVC200127', 'Acme DISC', 2.2, 1),
(19, 'GGWP0010', 'PHP for beginners', 30.3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `attribute_id`, `value`) VALUES
(1, 3, 1, '700'),
(2, 4, 2, '2'),
(3, 5, 3, '24x45x15'),
(4, 6, 3, '100x150x80'),
(5, 7, 2, '2'),
(11, 13, 1, '700'),
(12, 14, 3, '100x100x200'),
(13, 15, 2, '1'),
(14, 16, 2, '1.5'),
(15, 17, 3, '80x60x120'),
(16, 18, 1, '4800'),
(17, 19, 2, '2.3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_attribute_id` (`main_attribute_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `products_attributes_ibfk_2` (`attribute_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`main_attribute_id`) REFERENCES `attributes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD CONSTRAINT `products_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
