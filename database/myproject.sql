-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 02:11 AM
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
  `action_by` int(11) DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL COMMENT 'ช่องทางสังคมออนไลน์ของรายการงาน',
  `status_master_id` int(11) DEFAULT NULL COMMENT 'สถานะปัจจุบันของรายการงาน',
  `filepath` varchar(255) DEFAULT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `created`, `tag`, `launch_date`, `launch_time`, `name`, `detail`, `create_by`, `action_by`, `channel_id`, `status_master_id`, `filepath`, `remark`) VALUES
(1, '2020-11-11 05:59:18', NULL, '2020-12-03', '11:00:00', 'LINE TL PUSH : Mall - Exclusive Deal Promotio', '<p>รบกวนเซ็ตไทม์ไลน์ ตามไฟล์แนบ&nbsp;</p>', 1, 3, 2, 6, '20201111188898189.png', ''),
(2, '2020-11-11 06:04:04', NULL, '2020-12-03', '10:00:00', 'LINE OAE TL PUSH : GHS', ' <p>รบกวน push ไลน์ตามรายละเอียดด้านล่างค่ะ</p><p>นำลงวันที่ 3/12/20</p>', 1, 3, 2, 4, '202011111445716542.png', 'ยังผิดอยู่'),
(3, '2020-11-11 06:11:39', NULL, '2020-12-03', '11:00:00', 'FACEBOOK POST : Mall - Exclusive Deal Promoti', ' <p>รบกวนโพสเฟสบุ๊คตามรายละเอียดด้านล่างค่ะ</p>', 1, 0, 1, 2, NULL, ''),
(4, '2020-11-11 06:12:20', NULL, '2020-12-03', '11:00:00', 'LINE TL PUSH : GHS', ' <p>รบกวน push ไลน์ ตามรายละเอียดด้านล่างค่ะ</p><p>นำขึ้น : 3/11/20</p><p>เวลา : 11.00 น.</p><p>นำลง : 13/11/20</p><p>เวลา : 23.55 น.</p>', 1, 2, 2, 3, NULL, ''),
(5, '2020-11-11 06:27:26', NULL, '2020-11-14', '09:00:00', 'FACEBOOK POST : Lazada', ' <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, 3, 1, 5, '202011111554004818', 'ตั้งวันขึ้นผิด');

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
(31, '2020-11-11', '05:59:18', NULL, 1, 1, 2),
(32, '2020-11-11', '06:04:04', NULL, 1, 2, 2),
(34, '2020-11-11', '06:11:39', NULL, 1, 3, 1),
(35, '2020-11-11', '06:12:20', NULL, 1, 4, 1),
(37, '2020-11-11', '06:13:16', NULL, 1, 4, 2),
(40, '2020-11-11', '06:27:26', NULL, 1, 5, 2),
(43, '2020-11-11', '00:40:59', NULL, 2, 1, 4),
(45, '2020-11-11', '06:43:12', NULL, 2, 2, 3),
(46, '2020-11-11', '00:43:39', NULL, 2, 2, 2),
(47, '2020-11-11', '00:43:42', NULL, 2, 4, 2),
(48, '2020-11-11', '06:43:47', NULL, 2, 2, 3),
(49, '2020-11-11', '06:44:47', NULL, 2, 4, 3),
(50, '2020-11-11', '00:44:56', NULL, 2, 5, 2),
(51, '2020-11-11', '00:45:00', NULL, 2, 4, 2),
(52, '2020-11-11', '00:45:02', NULL, 2, 2, 2),
(53, '2020-11-11', '06:46:32', NULL, 2, 2, 3),
(54, '2020-11-11', '06:46:43', NULL, 2, 5, 3),
(55, '2020-11-11', '00:46:54', NULL, 2, 2, 4),
(56, '2020-11-11', '00:46:58', NULL, 2, 5, 4),
(57, '2020-11-11', '07:06:42', NULL, 2, 4, 3),
(58, '2020-11-11', '01:09:49', NULL, 3, 1, 5),
(59, '2020-11-11', '01:10:11', 'ตั้งวันขึ้นผิด', 3, 5, 3),
(60, '2020-11-11', '01:10:41', NULL, 2, 5, 4),
(61, '2020-11-11', '01:11:00', NULL, 3, 5, 5),
(62, '2020-11-11', '01:12:41', 'ตั้งเวลาผิด', 3, 2, 3),
(63, '2020-11-11', '01:13:17', NULL, 2, 2, 4),
(64, '2020-11-11', '01:13:41', 'ยังผิดอยู่', 3, 2, 3),
(65, '2020-11-11', '01:14:00', NULL, 2, 2, 4),
(66, '2020-11-11', '01:15:00', NULL, 3, 2, 5),
(67, '2020-11-11', '01:16:06', NULL, 1, 1, 6),
(68, '2020-11-11', '01:16:20', 'ภาพผิด', 1, 2, 4),
(69, '2020-11-11', '07:35:26', NULL, 1, 3, 1),
(70, '2020-11-11', '07:35:32', NULL, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `uploadfile`
--

CREATE TABLE `uploadfile` (
  `fileID` int(5) NOT NULL,
  `fileupload` varchar(200) CHARACTER SET utf8 NOT NULL,
  `dateup` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสของการการแสดงความคิดเห็น';

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการงาน', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task_history`
--
ALTER TABLE `task_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประวัติรายการงาน', AUTO_INCREMENT=74;

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
