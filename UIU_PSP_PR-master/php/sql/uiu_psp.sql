-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2023 at 07:43 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uiu_psp`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` varchar(100) NOT NULL,
  `problem_id` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `posted_by` varchar(20) DEFAULT NULL,
  `last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `is_accepted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `problem_id`, `description`, `posted_by`, `last_modified`, `is_accepted`) VALUES
('P0_1672593124_011202271_S1', 'P0_1672593124_011202271', 'If I understand correctly, you would like a mean to specify the version of TypeScript that should be used to compile a given project. And some automated mechanism to have the correct tsc version, or to raise an error.', '011202272', '2023-01-01 23:56:27', 0),
('P0_1672593124_011202271_S2', 'P0_1672593124_011202271', 'This is very friendly to the branch predictor since the branch consecutively goes the same direction many times. Even a simple saturating counter will correctly predict the branch except for the few iterations after it switches direction.', '011202274', '2023-01-02 00:27:14', 0),
('P1_1672593213_011202271_S0', 'P1_1672593213_011202271', 'We would likely need a little bit more detail to be sure the best way to solve, but it seems there are a few ways of approaching this.\r\n\r\nYou\'ve said that you can get the user id into JavaScript. I\'m presuming this means the browser is needing to make the connection to the Flask app. If you have the option of doing this with the WordPress site calling the Flask app directly (server-to-server) you can avoid a lot of hassle.', '011202273', '2023-01-01 23:17:47', 1),
('P2_1672597306_011202274_S3', 'P2_1672597306_011202274', 'The KMP algorithm searches for a length-m substring in a length-n string in worst-case O(n+m) time, compared to a worst-case of O(n⋅m) for the naive algorithm, so using KMP may be reasonable if you care about worst-case time complexity.', '011202275', '2023-01-02 00:33:01', 0),
('P3_1672597813_011202275_S4', 'P3_1672597813_011202275', 'The code above produces no output on my Windows machine. So any time zone which has any offset other than its standard one at the start of 1900 will count that as a transition. TZDB itself has some data going back earlier than that, and doesn\'t rely on any idea', '011202277', '2023-01-02 00:37:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ans_img`
--

CREATE TABLE `ans_img` (
  `img_name` varchar(255) NOT NULL,
  `ans_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ans_img`
--

INSERT INTO `ans_img` (`img_name`, `ans_id`) VALUES
('1672597634Screenshot_20230102_122659.png', 'P0_1672593124_011202271_S2'),
('1672593467Screenshot_20230101_111729.png', 'P1_1672593213_011202271_S0'),
('1672598223Screenshot_20230101_111326.png', 'P3_1672597813_011202275_S4');

-- --------------------------------------------------------

--
-- Table structure for table `a_comment`
--

CREATE TABLE `a_comment` (
  `comment_text` varchar(255) NOT NULL,
  `answer_id` varchar(100) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_comment`
--

INSERT INTO `a_comment` (`comment_text`, `answer_id`, `student_id`, `last_modified`) VALUES
('Nice explaination !', 'P0_1672593124_011202271_S1', '011202274', '2023-01-02 00:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `a_likes`
--

CREATE TABLE `a_likes` (
  `user_id` varchar(20) DEFAULT NULL,
  `answer_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_likes`
--

INSERT INTO `a_likes` (`user_id`, `answer_id`) VALUES
('011202273', 'P1_1672593213_011202271_S0'),
('011202271', 'P1_1672593213_011202271_S0'),
('011202273', 'P0_1672593124_011202271_S1'),
('011202274', 'P0_1672593124_011202271_S1'),
('011202274', 'P0_1672593124_011202271_S2'),
('011202275', 'P2_1672597306_011202274_S3');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_code` varchar(30) NOT NULL,
  `course_title` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `course_title`) VALUES
('ACT 111/ACT 2111', 'Financial and Managerial Accounting'),
('BDS 1201', 'History of the Emergence of Bangladesh'),
('BIO 3105', 'Biology for Engineers'),
('CHE 2101/CHEM 101', 'Chemistry'),
('CSE 1111/CSI 121', 'Structured Programming Language'),
('CSE 1115/CSI 211', 'Object Oriented Programming/Object-Oriented Programming'),
('CSE 113/EEE 2113', 'Electrical Circuits'),
('CSE 123/EEE 2123', 'Electronics'),
('CSE 1325/CSE 225', 'Digital Logic Design'),
('CSE 2213/CSI 219', 'Discrete Mathematics'),
('CSE 2215/CSI 217', 'Data Structure/Data Structure and Algorithms I'),
('CSE 2217/CSI 227', 'Algorithms/Data Structure and Algorithms II'),
('CSE 2233/CSI 233', 'Theory of Computation/Theory of Computing'),
('CSE 313/CSE 3313/EEE 4411', 'Computer Architecture'),
('CSE 315/CSE 3715', 'Data Communication'),
('CSE 323/CSE 3711/EEE 4413', 'Computer Networks'),
('CSE 3411/CSI 311', 'System Analysis and Design'),
('CSE 3421/CSI 321', 'Software Engineering'),
('CSE 3521/CSI 221', 'Database Management Systems'),
('CSE 3811/CSI 341', 'Artificial Intelligence'),
('CSE 4165/CSE 465', 'Web Programming'),
('CSE 4181/CSE 481', 'Mobile Application Development'),
('CSE 425/CSE 4325', 'Microprocessor, Microcontroller and Interfacing/Microprocessors and Microcontrol'),
('CSE 429/CSE 4329', 'Digital System Design'),
('CSE 4451/CSE 451', 'Human Computer Interaction'),
('CSE 4495/CSE 495', ' Software Testing and Quality Assurance/Software Testing, Verification and Quali'),
('CSE 4509/CSI 309', 'Operating System Concepts/Operating Systems'),
('CSE 4521/CSE 4621', 'Computer Graphics'),
('CSE 4523/CSI 423', 'Simulation & Modeling/Simulation and Modeling'),
('CSE 4587/CSE 487', 'Cloud Computing'),
('CSE 4611/CSI 411', 'Compiler/Compiler Design'),
('CSE 4633', 'Basic Graph Theory'),
('CSE 469/PMG 4101', 'Project Management'),
('CSE 483/CSE 4883', 'Digital Image Processing'),
('CSE 4889/CSE 489', 'Machine Learning'),
('CSE 4891/CSE 491', 'Data Mining'),
('CSE 4893/CSE 493', 'Introduction to Bioinformatics'),
('CSI 415', 'Pattern Recognition'),
('ECO 2101/ECO 213', ' Economics'),
('EEE 1001/EEE 101', 'Electrical Circuits I'),
('EEE 1003/EEE 103', 'Electrical Circuits II'),
('EEE 105/EEE 2101', 'Electronics I'),
('EEE 121/EEE 2401', 'Structured Programming Language'),
('EEE 203/EEE 2201', 'Energy Conversion I'),
('EEE 205/EEE 2203', 'Energy Conversion II'),
('EEE 207/EEE 2103', ' Electronics II'),
('EEE 2105/EEE 223', 'Digital Electronics'),
('EEE 211/EEE 2301', 'Signals and Linear System/Signals and Linear Systems'),
('EEE 255/EEE 3303', 'Probability and Random Signal Analysis/Probability, Statistics and Random Variab'),
('EEE 301/EEE 3107', 'Electrical Properties of Materials'),
('EEE 303/EEE 3305', 'Engineering Electromagnetics'),
('EEE 305/EEE 3205', 'Power System'),
('EEE 307/EEE 3207', 'Power Electronics'),
('EEE 309/EEE 3307', 'Communication Theory'),
('EEE 311/EEE 3309', 'Digital Signal Processing'),
('EEE 3403/EEE 423', 'Microprocessor and Interfacing'),
('EEE 401/EEE 4109', 'Control System'),
('EEE 4115/EEE 433', 'Optoelectronics'),
('EEE 4121/EEE 441', 'VLSI Design'),
('EEE 4223/EEE 483', 'Renewable Energy'),
('ENG 101/ENG 1011', 'English I'),
('ENG 1013/ENG 103', 'English II'),
('IPE 3401/IPE 401', 'Industrial and Operational Management'),
('MATH 1101/MATH 003', 'Calculus I/Elementary Calculus'),
('MATH 1103/MATH 151', 'Calculus II/Differential and Integral Calculus'),
('MATH 1151/MATH 151', 'Differential and Integral Calculus'),
('MATH 183/MATH 2183', 'Calculus and Linear Algebra/Linear'),
('MATH 2105', 'Linear Algebra and Differential Equation'),
('MATH 2107/MATH 187', 'Complex Variables, Fourier and Laplace Transforms/Fourier & Laplace Transformati'),
('MATH 2109/MATH 201', 'Coordinate Geometry and Vector Analysis'),
('MATH 2205/STAT 205', 'Probability and Statistics'),
('PHY 101/PHY 1101', 'Physics I'),
('PHY 103/PHY 1103', 'Physics II'),
('PHY 105/PHY 2105', 'Physics'),
('PSY 101/PSY 2101', 'Psychology'),
('SOC 101/SOC 2101', 'Society, Environment and Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`name`) VALUES
('Final'),
('Mid');

-- --------------------------------------------------------

--
-- Table structure for table `pblm_img`
--

CREATE TABLE `pblm_img` (
  `img_name` varchar(100) NOT NULL,
  `problem_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pblm_img`
--

INSERT INTO `pblm_img` (`img_name`, `problem_id`) VALUES
('1672593124Screenshot_20230101_111153.png', 'P0_1672593124_011202271'),
('1672593213Screenshot_20230101_111326.png', 'P1_1672593213_011202271'),
('1672597306Screenshot_20230102_122125.png', 'P2_1672597306_011202274'),
('1672598415Screenshot_20230102_124005.png', 'P4_1672598415_011202277');

-- --------------------------------------------------------

--
-- Table structure for table `problem_asked`
--

CREATE TABLE `problem_asked` (
  `title` text NOT NULL,
  `problem_id` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `course_code` varchar(30) DEFAULT NULL,
  `topic_name` varchar(100) NOT NULL,
  `views` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `last_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problem_asked`
--

INSERT INTO `problem_asked` (`title`, `problem_id`, `description`, `course_code`, `topic_name`, `views`, `student_id`, `last_modified`) VALUES
('How to optimize Linq query with large number of records?', 'P0_1672593124_011202271', '\r\n\r\nThe bounty expires in 10 hours. Answers to this question are eligible for a +300 reputation bounty. StarLord is looking for a more detailed answer to this question:\r\nI want to see a significant performance improvement for this.\r\nPlease help me to optimize the below code. I have tried different methods but I am not getting a significant performance improvement. There are around 30k entries in database and it\'s taking around 1 min to load in local.', 'CSE 2215/CSI 217', 'DFS', 10, '011202271', '2023-01-01 23:12:04'),
('ReactJS Kanban Board Drag and Drop without using external libraries', 'P1_1672593213_011202271', 'I am creating a Kanban Board in ReactJS. All the stages are stored as a JSON with their respective tasks. I want to be able to drag and drop a task to a given stage headline in order to move it from one stage to another.', 'CSE 4495/CSE 495', 'Verification', 8, '011202271', '2023-01-01 23:13:33'),
('The network of transistors, transformers, capacitors, connecting wires, and other electronic?', 'P2_1672597306_011202274', 'The second component is the device. It responds to the current passing through it. Today, a device is something that can be plugged into a wall socket and used with electricity. The loop is generally closed using a piece of conducting material. It is usually a wire but there are other kinds of materials that can close the loop too. For example, there are various strips of metal inside the television that have been deposited onto a plastic surface that may be the conducting material or even in some cases, the chassis of a device that becomes part of the closed circuit.', 'CSE 113/EEE 2113', 'Electric Circuit', 2, '011202274', '2023-01-02 00:21:46'),
('How do I check if an element is hidden in jQuery?', 'P3_1672597813_011202275', 'How do I toggle the visibility of an element using .hide(), .show(), or .toggle()?\r\n\r\nHow do I test if an element is visible or hidden?', 'CSE 1115/CSI 211', 'jQuery', 3, '011202275', '2023-01-02 00:30:13'),
('What is the difference between String and string in C#?', 'P4_1672598415_011202277', 'Usually I would expect a String.contains() method, but there doesn\'t seem to be one.\r\n\r\nWhat is a reasonable way to check for this?', 'CSE 1111/CSI 121', 'String', 2, '011202277', '2023-01-02 00:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `p_comment`
--

CREATE TABLE `p_comment` (
  `comment_text` varchar(255) NOT NULL,
  `problem_id` varchar(100) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_comment`
--

INSERT INTO `p_comment` (`comment_text`, `problem_id`, `student_id`, `last_modified`) VALUES
('Nice question', 'P0_1672593124_011202271', '011202274', '2023-01-02 00:23:57'),
('You can use string without a using directive for System. You can\'t do that with String', 'P0_1672593124_011202271', '011202275', '2023-01-02 00:34:05'),
('Can you please Explain it clearly?', 'P3_1672597813_011202275', '011202277', '2023-01-02 00:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `p_likes`
--

CREATE TABLE `p_likes` (
  `problem_id` varchar(100) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_likes`
--

INSERT INTO `p_likes` (`problem_id`, `user_id`) VALUES
('P1_1672593213_011202271', '011202273'),
('P1_1672593213_011202271', '011202271'),
('P0_1672593124_011202271', '011202271'),
('P0_1672593124_011202271', '011202273'),
('P2_1672597306_011202274', '011202275'),
('P3_1672597813_011202275', '011202277'),
('P4_1672598415_011202277', '011202277');

-- --------------------------------------------------------

--
-- Table structure for table `question_paper`
--

CREATE TABLE `question_paper` (
  `qp_id` varchar(30) NOT NULL,
  `course_code` varchar(30) NOT NULL,
  `trimester_id` varchar(30) NOT NULL,
  `ques_type` varchar(30) NOT NULL,
  `ques_file` varchar(50) NOT NULL,
  `error` int(11) NOT NULL,
  `uploader_id` varchar(30) DEFAULT NULL,
  `last_modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_paper`
--

INSERT INTO `question_paper` (`qp_id`, `course_code`, `trimester_id`, `ques_type`, `ques_file`, `error`, `uploader_id`, `last_modified`) VALUES
('231~Final~CSE_323', 'CSE 323/CSE 3711/EEE 4413', '231', 'Final', '231~Final~CSE_323~1672596879.pdf', 1, '011202273', '2023-01-02 00:14:39'),
('231~Mid~CSE_313', 'CSE 313/CSE 3313/EEE 4411', '231', 'Mid', '231~Mid~CSE_313~1672595403.pdf', 1, '011202271', '2023-01-01 23:50:03'),
('231~Mid~CSE_3521', 'CSE 3521/CSI 221', '231', 'Mid', '231~Mid~CSE_3521~1672593285.pdf', 1, '011202274', '2023-01-01 23:14:45'),
('231~Mid~CSE_3811', 'CSE 3811/CSI 341', '231', 'Mid', '231~Mid~CSE_3811~1672597862.pdf', 1, '011202275', '2023-01-02 00:31:02'),
('232~Final~CSE_323', 'CSE 323/CSE 3711/EEE 4413', '232', 'Final', '232~Final~CSE_323~1672596897.pdf', 1, '011202273', '2023-01-02 00:14:57'),
('232~Final~CSE_3521', 'CSE 3521/CSI 221', '232', 'Final', '232~Final~CSE_3521~1672593329.pdf', 1, '011202274', '2023-01-01 23:15:29'),
('232~Mid~CSE_313', 'CSE 313/CSE 3313/EEE 4411', '232', 'Mid', '232~Mid~CSE_313~1672595422.pdf', 1, '011202271', '2023-01-01 23:50:22'),
('232~Mid~CSE_3521', 'CSE 3521/CSI 221', '232', 'Mid', '232~Mid~CSE_3521~1672593300.pdf', 0, '011202274', '2023-01-01 23:15:59'),
('233~Final~CSE_3521', 'CSE 3521/CSI 221', '233', 'Final', '233~Final~CSE_3521~1672593341.pdf', 1, '011202274', '2023-01-01 23:15:41'),
('233~Mid~CSE_3521', 'CSE 3521/CSI 221', '233', 'Mid', '233~Mid~CSE_3521~1672593315.pdf', 1, '011202274', '2023-01-01 23:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `taken_courses`
--

CREATE TABLE `taken_courses` (
  `student_id` varchar(20) NOT NULL,
  `course_code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taken_courses`
--

INSERT INTO `taken_courses` (`student_id`, `course_code`) VALUES
('011202271', 'CSE 3521/CSI 221'),
('011202274', 'CSE 3521/CSI 221'),
('011202271', 'CSE 313/CSE 3313/EEE 4411'),
('011202273', 'CSE 3521/CSI 221'),
('011202273', 'CSE 313/CSE 3313/EEE 4411'),
('011202273', 'CSE 323/CSE 3711/EEE 4413'),
('011202274', 'CSE 313/CSE 3313/EEE 4411'),
('011202274', 'CSE 323/CSE 3711/EEE 4413'),
('011202275', 'CSE 3811/CSI 341');

-- --------------------------------------------------------

--
-- Table structure for table `trimester`
--

CREATE TABLE `trimester` (
  `trimester_id` varchar(30) NOT NULL,
  `trimester_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trimester`
--

INSERT INTO `trimester` (`trimester_id`, `trimester_name`) VALUES
('221', 'Spring'),
('222', 'Summer'),
('223', 'Fall'),
('231', 'Spring'),
('232', 'Summer'),
('233', 'Fall');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `student_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`student_id`, `name`, `email`, `password`, `img`, `rating`) VALUES
('011202271', 'Shahriar Rahman Niloy', 'sniloy202271@bscse.uiu.ac.bd', '1234', '1672594840profile (4).png', 22),
('011202272', 'Md Feruz Uddin', 'abc2@bscse.uiu.ac.bd', '1234', '1672595473profile (3).png', 3),
('011202273', 'Kazi Ayan', 'abc3@bscse.uiu.ac.bd', '1234', '1672596796profile (5).png', 28),
('011202274', 'Abdur Rahman', 'abc4@bscse.uiu.ac.bd', '1234', '1672597334profile (6).png', 54),
('011202275', 'Mahadi Hassan', 'abc5@bscse.uiu.ac.bd', '1234', '1672597687profile (2).png', 14),
('011202276', 'MD Kawsar Ahmed', 'abc6@bscse.uiu.ac.bd', '1234', 'default-img.jpg', 0),
('011202277', 'Aazair Bary', 'abc7@bscse.uiu.ac.bd', '1234', 'default-img.jpg', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `answer_ibfk_1` (`posted_by`),
  ADD KEY `answer_ibfk_2` (`problem_id`);

--
-- Indexes for table `ans_img`
--
ALTER TABLE `ans_img`
  ADD PRIMARY KEY (`img_name`),
  ADD KEY `ans_img_ibfk_1` (`ans_id`);

--
-- Indexes for table `a_comment`
--
ALTER TABLE `a_comment`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Indexes for table `a_likes`
--
ALTER TABLE `a_likes`
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `pblm_img`
--
ALTER TABLE `pblm_img`
  ADD PRIMARY KEY (`img_name`),
  ADD KEY `pblm_img_ibfk_1` (`problem_id`);

--
-- Indexes for table `problem_asked`
--
ALTER TABLE `problem_asked`
  ADD PRIMARY KEY (`problem_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `p_comment`
--
ALTER TABLE `p_comment`
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `p_likes`
--
ALTER TABLE `p_likes`
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question_paper`
--
ALTER TABLE `question_paper`
  ADD PRIMARY KEY (`qp_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `trimester_id` (`trimester_id`),
  ADD KEY `uploader_id` (`uploader_id`),
  ADD KEY `ques_type` (`ques_type`);

--
-- Indexes for table `taken_courses`
--
ALTER TABLE `taken_courses`
  ADD KEY `tk_cc` (`course_code`),
  ADD KEY `tk_sid` (`student_id`);

--
-- Indexes for table `trimester`
--
ALTER TABLE `trimester`
  ADD PRIMARY KEY (`trimester_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`student_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`posted_by`) REFERENCES `users` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem_asked` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ans_img`
--
ALTER TABLE `ans_img`
  ADD CONSTRAINT `ans_img_ibfk_1` FOREIGN KEY (`ans_id`) REFERENCES `answer` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_comment`
--
ALTER TABLE `a_comment`
  ADD CONSTRAINT `a_comment_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `a_comment_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_likes`
--
ALTER TABLE `a_likes`
  ADD CONSTRAINT `a_likes_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `a_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pblm_img`
--
ALTER TABLE `pblm_img`
  ADD CONSTRAINT `pblm_img_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problem_asked` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `problem_asked`
--
ALTER TABLE `problem_asked`
  ADD CONSTRAINT `problem_asked_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `problem_asked_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `p_comment`
--
ALTER TABLE `p_comment`
  ADD CONSTRAINT `p_comment_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problem_asked` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_comment_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `p_likes`
--
ALTER TABLE `p_likes`
  ADD CONSTRAINT `p_likes_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problem_asked` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `question_paper`
--
ALTER TABLE `question_paper`
  ADD CONSTRAINT `question_paper_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_paper_ibfk_2` FOREIGN KEY (`trimester_id`) REFERENCES `trimester` (`trimester_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `question_paper_ibfk_4` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `question_paper_ibfk_5` FOREIGN KEY (`ques_type`) REFERENCES `exams` (`name`) ON UPDATE CASCADE;

--
-- Constraints for table `taken_courses`
--
ALTER TABLE `taken_courses`
  ADD CONSTRAINT `tk_cc` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tk_sid` FOREIGN KEY (`student_id`) REFERENCES `users` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
