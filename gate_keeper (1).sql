-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2025 at 04:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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

CREATE DATABASE IF NOT EXISTS `gate_keeper` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gate_keeper`;

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

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_id` int(11) NOT NULL,
  `job_reference` varchar(120) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('New','Reviewed','Accepted','Rejected') DEFAULT 'New',
  `application_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`eoi_id`, `job_reference`, `first_name`, `last_name`, `email`, `phone`, `status`, `application_date`) VALUES
(21, 'SEC01', 'Alice', 'Nguyen', 'alice.nguyen@email.com', '0401234567', 'New', '2025-10-22 09:00:00'),
(22, 'PEN02', 'Bob', 'Tran', 'bob.tran@email.com', '0412345678', 'Reviewed', '2025-10-22 09:30:00'),
(23, 'INT03', 'Charlie', 'Le', 'charlie.le@email.com', '0423456789', 'Accepted', '2025-10-22 10:00:00'),
(24, 'SEC01', 'Diana', 'Pham', 'diana.pham@email.com', '0434567890', 'Rejected', '2025-10-22 10:30:00'),
(25, 'PEN02', 'Edward', 'Vo', 'edward.vo@email.com', '0445678901', 'New', '2025-10-22 11:00:00'),
(26, 'INT03', 'Fiona', 'Do', 'fiona.do@email.com', '0456789012', 'Reviewed', '2025-10-22 11:30:00'),
(27, 'SEC01', 'George', 'Bui', 'george.bui@email.com', '0467890123', 'Accepted', '2025-10-22 12:00:00'),
(28, 'PEN02', 'Hannah', 'Hoang', 'hannah.hoang@email.com', '0478901234', 'New', '2025-10-22 12:30:00'),
(29, 'INT03', 'Ian', 'Dang', 'ian.dang@email.com', '0489012345', 'Rejected', '2025-10-22 13:00:00'),
(30, 'SEC01', 'Jenny', 'Vu', 'jenny.vu@email.com', '0490123456', 'Reviewed', '2025-10-22 13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `reference_no` varchar(20) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `reporting_to` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_reqs` text NOT NULL,
  `prefered_reqs` text NOT NULL,
  `apply_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `title`, `reference_no`, `salary`, `reporting_to`, `description`, `responsibilities`, `essential_reqs`, `prefered_reqs`, `apply_link`) VALUES
(1, 'Senior Security Analyst', 'SEC01', '$120,000 - $150,000 per year', 'Head of Security Operations', 'We\'re looking for an experienced Security Analyst to join our team, focusing on threat detection, incident response, and vulnerability management.', 'Monitor and analyze security alerts and logs.\nLead incident response efforts and forensic investigations.\nConduct vulnerability assessments and penetration testing.\nDevelop and maintain security policies and procedures.', 'Bachelor\'s degree in Computer Science, Cybersecurity, or a related field.\nMinimum of 5 years of experience in a security operations role.\nCertifications such as CISSP, CEH, or SANS GIAC are highly desirable.\nStrong analytical and problem-solving skills.\nAbility to work under pressure and respond to security incidents.\n', 'Certifications: CISSP/CEH/GIAC (or similar)\nCloud workload hardening experience\nMentoring/leadership track record', 'https://105976643.github.io/Apply-form/'),
(2, 'Junior Penetration Tester', 'PEN02', '$70,000 - $90,000 per year', 'Lead Penetration Tester', 'A great entry-level opportunity for a passionate and skilled individual to learn and grow within our dynamic Red Team.', 'Assist in conducting penetration tests on web applications, networks, and mobile platforms.\nDocument findings and prepare detailed reports for clients.\nStay up-to-date with the latest security vulnerabilities and attack vectors.\nParticipate in security research projects and team training exercises.', 'Familiarity with penetration testing methodologies and tools (e.g., Metasploit, Nmap, Burp Suite).\nBasic understanding of networking concepts and web technologies.\nRelevant certifications such as CompTIA Security+ or OSCP are a bonus.\nExcellent communication and collaboration skills.\nA proactive and inquisitive mindset.', 'Security+/eJPT/OSCP (or in progress)\nPortfolio/GitHub of labs or CTFs\nSome scripting (Python/Ruby/Bash)\n', 'https://105976643.github.io/Apply-form/'),
(3, 'Cybersecurity Intern', 'INT03', '$20 per hour', 'Cybersecurity Team Lead', 'A paid internship for students seeking hands-on experience in a fast-paced cybersecurity environment.', 'Support the security team with daily operations.\r\nAssist with log analysis and monitoring.\r\nContribute to internal security awareness training materials.\r\nResearch emerging threats and security technologies.', 'Currently enrolled in a Bachelor\'s degree program in a relevant field.\nDemonstrated interest in cybersecurity through coursework or personal projects.\nBasic knowledge of network and system security principles.\nStrong communication and teamwork skills.', 'Any lab/CTF participation\nIntro scripting or Linux skills\nAvailability during semester breaks', 'https://105976643.github.io/Apply-form/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'gatekeeper', '105697481'),
(2, 'alice_admin', 'Cyber@123'),
(3, 'bob_hunter', 'SecureMe!456'),
(4, 'charlie_ops', 'Passw0rd!'),
(5, 'diana_analyst', 'Analyst#789'),
(6, 'edward_redteam', 'RedTeam$321'),
(7, 'frank_blue', 'BlueSky!007'),
(8, 'grace_devsec', 'DevSec@2024'),
(9, 'henry_threat', 'ThreatX!999'),
(10, 'irene_ciso', 'CISO#Secure'),
(11, 'jack_pen_test', 'PenTest$888');

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

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_id`),
  ADD KEY `job_reference` (`job_reference`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `reference_no` (`reference_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eoi`
--
ALTER TABLE `eoi`
  ADD CONSTRAINT `eoi_ibfk_1` FOREIGN KEY (`job_reference`) REFERENCES `jobs` (`reference_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
