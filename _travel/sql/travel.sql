-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 mai 2022 à 16:15
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `travel`
--
CREATE DATABASE IF NOT EXISTS `travel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `travel`;

-- --------------------------------------------------------

--
-- Structure de la table `airline`
--

DROP TABLE IF EXISTS `airline`;
CREATE TABLE IF NOT EXISTS `airline` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `startid` bigint(20) UNSIGNED NOT NULL,
  `destinationid` bigint(20) UNSIGNED NOT NULL,
  `airplaneid` bigint(20) UNSIGNED NOT NULL,
  `price` smallint(5) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `startid` (`startid`),
  KEY `destinationid` (`destinationid`),
  KEY `airplaneid` (`airplaneid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `airline`
--

INSERT INTO `airline` (`id`, `startid`, `destinationid`, `airplaneid`, `price`, `created`) VALUES
(1, 9, 7, 1, 492, '2022-05-10 16:57:23');

-- --------------------------------------------------------

--
-- Structure de la table `airline_reservation`
--

DROP TABLE IF EXISTS `airline_reservation`;
CREATE TABLE IF NOT EXISTS `airline_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `airlineid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `airlineid` (`airlineid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `airline_reservation`
--

INSERT INTO `airline_reservation` (`id`, `airlineid`, `userid`, `created`) VALUES
(1, 1, 1, '2022-05-10 17:52:27');

-- --------------------------------------------------------

--
-- Structure de la table `airplane`
--

DROP TABLE IF EXISTS `airplane`;
CREATE TABLE IF NOT EXISTS `airplane` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `engines` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `pilots` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `cruise` smallint(5) UNSIGNED NOT NULL,
  `range` smallint(5) UNSIGNED NOT NULL,
  `takeoff` smallint(5) UNSIGNED NOT NULL,
  `landing` smallint(5) UNSIGNED NOT NULL,
  `passengers` smallint(5) UNSIGNED NOT NULL,
  `fuel` mediumint(8) UNSIGNED NOT NULL,
  `cons_by_km` smallint(6) UNSIGNED NOT NULL,
  `cons_by_seat` float UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `airplane`
--

INSERT INTO `airplane` (`id`, `name`, `engines`, `pilots`, `cruise`, `range`, `takeoff`, `landing`, `passengers`, `fuel`, `cons_by_km`, `cons_by_seat`, `price`) VALUES
(1, 'Airbus A330-200', 2, 2, 880, 13000, 2500, 1700, 250, 139000, 6500, 0.026, 234000000),
(2, 'Airbus A330-300', 2, 2, 880, 10000, 2700, 1750, 270, 135000, 6800, 0.0251852, 260000000),
(3, 'Airbus A220-100', 2, 2, 860, 5800, 1500, 1400, 120, 21800, 2800, 0.0233333, 62000000),
(4, 'Airbus A220-300', 2, 2, 870, 6000, 1900, 1500, 140, 21500, 3100, 0.0221429, 71000000),
(5, 'Airbus A380-800', 4, 2, 900, 15000, 3000, 2200, 540, 320000, 13780, 0.0255185, 440000000),
(6, 'Boeing 737-600', 2, 2, 840, 6000, 2100, 1700, 130, 26000, 2800, 0.0215385, 70000000),
(7, 'Boeing 737-800', 2, 2, 840, 6000, 2300, 2000, 180, 27000, 3400, 0.0188889, 90000000),
(8, 'Boeing 787-8', 2, 2, 900, 14000, 2600, 2000, 250, 126000, 5380, 0.02152, 220000000),
(9, 'Boeing 747-400', 4, 2, 910, 14000, 2700, 2300, 480, 215000, 12300, 0.025625, 420000000),
(10, 'Bombardier CRJ-1000', 2, 2, 880, 3000, 2100, 1750, 100, 8800, 2660, 0.0266, 50000000),
(11, 'Bombardier CRJ-700', 2, 2, 840, 3500, 1600, 1540, 75, 8900, 2950, 0.0393333, 40000000),
(12, 'Embraer E190', 2, 2, 830, 5000, 1450, 1240, 100, 13500, 3200, 0.032, 60000000),
(13, 'Boeing 767-400', 2, 2, 850, 10400, 3300, 2500, 300, 110000, 5900, 0.0196667, 220000000),
(14, 'Sukhoi Superjet 100', 2, 2, 850, 4500, 2050, 1450, 100, 15800, 2800, 0.028, 50000000),
(15, 'Antonov An-148', 2, 2, 850, 4400, 1900, 1600, 80, 12000, 4230, 0.052875, 25000000),
(16, 'Tupolev Tu204-300', 2, 2, 820, 7500, 2100, 1800, 150, 36000, 3500, 0.0233333, 40000000),
(17, 'Boeing 757-200', 2, 2, 850, 7250, 2100, 1500, 200, 43500, 4680, 0.0234, 65000000),
(18, 'ATR 72', 2, 2, 510, 1500, 1400, 1200, 70, 5000, 1420, 0.0202, 18000000),
(19, 'Boeing 777-8', 2, 2, 890, 16000, 2500, 2000, 384, 237000, 7690, 0.02, 410000000),
(20, 'Boeing 777-300', 2, 2, 890, 11000, 3200, 2500, 370, 170000, 7880, 0.0213, 320000000),
(21, 'Boeing 767-200', 2, 2, 850, 7200, 1900, 1500, 220, 75000, 4930, 0.0224, 180000000),
(22, 'Boeing 787-10', 2, 2, 900, 12000, 2800, 2100, 340, 126000, 6120, 0.018, 290000000),
(23, 'Antonov An-158', 2, 2, 850, 2500, 1900, 1600, 100, 12000, 4340, 0.0438, 30000000),
(24, 'DHC-8 Q400', 2, 2, 600, 2000, 1425, 1300, 80, 6520, 2160, 0.027, 25000000),
(25, 'Bombardier CRJ-200', 2, 2, 780, 3100, 1920, 1480, 50, 8000, 2180, 0.0436, 20000000),
(26, 'Saab 2000', 2, 2, 665, 2870, 1250, 1000, 50, 5300, 1750, 0.035, 15000000),
(27, 'ATR 42', 2, 2, 556, 1325, 1100, 970, 50, 5000, 1260, 0.02625, 10000000);

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `countryid` bigint(20) UNSIGNED NOT NULL,
  `managerid` bigint(20) UNSIGNED NOT NULL,
  `cash` bigint(20) NOT NULL DEFAULT '10000000',
  PRIMARY KEY (`id`),
  KEY `countryid` (`countryid`),
  KEY `managerid` (`managerid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `name`, `countryid`, `managerid`, `cash`) VALUES
