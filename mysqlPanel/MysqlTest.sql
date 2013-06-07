

--
-- Структура таблицы `tbl_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ;
-----------------------------------------------------

--
-- Структура таблицы `tbl_answer_text`
--

CREATE TABLE IF NOT EXISTS `tbl_answer_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_answer` int(11) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `verity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);



--
-- Структура таблицы `tbl_question`
--

CREATE TABLE IF NOT EXISTS `tbl_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);



--
-- Структура таблицы `tbl_question_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_question_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `flagAnswer` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Структура таблицы `tbl_question_test`
--

CREATE TABLE IF NOT EXISTS `tbl_question_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `typeAnswer` int(11) DEFAULT NULL,
  `status` enum('work','old') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Структура таблицы `tbl_test`
--

CREATE TABLE IF NOT EXISTS `tbl_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('work','old') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
);


--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `salt`, `created`, `role`) VALUES
(1, 'admin', 'a88ab20dfb86f3ba5985e757185db6a8', '$2a$10$Bia6t436WGgYPU5SyEtJkE', 1338225000, 1);


-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_user_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_try` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Структура таблицы `tbl_user_multi_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_user_multi_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_answer` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Структура таблицы `tbl_user_test`
--

CREATE TABLE IF NOT EXISTS `tbl_user_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `statusAccess` enum('denied','allow','inProcess','reviewed') COLLATE utf8_unicode_ci DEFAULT NULL,
  `percentRight` int(11) DEFAULT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
