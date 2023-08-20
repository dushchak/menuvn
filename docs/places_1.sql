-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Час створення: Сер 20 2023 р., 12:40
-- Версія сервера: 8.0.34-0ubuntu0.22.04.1
-- Версія PHP: 8.1.2-1ubuntu2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `menuvn`
--

-- --------------------------------------------------------

--
-- Структура таблиці `places`
--

CREATE TABLE `places` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workhours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitplaces` smallint UNSIGNED NOT NULL DEFAULT '0',
  `delivery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disabled` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `places`
--

INSERT INTO `places` (`id`, `name`, `adress`, `workhours`, `description`, `sitplaces`, `delivery`, `manager`, `phone1`, `phone2`, `phone3`, `phone4`, `email`, `viber`, `telegram`, `insta`, `fb`, `thumbnail`, `disabled`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Кафе Вьнница', 'Ющенка 5', '12-23', 'дуже гарно кормлять', 135, 'Доставка курьерськими службами', '0683797974', '0968348883', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cafe_vinnica.jpg', 0, '2023-08-15 05:50:46', '2023-08-17 10:09:20', 2),
(2, 'Кафе Базилік', 'Коріатовичів 134', '12-23', 'дуже гарно кормлять', 120, 'Доставка курьерськими службами', '0968348883', '0683797974', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cafe_bazilik.jpg', 0, '2023-08-16 06:33:09', '2023-08-17 10:08:08', 2),
(3, 'Кафе Бібліотека', 'Соборна 35', '12-23', 'Гарне кафе у центрі міста', 135, 'Замовити доставку за телефоном (068)465-67-85', '0683797974', '0968348883', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'biblioteka.jpg', 0, '2023-08-17 14:31:30', '2023-08-17 14:31:30', 2),
(4, 'Песто кафе', 'Ющенка 5', '12-23', 'дуже гарно кормлять', 50, 'Доставка курьерськими службами', '0683797974', '0683797974', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pesto.jpg', 0, '2023-08-17 14:45:58', '2023-08-17 14:45:58', 2);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `places_id_index` (`id`),
  ADD KEY `places_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
