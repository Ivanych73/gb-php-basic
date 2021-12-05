-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 05 2021 г., 15:43
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

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
(17, '1.jpg', 'img\\big', 'img\\small', 60038, 7930, 42, 1),
(18, '2.jpg', 'img\\big', 'img\\small', 12271, 5568, 7, 3),
(19, '3.jpg', 'img\\big', 'img\\small', 249808, 10706, 17, 5),
(20, '4.jpg', 'img\\big', 'img\\small', 60857, 10830, 13, 7),
(21, '5.jpg', 'img\\big', 'img\\small', 137251, 6901, 6, 8),
(22, '6.jpg', 'img\\big', 'img\\small', 62514, 4433, 8, 9),
(23, '7.jpg', 'img\\big', 'img\\small', 85655, 8818, 13, 10),
(24, '8.jpg', 'img\\big', 'img\\small', 53399, 8685, 4, 11),
(25, '9.jpg', 'img\\big', 'img\\small', 68505, 12133, 4, 12);

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

--
-- Индексы сохранённых таблиц
--

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
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
-- Ограничения внешнего ключа сохраненных таблиц
--

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
