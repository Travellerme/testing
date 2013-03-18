-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 18 2013 г., 17:46
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
-- Структура таблицы `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `imgUrl` varchar(100) NOT NULL,
  `timeStart` int(11) NOT NULL,
  `timeEnd` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `title`, `imgUrl`, `timeStart`, `timeEnd`, `description`) VALUES
(1, 'title_1', 'image.png', 1372850100, 1372865400, 'desc_1'),
(2, 'title_2', 'Image2.png', 1373045700, 1373053020, 'desc_2'),
(3, 'title_3', 'image3.png', 1373199000, 1373209200, 'desc_3');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `salt`, `email`) VALUES
(1, 'test1', 'pass1', '', 'test1@example.com'),
(2, 'test2', 'pass2', '', 'test2@example.com'),
(3, 'test3', 'pass3', '', 'test3@example.com'),
(4, 'test4', 'pass4', '', 'test4@example.com'),
(5, 'test5', 'pass5', '', 'test5@example.com'),
(6, 'test6', 'pass6', '', 'test6@example.com'),
(7, 'test7', 'pass7', '', 'test7@example.com'),
(8, 'test8', 'pass8', '', 'test8@example.com'),
(9, 'test9', 'pass9', '', 'test9@example.com'),
(10, 'test10', 'pass10', '', 'test10@example.com'),
(11, 'test11', 'pass11', '', 'test11@example.com'),
(12, 'test12', 'pass12', '', 'test12@example.com'),
(13, 'test13', 'pass13', '', 'test13@example.com'),
(14, 'test14', 'pass14', '', 'test14@example.com'),
(15, 'test15', 'pass15', '', 'test15@example.com'),
(16, 'test16', 'pass16', '', 'test16@example.com'),
(17, 'test17', 'pass17', '', 'test17@example.com'),
(18, 'test18', 'pass18', '', 'test18@example.com'),
(19, 'test19', 'pass19', '', 'test19@example.com'),
(20, 'test20', 'pass20', '', 'test20@example.com'),
(21, 'test21', 'pass21', '', 'test21@example.com'),
(22, 'admin', 'e5ef8a9e5cf1749daeba305fb0e91412', '$2a$10$.b/3Ti/nYwCVGDx.v597YJ', 'admin@gmail.com'),
(24, 'qwerty', '532251fdbcf91939fbcfe941a98c695c', '$2a$10$UzlVhGu2sncknZg0eFmZxA', 'qwerty@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
