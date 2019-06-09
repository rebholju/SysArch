-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Jun 2019 um 10:17
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `sysarch`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `firstname` tinytext NOT NULL,
  `lastname` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL,
  `lastlogin` datetime NOT NULL,
  `resetpassword` longtext NOT NULL,
  `rfidID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`idUsers`, `username`, `firstname`, `lastname`, `email`, `password`, `lastlogin`, `resetpassword`, `rfidID`) VALUES
(14, 'rebholju', 'Julian', 'Rebholz', 'rebholju@googlemail.com', '$2y$10$GLP7r3wRuh0VRRa7Ssfsfehr0/.qmHMGGbiYy3xZAVWShI7G1SLOK', '2019-06-06 17:30:43', '', 12345),
(15, 'ju721reb', 'Julian', 'Rebholz', 'rebholju@googlemail.com', '$2y$10$d/l5q2XIHP1CsMkDxdslJOpPiTUZg262xavYqME1G9sR.UYM75oqW', '2019-06-03 09:19:00', '', 0),
(16, 'test', 'Julian', 'sagfa', 'rebholju@googlemail.com', '$2y$10$pxUTNCxCvLyukqVj7Fqwme4c6yGkRQkNtrNZdlj6BFQlakVxbIGoy', '0000-00-00 00:00:00', '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vehiclecurrentdata`
--

CREATE TABLE `vehiclecurrentdata` (
  `vehicleNumber` int(11) NOT NULL,
  `sensor` tinytext NOT NULL,
  `value` varchar(20) NOT NULL,
  `timeStamp` datetime NOT NULL,
  `driver` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `vehiclecurrentdata`
--

INSERT INTO `vehiclecurrentdata` (`vehicleNumber`, `sensor`, `value`, `timeStamp`, `driver`) VALUES
(1, 'CPUTemp', '12', '2019-06-08 17:00:12', 'rebholju'),
(1, 'jitter', '8', '2019-06-08 17:00:12', 'rebholju'),
(1, 'numOfRTThreads', 'eins', '2019-06-08 17:00:12', 'rebholju'),
(1, 'LIDAR', '190', '2019-06-08 17:00:12', 'rebholju'),
(1, 'Speed', '22', '2019-06-08 17:00:12', 'rebholju'),
(1, 'BatteryPower', '11', '2019-06-08 17:00:12', 'rebholju');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vehiclehistoricaldata`
--

CREATE TABLE `vehiclehistoricaldata` (
  `vehicleNumber` int(11) NOT NULL,
  `sensor` tinytext NOT NULL,
  `value` float NOT NULL,
  `timeStamp` datetime NOT NULL,
  `driver` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `vehiclehistoricaldata`
--

INSERT INTO `vehiclehistoricaldata` (`vehicleNumber`, `sensor`, `value`, `timeStamp`, `driver`) VALUES
(1, 'CPUTemp', 12, '2019-06-08 17:00:09', 'rebholju'),
(1, 'jitter', 8, '2019-06-08 17:00:09', 'rebholju'),
(1, 'numOfRTThreads', 0, '2019-06-08 17:00:09', 'rebholju'),
(1, 'LIDAR', 190, '2019-06-08 17:00:09', 'rebholju'),
(1, 'Speed', 22, '2019-06-08 17:00:09', 'rebholju'),
(1, 'BatteryPower', 11, '2019-06-08 17:00:09', 'rebholju'),
(1, 'CPUTemp', 12, '2019-06-08 17:00:12', 'rebholju'),
(1, 'jitter', 8, '2019-06-08 17:00:12', 'rebholju'),
(1, 'numOfRTThreads', 0, '2019-06-08 17:00:12', 'rebholju'),
(1, 'LIDAR', 190, '2019-06-08 17:00:12', 'rebholju'),
(1, 'Speed', 22, '2019-06-08 17:00:12', 'rebholju'),
(1, 'BatteryPower', 11, '2019-06-08 17:00:12', 'rebholju');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
