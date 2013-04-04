-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 04 2013 г., 21:36
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
  `titleCategory` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `titleCategory`, `position`) VALUES
(1, 'Новости', 'left'),
(2, 'Репертуар', 'top'),
(3, 'События', 'left'),
(4, 'Планы', 'left');

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
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `content`, `event_id`, `created`, `user_id`, `guest`, `status`) VALUES
(7, 'sdf', 2, 1364577098, 0, 'sadasdas', 0),
(8, 'qqqqqqqqq', 2, 1364577162, 0, 'qqqqqqqq', 0),
(9, 'aaaaaaaa', 2, 1364577787, 0, 'qaq', 0),
(11, 'qweeeeeeeee', 2, 1364578373, 22, '', 0),
(12, 'fffffffff', 2, 1364578401, 22, '', 0),
(13, 'zxcz', 4, 1364589742, 22, '', 0),
(14, 'a', 4, 1364589748, 22, '', 0),
(15, 'asdada', 4, 1364589800, 22, '', 0),
(16, 'asdasdad', 4, 1364823567, 0, 'name', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timeStart` int(11) NOT NULL,
  `timeEnd` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `title`, `timeStart`, `timeEnd`, `description`, `created`, `status`, `category_id`) VALUES
(1, 'title_1', 1372850100, 1372865400, 'desc_1', 1363893892, 0, 1),
(2, 'title_2', 1373045700, 1373053020, 'desc_2', 1363893892, 0, 2),
(3, 'title_3', 1373199000, 1373209200, 'desc_3', 1363893892, 0, 1),
(4, 'Событие_4', 1364217052, 1364224672, '<p>\r\n	asdasdasd</p>\r\n<p>\r\n	asdasdas<img align="middle" alt="" height="68" src="/upload/userfiles/images/screen.png" width="100" /></p>\r\n', 1363893892, 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_setting`
--

CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `defaultStatusComment` int(11) NOT NULL,
  `defaultStatusUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `defaultStatusComment`, `defaultStatusUser`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `salt`, `email`, `created`, `ban`, `role`) VALUES
(22, 'admin', 'a88ab20dfb86f3ba5985e757185db6a8', '$2a$10$Bia6t436WGgYPU5SyEtJkE', 'admin@gmail.com', 0, 0, 1),
(24, 'qwerty', '9d528e96251e1dec9fb12ab24d8c2183', '$2a$10$wUO2Zk7cvPpjaZRUbIsm65', 'qwerty@gmail.com', 0, 0, 0),
(25, 'username', '67857496f622e324f889d957717f6483', '$2a$10$7ke1LXo7X/I1jCqV7SrShg', 'username@user.com', 0, 0, 0),
(26, 'user123', '623098f378bb4a08ea7f788f675f3edf', '$2a$10$I8aNFKuychIGQv1N2j/K2i', 'user@user.ru', 1363978898, 0, 0),
(27, 'qwertyw', 'd43904df1ba71b07e647ed2136af3528', '$2a$10$NwZ2fVNE/DO5CRONhKM5d7', 'qwerty@asda.sa', 1364495959, 0, 0),
(28, 'qwertyw2', 'd64fe804b7fdc7151c1ebd2410a659c9', '$2a$10$NXrUWDR8KJj4Lieh0E/uMO', 'qwerty@asda.sa2', 1364496038, 0, 0),
(29, 'qwertyw2a', 'dd6513cd83fdca67ced5749d7a18f97c', '$2a$10$9cLO2GuxyG2uojUmbT2DT5', 'qwerty@asda.sa2a', 1364496078, 0, 0),
(30, 'qwertyw2asw', '9fa7103bf0b3a613656ec2521314f7fe', '$2a$10$tphMhTCrG1w/KFpocVyX7t', 'qwerty@asda.sa2a1', 1364496238, 0, 0),
(31, 'asdas', 'a6e1fd958ed830151e691d35139cc62c', '$2a$10$qawiuf/ZY/Xig5jaW4QBJb', 'qweq@adda.aq', 1364496295, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_video`
--

CREATE TABLE IF NOT EXISTS `tbl_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_video`
--

INSERT INTO `tbl_video` (`id`, `title`, `description`, `link`, `created`) VALUES
(1, 'Clutch - Ghost', '<p>\r\n	Описание тратата, классная песня</p>\r\n<ul>\r\n	<li>\r\n		фвф</li>\r\n	<li>\r\n		фв</li>\r\n	<li>\r\n		ввв</li>\r\n</ul>\r\n', '<iframe width="560" height="315" src="http://www.youtube.com/embed/42yUeYKNYck" frameborder="0" allowfullscreen></iframe>\r\n', 1365004736);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
