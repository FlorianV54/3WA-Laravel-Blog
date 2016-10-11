-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 11 Octobre 2016 à 09:30
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prix` float NOT NULL,
  `resume` mediumtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` float DEFAULT NULL,
  `visibilite` tinyint(1) DEFAULT '1',
  `annee_publication` year(4) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_modification` datetime DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `favoris` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `prix`, `resume`, `description`, `image`, `note`, `visibilite`, `annee_publication`, `date_creation`, `date_modification`, `categorie_id`, `user_id`, `created_at`, `updated_at`, `favoris`) VALUES
(29, 'Article 1', 15.23, 'L\'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée d', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'http://www.w3schools.com/css/img_forest.jpg', 12, 1, 2016, '2016-09-05 14:31:29', '2016-09-05 18:00:00', 1, NULL, '2016-09-05 14:31:29', '2016-10-11 10:40:00', 0),
(42, 'Article 2', 120.32, 'L\'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée d', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'http://www.w3schools.com/css/img_forest.jpg', 12, 1, 2016, '2016-09-19 14:31:29', '2016-09-05 18:00:00', 2, NULL, '2016-09-19 14:31:29', '2016-10-11 10:25:36', 1),
(43, 'Article 3', 72.52, 'L\'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée d', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'http://www.w3schools.com/css/img_forest.jpg', 8, 0, 2016, '2016-09-16 14:31:29', '2016-09-22 18:00:00', 1, NULL, '2016-09-28 12:46:38', '2016-10-11 10:03:47', 1);

-- --------------------------------------------------------

--
-- Structure de la table `articles_related`
--

CREATE TABLE `articles_related` (
  `article_id1` int(11) NOT NULL,
  `article_id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article_media`
--

CREATE TABLE `article_media` (
  `article_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `article_media`
--

INSERT INTO `article_media` (`article_id`, `media_id`) VALUES
(1, 2),
(0, 0),
(2, 2),
(0, 0),
(1, 3),
(29, 16),
(42, 17);

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

CREATE TABLE `article_tag` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `titre` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `parent`, `titre`, `description`) VALUES
(1, 1, 'News', 'ergaergaergagg\r\na\r\negraegea\r\ng\r\ng\r\n\r\neg\r\nge\r\ng\r\neregg'),
(2, 1, 'Insolite', 'rregrerg\r\ngrg\r\ngr\r\ng\r\ngr\r\nreg\r\ngerregreggrereg\r\nreg\r\negr\r\negr\r\nreg\r\nreg\r\nreg'),
(3, 1, 'Santé', 'rgg\r\nerrehrtzhr\r\nth\r\nrth\r\ntrhrthrrzthrzthr\r\nrt\r\nhrzth\r\nzrt\r\nrzhzrhhh'),
(4, 1, 'Sport', 'egerg\r\narg\r\nrgrg\r\nergeregereregrg\r\nreg\r\nerg\r\nerg\r\nerggegerreg');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `note` tinyint(11) NOT NULL,
  `etat` tinyint(4) DEFAULT '1',
  `article_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `content`, `note`, `etat`, `article_id`, `created_at`, `updated_at`) VALUES
(5, 367, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.\n', 4, 1, 29, '2011-09-13 13:24:21', '2016-10-10 17:56:07'),
(7, 367, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.\n', 3, 0, 42, '2013-09-15 12:28:42', '2016-10-10 17:55:44'),
(9, 365, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.\n', 5, 2, 43, '2015-09-16 15:33:47', '2016-10-10 17:56:04');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `genre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sujet` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `genre`, `nom`, `message`, `email`, `site`, `sujet`, `created_at`, `updated_at`) VALUES
(5, 'homme', 'Florian', 'ergtrghrzthzhrtt', 'florianvarenne@gmail.com', 'http://www.google.fr', 'article', '2016-09-09 13:44:55', '2016-09-09 13:44:55'),
(6, 'homme', 'gthrhtrhtrh', 'ergegzgzrgrg', 'florianvarenne@gmail.com', 'http://www.google.fr', 'article', '2016-09-09 13:45:54', '2016-09-09 13:45:54'),
(7, 'feminin', 'ffff', 'ehrehrehrthrthr', 'gegergrg@zefzef.vol', 'http://www.google.fr', 'demande', '2016-09-12 07:28:10', '2016-09-12 07:28:10');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `url` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `visibilite` tinyint(1) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_activation` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `page_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `url`, `visibilite`, `article_id`, `titre`, `date_activation`, `created_at`, `updated_at`, `page_id`) VALUES
(16, 'https://www.youtube.com/watch?v=UuPv5Qc5TwM', 1, NULL, 'grthrthrtrthrth', '2016-09-28', '2016-09-12 08:15:47', '2016-09-12 08:15:47', NULL),
(17, 'https://www.youtube.com/watch?v=UuPv5Qc5TwM', 1, NULL, 'fggdfgdfg', '2016-10-05', '2016-09-12 08:30:33', '2016-09-12 08:30:33', NULL),
(18, 'https://www.youtube.com/watch?v=UuPv5Qc5TwM', 1, NULL, 'rthrzthtrzhzrhrh', '2016-12-09', '2016-09-12 09:50:10', '2016-09-12 09:50:10', NULL),
(19, 'https://www.youtube.com/watch?v=UuPv5Qc5TwM', 1, NULL, 'thrtht', '0000-00-00', '2016-09-12 09:58:22', '2016-09-12 09:58:22', NULL),
(20, 'https://www.youtube.com/watch?v=UuPv5Qc5TwM', 0, NULL, 'iiiiiiiiiiii', '2016-09-13', '2016-09-12 09:59:41', '2016-09-12 09:59:41', NULL),
(21, 'https://www.youtube.com/watch?v=UuPv5Qc5TwM', 1, NULL, 'rtrh', '2016-09-22', '2016-09-14 14:47:14', '2016-09-14 14:47:14', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `titre` text COLLATE utf8_unicode_ci NOT NULL,
  `visibilite` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `article_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `titre`, `visibilite`, `date_creation`, `date_modification`, `article_id`, `media_id`) VALUES
