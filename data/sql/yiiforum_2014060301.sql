-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 06 月 03 日 00:01
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

DROP TABLE IF EXISTS `auth_item_child`;
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
('group_admin', 'admin_level_0'),
('group_admin', 'admin_level_1'),
('group_admin', 'admin_level_2'),
('root_permission', 'category_post'),
('root_permission', 'category_thread'),
('group_custom', 'custom_level_0'),
('group_custom', 'custom_level_1'),
('root_role', 'group_admin'),
('root_role', 'group_custom'),
('root_role', 'group_member'),
('root_role', 'group_special'),
('group_member', 'member_level_0'),
('group_member', 'member_level_1'),
('group_member', 'member_level_2'),
('group_member', 'member_level_3'),
('group_member', 'member_level_4'),
('group_member', 'member_level_5'),
('group_member', 'member_level_6'),
('admin_level_0', 'post_add'),
('category_post', 'post_add'),
('member_level_2', 'post_add'),
('member_level_3', 'post_add'),
('member_level_4', 'post_add'),
('member_level_5', 'post_add'),
('member_level_6', 'post_add'),
('admin_level_0', 'post_delete'),
('category_post', 'post_delete'),
('member_level_1', 'post_delete'),
('member_level_2', 'post_delete'),
('member_level_3', 'post_delete'),
('member_level_4', 'post_delete'),
('member_level_5', 'post_delete'),
('member_level_6', 'post_delete'),
('admin_level_0', 'post_edit'),
('category_post', 'post_edit'),
('member_level_1', 'post_edit'),
('member_level_2', 'post_edit'),
('member_level_3', 'post_edit'),
('member_level_4', 'post_edit'),
('member_level_5', 'post_edit'),
('member_level_6', 'post_edit'),
('group_special', 'special_level_0'),
('group_special', 'special_levle_1'),
('admin_level_0', 'thread_add'),
('category_thread', 'thread_add'),
('member_level_1', 'thread_add'),
('member_level_2', 'thread_add'),
('member_level_3', 'thread_add'),
('member_level_4', 'thread_add'),
('member_level_5', 'thread_add'),
('member_level_6', 'thread_add'),
('admin_level_0', 'thread_delete'),
('category_thread', 'thread_delete'),
('member_level_1', 'thread_delete'),
('member_level_2', 'thread_delete'),
('member_level_3', 'thread_delete'),
('member_level_4', 'thread_delete'),
('member_level_5', 'thread_delete'),
('member_level_6', 'thread_delete'),
('admin_level_0', 'thread_edit'),
('category_thread', 'thread_edit'),
('member_level_1', 'thread_edit'),
('member_level_2', 'thread_edit'),
('member_level_3', 'thread_edit'),
('member_level_4', 'thread_edit'),
('member_level_5', 'thread_edit'),
('member_level_6', 'thread_edit'),
('admin_level_0', 'thread_view'),
('category_thread', 'thread_view'),
('member_level_1', 'thread_view'),
('member_level_2', 'thread_view'),
('member_level_3', 'thread_view'),
('member_level_4', 'thread_view'),
('member_level_5', 'thread_view'),
('member_level_6', 'thread_view');

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
