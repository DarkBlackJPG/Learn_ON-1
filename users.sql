-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2016 at 05:30 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `level` tinyint(1) NOT NULL,
  `chat_key` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_chat_key_unique` (`chat_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirmed`, `confirmation_code`, `profile`, `level`, `chat_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Veljko', 'veledjokic@gmail.com', '$2y$10$yN9k3e0cF61ud7My9XhpzOqx.Gfb.O6CkEN580RiPRgzIhJK7Bf7C', 1, NULL, '1.jpg', 1, 'P2smmk20VfREbT7Of6sBS0CE2SIjxK', 'HIkzffcbsFc0ZbxIDDvS4RowblxLTHSBXgPMGC6aXe90uVci2GvLzFXXa8Vr', '2016-02-20 13:56:37', '2016-02-22 19:09:07'),
(7, 'Stefan', 'email@email.com', '$2y$10$ox12h8Y0KpbP6jl4n1/AHeFLiczs4Ylz688IJvGwVVxKpmoDSzO8a', 1, NULL, '7.png', 0, 'u9K2I7pt7YpNTpiFvw9pSoW58MZnWX', 'N2u6tqgGpyONf9Rdq0ft0tzYptMBhGbR4mIJ4oan3KxE5WXZBbgAS5Hoj8uG', '2016-02-20 14:53:22', '2016-02-22 19:03:58'),
(9, 'Nikola', 'nikola@gmail.com', '$2y$10$uwFfjPC7YzMsWC2e.mxx8Oco.az6ntmvsjP1wj36qXFvCg3vh4qGK', 1, NULL, '9.jpg', 0, 'mEAf3s8LStiqwjgfITE7lXwLIuFiyX', 'W1lzIm2TXx3oY0zRC8iC7wtCZMw4qSb6FWszOQy6R2CidpCJEVGUC4WGD2Dg', '2016-02-22 19:03:19', '2016-02-24 16:18:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
