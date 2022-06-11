-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2022 at 11:20 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syslogistique`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`fahed23`@`%` PROCEDURE `maintenance_preventive` ()   BEGIN
    DECLARE message varchar(255);
    DECLARE klm int;
    SET message=CONCAT('Vous avez ',total,' Maintenance préventive à venir');
    
    UPDATE vehicule SET vehicule.status="Maintenance préventive" WHERE vehicule.kilometres BETWEEN 8000 AND 10000;
    DELETE FROM notifications where notifications.title = 'Maintenance préventive';
    INSERT INTO `notifications` (`id`, `title`, `content`, `type`, `link`, `time`) VALUES (NULL, 'Maintenance préventive', message, 'Services','/services', current_timestamp());
END$$

CREATE DEFINER=`fahed23`@`%` PROCEDURE `vehicule_enPanne` ()   BEGIN
    DECLARE message varchar(255);
    DECLARE total int; 
    SELECT count(*) into total from vehicule where vehicule.status = "En Panne";
    SET message=concat('Vous avez ',total,' véhicules en panne à venir');
    DELETE FROM notifications where notifications.content = message;
    IF total > 0 THEN
    INSERT INTO `notifications` (`id`, `notif_time`, `title`, `content`, `type`, `link`) VALUES (NULL, current_timestamp(), 'Véhicule en panne', message, 'Vehicule','/vehicule');
    END IF;
END$$

CREATE DEFINER=`fahed23`@`%` PROCEDURE `weekLate` ()   BEGIN
	DECLARE l int;	
    DECLARE v int;
	DECLARE a int;	
    DECLARE message varchar(255);
    DECLARE total int;   
    DECLARE test boolean;
    SELECT count(*) into l from visite_et_assurance where date_leasing  < CURRENT_DATE+7;
    SELECT count(*) into v from visite_et_assurance where date_expVisite  < CURRENT_DATE+7;
    SELECT count(*) into a from visite_et_assurance where date_expAssurance  < CURRENT_DATE+7;
    SET	 total=l+v+a;
    SET message=concat('Vous avez ',total,' rappels de véhicules à venir cette semaine');
    DELETE FROM notifications where notifications.content = message;
    IF total > 0 THEN
    INSERT INTO `notifications` (`id`, `notif_time`, `title`, `content`, `type`, `link`) VALUES (NULL, current_timestamp(), 'Rappel véhicule', message, 'Rappels','/reminders');
    end IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_n` datetime NOT NULL,
  `cin` int NOT NULL,
  `premis` int DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `nom`, `prenom`, `email`, `date_n`, `cin`, `premis`, `role`, `tel`) VALUES
(49, 'vvvv', 'selmi', 'fahed@selmi.com', '2020-05-19 00:00:00', 11393163, 123456, 'test', 55972953),
(50, 'fahed', 'selmi', 'fahed@selmi.com', '2020-05-19 23:05:11', 11393163, 54789625, 'test', 55972953),
(51, 'fahed', 'selmi', 'fahed@selmi.com', '2020-05-19 23:05:11', 11393163, 54789625, 'test', 55972953),
(52, 'fahedb', 'selmi', 'fahed@selmi.com', '2020-05-19 00:00:00', 11393163, 123456, 'test', 55972953);

-- --------------------------------------------------------

--
-- Table structure for table `besoinlogistique`
--

