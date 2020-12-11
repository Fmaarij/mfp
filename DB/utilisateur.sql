-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 05 nov. 2020 à 17:04
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `utilisateur`
--

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `GalleryID` int(11) NOT NULL,
  `nom_photo` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `gallery`
--

INSERT INTO `gallery` (`GalleryID`, `nom_photo`) VALUES
(31, 'medias/video/photo-produits/fatal.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `genreID` int(11) NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`genreID`, `genre`) VALUES
(1, 'action'),
(2, 'comedie'),
(3, 'drame'),
(4, 'fantastique'),
(5, 'horreur'),
(6, 'aventure'),
(7, 'crime'),
(8, 'romantique');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `pay_code` varchar(2) COLLATE utf8_bin NOT NULL,
  `pay_fr` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pay_en` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`pay_code`, `pay_fr`, `pay_en`) VALUES
('AD', 'Andorre', 'Andorra'),
('AE', 'Émirats arabes unis', 'United Arab Emirates'),
('AF', 'Afghanistan', 'Afghanistan'),
('AG', 'Antigua-et-Barbuda', 'Antigua & Barbuda'),
('AI', 'Anguilla', 'Anguilla'),
('AL', 'Albanie', 'Albania'),
('AM', 'Arménie', 'Armenia'),
('AN', 'Antilles néerlandaises', 'Netherlands Antilles'),
('AO', 'Angola', 'Angola'),
('AQ', 'Antarctique', 'Antarctica'),
('AR', 'Argentine', 'Argentina'),
('AS', 'Samoa américaines', 'American Samoa'),
('AT', 'Autriche', 'Austria'),
('AU', 'Australie', 'Australia'),
('AW', 'Aruba', 'Aruba'),
('AZ', 'Azerbaïdjan', 'Azerbaijan'),
('BA', 'Bosnie-Herzégovine', 'Bosnia and Herzegovina'),
('BB', 'Barbade', 'Barbados'),
('BD', 'Bangladesh', 'Bangladesh'),
('BE', 'Belgique', 'Belgium'),
('BF', 'Burkina Faso', 'Burkina Faso'),
('BG', 'Bulgarie', 'Bulgaria'),
('BH', 'Bahreïn', 'Bahrain'),
('BI', 'Burundi', 'Burundi'),
('BJ', 'Bénin', 'Benin'),
('BM', 'Bermudes', 'Bermuda'),
('BN', 'Brunei', 'Brunei Darussalam'),
('BO', 'Bolivie', 'Bolivia'),
('BR', 'Brésil', 'Brazil'),
('BT', 'Bhoutan', 'Bhutan'),
('BV', 'Ile Bouvet', 'Bouvet Island'),
('BW', 'Botswana', 'Botswana'),
('BY', 'Biélorussie', 'Belarus'),
('BZ', 'Belize', 'Belize'),
('CA', 'Canada', 'Canada'),
('CC', 'Iles des Cocos (Keeling)', 'Cocos (Keeling) Islands'),
('CD', 'République démocratique du Congo', 'Congo, Democratic Rep. of the'),
('CF', 'République centrafricaine', 'Central African Republic'),
('CG', 'Congo', 'Congo'),
('CH', 'Suisse', 'Switzerland'),
('CI', 'Côte d\'Ivoire', 'Ivory Coast (see Cote d\'Ivoire)'),
('CK', 'Iles Cook', 'Cook Islands'),
('CL', 'Chili', 'Chile'),
('CM', 'Cameroun', 'Cameroon'),
('CN', 'Chine', 'China'),
('CO', 'Colombie', 'Colombia'),
('CR', 'Costa Rica', 'Costa Rica'),
('CU', 'Cuba', 'Cuba'),
('CV', 'Cap-Vert', 'Cape Verde'),
('CX', 'Ile Christmas', 'Christmas Island'),
('CY', 'Chypre', 'Cyprus'),
('CZ', 'République tchèque', 'Czech Republic'),
('DE', 'Allemagne', 'Germany'),
('DJ', 'Djibouti', 'Djibouti'),
('DK', 'Danemark', 'Denmark'),
('DM', 'Dominique', 'Dominica'),
('DO', 'République dominicaine', 'Dominican Republic'),
('DZ', 'Algérie', 'Algeria'),
('EC', 'Équateur', 'Ecuador'),
('EE', 'Estonie', 'Estonia'),
('EG', 'Égypte', 'Egypt'),
('EH', 'Sahara occidental', 'Western Sahara'),
('ER', 'Érythrée', 'Eritrea'),
('ES', 'Espagne', 'Spain'),
('ET', 'Éthiopie', 'Ethiopia'),
('FI', 'Finlande', 'Finland'),
('FJ', 'Iles Fidji', 'Fiji'),
('FK', 'Iles Falkland', 'Falkland Islands (Malvinas)'),
('FM', 'Micronésie', 'Micronesia, Federated States of'),
('FO', 'Iles Féroé', 'Faroe Islands'),
('FR', 'France', 'France'),
('GA', 'Gabon', 'Gabon'),
('GB', 'Royaume-Uni', 'Saint Pierre and Miquelon'),
('GD', 'Grenade', 'Grenada'),
('GE', 'Géorgie', 'Georgia'),
('GF', 'Guyane française', 'Guiana, French'),
('GH', 'Ghana', 'Ghana'),
('GI', 'Gibraltar', 'Gibraltar'),
('GL', 'Groenland', 'Greenland'),
('GM', 'Gambie', 'Gambia, the'),
('GN', 'Guinée', 'Guinea'),
('GP', 'Guadeloupe', 'Guinea, Equatorial'),
('GQ', 'Guinée équatoriale', 'Equatorial Guinea'),
('GR', 'Grèce', 'Greece'),
('GS', 'Iles Géorgie du Sud et Sandwich du Sud', 'S. Georgia and S. Sandwich Is.'),
('GT', 'Guatemala', 'Guatemala'),
('GU', 'Guam', 'Guam'),
('GW', 'Guinée-Bissao', 'Guinea-Bissau'),
('GY', 'Guyana', 'Guyana'),
('HK', 'Hong Kong', 'Hong Kong, (China)'),
('HM', 'Iles Heard et McDonald', 'Heard and McDonald Islands'),
('HN', 'Honduras', 'Honduras'),
('HR', 'Croatie', 'Croatia'),
('HT', 'Haïti', 'Haiti'),
('HU', 'Hongrie', 'Hungary'),
('ID', 'Indonésie', 'Indonesia'),
('IE', 'Irlande', 'Ireland'),
('IL', 'Israël', 'Israel'),
('IN', 'Inde', 'India'),
('IO', 'Territoire britannique de l\'Océan Indien', 'British Indian Ocean Territory'),
('IQ', 'Iraq', 'Iraq'),
('IR', 'Iran', 'Iran, Islamic Republic of'),
('IS', 'Islande', 'Iceland'),
('IT', 'Italie', 'Italy'),
('JM', 'Jamaïque', 'Jamaica'),
('JO', 'Jordanie', 'Jordan'),
('JP', 'Japon', 'Japan'),
('KE', 'Kenya', 'Kenya'),
('KG', 'Kirghizistan', 'Kyrgyzstan'),
('KH', 'Cambodge', 'Cambodia'),
('KI', 'Kiribati', 'Kiribati'),
('KM', 'Comores', 'Comoros'),
('KN', 'Saint-Christophe-et-Niévès', 'Saint Kitts and Nevis'),
('KP', 'Corée du Nord', 'Korea, Demo. People\'s Rep. of'),
('KR', 'Corée du Sud', 'Korea, (South) Republic of'),
('KW', 'Koweït', 'Kuwait'),
('KY', 'Iles Cayman', 'Cayman Islands'),
('KZ', 'Kazakhstan', 'Kazakhstan'),
('LA', 'Laos', 'Lao People\'s Democratic Republic'),
('LB', 'Liban', 'Lebanon'),
('LC', 'Sainte-Lucie', 'Saint Lucia'),
('LI', 'Liechtenstein', 'Liechtenstein'),
('LK', 'Sri Lanka', 'Sri Lanka (ex-Ceilan)'),
('LR', 'Liberia', 'Liberia'),
('LS', 'Lesotho', 'Lesotho'),
('LT', 'Lituanie', 'Lithuania'),
('LU', 'Luxembourg', 'Luxembourg'),
('LV', 'Lettonie', 'Latvia'),
('LY', 'Libye', 'Libyan Arab Jamahiriya'),
('MA', 'Maroc', 'Morocco'),
('MC', 'Monaco', 'Monaco'),
('MD', 'Moldavie', 'Moldova, Republic of'),
('MG', 'Madagascar', 'Madagascar'),
('MH', 'Iles Marshall', 'Marshall Islands'),
('MK', 'ex-République yougoslave de Macédoine', 'Macedonia, TFYR'),
('ML', 'Mali', 'Mali'),
('MM', 'Birmanie', 'Myanmar (ex-Burma)'),
('MN', 'Mongolie', 'Mongolia'),
('MO', 'Macao', 'Macao, (China)'),
('MP', 'Mariannes du Nord', 'Northern Mariana Islands'),
('MQ', 'Martinique', 'Martinique'),
('MR', 'Mauritanie', 'Mauritania'),
('MS', 'Montserrat', 'Montserrat'),
('MT', 'Malte', 'Malta'),
('MU', 'Maurice', 'Mauritius'),
('MV', 'Maldives', 'Maldives'),
('MW', 'Malawi', 'Malawi'),
('MX', 'Mexique', 'Mexico'),
('MY', 'Malaisie', 'Malaysia'),
('MZ', 'Mozambique', 'Mozambique'),
('NA', 'Namibie', 'Namibia'),
('NC', 'Nouvelle-Calédonie', 'New Caledonia'),
('NE', 'Niger', 'Niger'),
('NF', 'Ile Norfolk', 'Norfolk Island'),
('NG', 'Nigeria', 'Nigeria'),
('NI', 'Nicaragua', 'Nicaragua'),
('NL', 'Pays-Bas', 'Netherlands'),
('NO', 'Norvège', 'Norway'),
('NP', 'Népal', 'Nepal'),
('NR', 'Nauru', 'Nauru'),
('NU', 'Nioué', 'Niue'),
('NZ', 'Nouvelle-Zélande', 'New Zealand'),
('OM', 'Oman', 'Oman'),
('PA', 'Panama', 'Panama'),
('PE', 'Pérou', 'Peru'),
('PF', 'Polynésie française', 'French Polynesia'),
('PG', 'Papouasie-Nouvelle-Guinée', 'Papua New Guinea'),
('PH', 'Philippines', 'Philippines'),
('PK', 'Pakistan', 'Pakistan'),
('PL', 'Pologne', 'Poland'),
('PM', 'Saint-Pierre-et-Miquelon', 'Saint Pierre and Miquelon'),
('PN', 'Iles Pitcairn', 'Pitcairn Island'),
('PR', 'Porto Rico', 'Puerto Rico'),
('PT', 'Portugal', 'Portugal'),
('PW', 'Belau', 'Palau'),
('PY', 'Paraguay', 'Paraguay'),
('QA', 'Qatar', 'Qatar'),
('RE', 'Réunion', 'Reunion'),
('RO', 'Roumanie', 'Romania'),
('RU', 'Russie', 'Russia (Russian Federation)'),
('RW', 'Rwanda', 'Rwanda'),
('SA', 'Arabie saoudite', 'Saudi Arabia'),
('SB', 'Iles Salomon', 'Solomon Islands'),
('SC', 'Seychelles', 'Seychelles'),
('SD', 'Soudan', 'Sudan'),
('SE', 'Suède', 'Sweden'),
('SG', 'Singapour', 'Singapore'),
('SH', 'Sainte-Hélène', 'Saint Helena'),
('SI', 'Slovénie', 'Slovenia'),
('SJ', 'Iles Svalbard et Jan Mayen', 'Svalbard and Jan Mayen Islands'),
('SK', 'Slovaquie', 'Slovakia'),
('SL', 'Sierra Leone', 'Sierra Leone'),
('SM', 'Saint-Marin', 'San Marino'),
('SN', 'Sénégal', 'Senegal'),
('SO', 'Somalie', 'Somalia'),
('SR', 'Suriname', 'Suriname'),
('ST', 'Sao Tomé-et-Principe', 'Sao Tome and Principe'),
('SV', 'Salvador', 'El Salvador'),
('SY', 'Syrie', 'Syrian Arab Republic'),
('SZ', 'Swaziland', 'Swaziland'),
('TC', 'Iles Turks-et-Caicos', 'Turks and Caicos Islands'),
('TD', 'Tchad', 'Chad'),
('TF', 'Terres australes françaises', 'French Southern Territories - TF'),
('TG', 'Togo', 'Togo'),
('TH', 'Thaïlande', 'Thailand'),
('TJ', 'Tadjikistan', 'Tajikistan'),
('TK', 'Tokélaou', 'Tokelau'),
('TL', 'Timor Oriental', 'Timor-Leste (East Timor)'),
('TM', 'Turkménistan', 'Turkmenistan'),
('TN', 'Tunisie', 'Tunisia'),
('TO', 'Tonga', 'Tonga'),
('TR', 'Turquie', 'Turkey'),
('TT', 'Trinité-et-Tobago', 'Trinidad & Tobago'),
('TV', 'Tuvalu', 'Tuvalu'),
('TW', 'Taïwan', 'Taiwan'),
('TZ', 'Tanzanie', 'Tanzania, United Republic of'),
('UA', 'Ukraine', 'Ukraine'),
('UG', 'Ouganda', 'Uganda'),
('UM', 'Iles mineures éloignées des États-Unis', 'US Minor Outlying Islands'),
('US', 'États-Unis', 'United States'),
('UY', 'Uruguay', 'Uruguay'),
('UZ', 'Ouzbékistan', 'Uzbekistan'),
('VA', 'Saint-Siège ', 'Vatican City State (Holy See)'),
('VC', 'Saint-Vincent-et-les-Grenadines', 'Saint Vincent and the Grenadines'),
('VE', 'Venezuela', 'Venezuela'),
('VG', 'Iles Vierges britanniques', 'Virgin Islands, British'),
('VI', 'Iles Vierges américaines', 'Virgin Islands, U.S.'),
('VN', 'Vietnam', 'Viet Nam'),
('VU', 'Vanuatu', 'Vanuatu'),
('WF', 'Wallis-et-Futuna', 'Wallis and Futuna'),
('WS', 'Samoa', 'Samoa'),
('YE', 'Yémen', 'Yemen'),
('YT', 'Mayotte', 'Mayotte'),
('YU', 'Yougoslavie', 'Saint Pierre and Miquelon'),
('ZA', 'Afrique du Sud', 'South Africa'),
('ZM', 'Zambie', 'Zambia'),
('ZW', 'Zimbabwe', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `userID` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `Nom` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `mot_de_passe` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `role` varchar(250) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`userID`, `Nom`, `prenom`, `adresse`, `mot_de_passe`, `role`) VALUES
('Aim', 'Khan', 'Aimal', 'rue d\'uccle 25 anderlecht', '123', 'membre'),
('Fai', 'Maarij', 'Faisal', 'Rue Baron de Laveleye', '123', 'admin'),
('Flo', 'Guillume1', 'Florance', 'Rue de marchand 65', '123', 'membre'),
('Jaz', 'Madilo', 'Jason', 'Rue de marchand 65 1050', '123', 'membre'),
('Saada', 'Jadoo', 'Saada', 'Avenue jean volders 126 1060 ', '123', 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `videoID` int(11) NOT NULL,
  `titre` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `duree` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `genre` int(200) NOT NULL,
  `langue` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `subtitle` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `pay_code` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `chemin_video` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`videoID`, `titre`, `duree`, `genre`, `langue`, `subtitle`, `pay_code`, `chemin_video`) VALUES
(14, 'FATAL RISK', '10', 32, '  français', 'Anglais', 'BE', 'medias/video/video-produits/Trailer-1-FATAL-RISK-2019-de-LOUNSENY-KONE.mp4'),
(15, 'LA SOLITUDE', '20', 1, 'français', 'Anglais', 'BE', 'medias/video/video-produits/LA-SOLITUDE..mp4'),
(16, 'The hunter and the girl with the Pokemon', '3 minutes', 1, 'français', 'Anglais', 'BE', 'medias/video/video-produits/The-hunter-and-the-girl-with-the-Pokemon.mp4'),
(17, 'La sloitude', '10', 2, 'français', 'englais', 'BE', 'medias/video/video-produits/LA-SOLITUDE..mp4'),
(18, 'La Balle de trop', '10 m', 3, 'français', 'englais', 'BE', 'medias/video/video-produits/La-Balle-de-trop-le-film.mp4'),
(19, 'videonora', '10', 11, 'français', 'dari', 'BE', 'medias/video/video-produits/Trailer-1-FATAL-RISK-2019-de-LOUNSENY-KONE.mp4');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`GalleryID`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`userID`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`videoID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `GalleryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `genreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `videoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
