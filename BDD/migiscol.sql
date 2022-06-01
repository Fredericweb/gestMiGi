-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 09 mai 2022 à 16:38
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `migiscol`
--

-- --------------------------------------------------------

--
-- Structure de la table `anneescol`
--

DROP TABLE IF EXISTS `anneescol`;
CREATE TABLE IF NOT EXISTS `anneescol` (
  `id_an` int(11) NOT NULL AUTO_INCREMENT,
  `id_etud` int(11) NOT NULL,
  `id_niveau` int(11) NOT NULL,
  `codClass` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_an`),
  UNIQUE KEY `id_etud` (`id_etud`) USING BTREE,
  KEY `id_niveau` (`id_niveau`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `anneescol`
--

INSERT INTO `anneescol` (`id_an`, `id_etud`, `id_niveau`, `codClass`) VALUES
(74, 269, 3, 3230),
(75, 270, 3, 3230),
(77, 271, 3, 3230),
(79, 272, 4, 4230),
(80, 273, 3, 3231),
(82, 274, 1, 1230),
(83, 275, 4, 4230),
(85, 276, 5, 5230),
(86, 277, 1, 1230),
(88, 278, 2, 2230);

-- --------------------------------------------------------

--
-- Structure de la table `compte_etud`
--

DROP TABLE IF EXISTS `compte_etud`;
CREATE TABLE IF NOT EXISTS `compte_etud` (
  `idCompt` int(11) NOT NULL AUTO_INCREMENT,
  `id_etud` int(11) NOT NULL,
  `rest_pay` int(11) NOT NULL,
  PRIMARY KEY (`idCompt`),
  KEY `id_etud` (`id_etud`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte_etud`
--

INSERT INTO `compte_etud` (`idCompt`, `id_etud`, `rest_pay`) VALUES
(5, 269, 610000),
(6, 270, 910000),
(7, 271, 910000),
(8, 272, 1000000),
(9, 273, 910000),
(10, 274, 720000),
(11, 275, 1050000),
(12, 276, 1250000),
(13, 277, 720000),
(14, 278, 840000);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id_etat` int(11) NOT NULL AUTO_INCREMENT,
  `libel_etat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id_etat`, `libel_etat`) VALUES
(1, 'En cours'),
(2, 'En attente'),
(3, 'Admis'),
(4, 'redoublant'),
(5, 'Autorise');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id_etud` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etud` varchar(255) NOT NULL,
  `Prenom_etud` varchar(255) NOT NULL,
  `Dat_naiss` varchar(255) NOT NULL,
  `lieu_naiss` varchar(255) NOT NULL,
  `nationalite` varchar(255) NOT NULL,
  `id_niveau` int(11) NOT NULL,
  `id_sexe` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `tel_parent` varchar(11) NOT NULL,
  `anneescol` varchar(225) NOT NULL,
  PRIMARY KEY (`id_etud`),
  KEY `id_niveau` (`id_niveau`),
  KEY `id_sexe` (`id_sexe`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id_etud`, `nom_etud`, `Prenom_etud`, `Dat_naiss`, `lieu_naiss`, `nationalite`, `id_niveau`, `id_sexe`, `photo`, `email`, `tel`, `tel_parent`, `anneescol`) VALUES
(269, 'Tigoli', 'eyhua ange', '1999-10-19 ', 'cocody', 'ivoirienne', 3, 1, 'face3.jpg', 'asteroblack1@gmail.com', '0142994455', '07070707', '22-23'),
(270, 'kone', 'maria', '2022-04-20 ', 'cocody', 'ivoirienne', 3, 2, 'face4.jpg', 'kamy342@gmail.com', '0142994455', '07070707', '22-23'),
(271, 'tigoli', 'olivier', '2022-03-31 ', 'cocody', 'ivoirienne', 3, 1, 'face3.jpg', 'olivier@gmail.com', '0142994455', '07070707', '22-23'),
(272, 'assemien', 'junior', '2022-04-15 ', 'cocody', 'ivoirienne', 4, 1, 'face5.jpg', 'assemien1@gmail.com', '0142994455', '07070707', '22-23'),
(273, 'tigoli', 'michael', '2022-04-23 ', 'cocody', 'ivoirienne', 3, 1, 'face12.jpg', 'asteroblack1@gmail.com', '0142994455', '07070707', '22-23'),
(274, 'sasaki', 'saya', '2022-04-15 ', 'cocody', 'ivoirienne', 1, 1, 'face23.jpg', 'nunushop1@gmail.com', '0142994455', '07070707', '22-23'),
(275, 'sagbou', 'nidas', '2022-04-07 ', 'cocody', 'ivoirienne', 4, 1, 'face21.jpg', 'asteroblack1@gmail.com', '0142994455', '07070707', '22-23'),
(276, 'Tigoli', 'zowblazo', '2022-04-15 ', 'cocody', 'ivoirienne', 5, 3, 'face8.jpg', 'asteroblack1@gmail.com', '0142994455', '07070707', '22-23'),
(277, 'tigolie', 'frederique', '2022-04-01 ', 'cocody', 'ivoirienne', 1, 1, 'face19.jpg', 'asteroblack1@gmail.com', '0142994455', '07070707', '22-23'),
(278, 'tigoli', 'simplice', '2022-04-03 ', 'cocody', 'ivoirienne', 2, 1, 'face14.jpg', 'asteroblack1@gmail.com', '0142994455', '07070707', '22-23');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
CREATE TABLE IF NOT EXISTS `niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `libel_niveau` varchar(255) NOT NULL,
  PRIMARY KEY (`id_niveau`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id_niveau`, `libel_niveau`) VALUES