CREATE TABLE `besoinlogistique` (
  `id` int NOT NULL,
  `nom_demendeur` varchar(25) NOT NULL,
  `num_demendeur` varchar(25) NOT NULL,
  `date_b` date NOT NULL,
  `site_dep` varchar(25) NOT NULL,
  `site_des` varchar(25) NOT NULL,
  `etat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `besoinlogistique`
--

INSERT INTO `besoinlogistique` (`id`, `nom_demendeur`, `num_demendeur`, `date_b`, `site_dep`, `site_des`, `etat`) VALUES
(192, 'Anis', '96184791', '2020-04-30', 'Le Bardo', 'La Goulette', 'Vérifié'),
(193, 'mahfoudh', '55972953', '2020-04-23', 'Kairouan', 'Bizerte', 'Vérifié'),
(194, 'nouredine', '55972953', '2020-04-17', 'Tunis', 'Béja', 'Vérifié'),
(195, 'karim', '96184791', '2020-04-17', 'Le Bardo', 'El Maâgoula', 'Vérifié'),
(196, 'Anis', '96184791', '2020-04-30', 'Le Bardo', 'La Goulette', 'Vérifié'),
(197, 'mahfoudh', '55972953', '2020-04-23', 'Kairouan', 'Bizerte', 'Vérifié'),
(198, 'nouredine', '55972953', '2020-04-17', 'Tunis', 'Béja', 'Vérifié'),
(199, '-Select-', '', '2020-04-16', '-Select-', '-Select-', 'Vérifié'),
(200, '-Select-', '', '2020-04-16', '-Select-', '-Select-', 'Vérifié'),
(201, 'karim', '3', '2020-04-23', 'Le Kram', 'Sidi Bou', 'Vérifié'),
(202, 'karim', '3', '2020-04-23', 'Le Kram', 'Sidi Bou', 'Vérifié'),
(203, 'nouredine', '55972953', '2020-05-12', 'Le Kram', 'Le Bardo', 'Vérifié'),
(204, 'karim', '96184791', '2020-05-12', 'Tunis', 'Tunis', 'En Attente'),
(205, 'karim', '96184791', '2020-05-22', 'Le Bardo', 'Tunis', 'En Attente'),
(206, 'mahfoudh', '55972953', '2020-06-03', 'Tunis', 'Le Bardo', 'Vérifié'),
(207, 'mahfoudh', '55972953', '2022-06-17', 'Le Bardo', 'Douar Hicher', 'En Attente');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `num_tel`, `email`, `cin`) VALUES
(3, 'karim', 'jemili', '96184791', 'jemli.jemili@gmail.com', '10248596'),
(4, 'mahfoudh', 'trabelsi', '55972953', 'trabelsi123@gmail.com', '09147874'),
(7, 'Vehicule 1', 'selmi', '55972953', 'fahed.selmi3@gmail.com', '11393163'),
(14, 'fahed', 'selmi', '12345678', 'sss@email.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id_des` int NOT NULL,
  `num_des` varchar(25) NOT NULL,
  `nature` varchar(25) NOT NULL,
  `nb_pers` int NOT NULL,
  `date_dep` date NOT NULL,
  `date_arr` date NOT NULL,
  `id_besoin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id_des`, `num_des`, `nature`, `nb_pers`, `date_dep`, `date_arr`, `id_besoin`) VALUES
