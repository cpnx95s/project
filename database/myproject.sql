-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 01:27 AM
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
(3, 'Website', NULL),
(4, 'Mobile Application', NULL),
(5, 'Twitter', NULL),
(6, 'Instagram', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT 'รหัสของการการแสดงความคิดเห็น',
  `content` varchar(255) DEFAULT NULL COMMENT 'เนื้อหาในการแสดงความคิดเห็น',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
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
  `name` varchar(60) NOT NULL COMMENT 'ชื่อไฟล์',
  `task_id` int(11) NOT NULL COMMENT 'บอกเจ้าของรายการงานของไฟล์นี้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_config`
--

CREATE TABLE `role_config` (
  `id` int(11) NOT NULL COMMENT 'รหัสหน้าที่ผู้ใช้งานจะเห็น',
  `roleconfig_menu` text NOT NULL COMMENT 'เมนูที่สามารถมองเห็น',
  `role_master_id` int(11) NOT NULL COMMENT 'บทบาทของผู้ใช้งาน'
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
-- Table structure for table `status_config`
--

CREATE TABLE `status_config` (
  `id` int(11) NOT NULL,
  `status_from` int(11) NOT NULL,
  `status_to` int(11) NOT NULL,
  `status_master_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_config`
--

INSERT INTO `status_config` (`id`, `status_from`, `status_to`, `status_master_id`) VALUES
(1, 1, 2, NULL),
(2, 2, 3, NULL),
(3, 3, 4, NULL),
(4, 4, 7, NULL),
(5, 7, 10, NULL);

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
(1, 'plan', 'สถานะบ่งบอกว่างานนี้ยังมีรายละเอียดไม่ครบสมบูรณ์'),
(2, 'open', 'สถานะบอกว่างานนี้มีข้อมูลการสั่งงานสมบูรณ์แล้ว พร้อมให้ผู้ปฏิบัติงานนำไปปฏิบัติงาน'),
(3, 'InProcess', 'สถานะที่แสดงว่ารายการงานนี้กำลังดำเนินการทำอยู่'),
(4, 'InReview', 'สถานะที่แสดงว่ารายการงานนี้กำลังถูกตรวจสอบความถูกต้องจากหัวหน้างานอยู่'),
(5, 'Approve', 'สถานะที่แสดงว่ารายการงานนี้ได้รับการอนุมัติงานจากหัวหน้างาน'),
(6, 'Reject', 'สถานะที่แสดงว่ารายการงานนี้ไม่ได้รับการอนุมัติงานจากหัวหน้างาน'),
(7, 'InPermit', 'สถานะที่แสดงว่ารายการงานนี้กำลังอยู่ในกระบวนการตรวจรับงานจากลูกค้าอยู่'),
(8, 'Accept', 'สถานะที่แสดงว่ารายการงานนี้ได้รับการยอมรับงานจากลูกค้า'),
(9, 'Deny', 'สถานะที่แสดงว่ารายการงานนี้ถูกปฏฺเสธงานจากลูกค้า'),
(10, 'Done', 'สถานะงานที่แสดงว่ารายการงานนี้ถูกดำเนินการเรียบร้อยแล้ว');

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
  `status_master_id` int(11) DEFAULT NULL COMMENT 'สถานะปัจจุบันของรายการงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `created`, `tag`, `launch_date`, `launch_time`, `name`, `detail`, `create_by`, `channel_id`, `status_master_id`) VALUES
(11, '2020-08-14 16:58:30', NULL, '2020-08-14', '17:06:51', 'Banner Website', ' <p>เรียน ทีมเว็บไซต์ ค่ะ</p><p>รบกวนเซ็ต Banner Website ตามไฟล์แนบ</p><p>ขอบคุณค่ะ</p>', 1, 3, 2),
(12, '2020-08-14 17:42:26', 'zxvxcvz', '2020-08-21', '10:00:00', 'test Edit 8', ' <p>test Editzcvzcxc 8</p>', 1, 2, 2),
(17, '2020-08-17 05:34:44', NULL, '2020-08-19', '09:00:00', 'รบกวนเซ็ตแบนเนอร์สแปลชให้หน่อยค่ะ', 'รบกวนเซ็ตแบนเนอร์สแปลชตามไฟล์แนบค่ะ', 1, 4, 2),
(34, '2020-08-17 06:25:26', NULL, '0000-00-00', '00:00:00', 'ASFDA', '<p>ASFDASDF</p>', 1, 2, 2);

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
  `status_master_id` int(11) DEFAULT NULL,
  `channel_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `role_master_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `username`, `password`, `email`, `created`, `status_master_id`, `channel_id`, `company_id`, `role_master_id`) VALUES
(1, 'TAEYEON', 'KIM', 'kty309', 'kty309', 'kty309@kty309.com', '2020-08-14 17:03:30', 2, 2, 3, 1),
(2, 'TIFFANY', 'HWANG', 'hmy801', 'hmy801', 'hmy801@hmy801.com', '2020-08-21 06:23:53', 3, 3, 1, 2),
(3, 'YoonA', 'Im', 'iya305', 'iya305', 'iya305@iya305.com', '2020-08-21 06:23:53', 4, 3, 1, 3);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_files_task1_idx` (`task_id`);

--
-- Indexes for table `role_config`
--
ALTER TABLE `role_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_config_role_master1_idx` (`role_master_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_config`
--
ALTER TABLE `status_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_from` (`status_from`),
  ADD KEY `status_to` (`status_to`),
  ADD KEY `status_config2_ibfk_3` (`status_master_id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_user_status_master1_idx` (`status_master_id`),
  ADD KEY `fk_user_channel1_idx` (`channel_id`),
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
-- AUTO_INCREMENT for table `role_config`
--
ALTER TABLE `role_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหน้าที่ผู้ใช้งานจะเห็น';

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบทบาทผู้ใช้', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_config`
--
ALTER TABLE `status_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_master`
--
ALTER TABLE `status_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสถานะงาน', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการงาน', AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_config`
--
ALTER TABLE `role_config`
  ADD CONSTRAINT `fk_role_config_role_master1` FOREIGN KEY (`role_master_id`) REFERENCES `role_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `status_config`
--
ALTER TABLE `status_config`
  ADD CONSTRAINT `fk_status_config_status_master` FOREIGN KEY (`status_master_id`) REFERENCES `status_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `status_config_ibfk_1` FOREIGN KEY (`status_from`) REFERENCES `status_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `status_config_ibfk_2` FOREIGN KEY (`status_to`) REFERENCES `status_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `status_config_ibfk_3` FOREIGN KEY (`status_master_id`) REFERENCES `status_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_user_channel1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role_master1` FOREIGN KEY (`role_master_id`) REFERENCES `role_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_status_master1` FOREIGN KEY (`status_master_id`) REFERENCES `status_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