(1, 'Licence1'),
(2, 'Licence2'),
(3, 'Licence3'),
(4, 'Master1'),
(5, 'Master2');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `libel_role` varchar(255) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `libel_role`) VALUES
(1, 'admin'),
(2, 'secretaire'),
(3, 'comptable');

-- --------------------------------------------------------

--
-- Structure de la table `scolarite`
--

DROP TABLE IF EXISTS `scolarite`;
CREATE TABLE IF NOT EXISTS `scolarite` (
  `id_scol` int(11) NOT NULL AUTO_INCREMENT,
  `id_niveau` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  PRIMARY KEY (`id_scol`),
  KEY `id_niveau` (`id_niveau`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `scolarite`
--

INSERT INTO `scolarite` (`id_scol`, `id_niveau`, `montant`) VALUES
(1, 1, 720000),
(2, 2, 840000),
(3, 3, 910000),
(4, 4, 1050000),
(5, 5, 1250000);

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

DROP TABLE IF EXISTS `sexe`;
CREATE TABLE IF NOT EXISTS `sexe` (
  `id_sex` int(11) NOT NULL AUTO_INCREMENT,
  `libel_sex` varchar(255) NOT NULL,
  PRIMARY KEY (`id_sex`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id_sex`, `libel_sex`) VALUES
(1, 'Masculin'),
(2, 'feminin'),
(3, 'non binaire');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_sexe` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_role` (`id_role`),
  KEY `id_sexe` (`id_sexe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `id_role`, `login`, `password`, `id_sexe`) VALUES
(1, 'tigoli', 'frederic', 1, 'admin', '123456', 1),
(2, 'Kouadio', 'amoin', 2, 'Kouadioa', '123', 2),
(3, 'collins', 'misha', 3, 'collinsm', '123456', 1);

-- --------------------------------------------------------

--
-- Structure de la table `versement`
--

DROP TABLE IF EXISTS `versement`;
CREATE TABLE IF NOT EXISTS `versement` (
  `id_vers` int(11) NOT NULL AUTO_INCREMENT,
  `id_etud` int(11) NOT NULL,
  `date` varchar(225) NOT NULL,
  `montant_vers` int(11) NOT NULL,
  `rest` int(11) NOT NULL,
  `num_vers` int(11) NOT NULL,
  PRIMARY KEY (`id_vers`),
  KEY `id_etud` (`id_etud`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `versement`
--

INSERT INTO `versement` (`id_vers`, `id_etud`, `date`, `montant_vers`, `rest`, `num_vers`) VALUES
(38, 269, '2022-04-29 19:55:24', 300000, 610000, 7440),
(39, 272, '2022-04-30 16:59:07', 50000, 1000000, 6817);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `anneescol`
--
ALTER TABLE `anneescol`
  ADD CONSTRAINT `anneescol_ibfk_1` FOREIGN KEY (`id_etud`) REFERENCES `etudiants` (`id_etud`),
  ADD CONSTRAINT `anneescol_ibfk_2` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id_niveau`);

--
-- Contraintes pour la table `compte_etud`
--
ALTER TABLE `compte_etud`
  ADD CONSTRAINT `compte_etud_ibfk_2` FOREIGN KEY (`id_etud`) REFERENCES `etudiants` (`id_etud`);

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id_niveau`),
  ADD CONSTRAINT `etudiants_ibfk_2` FOREIGN KEY (`id_sexe`) REFERENCES `sexe` (`id_sex`);

--
-- Contraintes pour la table `scolarite`
--
ALTER TABLE `scolarite`
  ADD CONSTRAINT `scolarite_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id_niveau`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_sexe`) REFERENCES `sexe` (`id_sex`);

--
-- Contraintes pour la table `versement`
--
ALTER TABLE `versement`
  ADD CONSTRAINT `versement_ibfk_1` FOREIGN KEY (`id_etud`) REFERENCES `etudiants` (`id_etud`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