(74, '1', 'Achat Billet d\'avion', 3, '2020-04-17', '2020-04-17', 192),
(75, '1', 'Location Voiture', 4, '2020-04-30', '2020-04-30', 192),
(76, '1', 'Transport Peronnel', 2, '2020-04-23', '2020-04-23', 192),
(77, '1', 'Transport Equipement', 3, '2020-04-30', '2020-04-30', 192),
(78, '1', 'Hotel et Restauration', 4, '2020-04-20', '2020-04-20', 192),
(79, '1', 'Achat Billet d\'avion', 4, '2020-04-21', '2020-04-21', 193),
(80, '1', 'Location Voiture', 4, '2020-04-14', '2020-04-14', 193),
(81, '1', 'Transport Peronnel', 3, '2020-04-24', '2020-04-24', 193),
(82, '1', 'Transport Peronnel', 1, '2020-04-16', '2020-04-16', 194),
(83, '1', 'Transport Equipement', 2, '2020-04-17', '2020-04-17', 194),
(84, '1', 'Achat Billet d\'avion', 3, '2020-04-23', '2020-04-23', 194),
(85, '1', 'Transport Equipement', 1, '2020-04-16', '2020-04-16', 195),
(86, '1', '1', 2, '2020-04-10', '2020-04-15', 201),
(87, '1', '1', 2, '2020-04-10', '2020-04-15', 202),
(88, '1', 'HJH', 3, '2020-05-14', '2020-05-14', 203),
(89, '1', 'bbb', 3, '2020-05-14', '2020-05-14', 204),
(90, '1', 'hh', 5, '2020-05-06', '2020-05-06', 205),
(91, '1', 'Transport', 3, '2020-06-13', '2020-06-27', 206);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `vehicule` int DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `vehicule`, `type`) VALUES
(78, 'new_231-0.jpeg', 231, 'new'),
(79, 'new_231-1.jpeg', 231, 'new'),
(80, 'new_231-2.jpeg', 231, 'new'),
(84, 'QRCODE-GOLF 4-216TN7854', 234, 'new'),
(85, 'QRCODE-GOLF 4-216TN7854.png', 235, 'qrcode'),
(86, 'new_235-0.jpeg', 235, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `id` int NOT NULL,
  `phone` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `commentaire` varchar(1000) NOT NULL,
  `vehicule` int NOT NULL,
  `tel` int NOT NULL,
  `kelm` varchar(25) NOT NULL,
  `carroussrie` tinyint(1) NOT NULL,
  `pneu` tinyint(1) NOT NULL,
  `frein` tinyint(1) NOT NULL,
  `fuiteHuile` tinyint(1) NOT NULL,
  `retroviseu` tinyint(1) NOT NULL,
  `feu` tinyint(1) NOT NULL,
  `eauRadiateu` tinyint(1) NOT NULL,
  `niveauhuil` tinyint(1) NOT NULL,
  `roueSecour` tinyint(1) NOT NULL,
  `cri` tinyint(1) NOT NULL,
  `ivmsGp` tinyint(1) NOT NULL,
  `climatiseur` tinyint(1) NOT NULL,
  `proprete` tinyint(1) NOT NULL,
  `boitePharmaci` tinyint(1) NOT NULL,
  `triangleSignal` tinyint(1) NOT NULL,
  `cableRe` tinyint(1) NOT NULL,
  `centure` tinyint(1) NOT NULL,
  `types` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `inspec` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200503234727', '2020-05-03 23:52:40'),
('20200504222741', '2020-05-04 22:29:15'),
('20200521202615', '2020-05-21 20:27:30'),
('20200521205210', '2020-05-21 20:53:05'),
('20200521211050', '2020-05-21 21:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `mpreventive`
--

CREATE TABLE `mpreventive` (
  `id` int NOT NULL,
  `km` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `filtre_huile` tinyint(1) NOT NULL,
  `filtre_gasoil` tinyint(1) NOT NULL,
  `filtre_air` tinyint(1) NOT NULL,
  `huile` tinyint(1) NOT NULL,
  `roue` tinyint(1) NOT NULL,
  `frein` tinyint(1) NOT NULL,
  `chaine` tinyint(1) NOT NULL,
  `visite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mpreventive`
--

INSERT INTO `mpreventive` (`id`, `km`, `filtre_huile`, `filtre_gasoil`, `filtre_air`, `huile`, `roue`, `frein`, `chaine`, `visite`) VALUES
(2, '10000', 0, 0, 0, 0, 0, 0, 0, 0),
(3, '20000', 0, 1, 1, 0, 0, 1, 1, 0),
(4, '150000', 0, 0, 0, 0, 0, 0, 0, 0),
(58, '1000', 1, 1, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `type`, `link`, `time`) VALUES
(130, 'Maintenances préventive', 'Vous avez des Maintenances préventive à venir', 'Services', '{{ path(\'services_index\') }}', '2021-07-06 12:00:57'),
(131, 'Fiche Téchnique', 'Vous avez des Fiches Téchnique à venir', 'Fiche technique', '{{ path(\'suivi_index\') }}', '2021-07-06 12:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `poly_garde_user`
--

CREATE TABLE `poly_garde_user` (
  `id` int NOT NULL,
  `username` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` int NOT NULL,
  `tel` int NOT NULL,
  `image` longblob,
  `signature` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `poly_garde_user`
--

INSERT INTO `poly_garde_user` (`id`, `username`, `roles`, `password`, `nom`, `prenom`, `email`, `cin`, `tel`, `image`, `signature`) VALUES
(8, 'smail_ssm', '[\"ROLE_RACL\"]', '$argon2id$v=19$m=65536,t=4,p=1$TVYyTkFOSHpzdzl3eU9wYQ$9Zn8+T9VbeqyO3qstissldYIZMejMY+RpCWwZ3C7jTM', 'smail', 'mansouri', 'fahed@selmi.com', 11393163, 55972953, NULL, 0x6173736574732f696d616765732f7369676e6174757265732f7369676e2d7261636c2e6a7067),
(9, 'fahed_s', '[\"ROLE_RACL\"]', '$argon2id$v=19$m=65536,t=4,p=1$IEEp6VS1OjZdR5zMva+FhA$T3aW37hPD1ZYcglycpxJBdUezIYEWg7Ub4i64HGq6zs', 'fahed', 'selmi', 'fahed@selmi.com', 11393163, 55972953, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int NOT NULL,
  `v_nom` varchar(255) NOT NULL,
  `vin` varchar(255) NOT NULL,
  `matricule` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `maker` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `nbPlace` int NOT NULL,
  `etat_enreg` varchar(255) NOT NULL,
  `coleur` varchar(255) NOT NULL,
  `type_roue` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `groupe` varchar(255) NOT NULL,
  `ownership` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `kilometres` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`id`, `v_nom`, `vin`, `matricule`, `type`, `annee`, `maker`, `model`, `prix`, `nbPlace`, `etat_enreg`, `coleur`, `type_roue`, `status`, `groupe`, `ownership`, `description`, `kilometres`) VALUES
(226, 'vehicule1000', 'TN1456/20', '216TN7854', 'Car', '2020', 'AMC', 'GOLF 5', '1200', 5, 'QSSFSF', 'Noire', 'FDSFDSF', 'Active', 'Managers', 'Owned', '', '0'),
(227, 'vehicule1000', 'TN1456/20', '216TN7854', 'Car', '2020', 'AMC', 'GOLF 5', '1200', 5, 'QSSFSF', 'Noire', 'FDSFDSF', 'Active', 'Managers', 'Owned', '', '0'),
(228, 'vehicule1000', 'TN1456/20', '216TN7854', 'Car', '2020', 'AMC', 'GOLF 5', '1200', 5, 'QSSFSF', 'Noire', 'FDSFDSF', 'Active', 'Managers', 'Owned', '', '0'),
(229, 'vehicule1000', 'TN1456/20', '216TN7854', 'Car', '2020', 'AMC', 'GOLF 5', '1200', 5, 'QSSFSF', 'Noire', 'FDSFDSF', 'Active', 'Managers', 'Owned', '', '0'),
(230, 'vehicule 205', 'fdsfsd', 'A', 'Motorcycle', '2020', 'Chevrolet', 'GOLF 5', '1200', 5, 'QSSFSF', '45', 'FDSFDSF', 'Active', 'Managers', '45', '', '0'),
(231, 'fahed', 'TN1456/20', '216TN7854', 'Bus', '205', 'Alfa Romeo', 'GOLF 5', '1200', 5, 'QSSFSF', 'xfgdfsgsdfgfgv', '454', 'En Maintenance', 'Managers', 'Owned', '', '8000'),
(233, 'vehicule 20', 'TN1456/20', '216TN7854', 'Car', '2020', 'AMC', 'GOLF 5', '1200', 5, 'QSSFSF', 'SDFGQDG', 'QSFSF', 'Active', 'Managers', 'Owned', '', '18000'),
(234, 'vehicule 25', 'TN1456/20', '216TN7854', 'Bus', '2020', 'AMC', 'GOLF 4', '1200', 3, 'QSSFSF', 'Noire', 'QSFSF', 'Active', 'Managers', '2020', '', '18000'),
(235, 'vehicule 1000', 'TN1456/20', '216TN7854', 'Car', '2020', 'Alfa Romeo', 'GOLF 4', '1200', 3, 'QSSFSF', 'DFDSF', 'FDSFDSF', 'Active', 'Managers', 'Owned', '', '5000');

--
-- Triggers `vehicule`
--
DELIMITER $$
CREATE TRIGGER `mp_trigger` BEFORE UPDATE ON `vehicule` FOR EACH ROW BEGIN
	DECLARE klm int;
    DECLARE titre varchar(255);
    DECLARE message varchar(255);
    DECLARE total int;
    set klm=(SELECT count(*)  from mpreventive WHERE NEW.kilometres BETWEEN mpreventive.km-2000 AND mpreventive.km);
    
    IF klm > 0 THEN
		SET NEW.status="En Maintenance";
        DELETE FROM notifications where notifications.link= "{{ path('services_index') }}";
        SET titre=('Maintenances préventive');
        SET message=('Vous avez des Maintenances préventive à venir');
    	INSERT INTO `notifications` (`id`, `title`, `content`, `type`, `link`, `time`) VALUES (NULL, titre, message, "Services","{{ path('services_index') }}", current_timestamp());
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `visite_et_assurance`
--

CREATE TABLE `visite_et_assurance` (
  `id` int NOT NULL,
  `date_leasing` date NOT NULL,
  `date_expVisite` date NOT NULL,
  `date_expAssurance` date NOT NULL,
  `vehicule` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visite_et_assurance`
--

INSERT INTO `visite_et_assurance` (`id`, `date_leasing`, `date_expVisite`, `date_expAssurance`, `vehicule`) VALUES
(46, '2020-04-16', '2020-08-13', '2020-07-13', 230),
(47, '2020-07-15', '2020-07-15', '2020-07-15', 231),
(49, '2020-05-29', '2020-05-29', '2020-05-29', 233),
(50, '2020-05-29', '2020-05-29', '2020-05-29', 234),
(51, '2020-05-29', '2020-05-29', '2020-05-29', 235);

--
-- Triggers `visite_et_assurance`
--
DELIMITER $$
CREATE TRIGGER `suivi_trigger` BEFORE UPDATE ON `visite_et_assurance` FOR EACH ROW BEGIN
    DECLARE titre varchar(255);
    DECLARE message varchar(255);
    DECLARE total int;
    set total=(SELECT count(*)  from visite_et_assurance WHERE visite_et_assurance.date_leasing < CURRENT_DATE+7 OR visite_et_assurance.date_expVisite < CURRENT_DATE+7 OR visite_et_assurance.date_expAssurance < CURRENT_DATE+7);
    
    IF total > 0 THEN
        DELETE FROM notifications where notifications.link= "{{ path('suivi_index') }}";
        SET titre=('Fiche Téchnique');
        SET message=('Vous avez des Fiches Téchnique à venir');
    	INSERT INTO `notifications` (`id`, `title`, `content`, `type`, `link`, `time`) VALUES (NULL, titre, message, "Fiche technique","{{ path('suivi_index') }}", current_timestamp());
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `besoinlogistique`
--
ALTER TABLE `besoinlogistique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id_des`),
  ADD KEY `id_besoin` (`id_besoin`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_E01FBE6A292FFF1D` (`vehicule`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicule` (`vehicule`),
  ADD KEY `fk_inspec` (`inspec`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mpreventive`
--
ALTER TABLE `mpreventive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poly_garde_user`
--
ALTER TABLE `poly_garde_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6A28A8E5F85E0677` (`username`);

--
-- Indexes for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visite_et_assurance`
--
ALTER TABLE `visite_et_assurance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_3116C33A292FFF1D` (`vehicule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `besoinlogistique`
--
ALTER TABLE `besoinlogistique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
