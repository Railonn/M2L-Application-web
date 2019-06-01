-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Mai 2019 à 19:56
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fredi2`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

CREATE TABLE IF NOT EXISTS `adherents` (
  `NUMERO_LICENCE` varchar(25) NOT NULL DEFAULT '0',
  `NUM_CLUB` varchar(10) NOT NULL,
  `SEXE` char(1) DEFAULT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `DATENAIS` date DEFAULT NULL,
  `ADRESSE` varchar(128) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `VILLE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`NUMERO_LICENCE`),
  KEY `FK_ADHERENTS_CLUBS` (`NUM_CLUB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `adherents`
--

INSERT INTO `adherents` (`NUMERO_LICENCE`, `NUM_CLUB`, `SEXE`, `NOM`, `PRENOM`, `DATENAIS`, `ADRESSE`, `CP`, `VILLE`, `EMAIL`) VALUES
('17 05 40 010 121', '1', 'M', 'SILBERT', 'GILLES', '0000-00-00', '2 , grande rue', '54210', 'Azelot', 'SILBERT.GILLES@hotmail.fr'),
('17 05 40 010 254', '1', 'F', 'BILLOT', 'MARIANNE', '0000-00-00', '6, rue de la Sapinière', '54600', 'Villers lès Nancy', 'BILLOT.MARIANNE@hotmail.fr'),
('17 05 40 010 308', '1', 'M', 'BILLOT', 'DIDIER', '0000-00-00', '6, rue de la Sapinière', '54600', 'Villers lès Nancy', 'BILLOT.DIDIER@hotmail.fr'),
('17 05 40 010 309', '1', 'M', 'BECKER', 'ROMAIN', '0000-00-00', '1, rue des Mésanges', '54600', 'Villers lès Nancy', 'BECKER.ROMAIN@hotmail.fr'),
('17 05 40 010 329', '1', 'F', 'BILLOT', 'CLAIRE', '0000-00-00', '6, rue de la Sapinière', '54600', 'Villers lès Nancy', 'BILLOT.CLAIRE@hotmail.fr'),
('17 05 40 010 334', '1', 'F', 'BIACQUEL', 'VERONIQUE', '0000-00-00', '27, rue de Santifontaine', '54000', 'Nancy', 'BIACQUEL.VERONIQUE@hotmail.fr'),
('17 05 40 010 338', '1', 'M', 'GARBILLON', 'YANN', '0000-00-00', '31, avenue de Marron', '54600', 'Villers lès Nancy', 'GARBILLON.YANN@hotmail.fr'),
('17 05 40 010 339', '1', 'M', 'BERBIER', 'THEO', '0000-00-00', '12, rue de Marron', '54600', 'Villers lès Nancy', 'BERBIER.THEO@hotmail.fr'),
('17 05 40 010 340', '1', 'F', 'BERBIER', 'LUCILLE', '0000-00-00', '12, rue de Marron', '54600', 'Villers lès Nancy', 'BERBIER.LUCILLE@hotmail.fr'),
('17 05 40 010 341', '1', 'F', 'HUMERT', 'ISABELLE', '0000-00-00', '4 rue du maréchal Galliéni', '54600', 'Villers lès Nancy', 'HUMERT.ISABELLE@hotmail.fr'),
('17 05 40 010 351', '1', 'M', 'DEPERRIN', 'ARNAUD', '0000-00-00', '40 rue Paul Bert', '54600', 'Villers lès Nancy', 'DEPERRIN.ARNAUD@hotmail.fr'),
('17 05 40 010 353', '1', 'M', 'PERNOT', 'PAUL', '0000-00-00', '6, rue Winston Churchill', '54000', 'Nancy', 'PERNOT.PAUL@hotmail.fr'),
('17 05 40 010 364', '1', 'M', 'LUQUE', 'ETIENNE', '0000-00-00', '1, rue de Normandie', '54500', 'Vandoeuvre', 'LUQUE.ETIENNE@hotmail.fr'),
('17 05 40 010 382', '1', 'F', 'HAGENBACH', 'CLEMENTINE', '0000-00-00', '19, rue de Lavaux', '54520', 'Laxou', 'HAGENBACH.CLEMENTINE@hotmail.fr'),
('17 05 40 010 395', '1', 'M', 'GARBILLON', 'GILLES', '0000-00-00', '31, avenue de Marron', '54600', 'Villers lès nancy', 'GARBILLON.GILLES@hotmail.fr'),
('17 05 40 010 399', '1', 'F', 'BIDELOT', 'BRIGITTE', '0000-00-00', '5, rue des trois épis', '54600', 'Villers lès Nancy', 'BIDELOT.BRIGITTE@hotmail.fr'),
('17 05 40 010 401', '1', 'M', 'LIEVIN', 'NATHAN', '0000-00-00', '42, rue de la commanderie', '54840', 'Sexey les bois', 'LIEVIN.NATHAN@hotmail.fr'),
('17 05 40 010 402', '1', 'M', 'COTIN', 'FLORIAN', '0000-00-00', '14 route de Toul', '54113', 'Blenod les toul', 'COTIN.FLORIAN@hotmail.fr'),
('17 05 40 010 405', '1', 'M', 'TORTEMANN', 'PIERRE', '0000-00-00', '34, rue de Badonviller', '54000', 'Nancy', 'TORTEMANN.PIERRE@hotmail.fr'),
('17 05 40 010 407', '1', 'M', 'BINNET', 'MARIUS', '0000-00-00', '12, rue Edouard Grosjean', '54520', 'Laxou', 'BINNET.MARIUS@hotmail.fr'),
('17 05 40 010 409', '1', 'F', 'DEPRETRE', 'BEATRICE', '0000-00-00', '26, rue du petit étang', '54110', 'Buissoncourt', 'DEPRETRE.BEATRICE@hotmail.fr'),
('17 05 40 010 414', '1', 'M', 'CHERPION', 'UGO', '0000-00-00', '63, rue Français', '54000', 'Nancy', 'CHERPION.UGO@hotmail.fr'),
('17 05 40 010 418', '1', 'F', 'ZUEL', 'STEPHANIE', '0000-00-00', '8, sentier de Saint-Arriant', '54520', 'Laxou', 'ZUEL.STEPHANIE@hotmail.fr'),
('17 05 40 010 419', '1', 'M', 'LANIELLE', 'NICOLAS', '0000-00-00', '10, rue des orchidées', '54600', 'Villers les Nancy', 'LANIELLE.NICOLAS@hotmail.fr'),
('17 05 40 010 420', '1', 'F', 'HASFELD', 'AUXANE', '0000-00-00', '32, allée de lobservatoire', '54520', 'Laxou', 'HASFELD.AUXANE@hotmail.fr'),
('17 05 40 010 428', '1', 'M', 'CHEOLLE', 'NICOLAS', '0000-00-00', '46, rue de labbé Didelot', '54520', 'Laxou', 'CHEOLLE.NICOLAS@hotmail.fr'),
('17 05 40 010 429', '1', 'M', 'LAMOINE', 'GREGOIRE', '0000-00-00', '65, rue de la sivrite', '54600', 'Villers lès Nancy', 'LAMOINE.GREGOIRE@hotmail.fr'),
('17 05 40 010 431', '1', 'M', 'CASTEL', 'TIMOTHE', '0000-00-00', '26, rue de labbé Didelot', '54600', 'Villers lès Nancy', 'CASTEL.TIMOTHE@hotmail.fr'),
('17 05 40 010 432', '1', 'M', 'LAFIEGLON', 'CLEMENT', '0000-00-00', '62, avenue Paul Déroulède', '54600', 'Villers lès Nancy', 'LAFIEGLON.CLEMENT@hotmail.fr'),
('17 05 40 010 437', '1', 'M', 'ZOECKEL', 'MATHIEU', '0000-00-00', '15, rue de la Seille', '54320', 'Maxéville', 'ZOECKEL.MATHIEU@hotmail.fr'),
('17 05 40 010 438', '1', 'M', 'REMILLON', 'ELIOT', '0000-00-00', '3, rue de lEmbanie', '54520', 'Laxou', 'REMILLON.ELIOT@hotmail.fr'),
('17 05 40 010 439', '1', 'M', 'LOTANG', 'CYPRIEN', '0000-00-00', '16, rue de Gerbéviller', '54000', 'Nancy', 'LOTANG.CYPRIEN@hotmail.fr'),
('17 05 40 010 440', '1', 'M', 'CHOUARNO', 'TOM', '0000-00-00', '168, avenue de Boufflers', '54000', 'Nancy', 'CHOUARNO.TOM@hotmail.fr'),
('17 05 40 010 441', '1', 'M', 'CHEVOITINE', 'LOUIS', '0000-00-00', '40, rue de la république', '54320', 'Maxéville', 'CHEVOITINE.LOUIS@hotmail.fr'),
('17 05 40 010 442', '1', 'F', 'BIDELOT', 'JULIE', '0000-00-00', '5, rue des trois épis', '54600', 'Villers lès Nancy', 'BIDELOT.JULIE@hotmail.fr'),
('17 05 40 010 443', '1', 'M', 'BANDILELLA', 'CLEMENT', '1996-10-26', '30, rue Widric 1er', '54600', 'Nancy', 'clement.badilella@hotmail.fr'),
('17 05 40 010 444', '1', 'M', 'CALDI', 'THOMAS', '0000-00-00', '12, rue de Malzéville', '54000', 'Nancy', 'CALDI.THOMAS@hotmail.fr'),
('17 05 40 010 446', '1', 'M', 'DUCRICK', 'AUGUSTIN', '0000-00-00', '31, rue du chanoine Pierron', '54600', 'Villers lès nancy', 'DUCRICK.AUGUSTIN@hotmail.fr'),
('17 05 40 010 447', '1', 'F', 'SILBERT', 'LEA', '0000-00-00', '1, allée du cénacle', '54520', 'Laxou', 'SILBERT.LEA@hotmail.fr'),
('17 05 40 010 448', '1', 'M', 'ZUERO', 'THOMAS', '0000-00-00', 'immeuble Savoie', '54520', 'Laxou', 'ZUERO.THOMAS@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `NUM_CLUB` varchar(10) NOT NULL,
  `NUM_LIGUE` varchar(10) NOT NULL DEFAULT '0',
  `NUMERO_LICENCE` varchar(25) DEFAULT NULL,
  `PSWTRESO` varchar(20) NOT NULL,
  `NOM_CLUB` varchar(128) DEFAULT NULL,
  `VILLE` varchar(50) DEFAULT NULL,
  `CP` varchar(5) DEFAULT NULL,
  `RUE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`NUM_CLUB`),
  KEY `FK_CLUBS_LIGUES` (`NUM_LIGUE`),
  KEY `FK_CLUBS_ADHERENTS` (`NUMERO_LICENCE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `clubs`
--

INSERT INTO `clubs` (`NUM_CLUB`, `NUM_LIGUE`, `NUMERO_LICENCE`, `PSWTRESO`, `NOM_CLUB`, `VILLE`, `CP`, `RUE`) VALUES
('1', '1', '17 05 40 010 121', '1234', 'Salles d''Armes de Villers lès Nancy', 'Nancy', '54600', '1, rue Rodin');

-- --------------------------------------------------------

--
-- Structure de la table `demandeurs`
--

CREATE TABLE IF NOT EXISTS `demandeurs` (
  `ADRESSE_MAIL` varchar(128) NOT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `RUE` varchar(100) DEFAULT NULL,
  `CP` char(5) DEFAULT NULL,
  `VILLE` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL,
  `NUM_RECU` varchar(10) DEFAULT '0',
  PRIMARY KEY (`ADRESSE_MAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `demandeurs`
--

INSERT INTO `demandeurs` (`ADRESSE_MAIL`, `NOM`, `PRENOM`, `RUE`, `CP`, `VILLE`, `PASSWORD`, `NUM_RECU`) VALUES
('loic.desserich@hotmail.com', 'desserich', 'loic', 'la bartuille', '09240', 'montels', '123', '2019-1'),
('r@mail.fr', 'lfo', 'f', 'la bartuille', '09240', 'montels', 'fr', '2019-2'),
('tom.jedusor@hotmail.com', 'Jedusor', 'Tom', '21,DE LA SAUCISSE', '11111', 'OUI', '354', '2019-3');

-- --------------------------------------------------------

--
-- Structure de la table `lien`
--

CREATE TABLE IF NOT EXISTS `lien` (
  `NUMERO_LICENCE` varchar(25) NOT NULL DEFAULT '0',
  `ADRESSE_MAIL` varchar(128) NOT NULL,
  PRIMARY KEY (`NUMERO_LICENCE`,`ADRESSE_MAIL`),
  KEY `FK_LIEN_DEMANDEURS` (`ADRESSE_MAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `lien`
--

INSERT INTO `lien` (`NUMERO_LICENCE`, `ADRESSE_MAIL`) VALUES
('17 05 40 010 308', 'loic.desserich@hotmail.com'),
('17 05 40 010 329', 'loic.desserich@hotmail.com'),
('17 05 40 010 409', 'loic.desserich@hotmail.com'),
('17 05 40 010 414', 'loic.desserich@hotmail.com'),
('17 05 40 010 418', 'loic.desserich@hotmail.com'),
('17 05 40 010 419', 'r@mail.fr'),
('17 05 40 010 420', 'r@mail.fr'),
('17 05 40 010 254', 'tom.jedusor@hotmail.com'),
('17 05 40 010 308', 'tom.jedusor@hotmail.com'),
('17 05 40 010 309', 'tom.jedusor@hotmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `lignes_frais`
--

CREATE TABLE IF NOT EXISTS `lignes_frais` (
  `ADRESSE_MAIL` varchar(128) NOT NULL,
  `DATE_FRAIS` date NOT NULL,
  `ID_MOTIF` bigint(2) DEFAULT '1',
  `TRAJET` varchar(50) DEFAULT NULL,
  `KM` bigint(4) DEFAULT '0',
  `COUT_PEAGE` decimal(8,2) DEFAULT '0.00',
  `COUT_REPAS` decimal(8,2) DEFAULT '0.00',
  `COUT_HEBERGEMENT` decimal(8,2) DEFAULT '0.00',
  `KM_VALIDE` bigint(4) DEFAULT '0',
  `PEAGE_VALIDE` decimal(8,2) DEFAULT '0.00',
  `REPAS_VALIDE` decimal(8,2) DEFAULT '0.00',
  `HEBERGEMENT_VALIDE` decimal(8,2) DEFAULT '0.00',
  `LIGNEVALIDE` tinyint(1) NOT NULL DEFAULT '0',
  `NUM_CLUB` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ADRESSE_MAIL`,`DATE_FRAIS`),
  KEY `FK_LIGNES_FRAIS_MOTIFS` (`ID_MOTIF`),
  KEY `NUM_CLUB` (`NUM_CLUB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `lignes_frais`
--

INSERT INTO `lignes_frais` (`ADRESSE_MAIL`, `DATE_FRAIS`, `ID_MOTIF`, `TRAJET`, `KM`, `COUT_PEAGE`, `COUT_REPAS`, `COUT_HEBERGEMENT`, `KM_VALIDE`, `PEAGE_VALIDE`, `REPAS_VALIDE`, `HEBERGEMENT_VALIDE`, `LIGNEVALIDE`, `NUM_CLUB`) VALUES
('loic.desserich@hotmail.com', '2019-04-11', 3, 'foix-montels', 10, '0.00', '5.00', '0.00', 10, '0.00', '5.00', '0.00', 1, '1'),
('tom.jedusor@hotmail.com', '2019-04-10', 3, 'paris-toulouse', 150, '30.45', '0.00', '0.00', 117, '30.00', '0.00', '0.00', 1, '1'),
('tom.jedusor@hotmail.com', '2019-04-11', 1, 'toulouse-paris', 342, '45.50', '100.65', '134.05', 340, '45.00', '100.00', '130.00', 1, '1'),
('tom.jedusor@hotmail.com', '2019-04-12', 2, 'montels-foix', 15, '0.00', '0.00', '0.00', 15, '0.00', '0.00', '0.00', 0, '1');

-- --------------------------------------------------------

--
-- Structure de la table `ligues`
--

CREATE TABLE IF NOT EXISTS `ligues` (
  `NUM_LIGUE` varchar(10) NOT NULL DEFAULT '0',
  `NOM` varchar(100) DEFAULT NULL,
  `SIGLE` varchar(10) DEFAULT NULL,
  `PRESIDENT` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`NUM_LIGUE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `ligues`
--

INSERT INTO `ligues` (`NUM_LIGUE`, `NOM`, `SIGLE`, `PRESIDENT`) VALUES
('1', 'Ligue d''escrime', 'ESC', 'François Kurri'),
('2', 'Ligue de tennis', 'LDT', 'elon musk');

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

CREATE TABLE IF NOT EXISTS `motifs` (
  `ID_MOTIF` bigint(2) NOT NULL,
  `LIBELLE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_MOTIF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `motifs`
--

INSERT INTO `motifs` (`ID_MOTIF`, `LIBELLE`) VALUES
(1, 'Réunion'),
(2, 'Compétition régionale'),
(3, 'Compétition  nationale'),
(4, 'Compétition internationnale'),
(5, 'Stage');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adherents`
--
ALTER TABLE `adherents`
  ADD CONSTRAINT `FK_ADHERENTS_CLUBS` FOREIGN KEY (`NUM_CLUB`) REFERENCES `clubs` (`NUM_CLUB`);

--
-- Contraintes pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `FK_CLUBS_ADHERENTS` FOREIGN KEY (`NUMERO_LICENCE`) REFERENCES `adherents` (`NUMERO_LICENCE`),
  ADD CONSTRAINT `FK_CLUBS_LIGUES` FOREIGN KEY (`NUM_LIGUE`) REFERENCES `ligues` (`NUM_LIGUE`);

--
-- Contraintes pour la table `lien`
--
ALTER TABLE `lien`
  ADD CONSTRAINT `FK_LIEN_ADHERENTS` FOREIGN KEY (`NUMERO_LICENCE`) REFERENCES `adherents` (`NUMERO_LICENCE`),
  ADD CONSTRAINT `FK_LIEN_DEMANDEURS` FOREIGN KEY (`ADRESSE_MAIL`) REFERENCES `demandeurs` (`ADRESSE_MAIL`);

--
-- Contraintes pour la table `lignes_frais`
--
ALTER TABLE `lignes_frais`
  ADD CONSTRAINT `FK_LIGNES_FRAIS_CLUB` FOREIGN KEY (`NUM_CLUB`) REFERENCES `clubs` (`NUM_CLUB`),
  ADD CONSTRAINT `FK_LIGNES_FRAIS_DEMANDEURS` FOREIGN KEY (`ADRESSE_MAIL`) REFERENCES `demandeurs` (`ADRESSE_MAIL`),
  ADD CONSTRAINT `FK_LIGNES_FRAIS_MOTIFS` FOREIGN KEY (`ID_MOTIF`) REFERENCES `motifs` (`ID_MOTIF`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
