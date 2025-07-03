-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 01 juil. 2025 à 12:10
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `adopteunchien_db`
--
CREATE DATABASE IF NOT EXISTS `adopteunchien_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `adopteunchien_db`;

-- --------------------------------------------------------

--
-- Structure de la table `chiens`
--

DROP TABLE IF EXISTS `chiens`;
CREATE TABLE IF NOT EXISTS `chiens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NOT NULL,
  `age` INT NOT NULL,
  `race` VARCHAR(255) NOT NULL,
  `photo_url` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; -- Collation corrigée ici

--
-- Déchargement des données de la table `chiens`
--

INSERT INTO `chiens` (`id`, `nom`, `age`, `race`, `photo_url`) VALUES
(1, 'Buddy', 3, 'Golden Retriever', 'img/buddy.jpg'),
(2, 'Lucy', 2, 'Labrador', 'img/lucy.jpg'),
(3, 'Max', 5, 'Berger Allemand', 'img/max.jpg'),
(4, 'Daisy', 1, 'Caniche', 'img/daisy.jpg'),
(5, 'Charlie', 4, 'Beagle', 'img/charlie.jpg'),
(6, 'Bella', 2, 'Husky Sibérien', 'img/bella.jpg'),
(7, 'Rocky', 6, 'Boxer', 'img/rocky.jpg'),
(8, 'Mia', 1, 'Chihuahua', 'img/mia.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;