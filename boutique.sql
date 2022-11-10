-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 nov. 2022 à 17:34
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
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
(1, 'Nature'),
(2, 'Technologie'),
(3, 'Voyage');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text,
  `prix` float NOT NULL,
  `qte` int(11) NOT NULL,
  `FK_id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `FK_id_categorie` (`FK_id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `description`, `prix`, `qte`, `FK_id_categorie`) VALUES
(1, 'Telecommande', 'Utile pour changer de chaine par exemple', 10, 23, 2),
(7, 'test', 'un être humain avec un QI de 80', 12, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `nom`) VALUES
(1, 'utilisateur'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mdp` text NOT NULL,
  `FK_id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_id_role` (`FK_id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `mdp`, `FK_id_role`) VALUES
(1, 'Rémy', 'Treflest', 'mrtreflestremy@outlook.com', '$2y$10$3jer1x4edqOte/2Vt2kGWefMs9ZJbGqbCBoqX0A72zENneBBm8Ciq', 2);

--
-- Déclencheurs `utilisateur`
--
DROP TRIGGER IF EXISTS `easter_egg`;
DELIMITER $$
CREATE TRIGGER `easter_egg` BEFORE INSERT ON `utilisateur` FOR EACH ROW BEGIN
 	 IF (UPPER(NEW.prenom) = "YOANN" AND UPPER(NEW.nom) = "COUALAN") ||(UPPER(NEW.prenom) = "DAMIEN" AND UPPER(NEW.nom) = "CHAUVEAU") ||(UPPER(NEW.prenom) = "CORENTIN" AND UPPER(NEW.nom) = "MAILLE") THEN 
     	INSERT INTO role (nom) VALUE ('GHOST');
     	SET NEW.FK_id_role = (SELECT id_role FROM role WHERE nom = "GHOST");
     ELSE
     	IF (EXISTS (SELECT id_role FROM role WHERE UPPER(nom) = 'GHOST')) THEN DELETE FROM role WHERE UPPER(nom) = "GHOST";
        END IF;
     END IF;
END
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`FK_id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`FK_id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
