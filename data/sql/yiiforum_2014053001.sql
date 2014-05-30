-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 05 月 30 日 14:32
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

-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('group_admin', 'admin'),
('group_admin', 'board_role'),
('root_permission', 'category_post'),
('root_permission', 'category_thread'),
('root_role', 'group_admin'),
('root_role', 'group_custom'),
('root_role', 'group_member'),
('root_role', 'group_special'),
('group_member', 'member_hight'),
('group_member', 'member_low'),
('group_member', 'member_middle'),
('category_post', 'post_add'),
('member_hight', 'post_add'),
('admin', 'post_delete'),
('category_post', 'post_delete'),
('member_low', 'post_delete'),
('category_post', 'post_edit'),
('member_hight', 'post_edit'),
('member_low', 'post_edit'),
('category_thread', 'thread_add'),
('category_thread', 'thread_delete'),
('admin', 'thread_edit'),
('category_thread', 'thread_edit'),
('member_low', 'thread_edit'),
('admin', 'thread_view'),
('category_thread', 'thread_view'),
('member_hight', 'thread_view');

--
-- 限制导出的表
--

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
