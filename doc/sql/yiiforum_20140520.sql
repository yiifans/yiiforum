-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 20 日 00:29
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yiiforum`
--
CREATE DATABASE IF NOT EXISTS `yiiforum` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yiiforum`;

-- --------------------------------------------------------

--
-- 表的结构 `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(128) NOT NULL,
  `threads` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `board`
--

INSERT INTO `board` (`id`, `parent_id`, `name`, `description`, `threads`, `posts`) VALUES
(1, 0, '新闻', '新闻', 0, 0),
(2, 1, '国内', '国内', 0, 0),
(3, 1, '国际', '国际', 0, 0),
(4, 1, '社会', '社会', 0, 0),
(5, 0, '体育', '体育', 0, 0),
(6, 5, 'NBA', 'NBA', 0, 0),
(7, 5, 'CBA', 'CBA', 0, 0),
(8, 5, '足球', '足球', 0, 0),
(9, 0, '科技', '科技', 0, 0),
(10, 9, '互联网', '互联网', 0, 0),
(11, 9, '数码产品', '数码产品', 0, 0),
(12, 9, '探索', '探索', 0, 0),
(13, 9, '手机', '手机', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1400502923),
('m130524_201442_init', 1400502936);

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `title` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `supports` int(11) NOT NULL DEFAULT '0',
  `againsts` int(11) NOT NULL DEFAULT '0',
  `floor` int(11) NOT NULL DEFAULT '0',
  `note` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `thread_id`, `user_id`, `user_name`, `title`, `body`, `create_time`, `modify_time`, `supports`, `againsts`, `floor`, `note`) VALUES
(1, 15, 0, 'admin', 'bb', 'bb', '2014-05-19 07:02:00', '2014-05-19 15:02:00', 0, 0, 0, ''),
(2, 15, 0, 'admin', 'yy', 'yy', '2014-05-19 07:32:50', '2014-05-19 07:32:50', 0, 0, 0, ''),
(3, 15, 0, 'admin', 'cc', 'cc', '2014-05-19 07:32:56', '2014-05-19 07:32:56', 0, 0, 0, ''),
(4, 18, 0, 'admin', 'ttt', 'ttt', '2014-05-19 07:59:44', '2014-05-19 07:59:44', 0, 0, 0, ''),
(5, 1, 0, 'admin', 'tt', 'tt', '2014-05-19 14:38:50', '2014-05-19 14:38:50', 0, 0, 0, ''),
(6, 19, 0, 'admin', 'bb', 'bb', '2014-05-19 14:39:13', '2014-05-19 14:39:13', 0, 0, 0, ''),
(7, 19, 0, 'admin', 'uu', 'uu', '2014-05-19 14:50:25', '2014-05-19 14:50:25', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `board_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `title` varchar(256) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `views` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `note1` varchar(64) DEFAULT NULL,
  `note2` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `thread`
--

INSERT INTO `thread` (`id`, `board_id`, `user_id`, `user_name`, `title`, `create_time`, `modify_time`, `views`, `posts`, `status`, `note1`, `note2`) VALUES
(1, 2, 0, 'admin', 'aaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(2, 2, 0, 'admin', '子孙', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(3, 2, 0, 'admin', 'bbb', '2014-05-19 06:01:33', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(4, 2, 0, 'admin', 'ttww', '2014-05-19 06:15:22', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(5, 3, 0, 'admin', 'tt', '2014-05-19 06:19:05', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(6, 3, 0, 'admin', 'tt', '2014-05-19 06:21:15', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(7, 2, 0, 'admin', 'www', '2014-05-19 06:29:56', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(8, 2, 0, 'admin', 'www', '2014-05-19 06:36:09', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(9, 2, 0, 'admin', 'yyy', '2014-05-19 06:39:36', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(10, 2, 0, 'admin', 'yyy', '2014-05-19 06:45:32', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(11, 2, 0, 'admin', 'uu', '2014-05-19 06:54:03', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(12, 2, 0, 'admin', '123', '2014-05-19 06:55:45', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(13, 2, 0, 'admin', 'a', '2014-05-19 06:57:37', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(14, 2, 0, 'admin', 'cc', '2014-05-19 07:01:20', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(15, 2, 0, 'admin', 'bb', '2014-05-19 07:02:00', '0000-00-00 00:00:00', 0, 0, 4, NULL, NULL),
(16, 2, 0, 'admin', 'ttt', '2014-05-19 07:58:33', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(17, 2, 0, 'admin', 'ttt', '2014-05-19 07:59:05', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(18, 2, 0, 'admin', 'ttt', '2014-05-19 07:59:44', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL),
(19, 2, 0, 'admin', 'bb', '2014-05-19 14:39:13', '0000-00-00 00:00:00', 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
