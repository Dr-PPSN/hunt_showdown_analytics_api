-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Jan 2024 um 23:15
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hsa_api`
--
CREATE DATABASE IF NOT EXISTS `hsa_api` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hsa_api`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_log`
--

CREATE TABLE `user_log` (
  `ip` bigint(20) UNSIGNED NOT NULL,
  `os` varchar(32) NOT NULL,
  `device` varchar(32) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `weather_log`
--

CREATE TABLE `weather_log` (
  `weather` varchar(16) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `weather_log`
--

INSERT INTO `weather_log` (`weather`, `counter`) VALUES
('event', 0),
('gold', 0),
('mondnacht', 0),
('nacht', 0),
('nebel', 0),
('regen', 0),
('sonnenaufgang', 0),
('sonnenuntergang', 0),
('wolkenlos', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `user_log`
--
ALTER TABLE `user_log`
  ADD UNIQUE KEY `ip` (`ip`);

--
-- Indizes für die Tabelle `weather_log`
--
ALTER TABLE `weather_log`
  ADD PRIMARY KEY (`weather`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
