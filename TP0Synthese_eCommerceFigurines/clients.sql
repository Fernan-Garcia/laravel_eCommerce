-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 23, 2026 at 05:39 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4d6_h26_tp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `figurines`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL UNIQUE,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `codePostal` varchar(20) NOT NULL,
  `province` varchar(2) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--
-- ChatGPT à generé les données

INSERT INTO `clients`
(`id`, `email`, `nom`, `prenom`, `password`, `adresse`, `ville`, `codePostal`, `province`, `telephone`)
VALUES
(1, 'john.doe@email.com', 'Doe', 'John', 'password123', '123 Rue Sainte-Catherine', 'Montréal', 'H2X 1Y4', 'QC', '514-555-1234'),
(2, 'jane.smith@email.com', 'Smith', 'Jane', 'password123', '456 Avenue du Parc', 'Montréal', 'H2V 4G7', 'QC', '514-555-5678'),
(3, 'mike.johnson@email.com', 'Johnson', 'Mike', 'password123', '789 Boulevard Saint-Laurent', 'Montréal', 'H2Y 2Y5', 'QC', '514-555-9012'),
(4, 'emily.davis@email.com', 'Davis', 'Emily', 'password123', '321 Rue Sherbrooke O', 'Montréal', 'H3A 1B2', 'QC', '514-555-3456'),
(5, 'alex.brown@email.com', 'Brown', 'Alex', 'password123', '654 Rue Jean-Talon E', 'Montréal', 'H2R 1S7', 'QC', '514-555-7890'),
(6, 'admin@email.com', 'Admin', 'Admin', 'password', 'Admin Address', 'Admin', 'H2R 1S7', 'QC', '514-555-7890');


