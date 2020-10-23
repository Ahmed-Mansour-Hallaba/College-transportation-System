-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 10:38 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transport`
--
CREATE DATABASE IF NOT EXISTS `transport` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `transport`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `driver_details`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `driver_details` (IN `did` INT)  begin
select d.id,u.fullname,d.mobile,b.busnumber,b.color,b.capacity,d.state
from drivers d
join users u on(d.id=u.id)
join buses b on(d.bus_id=b.id)
where d.id=did;
end$$

DROP PROCEDURE IF EXISTS `estimated_salary`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `estimated_salary` (IN `did` INT)  begin
select count(*) from drivers d
join users u on(u.id=d.id)
join trips t on(d.bus_id=t.bus_id)
join student_schedule ss on(t.id=ss.trip_id) 
where d.id=did;
end$$

DROP PROCEDURE IF EXISTS `gettripsfrom`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `gettripsfrom` (IN `dno` INT, IN `sid` INT)  begin
select t.id,date_format(coll_time,'%k:%i'),date_format(district_time,'%k:%i') ,b.capacity
from trips t 
join bus_lines bl on (bl.id=t.line_id)
join line_details ld on(ld.line_id=bl.id)
join students s on (s.district_id=ld.district_id)
join buses b on(t.bus_id=b.id)

where day_no=dno and direction='from' and s.id=sid and (b.capacity>(
select count(*) from trips tt
join student_schedule sss on (tt.id=sss.trip_id)
where tt.id=t.id
));
end$$

DROP PROCEDURE IF EXISTS `gettripsto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `gettripsto` (IN `dno` INT, IN `sid` INT)  begin
select t.id,date_format(district_time,'%k:%i') ,date_format(coll_time,'%k:%i') ,b.capacity
from trips t 
join bus_lines bl on (bl.id=t.line_id)
join line_details ld on(ld.line_id=bl.id)
join students s on (s.district_id=ld.district_id)
join buses b on(t.bus_id=b.id)

where day_no=dno and direction='to' and s.id=sid and (b.capacity>(
select count(*) from trips tt
join student_schedule sss on (tt.id=sss.trip_id)
where tt.id=t.id
));
end$$

DROP PROCEDURE IF EXISTS `get_offdays`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_offdays` (IN `did` INT, IN `mon` INT, IN `yea` INT)  begin
select count(*)
 from execuses e join drivers d on(d.id=e.driver_id)
 join buses b on(d.bus_id=b.id)
 join trips t on(b.id=t.bus_id and t.day_no=(weekday(e.execuse_date) + 2) % 7)
 join student_schedule ss on(ss.trip_id=t.id)
 where month(e.execuse_date) =mon and year(e.execuse_date)=yea and d.id=did;

 end$$

DROP PROCEDURE IF EXISTS `get_student_drivers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_student_drivers` (IN `sid` INT)  begin
select distinct ud.id,ud.fullname from students s
join student_schedule ss on (s.id=ss.student_id)
join trips t on(t.id =ss.trip_id)
join buses b on (t.bus_id=b.id)
join drivers d on(d.bus_id=b.id)
join users ud on(d.id=ud.id) 
where s.id=sid;
end$$

DROP PROCEDURE IF EXISTS `get_user_schedule`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_schedule` (IN `sid` INT)  begin
select t.id,day_no,busnumber,color,direction,coll_time,district_time from trips t 
join buses b on(b.id=t.bus_id) 
join bus_lines bl on (bl.id=t.line_id) 
join line_details ld on(ld.line_id=t.line_id)
join students s on (s.district_id=ld.district_id)
join student_schedule ss on(ss.trip_id=t.id and s.id=ss.student_id)

 where s.id=sid;
 end$$

