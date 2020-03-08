-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2018 at 09:42 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mytables`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_modi_states`
--

CREATE TABLE IF NOT EXISTS `admin_modi_states` (
  `current_stand` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT 'مدرج1',
  `current_dr` int(11) NOT NULL DEFAULT '0',
  `current_group` int(11) NOT NULL DEFAULT '0',
  `adm_id` int(11) NOT NULL,
  `islogged` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_modi_states`
--

INSERT INTO `admin_modi_states` (`current_stand`, `current_dr`, `current_group`, `adm_id`, `islogged`) VALUES
('مدرج4', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `allcourses`
--

CREATE TABLE IF NOT EXISTS `allcourses` (
  `crs_id` int(11) NOT NULL,
  `crs_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `dr_id` int(11) NOT NULL,
  `v_dept` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT 'العام',
  `alocated` int(11) NOT NULL DEFAULT '0',
  `dr_alocated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allcourses`
--

INSERT INTO `allcourses` (`crs_id`, `crs_name`, `dr_id`, `v_dept`, `alocated`, `dr_alocated`) VALUES
(0, '_', 0, '', 1, 1),
(1, 'فيزياء', 6, 'العام', 0, 1),
(2, 'أساسيات برمجة', 8, 'العام', 0, 1),
(3, 'أساسيات ع حاسب', 7, 'العام', 0, 1),
(4, 'رياضيات منفصلة', 12, 'العام', 0, 1),
(5, 'data structure', 0, 'العام', 0, 0),
(6, 'computer archeture', 0, 'العام', 0, 0),
(7, 'جبر خطي', 12, 'العام', 0, 1),
(8, 'برمجة ويب', 6, 'العام', 0, 1),
(9, 'نظم تشغيل', 0, 'العام', 0, 0),
(10, 'الكترونيات', 0, 'تك_المعلومات', 0, 0),
(11, 'هندسة برمجيات', 5, 'تك_المعلومات', 0, 1),
(12, 'شبكات الحاسب', 0, 'تك_المعلومات', 0, 0),
(13, 'قواعد بيانات2', 0, 'ن_المعلومات', 0, 0),
(14, 'اساليب بحث ع', 0, 'العام', 0, 0),
(15, 'لغة', 10, 'العام', 0, 1),
(16, 'biometric', 2, 'تك_المعلومات', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assistants`
--

CREATE TABLE IF NOT EXISTS `assistants` (
`dr_id` int(11) NOT NULL,
  `dr_fullname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '6',
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `current_stand` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'مدرج1',
  `degree` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assistants`
--

INSERT INTO `assistants` (`dr_id`, `dr_fullname`, `username`, `password`, `priority`, `status`, `current_stand`, `degree`) VALUES
(1, 'محمود عبد السلام', 'ms', '123', 2, '1', 'مدرج1', 0),
(2, 'محمد الشرقاوي', 'msh', '123', 6, '1', 'مدرج2', 1),
(3, 'احمد ابو دسوقي', 'ad', '123', 5, '1', 'مدرج1', 1),
(4, 'مروة', 'mh', '123', 5, '1', 'مدرج1', 1),
(6, 'امل', 'am', '123', 4, '1', 'مدرج1', 1),
(7, 'مصطفي الجيار', 'mg', '123', 4, '1', 'مدرج1', 1),
(8, 'سارة', 'ssh', '123', 5, '1', 'مدرج1', 1),
(9, 'ياسمين', 'ys', '123', 4, '1', 'مدرج1', 1),
(10, 'نيرة', 'na', '123', 5, '1', 'مدرج1', 1),
(11, 'احمد', 'a', '1', 1, '1', 'مدرج1', 1),
(12, 'ahmed', 'as', '123', 2, '1', 'مدرج1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursesofdoctor`
--

CREATE TABLE IF NOT EXISTS `coursesofdoctor` (
  `c_o_d` int(11) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `crs_id` int(11) NOT NULL,
  `alocated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursesofdoctor`
--

INSERT INTO `coursesofdoctor` (`c_o_d`, `dr_id`, `crs_id`, `alocated`) VALUES
(0, 0, 0, 0),
(3, 3, 2, 0),
(5, 4, 12, 0),
(8, 4, 16, 0),
(24, 1, 22, 0),
(29, 1, 3, 0),
(30, 1, 11, 0),
(32, 6, 1, 0),
(33, 5, 11, 0),
(34, 8, 2, 0),
(35, 9, 10, 0),
(36, 10, 15, 0),
(37, 12, 7, 0),
(38, 12, 4, 0),
(39, 7, 3, 0),
(40, 6, 8, 0),
(41, 2, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses_groups`
--

CREATE TABLE IF NOT EXISTS `courses_groups` (
  `cg_id` int(11) NOT NULL,
  `s_group` int(11) NOT NULL,
  `crs_id` int(11) NOT NULL,
  `alocated` int(11) NOT NULL DEFAULT '0',
  `stand` varchar(11) CHARACTER SET utf8 NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses_groups`
--

INSERT INTO `courses_groups` (`cg_id`, `s_group`, `crs_id`, `alocated`, `stand`) VALUES
(0, 0, 0, 0, '0'),
(1, 1, 1, 6, '0'),
(2, 2, 1, 0, '0'),
(3, 3, 5, 0, '0'),
(4, 3, 6, 0, '0'),
(5, 3, 7, 12, '0'),
(6, 3, 8, 0, '0'),
(7, 1, 2, 0, '0'),
(8, 1, 3, 0, '0'),
(9, 1, 4, 0, '0'),
(10, 1, 15, 10, '0'),
(11, 3, 9, 0, '0'),
(12, 5, 14, 0, '0'),
(13, 5, 10, 0, '0'),
(14, 5, 11, 0, '0'),
(15, 5, 12, 0, '0'),
(16, 5, 13, 0, '0'),
(17, 6, 5, 0, '0'),
(18, 6, 6, 0, '0'),
(19, 6, 7, 0, '0'),
(20, 6, 8, 0, '0'),
(22, 7, 16, 2, '0'),
(23, 6, 16, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `current_stand`
--

CREATE TABLE IF NOT EXISTS `current_stand` (
  `id` int(11) NOT NULL,
  `current_stand_name` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT 'مدرج1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_stand`
--

INSERT INTO `current_stand` (`id`, `current_stand_name`) VALUES
(1, 'مدرج1');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `day_name`) VALUES
(1, 'السبت'),
(2, 'الاحد'),
(3, 'الاثنين'),
(4, 'الثلاثاء'),
(5, 'الاربعاء'),
(6, 'الخميس');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
`dr_id` int(11) NOT NULL,
  `dr_fullname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '6',
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `current_stand` varchar(20) CHARACTER SET utf8 DEFAULT 'مدرج1',
  `degree` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`dr_id`, `dr_fullname`, `username`, `password`, `priority`, `status`, `current_stand`, `degree`) VALUES
(0, '-', '', '', 0, '1', '', 0),
(2, 'أسامة عودة', 'oo', '123', 6, '1', 'مدرج1', 1),
(3, 'ريهام رضا', 'rr', '123', 4, '1', 'مدرج1', 1),
(4, 'أحمد عطوان', 'aa', '123', 6, '1', 'مدرج1', 1),
(5, 'وليد محمد', 'wm', '123', 5, '1', 'مدرج1', 1),
(6, 'حازم البكري', 'hb', '123', 6, '1', 'مدرج1', 1),
(7, 'هيثم', 'hh', '123', 4, '1', 'مدرج2', 1),
(8, 'أسامة ابو النصر', 'on', '123', 5, '1', 'مدرج2', 1),
(9, 'نغم', 'nn', '123', 4, '1', 'مدرج1', 1),
(10, 'ميرفت ابو الخير', 'mk', '123', 4, '1', 'مدرج1', 1),
(11, 'إيمان الديداموني', 'ed', '123', 5, '1', 'مدرج1', 1),
(12, 'شريف بركات ', 'sb', '123', 6, '1', 'مدرج1', 1),
(87, 'administrator', 'admin', 'admin', 6, '0', 'مدرج1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_course`
--

CREATE TABLE IF NOT EXISTS `doctor_course` (
  `doc_c_id` int(11) NOT NULL,
  `s_group` int(11) NOT NULL,
  `stand` varchar(30) CHARACTER SET utf8 NOT NULL,
  `day` int(10) NOT NULL,
  `lec` int(11) NOT NULL,
  `dr_id` int(11) DEFAULT NULL,
  `crs_id` int(11) NOT NULL,
  `done` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_course`
--

INSERT INTO `doctor_course` (`doc_c_id`, `s_group`, `stand`, `day`, `lec`, `dr_id`, `crs_id`, `done`) VALUES
(1, 5, 'stand1', 1, 1, 0, 0, 0),
(2, 7, 'stand1', 1, 3, 0, 0, 0),
(3, 7, 'stand1', 1, 4, 0, 0, 0),
(4, 7, 'stand1', 3, 2, 0, 0, 0),
(5, 8, 'stand3', 2, 3, 0, 0, 0),
(6, 8, 'stand2', 3, 3, 0, 0, 0),
(7, 8, 'stand2', 3, 4, 0, 0, 0),
(8, 8, 'stand2', 6, 1, 0, 0, 0),
(9, 8, 'stand2', 6, 2, 0, 0, 0),
(10, 6, 'stand1', 3, 4, 0, 0, 0),
(12, 1, 'stand1', 5, 1, 0, 0, 0),
(13, 10, 'stand1', 5, 2, 0, 0, 0),
(14, 10, 'stand1', 5, 3, 0, 0, 0),
(15, 1, 'stand2', 1, 1, 0, 0, 0),
(16, 1, 'stand2', 1, 2, 0, 0, 0),
(17, 2, 'stand2', 1, 3, 0, 0, 0),
(18, 2, 'stand2', 1, 4, 0, 0, 0),
(19, 3, 'stand1', 6, 3, 0, 0, 0),
(20, 3, 'stand1', 6, 4, 0, 0, 0),
(21, 4, 'stand1', 4, 3, 0, 0, 0),
(22, 4, 'stand1', 4, 4, 0, 0, 0),
(23, 9, 'stand1', 2, 3, 0, 0, 0),
(24, 9, 'stand1', 2, 4, 0, 0, 0),
(25, 6, 'stand1', 2, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lab_rooms`
--

CREATE TABLE IF NOT EXISTS `lab_rooms` (
  `lab_id` int(11) NOT NULL,
  `lab_name` varchar(30) NOT NULL,
  `capacity` int(11) NOT NULL,
  `location` varchar(30) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT 'عملي'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_rooms`
--

INSERT INTO `lab_rooms` (`lab_id`, `lab_name`, `capacity`, `location`, `type`) VALUES
(1, 'A-1', 30, 'الدور الاول', 'عملي'),
(2, 'A-4', 30, 'الدور الاول', 'عملي'),
(3, 'B-1', 30, 'الدور التاني', 'عملي'),
(4, 'B-3', 30, 'الدور التاني', 'عملي'),
(5, 'B-5', 30, 'الدور التاني', 'عملي'),
(6, 'C-1', 30, 'الدور التاني', 'عملي'),
(7, 'C-2', 30, 'الدور التاني', 'عملي'),
(8, 'C-3', 30, 'الدور التاني', 'عملي'),
(9, 'C-4', 30, 'الدور الثالث', 'عملي'),
(10, 'C-8', 30, 'الدور التالت', 'نظري'),
(11, 'C-5', 30, 'الدور الثالث', 'عملي'),
(12, 'C-6', 30, 'الدور الثالث', 'عملي'),
(13, 'C-7', 30, 'الدور الثالث', 'عملي'),
(14, 'C-9', 30, 'الدور الثالث', 'نظري');

-- --------------------------------------------------------

--
-- Table structure for table `lecs`
--

CREATE TABLE IF NOT EXISTS `lecs` (
  `lec_id` int(11) NOT NULL,
  `lec_name` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecs`
--

INSERT INTO `lecs` (`lec_id`, `lec_name`) VALUES
(1, 'محاضرة1'),
(2, 'محاضرة2'),
(3, 'محاضرة3'),
(4, 'محاضرة4'),
(5, 'محاضرة5'),
(6, 'محاضرة6');

-- --------------------------------------------------------

--
-- Table structure for table `showtables`
--

CREATE TABLE IF NOT EXISTS `showtables` (
  `doc_c_id` int(11) NOT NULL,
  `S_group` int(11) NOT NULL DEFAULT '0',
  `stand` varchar(30) CHARACTER SET utf8 DEFAULT 'stand1',
  `day` int(11) NOT NULL DEFAULT '0',
  `lec` int(11) NOT NULL DEFAULT '0',
  `dr_id` int(11) NOT NULL DEFAULT '0',
  `crs_id` int(11) NOT NULL DEFAULT '0',
  `done` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showtables`
--

INSERT INTO `showtables` (`doc_c_id`, `S_group`, `stand`, `day`, `lec`, `dr_id`, `crs_id`, `done`) VALUES
(1, 1, 'مدرج1', 1, 1, 6, 1, 6),
(2, 1, 'مدرج1', 1, 2, 10, 15, 10),
(3, 0, 'مدرج1', 1, 3, 0, 0, 0),
(4, 0, 'مدرج1', 1, 4, 0, 0, 0),
(5, 0, 'مدرج1', 1, 5, 0, 0, 0),
(6, 0, 'مدرج1', 1, 6, 0, 0, 0),
(7, 0, 'مدرج1', 2, 1, 0, 0, 0),
(8, 7, 'مدرج1', 2, 2, 0, 0, 0),
(9, 7, 'مدرج1', 2, 3, 2, 16, 2),
(10, 0, 'مدرج1', 2, 4, 0, 0, 0),
(11, 0, 'مدرج1', 2, 5, 0, 0, 0),
(12, 0, 'مدرج1', 2, 6, 0, 0, 0),
(13, 0, 'مدرج1', 3, 1, 0, 0, 0),
(14, 5, 'مدرج1', 3, 2, 0, 0, 0),
(15, 5, 'مدرج1', 3, 3, 0, 0, 0),
(16, 0, 'مدرج1', 3, 4, 0, 0, 0),
(17, 0, 'مدرج1', 3, 5, 0, 0, 0),
(18, 0, 'مدرج1', 3, 6, 0, 0, 0),
(19, 0, 'مدرج1', 4, 1, 0, 0, 0),
(20, 1, 'مدرج1', 4, 2, 0, 0, 0),
(21, 1, 'مدرج1', 4, 3, 0, 0, 0),
(22, 0, 'مدرج1', 4, 4, 0, 0, 0),
(23, 0, 'مدرج1', 4, 5, 0, 0, 0),
(24, 0, 'مدرج1', 4, 6, 0, 0, 0),
(25, 0, 'مدرج1', 5, 1, 0, 0, 0),
(26, 0, 'مدرج1', 5, 2, 0, 0, 0),
(27, 0, 'مدرج1', 5, 3, 0, 0, 0),
(28, 0, 'مدرج1', 5, 4, 0, 0, 0),
(29, 0, 'مدرج1', 5, 5, 0, 0, 0),
(30, 0, 'مدرج1', 5, 6, 0, 0, 0),
(31, 0, 'مدرج1', 6, 1, 0, 0, 0),
(32, 0, 'مدرج1', 6, 2, 0, 0, 0),
(33, 0, 'مدرج1', 6, 3, 0, 0, 0),
(34, 0, 'مدرج1', 6, 4, 0, 0, 0),
(35, 0, 'مدرج1', 6, 5, 0, 0, 0),
(36, 0, 'مدرج1', 6, 6, 0, 0, 0),
(44, 0, 'مدرج2', 1, 1, 0, 0, 0),
(45, 5, 'مدرج2', 1, 2, 0, 0, 0),
(46, 0, 'مدرج2', 1, 3, 0, 0, 0),
(47, 0, 'مدرج2', 1, 4, 0, 0, 0),
(48, 0, 'مدرج2', 1, 5, 0, 0, 0),
(49, 0, 'مدرج2', 1, 6, 0, 0, 0),
(51, 0, 'مدرج2', 2, 1, 0, 0, 0),
(52, 0, 'مدرج2', 2, 2, 0, 0, 0),
(53, 0, 'مدرج2', 2, 3, 0, 0, 0),
(54, 0, 'مدرج2', 2, 4, 0, 0, 0),
(55, 0, 'مدرج2', 2, 5, 0, 0, 0),
(56, 0, 'مدرج2', 2, 6, 0, 0, 0),
(58, 0, 'مدرج2', 3, 1, 0, 0, 0),
(59, 0, 'مدرج2', 3, 2, 0, 0, 0),
(60, 0, 'مدرج2', 3, 3, 0, 0, 0),
(61, 0, 'مدرج2', 3, 4, 0, 0, 0),
(62, 1, 'مدرج2', 3, 5, 0, 0, 0),
(63, 0, 'مدرج2', 3, 6, 0, 0, 0),
(65, 0, 'مدرج2', 4, 1, 0, 0, 0),
(66, 0, 'مدرج2', 4, 2, 0, 0, 0),
(67, 0, 'مدرج2', 4, 3, 0, 0, 0),
(68, 0, 'مدرج2', 4, 4, 0, 0, 0),
(69, 0, 'مدرج2', 4, 5, 0, 0, 0),
(70, 0, 'مدرج2', 4, 6, 0, 0, 0),
(72, 0, 'مدرج2', 5, 1, 0, 0, 0),
(73, 0, 'مدرج2', 5, 2, 0, 0, 0),
(74, 0, 'مدرج2', 5, 3, 0, 0, 0),
(75, 0, 'مدرج2', 5, 4, 0, 0, 0),
(76, 0, 'مدرج2', 5, 5, 0, 0, 0),
(77, 0, 'مدرج2', 5, 6, 0, 0, 0),
(79, 0, 'مدرج2', 6, 1, 0, 0, 0),
(80, 0, 'مدرج2', 6, 2, 0, 0, 0),
(81, 0, 'مدرج2', 6, 3, 0, 0, 0),
(82, 0, 'مدرج2', 6, 4, 0, 0, 0),
(83, 0, 'مدرج2', 6, 5, 0, 0, 0),
(84, 0, 'مدرج2', 6, 6, 0, 0, 0),
(85, 0, 'مدرج3', 1, 1, 0, 0, 0),
(86, 0, 'مدرج3', 1, 2, 0, 0, 0),
(87, 0, 'مدرج3', 1, 3, 0, 0, 0),
(88, 0, 'مدرج3', 1, 4, 0, 0, 0),
(89, 0, 'مدرج3', 1, 5, 0, 0, 0),
(90, 0, 'مدرج3', 1, 6, 0, 0, 0),
(91, 0, 'مدرج3', 2, 1, 0, 0, 0),
(92, 0, 'مدرج3', 2, 2, 0, 0, 0),
(93, 0, 'مدرج3', 2, 3, 0, 0, 0),
(94, 0, 'مدرج3', 2, 4, 0, 0, 0),
(95, 0, 'مدرج3', 2, 5, 0, 0, 0),
(96, 0, 'مدرج3', 2, 6, 0, 0, 0),
(97, 0, 'مدرج3', 3, 1, 0, 0, 0),
(98, 0, 'مدرج3', 3, 2, 0, 0, 0),
(99, 0, 'مدرج3', 3, 3, 0, 0, 0),
(100, 0, 'مدرج3', 3, 4, 0, 0, 0),
(101, 0, 'مدرج3', 3, 5, 0, 0, 0),
(102, 0, 'مدرج3', 3, 6, 0, 0, 0),
(103, 0, 'مدرج3', 4, 1, 0, 0, 0),
(104, 0, 'مدرج3', 4, 2, 0, 0, 0),
(105, 0, 'مدرج3', 4, 3, 0, 0, 0),
(106, 0, 'مدرج3', 4, 4, 0, 0, 0),
(107, 0, 'مدرج3', 4, 5, 0, 0, 0),
(108, 0, 'مدرج3', 4, 6, 0, 0, 0),
(109, 0, 'مدرج3', 5, 1, 0, 0, 0),
(110, 0, 'مدرج3', 5, 2, 0, 0, 0),
(111, 0, 'مدرج3', 5, 3, 0, 0, 0),
(112, 0, 'مدرج3', 5, 4, 0, 0, 0),
(113, 0, 'مدرج3', 5, 5, 0, 0, 0),
(114, 0, 'مدرج3', 5, 6, 0, 0, 0),
(115, 0, 'مدرج3', 6, 1, 0, 0, 0),
(116, 0, 'مدرج3', 6, 2, 0, 0, 0),
(117, 0, 'مدرج3', 6, 3, 0, 0, 0),
(118, 0, 'مدرج3', 6, 4, 0, 0, 0),
(119, 0, 'مدرج3', 6, 5, 0, 0, 0),
(120, 0, 'مدرج3', 6, 6, 0, 0, 0),
(121, 0, 'مدرج4', 1, 1, 0, 0, 0),
(122, 0, 'مدرج4', 1, 2, 0, 0, 0),
(123, 0, 'مدرج4', 1, 3, 0, 0, 0),
(124, 0, 'مدرج4', 1, 4, 0, 0, 0),
(125, 0, 'مدرج4', 1, 5, 0, 0, 0),
(126, 0, 'مدرج4', 1, 6, 0, 0, 0),
(127, 0, 'مدرج4', 2, 1, 0, 0, 0),
(128, 0, 'مدرج4', 2, 2, 0, 0, 0),
(129, 0, 'مدرج4', 2, 3, 0, 0, 0),
(130, 0, 'مدرج4', 2, 4, 0, 0, 0),
(131, 0, 'مدرج4', 2, 5, 0, 0, 0),
(132, 0, 'مدرج4', 2, 6, 0, 0, 0),
(133, 0, 'مدرج4', 3, 1, 0, 0, 0),
(134, 0, 'مدرج4', 3, 2, 0, 0, 0),
(135, 0, 'مدرج4', 3, 3, 0, 0, 0),
(136, 0, 'مدرج4', 3, 4, 0, 0, 0),
(137, 0, 'مدرج4', 3, 5, 0, 0, 0),
(138, 0, 'مدرج4', 3, 6, 0, 0, 0),
(139, 0, 'مدرج4', 4, 1, 0, 0, 0),
(140, 0, 'مدرج4', 4, 2, 0, 0, 0),
(141, 0, 'مدرج4', 4, 3, 0, 0, 0),
(142, 0, 'مدرج4', 4, 4, 0, 0, 0),
(143, 0, 'مدرج4', 4, 5, 0, 0, 0),
(144, 0, 'مدرج4', 4, 6, 0, 0, 0),
(145, 0, 'مدرج4', 5, 1, 0, 0, 0),
(146, 0, 'مدرج4', 5, 2, 0, 0, 0),
(147, 0, 'مدرج4', 5, 3, 0, 0, 0),
(148, 0, 'مدرج4', 5, 4, 0, 0, 0),
(149, 0, 'مدرج4', 5, 5, 0, 0, 0),
(150, 0, 'مدرج4', 5, 6, 0, 0, 0),
(151, 0, 'مدرج4', 6, 1, 0, 0, 0),
(152, 0, 'مدرج4', 6, 2, 0, 0, 0),
(153, 0, 'مدرج4', 6, 3, 0, 0, 0),
(154, 0, 'مدرج4', 6, 4, 0, 0, 0),
(155, 0, 'مدرج4', 6, 5, 0, 0, 0),
(156, 0, 'مدرج4', 6, 6, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stands`
--

CREATE TABLE IF NOT EXISTS `stands` (
  `stand_id` int(11) NOT NULL,
  `stand_name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT '100',
  `location` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stands`
--

INSERT INTO `stands` (`stand_id`, `stand_name`, `capacity`, `location`) VALUES
(1, 'مدرج1', 250, 'الدور 1'),
(2, 'مدرج2', 150, 'الدور 1'),
(3, 'مدرج3', 150, 'الدور 2'),
(4, 'مدرج4', 100, 'الدور 3');

-- --------------------------------------------------------

--
-- Table structure for table `s_groups`
--

CREATE TABLE IF NOT EXISTS `s_groups` (
  `group_id` int(11) NOT NULL,
  `st_group` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '_',
  `dept` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '_',
  `h_periority` int(6) NOT NULL DEFAULT '6',
  `capacity` int(11) DEFAULT '150',
  `count_groups` int(11) DEFAULT '5',
  `holiday` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_groups`
--

INSERT INTO `s_groups` (`group_id`, `st_group`, `dept`, `h_periority`, `capacity`, `count_groups`, `holiday`) VALUES
(0, '_', '_', -1, NULL, NULL, 0),
(1, 'اولي-أ', 'العام', 0, 330, 11, 6),
(5, 'ثالثة', 'تك_المعلومات', 6, 150, 5, 1),
(6, 'تانية-أ', 'العام', 6, 150, 5, 1),
(7, 'رابعة', 'تك-المعلومات', 0, 150, 5, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_modi_states`
--
ALTER TABLE `admin_modi_states`
 ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `allcourses`
--
ALTER TABLE `allcourses`
 ADD PRIMARY KEY (`crs_id`);

--
-- Indexes for table `assistants`
--
ALTER TABLE `assistants`
 ADD PRIMARY KEY (`dr_id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `coursesofdoctor`
--
ALTER TABLE `coursesofdoctor`
 ADD PRIMARY KEY (`c_o_d`);

--
-- Indexes for table `courses_groups`
--
ALTER TABLE `courses_groups`
 ADD PRIMARY KEY (`cg_id`);

--
-- Indexes for table `current_stand`
--
ALTER TABLE `current_stand`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
 ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
 ADD PRIMARY KEY (`dr_id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `doctor_course`
--
ALTER TABLE `doctor_course`
 ADD PRIMARY KEY (`doc_c_id`);

--
-- Indexes for table `lab_rooms`
--
ALTER TABLE `lab_rooms`
 ADD PRIMARY KEY (`lab_id`);

--
-- Indexes for table `lecs`
--
ALTER TABLE `lecs`
 ADD PRIMARY KEY (`lec_id`);

--
-- Indexes for table `showtables`
--
ALTER TABLE `showtables`
 ADD PRIMARY KEY (`doc_c_id`);

--
-- Indexes for table `stands`
--
ALTER TABLE `stands`
 ADD PRIMARY KEY (`stand_name`);

--
-- Indexes for table `s_groups`
--
ALTER TABLE `s_groups`
 ADD PRIMARY KEY (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assistants`
--
ALTER TABLE `assistants`
MODIFY `dr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
MODIFY `dr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
