--
-- Base de données : `pjf_macandcheese`
--

DROP DATABASE IF EXISTS pjf_macnchese;
CREATE DATABASE IF NOT EXISTS pjf_macnchese;
USE pjf_macnchese;

-- --------------------------------------------------------
--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `NoUtilisateur` int NOT NULL AUTO_INCREMENT,
  `Courriel` varchar(50) DEFAULT NULL,
  `MotDePasse` varchar(15) DEFAULT NULL,
  `Creation` datetime DEFAULT NULL,
  `NbConnexions` int DEFAULT NULL,
  `Statut` int DEFAULT NULL,
  `NoEmpl` int DEFAULT NULL,
  `Nom` varchar(25) DEFAULT NULL,
  `Prenom` varchar(20) DEFAULT NULL,
  `NoTelMaison` varchar(15) DEFAULT NULL,
  `NoTelTravail` varchar(21) DEFAULT NULL,
  `NoTelCellulaire` varchar(15) DEFAULT NULL,
  `Modification` datetime DEFAULT NULL,
  `AutresInfos` varchar(50) DEFAULT NULL,
  `CouleurProfil` varchar(10) DEFAULT "#e66465",
  PRIMARY KEY (`NoUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Structure de la table `connexions`
--

DROP TABLE IF EXISTS `connexions`;
CREATE TABLE IF NOT EXISTS `connexions` (
  `NoConnexion` int NOT NULL AUTO_INCREMENT,
  `NoUtilisateur` int NOT NULL,
  `Connexion` datetime DEFAULT NULL,
  `Deconnexion` datetime DEFAULT NULL,
  PRIMARY KEY (`NoConnexion`),
  CONSTRAINT `FK_NoUtilisateur_Connexions` FOREIGN KEY (`NoUtilisateur`) REFERENCES `utilisateurs` (`NoUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `NoCategorie` int NOT NULL AUTO_INCREMENT,
  `Description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`NoCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `NoAnnonce` int NOT NULL AUTO_INCREMENT,
  `NoUtilisateur` int NOT NULL,
  `Parution` datetime DEFAULT NULL,
  `Categorie` int NOT NULL,
  `DescriptionAbregee` varchar(50) DEFAULT NULL,
  `DescriptionComplete` varchar(250) DEFAULT NULL,
  `Prix` numeric(15,2) DEFAULT NULL,
  `Photo` varchar(50) DEFAULT NULL,
  `MiseAJour` datetime DEFAULT NULL,
  `Etat` int DEFAULT NULL,
  PRIMARY KEY (`NoAnnonce`),
  CONSTRAINT `FK_NoUtilisateur_Annonces` FOREIGN KEY (`NoUtilisateur`) REFERENCES `utilisateurs` (`NoUtilisateur`),
  CONSTRAINT `Categorie` FOREIGN KEY (`Categorie`) REFERENCES `categories` (`NoCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