(2, 'erterataertreareat', 1, '2016-09-22 10:32:32', '2016-09-22 17:34:49', 42, 18),
(3, 'erterataertreareatertaertert', 1, '2016-09-22 10:32:32', '2016-09-22 17:34:49', 29, 19);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('florianvarenne@gmail.com', '323a7120bd4e29bb28d15729a78b5fb7eac860f87a9668b770c406a98cc6a600', '2016-09-27 14:57:25');

-- --------------------------------------------------------

--
-- Structure de la table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `metadesc` longtext COLLATE utf8_unicode_ci NOT NULL,
  `metakeywords` longtext COLLATE utf8_unicode_ci NOT NULL,
  `urlcanonique` longtext COLLATE utf8_unicode_ci NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `word` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `word`) VALUES
(1, 'tag-test1'),
(2, 'tag-test2');

-- --------------------------------------------------------

--
-- Structure de la table `tchat`
--

CREATE TABLE `tchat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `tchat`
--

INSERT INTO `tchat` (`id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 363, 'ergerhtrhzrhzrthrthrthrzthrzthrh', '2016-09-20 09:28:49', '2016-09-20 17:47:43'),
(2, 364, 'Salut les gens !!!!', '2016-09-20 08:34:47', '2016-09-20 16:36:42'),
(3, 365, 'Hello !!!!', '2016-09-20 14:35:25', '2016-09-20 18:43:41'),
(15, 380, 'ioioiopo', '2016-09-21 09:12:08', '2016-09-21 09:12:08'),
(16, 380, 'iphipoiiop', '2016-09-21 09:12:11', '2016-09-21 09:12:11'),
(17, 380, 'ouiouioi', '2016-09-21 09:12:12', '2016-09-21 09:12:12'),
(18, 380, 'jtjjyjjyyj', '2016-09-21 09:14:24', '2016-09-21 09:14:24'),
(19, 380, 'jkljljjlljl', '2016-09-21 09:14:30', '2016-09-21 09:14:30'),
(20, 380, 'yttyytyu', '2016-09-21 09:19:04', '2016-09-21 09:19:04'),
(21, 380, 'fgfgfdgfdgfdg', '2016-09-21 09:56:59', '2016-09-21 09:56:59'),
(22, 380, 'uyyuyk', '2016-09-21 10:03:22', '2016-09-21 10:03:22'),
(23, 380, 'yukuitui', '2016-09-21 10:03:25', '2016-09-21 10:03:25'),
(24, 380, 'trhteheheeheh', '2016-09-21 12:29:31', '2016-09-21 12:29:31'),
(25, 380, 'khmkjhmlhj', '2016-09-21 16:03:09', '2016-09-21 16:03:09'),
(26, 0, 'ergeqrgeggqeg', '2016-09-21 16:29:11', '2016-09-21 16:29:11'),
(27, 0, 'tyuteuteyuutuy', '2016-09-27 15:19:04', '2016-09-27 15:19:04'),
(28, 0, 'hytjttjjj', '2016-09-28 09:14:34', '2016-09-28 09:14:34'),
(29, 0, 'rtrthrs', '2016-09-29 15:24:29', '2016-09-29 15:24:29'),
(30, 0, 'test', '2016-10-06 13:22:39', '2016-10-06 13:22:39');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `biographie` text COLLATE utf8_unicode_ci,
  `ville` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_id` int(11) DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `image`, `nom`, `prenom`, `email`, `password`, `confirmation_password`, `telephone`, `code_postal`, `biographie`, `ville`, `date_naissance`, `created_at`, `updated_at`, `remember_token`, `twitter_id`, `facebook_id`) VALUES
(364, 'web-development.jpg', 'VARENNE', 'Florian', 'ergreag@ergre.gt', '$2y$10$Bt4sb.q5iS2aIGNkAsShNOMyyusUIVtjCXugMa5kFCMFWC/cJjKlC', '$2y$10$GPRziynKfQZJD.SVZ5n3F.IqbgSn5toce0WXfmepGSOx2/y3Zezcm', '0656987454', 38290, '<p>Salut !!!!</p>\r\n', 'Lyon', '1983-04-04', '2016-09-14 10:07:47', '2016-09-14 10:07:47', '', NULL, NULL),
(365, 'Material-design.jpg', 'rtgrttrhrt', 'rthrhrrtht', 'rthrhh@ergeeth.com', '$2y$10$YLQnRYrXeHbIsrR4KiS/zOgBWZN7eK4wgYAXiKveSDGYO0MVIkq0i', '$2y$10$PQ/1PHEXUwvXJpzLDWoXW.I.HwaYIe9/YbftCmKrI7wjiquxCej/K', '0102030405', 54654, '<p>ergegerger</p>\r\n', 'Lyon', '1962-05-02', '2016-09-14 10:30:11', '2016-09-14 10:30:11', '', NULL, NULL),
(366, 'cdg-haut3.jpg', 'trhrthrthr', 'rthrthrhh', 'ergreag@ergre.gt', '$2y$10$Oj0Uk6felPXXFnboVRbUfOqk2q6bCqJrkZXIAdVk02M7h7Mj70bkq', '$2y$10$MsqaWuf8zJVBiP5lOjRECOmKO3XxRn.8uIkYXdN6DhYUQEYnr35fa', '0545574575', 57577, '<p>regregg</p>\r\n', 'Cannes', '1983-04-01', '2016-09-14 11:37:44', '2016-09-14 11:37:45', '', NULL, NULL),
(367, 'cdg-haut3.jpg', 'erergtrgrtz', 'erhrthrthrhrh', 'rtghtr@erageag.com', '$2y$10$oloTA1Y/U1LrT8WEhaXrTeV/Cgjt2T7cEsdRXK6hLDxC0ZlnkW5xa', '$2y$10$D1dlTQwOm8wtHUJ5NPJVEexzhANSyfPJ5msga8D6cVldxpqqO6VN6', '0546574654', 45545, '<p>ezfzefzfrzef</p>\r\n', 'Annecy', '1969-04-04', '2016-09-14 11:53:36', '2016-09-14 11:53:36', '', NULL, NULL),
(381, 'images.jpg', 'NOM', 'Prénom', 'test@test.com', '$2y$10$8h95FEZXU4UHUpqrCYHJn.LgZ.Bzj6lHm7lBEXhcHutNS75zIf1TS', '', '0434657890', 69100, 'test test test test test test ', 'Lyon', '1997-07-08', '2016-10-06 10:40:43', '2016-10-11 11:25:20', 'hhekvqZ3trRSezikC8pKHAn4OAoCMvZshYCFL4yXO8J0McKY7DGNuJSwU7UP', NULL, NULL),
(402, 'http://pbs.twimg.com/profile_images/666329045819355138/IAZjZbGn.jpg', 'Florian_V', '', '', '', '', NULL, NULL, NULL, '', NULL, '2016-10-10 15:53:36', '2016-10-11 11:22:59', '2cAXXaDX4t2hnIBMEN6fnXj9AJCCox8J0xK0c6poyvJLLhmC5dtvzfcV5lRn', 367191338, NULL),
(408, 'https://graph.facebook.com/v2.6/10210749480271096/picture?type=normal', 'Florian Varenne', '', 'florianvarenne@hotmail.fr', '', '', NULL, NULL, NULL, '', NULL, '2016-10-10 19:16:45', '2016-10-11 11:16:49', 'kK8DSEn7GYWNaxQ40RrVLa2aGMvbN51nsYUJ8W8xwAUXh5SSLrBQs1KmsFfS', NULL, '10210749480271096');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_friends`
--

