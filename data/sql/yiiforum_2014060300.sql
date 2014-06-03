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
-- 表的结构 `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin_level_0', 1, '管理员', NULL, 's:0:"";', 1401720843, 1401720843),
('admin_level_1', 1, '超级版主', NULL, 's:0:"";', 1401720881, 1401720881),
('admin_level_2', 1, '版主', NULL, 's:0:"";', 1401720900, 1401720900),
('category_post', 2, '帖子权限', NULL, 's:0:"";', 1401452696, 1401452696),
('category_thread', 2, '主题权限', NULL, 's:0:"";', 1401452713, 1401452713),
('custom_level_0', 1, '自定义角色0', NULL, 's:0:"";', 1401720765, 1401720765),
('custom_level_1', 1, '自定义角色1', NULL, 's:7:"s:0:"";";', 1401720781, 1401721363),
('group_admin', 1, '管理员组', NULL, 's:0:"";', 1401369900, 1401369900),
('group_custom', 1, '自定义组', NULL, 's:0:"";', 1401451311, 1401451311),
('group_member', 1, '会员组', NULL, 's:0:"";', 1401369927, 1401369927),
('group_special', 1, '特殊组', NULL, 's:0:"";', 1401369950, 1401369950),
('member_level_0', 1, '限制会员', NULL, 's:7:"s:0:"";";', 1401720496, 1401722061),
('member_level_1', 1, '新手上路', NULL, 's:0:"";', 1401720515, 1401720515),
('member_level_2', 1, '注册会员', NULL, 's:0:"";', 1401720529, 1401720529),
('member_level_3', 1, '中级会员', NULL, 's:0:"";', 1401720551, 1401720551),
('member_level_4', 1, '高级会员', NULL, 's:0:"";', 1401720567, 1401720567),
('member_level_5', 1, '金牌会员', NULL, 's:0:"";', 1401720580, 1401720580),
('member_level_6', 1, '论坛元老', NULL, 's:0:"";', 1401720596, 1401720596),
('post_add', 2, '增加回帖', NULL, 's:0:"";', 1401455750, 1401455750),
('post_delete', 2, '删除回帖', NULL, 's:0:"";', 1401455785, 1401455785),
('post_edit', 2, '编辑回帖', NULL, 's:7:"s:0:"";";', 1401455770, 1401459773),
('root_permission', 2, '', NULL, 's:0:"";', 1401451120, 1401451120),
('root_role', 1, '', NULL, 's:0:"";', 1401451102, 1401451102),
('special_level_0', 1, '特殊角色0', NULL, 's:0:"";', 1401720708, 1401720708),
('special_levle_1', 1, '特殊角色1', NULL, 's:0:"";', 1401720727, 1401720727),
('thread_add', 2, '添加主题', NULL, 's:0:"";', 1401455680, 1401455680),
('thread_delete', 2, '删除主题', NULL, 's:0:"";', 1401455712, 1401455712),
('thread_edit', 2, '修改主题', NULL, 's:7:"s:0:"";";', 1401455698, 1401722495),
('thread_view', 2, '浏览主题', NULL, 's:4:"hhhh";', 1401455728, 1401753005);

--
-- 限制导出的表
--

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
