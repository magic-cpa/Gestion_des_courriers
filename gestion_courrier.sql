-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Janvier 2023 à 00:21
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gestion_courrier`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `id_agent` int(11) NOT NULL AUTO_INCREMENT,
  `login_agents` varchar(100) NOT NULL,
  `password_agents` varchar(100) NOT NULL,
  `num_agent` varchar(100) NOT NULL,
  `nom_agent` varchar(100) NOT NULL,
  `tel_agent` int(8) NOT NULL,
  `mail_agent` varchar(30) NOT NULL,
  `statut` varchar(11) NOT NULL,
  PRIMARY KEY (`id_agent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `agent`
--

INSERT INTO `agent` (`id_agent`, `login_agents`, `password_agents`, `num_agent`, `nom_agent`, `tel_agent`, `mail_agent`, `statut`) VALUES
(1, 'fidele', 'fidele', 'fidele', '', 0, '', 'valide'),
(2, 'admin', 'admin', 'admin', '', 0, '', 'valide'),
(3, 'gbedji', ' gbedji', 'gbedji', 'gbedji', 45678, 'fidele@GMAIL.co', 'valide'),
(4, 'gbedji', ' gbedji', 'gbedji', 'gbedji', 45678, 'fidele@GMAIL.co', 'non valide'),
(5, 'APPO', ' APPO', 'aPP', 'gbedji', 309, 'gbedji@gmail.com', 'non valide'),
(6, 'APPO', ' APPO', 'aPP', 'gbedji', 309, 'gbedji@gmail.com', 'non valide');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `fullname` varchar(100) NOT NULL,
  `phoneno` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `cdate` varchar(30) NOT NULL,
  `approval` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `destinataire`
--

CREATE TABLE IF NOT EXISTS `destinataire` (
  `id_destinataire` int(100) NOT NULL AUTO_INCREMENT,
  `Nom_destiantaire` varchar(300) NOT NULL,
  `Adresse` varchar(300) NOT NULL,
  PRIMARY KEY (`id_destinataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `destinataire`
--

INSERT INTO `destinataire` (`id_destinataire`, `Nom_destiantaire`, `Adresse`) VALUES
(1, 'PHENIX', 'COTNOU'),
(2, 'OSE', 'PARAKOU'),
(3, 'PHENIX', 'COTNOU'),
(4, 'OSE', 'PARAKOU');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(300) NOT NULL,
  `user_name` varchar(300) NOT NULL,
  `password_user` varchar(30) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_prenom`, `user_name`, `password_user`) VALUES
(1, 'fidele', 'fidele', 'fidele'),
(2, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `_courrier`
--

CREATE TABLE IF NOT EXISTS `_courrier` (
  `num_courrier` varchar(100) NOT NULL,
  `objet_courrier` varchar(300) NOT NULL,
  `date_courrier` date NOT NULL,
  `ref_courrier` varchar(30) NOT NULL,
  `type_courrier` varchar(100) NOT NULL,
  `date_time_act` varchar(300) NOT NULL,
  `id_courrier` int(11) NOT NULL AUTO_INCREMENT,
  `expe` varchar(400) NOT NULL,
  `desti` varchar(300) NOT NULL,
  `desc` text NOT NULL,
  `nom_usager` varchar(400) NOT NULL,
  `titre` varchar(300) NOT NULL,
  `nom` varchar(300) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `type_carte` varchar(30) NOT NULL,
  `num_carte` varchar(45) NOT NULL,
  `tel` int(100) NOT NULL,
  `odjet` text NOT NULL,
  `adress_fichier` varchar(300) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_courrier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `_courrier`
--

INSERT INTO `_courrier` (`num_courrier`, `objet_courrier`, `date_courrier`, `ref_courrier`, `type_courrier`, `date_time_act`, `id_courrier`, `expe`, `desti`, `desc`, `nom_usager`, `titre`, `nom`, `prenom`, `email`, `type_carte`, `num_carte`, `tel`, `odjet`, `adress_fichier`, `statut`) VALUES
('', 'Lettre', '0000-00-00', 'REF 4539589', 'Entrant', '', 7, 'FIDELE', 'COTNOU', 'Lettre', 'Gbedjie', 'Dr.', 'WINSOU', 'GBEDJI FIDELE', 'fidelewinsou661@gmail.com', 'Sri Lankan', '464758456858', 77887987, 'Lettre', 'License.pdf', 0),
('', 'ContrÃ´le des marchÃ©', '2018-01-23', 'REF 45395B89', 'Entrant', '18-01-23 02:24:38', 8, 'SOGEA', 'PARAKOU', 'ContrÃ´le des marchÃ©', 'usager', 'Mrs.', 'AGBO', 'FERNAND', 'kkk@H', 'Non Sri Lankan ', '574949', 394949848, 'ContrÃ´le des marchÃ©', 'License.pdf', 0),
('', 'Raz', '2018-01-23', 'REF 453767889', 'Sortant Room', '18-01-23 11:21:10', 9, 'SOGEA', 'PARAKOU', 'Raz', 'Gbedjie', 'Dr.', 'DOGBO', 'Phampile', 'fidelewinsou661@gmail.com', 'Non Sri Lankan ', '574949', 0, 'Raz', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `_document`
--

CREATE TABLE IF NOT EXISTS `_document` (
  `id_document` int(11) NOT NULL AUTO_INCREMENT,
  `_document` varchar(400) NOT NULL,
  `reference` varchar(400) NOT NULL,
  PRIMARY KEY (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_service`
--

CREATE TABLE IF NOT EXISTS `_service` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `num_service` varchar(300) NOT NULL,
  `lib_service` varchar(300) NOT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `_service`
--

INSERT INTO `_service` (`id_service`, `num_service`, `lib_service`) VALUES
(1, 'service', 'service'),
(2, 'services', 'service');

-- --------------------------------------------------------

--
-- Structure de la table `_usager`
--

CREATE TABLE IF NOT EXISTS `_usager` (
  `id_usager` int(11) NOT NULL AUTO_INCREMENT,
  `num_usager` varchar(100) NOT NULL,
  `nom_usager` varchar(300) NOT NULL,
  `tel_usager` int(9) NOT NULL,
  `mail_usager` varchar(30) NOT NULL,
  `adresse_usager` varchar(30) NOT NULL,
  PRIMARY KEY (`id_usager`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `_usager`
--

INSERT INTO `_usager` (`id_usager`, `num_usager`, `nom_usager`, `tel_usager`, `mail_usager`, `adresse_usager`) VALUES
(1, '333', 'Gbedjie', 3453, 'fidele@mail.com', 'fiyftghj'),
(2, 'usager', 'usager', 373633, 'fgff@gmail.com', 'fffffffffffff'),
(3, 'usager', 'usager', 373633, 'fgff@gmail.com', 'fffffffffffff');

-- --------------------------------------------------------

--
-- Structure de la table `_usager_service`
--

CREATE TABLE IF NOT EXISTS `_usager_service` (
  `id_usager_service` int(11) NOT NULL,
  `num_service` int(11) NOT NULL,
  `num_usager` int(11) NOT NULL,
  `nom_usager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `_usager_service`
--

INSERT INTO `_usager_service` (`id_usager_service`, `num_service`, `num_usager`, `nom_usager`) VALUES
(0, 1, 1, 1),
(0, 333, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
