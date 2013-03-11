-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2013 at 04:22 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smsappota`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `action`, `description`) VALUES
(1, 'Quản trị người dùng', 'user', 'Quản trị danh sách người dùng'),
(3, 'Quản trị nhóm người dùng', 'group', 'Quản trị danh sách nhóm người dùng'),
(4, 'Thêm nhóm người dùng mới', 'group/add', 'Thêm nhóm người dùng mới'),
(5, 'Sửa nhóm người dùng', 'group/edit', 'Sửa nhóm người dùng'),
(6, 'Xóa nhóm người dùng', 'group/delete', 'Xóa nhóm người dùng'),
(7, 'Thêm người dùng mới', 'user/add', 'Thêm người dùng mới'),
(8, 'Sửa người dùng', 'user/edit', 'Sửa người dùng'),
(9, 'Xóa người dùng', 'user/delete', 'Xóa người dùng'),
(10, 'Quản trị phân quyền', 'grouproles', 'Quản trị danh sách phân quyền'),
(11, 'Sửa phân quyền', 'grouproles/ajax_submit', 'Sửa phân quyền'),
(12, 'Quản lý danh sách quyền', 'roles', 'Quản lý danh sách quyền'),
(13, 'Thêm quyền', 'roles/add', 'Thêm quyền sử dụng mới'),
(14, 'Sửa quyền', 'roles/edit', 'Sửa quyền sử dụng'),
(15, 'Xóa quyền', 'roles/delete', 'Xóa quyền sử dụng'),
(16, 'Xử lý thêm mới và sửa thành viên', 'user/action_user', 'Xử lý thêm mới và sửa thành viên'),
(17, 'Xử lý thêm mới và sửa nhóm người dùng', 'group/action_group', 'Xử lý thêm mới và sửa nhóm người dùng'),
(18, 'Xử lý thêm mới và sửa danh sách quyền', 'roles/action_roles', 'Xử lý thêm mới và sửa danh sách quyền'),
(19, 'Quản trị hệ điều hành', 'operator', 'Quản trị danh sách hệ điều hành'),
(20, 'Thêm mới hệ điều hành', 'operator/add', 'Thêm mới hệ điều hành'),
(21, 'Sửa hệ điều hành', 'operator/edit', 'Sửa hệ điều hành'),
(22, 'Xóa hệ điều hành', 'operator/delete', 'Xóa hệ điều hành'),
(23, 'Xử lý thêm mới và sửa hệ điều hành', 'operator/action_operator', 'Xử lý thêm mới và sửa hệ điều hành'),
(24, 'Quản trị danh sách khách hàng', 'customers', 'Quản trị danh sách khách hàng'),
(25, 'Thêm danh sách khách hàng', 'customers/add', 'Thêm danh sách khách hàng'),
(26, 'Sửa danh sách khách hàng', 'customers/edit', 'Sửa danh sách khách hàng'),
(27, 'Xử lý thêm mới và sửa khách hàng', 'customers/action_customer', 'Xử lý thêm mới và sửa khách hàng'),
(28, 'xóa khách hàng', 'customers/delete', 'xóa khách hàng');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
