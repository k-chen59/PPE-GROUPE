-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 05 Juin 2017 à 16:58
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bddagrur2`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `NumAdh` varchar(25) NOT NULL,
  `Dateadh` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `certification`
--

CREATE TABLE `certification` (
  `IDCertif` varchar(25) NOT NULL,
  `DateCertif` date DEFAULT NULL,
  `NumAdh` varchar(25) DEFAULT NULL,
  `NumProduc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `NumClient` int(11) NOT NULL,
  `Nom` varchar(25) DEFAULT NULL,
  `Adresse` varchar(25) DEFAULT NULL,
  `NomRespAchat` varchar(25) DEFAULT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`NumClient`, `Nom`, `Adresse`, `NomRespAchat`, `pseudo`, `mail`, `motdepasse`) VALUES
(1, 'Mounia', 'rue bourdonnaye', 'Mounia', 'moon', 'moon@hotmail.fr', 'winx'),
(2, 'Morad', 'rue kjhjnhl', 'Morad', 'momo', 'momo@hotmail.fr', 'mimolette'),
(3, 'Kevin', 'rue hbvp', 'Kevin', 'keke', 'keke@hotmail.fr', 'keke'),
(4, 'Axel', 'rue kfjbgejfek', 'Axel', 'Axel', 'axel@hotmail.fr', 'axel');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `NumCommande` int(11) NOT NULL,
  `DateEnvoi` date DEFAULT NULL,
  `Client` varchar(25) DEFAULT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `QteComm` varchar(25) DEFAULT NULL,
  `DateCondition` date DEFAULT NULL,
  `NumClient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`NumCommande`, `DateEnvoi`, `Client`, `Type`, `QteComm`, `DateCondition`, `NumClient`) VALUES
(1, '2017-06-30', 'Mounia', 'Sachet', '2', '2017-06-08', 1),
(2, '2017-06-16', 'Kevin', 'Filet', '1', '2017-06-02', 3);

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

CREATE TABLE `commander` (
  `NumCommande` int(11) NOT NULL,
  `idLotProd` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `idCommune` varchar(25) NOT NULL,
  `Lieu` varchar(25) DEFAULT NULL,
  `ControleAOC` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commune`
--

INSERT INTO `commune` (`idCommune`, `Lieu`, `ControleAOC`) VALUES
('1', 'Lille', 1),
('2', 'Lille', 3);

--
-- Déclencheurs `commune`
--
DELIMITER $$
CREATE TRIGGER `triggercontroleAOC` BEFORE UPDATE ON `commune` FOR EACH ROW BEGIN
    IF NEW.ControleAOC IS NOT NULL       AND NEW.ControleAOC != '0'           AND NEW.ControleAOC != '1'             THEN
        SET NEW.ControleAOC = NULL;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `conditionnement`
--

