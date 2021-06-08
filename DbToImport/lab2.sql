-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 25 2021 г., 14:41
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lab2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id_file` int(11) UNSIGNED NOT NULL,
  `id_page` int(11) UNSIGNED NOT NULL,
  `name_file` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id_file`, `id_page`, `name_file`) VALUES
(114, 179, 'W:\\domains\\mvc/files/files1/1619350495@Методичка_весна.pdf'),
(113, 178, 'W:\\domains\\mvc/files/files2/1619350360@Без названия.jpg'),
(112, 178, 'W:\\domains\\mvc/files/files3/1619350360@Варианты ДЗ -5 .docx'),
(111, 178, 'W:\\domains\\mvc/files/files3/1619350360@IDZ_MP_Ageev.pdf'),
(110, 177, 'W:\\domains\\mvc/files/files1/1619350216@Лекции по PHP.doc'),
(109, 177, 'W:\\domains\\mvc/files/files3/1619350216@лекции по html.docx');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id_page` int(11) UNSIGNED NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `header_page` varchar(255) NOT NULL,
  `text_page` text NOT NULL,
  `date_page` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id_page`, `email_user`, `header_page`, `text_page`, `date_page`) VALUES
(179, 'test3@test3.test3', 'Сейчас всё чаще звучит шопот бессменных лидеров', 'Задача организации, в особенности же новая модель организационной деятельности требует от нас анализа кластеризации усилий. Сложно сказать, почему некоторые особенности внутренней политики подвергнуты целой серии независимых исследований. С учётом сложившейся международной обстановки, высокотехнологичная концепция общественного уклада требует определения и уточнения системы массового участия. Таким образом, разбавленное изрядной долей эмпатии, рациональное мышление прекрасно подходит для реализации позиций, занимаемых участниками в отношении поставленных задач. Повседневная практика показывает, что семантический разбор внешних противодействий в значительной степени обусловливает важность глубокомысленных рассуждений. В целом, конечно, курс на социально-ориентированный национальный проект способствует подготовке и реализации новых принципов формирования материально-технической и кадровой базы!', '2021-04-25 14:34:55'),
(177, 'test1@test1.test1', 'Только экономическая повестка сегодняшнего дня станет частью наших традиций', 'Безусловно, существующая теория выявляет срочную потребность модели развития. Разнообразный и богатый опыт говорит нам, что постоянное информационно-пропагандистское обеспечение нашей деятельности требует анализа глубокомысленных рассуждений. Есть над чем задуматься: базовые сценарии поведения пользователей неоднозначны и будут преданы социально-демократической анафеме. Есть над чем задуматься: непосредственные участники технического прогресса ассоциативно распределены по отраслям. Лишь интерактивные прототипы объединены в целые кластеры себе подобных.', '2021-04-25 14:30:12'),
(178, 'test2@test2.test2', 'Светлый лик правового взаимодействия развеял последние сомнения', 'Диаграммы связей представлены в исключительно положительном свете. Внезапно, диаграммы связей объявлены нарушающими общечеловеческие нормы этики и морали! Не следует, однако, забывать, что современная методология разработки обеспечивает актуальность новых предложений. И нет сомнений, что ключевые особенности структуры проекта, инициированные исключительно синтетически, ассоциативно распределены по отраслям. Повседневная практика показывает, что внедрение современных методик выявляет срочную потребность прогресса профессионального сообщества. Разнообразный и богатый опыт говорит нам, что повышение уровня гражданского сознания позволяет оценить значение инновационных методов управления процессами. Каждый из нас понимает очевидную вещь: синтетическое тестирование однозначно определяет каждого участника как способного принимать собственные решения касаемо позиций, занимаемых участниками в отношении поставленных задач.', '2021-04-25 14:32:34');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_users` int(11) UNSIGNED NOT NULL,
  `name_users` varchar(255) NOT NULL,
  `password_users` varchar(255) NOT NULL,
  `email_users` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_users`, `name_users`, `password_users`, `email_users`) VALUES
(28, 'Админ', '$2y$10$g5q1MiXWwCHZdVsP9cM8fORRpdlXwEtuFLv/I2FKKcowm88prwWCS', 'test@test.test'),
(27, 'Данил', '$2y$10$U4cBQnBFOry5yzbpql6KOufRiB6JbWqdAYX.CkrHPxHh1Do50CFs6', 'test3@test3.test3'),
(26, 'Егор', '$2y$10$b9Kr2PPDeNdnm9cMTIcZ3ON2OBrif9SqhlFe.9iIf913UfZR5l/4W', 'test2@test2.test2'),
(25, 'Артем', '$2y$10$LrvljUvMwZceVE7CYJhTjuwsBgNnNmPMj7x246ygFdcDXbMrvXzve', 'test1@test1.test1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id_file`),
  ADD UNIQUE KEY `name_file` (`name_file`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email_users` (`email_users`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id_file` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
