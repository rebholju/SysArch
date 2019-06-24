-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Jun 2019 um 14:19
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
  `role` int(11) NOT NULL,
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

INSERT INTO `users` (`idUsers`, `role`, `username`, `firstname`, `lastname`, `email`, `password`, `lastlogin`, `resetpassword`, `rfidID`) VALUES
(14, 10, 'rebholju', 'Julian', 'Rebholz', 'rebholju@googlemail.com', '$2y$10$GLP7r3wRuh0VRRa7Ssfsfehr0/.qmHMGGbiYy3xZAVWShI7G1SLOK', '2019-06-24 12:17:21', '', 973453),
(15, 20, 'ju721reb', 'Julian', 'Rebholz', 'rebholju@googlemail.com', '$2y$10$Gm6/GPnk2S93XPLbsTpJueXPM7JMn98HRC0IHUlfUahImKtMMROMu', '2019-06-22 16:24:22', '', 123),
(20, 20, 'HalloTest', 'asaf', 'asfasf', '1123@web.de', '$2y$10$bvgxnf5bX3ijVJbQBOStTOv1WfVqyVgLsab50O0mfIqmf01OCzkMG', '0000-00-00 00:00:00', '', 2142),
(22, 20, 'awdadad', 'sdgdsf', 'eefsdf', 'sdgsdg@wesd.de', '$2y$10$Beznih6vfY2TrQlw5NXln.gO766QVMZFAqB44TB//O4LwRoUcVvIK', '0000-00-00 00:00:00', '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vehiclecurrentdata`
--

CREATE TABLE `vehiclecurrentdata` (
  `vehicleNumber` int(11) NOT NULL,
  `sensor` tinytext NOT NULL,
  `value` varchar(20) DEFAULT NULL,
  `timeStamp` datetime DEFAULT NULL,
  `driver` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `vehiclecurrentdata`
--

INSERT INTO `vehiclecurrentdata` (`vehicleNumber`, `sensor`, `value`, `timeStamp`, `driver`) VALUES
(1, 'CPUTemp', '300', '2019-06-12 18:05:48', 'No Driver authetificated'),
(1, 'jitter', '8', '2019-06-12 18:05:48', 'No Driver authetificated'),
(1, 'numOfRTThreads', 'test', '2019-06-12 18:05:48', 'No Driver authetificated'),
(1, 'LIDAR', '190', '2019-06-12 18:05:48', 'No Driver authetificated'),
(1, 'Speed', '200', '2019-06-07 13:46:01', 'Driver'),
(1, 'BatteryPower', '11', '2019-06-12 18:05:48', 'No Driver authetificated'),
(2, 'CPUTemp', '300', '2019-06-12 18:02:52', 'ju721reb'),
(2, 'jitter', '8', '2019-06-12 18:02:52', 'ju721reb'),
(2, 'numOfRTThreads', 'test', '2019-06-12 18:02:52', 'ju721reb'),
(2, 'LIDAR', '190', '2019-06-12 18:02:52', 'ju721reb'),
(2, 'Speed', '22', '2019-06-12 18:02:52', 'ju721reb'),
(2, 'BatteryPower', '11', '2019-06-12 18:02:52', 'ju721reb'),
(1, 'temperature', '100', '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', '300', '2019-06-07 13:46:01', 'Driver'),
(1, 'temperatures', '110', '2019-06-07 13:46:01', 'Driver'),
(1, 'speeds', '220', '2019-06-07 13:46:01', 'Driver'),
(1, 'humiditys', '30', '2019-06-07 13:46:01', 'Driver');

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
(2, 'jitter', 8, '2019-06-12 17:59:53', 'rebholju'),
(2, 'numOfRTThreads', 0, '2019-06-12 17:59:53', 'rebholju'),
(2, 'LIDAR', 190, '2019-06-12 17:59:53', 'rebholju'),
(2, 'Speed', 22, '2019-06-12 17:59:53', 'rebholju'),
(2, 'BatteryPower', 11, '2019-06-12 17:59:53', 'rebholju'),
(2, 'jitter', 8, '2019-06-12 18:00:33', 'rebholju'),
(2, 'numOfRTThreads', 0, '2019-06-12 18:00:33', 'rebholju'),
(2, 'LIDAR', 190, '2019-06-12 18:00:33', 'rebholju'),
(2, 'Speed', 22, '2019-06-12 18:00:33', 'rebholju'),
(2, 'BatteryPower', 11, '2019-06-12 18:00:33', 'rebholju'),
(2, 'jitter', 8, '2019-06-12 18:01:37', 'rebholju'),
(2, 'numOfRTThreads', 0, '2019-06-12 18:01:37', 'rebholju'),
(2, 'LIDAR', 190, '2019-06-12 18:01:37', 'rebholju'),
(2, 'Speed', 22, '2019-06-12 18:01:37', 'rebholju'),
(2, 'BatteryPower', 11, '2019-06-12 18:01:37', 'rebholju'),
(2, 'jitter', 8, '2019-06-12 18:02:52', 'ju721reb'),
(2, 'numOfRTThreads', 0, '2019-06-12 18:02:52', 'ju721reb'),
(2, 'LIDAR', 190, '2019-06-12 18:02:52', 'ju721reb'),
(2, 'Speed', 22, '2019-06-12 18:02:52', 'ju721reb'),
(2, 'BatteryPower', 11, '2019-06-12 18:02:52', 'ju721reb'),
(1, 'jitter', 8, '2019-06-12 18:03:55', 'ju721reb'),
(1, 'numOfRTThreads', 0, '2019-06-12 18:03:55', 'ju721reb'),
(1, 'LIDAR', 190, '2019-06-12 18:03:56', 'ju721reb'),
(1, 'Speed', 22, '2019-06-12 18:03:56', 'ju721reb'),
(1, 'BatteryPower', 11, '2019-06-12 18:03:56', 'ju721reb'),
(1, 'jitter', 8, '2019-06-12 18:04:59', 'ju721reb'),
(1, 'numOfRTThreads', 0, '2019-06-12 18:04:59', 'ju721reb'),
(1, 'LIDAR', 190, '2019-06-12 18:04:59', 'ju721reb'),
(1, 'Speed', 22, '2019-06-12 18:04:59', 'ju721reb'),
(1, 'BatteryPower', 11, '2019-06-12 18:04:59', 'ju721reb'),
(1, 'jitter', 8, '2019-06-12 18:05:48', 'rebholju'),
(1, 'numOfRTThreads', 0, '2019-06-12 18:05:48', 'rebholju'),
(1, 'LIDAR', 190, '2019-06-12 18:05:48', 'rebholju'),
(1, 'Speed', 22, '2019-06-12 18:05:48', 'rebholju'),
(1, 'BatteryPower', 11, '2019-06-12 18:05:48', 'rebholju'),
(1, 'temperature', 27, '2019-06-07 13:46:01', 'Driver'),
(1, 'speed', 28, '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', 26, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperature', 27, '2019-06-07 13:46:01', 'Driver'),
(1, 'speed', 28, '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', 26, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperature', 27, '2019-06-07 13:46:01', 'Driver'),
(1, 'speed', 28, '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', 26, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperature', 27, '2019-06-07 13:46:01', 'Driver'),
(1, 'speed', 28, '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', 26, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperature', 27, '2019-06-07 13:46:01', 'Driver'),
(1, 'speed', 28, '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', 26, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperature', 100, '2019-06-07 13:46:01', 'Driver'),
(1, 'speed', 200, '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', 300, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperature', 100, '2019-06-07 13:46:01', 'Driver'),
(1, 'speed', 200, '2019-06-07 13:46:01', 'Driver'),
(1, 'humidity', 300, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperatures', 110, '2019-06-07 13:46:01', 'Driver'),
(1, 'speeds', 220, '2019-06-07 13:46:01', 'Driver'),
(1, 'humiditys', 30, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperatures', 110, '2019-06-07 13:46:01', 'Driver'),
(1, 'speeds', 220, '2019-06-07 13:46:01', 'Driver'),
(1, 'humiditys', 30, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperatures', 110, '2019-06-07 13:46:01', 'Driver'),
(1, 'speeds', 220, '2019-06-07 13:46:01', 'Driver'),
(1, 'humiditys', 30, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperatures', 110, '2019-06-07 13:46:01', 'Driver'),
(1, 'speeds', 220, '2019-06-07 13:46:01', 'Driver'),
(1, 'humiditys', 30, '2019-06-07 13:46:01', 'Driver'),
(1, 'temperatures', 110, '2019-06-07 13:46:01', 'Driver'),
(1, 'speeds', 220, '2019-06-07 13:46:01', 'Driver'),
(1, 'humiditys', 30, '2019-06-07 13:46:01', 'Driver');

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
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