CREATE TABLE `conditionnement` (
  `IDCond` varchar(25) NOT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `Poids` int(11) DEFAULT NULL,
  `Quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `conditionnement`
--

INSERT INTO `conditionnement` (`IDCond`, `Type`, `Poids`, `Quantite`) VALUES
('1', 'Sachet', 700, 1);

--
-- Déclencheurs `conditionnement`
--
DELIMITER $$
CREATE TRIGGER `verifpoids` BEFORE UPDATE ON `conditionnement` FOR EACH ROW BEGIN

    IF NEW.Poids IS NOT NULL   
    AND NEW.Poids != '250g'       
    AND NEW.Poids != '500g'           
    AND NEW.Poids != '1kg'

      THEN

        SET NEW.Poids = NULL;

    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `espaceadmin`
--

CREATE TABLE `espaceadmin` (
  `ID` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `mail` int(11) NOT NULL,
  `mdp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `espaceclient`
--

CREATE TABLE `espaceclient` (
  `IDClient` int(11) NOT NULL,
  `NomClient` varchar(255) NOT NULL,
  `PrenomClient` varchar(255) NOT NULL,
  `AdresseClient` varchar(255) NOT NULL,
  `NomRespAchat` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `espaceclient`
--

INSERT INTO `espaceclient` (`IDClient`, `NomClient`, `PrenomClient`, `AdresseClient`, `NomRespAchat`, `pseudo`, `mail`, `motdepasse`) VALUES
(1, 'gyhugy', 'iughuhgoi', 'iughiohgio', 'hgiughio', 'ab', 'ab@hotmail.fr', 'a9993e364706816aba3e25717850c26c9cd0d89d'),
(2, 'Benjana', 'Mounia', '46 rue gal bourdonnaye', 'Libelulle', 'mounia.b', 'mounia.benj@gmail.com', 'ef6a7c2b2a6b842f5043696cd8debf645ce116c0'),
(3, 'test', 'test', 'test', 'test', 'test', 'test@test.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

-- --------------------------------------------------------

--
-- Structure de la table `espacefournisseur`
--

CREATE TABLE `espacefournisseur` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `NomSte` varchar(255) NOT NULL,
  `AdresseSte` varchar(255) NOT NULL,
  `PrenRespProd` varchar(255) NOT NULL,
  `NomRespProd` varchar(255) NOT NULL,
  `date_insertion` datetime DEFAULT NULL,
  `utilisateur_insertion` varchar(20) DEFAULT NULL,
  `date_modification` datetime DEFAULT NULL,
  `utilisateur_modification` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `espacefournisseur`
--

INSERT INTO `espacefournisseur` (`ID`, `pseudo`, `mail`, `motdepasse`, `Nom`, `Prenom`, `NomSte`, `AdresseSte`, `PrenRespProd`, `NomRespProd`, `date_insertion`, `utilisateur_insertion`, `date_modification`, `utilisateur_modification`) VALUES
(1, 'moon', 'moon@hotmail.fr', '2912e0f7453547edcc36df0c9eb3a7e146e98f10', '', '', '', '', '', '', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(2, 'moonxxii', 'mimoon@hotmail.fr', '8b79208eaad75bb3f810f0114a5a9e0369fe6f0d', 'BENJ', 'Moon', 'BENJI', '46 rue du gal', 'BENJ', 'MOON', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(3, 'axel', 'axel@hotmail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Verbrouck', 'Axel', 'GRIEZOU', '7 rue griezmann', 'GRIEZMANN', 'Antoine', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(4, 'morad', 'morad@hotmail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Atrari', 'Morad', 'MORAD', '6 rue de dormir', 'CHEN', 'Kevin', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(5, 'kevin', 'kevin@hotmail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Chen', 'Kevin', 'MEDUSE', '5 rue de la meduse', 'BENJANA', 'Mounia', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(6, 'durant.r', 'durant@hotmail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Durant', 'Robert', 'ROBERT', '8 rue de la khjbvhj', 'BENJANA', 'Mounia', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(7, 'hb', '123@hotmail.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hfbgeh', 'hghugo', 'ho', 'gho', 'gbh', 'g', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(8, '123', '1234@hotmail.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'jhcfr', 'jhbgbk', 'hgbhjg', 'hjgvhjbbk', 'hjgbjk', 'hjvkvh', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(9, 'robert.dupuis', 'robert@hotmail.fr', '12e9293ec6b30c7fa8a0926af42807e929c1684f', 'DUPUIS', 'Robert', 'MANGER', '90 rue de la miam', 'DUPUIS', 'Robert', '2017-06-03 12:42:32', 'Test', '2017-06-03 12:42:32', 'Test'),
(10, 'test', 'test@test.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Test', 'Test', 'Test', 'Test', 'TEST', 'TEST', '2017-06-04 12:59:02', 'root@localhost', '2017-06-04 12:59:02', 'root@localhost');

--
-- Déclencheurs `espacefournisseur`
--
DELIMITER $$
CREATE TRIGGER `before_insert_espfourn` BEFORE INSERT ON `espacefournisseur` FOR EACH ROW BEGIN
    SET NEW.date_insertion = NOW();
    SET NEW.utilisateur_insertion = CURRENT_USER();
    SET NEW.date_modification = NOW();
    SET NEW.utilisateur_modification = CURRENT_USER();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_espfourn` BEFORE UPDATE ON `espacefournisseur` FOR EACH ROW BEGIN
    SET NEW.date_modification = NOW();
    SET NEW.utilisateur_modification = CURRENT_USER();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `etre`
--

CREATE TABLE `etre` (
  `Numliv` int(11) NOT NULL,
  `idLotProd` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `Numliv` int(11) NOT NULL,
  `dateliv` date DEFAULT NULL,
  `typeproduit` varchar(25) DEFAULT NULL,
  `qtelivree` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lot_production`
--

CREATE TABLE `lot_production` (
  `idLotProd` varchar(25) NOT NULL,
  `Calibre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `memoriser`
--

CREATE TABLE `memoriser` (
  `NumCommande` int(11) NOT NULL,
  `IDCond` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `producteur`
--

CREATE TABLE `producteur` (
  `NumProduc` int(11) NOT NULL,
  `Nom` varchar(25) DEFAULT NULL,
  `AdresseSte` varchar(25) DEFAULT NULL,
  `NomRespProd` varchar(25) DEFAULT NULL,
  `PrenRespProd` varchar(25) DEFAULT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `producteur`
--

INSERT INTO `producteur` (`NumProduc`, `Nom`, `AdresseSte`, `NomRespProd`, `PrenRespProd`, `pseudo`, `mail`, `motdepasse`) VALUES
(1, 'Morad', 'DORMIR', 'Atrari', 'Morad', '', '', ''),
(2, 'Axel', 'JOUER', 'Verbrouck', 'Axel', '', '', ''),
(3, 'Kevin', 'KYOTO', 'Chen', 'Kevin', '', '', ''),
(4, 'Mounia', 'FILMMESPIEDS', 'Benjana', 'Mounia', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `variete`
--

CREATE TABLE `variete` (
  `idVariete` varchar(25) NOT NULL,
  `TypeVariete` varchar(25) DEFAULT NULL,
  `ControleAOC` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `verger`
--

CREATE TABLE `verger` (
  `IDVerger` varchar(25) NOT NULL,
  `VarieteNoix` varchar(25) DEFAULT NULL,
  `Superficie` int(11) DEFAULT NULL,
  `Nbarbres` int(11) DEFAULT NULL,
  `NumProduc` int(11) DEFAULT NULL,
  `idCommune` varchar(25) DEFAULT NULL,
  `idVariete` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`NumAdh`);

--
-- Index pour la table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`IDCertif`),
  ADD KEY `FK_CERTIFICATION_NumAdh` (`NumAdh`),
  ADD KEY `FK_CERTIFICATION_NumProduc` (`NumProduc`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`NumClient`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`NumCommande`),
  ADD KEY `FK_COMMANDE_NumClient` (`NumClient`);

--
-- Index pour la table `commander`
--
ALTER TABLE `commander`
  ADD PRIMARY KEY (`NumCommande`,`idLotProd`),
  ADD KEY `FK_commander_idLotProd` (`idLotProd`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`idCommune`);

--
-- Index pour la table `conditionnement`
--
ALTER TABLE `conditionnement`
  ADD PRIMARY KEY (`IDCond`);

--
-- Index pour la table `espaceclient`
--
ALTER TABLE `espaceclient`
  ADD PRIMARY KEY (`IDClient`);

--
-- Index pour la table `espacefournisseur`
--
ALTER TABLE `espacefournisseur`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `etre`
--
ALTER TABLE `etre`
  ADD PRIMARY KEY (`Numliv`,`idLotProd`),
  ADD KEY `FK_Etre_idLotProd` (`idLotProd`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`Numliv`);

--
-- Index pour la table `lot_production`
--
ALTER TABLE `lot_production`
  ADD PRIMARY KEY (`idLotProd`);

--
-- Index pour la table `memoriser`
--
ALTER TABLE `memoriser`
  ADD PRIMARY KEY (`NumCommande`,`IDCond`),
  ADD KEY `FK_memoriser_IDCond` (`IDCond`);

--
-- Index pour la table `producteur`
--
ALTER TABLE `producteur`
  ADD PRIMARY KEY (`NumProduc`);

--
-- Index pour la table `variete`
--
ALTER TABLE `variete`
  ADD PRIMARY KEY (`idVariete`);

--
-- Index pour la table `verger`
--
ALTER TABLE `verger`
  ADD PRIMARY KEY (`IDVerger`),
  ADD KEY `FK_VERGER_NumProduc` (`NumProduc`),
  ADD KEY `FK_VERGER_idCommune` (`idCommune`),
  ADD KEY `FK_VERGER_idVariete` (`idVariete`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `espaceclient`
--
ALTER TABLE `espaceclient`
  MODIFY `IDClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `espacefournisseur`
--
ALTER TABLE `espacefournisseur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `certification`
--
ALTER TABLE `certification`
  ADD CONSTRAINT `FK_CERTIFICATION_NumAdh` FOREIGN KEY (`NumAdh`) REFERENCES `adherent` (`NumAdh`),
  ADD CONSTRAINT `FK_CERTIFICATION_NumProduc` FOREIGN KEY (`NumProduc`) REFERENCES `producteur` (`NumProduc`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_COMMANDE_NumClient` FOREIGN KEY (`NumClient`) REFERENCES `client` (`NumClient`);

--
-- Contraintes pour la table `commander`
--
ALTER TABLE `commander`
  ADD CONSTRAINT `FK_commander_NumCommande` FOREIGN KEY (`NumCommande`) REFERENCES `commande` (`NumCommande`),
  ADD CONSTRAINT `FK_commander_idLotProd` FOREIGN KEY (`idLotProd`) REFERENCES `lot_production` (`idLotProd`);

--
-- Contraintes pour la table `etre`
--
ALTER TABLE `etre`
  ADD CONSTRAINT `FK_Etre_Numliv` FOREIGN KEY (`Numliv`) REFERENCES `livraison` (`Numliv`),
  ADD CONSTRAINT `FK_Etre_idLotProd` FOREIGN KEY (`idLotProd`) REFERENCES `lot_production` (`idLotProd`);

--
-- Contraintes pour la table `memoriser`
--
ALTER TABLE `memoriser`
  ADD CONSTRAINT `FK_memoriser_IDCond` FOREIGN KEY (`IDCond`) REFERENCES `conditionnement` (`IDCond`),
  ADD CONSTRAINT `FK_memoriser_NumCommande` FOREIGN KEY (`NumCommande`) REFERENCES `commande` (`NumCommande`);

--
-- Contraintes pour la table `verger`
--
ALTER TABLE `verger`
  ADD CONSTRAINT `FK_VERGER_NumProduc` FOREIGN KEY (`NumProduc`) REFERENCES `producteur` (`NumProduc`),
  ADD CONSTRAINT `FK_VERGER_idCommune` FOREIGN KEY (`idCommune`) REFERENCES `commune` (`idCommune`),
  ADD CONSTRAINT `FK_VERGER_idVariete` FOREIGN KEY (`idVariete`) REFERENCES `variete` (`idVariete`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
