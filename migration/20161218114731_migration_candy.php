<?php
/**
 * Migration Task class.
 */
class MigrationCandy
{
  public function preUp()
  {
      // add the pre-migration code here
  }

  public function postUp()
  {
      // add the post-migration code here
  }

  public function preDown()
  {
      // add the pre-migration code here
  }

  public function postDown()
  {
      // add the post-migration code here
  }

  public function getUpSQL()
  {
    return <<<END
-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 年 12 月 17 日 10:50
-- サーバのバージョン： 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+09:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candy`
--
USE candy;
CREATE DATABASE IF NOT EXISTS `candy` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `candy`;

-- --------------------------------------------------------

--
-- テーブルの構造 `category_l`
--

DROP TABLE IF EXISTS `category_l`;
CREATE TABLE IF NOT EXISTS `category_l` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `category_m`
--

DROP TABLE IF EXISTS `category_m`;
CREATE TABLE IF NOT EXISTS `category_m` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_l_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`category_l_id`),
  KEY `category_l_id` (`category_l_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `category_recipe_relations`
--

DROP TABLE IF EXISTS `category_recipe_relations`;
CREATE TABLE IF NOT EXISTS `category_recipe_relations` (
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `category_s_id` int(10) UNSIGNED NOT NULL,
  `category_m_id` int(10) UNSIGNED NOT NULL,
  `category_l_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`,`category_s_id`,`category_m_id`,`category_l_id`),
  KEY `category_s_id` (`category_s_id`,`category_m_id`,`category_l_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `category_s`
--

DROP TABLE IF EXISTS `category_s`;
CREATE TABLE IF NOT EXISTS `category_s` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_m_id` int(10) UNSIGNED NOT NULL,
  `category_l_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`category_m_id`,`category_l_id`),
  KEY `category_m_id` (`category_m_id`,`category_l_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `ingredients_no` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`,`ingredients_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `ingredients`
--

INSERT INTO `ingredients` (`recipe_id`, `ingredients_no`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(5, 1, 'バター', '140g', '2016-11-28 01:03:57', '2016-11-28 01:03:57');

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `img_url` text,
  `mail` varchar(255) NOT NULL,
  `login_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `pos_code` char(7) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`id`, `name`, `img_url`, `mail`, `login_id`, `password`, `pos_code`, `address`, `created_at`, `updated_at`) VALUES
(1, 'aaa', NULL, '', '', '', NULL, NULL, '2016-11-27 03:58:59', '2016-11-27 03:58:59');

-- --------------------------------------------------------

--
-- テーブルの構造 `member_favorite_recipe`
--

DROP TABLE IF EXISTS `member_favorite_recipe`;
CREATE TABLE IF NOT EXISTS `member_favorite_recipe` (
  `member_id` int(10) UNSIGNED NOT NULL,
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`member_id`,`recipe_id`),
  KEY `id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `clip` text,
  `explain` text NOT NULL,
  `point` varchar(300) NOT NULL,
  `mistake` varchar(300) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `member_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `clip`, `explain`, `point`, `mistake`, `views`, `member_id`, `created_at`, `updated_at`) VALUES
(5, 'ボックスクッキー', 'sample.mp4', 'ココアはバンホーテンを使いました！ 甘くなりすぎないクッキーに仕上がってます。 コーヒーと一緒につまむのに丁度良いです！ココアはバンホーテンを使いました！ 甘くなりすぎないクッキーに仕上がってます。 コーヒーと一緒につまむのに丁度良いです！', 'ココアはバンホーテンを使いました！ 甘くなりすぎないクッキーに仕上がってます。 コーヒーと一緒につまむのに丁度良いです！', '焼き方が', 0, 1, '2016-11-28 00:25:47', '2016-11-28 00:36:24'),
(6, 'あめ', 'sample.mp4', 'りんごあめ', '温度', 'こげる', 0, 1, '2016-11-28 04:46:36', '2016-11-28 04:46:36'),
(26, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:08:48', '2016-12-12 01:08:48'),
(27, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:10:17', '2016-12-12 01:10:17'),
(28, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:10:56', '2016-12-12 01:10:56'),
(29, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:11:49', '2016-12-12 01:11:49'),
(30, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:12:37', '2016-12-12 01:12:37'),
(31, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:14:29', '2016-12-12 01:14:29'),
(32, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:18:46', '2016-12-12 01:18:46'),
(33, 'どうぞ', 'どーもくん　どーもニュース.mp4', 'あああ', 'w', 'w', 0, 1, '2016-12-12 01:30:03', '2016-12-12 01:30:03'),
(34, '3', 'どーもくん　どーもニュース.mp4', 'e', 'e', 'e', 0, 1, '2016-12-12 05:33:16', '2016-12-12 05:33:16');

-- --------------------------------------------------------

--
-- テーブルの構造 `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `review_no` int(10) UNSIGNED NOT NULL,
  `reply_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`,`review_no`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `review`
--

INSERT INTO `review` (`recipe_id`, `review_no`, `reply_id`, `comment`, `member_id`, `created_at`, `updated_at`) VALUES
(5, 1, 1, '美味しかった！', 1, '2016-11-28 01:01:38', '2016-11-28 01:01:38');

-- --------------------------------------------------------

--
-- テーブルの構造 `step`
--

DROP TABLE IF EXISTS `step`;
CREATE TABLE IF NOT EXISTS `step` (
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `step_no` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `img_url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`,`step_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `step`
--

INSERT INTO `step` (`recipe_id`, `step_no`, `description`, `img_url`, `created_at`, `updated_at`) VALUES
(5, 1, '柔らかくしたバターを砂糖と混ぜる\r\nバターをチンしたら溶けすぎたので、冷蔵庫で冷やしてから砂糖と混ぜました', NULL, '2016-11-28 01:02:39', '2016-11-28 01:02:39'),
(5, 2, '次に、卵を加えて混ぜる', NULL, '2016-11-28 01:02:39', '2016-11-28 01:02:39');

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `category_m`
--
ALTER TABLE `category_m`
  ADD CONSTRAINT `category_m_ibfk_1` FOREIGN KEY (`category_l_id`) REFERENCES `category_l` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `category_recipe_relations`
--
ALTER TABLE `category_recipe_relations`
  ADD CONSTRAINT `category_recipe_relations_ibfk_1` FOREIGN KEY (`category_s_id`,`category_m_id`,`category_l_id`) REFERENCES `category_s` (`id`, `category_m_id`, `category_l_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `category_recipe_relations_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `category_s`
--
ALTER TABLE `category_s`
  ADD CONSTRAINT `category_s_ibfk_1` FOREIGN KEY (`category_m_id`,`category_l_id`) REFERENCES `category_m` (`id`, `category_l_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `member_favorite_recipe`
--
ALTER TABLE `member_favorite_recipe`
  ADD CONSTRAINT `member_favorite_recipe_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `member_favorite_recipe_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- テーブルの制約 `step`
--
ALTER TABLE `step`
  ADD CONSTRAINT `step_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

END;
  }


  public function getDownSQL()
  {
    return <<<END
DROP TABLE IF EXISTS `category_recipe_relations`;
DROP TABLE IF EXISTS `category_s`;
DROP TABLE IF EXISTS `category_m`;
DROP TABLE IF EXISTS `category_l`;
DROP TABLE IF EXISTS `review`;
DROP TABLE IF EXISTS `member_favorite_recipe`;
DROP TABLE IF EXISTS `ingredients`;
DROP TABLE IF EXISTS `schema_version`;
DROP TABLE IF EXISTS `step`;
DROP TABLE IF EXISTS `recipe`;
DROP TABLE IF EXISTS `member`;
END;
  }

}