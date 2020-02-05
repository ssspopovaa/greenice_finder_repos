-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 05 2020 г., 22:58
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `greenice`
--

-- --------------------------------------------------------

--
-- Структура таблицы `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ident` int(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `htmlurl` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ownerlogin` varchar(255) NOT NULL,
  `stargazerscount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `favorite`
--

INSERT INTO `favorite` (`id`, `userid`, `ident`, `name`, `htmlurl`, `description`, `ownerlogin`, `stargazerscount`) VALUES
(1, 1, 237788286, 'beejee_jobber', 'https://github.com/ssspopovaa/beejee_jobber', NULL, 'ssspopovaa', '0'),
(2, 0, 237788286, 'beejee_jobber', 'https://github.com/ssspopovaa/beejee_jobber', NULL, 'ssspopovaa', '0'),
(3, 0, 237788286, 'beejee_jobber', 'https://github.com/ssspopovaa/beejee_jobber', NULL, 'ssspopovaa', '0'),
(4, 0, 237788286, 'beejee_jobber', 'https://github.com/ssspopovaa/beejee_jobber', NULL, 'ssspopovaa', '0'),
(5, 1, 167174, 'jquery', 'https://github.com/jquery/jquery', 'jQuery JavaScript Library', 'jquery', '52920'),
(7, 1, 167174, 'jquery', 'https://github.com/jquery/jquery', 'jQuery JavaScript Library', 'jquery', '52919'),
(8, 1, 478996, 'jquery-ui', 'https://github.com/jquery/jquery-ui', 'The official jQuery user interface library.', 'jquery', '10757'),
(9, 1, 343614, 'jquery-postmessage', 'https://github.com/cowboy/jquery-postmessage', 'jQuery postMessage: Cross-domain scripting goodness', 'cowboy', '356'),
(11, 1, 343614, 'jquery-postmessage', 'https://github.com/cowboy/jquery-postmessage', 'jQuery postMessage: Cross-domain scripting goodness', 'cowboy', '356'),
(12, 1, 260417, 'jquery-metadata', 'https://github.com/jquery-archive/jquery-metadata', 'A jQuery plugin for extracting metadata from DOM elements.', 'jquery-archive', '220'),
(13, 1, 14212980, 'jQuery-Seat-Charts', 'https://github.com/mateuszmarkowski/jQuery-Seat-Charts', 'jQuery Seat Charts Plugin', 'mateuszmarkowski', '494'),
(14, 1, 1306613, 'jQuery.AjaxFileUpload.js', 'https://github.com/jfeldstein/jQuery.AjaxFileUpload.js', 'jQuery plugin to magically make file inputs upload via ajax', 'jfeldstein', '419'),
(15, 1, 1306613, 'jQuery.AjaxFileUpload.js', 'https://github.com/jfeldstein/jQuery.AjaxFileUpload.js', 'jQuery plugin to magically make file inputs upload via ajax', 'jfeldstein', '419');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'test@s.s', '123456'),
(2, 'petro@sss.ss', '222222');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
