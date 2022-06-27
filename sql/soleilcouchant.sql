-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 avr. 2022 à 14:04
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `soleilcouchant`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `categories` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categories`) VALUES
(1, 'appareils'),
(2, 'thés'),
(3, 'ustensiles'),
(4, 'linge');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_commentaire` text NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_commentaire` (`id_commentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `contenu_commentaire`) VALUES
(1, 'contenu'),
(2, 'contenu2'),
(3, 'contenu3');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produits` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` varchar(255) NOT NULL,
  `prix_produit` int(11) NOT NULL,
  `stock_produit` int(11) NOT NULL,
  `date_depot` datetime NOT NULL,
  `image_produit` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `vendeur_id` int(11) NOT NULL,
  `commentaire_id` int(11) NOT NULL,
  PRIMARY KEY (`id_produits`),
  KEY `categorie_id` (`categorie_id`),
  KEY `fournisseur_id` (`vendeur_id`),
  KEY `commentaire_id` (`commentaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produits`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`, `categorie_id`, `vendeur_id`, `commentaire_id`) VALUES
(1, 'Soupe d\'orties', 'soupe crémeuse pour dormir avec l estomac leger', 18, 29, '2021-11-08 11:40:49', '', 1, 3, 1),
(2, 'Sieste et assoupissement', 'thé en vrac ', 12, 75, '2022-04-11 09:43:03', '', 3, 2, 1),
(3, 'masseur aquatique electrique', 'masseur de orthopedique', 56, 41, '2022-04-11 09:44:14', '', 3, 4, 2),
(4, 'Systeme d infusion', 'appareil a infusion', 12, 75, '2021-10-05 11:45:08', '', 2, 4, 1),
(5, 'plaid des monts', 'plaid avec un graphisme de chiens de traineau', 12, 24, '2015-08-18 11:52:38', '', 1, 2, 2),
(6, 'tasse a thé', 'tasse decoree de plantes multiples', 32, 20, '2021-01-20 09:52:38', '', 3, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vendeurs`
--

DROP TABLE IF EXISTS `vendeurs`;
CREATE TABLE IF NOT EXISTS `vendeurs` (
  `id_vendeurs` int(11) NOT NULL AUTO_INCREMENT,
  `nom_vendeur` varchar(255) NOT NULL,
  `prenom_vendeur` varchar(255) NOT NULL,
  `email_vendeur` varchar(255) NOT NULL,
  `logo_vendeur` varchar(255) NOT NULL,
  `adresse_vendeur` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `telephone_vendeur` int(11) NOT NULL,
  PRIMARY KEY (`id_vendeurs`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeurs`
--

INSERT INTO `vendeurs` (`id_vendeurs`, `nom_vendeur`, `prenom_vendeur`, `email_vendeur`, `logo_vendeur`, `adresse_vendeur`, `code_postal`, `telephone_vendeur`) VALUES
(1, 'Richard', 'Prince', 'delu@gmail.com', '', '5 rue Desmoines, Fontaine', 38600, 6598678),
(2, 'Killiki', 'Emilia', 'mimideluxe@gmail.Com', '', '10 place philis de la charce, echirolles', 38130, 623447789),
(3, 'grand', 'micheline', 'berthe@gmail.com', '', '89 rue fils d\'aimée trinne, grenoble', 38100, 659867845),
(4, 'stonks', 'ernest', 'ernestopatronius@aol.fr', '', '85 avenu du rire en boite, meylans', 38240, 623476789);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`vendeur_id`) REFERENCES `vendeurs` (`id_vendeurs`),
  ADD CONSTRAINT `produits_ibfk_3` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`id_commentaire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
