-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 04 mars 2025 à 10:10
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Ensitech`
--

-- --------------------------------------------------------

--
-- Structure de la table `JOURNASTAGE_CLASSE`
--

CREATE TABLE `JOURNASTAGE_CLASSE` (
  `id_classe` int NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `JOURNASTAGE_COMPTE_RENDU`
--

CREATE TABLE `JOURNASTAGE_COMPTE_RENDU` (
  `id_compte_rendu` int NOT NULL,
  `titre` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `PJ` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_etudiant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `JOURNASTAGE_ENSEIGNER`
--

CREATE TABLE `JOURNASTAGE_ENSEIGNER` (
  `id_professeur` int NOT NULL,
  `id_classe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `JOURNASTAGE_UTILISATEUR`
--

CREATE TABLE `JOURNASTAGE_UTILISATEUR` (
  `id_utilisateur` int NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL,
  `date_naissance` date NOT NULL,
  `id_classe` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `JOURNASTAGE_CLASSE`
--
ALTER TABLE `JOURNASTAGE_CLASSE`
  ADD PRIMARY KEY (`id_classe`);

--
-- Index pour la table `JOURNASTAGE_COMPTE_RENDU`
--
ALTER TABLE `JOURNASTAGE_COMPTE_RENDU`
  ADD PRIMARY KEY (`id_compte_rendu`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Index pour la table `JOURNASTAGE_ENSEIGNER`
--
ALTER TABLE `JOURNASTAGE_ENSEIGNER`
  ADD PRIMARY KEY (`id_professeur`,`id_classe`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Index pour la table `JOURNASTAGE_UTILISATEUR`
--
ALTER TABLE `JOURNASTAGE_UTILISATEUR`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_classe` (`id_classe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `JOURNASTAGE_CLASSE`
--
ALTER TABLE `JOURNASTAGE_CLASSE`
  MODIFY `id_classe` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `JOURNASTAGE_COMPTE_RENDU`
--
ALTER TABLE `JOURNASTAGE_COMPTE_RENDU`
  MODIFY `id_compte_rendu` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `JOURNASTAGE_UTILISATEUR`
--
ALTER TABLE `JOURNASTAGE_UTILISATEUR`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `JOURNASTAGE_COMPTE_RENDU`
--
ALTER TABLE `JOURNASTAGE_COMPTE_RENDU`
  ADD CONSTRAINT `journastage_compte_rendu_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `JOURNASTAGE_UTILISATEUR` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `JOURNASTAGE_ENSEIGNER`
--
ALTER TABLE `JOURNASTAGE_ENSEIGNER`
  ADD CONSTRAINT `journastage_enseigner_ibfk_1` FOREIGN KEY (`id_professeur`) REFERENCES `JOURNASTAGE_UTILISATEUR` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `journastage_enseigner_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `JOURNASTAGE_CLASSE` (`id_classe`) ON DELETE CASCADE;

--
-- Contraintes pour la table `JOURNASTAGE_UTILISATEUR`
--
ALTER TABLE `JOURNASTAGE_UTILISATEUR`
  ADD CONSTRAINT `journastage_utilisateur_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `JOURNASTAGE_CLASSE` (`id_classe`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
