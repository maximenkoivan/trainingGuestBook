-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 04 2021 г., 23:01
-- Версия сервера: 8.0.27-0ubuntu0.20.04.1
-- Версия PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `guest_book`
--
CREATE DATABASE IF NOT EXISTS `guest_book` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `guest_book`;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `post` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` int DEFAULT NULL,
  `user_ip` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `browser_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post`, `date_time`, `user_ip`, `browser_info`) VALUES
(31, 37, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '8', 'Mozilla/5.0 (compatible; MSIE 6.0; Windows CE; Trident/4.1)'),
(32, 38, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '17', 'Mozilla/5.0 (X11; Linux x86_64; rv:5.0) Gecko/20160724 Firefox/35.0'),
(33, 39, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '127', 'Opera/8.23 (X11; Linux x86_64; en-US) Presto/2.9.267 Version/10.00'),
(34, 40, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '109', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 5.1; Trident/4.1)'),
(35, 41, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '143', 'Mozilla/5.0 (X11; Linux i686; rv:7.0) Gecko/20180915 Firefox/36.0'),
(36, 42, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '44', 'Mozilla/5.0 (Macintosh; PPC Mac OS X 10_5_0) AppleWebKit/5320 (KHTML, like Gecko) Chrome/37.0.843.0 Mobile Safari/5320'),
(37, 43, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '63', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_7_8 rv:6.0) Gecko/20180911 Firefox/36.0'),
(38, 44, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '192', 'Mozilla/5.0 (Windows 95; en-US; rv:1.9.2.20) Gecko/20120214 Firefox/36.0'),
(39, 45, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '222', 'Mozilla/5.0 (Windows 98) AppleWebKit/5322 (KHTML, like Gecko) Chrome/37.0.899.0 Mobile Safari/5322'),
(40, 46, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '22', 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_7_4 rv:5.0) Gecko/20120718 Firefox/37.0'),
(41, 47, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '32', 'Opera/9.25 (X11; Linux i686; en-US) Presto/2.8.278 Version/12.00'),
(42, 48, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '1', 'Mozilla/5.0 (Windows NT 4.0; sl-SI; rv:1.9.2.20) Gecko/20140306 Firefox/36.0'),
(43, 49, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '190', 'Mozilla/5.0 (Windows; U; Windows 98) AppleWebKit/534.16.3 (KHTML, like Gecko) Version/4.0 Safari/534.16.3'),
(44, 50, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '194', 'Mozilla/5.0 (compatible; MSIE 11.0; Windows NT 5.01; Trident/5.1)'),
(45, 51, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '133', 'Opera/9.92 (Windows 95; sl-SI) Presto/2.8.235 Version/12.00'),
(46, 52, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '44', 'Opera/9.83 (Windows NT 5.1; sl-SI) Presto/2.11.207 Version/12.00'),
(47, 53, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '54', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_8) AppleWebKit/5350 (KHTML, like Gecko) Chrome/38.0.854.0 Mobile Safari/5350'),
(48, 54, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '48', 'Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.0; Trident/5.1)');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`) VALUES
(37, 'Frida Pagac', 'ppagac@gmail.com'),
(38, 'Oceane White', 'joelle.nitzsche@walker.com'),
(39, 'Mr. Ike Ziemann', 'lilian43@block.com'),
(40, 'Prof. Eldred Nikolaus PhD', 'rhills@yahoo.com'),
(41, 'Sandrine Pollich', 'tyreek79@hotmail.com'),
(42, 'Lorenzo Rutherford', 'weldon95@gmail.com'),
(43, 'Milan Fay MD', 'ryleigh94@schamberger.com'),
(44, 'Elouise Dickens', 'antoinette.hudson@huels.info'),
(45, 'Zena Crooks', 'dena.roob@yahoo.com'),
(46, 'Wilton Schoen', 'maddison.robel@hotmail.com'),
(47, 'Jayme Emmerich', 'stephanie56@hirthe.com'),
(48, 'Thad Powlowski', 'libbie84@huel.com'),
(49, 'Mallory Roob', 'dboyle@hotmail.com'),
(50, 'Asa Feeney II', 'hmayer@yahoo.com'),
(51, 'Euna Christiansen', 'josie28@heathcote.biz'),
(52, 'Adela Rath', 'zemlak.russell@luettgen.org'),
(53, 'Twila O\'Kon', 'koelpin.dale@cummings.com'),
(54, 'Herman O\'Reilly', 'fstrosin@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
