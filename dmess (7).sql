-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 01:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmess`
--

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary`
--

CREATE TABLE `beneficiary` (
  `bid` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `mname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `location` varchar(45) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `phone` varchar(10) NOT NULL,
  `file_name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `distype_id` int(11) NOT NULL,
  `chairperson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beneficiary`
--

INSERT INTO `beneficiary` (`bid`, `fname`, `mname`, `lname`, `dob`, `location`, `gender`, `phone`, `file_name`, `description`, `distype_id`, `chairperson_id`) VALUES
(8, 'MOANA', 'MAKE', 'WAYS', '2024-05-29', 'ARUSHA', 'female', '0986767688', 'vlc-record-2024-06-14-13h44m07s-www.1TamilMV.', 'weulsssifhbd     kh', 3, 7),
(9, 'TORI', 'VICTORIOUS', 'VEGA', '2024-05-27', 'ARUSHA', 'female', '2345456756', 'vlc-record-2024-06-14-13h38m47s-Avatar.The.Wa', 'JHDKJHNJKFCVNKJXCFNM VJKLFVN', 2, 7),
(10, 'JADE', 'BECK', 'CAT', '2024-05-30', 'ARUSHA', 'female', '76567896', 'ANORD.mp4', 'NB VBBBBBYHJJJJJJJJJJJ', 3, 7),
(11, 'JULIE', 'AND', 'PHANTHOMS', '2024-06-14', 'ARUSHA', 'female', '9087898767', 'MOANA.mp4', 'SHE CAN SING', 7, 7),
(13, 'KEKE', 'THE', 'PALMER', '2024-05-29', 'DODO', 'female', '0986767688', 'yt5s.io-As We Gather .mp4', 'NKHUDFGNVFJIGLKDLM', 1, 8),
(15, 'JULIE', 'AND', 'MIKE', '2024-05-28', 'ARUSHA', 'female', '9098765432', 'yt5s.io-As We Gather .mp4', 'hhhhuitttttttttt', 4, 7),
(16, 'TATIANA', 'MANAOIS', 'LIKE', '2016-02-03', 'ARUSHA', 'female', '6573654546', 'yt5s.io-Gethsemane ~ Claire Ryan ~ lyric vide', 'NO LEGS', 1, 7),
(18, 'Nairobi', 'TOKYO', 'Berlin', '2024-05-31', 'DODOMA', 'male', '5467654356', 'MOANA.mp4', 'rtedtygf', 1, 8),
(19, 'OSLO', 'BERLIN', 'PROFESSOR', '2024-07-01', 'DAR ES SALAAM', 'male', '0764565456', 'ANORD.mp4', 'A MOVIE to watch money heist', 4, 10),
(20, 'TRISS', 'THOBIAS', 'MOVIE', '2024-07-01', 'MWANZA', 'female', '9087898765', 'yt5s.io-Moses Bliss - BIGGER EVERYDAY(Live) x', 'ACTRESS on a movie', 4, 11),
(22, 'AKSHAY', 'KHAN', 'KUMAR', '2024-07-05', 'KILIMANJARO', 'male', '7678987890', 'yt5s.io-As We Gather .mp4', 'CANCER', 3, 12),
(25, 'SHA', 'RHUK', 'KHAN', '2024-07-03', 'KILIMANJARO', 'female', '9876543456', 'yt5s.io-As We Gather .mp4', 'regulator', 1, 12),
(29, 'MRISHO', 'MPOTO', 'MRISHO', '2024-07-01', 'KILIMANJARO', 'male', '0989876767', 'yt5s.io-As We Gather .mp4', 'RESERTYUHFVVB', 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `chairperson`
--

CREATE TABLE `chairperson` (
  `chairperson_id` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `mname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `dob` date NOT NULL,
  `location` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `idkey` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chairperson`
--

INSERT INTO `chairperson` (`chairperson_id`, `fname`, `mname`, `lname`, `gender`, `dob`, `location`, `phone`, `email`, `password`, `idkey`) VALUES
(7, 'KEV', 'BARAKA', 'SOSPETER', 'male', '2024-05-28', 'ARUSHA', '0789878712', 'kev@gmail.com', 'kev123', 'ARU01'),
(8, 'JOSEPHINE', 'INNOCENT', 'JOHN', 'female', '2024-05-31', 'DODOMA', '0786545678', 'jose@gmail.com', 'jose123', 'DOD03'),
(10, 'IRENE', 'MAFURU', 'MAGESA', 'female', '2024-05-28', 'DAR ES SALAAM', '0754646464', 'irene@gmail.com', 'irene123', 'DAR02'),
(11, 'ALI', 'KIBA', 'MUSIC', 'male', '2024-07-01', 'MWANZA', '0798869876', 'ali@gmail.com', 'ali123', 'MWA12'),
(12, 'CELEBY', 'CAREEN', 'GEOR', 'male', '2024-07-02', 'KILIMANJARO', '89009890876', 'cel@gmail.com', 'cel123', 'KIL04'),
(13, 'JOHN', 'MARCEL', 'MTENGA', 'male', '2024-07-02', 'GEITA', '7678765678', 'john@gmail.com', 'john123', 'GEI06');

-- --------------------------------------------------------

--
-- Table structure for table `chair_idkey`
--

CREATE TABLE `chair_idkey` (
  `idkey` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chair_idkey`
--

INSERT INTO `chair_idkey` (`idkey`) VALUES
('ARU01'),
('DAR02'),
('DOD03'),
('GEI06'),
('KIG05'),
('KIL04'),
('MWA12');

-- --------------------------------------------------------

--
-- Table structure for table `distype`
--

CREATE TABLE `distype` (
  `distype_id` int(11) NOT NULL,
  `disname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distype`
--

INSERT INTO `distype` (`distype_id`, `disname`) VALUES
(1, 'Mobility ipairments'),
(2, 'Amputation'),
(3, 'visual impairment'),
(4, 'hearing imparement'),
(7, 'speech imparement');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `did` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `mdonation` text DEFAULT NULL,
  `date` date NOT NULL,
  `bid` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`did`, `amount`, `mdonation`, `date`, `bid`, `donor_id`) VALUES
(2, NULL, 'jjoiy89', '2024-06-19', 8, 8),
(3, 10000.00, NULL, '2024-06-19', 8, 8),
(4, NULL, 'ljhgvuggt', '2024-06-19', 10, 8),
(5, 20000.00, 'SPEECH APP', '2024-06-20', 9, 9),
(6, 40000.00, NULL, '2024-06-20', 11, 9),
(9, 10000.00, 'clothes', '2024-07-11', 22, 10),
(10, 10000.00, 'clothes', '2024-07-11', 25, 10),
(11, 20000.00, NULL, '2024-07-11', 15, 9),
(12, NULL, 'kikombe', '2024-07-11', 13, 10),
(13, NULL, 'WHEELCHAIR', '2024-07-13', 13, 8);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `donor_id` int(11) NOT NULL,
  `f_name` varchar(45) NOT NULL,
  `l_name` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `e_mail` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`donor_id`, `f_name`, `l_name`, `phone`, `e_mail`, `password`) VALUES
(8, 'Evensiaa', 'innocent', '0700000000', 'eve@gmail.com', 'eve123'),
(9, 'Noel', 'Kelvin', '0754565657', 'noel@gmail.com', 'noel123'),
(10, 'INNOCENT', 'MTENGA', '0987898765', 'inno@gmail.com', 'inno123');

-- --------------------------------------------------------

--
-- Table structure for table `pending_donations`
--

CREATE TABLE `pending_donations` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `mdonation` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `story_id` int(11) NOT NULL,
  `dec1` varchar(250) NOT NULL,
  `dec2` varchar(250) NOT NULL,
  `file_name1` varchar(45) NOT NULL,
  `file_name2` varchar(45) NOT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`story_id`, `dec1`, `dec2`, `file_name1`, `file_name2`, `bid`) VALUES
(2, 'RESERTYUHFVVB', '', 'yt5s.io-As We Gather .mp4', '', 29);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'eve@gmail.com', 'eve123', 'donor'),
(2, 'eve@gmail.com', 'eve123', 'donor'),
(3, 'irene@gmail.com', 'irene123', 'chairperson'),
(4, 'noel@gmail.com', 'noel123', 'donor'),
(5, 'ali@gmail.com', 'ali123', 'chairperson'),
(6, 'inno@gmail.com', 'inno123', 'donor'),
(7, 'cel@gmail.com', 'cel123', 'chairperson'),
(8, 'john@gmail.com', 'john123', 'chairperson');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `distype_id` (`distype_id`),
  ADD KEY `chairperson_id` (`chairperson_id`);

--
-- Indexes for table `chairperson`
--
ALTER TABLE `chairperson`
  ADD PRIMARY KEY (`chairperson_id`),
  ADD KEY `idkey` (`idkey`);

--
-- Indexes for table `chair_idkey`
--
ALTER TABLE `chair_idkey`
  ADD PRIMARY KEY (`idkey`);

--
-- Indexes for table `distype`
--
ALTER TABLE `distype`
  ADD PRIMARY KEY (`distype_id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`did`),
  ADD KEY `bid` (`bid`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `pending_donations`
--
ALTER TABLE `pending_donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`story_id`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beneficiary`
--
ALTER TABLE `beneficiary`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `chairperson`
--
ALTER TABLE `chairperson`
  MODIFY `chairperson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `distype`
--
ALTER TABLE `distype`
  MODIFY `distype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pending_donations`
--
ALTER TABLE `pending_donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `story_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD CONSTRAINT `beneficiary_ibfk_1` FOREIGN KEY (`distype_id`) REFERENCES `distype` (`distype_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `beneficiary_ibfk_2` FOREIGN KEY (`chairperson_id`) REFERENCES `chairperson` (`chairperson_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chairperson`
--
ALTER TABLE `chairperson`
  ADD CONSTRAINT `chairperson_ibfk_1` FOREIGN KEY (`idkey`) REFERENCES `chair_idkey` (`idkey`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `beneficiary` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_ibfk_2` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `beneficiary` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
