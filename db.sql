-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 19 juin 2024 à 17:53
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parcelle_maisons_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

CREATE TABLE `communes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commune_libelle` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'actif',
  `ville_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `communes`
--

INSERT INTO `communes` (`id`, `commune_libelle`, `status`, `ville_id`, `created_at`, `updated_at`) VALUES
(69, 'Kinshasa', 'actif', 1, NULL, NULL),
(70, 'Barumbu', 'actif', 1, NULL, NULL),
(71, 'Bumbu', 'actif', 1, NULL, NULL),
(72, 'Gombe', 'actif', 1, NULL, NULL),
(73, 'Kalamu', 'actif', 1, NULL, NULL),
(74, 'Kasa-Vubu', 'actif', 1, NULL, NULL),
(75, 'Kimbanseke', 'actif', 1, NULL, NULL),
(76, 'Kinshasa', 'actif', 1, NULL, NULL),
(77, 'Kintambo', 'actif', 1, NULL, NULL),
(78, 'Kisenso', 'actif', 1, NULL, NULL),
(79, 'Lemba', 'actif', 1, NULL, NULL),
(80, 'Limete', 'actif', 1, NULL, NULL),
(81, 'Lingwala', 'actif', 1, NULL, NULL),
(82, 'Makala', 'actif', 1, NULL, NULL),
(83, 'Maluku', 'actif', 1, NULL, NULL),
(84, 'Masina', 'actif', 1, NULL, NULL),
(85, 'Matete', 'actif', 1, NULL, NULL),
(86, 'Mont Ngafula', 'actif', 1, NULL, NULL),
(87, 'Ndjili', 'actif', 1, NULL, NULL),
(88, 'Ngaba', 'actif', 1, NULL, NULL),
(89, 'Ngaliema', 'actif', 1, NULL, NULL),
(90, 'Ngiri-Ngiri', 'actif', 1, NULL, NULL),
(91, 'Nsele', 'actif', 1, NULL, NULL),
(92, 'Selembao', 'actif', 1, NULL, NULL),
(93, 'Bandalungwa', 'actif', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `locataires`
--

CREATE TABLE `locataires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `nip_locataire` varchar(255) NOT NULL,
  `maison_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `maison_locations`
--

CREATE TABLE `maison_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_usage` enum('Commerciale','Habitation') NOT NULL,
  `description_activite` text DEFAULT NULL,
  `caracteristiques` varchar(255) NOT NULL,
  `montant_loyer` double(8,2) NOT NULL,
  `montant_loyer_devise` varchar(255) NOT NULL DEFAULT 'CDF',
  `contrat_bail` varchar(255) NOT NULL DEFAULT 'non',
  `duree_occupation` int(11) NOT NULL,
  `duree_occupation_unite` varchar(255) NOT NULL,
  `parcelle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `maison_locations`
--

