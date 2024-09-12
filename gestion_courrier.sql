-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 01:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_courrier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `admin` (`email`, `name`, `password`, `created_at`, `updated_at`)
VALUES ('admin@gmail.com', 'Admin', '$2y$10$GQqheqSmGW1ioRKQM0vsbuRHp4A0uJVtvQlYl68PFRrijPrU.s69y', NOW(), NOW());


-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id_agent` int(11) NOT NULL AUTO_INCREMENT,
  `nom_agent` varchar(100) NOT NULL,
  `prenom_agent` varchar(100) NOT NULL,
  `email_agent` varchar(100) NOT NULL,
  `tel_agent` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logical_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_agent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `fullname` varchar(100) NOT NULL,
  `phoneno` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `cdate` varchar(30) NOT NULL,
  `approval` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courrier`
--

CREATE TABLE `courrier` (
  `id_courrier` int(11) NOT NULL AUTO_INCREMENT,
  `file_cour` varchar(255) NOT NULL,
  `titre_cour` varchar(255) NOT NULL,
  `logical_delete` tinyint(1) NOT NULL DEFAULT 0,
  `archiver` tinyint(1) DEFAULT NULL,  -- Nullable boolean for archiving status
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_courrier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courrier_agent`
--

CREATE TABLE `courrier_agent` (
  `id_cour_ag` int(11) NOT NULL AUTO_INCREMENT,
  `id_cour` int(11) NOT NULL,  -- This references the id_courrier column in the courrier table
  `id_ag_destinataire` int(11) NOT NULL,  -- This references the id_agent column in the agent table
  `id_envoyeur` int(11) NULL,  -- Can be either the ID of an agent or an admin
  `envoyeur_type` ENUM('admin', 'agent') NOT NULL,  -- Type of sender: admin or agent
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_cour_ag`),
  FOREIGN KEY (`id_cour`) REFERENCES `courrier`(`id_courrier`) ON DELETE CASCADE,  -- Correct foreign key
  FOREIGN KEY (`id_ag_destinataire`) REFERENCES `agent`(`id_agent`) ON DELETE CASCADE  -- Correct foreign key
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id_not` int(11) NOT NULL AUTO_INCREMENT,
  `id_cour` int(11) DEFAULT NULL,
  `id_agent` int(11) NOT NULL,
  `contenu_not` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `close_not` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_not`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id_agent`);

--
-- Indexes for table `courrier`
--
ALTER TABLE `courrier`
  ADD PRIMARY KEY (`id_courrier`);

--
-- Indexes for table `courrier_agent`
--
ALTER TABLE `courrier_agent`
  ADD PRIMARY KEY (`id_cour_ag`),
  ADD KEY `id_cour` (`id_cour`),
  ADD KEY `id_ag` (`id_ag`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_not`),
  ADD KEY `id_cour` (`id_cour`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courrier`
--
ALTER TABLE `courrier`
  MODIFY `id_courrier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courrier_agent`
--
ALTER TABLE `courrier_agent`
  MODIFY `id_cour_ag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_not` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courrier_agent`
--
ALTER TABLE `courrier_agent`
  ADD CONSTRAINT `courrier_agent_ibfk_1` FOREIGN KEY (`id_cour`) REFERENCES `courrier` (`id_courrier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courrier_agent_ibfk_2` FOREIGN KEY (`id_ag`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courrier_agent_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_cour`) REFERENCES `courrier` (`id_courrier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
