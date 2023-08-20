-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Час створення: Сер 20 2023 р., 12:39
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
-- Структура таблиці `dishes`
--

CREATE TABLE `dishes` (
  `id` bigint UNSIGNED NOT NULL,
  `dishtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dishgroup` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `portionweight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portioncost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost100g` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint NOT NULL DEFAULT '1',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `places_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `dishes`
--

INSERT INTO `dishes` (`id`, `dishtitle`, `dishgroup`, `description`, `portionweight`, `portioncost`, `cost100g`, `position`, `thumbnail`, `places_id`, `created_at`, `updated_at`) VALUES
(6, 'Піцца з олівє', 2, '20/50/30 Сметана/Дируни/Соус', '250', '200', '100', 1, 'balk.jpg', 1, '2023-08-16 06:33:46', '2023-08-16 11:59:27'),
(7, 'Олівє по Вінницьки2', 1, '20/50/30 Сметана/Дируни/Соус', '250', '75', '25', 1, 'okonnaya-furnitura.jpg', 1, '2023-08-16 06:34:15', '2023-08-16 11:59:32'),
(8, 'Картопля варена', 1, '20/50/30 Сметана/Дируни/Соус', '275', '200', '100', 2, 'uplotniteli.jpg', 1, '2023-08-16 06:34:49', '2023-08-16 11:59:47'),
(10, 'Вінігрет', 6, '20/50/30 Сметана/Дируни/Соус', '150', '45', '25', 1, 'Kak-prigotovit-vinegret_1551297743_1647236273.jpg', 2, '2023-08-17 06:27:23', '2023-08-17 12:21:53'),
(11, 'Грецький салат', 6, '20/50/30 Сметана/Дируни/Соус', '250', '25', '25', 1, 'greckij_2.jpeg', 2, '2023-08-17 12:39:24', '2023-08-17 12:45:56'),
(12, 'Бульйон курячий з яйцем', 4, '20/50/30 Сметана/Дируни/Соус', '350', '75', '25', 1, 'id_210900.jpg', 2, '2023-08-17 12:48:09', '2023-08-17 12:48:19'),
(13, 'Крем суп', 4, '20/50/30 Сметана/Дируни/Соус', '350', '250', '150', 1, 'gribnoy.jpg', 2, '2023-08-17 12:51:22', '2023-08-17 12:51:22'),
(14, 'Уха', 4, '20/50/30 Сметана/Дируни/Соус', '250', '250', '150', 1, '1.jpg', 2, '2023-08-17 12:52:13', '2023-08-17 12:52:13'),
(15, 'Солянка', 4, '20/50/30 Сметана/Дируни/Соус', '250', '250', '25', 1, 'gp-2223.jpg', 2, '2023-08-17 14:16:39', '2023-08-17 14:16:39'),
(16, 'стейк із свинини', 1, '20/50/30 Сметана/Дируни/Соус', '250', '75', '100', 1, 'staik.jpg', 2, '2023-08-17 14:18:15', '2023-08-17 14:18:15'),
(17, 'теплий салат з куркою гриль', 6, '20/50/30 Сметана/Дируни/Соус', '250', '250', '25', 1, 'Salat-z-kurkou-grill_siteNewWebUkr.jpg', 2, '2023-08-17 14:19:02', '2023-08-17 14:19:02'),
(18, 'картопля по селянськи', 5, '20/50/30 Сметана/Дируни/Соус', '350', '250', '25', 1, 'kartopla.jpg', 2, '2023-08-17 14:22:30', '2023-08-17 14:22:30'),
(19, 'Курячий галантин', 1, '20/50/30 Сметана/Дируни/Соус', '275', '75', '150', 1, 'Galantin-z-kurku_siteWebUkr.jpg', 2, '2023-08-17 14:47:59', '2023-08-17 14:47:59'),
(20, 'рулет свинячий з грибами', 1, '20/50/30 Сметана/Дируни/Соус', '275', '250', '150', 1, '10-receptov-kurinogo-ruleta-kotoryj-soberyot-za-stolom-vsyu-semyu_1573849636.jpg', 2, '2023-08-17 14:48:44', '2023-08-17 14:48:44');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dishes_places_id_foreign` (`places_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_places_id_foreign` FOREIGN KEY (`places_id`) REFERENCES `places` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