INSERT INTO `maison_locations` (`id`, `type_usage`, `description_activite`, `caracteristiques`, `montant_loyer`, `montant_loyer_devise`, `contrat_bail`, `duree_occupation`, `duree_occupation_unite`, `parcelle_id`, `created_at`, `updated_at`) VALUES
(1, 'Commerciale', 'Boutique et salon de coiffure', 'Local', 200.00, 'USD', 'oui', 2, 'Mois', 1, '2024-06-19 14:45:01', '2024-06-19 14:45:01');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_29_115908_create_provinces_table', 1),
(6, '2024_05_29_120031_create_villes_table', 1),
(7, '2024_05_29_120202_create_communes_table', 1),
(8, '2024_05_29_120407_create_quartiers_table', 1),
(9, '2024_06_14_195727_create_parcelles_table', 1),
(10, '2024_06_14_202329_create_parcelle_maison_locations_table', 1),
(11, '2024_06_14_202810_create_locataires_table', 1),
(12, '2024_06_19_142759_create_proprietaires_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `parcelles`
--

CREATE TABLE `parcelles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip_parcelle` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `forme_geometrique` enum('Carré','Rectangle','Losange','Trapèze','Triangle') NOT NULL,
  `dimensions` varchar(255) NOT NULL,
  `etage` varchar(255) NOT NULL DEFAULT 'non',
  `nbre_etages` varchar(255) DEFAULT NULL,
  `nbre_maisons_location` int(11) DEFAULT NULL,
  `type_titre` varchar(255) NOT NULL,
  `numero_titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `ville_id` bigint(20) UNSIGNED NOT NULL,
  `commune_id` bigint(20) UNSIGNED NOT NULL,
  `quartier_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaires`
--

CREATE TABLE `proprietaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `npi_proprietaire` varchar(255) NOT NULL,
  `type_proprietaire` varchar(255) NOT NULL,
  `npi_parcelle` varchar(255) NOT NULL,
  `parcelle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_libelle` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'actif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `provinces`
--

INSERT INTO `provinces` (`id`, `province_libelle`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kinshasa', 'actif', NULL, NULL),
(2, 'Kongo-Central', 'actif', NULL, NULL),
(3, 'Kwango', 'actif', NULL, NULL),
(4, 'Kwilu', 'actif', NULL, NULL),
(5, 'Mai-Ndombe', 'actif', NULL, NULL),
(6, 'Equateur', 'actif', NULL, NULL),
(7, 'Nord-Ubangi', 'actif', NULL, NULL),
(8, 'Sud-Ubangi', 'actif', NULL, NULL),
(9, 'Mongala', 'actif', NULL, NULL),
(10, 'Tshuapa', 'actif', NULL, NULL),
(11, 'Tshopo', 'actif', NULL, NULL),
(12, 'Bas-Uele', 'actif', NULL, NULL),
(13, 'Haut-Uele', 'actif', NULL, NULL),
(14, 'Ituri', 'actif', NULL, NULL),
(15, 'Nord-Kivu', 'actif', NULL, NULL),
(16, 'Sud-Kivu', 'actif', NULL, NULL),
(17, 'Maniema', 'actif', NULL, NULL),
(18, 'Haut-Katanga', 'actif', NULL, NULL),
(19, 'Haut-Lomami', 'actif', NULL, NULL),
(20, 'Lualaba', 'actif', NULL, NULL),
(21, 'Tanganyka', 'actif', NULL, NULL),
(22, 'Lomami', 'actif', NULL, NULL),
(23, 'Sankuru', 'actif', NULL, NULL),
(24, 'Kasai Oriental', 'actif', NULL, NULL),
(25, 'Kasai', 'actif', NULL, NULL),
(26, 'Tshuapa', 'actif', NULL, NULL),
(27, 'Kasai Central', 'actif', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `quartiers`
--

CREATE TABLE `quartiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quartier_libelle` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'actif',
  `commune_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `quartiers`
--

INSERT INTO `quartiers` (`id`, `quartier_libelle`, `status`, `commune_id`, `created_at`, `updated_at`) VALUES
(1, 'Kingabwa', 'actif', 80, NULL, NULL),
(2, 'Sous region', 'actif', 79, NULL, NULL),
(3, 'Salongo', 'actif', 79, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ville_libelle` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'actif',
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `communes`
--
ALTER TABLE `communes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `locataires`
--
ALTER TABLE `locataires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `maison_locations`
--
ALTER TABLE `maison_locations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parcelles`
--
ALTER TABLE `parcelles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parcelles_nip_parcelle_unique` (`nip_parcelle`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `quartiers`
--
ALTER TABLE `quartiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `communes`
--
ALTER TABLE `communes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `locataires`
--
ALTER TABLE `locataires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `maison_locations`
--
ALTER TABLE `maison_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `parcelles`
--
ALTER TABLE `parcelles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `quartiers`
--
ALTER TABLE `quartiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
