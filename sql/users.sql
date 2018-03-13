-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 05 2018 г., 12:04
-- Версия сервера: 5.5.48
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `symfonygs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date`) VALUES
(11, 'name', '81dc9bdb52d04dc20036dbd8313ed055', 'email@email.com', '2018-02-24'),
(12, 'test', '202cb962ac59075b964b07152d234b70', 'test@test.test', '2018-02-24'),
(13, 'aziz', '01039d0f1ce470da36b0252dd17c7416', 'shaks.fon@yandex.ru', '2018-02-24'),
(14, 'SHineXSuka', '9a135e5fcaad4aba2234e77eda6c9f1b', 'SHinex@gmail.com', '2018-02-28');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
