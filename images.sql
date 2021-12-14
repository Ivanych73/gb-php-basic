-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2021 г., 20:09
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
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pathbig` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pathsmall` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sizebig` int(11) DEFAULT NULL,
  `sizesmall` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `title`, `pathbig`, `pathsmall`, `sizebig`, `sizesmall`, `clicks`) VALUES
(17, '1.jpg', 'img\\big', 'img\\small', 60038, 7930, 0),
(18, '2.jpg', 'img\\big', 'img\\small', 12271, 5568, 1),
(19, '3.jpg', 'img\\big', 'img\\small', 249808, 10706, 1),
(20, '4.jpg', 'img\\big', 'img\\small', 60857, 10830, 1),
(21, '5.jpg', 'img\\big', 'img\\small', 137251, 6901, 2),
(22, '6.jpg', 'img\\big', 'img\\small', 62514, 4433, 0),
(23, '7.jpg', 'img\\big', 'img\\small', 85655, 8818, 0),
(24, '8.jpg', 'img\\big', 'img\\small', 53399, 8685, 0),
(25, '9.jpg', 'img\\big', 'img\\small', 68505, 12133, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
