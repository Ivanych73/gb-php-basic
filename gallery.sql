-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 07 2021 г., 14:40
-- Версия сервера: 5.7.33
-- Версия PHP: 7.4.21


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--

-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `title` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `title`, `price`, `description`) VALUES
(1, 'Два толстых котика', 55, 'Два толстых котика удивленно глядят из дверного проема'),
(3, 'Наглый котик \"коровка\"', 48, 'Наглый котик расцветки \"коровка\" оперся передними лапами о другого черного котика'),
(5, 'Толстый полосатый котик', 39, 'Толстый полосатый котик просто зевает'),
(7, 'Рыжий котик', 41, 'Рыжий котик умильно спит'),
(8, 'Два белых котика', 62, 'Два белых котика вылизывают друг дружку.'),
(9, 'Бело-рыжий котенок', 49, 'Бело-рыжий котенок очень серьезно смотрит на Вас'),
(10, 'Британцы в шапочках', 58, 'Два британских котика в смешных шапочках сидят на диване с очень важным видом'),
(11, 'Толстый белый', 42, 'Толстый белый котик, в шапочке, как корона 18 века, сидит враскоряку'),
(12, 'Двое на подоконнике', 82, 'Серый и рыжий котики летним днем наблюдают за чем-то с подоконника');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pathbig` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pathsmall` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sizebig` int(11) DEFAULT NULL,
  `sizesmall` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `good_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `title`, `pathbig`, `pathsmall`, `sizebig`, `sizesmall`, `clicks`, `good_id`) VALUES

(17, '1.jpg', 'img\\big', 'img\\small', 60038, 7930, 49, 1),
(18, '2.jpg', 'img\\big', 'img\\small', 12271, 5568, 7, 3),
(19, '3.jpg', 'img\\big', 'img\\small', 249808, 10706, 19, 5),
(20, '4.jpg', 'img\\big', 'img\\small', 60857, 10830, 19, 7),
(21, '5.jpg', 'img\\big', 'img\\small', 137251, 6901, 8, 8),
(22, '6.jpg', 'img\\big', 'img\\small', 62514, 4433, 8, 9),
(23, '7.jpg', 'img\\big', 'img\\small', 85655, 8818, 14, 10),
(24, '8.jpg', 'img\\big', 'img\\small', 53399, 8685, 5, 11),
(25, '9.jpg', 'img\\big', 'img\\small', 68505, 12133, 6, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `reviewer` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `good_id`, `reviewer`, `text`) VALUES
(4, 1, 'Автор №1', 'Текст первого автора'),
(5, 9, 'Автор №2', 'Текст Текст текст текст'),
(6, 9, 'Автор №3', 'Это отзыв на бело-рыжего котенка'),
(7, 10, 'Автор 10', 'Отзыв автора 10'),
(8, 10, 'Автор 11', 'Отзыв автора 11'),
(9, 5, 'Автор 11', 'Отзыва автора 11'),
(10, 5, 'Автор 12', 'Отзыв автора 12'),
(11, 5, 'автор 13', 'отзыв'),
(12, 1, 'Автор 14', 'Отзыв');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_customer` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `salt` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `is_customer`, `is_admin`, `salt`) VALUES
(9, 'admin1', '02dd87039afaf7124ca9c14e5766a9be', 1, 1, '0GrViTNuNtwvDAT6S6gKJB5PP5CEFDHM6GaD2IIfSGm0nOJ3AuyeJ8UJ59mKMe3'),
(10, 'user1', 'c56e8355145d929852e71b0193d1d7db', 1, 0, 'YLgG6vSmuli2IZkSTXwYVvLFdQatICadzwZ4g6OQraqgR4XdzHynqYOQ6vDvCkE');


--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `good_id` (`good_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `good_id` (`good_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `good_id` (`good_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--er
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`good_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`good_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`good_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
