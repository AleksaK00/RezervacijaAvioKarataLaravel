-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 03:07 PM
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
-- Database: `online_rezervacija_letova`
--

-- --------------------------------------------------------

--
-- Table structure for table `aerodrom`
--

CREATE TABLE `aerodrom` (
  `ICAO_Kod_Aerodroma` varchar(6) NOT NULL,
  `Grad` varchar(60) NOT NULL,
  `Ime` varchar(120) NOT NULL,
  `Drzava` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aerodrom`
--

INSERT INTO `aerodrom` (`ICAO_Kod_Aerodroma`, `Grad`, `Ime`, `Drzava`) VALUES
('EGGW', 'London', 'London Luton Airport', 'Velika Britanija'),
('EGLL', 'London', 'London Heathrow Airport', 'Velika Britanija'),
('EHAM', 'Amsterdam', 'Amsterdam Schiphol Airport', 'Holandija'),
('LIRF', 'Rim', 'Rome Fiumicino Airport', 'Italija'),
('LTFJ ', 'Istanbul', 'Istanbul Sabiha Gokcen International Airport', 'Turska'),
('LTFM', 'Istanbul', 'Istanbul Airport', 'Turska'),
('LYBE', 'Beograd', 'Belgrade Nikola Tesla Airport', 'Srbija'),
('ZGGG', 'Guangdžou', 'Guangzhou Baiyun International Airport', 'Kina');

-- --------------------------------------------------------

--
-- Table structure for table `avion`
--

CREATE TABLE `avion` (
  `Registracija` varchar(20) NOT NULL,
  `ICAO_Kod` varchar(6) NOT NULL,
  `Proizvodjac` varchar(120) NOT NULL,
  `Model` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avion`
--

INSERT INTO `avion` (`Registracija`, `ICAO_Kod`, `Proizvodjac`, `Model`) VALUES
('9H-WBT ', 'WZZ', 'Airbus', 'A320'),
('B-1168', 'CSN', 'Boeing', '787-9'),
('PH-NXA', 'KLM', 'Embraer', 'E195-E2'),
('TC-JPH', 'THY', 'Airbus', 'A320'),
('TC-JYB', 'THY', 'Boeing', '737-900'),
('TC-LPA', 'THY', 'Airbus', 'A321neo'),
('TC-RBB', 'PGT', 'Airbus', 'A320neo'),
('YU-APB', 'ASL', 'Airbus', 'A319'),
('YU-APH', 'ASL', 'Airbus', 'A320'),
('YU-ARC', 'ASL', 'Airbus', 'A330-200');

-- --------------------------------------------------------

--
-- Table structure for table `avio_kompanija`
--

CREATE TABLE `avio_kompanija` (
  `ICAO_Kod` varchar(6) NOT NULL,
  `Ime` varchar(60) NOT NULL,
  `Drzava_Porekla` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avio_kompanija`
--

INSERT INTO `avio_kompanija` (`ICAO_Kod`, `Ime`, `Drzava_Porekla`) VALUES
('ASL', 'Air Serbia', 'Srbija'),
('CSN', 'China Southern Airlines', 'Kina'),
('KLM', 'KLM', 'Holandija'),
('PGT', 'Pegasus', 'Turska'),
('THY', 'Turkish Airlines', 'Turska'),
('WZZ', 'Wizz Air', 'Mađarska');

-- --------------------------------------------------------

--
-- Table structure for table `instanca_leta`
--

CREATE TABLE `instanca_leta` (
  `Datum_Polaska` date NOT NULL,
  `Br_Leta` varchar(20) NOT NULL,
  `ICAO_Kod` varchar(6) NOT NULL,
  `Registracija` varchar(20) NOT NULL,
  `Cena_Ekonomija` float DEFAULT NULL,
  `Cena_Premium_Ekonomija` float DEFAULT NULL,
  `Cena_Biznis` float DEFAULT NULL,
  `Benefiti_Ekonomija` text NOT NULL,
  `Benefiti_Premium_Ekonomija` text NOT NULL,
  `Benefiti_Biznis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instanca_leta`
--

INSERT INTO `instanca_leta` (`Datum_Polaska`, `Br_Leta`, `ICAO_Kod`, `Registracija`, `Cena_Ekonomija`, `Cena_Premium_Ekonomija`, `Cena_Biznis`, `Benefiti_Ekonomija`, `Benefiti_Premium_Ekonomija`, `Benefiti_Biznis`) VALUES
('2025-06-12', 'JU400', 'ASL', 'YU-APB', 130, NULL, 720, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-08-17', 'JU426', 'ASL', 'YU-APB', 191.03, NULL, 955.16, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-18', 'JU404', 'ASL', 'YU-APH', 129.9, NULL, 740, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-18', 'KL1984', 'KLM', 'PH-NXA', 222, NULL, 770, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-19', 'JU404', 'ASL', 'YU-APB', 129.9, NULL, 740, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-19', 'W64031', 'WZZ', '9H-WBT ', 107, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-20', 'JU404', 'ASL', 'YU-APB', 129.9, NULL, 740, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-20', 'JU422', 'ASL', 'YU-APB', 200.99, NULL, 944.59, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-20', 'TK1080', 'THY', 'TC-JYB', 220, NULL, 990.99, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-20', 'TK1082', 'THY', 'TC-JYB', 222, NULL, 980, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-20', 'TK1084', 'THY', 'TC-LPA', 220, NULL, 970, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-20', 'W64031', 'WZZ', '9H-WBT ', 110, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-21', 'JU400', 'ASL', 'YU-APB', 135, NULL, 750, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-21', 'JU404', 'ASL', 'YU-APH', 130.09, NULL, 733.33, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-21', 'JU422', 'ASL', 'YU-APB', 195, NULL, 930, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-21', 'JU426', 'ASL', 'YU-APB', 190, NULL, 950, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-21', 'PC374', 'PGT', 'TC-RBB', 195, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-21', 'TK1080', 'THY', 'TC-JPH', 225.99, NULL, 990, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-21', 'TK1084', 'THY', 'TC-LPA', 222, NULL, 995, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'JU260', 'ASL', 'YU-APH', 213.99, NULL, 755.99, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'JU400', 'ASL', 'YU-APB', 140, NULL, 760, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'JU404', 'ASL', 'YU-APB', 129.9, NULL, 740, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'JU422', 'ASL', 'YU-APH', 194.5, NULL, 940, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'JU426', 'ASL', 'YU-APH', 192, NULL, 970, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'TK1082', 'THY', 'TC-JPH', 224, NULL, 1000, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'TK1084', 'THY', 'TC-JPH', 225, NULL, 1010, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-22', 'W64031', 'WZZ', '9H-WBT ', 110, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-23', 'JU260', 'ASL', 'YU-APB', 208.99, NULL, 740, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-23', 'JU400', 'ASL', 'YU-APH', 137, NULL, 741, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-23', 'JU404', 'ASL', 'YU-APH', 129.9, NULL, 740, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-23', 'JU422', 'ASL', 'YU-APH', 197, NULL, 930, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-23', 'JU426', 'ASL', 'YU-APB', 188.99, NULL, 960.78, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-23', 'PC374', 'PGT', 'TC-RBB', 194, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-23', 'TK1080', 'THY', 'TC-JYB', 223.3, NULL, 990, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-23', 'TK1084', 'THY', 'TC-JYB', 217.59, NULL, 997, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'CZ668', 'CSN', 'B-1168', 779.99, 1015.99, 1450, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-09-24', 'JU260', 'ASL', 'YU-APB', 212, NULL, 760, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'JU400', 'ASL', 'YU-APB', 133, NULL, 720, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'JU404', 'ASL', 'YU-APB', 129.9, NULL, 740, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'JU422', 'ASL', 'YU-APH', 194, NULL, 935, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'JU426', 'ASL', 'YU-APB', 199.99, NULL, 960.39, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'TK1080', 'THY', 'TC-JPH', 230, NULL, 1000, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'TK1082', 'THY', 'TC-LPA', 225, NULL, 990.5, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'TK1084', 'THY', 'TC-LPA', 215.99, NULL, 995, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-24', 'W64031', 'WZZ', '9H-WBT ', 108.99, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-25', 'JU260', 'ASL', 'YU-APH', 209.59, NULL, 770, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-25', 'JU400', 'ASL', 'YU-APH', 131, NULL, 742.49, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-25', 'JU426', 'ASL', 'YU-APH', 200, NULL, 944.99, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-25', 'KL1984', 'KLM', 'PH-NXA', 218, NULL, 760, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-25', 'PC374', 'PGT', 'TC-RBB', 195, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-25', 'TK1080', 'THY', 'TC-JPH', 219, NULL, 970, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-25', 'TK1084', 'THY', 'TC-JPH', 227, NULL, 1000, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'CZ668', 'CSN', 'B-1168', 790, 1010, 1460, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-09-26', 'JU260', 'ASL', 'YU-APB', 213, NULL, 755, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'JU422', 'ASL', 'YU-APH', 196, NULL, 943, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'JU426', 'ASL', 'YU-APB', 194.95, NULL, 955, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'KL1982', 'KLM', 'PH-NXA', 220, NULL, 770, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'KL1984', 'KLM', 'PH-NXA', 218, NULL, 765, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'TK1080', 'THY', 'TC-LPA', 222, NULL, 993, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'TK1082', 'THY', 'TC-JPH', 220, NULL, 999.99, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'TK1084', 'THY', 'TC-JYB', 221.55, NULL, 980, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-26', 'W64031', 'WZZ', '9H-WBT ', 106, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-27', 'JU260', 'ASL', 'YU-APH', 215, NULL, 749.99, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-27', 'JU422', 'ASL', 'YU-APH', 197, NULL, 941, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-27', 'JU426', 'ASL', 'YU-APH', 193.79, NULL, 977.77, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-27', 'KL1982', 'KLM', 'PH-NXA', 216.99, NULL, 777.77, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-27', 'KL1984', 'KLM', 'PH-NXA', 223, NULL, 770, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-27', 'PC374', 'PGT', 'TC-RBB', 188, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-27', 'TK1080', 'THY', 'TC-LPA', 227, NULL, 1010, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-27', 'W94001', 'WZZ', '9H-WBT', 290, NULL, NULL, '- 1 licni predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-28', 'CZ668', 'CSN', 'B-1168', 785, 1012, 1455, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-09-28', 'JU422', 'ASL', 'YU-APB', 192, NULL, 952, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-28', 'KL1982', 'KLM', 'PH-NXA', 219, NULL, 760, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-28', 'KL1984', 'KLM', 'PH-NXA', 227.99, NULL, 756, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-28', 'TK1080', 'THY', 'TC-JYB', 229, NULL, 997.99, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-28', 'TK1082', 'THY', 'TC-JPH', 227.99, NULL, 996.55, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-28', 'TK1084', 'THY', 'TC-JPH', 222, NULL, 1007.99, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-09-28', 'W64031', 'WZZ', '9H-WBT ', 112, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-09-28', 'W94001', 'WZZ', '9H-WBT', 300, NULL, NULL, '- 1 licni predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-01', 'JU210', 'ASL', 'YU-APB', 478.99, NULL, 1010, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-01', 'JU988', 'ASL', 'YU-ARC', 790, NULL, 1420, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-01', 'KL1982', 'KLM', 'PH-NXA', 230, NULL, 755, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-01', 'KL1984', 'KLM', 'PH-NXA', 222, NULL, 757, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-01', 'PC374', 'PGT', 'TC-RBB', 190.9, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-01', 'TK1080', 'THY', 'TC-LPA', 219.99, NULL, 995.55, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-01', 'W64031', 'WZZ', '9H-WBT ', 111, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-01', 'W94001', 'WZZ', '9H-WBT', 288.99, NULL, NULL, '- 1 licni predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-02', 'CZ668', 'CSN', 'B-1168', 794, 1013, 1453.99, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-02', 'JU210', 'ASL', 'YU-APH', 490, NULL, 1010, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-02', 'KL1982', 'KLM', 'PH-NXA', 222.4, NULL, 740, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-02', 'KL1984', 'KLM', 'PH-NXA', 225, NULL, 758.99, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-02', 'TK1082', 'THY', 'TC-JPH', 226, NULL, 991.55, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-02', 'W94001', 'WZZ', '9H-WBT', 301, NULL, NULL, '- 1 licni predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-03', 'JU210', 'ASL', 'YU-APB', 483.99, NULL, 1005, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-03', 'JU988', 'ASL', 'YU-ARC', 796, NULL, 1430, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-03', 'KL1982', 'KLM', 'PH-NXA', 221, NULL, 730, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-03', 'PC374', 'PGT', 'TC-RBB', 193, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-03', 'W64031', 'WZZ', '9H-WBT ', 110, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-03', 'W94001', 'WZZ', '9H-WBT', 295, NULL, NULL, '- 1 licni predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-04', 'CZ668', 'CSN', 'B-1168', 800, 1022, 1449, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-04', 'JU260', 'ASL', 'YU-APH', 210, NULL, 750, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-04', 'KL1982', 'KLM', 'PH-NXA', 225, NULL, 745, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-04', 'TK1082', 'THY', 'TC-JYB', 230, NULL, 997.99, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-04', 'W94001', 'WZZ', '9H-WBT', 297, NULL, NULL, '- 1 licni predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-05', 'JU210', 'ASL', 'YU-APH', 488, NULL, 998.99, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-05', 'JU988', 'ASL', 'YU-ARC', 785, NULL, 1442.99, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-05', 'PC374', 'PGT', 'TC-RBB', 192.2, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-05', 'W94001', 'WZZ', '9H-WBT', 290, NULL, NULL, '- 1 licni predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-06', 'CZ668', 'CSN', 'B-1168', 793.99, 1009.49, 1460, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-06', 'JU210', 'ASL', 'YU-APB', 490, NULL, 1010, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-06', 'TK1082', 'THY', 'TC-JYB', 227.99, NULL, 999, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-07', 'JU210', 'ASL', 'YU-APH', 480, NULL, 1005, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-07', 'JU988', 'ASL', 'YU-ARC', 799, NULL, 1400, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-07', 'PC374', 'PGT', 'TC-RBB', 189.99, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-08', 'CZ668', 'CSN', 'B-1168', 797.49, 1015, 1455, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-08', 'JU210', 'ASL', 'YU-APH', 482, NULL, 1000, '- Prijava za let na aerodromu\r\n- Rucni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Rucni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-08', 'TK1082', 'THY', 'TC-JYB', 221.99, NULL, 980, '- Prijava za let na aerodromu\r\n- Ručni prtljag\r\n- Grickalice\r\n- Prijava za let putem interneta', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Prioritetna prijava za let\r\n- Refundacija\r\n- Prijava za let putem interneta '),
('2025-10-09', 'JU988', 'ASL', 'YU-ARC', 791, NULL, 1415, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2025-10-09', 'W64031', 'WZZ', '9H-WBT ', 114, NULL, NULL, '- 1 lični predmet\r\n- Staje ispod sedišta ispred vas', '', ''),
('2025-10-11', 'JU988', 'ASL', 'YU-ARC', 783, NULL, 1417, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', '', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n'),
('2026-09-13', 'JU988', 'ASL', 'YU-ARC', 780, NULL, 1400, '- Prijava za let na aerodromu\r\n- 1 x 23kg\r\n- Ručni prtljag\r\n- Obrok\r\n- Milje\r\n- Prijava za let putem interneta\r\n', ' ', '- Prijava za let na aerodromu\r\n- Prioritetni prolaz na pasoškoj kontroli\r\n- 2 x 32kg *\r\n- Ručni prtljag\r\n- Pristup salonu\r\n- Obrok\r\n- Milje\r\n- Prioritetni prtljag\r\n- Prioritetno ukrcavanje\r\n- Rezervacija sedišta unapred\r\n- Prijava za let putem interneta\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `ID_Korisnika` int(10) UNSIGNED NOT NULL,
  `Korisnicko_Ime` varchar(100) NOT NULL,
  `Sifra` varchar(100) NOT NULL,
  `Ime` varchar(30) NOT NULL,
  `Prezime` varchar(30) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Adresa` varchar(120) NOT NULL,
  `Uloga` varchar(20) DEFAULT NULL,
  `Password_Reset_Token` varchar(100) DEFAULT NULL,
  `Password_Reset_Timestamp` timestamp NULL DEFAULT NULL,
  `Is_Deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID_Korisnika`, `Korisnicko_Ime`, `Sifra`, `Ime`, `Prezime`, `Email`, `Adresa`, `Uloga`, `Password_Reset_Token`, `Password_Reset_Timestamp`, `Is_Deleted`) VALUES
(1, 'AleksaK', '$2y$12$MKpYeR2QwaSLrpOWju3qX.cPUidOix4fTyh.lcQw6nQB23H1SenGy', 'Aleksa', 'Karamarkovic', 'aleksa56522@its.edu.rs', 'Adresa 123', 'KORISNIK', NULL, NULL, NULL),
(2, 'KorisnikNovi', '$2y$12$UJW/wtpBHc6te7B/Xunmv.t1FJyR3VsuoiVcYm3GrMlWqNBdWpDhm', 'Novi', 'Korisnik', 'noviKorisnik@gmail.com', 'Nova Adresa 37', 'KORISNIK', '$2y$12$dA0Q/ksVX4.PIy/V8S.08eJSNcNwZ.9FI6tZeDNTZVJdb/NNowfm6', '2025-01-20 14:44:20', NULL),
(3, 'PeraPeric', '$2y$12$naky8Jr5Owbr8j0QSvSIBOyQTA55si2nSDDed4RGSG5vRsuhXarrK', 'Pera', 'Peric', 'Pera@gmail.com', 'Perina Kuca', 'KORISNIK', NULL, NULL, NULL),
(4, 'Mikic_Mika', '$2y$12$JOdvm78q7wCif/F5b0pAjumvDarON2SAR3.7c6Ks3UDxvo1/VJqxe', 'Mika', 'Mikic', 'mikinemail@yahoo.com', 'Mikin penthaus 123', 'KORISNIK', NULL, NULL, NULL),
(5, 'Ana_Anic', '$2y$12$U9fz.6qV6ZJ8TMUiQwJh7emvlog8fI38P9oxd6dHbfxx7qEPSTi0m', 'Ana', 'Anic', 'anaanic@gmail.com', 'PrimerAdrese 123', 'KORISNIK', NULL, NULL, NULL),
(7, 'Administrator1', '$2y$12$VfsFoXpogYxXa8M7geVySOFMNb3VHHj2ISJ0n71p2hhFAEIEOQEMe', 'Administrator', 'Administratorovic', 'admin@onlinerezervacijaletova.com', 'Admin Adresa 123', 'ADMIN', NULL, NULL, NULL),
(9, 'PrimerUgasenog', '$2y$12$MlRCGHi6FyHCK9C0LEJS.uRSMGdC6OEgWoeEKdKsjRnwVgOsUzuV.', 'Ugasen', 'Nalog', 'ugasennalog@yahoo.com', 'Ugasen je btw 123', 'KORISNIK', NULL, NULL, 1),
(10, 'Menadzer1', '$2y$12$YQ9ueGtfQCxTNdXz3RQeSezbS7cGEqBNpJoVmVzA3fxp7TcDQ6NSO', 'Menadzer', 'Menadzer', 'menadzer@rezervacijaletova.com', 'Menadzer adresa', 'MENADZER', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `let`
--

CREATE TABLE `let` (
  `Br_Leta` varchar(20) NOT NULL,
  `ICAO_Kod` varchar(6) NOT NULL,
  `Polazni_Aerodrom` varchar(6) NOT NULL,
  `Dolazni_Aerodrom` varchar(6) NOT NULL,
  `Vreme_Polaska` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `let`
--

INSERT INTO `let` (`Br_Leta`, `ICAO_Kod`, `Polazni_Aerodrom`, `Dolazni_Aerodrom`, `Vreme_Polaska`) VALUES
('CZ668', 'CSN', 'LYBE', 'ZGGG', '05:00:00'),
('JU210', 'ASL', 'LYBE', 'EGLL', '12:20:00'),
('JU260', 'ASL', 'LYBE', 'EHAM', '09:15:00'),
('JU400', 'ASL', 'LYBE', 'LIRF', '08:15:00'),
('JU404', 'ASL', 'LYBE', 'LIRF', '19:35:00'),
('JU422', 'ASL', 'LYBE', 'LTFM', '16:05:00'),
('JU426', 'ASL', 'LYBE', 'LTFM', '04:25:00'),
('JU988', 'ASL', 'LYBE', 'ZGGG', '18:55:00'),
('KL1982', 'KLM', 'LYBE', 'EHAM', '08:35:00'),
('KL1984', 'KLM', 'LYBE', 'EHAM', '15:15:00'),
('PC374', 'PGT', 'LYBE', 'LTFJ ', '15:00:00'),
('TK1080', 'THY', 'LYBE', 'LTFM', '19:05:00'),
('TK1082', 'THY', 'LYBE', 'LTFM', '12:50:00'),
('TK1084', 'THY', 'LYBE', 'LTFM', '00:05:00'),
('W64031', 'WZZ', 'LYBE', 'LIRF', '18:00:00'),
('W94001', 'WZZ', 'LYBE', 'EGGW', '01:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_12_29_164437_create_aerodrom_table', 0),
(2, '2024_12_29_164437_create_avio_kompanija_table', 0),
(3, '2024_12_29_164437_create_avion_table', 0),
(4, '2024_12_29_164437_create_instanca_leta_table', 0),
(5, '2024_12_29_164437_create_korisnik_table', 0),
(6, '2024_12_29_164437_create_let_table', 0),
(7, '2024_12_29_164437_create_nalog_table', 0),
(8, '2024_12_29_164437_create_rezervacija_table', 0),
(9, '2024_12_29_164437_create_sediste_table', 0),
(10, '2024_12_29_164440_add_foreign_keys_to_avion_table', 0),
(11, '2024_12_29_164440_add_foreign_keys_to_instanca_leta_table', 0),
(12, '2024_12_29_164440_add_foreign_keys_to_let_table', 0),
(13, '2024_12_29_164440_add_foreign_keys_to_nalog_table', 0),
(14, '2024_12_29_164440_add_foreign_keys_to_rezervacija_table', 0),
(15, '2024_12_29_164440_add_foreign_keys_to_sediste_table', 0),
(16, '0001_01_01_000000_create_users_table', 1),
(17, '0001_01_01_000001_create_cache_table', 1),
(18, '0001_01_01_000002_create_jobs_table', 1),
(19, '2024_12_29_194305_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nalog`
--

CREATE TABLE `nalog` (
  `ID_Naloga` int(10) UNSIGNED NOT NULL,
  `Datum_Polaska` date NOT NULL,
  `Br_Leta` varchar(20) NOT NULL,
  `ICAO_Kod` varchar(6) NOT NULL,
  `ID_Korisnika` int(10) UNSIGNED NOT NULL,
  `Iznos` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nalog`
--

INSERT INTO `nalog` (`ID_Naloga`, `Datum_Polaska`, `Br_Leta`, `ICAO_Kod`, `ID_Korisnika`, `Iznos`) VALUES
(5, '2025-09-25', 'JU400', 'ASL', 1, 276),
(7, '2025-09-20', 'W64031', 'WZZ', 1, 110),
(10, '2025-09-28', 'JU422', 'ASL', 2, 1904),
(11, '2025-06-12', 'JU400', 'ASL', 1, 260),
(15, '2025-09-25', 'JU400', 'ASL', 3, 414),
(16, '2025-09-27', 'TK1080', 'THY', 5, 470),
(17, '2025-09-24', 'W64031', 'WZZ', 5, 366.97),
(18, '2025-10-01', 'PC374', 'PGT', 4, 421.8),
(19, '2025-09-21', 'JU404', 'ASL', 2, 1466.66),
(20, '2025-09-27', 'TK1080', 'THY', 2, 5050),
(21, '2025-10-07', 'PC374', 'PGT', 1, 199.99),
(22, '2025-09-18', 'KL1984', 'KLM', 1, 466),
(23, '2025-09-28', 'CZ668', 'CSN', 1, 1027),
(24, '2025-09-25', 'JU260', 'ASL', 5, 770),
(25, '2025-10-02', 'KL1982', 'KLM', 5, 1480),
(26, '2025-09-20', 'JU404', 'ASL', 1, 273.8),
(27, '2025-09-26', 'JU422', 'ASL', 2, 406),
(28, '2025-10-04', 'W94001', 'WZZ', 2, 297);

-- --------------------------------------------------------

--
-- Table structure for table `promocija`
--

CREATE TABLE `promocija` (
  `ID` int(11) NOT NULL,
  `Destinacija` varchar(32) NOT NULL,
  `Tekst` text NOT NULL,
  `Aktivan_Slot` set('1','2','3') DEFAULT NULL,
  `Broj_Klikova` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promocija`
--

INSERT INTO `promocija` (`ID`, `Destinacija`, `Tekst`, `Aktivan_Slot`, `Broj_Klikova`) VALUES
(1, 'Rim', 'Pogledajte naše ponude letova za srce Italije.', '1', 1),
(2, 'Istanbul', 'Pogledajte naše ponude letova za most izmedju Evrope i Azije.', '2', 2),
(3, 'London', 'Pogledajte naše ponude letova za London.', '3', 1),
(9, 'Amsterdam', 'Pogledajte naše ponude letova za kanale Amsterdama.', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `Datum_Polaska` date NOT NULL,
  `Br_Leta` varchar(20) NOT NULL,
  `ICAO_Kod` varchar(6) NOT NULL,
  `ID_Korisnika` int(10) UNSIGNED NOT NULL,
  `Br_Karata` int(11) NOT NULL,
  `Klasa` enum('Ekonomija','Premium_Ekonomija','Biznis') NOT NULL,
  `Ime` varchar(30) NOT NULL,
  `Prezime` varchar(30) NOT NULL,
  `Adresa` varchar(120) NOT NULL,
  `Otkazana` tinyint(1) NOT NULL DEFAULT 0,
  `ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`Datum_Polaska`, `Br_Leta`, `ICAO_Kod`, `ID_Korisnika`, `Br_Karata`, `Klasa`, `Ime`, `Prezime`, `Adresa`, `Otkazana`, `ID`) VALUES
('2025-06-12', 'JU400', 'ASL', 1, 2, 'Ekonomija', 'Aleksa', 'Karamarkovic', 'Adresa 123', 0, 1),
('2025-09-18', 'KL1984', 'KLM', 1, 2, 'Ekonomija', 'Aleksa', 'Karamarkovic', 'Adresa 123', 0, 15),
('2025-09-20', 'JU404', 'ASL', 1, 2, 'Ekonomija', 'Aleksa', 'Karamarkovic', 'Adresa 123', 0, 19),
('2025-09-20', 'W64031', 'WZZ', 1, 1, 'Ekonomija', 'Aleksa', 'Karamarkovic', 'Adresa 123', 0, 4),
('2025-09-21', 'JU404', 'ASL', 2, 2, 'Biznis', 'Novi', 'Korisnik', 'Nova Adresa 37', 0, 12),
('2025-09-24', 'W64031', 'WZZ', 5, 3, 'Ekonomija', 'Anin', 'Drugar', 'PrimerAdrese 231', 0, 10),
('2025-09-25', 'JU260', 'ASL', 5, 1, 'Biznis', 'Ana', 'Anic', 'PrimerAdrese 123', 0, 17),
('2025-09-25', 'JU400', 'ASL', 1, 2, 'Ekonomija', 'Aleksa', 'Karamarkovic', 'Adresa 123', 0, 2),
('2025-09-25', 'JU400', 'ASL', 3, 3, 'Ekonomija', 'Pera', 'Peric', 'Perina Kuca', 1, 8),
('2025-09-26', 'JU422', 'ASL', 2, 2, 'Ekonomija', 'Novi', 'Korisnik', 'Nova Adresa 37', 0, 20),
('2025-09-27', 'TK1080', 'THY', 2, 5, 'Biznis', 'Novi', 'Korisnik', 'Nova Adresa 37', 0, 13),
('2025-09-27', 'TK1080', 'THY', 5, 2, 'Ekonomija', 'Ana', 'Anic', 'PrimerAdrese 123', 1, 9),
('2025-09-28', 'CZ668', 'CSN', 1, 1, 'Premium_Ekonomija', 'Aleksa', 'Karamarkovic', 'Adresa 123', 0, 16),
('2025-09-28', 'JU422', 'ASL', 2, 2, 'Biznis', 'Novi', 'Korisnik', 'Druga Adresa 123', 1, 3),
('2025-10-01', 'PC374', 'PGT', 4, 2, 'Ekonomija', 'Mika', 'Mikic', 'Mikin penthaus 123', 0, 11),
('2025-10-02', 'KL1982', 'KLM', 5, 2, 'Biznis', 'Ana', 'Anic', 'PrimerAdrese 123', 0, 18),
('2025-10-04', 'W94001', 'WZZ', 2, 1, 'Ekonomija', 'Novi', 'Korisnik', 'Nova Adresa 37', 0, 21),
('2025-10-07', 'PC374', 'PGT', 1, 1, 'Ekonomija', 'Aleksa', 'Karamarkovic', 'Adresa 123', 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `rezervisana_sedista`
--

CREATE TABLE `rezervisana_sedista` (
  `Datum_Polaska` date NOT NULL,
  `Br_Leta` varchar(20) NOT NULL,
  `ICAO_Kod` varchar(6) NOT NULL,
  `ID_Korisnika` int(10) UNSIGNED NOT NULL,
  `Br_Sedista` varchar(4) NOT NULL,
  `Registracija` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervisana_sedista`
--

INSERT INTO `rezervisana_sedista` (`Datum_Polaska`, `Br_Leta`, `ICAO_Kod`, `ID_Korisnika`, `Br_Sedista`, `Registracija`) VALUES
('2025-09-18', 'KL1984', 'KLM', 1, 'A11', 'PH-NXA'),
('2025-09-18', 'KL1984', 'KLM', 1, 'A15', 'PH-NXA'),
('2025-09-20', 'JU404', 'ASL', 1, 'D8', 'YU-APB'),
('2025-09-20', 'JU404', 'ASL', 1, 'E8', 'YU-APB'),
('2025-09-21', 'JU404', 'ASL', 2, 'D1', 'YU-APH'),
('2025-09-21', 'JU404', 'ASL', 2, 'F1', 'YU-APH'),
('2025-09-24', 'W64031', 'WZZ', 5, 'D13', '9H-WBT'),
('2025-09-24', 'W64031', 'WZZ', 5, 'E13', '9H-WBT'),
('2025-09-25', 'JU260', 'ASL', 5, 'D1', 'YU-APH'),
('2025-09-25', 'JU400', 'ASL', 1, 'A15', 'YU-APH'),
('2025-09-25', 'JU400', 'ASL', 1, 'B15', 'YU-APH'),
('2025-09-26', 'JU422', 'ASL', 2, 'A15', 'YU-APH'),
('2025-09-26', 'JU422', 'ASL', 2, 'B15', 'YU-APH'),
('2025-09-28', 'CZ668', 'CSN', 1, 'A26', 'B-1168'),
('2025-10-01', 'PC374', 'PGT', 4, 'A16', 'TC-RBB'),
('2025-10-01', 'PC374', 'PGT', 4, 'B16', 'TC-RBB'),
('2025-10-02', 'KL1982', 'KLM', 5, 'A1', 'PH-NXA'),
('2025-10-02', 'KL1982', 'KLM', 5, 'C1', 'PH-NXA'),
('2025-10-07', 'PC374', 'PGT', 1, 'C5', 'TC-RBB');

-- --------------------------------------------------------

--
-- Table structure for table `sediste`
--

CREATE TABLE `sediste` (
  `Br_Sedista` varchar(4) NOT NULL,
  `Registracija` varchar(20) NOT NULL,
  `Klasa` enum('Ekonomija','Premium_Ekonomija','Biznis','Prva klasa') NOT NULL,
  `Doplata` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sediste`
--

INSERT INTO `sediste` (`Br_Sedista`, `Registracija`, `Klasa`, `Doplata`) VALUES
('A1', 'PH-NXA', 'Biznis', 0),
('A11', 'PH-NXA', 'Ekonomija', 7),
('A15', 'PH-NXA', 'Ekonomija', 15),
('A15', 'TC-RBB', 'Ekonomija', 20),
('A15', 'YU-APH', 'Ekonomija', 7),
('A16', 'TC-RBB', 'Ekonomija', 20),
('A19', 'TC-LPA', 'Ekonomija', 8),
('A2', 'TC-JYB', 'Biznis', 0),
('A2', 'YU-ARC', 'Biznis', 0),
('A25', '9H-WBT ', 'Ekonomija', 10),
('A26', 'B-1168', 'Premium_Ekonomija', 15),
('A5', 'TC-RBB', 'Ekonomija', 10),
('A50', 'B-1168', 'Ekonomija', 15),
('A6', 'B-1168', 'Biznis', 15),
('A8', '9H-WBT ', 'Ekonomija', 10),
('A8', 'TC-JPH', 'Ekonomija', 8),
('A8', 'TC-JYB', 'Ekonomija', 8),
('B15', 'TC-RBB', 'Ekonomija', 20),
('B15', 'YU-APH', 'Ekonomija', 7),
('B16', 'TC-RBB', 'Ekonomija', 20),
('B19', 'TC-LPA', 'Ekonomija', 8),
('B2', 'TC-JYB', 'Biznis', 0),
('B25', '9H-WBT ', 'Ekonomija', 10),
('B27', 'TC-RBB', 'Ekonomija', 10),
('B5', 'TC-RBB', 'Ekonomija', 10),
('B50', 'B-1168', 'Ekonomija', 15),
('B8', '9H-WBT ', 'Ekonomija', 10),
('B8', 'TC-JPH', 'Ekonomija', 8),
('B8', 'TC-JYB', 'Ekonomija', 8),
('C1', 'PH-NXA', 'Biznis', 0),
('C11', 'PH-NXA', 'Ekonomija', 7),
('C15', 'PH-NXA', 'Ekonomija', 15),
('C15', 'YU-APH', 'Ekonomija', 7),
('C16', 'TC-RBB', 'Ekonomija', 20),
('C19', 'TC-LPA', 'Ekonomija', 8),
('C20', '9H-WBT ', 'Ekonomija', 10),
('C26', 'B-1168', 'Premium_Ekonomija', 15),
('C5', 'TC-RBB', 'Ekonomija', 10),
('C50', 'B-1168', 'Ekonomija', 15),
('C8', '9H-WBT ', 'Ekonomija', 10),
('C8', 'TC-JPH', 'Ekonomija', 8),
('C8', 'TC-JYB', 'Ekonomija', 8),
('D1', 'YU-APB', 'Biznis', 0),
('D1', 'YU-APH', 'Biznis', 0),
('D11', 'PH-NXA', 'Ekonomija', 7),
('D13', '9H-WBT ', 'Ekonomija', 20),
('D14', 'YU-ARC', 'Ekonomija', 15),
('D2', 'TC-JPH', 'Biznis', 0),
('D2', 'YU-ARC', 'Biznis', 0),
('D21', 'TC-JPH', 'Ekonomija', 8),
('D21', 'TC-JYB', 'Ekonomija', 8),
('D23', 'TC-RBB', 'Ekonomija', 10),
('D24', 'TC-LPA', 'Ekonomija', 20),
('D3', 'TC-LPA', 'Biznis', 0),
('D33', 'B-1168', 'Ekonomija', 15),
('D34', 'TC-RBB', 'Ekonomija', 7),
('D5', 'TC-RBB', 'Ekonomija', 10),
('D8', 'YU-APB', 'Ekonomija', 7),
('E10', 'B-1168', 'Biznis', 0),
('E10', 'TC-LPA', 'Ekonomija', 8),
('E13', '9H-WBT ', 'Ekonomija', 20),
('E14', 'YU-ARC', 'Ekonomija', 15),
('E19', 'YU-APH', 'Ekonomija', 7),
('E21', 'TC-JPH', 'Ekonomija', 8),
('E21', 'TC-JYB', 'Ekonomija', 8),
('E23', 'TC-RBB', 'Ekonomija', 10),
('E24', 'TC-LPA', 'Ekonomija', 20),
('E28', 'B-1168', 'Premium_Ekonomija', 15),
('E33', 'B-1168', 'Ekonomija', 15),
('E5', 'TC-RBB', 'Ekonomija', 10),
('E8', 'YU-APB', 'Ekonomija', 7),
('E9', 'YU-APH', 'Ekonomija', 7),
('F1', 'YU-APB', 'Biznis', 0),
('F1', 'YU-APH', 'Biznis', 0),
('F10', 'TC-LPA', 'Ekonomija', 8),
('F11', 'PH-NXA', 'Ekonomija', 7),
('F14', 'YU-ARC', 'Ekonomija', 15),
('F15', 'TC-JPH', 'Ekonomija', 8),
('F15', 'TC-JYB', 'Ekonomija', 8),
('F19', 'YU-APH', 'Ekonomija', 7),
('F2', 'TC-JPH', 'Biznis', 0),
('F20', '9H-WBT ', 'Ekonomija', 10),
('F23', 'TC-RBB', 'Ekonomija', 10),
('F3', 'TC-LPA', 'Biznis', 0),
('F31', 'TC-LPA', 'Ekonomija', 8),
('F4', '9H-WBT ', 'Ekonomija', 10),
('F5', 'TC-RBB', 'Ekonomija', 10),
('F8', 'YU-APB', 'Ekonomija', 7),
('G10', 'B-1168', 'Biznis', 0),
('G14', 'YU-ARC', 'Ekonomija', 15),
('G33', 'B-1168', 'Ekonomija', 15),
('H20', 'YU-ARC', 'Ekonomija', 15),
('K2', 'YU-ARC', 'Biznis', 0),
('K20', 'YU-ARC', 'Ekonomija', 15),
('K38', 'B-1168', 'Ekonomija', 15);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PLwUWT39P0i3NYnpdzuDKT2wDd6IbgPNYLdYszqW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEY5RWZYVUV0Znd1SkJ5TVRaNjcxd3RlbEgzbVFmazVKSDlpSlZ5QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbmZvL2xvZ2luTmVlZGVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750337463),
('s3AXQj0Q8cZkh7D1uaXpc7zB7b9F6o3pH9dieqO7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiYjdtbGtIM2VCd05BZUFFdzdQSEI2Z295azNwM1M2dkhjVU5yek45cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tYW5hZ2VyL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTA6ImJyb2pLYXJhdGEiO3M6MToiMSI7czoxNToiaXphYnJhbmFTZWRpc3RhIjthOjA6e31zOjk6ImNlbmFLYXJ0ZSI7czozOiIyOTciO3M6MTE6ImNlbmFEb3BsYXRlIjtzOjE6IjAiO30=', 1750338242),
('ViebA4U0dMvR3AZU59trEQ1uLWiGE0JX1IBTJ39c', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUlNQXRBbXZ6STR6Mm9ETmdHb2hYSzBlbzhhQXBlelJMSjg4Q3VXbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tYW5hZ2VyL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750337463);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aerodrom`
--
ALTER TABLE `aerodrom`
  ADD PRIMARY KEY (`ICAO_Kod_Aerodroma`);

--
-- Indexes for table `avion`
--
ALTER TABLE `avion`
  ADD PRIMARY KEY (`Registracija`),
  ADD KEY `FK_Avion_AvioKompanija` (`ICAO_Kod`);

--
-- Indexes for table `avio_kompanija`
--
ALTER TABLE `avio_kompanija`
  ADD PRIMARY KEY (`ICAO_Kod`);

--
-- Indexes for table `instanca_leta`
--
ALTER TABLE `instanca_leta`
  ADD PRIMARY KEY (`Datum_Polaska`,`Br_Leta`,`ICAO_Kod`),
  ADD KEY `FK_InstancaLeta_Let` (`Br_Leta`,`ICAO_Kod`),
  ADD KEY `FK_InstancaLeta_Avion` (`Registracija`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`ID_Korisnika`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `UQ_korisnickoime` (`Korisnicko_Ime`);

--
-- Indexes for table `let`
--
ALTER TABLE `let`
  ADD PRIMARY KEY (`Br_Leta`,`ICAO_Kod`),
  ADD KEY `FK_Let_Aerodrom_Dolazni` (`Dolazni_Aerodrom`),
  ADD KEY `FK_Let_Aerodrom_Polazni` (`Polazni_Aerodrom`),
  ADD KEY `FK_Let_AvioKompanija` (`ICAO_Kod`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nalog`
--
ALTER TABLE `nalog`
  ADD PRIMARY KEY (`ID_Naloga`,`Datum_Polaska`,`Br_Leta`,`ICAO_Kod`,`ID_Korisnika`),
  ADD KEY `FK_Nalog_Rezervacija` (`Datum_Polaska`,`Br_Leta`,`ICAO_Kod`,`ID_Korisnika`);

--
-- Indexes for table `promocija`
--
ALTER TABLE `promocija`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Aktivan_Slot` (`Aktivan_Slot`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`Datum_Polaska`,`Br_Leta`,`ICAO_Kod`,`ID_Korisnika`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `FK_Rezervacija_InstancaLeta` (`Br_Leta`,`ICAO_Kod`,`Datum_Polaska`),
  ADD KEY `FK_Rezervacija_Korisnik` (`ID_Korisnika`);

--
-- Indexes for table `rezervisana_sedista`
--
ALTER TABLE `rezervisana_sedista`
  ADD PRIMARY KEY (`Datum_Polaska`,`Br_Leta`,`ICAO_Kod`,`ID_Korisnika`,`Br_Sedista`,`Registracija`),
  ADD KEY `FK_RezervisanaSedista_Sediste` (`Br_Sedista`,`Registracija`);

--
-- Indexes for table `sediste`
--
ALTER TABLE `sediste`
  ADD PRIMARY KEY (`Br_Sedista`,`Registracija`),
  ADD KEY `FK_Sediste_Avion` (`Registracija`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `ID_Korisnika` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nalog`
--
ALTER TABLE `nalog`
  MODIFY `ID_Naloga` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `promocija`
--
ALTER TABLE `promocija`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avion`
--
ALTER TABLE `avion`
  ADD CONSTRAINT `FK_Avion_AvioKompanija` FOREIGN KEY (`ICAO_Kod`) REFERENCES `avio_kompanija` (`ICAO_Kod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instanca_leta`
--
ALTER TABLE `instanca_leta`
  ADD CONSTRAINT `FK_InstancaLeta_Avion` FOREIGN KEY (`Registracija`) REFERENCES `avion` (`Registracija`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_InstancaLeta_Let` FOREIGN KEY (`Br_Leta`,`ICAO_Kod`) REFERENCES `let` (`Br_Leta`, `ICAO_Kod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `let`
--
ALTER TABLE `let`
  ADD CONSTRAINT `FK_Let_Aerodrom_Dolazni` FOREIGN KEY (`Dolazni_Aerodrom`) REFERENCES `aerodrom` (`ICAO_Kod_Aerodroma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Let_Aerodrom_Polazni` FOREIGN KEY (`Polazni_Aerodrom`) REFERENCES `aerodrom` (`ICAO_Kod_Aerodroma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Let_AvioKompanija` FOREIGN KEY (`ICAO_Kod`) REFERENCES `avio_kompanija` (`ICAO_Kod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nalog`
--
ALTER TABLE `nalog`
  ADD CONSTRAINT `FK_Nalog_Rezervacija` FOREIGN KEY (`Datum_Polaska`,`Br_Leta`,`ICAO_Kod`,`ID_Korisnika`) REFERENCES `rezervacija` (`Datum_Polaska`, `Br_Leta`, `ICAO_Kod`, `ID_Korisnika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `FK_Rezervacija_InstancaLeta` FOREIGN KEY (`Br_Leta`,`ICAO_Kod`,`Datum_Polaska`) REFERENCES `instanca_leta` (`Br_Leta`, `ICAO_Kod`, `Datum_Polaska`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Rezervacija_Korisnik` FOREIGN KEY (`ID_Korisnika`) REFERENCES `korisnik` (`ID_Korisnika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervisana_sedista`
--
ALTER TABLE `rezervisana_sedista`
  ADD CONSTRAINT `FK_RezervisanaSedista_Rezervacija` FOREIGN KEY (`Datum_Polaska`,`Br_Leta`,`ICAO_Kod`,`ID_Korisnika`) REFERENCES `rezervacija` (`Datum_Polaska`, `Br_Leta`, `ICAO_Kod`, `ID_Korisnika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RezervisanaSedista_Sediste` FOREIGN KEY (`Br_Sedista`,`Registracija`) REFERENCES `sediste` (`Br_Sedista`, `Registracija`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sediste`
--
ALTER TABLE `sediste`
  ADD CONSTRAINT `FK_Sediste_Avion` FOREIGN KEY (`Registracija`) REFERENCES `avion` (`Registracija`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