CREATE TABLE `user_friends` (
  `user_id1` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `categorie_id_2` (`categorie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `articles_related`
--
ALTER TABLE `articles_related`
  ADD KEY `article_id1` (`article_id1`),
  ADD KEY `article_id2` (`article_id2`);

--
-- Index pour la table `article_media`
--
ALTER TABLE `article_media`
  ADD KEY `article_id` (`article_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`article_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `parent` (`parent`),
  ADD KEY `parent_2` (`parent`),
  ADD KEY `parent_3` (`parent`),
  ADD KEY `parent_4` (`parent`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`user_id`,`article_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Index pour la table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tchat`
--
ALTER TABLE `tchat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `user_friends`
--
ALTER TABLE `user_friends`
  ADD PRIMARY KEY (`user_id1`,`user_id`),
  ADD KEY `user_id1` (`user_id1`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tchat`
--
ALTER TABLE `tchat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`categorie_id`) REFERENCES `articles` (`categorie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `articles_related`
--
ALTER TABLE `articles_related`
  ADD CONSTRAINT `articles_related_ibfk_1` FOREIGN KEY (`article_id1`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_related_ibfk_2` FOREIGN KEY (`article_id2`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_tag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_tag_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_2` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `seo`
--
ALTER TABLE `seo`
  ADD CONSTRAINT `seo_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_friends`
--
ALTER TABLE `user_friends`
  ADD CONSTRAINT `user_friends_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_friends_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
