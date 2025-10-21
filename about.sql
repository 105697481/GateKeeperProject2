-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2025 at 01:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gate_keeper`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `member_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `project_number` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `contribution_title` varchar(100) NOT NULL,
  `contribution_details` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `technologies_used` text DEFAULT NULL,
  `completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`member_id`, `full_name`, `student_id`, `project_number`, `project_name`, `contribution_title`, `contribution_details`, `role`, `technologies_used`, `completion_date`) VALUES
(1, 'G.P. Thishula Nimsara Punchiewa', '105517068', 1, 'Team Website Project', 'Jobs Page and Navigation Bar', 'Designed and developed the jobs listing page with responsive design. Created the main navigation bar structure and implemented interactive elements for job browsing.', 'Frontend Developer', 'HTML5, CSS3, Responsive Design', '2024-09-15'),
(1, 'G.P. Thishula Nimsara Punchiewa', '105517068', 2, 'GateKeeper Database Project', 'Jobs Database and Backend Development', 'Developed the jobs table structure and database schema. Implemented PHP backend for job listings management.', 'Backend Developer', 'PHP, MySQL, Database Design, SQL', '2025-10-19'),
(2, 'W.A. Charith Jayashan', '105976643', 1, 'Team Website Project', 'Apply Page', 'Created the job application form with validation. Implemented form handling, user input validation, and error messaging.', 'Form Developer', 'HTML5, CSS3, Form Validation', '2024-09-15'),
(2, 'W.A. Charith Jayashan', '105976643', 2, 'GateKeeper Database Project', 'Application System Integration', 'Integrated the application form with database backend. Implemented form data processing and storage.', 'Full-stack Developer', 'PHP, MySQL, Email Integration', '2025-10-19'),
(3, 'Quoc Viet Truong', '105697481', 1, 'Team Website Project', 'Home Page and Footer', 'Developed the main homepage layout and content structure. Created the website footer with contact information and social media links.', 'UI/UX Designer', 'HTML5, CSS3, Design Systems', '2024-09-15'),
(3, 'Quoc Viet Truong', '105697481', 2, 'GateKeeper Database Project', 'Database Architecture and About System', 'Designed the overall database architecture and relationships. Implemented the about table and member contribution system.', 'Database Architect', 'MySQL, Database Design, PHP, System Architecture', '2025-10-19'),
(4, 'MD Tasin Bin Mannan', '105959217', 1, 'Team Website Project', 'About Page', 'Designed and implemented the about us page showcasing team information. Created team member profiles, contribution sections, and company information display.', 'Content Developer', 'HTML5, CSS3, Content Management', '2024-09-15'),
(4, 'MD Tasin Bin Mannan', '105959217', 2, 'GateKeeper Database Project', 'User Interface Enhancement and Testing', 'Enhanced the user interface for better database interaction. Implemented dynamic content rendering and improved user experience.', 'UI Developer & QA Tester', 'PHP, CSS3, Testing Frameworks', '2025-10-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`member_id`,`project_number`),
  ADD KEY `idx_student_id` (`student_id`),
  ADD KEY `idx_project_number` (`project_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