DROP PROCEDURE IF EXISTS `regist_driver`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `regist_driver` (IN `fname` VARCHAR(255), IN `uname` VARCHAR(255), IN `pw` VARCHAR(255), IN `mob` VARCHAR(255), IN `busno` VARCHAR(255), IN `color` VARCHAR(255), IN `cap` INT)  begin
insert into users (`fullname`, `username`, `pass`, `role`)  values (fname,uname,pw,'driver');
SET @DID = LAST_INSERT_ID();
insert into buses(busnumber, color, capacity) values (busno,color,cap);
set @BID=LAST_INSERT_ID();
insert into drivers (id,mobile, bus_id, state) values( @DID, mob,@BID,'pending');
END$$

DROP PROCEDURE IF EXISTS `trip_students`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `trip_students` (IN `tid` INT)  begin
select u.fullname,s.mobile,s.parent_mobile,s.address,d.name,s.img from students s
join users u on (u.id=s.id)
join student_schedule ss on (ss.student_id=s.id)
join districts d on(d.id=s.district_id)
where ss.trip_id=tid;
end$$

DROP PROCEDURE IF EXISTS `userannouncement`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `userannouncement` (IN `uid` INT)  BEGIN
select  a.id,a.message,au.is_opened
from notifications a join user_notification au 
on a.id=au.notification_id
where au.user_id=uid
order by a.notification_date DESC limit 8;

END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `check_login`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `check_login` (`uname` VARCHAR(255), `pass` VARCHAR(255)) RETURNS VARCHAR(50) CHARSET utf8 BEGIN
    RETURN  (SELECT role FROM users WHERE uname = username AND pass = users.pass);
end$$

DROP FUNCTION IF EXISTS `check_schedule`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `check_schedule` (`sid` INT) RETURNS TINYINT(1) begin 
return (select exists(select * from student_schedule where student_id=sid));
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
CREATE TABLE `buses` (
  `id` int(11) NOT NULL,
  `busnumber` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `busnumber`, `color`, `capacity`) VALUES
(1, 'ART123', 'Ø£Ø¨ÙŠØ¶', 13),
(2, 'RGH3652', 'Ø£Ø¨ÙŠØ¶', 13);

-- --------------------------------------------------------

--
-- Table structure for table `bus_lines`
--

