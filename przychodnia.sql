-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 26, 2025 at 06:12 PM
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
-- Database: `przychodnia`
--
CREATE DATABASE IF NOT EXISTS `przychodnia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `przychodnia`;

-- --------------------------------------------------------

--
-- Table structure for table `lekarze`
--

CREATE TABLE `lekarze` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lekarze`
--

INSERT INTO `lekarze` (`id`, `imie`, `nazwisko`, `email`, `haslo`) VALUES
(3, 'mat', 'pat', 'mat@przychodnia.com', 'password12345'),
(5, 'mateusz', 'mat', 'pat@przychodnia.com', '$2y$10$lnt5sk.71csqPlDbFrklXu./Pavs3JtiT08xBXUrSmmK04X.JWxL.'),
(6, 'Kamil', 'Osiński', 'kamil.osinski@przychodnia.com', '$2y$10$efJw0ANClGMcL6Oz3Nf5VeW6KhUIuYzyQ7fRMTnD1Zm93sgVQa/mK');

-- --------------------------------------------------------

--
-- Table structure for table `pacjenci`
--

CREATE TABLE `pacjenci` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pacjenci`
--

INSERT INTO `pacjenci` (`id`, `imie`, `nazwisko`, `email`, `haslo`) VALUES
(18, 'mat2', 'pat', 'mat@gmail.com', '$2y$10$aJkStgwBNvulfhCnyi2QkOkSQUA9bEFXvXf1CsmDqSFa6es0dl09S'),
(20, 'taw', 'wat', 'taw@gmail.com', '$2y$10$c0aTqatBHIGfRhsIEcKOuOGYpN4RtatkJhGvc8e5wkFULzMRL3Y2K'),
(21, 'kam', 'osi', 'lat@gmail.com', '$2y$10$bDuN6niNLtZTRSO7ZGG/VuSTb1fPizZmxuyJc1oNgpvqe6xgN4QYS'),
(25, 'ram', 'pamsiam', 'ram@gmail.com', '$2y$10$7ZmzDcwktw/Ne2CipBP9LuUejpBxn3Ioxtbgdgu0.Dj2JzI3HIX5G'),
(27, 'nowy', 'pacjent', 'nowy@gmail.com', '$2y$10$VAMDSkTXtoY3qTDl7jjL9uHd0TAtwbkRWVlVa6Ujr0ms1UI3B6n6m');

-- --------------------------------------------------------

--
-- Table structure for table `wizyty`
--

CREATE TABLE `wizyty` (
  `id` int(11) NOT NULL,
  `lekarz_id` int(11) NOT NULL,
  `pacjent_id` int(11) NOT NULL,
  `data_wizyty` datetime NOT NULL,
  `opis` text DEFAULT NULL,
  `powod_odwolania` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wizyty`
--

INSERT INTO `wizyty` (`id`, `lekarz_id`, `pacjent_id`, `data_wizyty`, `opis`, `powod_odwolania`) VALUES
(1, 3, 18, '2024-01-25 00:00:00', 'Problemy z nogą', 'Pacjent nie da rady przyjść'),
(2, 3, 18, '2024-01-25 00:00:00', 'Wizyta kontrolna - edytuję tą wizytę', 'Lekarz się rozchorował.'),
(3, 5, 21, '2025-01-30 00:00:00', 'Problem z gardłem', 'nie ma żadnego problemu z gardłem'),
(4, 3, 18, '2025-02-25 00:00:00', 'Ból gardła - jeszcze bardziej boli', ''),
(5, 3, 25, '2025-01-31 00:00:00', 'Problemy z nogą - zmieniłem opis tej wizyty właśnie', 'Już nie boli'),
(6, 5, 25, '2025-01-24 00:00:00', 'Problemy z tarczycą', ''),
(7, 5, 18, '2025-01-30 00:00:00', 'Ból po wyrwaniu 8emki - tak', ''),
(8, 3, 18, '2025-01-12 13:30:00', 'Wizyta kontrolna po chorobie - to jest moja edytowana wizyta ', ''),
(9, 3, 18, '2025-01-31 13:30:00', 'Ból w klatce piersiowej', 'Dzisiaj mam kolokwium i nie dam rady przyjść'),
(10, 3, 27, '2025-01-30 14:15:00', 'Nowa wizyta na 14:15', ''),
(11, 3, 25, '2025-01-26 08:00:00', 'Nowa wizyta na godzię 8:00 ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lekarze`
--
ALTER TABLE `lekarze`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacjenci`
--
ALTER TABLE `pacjenci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wizyty`
--
ALTER TABLE `wizyty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lekarz_id` (`lekarz_id`),
  ADD KEY `pacjent_id` (`pacjent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lekarze`
--
ALTER TABLE `lekarze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pacjenci`
--
ALTER TABLE `pacjenci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `wizyty`
--
ALTER TABLE `wizyty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wizyty`
--
ALTER TABLE `wizyty`
  ADD CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`lekarz_id`) REFERENCES `lekarze` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wizyty_ibfk_2` FOREIGN KEY (`pacjent_id`) REFERENCES `pacjenci` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
