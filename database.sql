-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 14 avr. 2021 à 11:33
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `enchere`
--

-- --------------------------------------------------------

--
-- Structure de la table `ad`
--

CREATE TABLE `ad` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `brand` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `power` varchar(255) NOT NULL,
  `years` int(11) NOT NULL,
  `description` text,
  `user_win` int(11) DEFAULT NULL,
  `user_creator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ad`
--

INSERT INTO `ad` (`id`, `price`, `end_date`, `brand`, `modele`, `power`, `years`, `description`, `user_win`, `user_creator`) VALUES
(11, 1000, '2021-03-22', 'Renault', 'Clio', '90', 2015, 'Renault clio rouge, bien entretenue', 10, 7),
(12, 1000, '2021-03-10', 'Peugeot', '206', '90', 2016, 'Peugeot 206 grise, bien entretenue', 12, 8),
(13, 1500, '2021-04-10', 'Volkswagen', 'Polo', '110', 2018, 'Volkswagen bleue, bien entretenue', 11, 9),
(14, 1100, '2021-04-28', 'Seat', 'Ibiza', '100', 2018, 'Seat Ibiza noire, bien entretenue', 12, 10),
(15, 1200, '2021-04-24', 'Ford', 'Fiesta', '90', 2009, 'Ford Fiesta grise bien entretenue', 12, 11),
(16, 2000, '2021-04-12', 'Mercedes-Benz', 'Classe A', '190', 2003, 'Classe A blanche, bien entretenue', 8, 12),
(17, 1800, '2021-04-29', 'BMW', 'Serie 1', '190', 2012, 'Serie 1 bleue, bien entretenue', 10, 12),
(18, 1400, '2021-05-02', 'Fiat', 'Panda', '90', 2017, 'Fiat Panda roure, bien entretenue', 9, 10);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`) VALUES
(7, 'Smith', 'John', 'john@smith.fr', '$2y$10$2yYe1DT0lGxwj6zQHYGr.eQ392aq8eUkiVe3XLhOMGBeGGAaakYwi'),
(8, 'Martin', 'Martin', 'martin@martin.fr', '$2y$10$Dg.ZvXXAKp3rqEy5hYs2LOitxypyLaxD7HDjm1YLagCvXisRXjc1e'),
(9, 'Test', 'Jean', 'jean@test.fr', '$2y$10$Igrjd.XGXCdg9f.0K/.whe87j0OiCVSaG7Ysjz2/JZkQ8DL8AOQi2'),
(10, 'Tasse', 'Luc', 'luc@tasse.fr', '$2y$10$YFHYcGbVEzbgwURfJ7ole.Xk0t43.H6n48B7vZlrla0FqYRSKI1Jy'),
(11, 'Car', 'Julie', 'julie@car.fr', '$2y$10$0PHaCeffTdgw07IaF1IiNOCQBXPYtIRJsrWhYDS3T0w71o2KZVgFe'),
(12, 'Seller', 'Marie', 'marie@seller.fr', '$2y$10$KGSfed8kZ8I1HQPhjVhqN.MPGhxvZWVQqXLWmox7/nxpLzvKPOLNq');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ad`
--
ALTER TABLE `ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