(1, 'Air Demo', 3, 1, 10000000);

-- --------------------------------------------------------

--
-- Structure de la table `company_airplane`
--

DROP TABLE IF EXISTS `company_airplane`;
CREATE TABLE IF NOT EXISTS `company_airplane` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `companyid` bigint(20) UNSIGNED NOT NULL,
  `airplaneid` bigint(20) UNSIGNED NOT NULL,
  `serial` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `locationid` bigint(20) UNSIGNED DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `latitutde` decimal(9,6) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `airplaneid` (`airplaneid`),
  KEY `companyid` (`companyid`,`airplaneid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `company_airplane`
--

INSERT INTO `company_airplane` (`id`, `companyid`, `airplaneid`, `serial`, `available`, `locationid`, `longitude`, `latitutde`, `created`) VALUES
(1, 1, 27, '1-27-9580759650', 1, NULL, NULL, NULL, '2022-05-09 11:33:16');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Allemagne'),
(2, 'Royaume-Uni'),
(3, 'Belgique'),
(4, 'France'),
(5, 'Pays-Bas'),
(6, 'Italie'),
(7, 'USA'),
(8, 'Russie'),
(9, 'Japon'),
(10, 'Chine'),
(11, 'Espagne'),
(12, 'Turquie'),
(13, 'Irlande'),
(14, 'Autriche'),
(15, 'Suisse'),
(16, 'Portugal'),
(17, 'Danemark'),
(18, 'Norvège'),
(19, 'Suède'),
(20, 'Grèce'),
(21, 'Finlande'),
(22, 'Pologne'),
(23, 'Tchéquie'),
(24, 'Hongrie'),
(25, 'Roumanie');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `countryid` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coordinate` (`longitude`,`latitude`),
  KEY `country` (`countryid`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id`, `name`, `longitude`, `latitude`, `countryid`) VALUES
(1, 'Bruxelles', '4.484500', '50.887900', 3),
(2, 'Liège', '5.443000', '50.622500', 3),
(3, 'Paris - Charles de Gaulle', '2.548800', '48.996000', 4),
(4, 'London Stansted', '0.235000', '51.885000', 2),
(5, 'London Heathrow', '-0.461400', '51.465100', 2),
(6, 'London City', '0.055278', '51.505278', 2),
(7, 'Berlin Brandenburg', '13.503600', '52.353400', 1),
(8, 'Berlin Tegel', '13.288000', '52.547500', 1),
(9, 'Amsterdam Schiphol', '4.761200', '52.295000', 5),
(10, 'Frankfurt Main', '8.559700', '50.018800', 1),
(11, 'Atlanta Hartsfield-Jackson ', '-84.427900', '33.622100', 7),
(12, 'Chicago O\'Hare', '-87.904400', '41.963100', 7),
(13, 'Tokyo Haneda', '139.779700', '35.535000', 9),
(14, 'New York - JFK', '-73.778700', '40.623900', 7),
(15, 'Roma Fiumicino', '12.251100', '41.791300', 6),
(16, 'Běijīng Shǒudū', '116.584200', '40.063900', 10),
(17, 'Shànghǎi Pǔdōng', '121.805400', '31.124700', 10),
(18, 'Guǎngzhōu Báiyún', '113.298600', '23.373800', 10),
(19, 'München \"Franz Josef Strauß\"', '11.782200', '48.338900', 1),
(20, 'Madrid Barajas', '-3.560300', '40.471500', 11),
(21, 'Barcelona El Prat', '2.078500', '41.280900', 11),
(22, 'Paris Orly', '2.359300', '48.711400', 4),
(23, 'Nice', '7.214600', '43.650000', 4),
(24, 'Lyon', '5.081200', '45.710500', 4),
(25, 'Marseille', '5.215100', '43.421000', 4),
(26, 'Moskva Cheremetievo', '37.416700', '55.955000', 8),
(27, 'London Gatwick', '-0.190200', '51.134600', 2),
(28, 'Istanbul', '28.771100', '41.266500', 12),
(29, 'Dublin', '-6.255300', '53.419800', 13),
(30, 'Wien', '16.569400', '48.097300', 14),
(31, 'Zürich', '8.548700', '47.444800', 15),
(32, 'Lisboa', '-9.135100', '38.760500', 16),
(33, 'Manchester', '-2.274900', '53.341500', 2),
(34, 'Milano Malpensa', '8.724500', '45.612600', 6),
(35, 'Chéngdū shuāngliú', '103.947100', '30.559900', 10),
(36, 'Dallas-Fort Worth', '-97.038100', '32.879000', 7);

-- --------------------------------------------------------

--
-- Structure de la table `location_runway`
--

DROP TABLE IF EXISTS `location_runway`;
CREATE TABLE IF NOT EXISTS `location_runway` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `locationid` bigint(20) UNSIGNED NOT NULL,
  `runwayid` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `runwayid` (`runwayid`),
  KEY `locationid` (`locationid`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `location_runway`
--

INSERT INTO `location_runway` (`id`, `locationid`, `runwayid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 4, 9),
(10, 5, 10),
(11, 5, 11),
(12, 6, 12),
(13, 8, 13),
(14, 8, 14),
(15, 7, 15),
(16, 7, 16),
(17, 9, 17),
(18, 9, 18),
(19, 9, 19),
(20, 9, 20),
(21, 10, 21),
(22, 10, 22),
(23, 10, 23),
(24, 11, 24),
(25, 11, 25),
(26, 11, 26),
(27, 11, 27),
(28, 12, 28),
(29, 12, 29),
(30, 12, 30),
(31, 12, 31),
(32, 13, 32),
(33, 13, 33),
(34, 13, 34),
(35, 14, 35),
(36, 14, 36),
(37, 15, 37),
(38, 15, 38),
(39, 16, 39),
(40, 16, 40),
(41, 17, 41),
(42, 17, 42),
(43, 18, 43),
(44, 18, 44),
(45, 19, 45),
(46, 19, 46),
(47, 20, 47),
(48, 20, 48),
(49, 21, 49),
(50, 21, 50),
(51, 22, 51),
(52, 22, 52),
(53, 23, 53),
(54, 23, 54),
(55, 24, 55),
(56, 24, 56),
(57, 25, 57),
(58, 25, 58),
(59, 26, 59),
(60, 26, 60),
(61, 27, 61),
(62, 27, 62),
(63, 28, 63),
(64, 28, 64),
(65, 29, 65),
(66, 29, 66),
(67, 30, 67),
(68, 30, 68),
(69, 31, 69),
(70, 31, 70),
(71, 32, 71),
(72, 32, 72),
(73, 33, 73),
(74, 33, 74),
(75, 34, 75),
(76, 34, 76),
(77, 35, 77),
(78, 35, 78),
(79, 36, 79),
(80, 36, 80);

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `errorcode` smallint(5) UNSIGNED DEFAULT NULL,
  `errormsg` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `line` smallint(5) UNSIGNED NOT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'client'),
