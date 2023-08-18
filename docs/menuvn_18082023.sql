-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Час створення: Сер 18 2023 р., 20:16
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

-- --------------------------------------------------------

--
-- Структура таблиці `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 2),
(10, '2023_08_06_112418_create_places_table', 3),
(11, '2023_08_10_093952_create_dishes_table', 3);

-- --------------------------------------------------------

--
-- Структура таблиці `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@menu.vn.ua', NULL, '$2y$10$m3wYXTvZSm/YLmEFeqBuLO16SKm6nodWDslfV4iFCFan2uk8SYPkW', NULL, '2023-08-09 14:41:47', '2023-08-09 14:41:47'),
(2, 'test', 'test@menu', NULL, '$2y$10$AjeEJNUtqcacOh7asHWTZuNWXtg4sMsP.EEdDhPyoWMjXfDvs20bS', 'K9AZ6BcYGKLpE6JIldSEHOhauNeax3wyPuytoTWnOCAQlJbnxOekp3yByvJD', '2023-08-13 04:28:53', '2023-08-13 04:28:53');

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
-- Індекси таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Індекси таблиці `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Індекси таблиці `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Індекси таблиці `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `places_id_index` (`id`),
  ADD KEY `places_user_id_foreign` (`user_id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблиці `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_places_id_foreign` FOREIGN KEY (`places_id`) REFERENCES `places` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
