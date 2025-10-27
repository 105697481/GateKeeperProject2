-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 06:03 AM
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
  `short_name` varchar(50) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `class_time` varchar(100) NOT NULL,
  `tutor_name` varchar(100) NOT NULL,
  `project_number` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `contribution_title` varchar(150) NOT NULL,
  `contribution_details` text NOT NULL,
  `role` varchar(100) NOT NULL,
  `technologies_used` varchar(255) NOT NULL,
  `completion_date` date NOT NULL,
  `interests` varchar(255) DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `favourite_sport` varchar(100) DEFAULT NULL,
  `first_language` varchar(50) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`member_id`, `full_name`, `short_name`, `student_id`, `image_path`, `class_time`, `tutor_name`, `project_number`, `project_name`, `contribution_title`, `contribution_details`, `role`, `technologies_used`, `completion_date`, `interests`, `hometown`, `favourite_sport`, `first_language`, `skills`) VALUES
(1, 'G.P. Thishula Nimsara Punchiewa', 'Thishula', '105517068', 'images/1.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 1, 'Team Website Project', 'Jobs Page and Navigation Bar', 'Designed and developed the jobs listing page with navigation bar for better usability and structure.', 'Frontend Developer', 'HTML5, CSS3, Responsive Design', '2024-09-15', 'Programming and Gaming', 'Balangoda, Sri Lanka', 'Cricket', 'Sinhala', 'Teamwork and Leadership'),
(2, 'G.P. Thishula Nimsara Punchiewa', 'Thishula', '105517068', 'images/1.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 2, 'GateKeeper Database Project', 'Jobs Database and Backend Development', 'Developed the jobs table structure and database schema using PHP and MySQL, ensuring backend integration.', 'Backend Developer', 'PHP, MySQL, Database Design, SQL', '2025-10-19', 'Programming and Gaming', 'Balangoda, Sri Lanka', 'Cricket', 'Sinhala', 'Teamwork and Leadership'),
(3, 'W.A. Charith Jayashan', 'Charith', '105976643', 'images/3.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 1, 'Team Website Project', 'Apply Page', 'Created the job application form with validation and submission handling.', 'Form Developer', 'HTML5, CSS3, Form Validation', '2024-09-15', 'Web Developing and Gaming', 'Elpitiya, Sri Lanka', 'Cricket', 'Sinhala', 'Communication and Time Management'),
(4, 'W.A. Charith Jayashan', 'Charith', '105976643', 'images/3.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 2, 'GateKeeper Database Project', 'Application System Integration', 'Integrated the application form with the database backend to store user submissions and handle email notifications.', 'Full-stack Developer', 'PHP, MySQL, Email Integration', '2025-10-19', 'Web Developing and Gaming', 'Elpitiya, Sri Lanka', 'Cricket', 'Sinhala', 'Communication and Time Management'),
(5, 'Quoc Viet Truong', 'Viet', '105697481', 'images/2.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 1, 'Team Website Project', 'Home Page and Footer', 'Developed the main homepage layout and content structure including the responsive footer.', 'UI/UX Designer', 'HTML5, CSS3, Design Systems', '2024-09-15', 'Gaming and Programming', 'Hanoi, Vietnam', 'Soccer and Basketball', 'Vietnamese', 'Active and Leadership'),
(6, 'Quoc Viet Truong', 'Viet', '105697481', 'images/2.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 2, 'GateKeeper Database Project', 'Database Architecture and About System', 'Designed the overall database architecture and relationships between the job and EOI tables.', 'Database Architect', 'MySQL, Database Design, PHP, System Architecture', '2025-10-19', 'Gaming and Programming', 'Hanoi, Vietnam', 'Soccer and Basketball', 'Vietnamese', 'Active and Leadership'),
(7, 'Md Tasin Bin Mannan', 'Tasin', '105959217', 'images/4.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 1, 'Team Website Project', 'About Page', 'Designed and implemented the about page showcasing team members and their contributions.', 'Content Developer', 'HTML5, CSS3, Content Management', '2024-09-15', 'Watching TV/Movies and Gaming', 'Feni, Bangladesh', 'Football and Cricket', 'Bengali', 'Communication and Management'),
(8, 'Md Tasin Bin Mannan', 'Tasin', '105959217', 'images/4.jpg', '2:30–4:30 PM Wednesday', 'Razeen', 2, 'GateKeeper Database Project', 'User Interface Enhancement and Testing', 'Enhanced the user interface for better database integration and performed QA testing on the system.', 'UI Developer & QA Tester', 'PHP, CSS3, Testing Frameworks', '2025-10-19', 'Watching TV/Movies and Gaming', 'Feni, Bangladesh', 'Football and Cricket', 'Bengali', 'Communication and Management');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb_town` varchar(40) NOT NULL,
  `state` enum('VIC(Victoria)','NSW(New South Wales)','QLD(Queensland)','NT(Northern Territory)','WA(Western Australia)','SA(South Australia)','TAS(Tasmania)','ACT(Australian Capital Territory)') DEFAULT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country_code` varchar(5) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `job_reference` varchar(10) NOT NULL,
  `visa_class` enum('Citizen','Temporary visa') NOT NULL,
  `skills` varchar(255) NOT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `first_name`, `last_name`, `dob`, `gender`, `street_address`, `suburb_town`, `state`, `postcode`, `email`, `country_code`, `phone`, `job_role`, `job_reference`, `visa_class`, `skills`, `other_skills`, `status`) VALUES
(1, 'Thishula', 'Nimsara', '2004-04-22', 'male', '43/Alymer Road/Lynbrook', 'Lynbrook', 'VIC(Victoria)', '3975', 'thrishulanimsara111@gmail.com', '+61', '490741635', 'senior-security-analyst', 'SEC01', 'Temporary visa', 'Network Security, Risk Management, Web App Testing, Social Engineering, System Administration, Other Skills', 'Malware Analysis, Cloud Security', 'New'),
(2, 'Charith', 'Attanayaka', '2003-04-22', 'male', '44/Church Road/Berwick', 'Berwick', 'VIC(Victoria)', '3805', 'charith119gamage@gmail.com', '+61', '490751643', 'junior-penetration-tester', 'PEN02', 'Temporary visa', 'Risk Management, Web App Testing, Social Engineering, Ethical Hacking, Other Skills', 'Secure coding practises, Cryptography', 'New'),
(3, 'Quoec', 'Viet', '2002-07-24', 'male', '46/Subway Road/Glenferrie', 'Glenferrie', 'VIC(Victoria)', '3122', 'viettroung999@gmail.com', '+61', '490692746', 'senior-security-analyst', 'SEC01', 'Temporary visa', 'Network Security, Risk Management, Web App Testing, Social Engineering', '', 'New'),
(4, 'James', 'Anderson', '1994-09-02', 'male', '12/Lake Road/Springvale', 'Springvale', 'VIC(Victoria)', '3171', 'andrewjems@gmail.com', '+61', '490452946', 'junior-penetration-tester', 'PEN02', 'Citizen', 'Network Security, Risk Management, Web App Testing, Social Engineering, Ethical Hacking, System Administration, Other Skills', 'Linux command line skills, Secure coding practices', 'New'),
(5, 'Maxwell', 'patrol', '2003-09-25', 'male', '43/B/5 Chinatown Road/ Boxhill', 'Boxhill', 'VIC(Victoria)', '3987', 'maxwell190@gmail.com', '+61', '490876543', 'cybersecurity-intern', 'INT03', 'Citizen', 'Network Security, Risk Management, Social Engineering', '', 'New'),
(6, 'Saduni', 'Sasikala', '2000-09-25', 'female', '43/B/5 Lotus Road/ Heartwood', 'Heartwood', 'VIC(Victoria)', '3945', 'sasi69kala3@gmail.com', '+61', '490611432', 'cybersecurity-intern', 'INT03', 'Temporary visa', 'Social Engineering, Ethical Hacking', '', 'New'),
(7, 'Lasith', 'Malinga', '1990-05-21', 'male', '49/Madison Road/Union', 'Union', 'VIC(Victoria)', '3976', 'watawalapinnaya62@gmail.com', '+61', '490453987', 'cybersecurity-intern', 'INT03', 'Temporary visa', 'Web App Testing', '', 'New'),
(8, 'Yonal', 'Sandeepa', '1998-07-24', 'male', '49/Ceylon Road/Auburn', 'Auburn', 'VIC(Victoria)', '3971', 'Pinnasamantha34@gmail.com', '+61', '490423765', 'cybersecurity-intern', 'INT03', 'Temporary visa', 'Network Security, Web App Testing', 'Cloud Security', 'New'),
(9, 'kanchana', 'Anuradhi', '2001-08-24', 'female', '43/B/5 Manel Road/ Dandenong', 'Dandenong', 'VIC(Victoria)', '3978', 'badukanchana@gmail.com', '+61', '490657341', 'cybersecurity-intern', 'INT03', 'Temporary visa', 'Network Security, Risk Management, Social Engineering, Ethical Hacking', 'Could security, Database security', 'New'),
(10, 'Punchi', 'Malith', '1987-04-12', 'male', '43/B/5 Katuhena Road/ Westall', 'Westall', 'VIC(Victoria)', '3934', 'maliyapuliya@gmail.com', '+61', '490632317', 'junior-penetration-tester', 'PEN02', 'Citizen', 'Network Security, Risk Management, Social Engineering, Ethical Hacking', '', 'New'),
(11, 'Maliya', 'Puliya', '1990-03-17', 'male', '43/B/5 Katubedda Road/ Richmond', 'Richmond', 'VIC(Victoria)', '3923', 'puliyamaliya@gmail.com', '+61', '490632317', 'senior-security-analyst', 'SEC01', 'Temporary visa', 'Network Security, Risk Management, Social Engineering, Ethical Hacking', '', 'New'),
(12, 'Piyumi', 'Hansamali', '2002-02-21', 'female', '75/Temple Road/Berwick', 'Berwick', 'VIC(Victoria)', '3900', 'piyumihansamali@gmail.com', '+1', '490387423', 'cybersecurity-intern', 'INT03', 'Temporary visa', 'Network Security, Risk Management, Social Engineering, System Administration', '', 'New'),
(13, 'Madduma', 'Bandara', '2001-01-21', 'male', '45/Butteryfly Road/Westall', 'Westall', 'NSW(New South Wales)', '1990', 'maddumabandara@gmail.com', '+61', '490876121', 'senior-security-analyst', 'SEC01', 'Citizen', 'Network Security, Web App Testing, Social Engineering, Ethical Hacking', '', 'New');

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
(1, 'Senior Security Analyst', 'SEC01', '$120,000 - $150,000 per year', 'Head of Security Operations', 'We\'re looking for an experienced Security Analyst to join our team, focusing on threat detection, incident response, and vulnerability management.', 'Monitor and analyze security alerts and logs.\nLead incident response efforts and forensic investigations.\nConduct vulnerability assessments and penetration testing.\nDevelop and maintain security policies and procedures.', 'Bachelor\'s degree in Computer Science, Cybersecurity, or a related field.\nMinimum of 5 years of experience in a security operations role.\nCertifications such as CISSP, CEH, or SANS GIAC are highly desirable.\nStrong analytical and problem-solving skills.\nAbility to work under pressure and respond to security incidents.\n', 'Certifications: CISSP/CEH/GIAC (or similar)\nCloud workload hardening experience\nMentoring/leadership track record', 'apply.php'),
(2, 'Junior Penetration Tester', 'PEN02', '$70,000 - $90,000 per year', 'Lead Penetration Tester', 'A great entry-level opportunity for a passionate and skilled individual to learn and grow within our dynamic Red Team.', 'Assist in conducting penetration tests on web applications, networks, and mobile platforms.\nDocument findings and prepare detailed reports for clients.\nStay up-to-date with the latest security vulnerabilities and attack vectors.\nParticipate in security research projects and team training exercises.', 'Familiarity with penetration testing methodologies and tools (e.g., Metasploit, Nmap, Burp Suite).\nBasic understanding of networking concepts and web technologies.\nRelevant certifications such as CompTIA Security+ or OSCP are a bonus.\nExcellent communication and collaboration skills.\nA proactive and inquisitive mindset.', 'Security+/eJPT/OSCP (or in progress)\nPortfolio/GitHub of labs or CTFs\nSome scripting (Python/Ruby/Bash)\n', 'apply.php'),
(3, 'Cybersecurity Intern', 'INT03', '$20 per hour', 'Cybersecurity Team Lead', 'A paid internship for students seeking hands-on experience in a fast-paced cybersecurity environment.', 'Support the security team with daily operations.\r\nAssist with log analysis and monitoring.\r\nContribute to internal security awareness training materials.\r\nResearch emerging threats and security technologies.', 'Currently enrolled in a Bachelor\'s degree program in a relevant field.\nDemonstrated interest in cybersecurity through coursework or personal projects.\nBasic knowledge of network and system security principles.\nStrong communication and teamwork skills.', 'Any lab/CTF participation\nIntro scripting or Linux skills\nAvailability during semester breaks', 'apply.php');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Thishula', '$2y$10$g4jbsK6EFwWo9DUsdHk0RuvUlFpjR/eW9oWWm5K6c5F4T7W8ueSjm'),
(2, 'Nimsara', '$2y$10$2oWKjxf3fnNFpgH.NdmgV.fmqMIwX/hxBCbS1xwI95zkXZXOnOL1O'),
(3, 'Charith', '$2y$10$7wKjPcJLDWsZHiqeANYCze07SvmT.BQgTxbZIKp5qp/rMyTBAL2xy'),
(4, 'Viet', '$2y$10$wNa/2WAevyhhYuabXdbBM.mAXGu.0TDKHy7rJVbVHbtjnDntzUTK.'),
(5, 'Tasin', '$2y$10$nkBmS4kl8Z5lRYI/MqpigeniZMBN18j3jdFA7dEggF6Es1q9V.7jq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