DROP TABLE IF EXISTS `bus_lines`;
CREATE TABLE `bus_lines` (
  `id` int(11) NOT NULL,
  `line_name` varchar(255) DEFAULT NULL,
  `direction` enum('from','to') DEFAULT NULL,
  `coll_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bus_lines`
--

INSERT INTO `bus_lines` (`id`, `line_name`, `direction`, `coll_time`) VALUES
(1, 'Ø§Ù„Ù…Ø³Ø§Ø± Ø§Ù„Ø£ÙˆÙ„', 'to', '08:00:00'),
(2, 'Ø§Ù„Ù…Ø³Ø§Ø± Ø§Ù„Ø£ÙˆÙ„ Ø¹ÙˆØ¯Ø©', 'from', '01:00:00'),
(3, 'Ø§Ù„Ù…Ø³Ø§Ø± Ø§Ù„Ø«Ø§Ù†ÙŠ', 'to', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`) VALUES
(1, 'Ø§Ù„Ø¹Ø²ÙŠØ²ÙŠØ©'),
(2, 'Ø§Ù„Ø®Ø§Ù„Ø¯ÙŠØ©'),
(3, 'Ø§Ù„Ø¹Ø²ÙŠØ²ÙŠØ© Ø¨'),
(4, 'Ø§Ù„Ø¨Ù„Ø¯ÙŠØ©'),
(5, 'Ø§Ù„Ù†Ø§ÙŠÙÙŠØ©'),
(6, 'Ø§Ù„Ù…Ø­Ù…Ø¯ÙŠØ©'),
(7, 'Ø§Ù„ÙÙŠØµÙ„ÙŠØ©'),
(8, 'Ø§Ù„Ù…Ø±ÙˆØ¬'),
(9, 'Ø£Ø¨Ùˆ Ù…ÙˆØ³Ù‰ Ø§Ù„Ø£Ø´Ø¹Ø±ÙŠ'),
(10, 'ÙÙ„ÙŠØ¬'),
(11, 'Ø§Ù„Ø±ÙˆØ¶Ø©'),
(12, 'Ø§Ù„Ø§Ø³ÙƒØ§Ù†'),
(13, 'Ø§Ù„Ù†Ø®ÙŠÙ„'),
(14, 'Ø§Ù„ÙˆØ§Ø¯ÙŠ');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `state` enum('pending','accepted','refused') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `mobile`, `bus_id`, `state`) VALUES
(3, '0507703451', 1, 'accepted'),
(6, '0559321456', 2, 'refused');

-- --------------------------------------------------------

--
-- Table structure for table `execuses`
--

DROP TABLE IF EXISTS `execuses`;
CREATE TABLE `execuses` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `execuse_date` date DEFAULT NULL,
  `solved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `ffrom` int(11) NOT NULL,
  `fto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `message`, `ffrom`, `fto`) VALUES
(1, '\r\n                     ØªØ£Ø®ÙŠØ± Ø¹Ù† Ø§Ù„Ù…ÙˆØ¹Ø¯', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `line_details`
--

DROP TABLE IF EXISTS `line_details`;
CREATE TABLE `line_details` (
  `line_id` int(11) NOT NULL,
  `district_time` time NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `line_details`
--

INSERT INTO `line_details` (`line_id`, `district_time`, `district_id`) VALUES
(1, '07:40:00', 1),
(2, '01:20:00', 1),
(3, '09:40:00', 1),
(1, '07:30:00', 3),
(2, '01:30:00', 3),
(3, '09:30:00', 3),
(1, '07:20:00', 9),
(2, '01:40:00', 9),
(3, '09:20:00', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notification_date`, `message`) VALUES
(1, '2019-04-01 02:12:51', 'Ø§Ø¹ØªØ°Ø±Øª Ø§Ù„Ø·Ø§Ù„Ø¨Ù‡ Ù„Ù…Ù‰ ÙÙ‡Ø¯ Ø¹Ù† Ø§Ù„Ø­Ø¶ÙˆØ± ÙÙŠ Ø§Ù„Ø±Ø­Ù„Ù‡ ÙŠÙˆÙ… 2019-04-02'),
(2, '2019-04-01 02:13:48', 'Ø§Ø¹ØªØ°Ø±Øª Ø§Ù„Ø·Ø§Ù„Ø¨Ù‡ Ù„Ù…Ù‰ ÙÙ‡Ø¯ Ø¹Ù† Ø§Ù„Ø­Ø¶ÙˆØ± ÙÙŠ Ø§Ù„Ø±Ø­Ù„Ù‡ ÙŠÙˆÙ… 2019-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `parent_mobile` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `mobile`, `parent_mobile`, `address`, `img`, `district_id`) VALUES
(2, '0507703451', '0535202766', 'Ø´Ø§Ø±Ø¹ Ø§Ù„Ù…Ù„Ùƒ Ø®Ø§Ù„Ø¯ Ù…Ù†Ø²Ù„ Ø±Ù‚Ù…4546', '../uimg/ghada20190331072149.png', 4),
(5, '0506681422', '0509895124', 'Ù…Ø³Ø¬Ø¯ Ø¹Ø¨Ø¯Ø§Ù„Ø±Ø­Ù…Ù† Ø¨Ù†  Ø¹ÙˆÙ - Ù…Ù‚Ø§Ø¨Ù„ Ø§Ù„Ø®Ø·ÙˆØ· Ø§Ù„Ø¨ÙŠØ¶Ø§Ø¡ ', '../uimg/lama20190331080154.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_schedule`
--

DROP TABLE IF EXISTS `student_schedule`;
CREATE TABLE `student_schedule` (
  `trip_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_schedule`
--

INSERT INTO `student_schedule` (`trip_id`, `student_id`) VALUES
(1, 5),
(6, 5),
(2, 5),
(7, 5),
(3, 5),
(8, 5),
(9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
CREATE TABLE `suggestions` (
  `id` int(11) NOT NULL,
  `mess` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`id`, `mess`, `uid`) VALUES
(1, 'Ø§Ù„Ø±Ø¬Ø§Ø¡ Ø¥Ø¶Ø§ÙØ© Ø±Ø­Ù„Ø© ÙŠÙˆÙ… Ø§Ù„Ø«Ù„Ø§Ø«Ø§Ø¡ Ø§Ù„Ø³Ø§Ø¹Ø© 3\r\n                     ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `day_no` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `day_no`, `bus_id`, `line_id`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 1, 1, 1),
(6, 1, 1, 2),
(7, 2, 1, 2),
(8, 3, 1, 2),
(9, 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(52) NOT NULL,
  `username` varchar(52) NOT NULL,
  `pass` varchar(52) NOT NULL,
  `role` enum('admin','student','driver','mdriver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `pass`, `role`) VALUES
(1, 'admin', 'admin', '123', 'admin'),
(2, 'ØºØ§Ø¯Ø© Ø¹Ø¨Ø¯Ø§Ù„Ø±Ø­Ù…Ù†', 'ghada', '123', 'student'),
(3, 'Ø£Ø¨Ùˆ Ø³Ø§Ù„Ù…', 'salem', '123', 'driver'),
(4, 'Hamed ', 'mdriver', '123', 'mdriver'),
(5, 'Ù„Ù…Ù‰ ÙÙ‡Ø¯', 'lama', '123', 'student'),
(6, 'Ø®Ø§Ù„Ø¯ Ø§Ù„Ø´Ù…Ø±ÙŠ', 'Khalid', '123', 'driver');

-- --------------------------------------------------------

--
-- Table structure for table `user_code`
--

DROP TABLE IF EXISTS `user_code`;
CREATE TABLE `user_code` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cod` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_code`
--

INSERT INTO `user_code` (`id`, `user_id`, `cod`) VALUES
(1, 5, '803561'),
(2, 5, '695703'),
(3, 5, '563595');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

DROP TABLE IF EXISTS `user_notification`;
CREATE TABLE `user_notification` (
  `user_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `is_opened` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`user_id`, `notification_id`, `is_opened`) VALUES
(3, 1, 1),
(3, 2, 1),
(3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_lines`
--
ALTER TABLE `bus_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `execuses`
--
ALTER TABLE `execuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ffrom` (`ffrom`),
  ADD KEY `fto` (`fto`);

--
-- Indexes for table `line_details`
--
ALTER TABLE `line_details`
  ADD PRIMARY KEY (`district_id`,`line_id`),
  ADD KEY `line_id` (`line_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD KEY `trip_id` (`trip_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `line_id` (`line_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_code`
--
ALTER TABLE `user_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bus_lines`
--
ALTER TABLE `bus_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `execuses`
--
ALTER TABLE `execuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_code`
--
ALTER TABLE `user_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `drivers_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`);

--
-- Constraints for table `execuses`
--
ALTER TABLE `execuses`
  ADD CONSTRAINT `execuses_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`ffrom`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`fto`) REFERENCES `users` (`id`);

--
-- Constraints for table `line_details`
--
ALTER TABLE `line_details`
  ADD CONSTRAINT `line_details_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `line_details_ibfk_2` FOREIGN KEY (`line_id`) REFERENCES `bus_lines` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD CONSTRAINT `student_schedule_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`),
  ADD CONSTRAINT `student_schedule_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD CONSTRAINT `suggestions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`),
  ADD CONSTRAINT `trips_ibfk_2` FOREIGN KEY (`line_id`) REFERENCES `bus_lines` (`id`);

--
-- Constraints for table `user_code`
--
ALTER TABLE `user_code`
  ADD CONSTRAINT `user_code_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_notification_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
