-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Jun 2019 um 14:43
-- Server-Version: 10.1.31-MariaDB
-- PHP-Version: 7.1.15

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
(1, 10, 'Admin', 'Admin', 'Admin', 'anpeju@googlemail.com', '$2y$10$rPgGdVdsJHkh9fzwmq9ixebz59qArpFnwtBmDs.7DcaU9eD7ZSVuW', '2019-06-26 14:33:37', '', 973453),
(23, 20, 'rebholju', 'Julian', 'Rebholz', 'rebholju@googlemail.com', '$2y$10$VkbQUXhfyTPKY1bYLF9UQ.VahZkg0fwDEk.5GwwE1kVlMnSVcrH1a', '2019-06-26 14:33:47', '', 123456),
(24, 20, 'pe721sch', 'Peter', 'Schmidt', 'petersch1994@gmail.com', '$2y$10$k5jgB6Eu77A6hO5r8GU4Q.5.AnLIoPpcuXaeAb3sRyqhx/hG1YX26', '0000-00-00 00:00:00', '', 111111),
(25, 20, 'an721rot', 'Andreas', 'Roth', 'an721rot@htwg-konstanz.de', '$2y$10$4bfCn8IjqFxEH0e4oj7ZduvxyiR0IgosgtgqnVd0glhjed0sftrhG', '0000-00-00 00:00:00', '', 12345);

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
(1, 1, 'Temperature', '10', 'Degree Celsius', '2019-06-12 18:05:48', 'No Driver authetificated'),
(2, 1, 'Humidity', '8', '%', '2019-06-12 18:05:48', 'No Driver authetificated'),
(3, 1, 'Speed', '50', 'km/h', '2019-06-12 18:05:48', 'No Driver authetificated'),
(4, 1, 'LidarDistances', '190', 'mm', '2019-06-12 18:05:48', 'No Driver authetificated');

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
(1, 1, 'Temperature', 10, 'Degree Celsius', '2019-06-12 18:05:48', 'pe721sch'),
(2, 1, 'Humidity', 8, '%', '2019-06-12 18:05:48', 'pe721sch'),
(3, 1, 'Speed', 50, 'km/h', '2019-06-12 18:05:48', 'pe721sch'),
(4, 1, 'LidarDistances', 190, 'mm', '2019-06-12 18:05:48', 'pe721sch'),
(5, 1, 'Temperature', 10, 'Degree Celsius', '2019-06-14 18:05:48', 'pe721sch'),
(6, 1, 'Humidity', 8, '%', '2019-06-14 18:05:48', 'pe721sch'),
(7, 1, 'Speed', 50, 'km/h', '2019-06-14 18:05:48', 'pe721sch'),
(8, 1, 'LidarDistances', 190, 'mm', '2019-06-14 18:05:48', 'pe721sch'),
(9, 1, 'Temperature', 10, 'Degree Celsius', '2019-06-13 18:05:48', 'pe721sch'),
(10, 1, 'Humidity', 8, '%', '2019-06-13 18:05:48', 'pe721sch'),
(11, 1, 'Speed', 50, 'km/h', '2019-06-13 18:05:48', 'pe721sch'),
(12, 1, 'LidarDistances', 190, 'mm', '2019-06-13 18:05:48', 'pe721sch');

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
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