(4, 'guest');

-- --------------------------------------------------------

--
-- Structure de la table `runway`
--

DROP TABLE IF EXISTS `runway`;
CREATE TABLE IF NOT EXISTS `runway` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `length` smallint(5) UNSIGNED NOT NULL,
  `directionL` tinyint(3) UNSIGNED NOT NULL,
  `directionR` tinyint(3) UNSIGNED NOT NULL,
  `surface` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `surface` (`surface`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `runway`
--

INSERT INTO `runway` (`id`, `length`, `directionL`, `directionR`, `surface`) VALUES
(1, 3638, 7, 25, 1),
(2, 3211, 25, 7, 1),
(3, 3690, 22, 4, 1),
(4, 2340, 4, 22, 1),
(5, 2700, 9, 27, 3),
(6, 4200, 27, 9, 3),
(7, 4215, 8, 26, 3),
(8, 2700, 26, 8, 3),
(9, 3048, 23, 5, 3),
(10, 3902, 9, 27, 1),
(11, 3658, 27, 9, 1),
(12, 1508, 9, 27, 2),
(13, 2428, 26, 8, 1),
(14, 3023, 8, 26, 1),
(15, 3600, 7, 25, 2),
(16, 4000, 25, 7, 2),
(17, 3800, 36, 18, 3),
(18, 3500, 6, 24, 3),
(19, 3453, 9, 27, 3),
(20, 3400, 18, 36, 3),
(21, 4000, 25, 7, 1),
(22, 4000, 18, 36, 2),
(23, 4000, 7, 25, 1),
(24, 2743, 27, 9, 3),
(25, 3624, 9, 27, 3),
(26, 3048, 26, 8, 3),
(27, 2743, 8, 26, 3),
(28, 3962, 10, 28, 3),
(29, 2952, 15, 33, 1),
(30, 2286, 4, 22, 1),
(31, 2286, 9, 27, 2),
(32, 3000, 34, 16, 3),
(33, 2500, 4, 22, 3),
(34, 2500, 5, 23, 3),
(35, 3460, 4, 22, 3),
(36, 4442, 31, 13, 3),
(37, 3309, 7, 25, 1),
(38, 3900, 34, 16, 1),
(39, 3800, 18, 36, 1),
(40, 3200, 36, 18, 1),
(41, 3800, 34, 16, 2),
(42, 4000, 17, 35, 2),
(43, 3600, 2, 20, 2),
(44, 3800, 20, 2, 2),
(45, 4000, 26, 8, 1),
(46, 4000, 8, 26, 1),
(47, 4350, 36, 18, 3),
(48, 4130, 14, 32, 3),
(49, 3350, 7, 25, 1),
(50, 2660, 25, 7, 1),
(51, 3650, 6, 24, 3),
(52, 3320, 7, 25, 3),
(53, 2960, 22, 4, 3),
(54, 2570, 4, 22, 3),
(55, 4000, 35, 17, 3),
(56, 2670, 17, 35, 3),
(57, 3500, 13, 31, 3),
(58, 2370, 31, 13, 3),
(59, 3700, 24, 6, 2),
(60, 3550, 6, 24, 2),
(61, 3300, 26, 8, 1),
(62, 2565, 8, 26, 1),
(63, 4100, 17, 35, 1),
(64, 3750, 34, 16, 1),
(65, 2635, 10, 28, 2),
(66, 2070, 16, 34, 1),
(67, 3600, 16, 34, 1),
(68, 3500, 11, 29, 1),
(69, 3700, 16, 34, 2),
(70, 3300, 14, 32, 2),
(71, 3800, 3, 21, 1),
(72, 2400, 17, 35, 1),
(73, 3050, 5, 23, 1),
(74, 3050, 23, 5, 1),
(75, 3915, 17, 35, 1),
(76, 3915, 35, 17, 1),
(77, 3600, 20, 2, 3),
(78, 3600, 2, 20, 2),
(79, 4085, 35, 17, 1),
(80, 4084, 18, 36, 1);

-- --------------------------------------------------------

--
-- Structure de la table `surface`
--

DROP TABLE IF EXISTS `surface`;
CREATE TABLE IF NOT EXISTS `surface` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `surface`
--

INSERT INTO `surface` (`id`, `name`) VALUES
(1, 'asphalte'),
(2, 'béton'),
(3, 'béton bitumineux'),
(4, 'hydrocarbone');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `lastlogin`, `created`, `modified`, `status`) VALUES
(1, 'admin', '$2y$10$t9QSin6YL23mL9Y05AcGZeDdn6S.cNduwVfplYSFU9jxdOiih3.P6', 'test@iepscf-namur.be', '2022-05-10 15:49:46', '2022-05-09 06:42:53', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `roleid` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`,`roleid`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `userid`, `roleid`) VALUES
(1, 1, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `airline`
--
ALTER TABLE `airline`
  ADD CONSTRAINT `airline_ibfk_1` FOREIGN KEY (`airplaneid`) REFERENCES `company_airplane` (`id`),
  ADD CONSTRAINT `airline_ibfk_2` FOREIGN KEY (`startid`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `airline_ibfk_3` FOREIGN KEY (`destinationid`) REFERENCES `location` (`id`);

--
-- Contraintes pour la table `airline_reservation`
--
ALTER TABLE `airline_reservation`
  ADD CONSTRAINT `airline_reservation_ibfk_1` FOREIGN KEY (`airlineid`) REFERENCES `airline` (`id`),
  ADD CONSTRAINT `airline_reservation_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`countryid`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `company_ibfk_2` FOREIGN KEY (`managerid`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `company_airplane`
--
ALTER TABLE `company_airplane`
  ADD CONSTRAINT `company_airplane_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `company_airplane_ibfk_2` FOREIGN KEY (`airplaneid`) REFERENCES `airplane` (`id`);

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`countryid`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `location_runway`
--
ALTER TABLE `location_runway`
  ADD CONSTRAINT `location_runway_ibfk_1` FOREIGN KEY (`runwayid`) REFERENCES `runway` (`id`),
  ADD CONSTRAINT `location_runway_ibfk_2` FOREIGN KEY (`locationid`) REFERENCES `location` (`id`);

--
-- Contraintes pour la table `runway`
--
ALTER TABLE `runway`
  ADD CONSTRAINT `runway_ibfk_1` FOREIGN KEY (`surface`) REFERENCES `surface` (`id`);

--
-- Contraintes pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
