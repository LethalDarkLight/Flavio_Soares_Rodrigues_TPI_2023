-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 04 mai 2023 à 13:21
-- Version du serveur :  10.3.38-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `GYM`
--

CREATE DATABASE IF NOT EXISTS GYM;

-- --------------------------------------------------------

--
-- Structure de la table `ARTICLES`
--

CREATE TABLE `ARTICLES` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `DESCRIPTION` mediumtext NOT NULL,
  `PRICE` double NOT NULL,
  `STOCK` int(11) NOT NULL,
  `FEATURED` tinyint(4) NOT NULL,
  `CREATION_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATE_DATE` timestamp NULL DEFAULT NULL,
  `CATEGORIES_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CART_ITEMS`
--

CREATE TABLE `CART_ITEMS` (
  `USERS_ID` int(11) NOT NULL,
  `ARTICLES_ID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORIES`
--

CREATE TABLE `CATEGORIES` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `CATEGORIES`
--

INSERT INTO `CATEGORIES` (`ID`, `NAME`) VALUES
(1, 'APPAREILS'),
(2, 'BARRE/HALTERES'),
(3, 'CARDIO'),
(4, 'CROSSTRAINING');

-- --------------------------------------------------------

--
-- Structure de la table `CITIES`
--

CREATE TABLE `CITIES` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `CITIES`
--

INSERT INTO `CITIES` (`ID`, `NAME`) VALUES
(1, 'Zürich'),
(2, 'Geneva'),
(3, 'Basel'),
(4, 'Lausanne'),
(5, 'Bern'),
(6, 'Winterthur'),
(7, 'Lucerne'),
(8, 'Sankt Gallen'),
(9, 'Lugano'),
(10, 'Biel/Bienne'),
(11, 'Thun'),
(12, 'Bellinzona'),
(13, 'Köniz'),
(14, 'La Chaux-de-Fonds'),
(15, 'Fribourg'),
(16, 'Schaffhausen'),
(17, 'Vernier'),
(18, 'Chur'),
(19, 'Sion'),
(20, 'Uster'),
(21, 'Neuchâtel'),
(22, 'Landecy'),
(23, 'Zug'),
(24, 'Yverdon-les-Bains'),
(25, 'Emmen'),
(26, 'Dübendorf'),
(27, 'Kriens'),
(28, 'Rapperswil-Jona'),
(29, 'Dietikon'),
(30, 'Montreux'),
(31, 'Wetzikon'),
(32, 'Baar'),
(33, 'Meyrin'),
(34, 'Wil'),
(35, 'Bulle'),
(36, 'Horgen'),
(37, 'Carouge'),
(38, 'Frauenfeld'),
(39, 'Kreuzlingen'),
(40, 'Wädenswil'),
(41, 'Riehen'),
(42, 'Aarau'),
(43, 'Allschwil'),
(44, 'Renens'),
(45, 'Wettingen'),
(46, 'Nyon'),
(47, 'Bülach'),
(48, 'Vevey'),
(49, 'Opfikon'),
(50, 'Kloten'),
(51, 'Reinach'),
(52, 'Baden'),
(53, 'Onex'),
(54, 'Adliswil'),
(55, 'Schlieren'),
(56, 'Volketswil'),
(57, 'Pully'),
(58, 'Regensdorf'),
(59, 'Gossau'),
(60, 'Muttenz'),
(61, 'Thalwil'),
(62, 'Monthey'),
(63, 'Ostermundigen'),
(64, 'Littau'),
(65, 'Grenchen'),
(66, 'Olten'),
(67, 'Sierre'),
(68, 'Solothurn'),
(69, 'Pratteln'),
(70, 'Burgdorf'),
(71, 'Freienbach'),
(72, 'Wohlen'),
(73, 'Locarno'),
(74, 'Wallisellen'),
(75, 'Morges'),
(76, 'Steffisburg'),
(77, 'Herisau'),
(78, 'Langenthal'),
(79, 'Binningen'),
(80, 'Einsiedeln'),
(81, 'Lyss'),
(82, 'Mendrisio'),
(83, 'Arbon'),
(84, 'Liestal'),
(85, 'Stäfa'),
(86, 'Küsnacht'),
(87, 'Horw'),
(88, 'Schwyz'),
(89, 'Thônex'),
(90, 'Meilen'),
(91, 'Oftringen'),
(92, 'Amriswil'),
(93, 'Versoix'),
(94, 'Richterswil'),
(95, 'Rheinfelden'),
(96, 'Brig-Glis'),
(97, 'Gland'),
(98, 'Küssnacht'),
(99, 'Muri'),
(100, 'Zollikon'),
(101, 'Ecublens'),
(102, 'Spiez'),
(103, 'Delémont'),
(104, 'Buchs'),
(105, 'Prilly'),
(106, 'Chêne-Bougeries'),
(107, 'Le Grand-Saconnex'),
(108, 'Rüti'),
(109, 'Münchenstein'),
(110, 'Villars-sur-Glâne'),
(111, 'Affoltern am Albis'),
(112, 'Arth'),
(113, 'La Tour-de-Peilz'),
(114, 'Pfäffikon'),
(115, 'Spreitenbach'),
(116, 'Altstätten'),
(117, 'Zofingen'),
(118, 'Veyrier'),
(119, 'Bassersdorf'),
(120, 'Weinfelden'),
(121, 'Belp'),
(122, 'Worb'),
(123, 'Hinwil'),
(124, 'Romanshorn'),
(125, 'Oberwil'),
(126, 'Brugg'),
(127, 'Möhlin'),
(128, 'Männedorf'),
(129, 'Davos'),
(130, 'Plan-les-Ouates'),
(131, 'Waltikon'),
(132, 'Lenzburg'),
(133, 'Flawil'),
(134, 'Neuhausen am Rheinfall'),
(135, 'Le Locle'),
(136, 'Suhr'),
(137, 'Sarnen'),
(138, 'Aesch'),
(139, 'Birsfelden'),
(140, 'Lutry'),
(141, 'Bernex'),
(142, 'Maur'),
(143, 'Aigle'),
(144, 'Naters'),
(145, 'Steinhaus'),
(146, 'Therwil'),
(147, 'Payerne'),
(148, 'Gossau'),
(149, 'Sursee'),
(150, 'Hochdorf'),
(151, 'Urdorf'),
(152, 'Wald'),
(153, 'Estavayer-le-Lac'),
(154, 'Wittenbach'),
(155, 'Widnau'),
(156, 'Epalinges'),
(157, 'Rorschach'),
(158, 'Embrach'),
(159, 'Altdorf'),
(160, 'Langnau'),
(161, 'Goldach'),
(162, 'Schübelbach'),
(163, 'Arlesheim'),
(164, 'Niederhasli'),
(165, 'Rothrist'),
(166, 'Aadorf'),
(167, 'Ingenbohl'),
(168, 'Oberriet'),
(169, 'Zuchwil'),
(170, 'Unterägeri'),
(171, 'Landquart'),
(172, 'Neuenhof'),
(173, 'Hünenberg'),
(174, 'Fully'),
(175, 'Lachen'),
(176, 'Wattwil'),
(177, 'Bussy'),
(178, 'Conthey'),
(179, 'Mels'),
(180, 'Egg'),
(181, 'Hombrechtikon'),
(182, 'Fällanden'),
(183, 'Biberist'),
(184, 'Obersiggenthal'),
(185, 'Le Mont-sur-Lausanne'),
(186, 'Reinach'),
(187, 'Kilchberg'),
(188, 'Stans'),
(189, 'Oberentfelden'),
(190, 'Murten'),
(191, 'Bagnes'),
(192, 'Aarburg'),
(193, 'Domat/Ems'),
(194, 'Chiasso'),
(195, 'Buchs'),
(196, 'Düdingen'),
(197, 'Crissier'),
(198, 'Rümlang'),
(199, 'Visp'),
(200, 'Muri'),
(201, 'Au'),
(202, 'Willisau'),
(203, 'Bex'),
(204, 'Sirnach'),
(205, 'Bremgarten'),
(206, 'Gränichen'),
(207, 'Chavannes-près-Renens'),
(208, 'Savièse'),
(209, 'Dietlikon'),
(210, 'Windisch'),
(211, 'Rothenburg'),
(212, 'Dürnten'),
(213, 'Langnau am Albis'),
(214, 'Ollon'),
(215, 'Hirslen'),
(216, 'Moutier'),
(217, 'Villmergen'),
(218, 'Minusio'),
(219, 'Seuzach'),
(220, 'Rorschacherberg'),
(221, 'Wollerau'),
(222, 'Untersiggenthal'),
(223, 'Meggen'),
(224, 'Herzogenbuchsee'),
(225, 'Bubikon'),
(226, 'Reiden'),
(227, 'Altendorf'),
(228, 'Grabs'),
(229, 'Orbe'),
(230, 'Châtel-Saint-Denis'),
(231, 'Oberglatt'),
(232, 'Frutigen'),
(233, 'Ruswil'),
(234, 'Schwarzenburg'),
(235, 'Heimberg'),
(236, 'Saanen'),
(237, 'Nidau'),
(238, 'Dornach'),
(239, 'Losone'),
(240, 'Bottmingen'),
(241, 'Sissach'),
(242, 'Porrentruy'),
(243, 'Beromünster'),
(244, 'Thal'),
(245, 'Oberengstringen'),
(246, 'Trimbach'),
(247, 'Wiesendangen'),
(248, 'Derendingen'),
(249, 'Würenlos'),
(250, 'Diepoldsau'),
(251, 'Frenkendorf'),
(252, 'Uznach'),
(253, 'Oberuzwil'),
(254, 'Birmensdorf'),
(255, 'Fehraltorf'),
(256, 'Vétroz'),
(257, 'Kerns'),
(258, 'Menziken'),
(259, 'Buchs'),
(260, 'Herrliberg'),
(261, 'Oensingen'),
(262, 'Teufen'),
(263, 'Bolligen'),
(264, 'Rolle'),
(265, 'Massagno'),
(266, 'Gelterkinden'),
(267, 'Küttigen'),
(268, 'Blonay'),
(269, 'Boudry'),
(270, 'Uetikon am See'),
(271, 'Moudon'),
(272, 'Balsthal'),
(273, 'Buchrain'),
(274, 'Biasca'),
(275, 'Obererli'),
(276, 'Alpnach'),
(277, 'Bischofszell'),
(278, 'Glarus'),
(279, 'Kirchberg'),
(280, 'Dielsdorf'),
(281, 'Zell'),
(282, 'Saxon'),
(283, 'Uetendorf'),
(284, 'Sankt Margrethen'),
(285, 'Rüschlikon'),
(286, 'Peseux'),
(287, 'Hergiswil'),
(288, 'Villeneuve'),
(289, 'Unterseen'),
(290, 'Jegenstorf'),
(291, 'Echallens'),
(292, 'Neftenbach'),
(293, 'Saint-Prex'),
(294, 'Walenstadt'),
(295, 'Appenzell'),
(296, 'Zermatt'),
(297, 'Mellingen'),
(298, 'Lindau'),
(299, 'Interlaken'),
(300, 'Sennwald'),
(301, 'Nürensdorf'),
(302, 'Kaiseraugst'),
(303, 'Cologny'),
(304, 'Erlenbach'),
(305, 'Frick'),
(306, 'Laufen'),
(307, 'Colombier'),
(308, 'Fislisbach'),
(309, 'Bonstetten'),
(310, 'Ascona'),
(311, 'Dagmersellen'),
(312, 'Rupperswil'),
(313, 'Thayngen'),
(314, 'Courtepin'),
(315, 'Schattdorf'),
(316, 'Gebenstorf'),
(317, 'Adligenswil'),
(318, 'Münchwilen'),
(319, 'Greifensee'),
(320, 'Obfelden'),
(321, 'Buochs'),
(322, 'Vechigen'),
(323, 'Seon'),
(324, 'Préverenges'),
(325, 'Konolfingen Dorf'),
(326, 'Romont'),
(327, 'Feusisberg'),
(328, 'Lengnau'),
(329, 'Bellach'),
(330, 'Lausen'),
(331, 'Gerlafingen'),
(332, 'Hitzkirch'),
(333, 'Glattfelden'),
(334, 'Saint Légier-La Chiésaz'),
(335, 'Eglisau'),
(336, 'Gommiswald'),
(337, 'Ettingen'),
(338, 'Sachseln'),
(339, 'Hägendorf'),
(340, 'Zumikon'),
(341, 'Fraubrunnen'),
(342, 'Sevelen'),
(343, 'Schwerzenbach'),
(344, 'Oberrieden'),
(345, 'Wangen bei Olten'),
(346, 'Wangen'),
(347, 'Dulliken'),
(348, 'Sumiswald'),
(349, 'Root'),
(350, 'Ebnat-Kappel'),
(351, 'Bäretswil'),
(352, 'Chavornay'),
(353, 'Saint Moritz'),
(354, 'Bauma'),
(355, 'Geroldswil'),
(356, 'Niederglatt'),
(357, 'Schönenwerd'),
(358, 'Bettlach'),
(359, 'Elgg'),
(360, 'Strengelbach'),
(361, 'Mettmenstetten'),
(362, 'Sainte-Croix'),
(363, 'Flums'),
(364, 'Kaltbrunn'),
(365, 'Huttwil'),
(366, 'Sigriswil'),
(367, 'Ehrendingen'),
(368, 'Ennetbürgen'),
(369, 'Balgach'),
(370, 'Zuzwil'),
(371, 'Niederlenz'),
(372, 'Berikon'),
(373, 'Weiningen'),
(374, 'Oetwil am See'),
(375, 'Turbenthal'),
(376, 'Cortaillod'),
(377, 'Wängi'),
(378, 'Niederbipp'),
(379, 'Egnach'),
(380, 'Oberkirch'),
(381, 'Würenlingen'),
(382, 'Gordola'),
(383, 'Troistorrents'),
(384, 'Saint-Sulpice'),
(385, 'Triengen'),
(386, 'Le Landeron'),
(387, 'Beringen'),
(388, 'Tägerwilen'),
(389, 'Aarberg'),
(390, 'Confignon'),
(391, 'Meiringen'),
(392, 'Stabio'),
(393, 'Scuol'),
(394, 'Le Chenit'),
(395, 'Stansstad'),
(396, 'Morbio Inferiore'),
(397, 'Saint-Maurice'),
(398, 'Tramelan'),
(399, 'Menzingen'),
(400, 'Monte Ceneri'),
(401, 'Bronschhofen'),
(402, 'Aarwangen'),
(403, 'Winkel'),
(404, 'Füllinsdorf'),
(405, 'Zufikon'),
(406, 'Kölliken'),
(407, 'Rafz'),
(408, 'Oberbüren'),
(409, 'Agno'),
(410, 'Klosters Platz'),
(411, 'Schötz'),
(412, 'Schöftland'),
(413, 'Bubendorf'),
(414, 'Brügg'),
(415, 'Rebstein'),
(416, 'Speicher'),
(417, 'Eschlikon'),
(418, 'Weggis'),
(419, 'Gachnang'),
(420, 'Caslano'),
(421, 'Russikon'),
(422, 'Birr'),
(423, 'Cheseaux-sur-Lausanne'),
(424, 'Wolhusen'),
(425, 'Utzenstorf'),
(426, 'Kehrsatz'),
(427, 'Wichtrach'),
(428, 'Avenches'),
(429, 'Sins'),
(430, 'Bad Zurzach'),
(431, 'Uitikon'),
(432, 'Schüpfheim'),
(433, 'Lucens'),
(434, 'Lens'),
(435, 'Vouvry'),
(436, 'Satigny'),
(437, 'Engelberg'),
(438, 'Sempach'),
(439, 'Gross Höchstetten'),
(440, 'Heiden'),
(441, 'Unterentfelden'),
(442, 'Lützelflüh'),
(443, 'Paradiso'),
(444, 'Degersheim'),
(445, 'Niederrohrdorf'),
(446, 'Matten'),
(447, 'Dällikon'),
(448, 'Roggwil'),
(449, 'Oberrohrdorf'),
(450, 'Ayent'),
(451, 'Döttingen'),
(452, 'Hilterfingen'),
(453, 'Prangins'),
(454, 'Leysin'),
(455, 'Hunzenschwil'),
(456, 'Diessenhofen'),
(457, 'Seengen'),
(458, 'Bürglen'),
(459, 'Berneck'),
(460, 'Brittnau'),
(461, 'Böttstein'),
(462, 'Lostorf'),
(463, 'Leuk'),
(464, 'Magden'),
(465, 'Chamoson'),
(466, 'Dottikon'),
(467, 'Muhen'),
(468, 'Sulgen'),
(469, 'Niedergösgen'),
(470, 'Nottwil'),
(471, 'Breitenbach'),
(472, 'Pfungen'),
(473, 'Safenwil'),
(474, 'Bürglen'),
(475, 'Vallorbe'),
(476, 'Schänis'),
(477, 'Unterengstringen'),
(478, 'Grindelwald'),
(479, 'Bevaix'),
(480, 'Langendorf'),
(481, 'Founex'),
(482, 'Jonschwil'),
(483, 'Steckborn'),
(484, 'Reichenburg'),
(485, 'Erlen'),
(486, 'La Neuveville'),
(487, 'Hedingen'),
(488, 'Schüpfen'),
(489, 'Belmont-sur-Lausanne'),
(490, 'Mönchaltorf'),
(491, 'Schmerikon'),
(492, 'Widen'),
(493, 'Port'),
(494, 'Stallikon'),
(495, 'Egerkingen'),
(496, 'Beckenried'),
(497, 'Walchwil'),
(498, 'Elsau'),
(499, 'Giswil'),
(500, 'Rüti'),
(501, 'Hausen am Albis'),
(502, 'Feuerthalen'),
(503, 'Hausen'),
(504, 'Tavannes'),
(505, 'Laufenburg'),
(506, 'Reichenbach im Kandertal'),
(507, 'Hittnau'),
(508, 'Stein'),
(509, 'Plaffeien'),
(510, 'Eschenbach'),
(511, 'Mörschwil'),
(512, 'Büren an der Aare'),
(513, 'Ins'),
(514, 'Erlinsbach'),
(515, 'Merenschwand'),
(516, 'Chalais'),
(517, 'Attalens'),
(518, 'Poschiavo'),
(519, 'Waldkirch'),
(520, 'Ennetbaden'),
(521, 'Klingnau'),
(522, 'Luterbach'),
(523, 'Gams'),
(524, 'Steinmaur'),
(525, 'Château-d’Oex'),
(526, 'Ermatingen'),
(527, 'Selzach'),
(528, 'Münsterlingen'),
(529, 'Grimisuat'),
(530, 'Zizers'),
(531, 'Yvonand'),
(532, 'Rheineck'),
(533, 'Steinen'),
(534, 'Berg'),
(535, 'Bösingen'),
(536, 'Vacallo'),
(537, 'Thunstetten'),
(538, 'Corsier-sur-Vevey'),
(539, 'Stein am Rhein'),
(540, 'Adelboden'),
(541, 'Rickenbach'),
(542, 'Grüningen'),
(543, 'Grandson'),
(544, 'Savigny'),
(545, 'Staufen'),
(546, 'Bonaduz'),
(547, 'Entlebuch'),
(548, 'Courroux'),
(549, 'Romanel-sur-Lausanne'),
(550, 'Tuggen'),
(551, 'Trimmis'),
(552, 'Weisslingen'),
(553, 'Bellevue'),
(554, 'Buttisholz'),
(555, 'Penthalaz'),
(556, 'Belfaux'),
(557, 'Madiswil'),
(558, 'Beinwil am See'),
(559, 'Balerna'),
(560, 'Rüegsbach'),
(561, 'Bätterkinden'),
(562, 'Aubonne'),
(563, 'Grosswangen'),
(564, 'Kappel'),
(565, 'Thusis'),
(566, 'Ardon'),
(567, 'Saint-Blaise'),
(568, 'Leytron'),
(569, 'Subingen'),
(570, 'Stein'),
(571, 'Ursy'),
(572, 'Arosa'),
(573, 'Orsières'),
(574, 'Kirchlindach'),
(575, 'Hofstetten'),
(576, 'Le Mouret'),
(577, 'Coppet'),
(578, 'Niederhelfenschwil'),
(579, 'Hettlingen'),
(580, 'Neerach'),
(581, 'Laupen'),
(582, 'Oberdorf'),
(583, 'Seedorf'),
(584, 'Stettlen'),
(585, 'Lupfig'),
(586, 'Brienz'),
(587, 'Torricella'),
(588, 'Unterkulm'),
(589, 'Gais'),
(590, 'Roggwil'),
(591, 'Echichens'),
(592, 'Benken'),
(593, 'Niederweningen'),
(594, 'Zweisimmen'),
(595, 'Grossaffoltern'),
(596, 'Turgi'),
(597, 'Schafisheim'),
(598, 'Courrendlin'),
(599, 'Birmenstorf'),
(600, 'Müllheim'),
(601, 'Mühleberg'),
(602, 'Murgenthal'),
(603, 'Meisterschwanden'),
(604, 'Chardonne'),
(605, 'Geuensee'),
(606, 'Coldrerio'),
(607, 'Schenkon'),
(608, 'Quarten'),
(609, 'Wattenwil'),
(610, 'Oberburg'),
(611, 'Waltenschwil'),
(612, 'Cadenazzo'),
(613, 'Samedan'),
(614, 'Matzingen'),
(615, 'Faido'),
(616, 'Sarmenstorf'),
(617, 'Etoy'),
(618, 'Märstetten'),
(619, 'Othmarsingen'),
(620, 'Mosnang'),
(621, 'Menznau'),
(622, 'Puidoux'),
(623, 'Commugny'),
(624, 'Täuffelen'),
(625, 'Däniken'),
(626, 'Rorbas'),
(627, 'Boswil'),
(628, 'Flims'),
(629, 'Otelfingen'),
(630, 'Niederwil'),
(631, 'Bergdietikon'),
(632, 'Ennenda'),
(633, 'Orpund'),
(634, 'Fischingen'),
(635, 'Ballwil'),
(636, 'Gretzenbach'),
(637, 'Genthod'),
(638, 'Riaz'),
(639, 'Rickenbach bei Wil'),
(640, 'Rain'),
(641, 'Horn'),
(642, 'Ettiswil'),
(643, 'Lengnau'),
(644, 'Cugy'),
(645, 'Lauterbrunnen'),
(646, 'Vionnaz'),
(647, 'Höri'),
(648, 'Oberkulm'),
(649, 'Corminboeuf'),
(650, 'Muralto'),
(651, 'Montanaire'),
(652, 'Schiers'),
(653, 'Pfaffnau'),
(654, 'Evilard'),
(655, 'Kaisten'),
(656, 'Signau'),
(657, 'Rickenbach'),
(658, 'Wilderswil'),
(659, 'Mont-sur-Rolle'),
(660, 'Broc'),
(661, 'Riva San Vitale'),
(662, 'Lenzerheide'),
(663, 'Nebikon'),
(664, 'Bioggio'),
(665, 'Hauterive'),
(666, 'Felsberg'),
(667, 'Saillon'),
(668, 'Rapperswil'),
(669, 'Lauperswil'),
(670, 'Courtételle'),
(671, 'Saignelégier'),
(672, 'La Sarraz'),
(673, 'Lonay'),
(674, 'Maggia'),
(675, 'Buchegg'),
(676, 'Froideville'),
(677, 'Saint-Cergue'),
(678, 'Endingen'),
(679, 'Neyruz'),
(680, 'Lotzwil'),
(681, 'Ringgenberg'),
(682, 'Zunzgen'),
(683, 'Inwil'),
(684, 'Ottenbach'),
(685, 'Riggisberg'),
(686, 'Affeltrangen'),
(687, 'Kemmen'),
(688, 'Büron'),
(689, 'Wimmis'),
(690, 'Bönigen'),
(691, 'Hölstein'),
(692, 'Sant’ Antonino'),
(693, 'Roveredo'),
(694, 'Wilen'),
(695, 'Untervaz'),
(696, 'Toffen'),
(697, 'Fischenthal'),
(698, 'Troinex'),
(699, 'Vandœuvres'),
(700, 'Corcelles-près-Payerne'),
(701, 'Hohenrain'),
(702, 'Puplinge'),
(703, 'Oetwil an der Limmat'),
(704, 'Meikirch'),
(705, 'Wigoltingen'),
(706, 'Saint-Léonard'),
(707, 'Eggiwil'),
(708, 'Oberdorf'),
(709, 'Thierachern'),
(710, 'Hägglingen'),
(711, 'Grône'),
(712, 'Rothenthurm'),
(713, 'Vuadens'),
(714, 'Anières'),
(715, 'Zwingen'),
(716, 'Saint-Aubin-Sauges'),
(717, 'Rüthi'),
(718, 'Unteriberg'),
(719, 'Rüderswil'),
(720, 'Novazzano'),
(721, 'Malans'),
(722, 'Wiedlisbach'),
(723, 'Freienstein'),
(724, 'Ueberstorf'),
(725, 'Lufingen'),
(726, 'Krauchthal'),
(727, 'Pfeffingen'),
(728, 'Hildisrieden'),
(729, 'Gersau'),
(730, 'Courgenay'),
(731, 'Vuisternens-devant-Romont'),
(732, 'Reconvilier'),
(733, 'Urnäsch'),
(734, 'Martigny-Combe'),
(735, 'Wangen an der Aare'),
(736, 'Riedholz'),
(737, 'Zeiningen'),
(738, 'Knonau'),
(739, 'Bardonnex'),
(740, 'Büsserach'),
(741, 'Oberbuchsiten'),
(742, 'Eiken'),
(743, 'Neunkirch'),
(744, 'Worben'),
(745, 'Corseaux'),
(746, 'Udligenswil'),
(747, 'Wolfwil'),
(748, 'Stadel bei Niederglatt'),
(749, 'Henggart'),
(750, 'Neuheim'),
(751, 'Schinznach Dorf'),
(752, 'Canobbio'),
(753, 'Diemtigen'),
(754, 'Wauwil'),
(755, 'Sankt Niklaus'),
(756, 'Chexbres'),
(757, 'Gimel'),
(758, 'Siviriez'),
(759, 'Neuendorf'),
(760, 'Knutwil'),
(761, 'Dintikon'),
(762, 'Bottighofen'),
(763, 'Cazis'),
(764, 'Hallau'),
(765, 'Ormalingen'),
(766, 'Savosa'),
(767, 'Altnau'),
(768, 'Deitingen'),
(769, 'Obergösgen'),
(770, 'Stetten'),
(771, 'Andelfingen'),
(772, 'Gruyères'),
(773, 'Ennetmoos'),
(774, 'Gontenschwil'),
(775, 'Leuggern'),
(776, 'Pontresina'),
(777, 'Castel San Pietro'),
(778, 'Aegerten'),
(779, 'Itingen'),
(780, 'Auw'),
(781, 'Seftigen'),
(782, 'Fahrwangen'),
(783, 'Meinier'),
(784, 'Villigen'),
(785, 'Werthenstein'),
(786, 'Lungern'),
(787, 'Mägenwil'),
(788, 'Corsier'),
(789, 'Jonen'),
(790, 'Marbach'),
(791, 'Wolfenschiessen'),
(792, 'Koppigen'),
(793, 'Mies'),
(794, 'Forel'),
(795, 'Kleinandelfingen'),
(796, 'Sankt Antoni'),
(797, 'Grüsch'),
(798, 'Killwangen'),
(799, 'Ersigen'),
(800, 'Wynigen'),
(801, 'Oberlunkhofen'),
(802, 'Zell'),
(803, 'Comano'),
(804, 'Alterswil'),
(805, 'Gorgier'),
(806, 'Vollèges'),
(807, 'Brütten'),
(808, 'Pfyn'),
(809, 'Andwil'),
(810, 'Recherswil'),
(811, 'Remetschwil'),
(812, 'Silenen'),
(813, 'Aeugst am Albis'),
(814, 'Flüeln'),
(815, 'Walzenhausen'),
(816, 'Wila'),
(817, 'Barbengo'),
(818, 'Val-d’Illiez'),
(819, 'Flühli'),
(820, 'Vordemwald'),
(821, 'Begnins'),
(822, 'Marthalen'),
(823, 'Churwalden'),
(824, 'Servion'),
(825, 'Raron'),
(826, 'Sattel'),
(827, 'Genolier'),
(828, 'Tolochenaz'),
(829, 'Dachsen'),
(830, 'Hochfelden'),
(831, 'Avry-sur-Matran'),
(832, 'Grolley'),
(833, 'Winznau'),
(834, 'Kallnach'),
(835, 'Oberegg'),
(836, 'Vezia'),
(837, 'Marsens'),
(838, 'Ponte Capriasca'),
(839, 'Malleray'),
(840, 'Cressier'),
(841, 'Vernayaz'),
(842, 'Nunningen'),
(843, 'Lichtensteig'),
(844, 'Dänikon'),
(845, 'Waldstatt'),
(846, 'Dardagny'),
(847, 'Röschenz'),
(848, 'Seedorf'),
(849, 'Uttwil'),
(850, 'Laax'),
(851, 'Charrat'),
(852, 'Alle'),
(853, 'Le Noirmont'),
(854, 'Grellingen'),
(855, 'Dallenwil'),
(856, 'Kirchdorf'),
(857, 'Schönenberg'),
(858, 'Arni'),
(859, 'Wolfhalden'),
(860, 'Veyras'),
(861, 'Pont-en-Ogoz'),
(862, 'Laupersdorf'),
(863, 'Biglen'),
(864, 'Vex'),
(865, 'Acquarossa'),
(866, 'Kestenholz'),
(867, 'Melide'),
(868, 'Saint-Aubin'),
(869, 'Bühler'),
(870, 'Oberweningen'),
(871, 'Niederdorf'),
(872, 'Rüeggisberg'),
(873, 'Massongex'),
(874, 'Amden'),
(875, 'Fulenbach'),
(876, 'Sorengo'),
(877, 'Brissago'),
(878, 'Römerswil'),
(879, 'Oberbipp'),
(880, 'Walkringen'),
(881, 'Avully'),
(882, 'Cugy'),
(883, 'Weiach'),
(884, 'Penthaz'),
(885, 'Künten'),
(886, 'Rehetobel'),
(887, 'Erlenbach im Simmental'),
(888, 'Eschenz'),
(889, 'Hasle'),
(890, 'Lamone'),
(891, 'Wilchingen'),
(892, 'Trogen'),
(893, 'Lengwil'),
(894, 'Hüttwilen'),
(895, 'Attinghausen'),
(896, 'Weesen'),
(897, 'Oberdorf'),
(898, 'Starrkirch'),
(899, 'La Roche'),
(900, 'Schwarzenberg'),
(901, 'Corgémont'),
(902, 'Wagenhausen'),
(903, 'Bellmund'),
(904, 'Chancy'),
(905, 'Fontenais'),
(906, 'Evolène'),
(907, 'Schleitheim'),
(908, 'Teufenthal'),
(909, 'Niederönz'),
(910, 'Langwiesen'),
(911, 'Rüschegg'),
(912, 'Koblenz'),
(913, 'Diegten'),
(914, 'Gunzgen'),
(915, 'Brislach'),
(916, 'Roche'),
(917, 'Härkingen'),
(918, 'Arisdorf'),
(919, 'Giffers'),
(920, 'Villnachern'),
(921, 'Cudrefin'),
(922, 'Wynau'),
(923, 'Eich'),
(924, 'Magliaso'),
(925, 'Chippis'),
(926, 'Sisseln'),
(927, 'Denges'),
(928, 'Eysins'),
(929, 'Saas-Fee'),
(930, 'Zäziwil'),
(931, 'Arch'),
(932, 'Güttingen'),
(933, 'Hirschthal'),
(934, 'Bière'),
(935, 'Ziefen'),
(936, 'Berg'),
(937, 'Reigoldswil'),
(938, 'Luzein'),
(939, 'Auenstein'),
(940, 'Heimiswil'),
(941, 'Porza'),
(942, 'Altishofen'),
(943, 'Lütisburg'),
(944, 'Tannay'),
(945, 'Schwellbrunn'),
(946, 'Biberstein'),
(947, 'Ossingen'),
(948, 'Wohlenschwil'),
(949, 'Pfäfers'),
(950, 'Cornaux'),
(951, 'Bellikon'),
(952, 'Seeberg'),
(953, 'Auvernier'),
(954, 'Bedano'),
(955, 'Dinhard'),
(956, 'Salgesch'),
(957, 'Herznach'),
(958, 'Homburg'),
(959, 'Duggingen'),
(960, 'Perroy'),
(961, 'Lommiswil'),
(962, 'Jongny'),
(963, 'Oberrüti'),
(964, 'Cadempino'),
(965, 'Wikon'),
(966, 'Airolo'),
(967, 'Zernez'),
(968, 'Les Breuleux'),
(969, 'Rue'),
(970, 'Buchholterberg'),
(971, 'Eichberg'),
(972, 'Matran'),
(973, 'Melchnau'),
(974, 'Niederbüren'),
(975, 'Lumino'),
(976, 'Tägerig'),
(977, 'Cottens'),
(978, 'Guggisberg'),
(979, 'Bossonnens'),
(980, 'Paudex'),
(981, 'Attiswil'),
(982, 'Aristau'),
(983, 'Rhäzüns'),
(984, 'Rohrbach'),
(985, 'Messen'),
(986, 'L’Abbaye'),
(987, 'Les Montets'),
(988, 'Löhningen'),
(989, 'Treyvaux'),
(990, 'Ramsen'),
(991, 'Apples'),
(992, 'Mumpf'),
(993, 'Veltheim'),
(994, 'Wahlen'),
(995, 'Schneisingen'),
(996, 'Rüttenen'),
(997, 'Tübach'),
(998, 'Meierskappel'),
(999, 'Mauensee'),
(1000, 'Origlio'),
(1001, 'Salmsach'),
(1002, 'Dotzigen'),
(1003, 'Egliswil'),
(1004, 'Gonten'),
(1005, 'Holziken'),
(1006, 'Riniken'),
(1007, 'Lyssach'),
(1008, 'Melano'),
(1009, 'Witterswil'),
(1010, 'Flurlingen'),
(1011, 'Thundorf'),
(1012, 'Courtelary'),
(1013, 'Lupsingen'),
(1014, 'Yens'),
(1015, 'Emmetten'),
(1016, 'Trin'),
(1017, 'Boniswil'),
(1018, 'Court'),
(1019, 'Seegräben'),
(1020, 'Wil'),
(1021, 'Stein'),
(1022, 'Courgevaux'),
(1023, 'Kappelen'),
(1024, 'Avusy'),
(1025, 'Unterlunkhofen'),
(1026, 'Semsales'),
(1027, 'Münstschemier'),
(1028, 'Heitenried'),
(1029, 'Mühlethurnen'),
(1030, 'Trélex'),
(1031, 'Schöfflisdorf'),
(1032, 'Eriswil'),
(1033, 'Salvan'),
(1034, 'Hérémence'),
(1035, 'Andermatt'),
(1036, 'Gisikon'),
(1037, 'Gravesano'),
(1038, 'Cureglia'),
(1039, 'Schönenbuch'),
(1040, 'Erlach'),
(1041, 'Vitznau'),
(1042, 'Grono'),
(1043, 'Flaach'),
(1044, 'Leukerbad'),
(1045, 'Boppelsen'),
(1046, 'Häggenschwil'),
(1047, 'Gryon'),
(1048, 'Thürnen'),
(1049, 'Develier'),
(1050, 'Stetten'),
(1051, 'Trub'),
(1052, 'Miège'),
(1053, 'Schinznach Bad'),
(1054, 'Mesocco'),
(1055, 'Sankt Ursen'),
(1056, 'Visperterminen'),
(1057, 'Le Pâquier'),
(1058, 'Bassins'),
(1059, 'Seewis im Prätigau'),
(1060, 'Pura'),
(1061, 'Aesch'),
(1062, 'Sankt Stephan'),
(1063, 'Dietwil'),
(1064, 'Champéry'),
(1065, 'Uerkheim'),
(1066, 'Matzendorf'),
(1067, 'Baltschieder'),
(1068, 'Leibstadt'),
(1069, 'Manno'),
(1070, 'Salenstein'),
(1071, 'Gilly'),
(1072, 'Holderbank'),
(1073, 'Birwinken'),
(1074, 'Täsch'),
(1075, 'Le Vaud'),
(1076, 'Rodersdorf'),
(1077, 'Hochwald'),
(1078, 'Wittnau'),
(1079, 'Villaz-Saint-Pierre'),
(1080, 'Zetzwil'),
(1081, 'Meinisberg'),
(1082, 'Lavertezzo'),
(1083, 'Seltisberg'),
(1084, 'Kandersteg'),
(1085, 'Linden'),
(1086, 'Vufflens-la-Ville'),
(1087, 'Rheinau'),
(1088, 'Bottens'),
(1089, 'Kriegstetten'),
(1090, 'Läufelfingen'),
(1091, 'Langrickenbach'),
(1092, 'Chavannes-de-Bogis'),
(1093, 'Venthône'),
(1094, 'Radelfingen'),
(1095, 'Staffelbach'),
(1096, 'Arbaz'),
(1097, 'Jussy'),
(1098, 'Luthern'),
(1099, 'Hendschiken'),
(1100, 'Evionnaz'),
(1101, 'Boltigen'),
(1102, 'Oberhelfenschwil'),
(1103, 'Kleinlützel'),
(1104, 'Ferenbalm'),
(1105, 'Leuzigen'),
(1106, 'Dürrenäsch'),
(1107, 'Grächen'),
(1108, 'Les Ponts-de-Martel'),
(1109, 'Bettwiesen'),
(1110, 'Blumenstein'),
(1111, 'Reitnau'),
(1112, 'Les Bois'),
(1113, 'Frauenkappelen'),
(1114, 'Rochefort'),
(1115, 'Bercher'),
(1116, 'Sonvilier'),
(1117, 'Buttwil'),
(1118, 'Boncourt'),
(1119, 'Orvin'),
(1120, 'Chéserex'),
(1121, 'Gingins'),
(1122, 'Tamins'),
(1123, 'Gerzensee'),
(1124, 'Lommis'),
(1125, 'Bettingen'),
(1126, 'Eclépens'),
(1127, 'Villars-le-Terroir'),
(1128, 'Marbach'),
(1129, 'Aesch'),
(1130, 'Stettfurt'),
(1131, 'Muolen'),
(1132, 'Oberstammheim'),
(1133, 'Beatenberg'),
(1134, 'La Sonnaz'),
(1135, 'Tegerfelden'),
(1136, 'La Verrerie'),
(1137, 'Bättwil'),
(1138, 'Zuoz'),
(1139, 'Aire-la-Ville'),
(1140, 'Ried bei Kerzers'),
(1141, 'Choulex'),
(1142, 'Crassier'),
(1143, 'Obergerlafingen'),
(1144, 'Niederbuchsiten'),
(1145, 'Mühlau'),
(1146, 'Günsberg'),
(1147, 'Zeihen'),
(1148, 'Twann'),
(1149, 'Gettnau'),
(1150, 'Trun'),
(1151, 'Schmiedrued'),
(1152, 'Birrwil'),
(1153, 'La Rippe'),
(1154, 'La Roche'),
(1155, 'Morschach'),
(1156, 'Cevio'),
(1157, 'Sumvitg'),
(1158, 'Jenaz'),
(1159, 'Heimenhausen'),
(1160, 'Lully'),
(1161, 'Remaufens'),
(1162, 'Wyssachen'),
(1163, 'Schnottwil'),
(1164, 'Remigen'),
(1165, 'Borex'),
(1166, 'Krattigen'),
(1167, 'Liesberg'),
(1168, 'Schlatterlehn'),
(1169, 'Waldenburg'),
(1170, 'Kappel am Albis'),
(1171, 'Leissigen'),
(1172, 'Greppen'),
(1173, 'Noville'),
(1174, 'Etagnières'),
(1175, 'Pampigny'),
(1176, 'Welschenrohr'),
(1177, 'Brusio'),
(1178, 'Wuppenau'),
(1179, 'Silvaplauna'),
(1180, 'Bünzen'),
(1181, 'Mülligen'),
(1182, 'Hagenbuch'),
(1183, 'Rechthalten'),
(1184, 'Lauerz'),
(1185, 'Sorens'),
(1186, 'Affoltern im Emmental'),
(1187, 'Rifferswil'),
(1188, 'Burgistein'),
(1189, 'Ependes'),
(1190, 'Stalden'),
(1191, 'Duillier'),
(1192, 'Morrens'),
(1193, 'Herdern'),
(1194, 'Assens'),
(1195, 'Obermumpf'),
(1196, 'Untereggen'),
(1197, 'Oberembrach'),
(1198, 'Gletterens'),
(1199, 'Wegenstetten'),
(1200, 'Buus'),
(1201, 'Yvorne'),
(1202, 'Ballaigues'),
(1203, 'Vaulruz'),
(1204, 'Innertkirchen'),
(1205, 'Hermance'),
(1206, 'Bäriswil'),
(1207, 'Dürrenroth'),
(1208, 'Fétigny'),
(1209, 'Wäldi'),
(1210, 'Stüsslingen'),
(1211, 'Giebenach'),
(1212, 'Trüllikon'),
(1213, 'Eggenwil'),
(1214, 'Freienwil'),
(1215, 'Wölflinswil'),
(1216, 'Plasselb'),
(1217, 'Mézières'),
(1218, 'Les Brenets'),
(1219, 'Schongau'),
(1220, 'Büren'),
(1221, 'Sembrancher'),
(1222, 'Sullens'),
(1223, 'Vich'),
(1224, 'Champagne'),
(1225, 'Gansingen'),
(1226, 'Haldenstein'),
(1227, 'Saint George'),
(1228, 'Dörflingen'),
(1229, 'Daillens'),
(1230, 'Baulmes'),
(1231, 'Givrins'),
(1232, 'Oeschgen'),
(1233, 'Quinto'),
(1234, 'Augst'),
(1235, 'Burg'),
(1236, 'Essertines-sur-Yverdon'),
(1237, 'Hüntwangen'),
(1238, 'La Sagne'),
(1239, 'Vorderthal'),
(1240, 'Rickenbach'),
(1241, 'Dägerlen'),
(1242, 'Cornol'),
(1243, 'Seewen'),
(1244, 'Grub'),
(1245, 'Vals'),
(1246, 'Saint Martin'),
(1247, 'Vuarrens'),
(1248, 'Cressier'),
(1249, 'L’Isle'),
(1250, 'Mörel-Filet'),
(1251, 'Igis'),
(1252, 'Tafers'),
(1253, 'Cernier'),
(1254, 'Haslen'),
(1255, 'Münster-Geschinen'),
(1256, 'Tiefencastel');

-- --------------------------------------------------------

--
-- Structure de la table `IMAGES`
--

CREATE TABLE `IMAGES` (
  `ID` int(11) NOT NULL,
  `CONTENT` longtext NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `TYPE` varchar(255) NOT NULL,
  `MAIN_IMAGE` tinyint(4) NOT NULL,
  `ARTICLES_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `USERS`
--

CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL,
  `SURNAME` varchar(45) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` varchar(20) NOT NULL,
  `ADDRESS1` varchar(255) NOT NULL,
  `ADDRESS2` varchar(255) DEFAULT NULL,
  `CITIES_ID` int(11) NOT NULL,
  `ZIP_CODE` varchar(4) NOT NULL,
  `IS_ADMIN` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `USERS`
--

INSERT INTO `USERS` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `GENDER`, `ADDRESS1`, `ADDRESS2`, `CITIES_ID`, `ZIP_CODE`, `IS_ADMIN`) VALUES
(1, 'Soares Rodrigues', 'Flavio', 'admin@gym.ch', '$2y$10$goXolnzimpX63UFOttHh9O.zcy3JrkQAVs5fg9A2C56AVMzsKI9xC', 'homme', 'Grand-Montfleury', '', 93, '1290', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ARTICLES`
--
ALTER TABLE `ARTICLES`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_ARTICLES_CATEGORIES1_idx` (`CATEGORIES_ID`);

--
-- Index pour la table `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  ADD PRIMARY KEY (`USERS_ID`,`ARTICLES_ID`),
  ADD KEY `fk_CART_ITEMS_ARTICLES1_idx` (`ARTICLES_ID`),
  ADD KEY `fk_CART_ITEMS_USERS1_idx` (`USERS_ID`);

--
-- Index pour la table `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `CITIES`
--
ALTER TABLE `CITIES`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `IMAGES`
--
ALTER TABLE `IMAGES`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_IMAGES_ARTICLES1_idx` (`ARTICLES_ID`);

--
-- Index pour la table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_USERS_CITIES1_idx` (`CITIES_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ARTICLES`
--
ALTER TABLE `ARTICLES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `CITIES`
--
ALTER TABLE `CITIES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1257;

--
-- AUTO_INCREMENT pour la table `IMAGES`
--
ALTER TABLE `IMAGES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ARTICLES`
--
ALTER TABLE `ARTICLES`
  ADD CONSTRAINT `fk_ARTICLES_CATEGORIES1` FOREIGN KEY (`CATEGORIES_ID`) REFERENCES `CATEGORIES` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  ADD CONSTRAINT `fk_CART_ITEMS_ARTICLES1` FOREIGN KEY (`ARTICLES_ID`) REFERENCES `ARTICLES` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CART_ITEMS_USERS1` FOREIGN KEY (`USERS_ID`) REFERENCES `USERS` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `IMAGES`
--
ALTER TABLE `IMAGES`
  ADD CONSTRAINT `fk_IMAGES_ARTICLES1` FOREIGN KEY (`ARTICLES_ID`) REFERENCES `ARTICLES` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `USERS`
--
ALTER TABLE `USERS`
  ADD CONSTRAINT `fk_USERS_CITIES1` FOREIGN KEY (`CITIES_ID`) REFERENCES `CITIES` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Creer un utilisateur pour la base de données
GRANT USAGE ON *.* TO `GYM_ADMIN`@`localhost` IDENTIFIED BY PASSWORD '*B2415CB57745112BC029951B95771BD951CA2243';
GRANT ALL PRIVILEGES ON `GYM`.* TO `GYM_ADMIN`@`localhost`;