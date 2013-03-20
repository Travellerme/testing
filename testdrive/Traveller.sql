-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 20 2013 г., 23:38
-- Версия сервера: 5.5.29
-- Версия PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `Traveller`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `position` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `guest` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgUrl` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timeStart` int(11) NOT NULL,
  `timeEnd` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `title`, `imgUrl`, `timeStart`, `timeEnd`, `description`, `created`, `status`, `category_id`) VALUES
(1, 'title_1', 'events/image.jpg', 1372850100, 1372865400, 'desc_1', 0, 0, 0),
(2, 'title_2', 'Image2.png', 1373045700, 1373053020, 'desc_2', 0, 0, 0),
(3, 'title_3', 'image3.png', 1373199000, 1373209200, 'desc_3', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `partDescription` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fullDescription` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `title`, `partDescription`, `fullDescription`, `date`) VALUES
(1, 'Новость_1', 'Это тестовое описание. Проверяется кодировка. Данное описание является частью.\r\n\r\nА данное является полным. Дополняет частичное.\r\nЧто делает частичное описание, не частичным, а полным.\r\nВот так-то.', 'Это тестовое описание. Проверяется кодировка. Данное описание является частью.\r\n\r\nА данное является полным. Дополняет частичное.\r\nЧто делает частичное описание, не частичным, а полным.\r\nВот так-то.', 1373903739),
(2, 'Новость_2', 'Частичное описание второй новости, которое будет продолжено далее...', 'Частичное описание второй новости, которое будет продолжено далее...\r\nВот и продолжение сего текста, что означает, что это уже является полным описанием', 1376738100),
(3, 'Новость_3', 'ываытадыватждолыатфыволдажптэыв\r\nываыважтв\r\nапывпжлыв\r\nыважывтаыдлвтаыватываыв\r\nываыьвэаы\r\nываыв', 'ываытадыватждолыатфыволдажптэыв\r\nываыважтв\r\nапывпжлыв\r\nыважывтаыдлвтаыватываыв\r\nываыьвэаы\r\nываыв', 1379246743),
(4, 'Название_4', 'Проверка записи описания в базу. Это описание должно частично попасть в частичное описание, и полностью записаться в полное описание. Еще немного букв и я смогу проверить, как это нынче работает.\r\nНе хватило символов. Ну ладно, я проверю та экранирование ', 'Проверка записи описания в базу. Это описание должно частично попасть в частичное описание, и полностью записаться в полное описание. Еще немного букв и я смогу проверить, как это нынче работает.\r\nНе хватило символов. Ну ладно, я проверю та экранирование спец. тегов. Таких как <b>блаблабла</b>\r\n<script>\r\nalert(123);\r\n<script>', 1378910152);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `created` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `salt`, `email`, `created`, `ban`, `role`) VALUES
(1, 'test1', 'pass1', '', 'test1@example.com', 0, 0, 0),
(2, 'test2', 'pass2', '', 'test2@example.com', 0, 0, 0),
(3, 'test3', 'pass3', '', 'test3@example.com', 0, 0, 0),
(4, 'test4', 'pass4', '', 'test4@example.com', 0, 0, 0),
(5, 'test5', 'pass5', '', 'test5@example.com', 0, 0, 0),
(6, 'test6', 'pass6', '', 'test6@example.com', 0, 0, 0),
(7, 'test7', 'pass7', '', 'test7@example.com', 0, 0, 0),
(8, 'test8', 'pass8', '', 'test8@example.com', 0, 0, 0),
(9, 'test9', 'pass9', '', 'test9@example.com', 0, 0, 0),
(10, 'test10', 'pass10', '', 'test10@example.com', 0, 0, 0),
(11, 'test11', 'pass11', '', 'test11@example.com', 0, 0, 0),
(12, 'test12', 'pass12', '', 'test12@example.com', 0, 0, 0),
(13, 'test13', 'pass13', '', 'test13@example.com', 0, 0, 0),
(14, 'test14', 'pass14', '', 'test14@example.com', 0, 0, 0),
(15, 'test15', 'pass15', '', 'test15@example.com', 0, 0, 0),
(16, 'test16', 'pass16', '', 'test16@example.com', 0, 0, 0),
(17, 'test17', 'pass17', '', 'test17@example.com', 0, 0, 0),
(18, 'test18', 'pass18', '', 'test18@example.com', 0, 0, 0),
(19, 'test19', 'pass19', '', 'test19@example.com', 0, 0, 0),
(20, 'test20', 'pass20', '', 'test20@example.com', 0, 0, 0),
(21, 'test21', 'pass21', '', 'test21@example.com', 0, 0, 0),
(22, 'admin', 'e5ef8a9e5cf1749daeba305fb0e91412', '$2a$10$.b/3Ti/nYwCVGDx.v597YJ', 'admin@gmail.com', 0, 0, 0),
(24, 'qwerty', '532251fdbcf91939fbcfe941a98c695c', '$2a$10$UzlVhGu2sncknZg0eFmZxA', 'qwerty@gmail.com', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
