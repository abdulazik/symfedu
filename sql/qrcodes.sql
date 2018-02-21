-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 21 2018 г., 17:08
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
-- Структура таблицы `qrcodes`
--

CREATE TABLE IF NOT EXISTS `qrcodes` (
  `id` int(12) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qrcodes`
--

INSERT INTO `qrcodes` (`id`, `date`, `time`, `name`) VALUES
(1, '2018-02-13', '19:07:51', 'a26fe95b54631e53c42f3cb68e3f07cd'),
(2, '2018-02-13', '19:07:54', 'ae332e1e85372fa8525cbb879875a7e3'),
(3, '2018-02-13', '19:07:56', 'f047e2105056cbe073029fb0e139c368'),
(4, '2018-02-13', '20:01:08', '961ea29214a3de61104f72363da44969'),
(5, '2018-02-14', '20:11:46', '5cc4b6b7940089cc2add4fe5e856b55e'),
(6, '2018-02-15', '20:11:59', '98ddcc1fb43fad14a953afd089a54fba'),
(7, '2018-02-15', '20:12:01', '9229d3786bd2a14557d188f4940c90c8'),
(8, '2018-02-15', '20:12:02', '4808e8dbd24c8c077ab668e543d77b47'),
(9, '2018-02-15', '20:13:38', '5764e4b6a86c0fcf90bc5acd1e4eef5a'),
(10, '2018-02-18', '09:53:33', '22a2fded3d013f9a64754470fc9318d9'),
(11, '2018-02-19', '13:26:10', 'd5830c5f3f0475e3bd4ad869fd74eb1b'),
(12, '2018-02-20', '17:43:44', 'eaabe2e6caf79371707d426d0dd8ef53'),
(13, '2018-02-21', '11:56:30', '6c7c415db25c955522a92b71955d2075'),
(14, '2018-02-21', '11:56:42', '4d47c874039e190dc34c52eab38ab91d');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
