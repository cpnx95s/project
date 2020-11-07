-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2020 at 05:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL COMMENT 'รหัสช่องทางสังคมออนไลน์',
  `name` varchar(40) NOT NULL COMMENT 'ชื่อช่องทางสังคมออนไลน์',
  `description` text DEFAULT NULL COMMENT 'คำอธิบายช่องทางสังคมออนไลน์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `name`, `description`) VALUES
(1, 'Facebook', 'Facebook'),
(2, 'Line', 'Line'),
(3, 'Website', 'Website'),
(4, 'Mobile Application', 'Mobile Application'),
(5, 'Twitter', 'Twitter'),
(6, 'Instagram', 'Instagram');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT 'รหัสของการการแสดงความคิดเห็น',
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT 'เนื้อหาในการแสดงความคิดเห็น',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `task_id` int(11) NOT NULL COMMENT 'รายการงานของการแสดงความคิดเห็น',
  `user_id` int(11) NOT NULL COMMENT 'ผู้ที่แสดงความคิดเห็น'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `content`, `created`, `updated`, `task_id`, `user_id`) VALUES
(1, 'Lorem ipsum', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet est placerat in egestas erat imperdiet sed. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus vit', '2020-11-03 22:45:36', NULL, 50, 1),
(2, 'เทส', '<p>dcbfnghfkujghjklghfgjh</p>', '2020-11-03 22:47:42', NULL, 50, 1),
(3, 'fsgdfgsdfg', '<p>sfdgsdfsdfgsd</p>', '2020-11-03 22:48:14', NULL, 50, 1),
(4, 'fgsdfgsdf', '<p>sdfgsdfgsdfgsdfgsdfg</p>', '2020-11-03 22:50:34', NULL, 50, 1),
(5, 'เทส', '<p>เทส</p>', '2020-11-03 22:55:11', NULL, 50, 1),
(6, 'เทสฟานี่', '<p>คอมเม้นท์ฟานี่</p>', '2020-11-07 00:41:16', NULL, 50, 2),
(7, 'เทสฟานี่', '<p>คอมเม้นท์ฟานี่</p>', '2020-11-07 00:43:02', NULL, 50, 2),
(8, 'เทส', '<p>asdfasd</p>', '2020-11-07 00:44:51', NULL, 50, 2),
(9, 'test', '<p>test</p>', '2020-11-07 00:45:52', NULL, 50, 2),
(10, 'test', '<p>test</p>', '2020-11-07 00:46:18', NULL, 50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL COMMENT 'รหัสบริษัท',
  `name` varchar(60) NOT NULL COMMENT 'ชื่อบริษัท',
  `description` text DEFAULT NULL COMMENT 'คำอธิบายบริษัท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `description`) VALUES
(1, 'Brillian & Million', NULL),
(2, 'Digitas', NULL),
(3, 'Testgo', NULL),
(4, 'Loe Bernate', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL COMMENT 'ที่อยู่ไฟล์',
  `name` varchar(60) NOT NULL COMMENT 'ชื่อไฟล์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `file_task`
--

CREATE TABLE `file_task` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `id` int(11) NOT NULL COMMENT 'รหัสบทบาทผู้ใช้',
  `role_name` varchar(45) NOT NULL COMMENT 'ชื่อบทบาทผู้ใช้',
  `role_description` text DEFAULT NULL COMMENT 'คำอธิบายบทบาทผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`id`, `role_name`, `role_description`) VALUES
(1, 'customer', 'ลูกค้า'),
(2, 'staff', 'ผู้ปฏิบัติงาน'),
(3, 'leader', 'หัวหน้างาน');

-- --------------------------------------------------------

--
-- Table structure for table `status_master`
--

CREATE TABLE `status_master` (
  `id` int(11) NOT NULL COMMENT 'รหัสสถานะงาน',
  `status_name` varchar(25) NOT NULL COMMENT 'ชื่อสถานะงาน',
  `status_description` text DEFAULT NULL COMMENT 'คำอธิบายสถานะงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_master`
--

INSERT INTO `status_master` (`id`, `status_name`, `status_description`) VALUES
(1, 'Plan', 'สถานะของรายการงานที่ถูกสร้างขึ้นแต่ระบุข้อมูลไม่สมบูรณ์'),
(2, 'Open', 'สถานะของรายการที่ถูกสร้างขึ้นใหม่ และระบุข้อมูลสมบูรณ์'),
(3, 'In Process', 'สถานะที่แสดงว่ารายการงานนี้กำลังดำเนินการทำอยู่'),
(4, 'In Review', 'สถานะที่แสดงว่ารายการงานนี้กำลังถูกตรวจสอบความถูกต้องจากหัวหน้างานอยู่'),
(5, 'In Permit', 'สถานะที่แสดงว่ารายการงานนี้กำลังถูกตรวจรับงานจากลูกค้าอยู่'),
(6, 'Done', 'สถานะงานที่แสดงว่ารายการงานนี้ถูกดำเนินการเรียบร้อยแล้ว'),
(7, 'Disable', 'สถานะงานที่แสดงว่ารายการงานนี้ถูกลบ');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL COMMENT 'รหัสรายการงาน',
  `created` datetime DEFAULT current_timestamp() COMMENT 'วันที่สร้างงาน',
  `tag` text DEFAULT NULL COMMENT 'แท็กประเภทย่อยๆของงาน หรือคำที่เกี่ยวข้องกับงาน',
  `launch_date` date NOT NULL COMMENT 'วันที่งานถูกเผยแพร่สู่สาธารณะ',
  `launch_time` time NOT NULL COMMENT 'เวลาที่งานถูกเผยแพร่สู่สาธารณะ',
  `name` varchar(45) NOT NULL COMMENT 'ชื่อรายการงาน',
  `detail` text DEFAULT NULL COMMENT 'รายละเอียดของงาน',
  `create_by` int(11) DEFAULT NULL COMMENT 'ผู้สร้างรายการงาน',
  `channel_id` int(11) DEFAULT NULL COMMENT 'ช่องทางสังคมออนไลน์ของรายการงาน',
  `status_master_id` int(11) DEFAULT NULL COMMENT 'สถานะปัจจุบันของรายการงาน',
  `filepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `created`, `tag`, `launch_date`, `launch_time`, `name`, `detail`, `create_by`, `channel_id`, `status_master_id`, `filepath`) VALUES
(50, '2020-10-29 07:51:55', NULL, '2020-10-29', '10:00:00', 'โพสโปรของสด', ' <p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet est placerat in egestas erat imperdiet sed. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus vitae. Vel risus commodo viverra maecenas accumsan lacus vel. Erat velit scelerisque in dictum non. Id leo in vitae turpis massa sed. <strong>Amet est placerat</strong> in egestas erat imperdiet sed euismod nisi. Bibendum at varius vel pharetra vel turpis nunc. Lacus vel facilisis volutpat est velit egestas dui. Etiam sit amet nisl purus in mollis nunc. Gravida in <strong>fermentum et sollicitudin</strong> ac orci.</p><blockquote><p>Massa vitae tortor condimentum lacinia quis. Amet consectetur adipiscing elit ut. Placerat duis ultricies lacus sed turpis. Tristique sollicitudin nibh sit amet commodo nulla. Nisi scelerisque eu ultrices vitae auctor eu. Purus sit amet luctus venenatis lectus magna. Scelerisque varius morbi enim nunc. In nulla posuere sollicitudin aliquam. Cras sed felis eget velit aliquet sagittis. Amet consectetur adipiscing elit duis.</p></blockquote><p><i><strong>Faucibus interdum</strong></i> posuere lorem ipsum dolor. Integer quis auctor elit sed. Id interdum velit laoreet id donec ultrices tincidunt arcu. Nunc lobortis mattis aliquam faucibus. Elementum nisi quis eleifend quam adipiscing. Consectetur purus ut faucibus pulvinar. Risus nec feugiat in fermentum posuere urna nec tincidunt. Diam phasellus vestibulum lorem sed risus ultricies tristique. Risus nec feugiat in fermentum. Tortor pretium viverra suspendisse potenti nullam ac. Feugiat scelerisque varius <i>morbi enim</i> nunc faucibus a.</p>', 1, 1, 2, NULL),
(51, '2020-10-29 07:52:11', NULL, '2020-10-30', '20:00:00', 'รบกวนแก้ไขปกเว็บไซต์ให้หน่อยค่ะ', '<p>&nbsp;</p>', 1, 3, 6, NULL),
(52, '2020-10-29 07:52:35', NULL, '2020-10-30', '09:00:00', 'Line Push', '<p>&nbsp;</p>', 1, 2, 6, NULL),
(53, '2020-10-29 07:56:45', NULL, '2020-11-05', '09:00:00', 'Promotion 11.11 Notification', ' <p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet est placerat in egestas erat imperdiet sed. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus vitae. Vel risus commodo viverra maecenas accumsan lacus vel. Erat velit scelerisque in dictum non. Id leo in vitae turpis massa sed. <strong>Amet est placerat</strong> in egestas erat imperdiet sed euismod nisi. Bibendum at varius vel pharetra vel turpis nunc. Lacus vel facilisis volutpat est velit egestas dui. Etiam sit amet nisl purus in mollis nunc. Gravida in <strong>fermentum et sollicitudin</strong> ac orci.</p><blockquote><p>Massa vitae tortor condimentum lacinia quis. Amet consectetur adipiscing elit ut. Placerat duis ultricies lacus sed turpis. Tristique sollicitudin nibh sit amet commodo nulla. Nisi scelerisque eu ultrices vitae auctor eu. Purus sit amet luctus venenatis lectus magna. Scelerisque varius morbi enim nunc. In nulla posuere sollicitudin aliquam. Cras sed felis eget velit aliquet sagittis. Amet consectetur adipiscing elit duis.</p></blockquote><p><i><strong>Faucibus interdum</strong></i> posuere lorem ipsum dolor. Integer quis auctor elit sed. Id interdum velit laoreet id donec ultrices tincidunt arcu. Nunc lobortis mattis aliquam faucibus. Elementum nisi quis eleifend quam adipiscing. Consectetur purus ut faucibus pulvinar. Risus nec feugiat in fermentum posuere urna nec tincidunt. Diam phasellus vestibulum lorem sed risus ultricies tristique. Risus nec feugiat in fermentum. Tortor pretium viverra suspendisse potenti nullam ac. Feugiat scelerisque varius <i>morbi enim</i> nunc faucibus a.</p>', 1, 4, 2, NULL),
(54, '2020-11-04 04:49:20', NULL, '2020-11-03', '11:00:00', 'Mall - Exclusive Deal Promotion', ' <p>&nbsp;</p>', 1, 1, 4, NULL),
(55, '2020-11-04 04:53:29', NULL, '2020-11-12', '09:00:00', 'Express', '<p>&nbsp;</p>', 1, 2, 4, NULL),
(56, '2020-11-04 04:54:19', NULL, '2020-11-13', '09:00:00', 'Banner GHS', NULL, 1, 4, 1, NULL),
(57, '2020-11-04 04:55:42', NULL, '2020-11-25', '10:00:00', 'TL Corporate Agenda', ' <p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Amet est placerat in egestas erat imperdiet sed. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus vitae. Vel risus commodo viverra maecenas accumsan lacus vel. Erat velit scelerisque in dictum non. Id leo in vitae turpis massa sed. <strong>Amet est placerat</strong> in egestas erat imperdiet sed euismod nisi. Bibendum at varius vel pharetra vel turpis nunc. Lacus vel facilisis volutpat est velit egestas dui. Etiam sit amet nisl purus in mollis nunc. Gravida in <strong>fermentum et sollicitudin</strong> ac orci.</p><blockquote><p>Massa vitae tortor condimentum lacinia quis. Amet consectetur adipiscing elit ut. Placerat duis ultricies lacus sed turpis. Tristique sollicitudin nibh sit amet commodo nulla. Nisi scelerisque eu ultrices vitae auctor eu. Purus sit amet luctus venenatis lectus magna. Scelerisque varius morbi enim nunc. In nulla posuere sollicitudin aliquam. Cras sed felis eget velit aliquet sagittis. Amet consectetur adipiscing elit duis.</p></blockquote><p><i><strong>Faucibus interdum</strong></i> posuere lorem ipsum dolor. Integer quis auctor elit sed. Id interdum velit laoreet id donec ultrices tincidunt arcu. Nunc lobortis mattis aliquam faucibus. Elementum nisi quis eleifend quam adipiscing. Consectetur purus ut faucibus pulvinar. Risus nec feugiat in fermentum posuere urna nec tincidunt. Diam phasellus vestibulum lorem sed risus ultricies tristique. Risus nec feugiat in fermentum. Tortor pretium viverra suspendisse potenti nullam ac. Feugiat scelerisque varius <i>morbi enim</i> nunc faucibus a.</p>', 1, 2, 2, NULL),
(58, '2020-11-06 22:07:48', NULL, '0000-00-00', '00:00:00', 'sadfsdfas', ' <p>&nbsp;</p>', 1, 1, 2, NULL),
(59, '2020-11-06 22:08:03', NULL, '0000-00-00', '00:00:00', 'asdfadsf', ' <p>&nbsp;</p>', 1, 2, 2, NULL),
(60, '2020-11-06 22:08:27', NULL, '2020-11-20', '12:00:00', 'asdfsdfghytr', ' <p>&nbsp;</p>', 1, 3, 2, NULL),
(61, '2020-11-06 22:09:56', NULL, '2020-11-13', '10:00:00', 'yjrtyujy', ' <p>&nbsp;</p>', 1, 5, 1, NULL),
(62, '2020-11-07 09:18:20', NULL, '2020-11-07', '04:05:55', '', '<p>&nbsp;</p>', 1, 1, 7, NULL),
(63, '2020-11-07 10:00:09', NULL, '2020-11-07', '04:05:58', 'เทสไฟล์', '<p>&nbsp;</p>', 1, 5, 7, NULL),
(64, '2020-11-07 10:01:21', NULL, '2020-11-07', '04:05:51', 'เทสอัปไฟล์', '<p>ฟหกดฟก</p>', 1, 1, 7, NULL),
(65, '2020-11-07 10:03:35', NULL, '2020-11-07', '04:05:47', 'เทสอัปไฟล์2', '<p>ฟหกดฟก</p>', 1, 1, 7, NULL),
(66, '2020-11-07 10:10:04', NULL, '2020-11-07', '04:11:13', 'เทสไฟล์', '<p>หเฟดหดเ</p>', 1, 1, 7, '2020-11-07480558346'),
(67, '2020-11-07 10:11:31', NULL, '2020-11-07', '04:15:46', 'เทสไฟล์', '<p>ผปแอผแป</p>', 1, 1, 7, '202011071536342268'),
(68, '2020-11-07 10:14:20', NULL, '2020-11-07', '04:15:42', 'เทสไฟล์', '<p>ผปแอผแป</p>', 1, 1, 7, '202011071168133022'),
(69, '2020-11-07 10:14:50', NULL, '2020-11-07', '04:15:37', 'เทสไฟล์', '<p>ผปแอผแป</p>', 1, 1, 7, '20201107760918554'),
(70, '2020-11-07 10:15:54', NULL, '0000-00-00', '00:00:00', 'เทสไฟล์', '<p>&nbsp;</p>', 1, 1, 2, '202011071996435985'),
(71, '2020-11-07 10:16:57', NULL, '0000-00-00', '00:00:00', 'เทสไฟล์', '<p>ปแผอปแอ</p>', 1, 1, 2, '20201107558996470'),
(72, '2020-11-07 10:20:34', NULL, '0000-00-00', '00:00:00', 'เทสไฟล์dfg', '<p>ปแผอปแอ</p>', 1, 1, 2, '202011071174360687'),
(73, '2020-11-07 10:25:40', NULL, '2020-11-07', '04:26:22', 'เทสอีสเซ็ต', '<p>&nbsp;</p>', 1, 1, 7, '20201107399730325'),
(74, '2020-11-07 10:26:43', NULL, '0000-00-00', '00:00:00', 'เทสอีสเซ็ต', '<p>ฟกหกดฟห</p>', 1, 1, 2, '202011071961061194.jpg'),
(75, '2020-11-07 10:29:46', NULL, '0000-00-00', '00:00:00', 'เทสอีสเซ็ตสองภาพ', ' <p>ฟกหกดฟห</p>', 1, 1, 2, '20201107300998207.gif');

-- --------------------------------------------------------

--
-- Table structure for table `task_history`
--

CREATE TABLE `task_history` (
  `id` int(11) NOT NULL COMMENT 'รหัสประวัติรายการงาน',
  `actiondate` date NOT NULL COMMENT 'วันที่มีการอัปเดต',
  `actiontime` time NOT NULL COMMENT 'เวลาที่มีการอัปเดต',
  `remark` text DEFAULT NULL COMMENT 'หมายเหตุเพิ่มเติม',
  `action_by` int(11) NOT NULL COMMENT 'ผู้แก้ไขรายละเอียดงาน',
  `task_id` int(11) NOT NULL COMMENT 'บอกว่าเจ้าของประวัติรายการงานนี้เป็นของรายการงานใด',
  `status_master_id` int(11) NOT NULL COMMENT 'สถานะของประวัติรายการงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_history`
--

INSERT INTO `task_history` (`id`, `actiondate`, `actiontime`, `remark`, `action_by`, `task_id`, `status_master_id`) VALUES
(1, '2020-11-06', '10:07:48', NULL, 1, 58, 1),
(2, '2020-11-06', '10:09:56', NULL, 1, 61, 1),
(3, '2020-11-06', '10:12:48', NULL, 1, 59, 2),
(4, '2020-11-07', '07:27:36', NULL, 1, 60, 2),
(5, '2020-11-07', '07:28:18', NULL, 1, 61, 1),
(6, '2020-11-07', '09:18:20', NULL, 1, 62, 2),
(7, '2020-11-07', '10:00:09', NULL, 1, 63, 2),
(8, '2020-11-07', '10:01:21', NULL, 1, 64, 2),
(9, '2020-11-07', '10:03:35', NULL, 1, 65, 2),
(10, '2020-11-07', '04:05:47', NULL, 1, 65, 7),
(11, '2020-11-07', '04:05:51', NULL, 1, 64, 7),
(12, '2020-11-07', '04:05:55', NULL, 1, 62, 7),
(13, '2020-11-07', '04:05:58', NULL, 1, 63, 7),
(14, '2020-11-07', '10:10:04', NULL, 1, 66, 2),
(15, '2020-11-07', '04:11:13', NULL, 1, 66, 7),
(16, '2020-11-07', '10:11:31', NULL, 1, 67, 2),
(17, '2020-11-07', '10:14:20', NULL, 1, 68, 2),
(18, '2020-11-07', '10:14:50', NULL, 1, 69, 2),
(19, '2020-11-07', '04:15:37', NULL, 1, 69, 7),
(20, '2020-11-07', '04:15:42', NULL, 1, 68, 7),
(21, '2020-11-07', '04:15:46', NULL, 1, 67, 7),
(22, '2020-11-07', '10:15:54', NULL, 1, 70, 2),
(23, '2020-11-07', '10:16:57', NULL, 1, 71, 2),
(24, '2020-11-07', '10:20:34', NULL, 1, 72, 2),
(25, '2020-11-07', '10:25:40', NULL, 1, 73, 2),
(26, '2020-11-07', '04:26:22', NULL, 1, 73, 7),
(27, '2020-11-07', '10:26:43', NULL, 1, 74, 2),
(28, '2020-11-07', '10:29:46', NULL, 1, 75, 2);

-- --------------------------------------------------------

--
-- Table structure for table `uploadfile`
--

CREATE TABLE `uploadfile` (
  `fileID` int(5) NOT NULL,
  `fileupload` varchar(200) CHARACTER SET utf8 NOT NULL,
  `dateup` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploadfile`
--

INSERT INTO `uploadfile` (`fileID`, `fileupload`, `dateup`) VALUES
(1, '2020-11-07943136836', '2020-11-07 03:00:09'),
(2, '2020-11-07526255305', '2020-11-07 03:01:21'),
(3, '2020-11-071493393431', '2020-11-07 03:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `role_master_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `username`, `password`, `email`, `created`, `company_id`, `role_master_id`) VALUES
(1, 'Taeyeon', 'Kim', 'kty309', 'kty309', 'kty309@kty309.com', '2020-10-29 07:49:02', 3, 1),
(2, 'Tiffany', 'Hwang', 'hmy801', 'hmy801', 'hmy801@hmy801.com', '2020-10-29 07:49:02', 1, 2),
(3, 'YoonA', 'Im', 'iya530', 'iya530', 'iya530@iya530.com', '2020-10-29 07:50:26', 1, 3),
(4, 'Chungha', 'Kim', 'kch018', 'kch018', 'kch018@kch018.com', '2020-11-06 22:28:14', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_task1_idx` (`task_id`),
  ADD KEY `fk_comment_user1_idx` (`user_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_task`
--
ALTER TABLE `file_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_file_id` (`file_id`),
  ADD KEY `fk_task_id` (`task_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_master`
--
ALTER TABLE `status_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_task_user1_idx` (`create_by`),
  ADD KEY `fk_task_channel1_idx` (`channel_id`),
  ADD KEY `fk_task_status_master1_idx` (`status_master_id`);

--
-- Indexes for table `task_history`
--
ALTER TABLE `task_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_task_history_user1_idx` (`action_by`),
  ADD KEY `fk_task_history_task1_idx` (`task_id`),
  ADD KEY `fk_task_history_status_master1_idx` (`status_master_id`);

--
-- Indexes for table `uploadfile`
--
ALTER TABLE `uploadfile`
  ADD PRIMARY KEY (`fileID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_user_company1_idx` (`company_id`),
  ADD KEY `fk_user_role_master1_idx` (`role_master_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสช่องทางสังคมออนไลน์', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสของการการแสดงความคิดเห็น', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบริษัท', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_task`
--
ALTER TABLE `file_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบทบาทผู้ใช้', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_master`
--
ALTER TABLE `status_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสถานะงาน', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการงาน', AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `task_history`
--
ALTER TABLE `task_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประวัติรายการงาน', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `uploadfile`
--
ALTER TABLE `uploadfile`
  MODIFY `fileID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `file_task`
--
ALTER TABLE `file_task`
  ADD CONSTRAINT `fk_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `fk_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_channel1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_status_master1` FOREIGN KEY (`status_master_id`) REFERENCES `status_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_user1` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task_history`
--
ALTER TABLE `task_history`
  ADD CONSTRAINT `fk_task_history_status_master1` FOREIGN KEY (`status_master_id`) REFERENCES `status_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_history_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_history_user1` FOREIGN KEY (`action_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role_master1` FOREIGN KEY (`role_master_id`) REFERENCES `role_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
