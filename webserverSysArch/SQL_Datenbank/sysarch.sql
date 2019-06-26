-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Jun 2019 um 14:11
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
(14, 10, 'rebholju', 'Julian', 'Rebholz', 'rebholju@googlemail.com', '$2y$10$GLP7r3wRuh0VRRa7Ssfsfehr0/.qmHMGGbiYy3xZAVWShI7G1SLOK', '2019-06-25 19:57:13', '', 973453),
(15, 20, 'ju721reb', 'Julian', 'Rebholz', 'rebholju@googlemail.com', '$2y$10$Gm6/GPnk2S93XPLbsTpJueXPM7JMn98HRC0IHUlfUahImKtMMROMu', '2019-06-25 15:24:46', '', 123),
(20, 20, 'HalloTest', 'asaf', 'asfasf', '1123@web.de', '$2y$10$bvgxnf5bX3ijVJbQBOStTOv1WfVqyVgLsab50O0mfIqmf01OCzkMG', '0000-00-00 00:00:00', '', 2142),
(22, 20, 'awdadad', 'sdgdsf', 'eefsdf', 'sdgsdg@wesd.de', '$2y$10$Beznih6vfY2TrQlw5NXln.gO766QVMZFAqB44TB//O4LwRoUcVvIK', '0000-00-00 00:00:00', '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vehiclecurrentdata`
--

CREATE TABLE `vehiclecurrentdata` (
  `id` int(11) NOT NULL,
  `vehicleNumber` int(11) NOT NULL,
  `sensor` tinytext NOT NULL,
  `value` varchar(20) DEFAULT NULL,
  `unit` tinytext NOT NULL,
  `timeStamp` datetime DEFAULT NULL,
  `driver` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `vehiclecurrentdata`
--

INSERT INTO `vehiclecurrentdata` (`id`, `vehicleNumber`, `sensor`, `value`, `unit`, `timeStamp`, `driver`) VALUES
(1, 1, 'CPUTemp', '300', '', '2019-06-12 18:05:48', 'No Driver authetificated'),
(2, 1, 'jitter', '8', '', '2019-06-12 18:05:48', 'No Driver authetificated'),
(3, 1, 'numOfRTThreads', 'test', '', '2019-06-12 18:05:48', 'No Driver authetificated'),
(4, 1, 'LIDAR', '190', '', '2019-06-12 18:05:48', 'No Driver authetificated'),
(5, 1, 'Speed', '0', 'km/h', '1111-11-11 11:11:11', 'Driver'),
(6, 1, 'BatteryPower', '11', '', '2019-06-12 18:05:48', 'No Driver authetificated'),
(7, 2, 'CPUTemp', '300', '', '2019-06-12 18:02:52', 'ju721reb'),
(8, 2, 'jitter', '8', '', '2019-06-12 18:02:52', 'ju721reb'),
(9, 2, 'numOfRTThreads', 'test', '', '2019-06-12 18:02:52', 'ju721reb'),
(10, 2, 'LIDAR', '190', '', '2019-06-12 18:02:52', 'ju721reb'),
(11, 2, 'Speed', '22', 'km/h', '2019-06-12 18:02:52', 'ju721reb'),
(12, 2, 'BatteryPower', '11', '', '2019-06-12 18:02:52', 'ju721reb'),
(13, 1, 'temperature', '0', 'Degree', '1111-11-11 11:11:11', 'Driver'),
(14, 1, 'humidity', '0', '', '1111-11-11 11:11:11', 'Driver'),
(15, 1, 'temperatures', '110', 'Degree', '2019-06-07 13:46:01', 'Driver'),
(16, 1, 'speeds', '220', 'km/h', '2019-06-07 13:46:01', 'Driver'),
(17, 1, 'humiditys', '30', '', '2019-06-07 13:46:01', 'Driver'),
(18, 1, 'test', '110', '', '2019-06-07 13:46:01', 'test4'),
(19, 1, 'test2', '220', '', '2019-06-07 13:46:01', 'test4'),
(20, 1, 'test3', '30', '', '2019-06-07 13:46:01', 'test4'),
(21, 1, 'LidarDistances', '0', '', '1111-11-11 11:11:11', 'Driver');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vehiclehistoricaldata`
--

CREATE TABLE `vehiclehistoricaldata` (
  `id` int(11) NOT NULL,
  `vehicleNumber` int(11) NOT NULL,
  `sensor` tinytext NOT NULL,
  `value` float NOT NULL,
  `unit` tinytext NOT NULL,
  `timeStamp` datetime NOT NULL,
  `driver` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `vehiclehistoricaldata`
--

INSERT INTO `vehiclehistoricaldata` (`id`, `vehicleNumber`, `sensor`, `value`, `unit`, `timeStamp`, `driver`) VALUES
(1, 2, 'jitter', 8, '', '2019-06-12 17:59:53', 'rebholju'),
(2, 2, 'numOfRTThreads', 0, '', '2019-06-12 17:59:53', 'rebholju'),
(3, 2, 'LIDAR', 190, '', '2019-06-12 17:59:53', 'rebholju'),
(4, 2, 'Speed', 22, '', '2019-06-12 17:59:53', 'rebholju'),
(5, 2, 'BatteryPower', 11, '', '2019-06-12 17:59:53', 'rebholju'),
(6, 2, 'jitter', 8, '', '2019-06-12 18:00:33', 'rebholju'),
(7, 2, 'numOfRTThreads', 0, '', '2019-06-12 18:00:33', 'rebholju'),
(8, 2, 'LIDAR', 190, '', '2019-06-12 18:00:33', 'rebholju'),
(9, 2, 'Speed', 22, '', '2019-06-12 18:00:33', 'rebholju'),
(10, 2, 'BatteryPower', 11, '', '2019-06-12 18:00:33', 'rebholju'),
(11, 2, 'jitter', 8, '', '2019-06-12 18:01:37', 'rebholju'),
(12, 2, 'numOfRTThreads', 0, '', '2019-06-12 18:01:37', 'rebholju'),
(13, 2, 'LIDAR', 190, '', '2019-06-12 18:01:37', 'rebholju'),
(14, 2, 'Speed', 22, '', '2019-06-12 18:01:37', 'rebholju'),
(15, 2, 'BatteryPower', 11, '', '2019-06-12 18:01:37', 'rebholju'),
(16, 2, 'jitter', 8, '', '2019-06-12 18:02:52', 'ju721reb'),
(17, 2, 'numOfRTThreads', 0, '', '2019-06-12 18:02:52', 'ju721reb'),
(18, 2, 'LIDAR', 190, '', '2019-06-12 18:02:52', 'ju721reb'),
(19, 2, 'Speed', 22, '', '2019-06-12 18:02:52', 'ju721reb'),
(20, 2, 'BatteryPower', 11, '', '2019-06-12 18:02:52', 'ju721reb'),
(21, 1, 'jitter', 8, '', '2019-06-12 18:03:55', 'ju721reb'),
(22, 1, 'numOfRTThreads', 0, '', '2019-06-12 18:03:55', 'ju721reb'),
(23, 1, 'LIDAR', 190, '', '2019-06-12 18:03:56', 'ju721reb'),
(24, 1, 'Speed', 22, '', '2019-06-12 18:03:56', 'ju721reb'),
(25, 1, 'BatteryPower', 11, '', '2019-06-12 18:03:56', 'ju721reb'),
(26, 1, 'jitter', 8, '', '2019-06-12 18:04:59', 'ju721reb'),
(27, 1, 'numOfRTThreads', 0, '', '2019-06-12 18:04:59', 'ju721reb'),
(28, 1, 'LIDAR', 190, '', '2019-06-12 18:04:59', 'ju721reb'),
(29, 1, 'Speed', 22, '', '2019-06-12 18:04:59', 'ju721reb'),
(30, 1, 'BatteryPower', 11, '', '2019-06-12 18:04:59', 'ju721reb'),
(31, 1, 'jitter', 8, '', '2019-06-12 18:05:48', 'rebholju'),
(32, 1, 'numOfRTThreads', 0, '', '2019-06-12 18:05:48', 'rebholju'),
(33, 1, 'LIDAR', 190, '', '2019-06-12 18:05:48', 'rebholju'),
(34, 1, 'Speed', 22, '', '2019-06-12 18:05:48', 'rebholju'),
(35, 1, 'BatteryPower', 11, '', '2019-06-12 18:05:48', 'rebholju'),
(36, 1, 'temperature', 27, '', '2019-06-07 13:46:01', 'Driver'),
(37, 1, 'speed', 28, '', '2019-06-07 13:46:01', 'Driver'),
(38, 1, 'humidity', 26, '', '2019-06-07 13:46:01', 'Driver'),
(39, 1, 'temperature', 27, '', '2019-06-07 13:46:01', 'Driver'),
(40, 1, 'speed', 28, '', '2019-06-07 13:46:01', 'Driver'),
(41, 1, 'humidity', 26, '', '2019-06-07 13:46:01', 'Driver'),
(42, 1, 'temperature', 27, '', '2019-06-07 13:46:01', 'Driver'),
(43, 1, 'speed', 28, '', '2019-06-07 13:46:01', 'Driver'),
(44, 1, 'humidity', 26, '', '2019-06-07 13:46:01', 'Driver'),
(45, 1, 'temperature', 27, '', '2019-06-07 13:46:01', 'Driver'),
(46, 1, 'speed', 28, '', '2019-06-07 13:46:01', 'Driver'),
(47, 1, 'humidity', 26, '', '2019-06-07 13:46:01', 'Driver'),
(48, 1, 'temperature', 27, '', '2019-06-07 13:46:01', 'Driver'),
(49, 1, 'speed', 28, '', '2019-06-07 13:46:01', 'Driver'),
(50, 1, 'humidity', 26, '', '2019-06-07 13:46:01', 'Driver'),
(51, 1, 'temperature', 100, '', '2019-06-07 13:46:01', 'Driver'),
(52, 1, 'speed', 200, '', '2019-06-07 13:46:01', 'Driver'),
(53, 1, 'humidity', 300, '', '2019-06-07 13:46:01', 'Driver'),
(54, 1, 'temperature', 100, '', '2019-06-07 13:46:01', 'Driver'),
(55, 1, 'speed', 200, '', '2019-06-07 13:46:01', 'Driver'),
(56, 1, 'humidity', 300, '', '2019-06-07 13:46:01', 'Driver'),
(57, 1, 'temperatures', 110, '', '2019-06-07 13:46:01', 'Driver'),
(58, 1, 'speeds', 220, '', '2019-06-07 13:46:01', 'Driver'),
(59, 1, 'humiditys', 30, '', '2019-06-07 13:46:01', 'Driver'),
(60, 1, 'temperatures', 110, '', '2019-06-07 13:46:01', 'Driver'),
(61, 1, 'speeds', 220, '', '2019-06-07 13:46:01', 'Driver'),
(62, 1, 'humiditys', 30, '', '2019-06-07 13:46:01', 'Driver'),
(63, 1, 'temperatures', 110, '', '2019-06-07 13:46:01', 'Driver'),
(64, 1, 'speeds', 220, '', '2019-06-07 13:46:01', 'Driver'),
(65, 1, 'humiditys', 30, '', '2019-06-07 13:46:01', 'Driver'),
(66, 1, 'temperatures', 110, '', '2019-06-07 13:46:01', 'Driver'),
(67, 1, 'speeds', 220, '', '2019-06-07 13:46:01', 'Driver'),
(68, 1, 'humiditys', 30, '', '2019-06-07 13:46:01', 'Driver'),
(69, 1, 'temperatures', 110, '', '2019-06-07 13:46:01', 'Driver'),
(70, 1, 'speeds', 220, '', '2019-06-07 13:46:01', 'Driver'),
(71, 1, 'humiditys', 30, '', '2019-06-07 13:46:01', 'Driver'),
(72, 1, 'test', 110, '', '2019-06-07 13:46:01', 'test4'),
(73, 1, 'test', 110, '', '2019-06-07 13:46:01', 'test4'),
(74, 1, 'test2', 220, '', '2019-06-07 13:46:01', 'test4'),
(75, 1, 'test3', 30, '', '2019-06-07 13:46:01', 'test4'),
(76, 1, 'test', 110, '', '2019-06-07 13:46:01', 'test4'),
(77, 1, 'test2', 220, '', '2019-06-07 13:46:01', 'test4'),
(78, 1, 'test3', 30, '', '2019-06-07 13:46:01', 'test4'),
(79, 1, 'Temperature', 0, '', '2019-06-24 00:51:55', 'Driver'),
(80, 1, 'Humidity', 0, '', '2019-06-24 00:51:55', 'Driver'),
(81, 1, 'Speed', 0, '', '2019-06-24 00:51:55', 'Driver'),
(82, 1, 'LidarDistances', 0, '', '2019-06-24 00:51:55', 'Driver'),
(83, 1, 'Temperature', 0, '', '2019-11-11 11:11:11', 'Driver'),
(84, 1, 'Humidity', 0, '', '2019-11-11 11:11:11', 'Driver'),
(85, 1, 'Speed', 0, '', '2019-11-11 11:11:11', 'Driver'),
(86, 1, 'LidarDistances', 0, '', '2019-11-11 11:11:11', 'Driver'),
(87, 1, 'Temperature', 0, '', '2019-11-11 11:11:11', 'Driver'),
(88, 1, 'Humidity', 0, '', '2019-11-11 11:11:11', 'Driver'),
(89, 1, 'Speed', 0, '', '2019-11-11 11:11:11', 'Driver'),
(90, 1, 'LidarDistances', 0, '', '2019-11-11 11:11:11', 'Driver'),
(91, 1, 'Temperature', 0, '', '2019-11-11 11:11:11', 'Driver'),
(92, 1, 'Humidity', 0, '', '2019-11-11 11:11:11', 'Driver'),
(93, 1, 'Speed', 0, '', '2019-11-11 11:11:11', 'Driver'),
(94, 1, 'LidarDistances', 0, '', '2019-11-11 11:11:11', 'Driver'),
(95, 1, 'Temperature', 0, '', '1111-11-11 11:11:11', 'Driver'),
(96, 1, 'Humidity', 0, '', '1111-11-11 11:11:11', 'Driver'),
(97, 1, 'Speed', 0, '', '1111-11-11 11:11:11', 'Driver'),
(98, 1, 'LidarDistances', 0, '', '1111-11-11 11:11:11', 'Driver'),
(99, 1, 'Temperature', 0, '', '1111-11-11 11:11:11', 'Driver'),
(100, 1, 'Humidity', 0, '', '1111-11-11 11:11:11', 'Driver'),
(101, 1, 'Speed', 0, '', '1111-11-11 11:11:11', 'Driver'),
(102, 1, 'LidarDistances', 0, '', '1111-11-11 11:11:11', 'Driver'),
(103, 1, 'Temperature', 0, '', '1111-11-11 11:11:11', 'Driver'),
(104, 1, 'Humidity', 0, '', '1111-11-11 11:11:11', 'Driver'),
(105, 1, 'Speed', 0, '', '1111-11-11 11:11:11', 'Driver'),
(106, 1, 'LidarDistances', 0, '', '1111-11-11 11:11:11', 'Driver');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- Indizes für die Tabelle `vehiclecurrentdata`
--
ALTER TABLE `vehiclecurrentdata`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vehiclehistoricaldata`
--
ALTER TABLE `vehiclehistoricaldata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `vehiclecurrentdata`
--
ALTER TABLE `vehiclecurrentdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `vehiclehistoricaldata`
--
ALTER TABLE `vehiclehistoricaldata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
