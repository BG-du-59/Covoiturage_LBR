-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 08 juin 2022 à 06:06
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_personne` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` char(10) NOT NULL,
  `passw` varchar(40) NOT NULL,
  `role_` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_personne`, `nom`, `prenom`, `email`, `phone`, `passw`, `role_`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 'festivalier'),
(2, '', '', '', '', 'z', 'festivalier'),
(3, 'w', 'w', 'w', 'w', 'w', 'festivalier'),
(4, 'p', 'p', 'p', 'p', 'p', 'festivalier'),
(5, 'eeee', 'eee', 'e', 'e', 'e', 'festivalier'),
(6, 'zen', 'chen', 'igo', '09', '08', 'festivalier'),
(7, 'xx', 'xxx', 'x', 'x', 'x', 'festivalier'),
(8, 'vv', 'vvvv', 'vvv', 'vv', 'v', 'festivalier');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_personne` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_personne`, `id_trajet`) VALUES
(1, 10),
(3, 11);

-- --------------------------------------------------------

--
-- Structure de la table `edition`
--

CREATE TABLE `edition` (
  `num_edition` int(11) NOT NULL,
  `date_heure_debut` varchar(40) NOT NULL,
  `date_heure_fin` varchar(40) NOT NULL,
  `lieu` varchar(40) NOT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `edition`
--

INSERT INTO `edition` (`num_edition`, `date_heure_debut`, `date_heure_fin`, `lieu`, `description`) VALUES
(2020, '00', '00', 'lille', 'ok'),
(2019, '2', '3', 'paris', 'a');

-- --------------------------------------------------------

--
-- Structure de la table `rejoindre`
--

CREATE TABLE `rejoindre` (
  `id_personne` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rejoindre`
--

INSERT INTO `rejoindre` (`id_personne`, `id_trajet`, `etat`) VALUES
(11, 24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL,
  `type_` varchar(10) NOT NULL,
  `description` text,
  `date_heure_depart` varchar(40) NOT NULL,
  `date_heure_arrivee` varchar(40) NOT NULL,
  `adresse` varchar(70) NOT NULL,
  `num_edition` int(11) NOT NULL,
  `date_creation` varchar(40) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`id_trajet`, `type_`, `description`, `date_heure_depart`, `date_heure_arrivee`, `adresse`, `num_edition`, `date_creation`, `etat`) VALUES
(24, 'retour', '', '2022-06-15', 'calcul api heure arrive', 'lille', 2020, '08-06-22', 0),
(10, 'retour', 'desc', '2022-06-08', 'okok', 'creil', 2020, '1222', 1),
(13, 'aller', '1111', '2022-06-03', '2022-06-10', '11', 2020, '08-06-22', 0);

-- --------------------------------------------------------

--
-- Structure de la table `trajet_conducteur`
--

CREATE TABLE `trajet_conducteur` (
  `id_personne` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL,
  `prix` varchar(10) NOT NULL,
  `nb_passager` int(11) NOT NULL,
  `telephone_visible` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trajet_conducteur`
--

INSERT INTO `trajet_conducteur` (`id_personne`, `id_trajet`, `prix`, `nb_passager`, `telephone_visible`) VALUES
(8, 13, '1', 1, 'non'),
(1, 24, '2', 2, 'oui');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_personne`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD KEY `id_personne` (`id_personne`),
  ADD KEY `id_trajet` (`id_trajet`);

--
-- Index pour la table `edition`
--
ALTER TABLE `edition`
  ADD PRIMARY KEY (`num_edition`);

--
-- Index pour la table `rejoindre`
--
ALTER TABLE `rejoindre`
  ADD KEY `id_personne` (`id_personne`),
  ADD KEY `id_trajet` (`id_trajet`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `num_edition` (`num_edition`);

--
-- Index pour la table `trajet_conducteur`
--
ALTER TABLE `trajet_conducteur`
  ADD KEY `id_personne` (`id_personne`),
  ADD KEY `id_trajet` (`id_trajet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_personne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
