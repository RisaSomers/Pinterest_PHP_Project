-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 14 apr 2017 om 16:37
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Pinterest_PHP`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comments` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `Url` varchar(200) NOT NULL,
  `Beschrijving` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `items`
--

INSERT INTO `items` (`id`, `user_id`, `Image`, `Url`, `Beschrijving`) VALUES
(3, 0, '49048cd46d6fa23c6d6fdc2cb6ce4762.png', '', 'sxksqksqkl'),
(4, 0, 'ac525979dfc38f0809df7e644784551e.png', '', 'jdjdjdsdsjk'),
(5, 0, 'cf4741e2ff6e2631de5e773c34906a0b.png', '', 'Logo design');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `items_topics`
--

CREATE TABLE `items_topics` (
  `id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `items_topics`
--

INSERT INTO `items_topics` (`id`, `item`, `topic`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Topics`
--

CREATE TABLE `Topics` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Topics`
--

INSERT INTO `Topics` (`id`, `name`, `image`) VALUES
(1, 'Logo design', 'https://s-media-cache-ak0.pinimg.com/564x/4b/0f/1c/4b0f1c458e70541db2391b919622b1c7.jpg'),
(2, 'Design', 'https://s-media-cache-ak0.pinimg.com/564x/89/ab/da/89abda2d1c25b83aa09fb4180a7b4673.jpg'),
(3, 'Grafische ontwerp', 'https://s-media-cache-ak0.pinimg.com/564x/03/9a/49/039a4999b10eb1d446e0dd5eaff18fba.jpg'),
(4, 'Bedrijfsdesign', 'https://s-media-cache-ak0.pinimg.com/564x/d5/b1/d4/d5b1d408fdef446a6c38053dcf60c725.jpg'),
(5, 'Branding', 'https://s-media-cache-ak0.pinimg.com/564x/bb/cd/bc/bbcdbcdfac67590e4b8f2afe8e2a3ac3.jpg'),
(6, 'Illustraties', 'https://s-media-cache-ak0.pinimg.com/564x/88/51/a3/8851a3c55901da3c340cb0058e5313ca.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `firstname`, `lastname`, `email`, `avatar`, `password`) VALUES
(42, 'Thomas', 'Corbeel', 'thomas@gmail.com', '', '$2y$12$ykM.o5NFZ1cym55H5hIFJuwOcceLZkDrHceRtbkx.KF9GjWr0/gQ6'),
(43, 'Kristel', 'Pire', 'kristel@gmail.com', '', '$2y$12$umgcf3CKiZtXhPwaw7ylwucOISVgF15esmtH189CCaIPz1KVbKRbm'),
(44, 'Ann', 'Schevenels', 'ann@gmail.com', '', '$2y$12$CdOI5oCYtYztaAsTdadtLeMmYu.AlE1CVgANufCfH9XuG9UfYdOCW'),
(45, 'Lisa', 'Os', 'lisa@gmail.com', '', '$2y$12$3korR0nQMeNuQeW1VvMkPu4hgreDWH64o/I2vPrH6Xy2ZSdrS5GKq'),
(46, 'Ilyan', 'Somers', 'ilyan@gmail.com', '', '$2y$12$/1.Yo1ckPd7DSfbw264Qe.j3Ey8oQiyuW.p0eWjIkm1PVZ4va2ilG'),
(47, 'Sam', 'Van Loock', 'sam@gmail.com', '', '$2y$12$UHdpszFZXZp7t29xgstgKOJSBfGilfrjAUjGIwGHtJnjS44TmPqmS'),
(48, 'Alex', 'Heremans', 'alex@gmail.com', '', '$2y$12$8CwY2lupmjnqZITFymtxzO24gODCbL.BBfONtufdkvzYViGM1rx8e'),
(49, 'Herman', 'Somers', 'herman@gmail.com', '', '$2y$12$n0zoIpDbZStZgpLWqMDkXu3rRvgZdhTeh2RKG0yedEKB3qnnwUTaS'),
(50, 'Chiara', 'Faes', 'chiara@gmail.com', '', '$2y$12$RTvAjIjvUVBZZ5HMqO73xeS0ya2mqs6xPaP.Uj4ZG7KbvbDMhZDJm'),
(51, 'Yoeri', 'Eraerts', 'yoeri@gmail.com', '', '$2y$12$JHx4KbOY.V1krVAVtNTeoOfGMZd4aIIX8uvc2r.3TGQnapYIeUbta'),
(53, 'Tom', 'Caers', 'tom@gmail.com', '', '$2y$12$9iOPIWKqBoX5d08DHwPHjem0e0As6YaPi24a9EhIFKhj1/xetsMay'),
(54, 'Jodie', 'Van Win', 'jodie@gmail.com', '', '$2y$12$k4m5WHfCSv4L37ejmXIq/eFEVHXXsfy0t81jH76Q9Z6AQM2JsJSEi'),
(55, 'Davy', 'Ceuppens', 'davy@gmail.com', '', '$2y$12$xXU1nGq6AG8L96P2OphMbuLKkq7.XS3upP01ofsBWtxOf6pEHrsJq'),
(56, 'Sander ', 'Van Wing', 'sander@gmail.com', '', '$2y$12$DuiyzaJUc2qDHCVw5dUAiumKPf89LuTZK/KgOg0qfFL4WEYp3Q00y'),
(57, 'Patrick', 'Verbinnen', 'patrick@gmail.com', '', '$2y$12$pHUNxzqC8gBIeDkGN2SI0.xdMx/X7m2iM9dbPk8VMNmmjRjrNS2n6'),
(58, 'Thomas', 'De Wulf', 'thomasdw@gmail.com', '', '$2y$12$klHRUsIv5ud3rIP1BviZdOmwA7KDE65FjgJo/VNNeUqJRF0zUuGNy'),
(59, 'Bram', 'Dekoninck', 'bramdk@gmail.com', '', '$2y$12$ac49v1Hzjt6DLss.iR44Lu/vmp4X8rhl56AmoHf9xRvh2AN10.scq'),
(60, 'Jens', 'Wouters', 'jens@gmail.com', '', '$2y$12$LSeh6ByaHAAkvFGF1lsi3O5NLKlDiWURjAQz9bWqzaoDuvp.GRRY.'),
(61, 'Jens', 'Gilles', 'jensg@gmail.com', '', '$2y$12$7epVGEaQumF.K5pPiJ0AZutnl3sstd6i37YBYfFxhrURdpsV/0e1O'),
(62, 'Alex', 'Dazin', 'alexd@gmail.com', '', '$2y$12$DDrcvpBIhtrgfaQl6Ksp4.77hLovYF9MD3UvNYCoVhYO/08TvsSYi'),
(63, 'Jesse', 'Abeloos', 'jesse@gmail.com', '', '$2y$12$eLHYUmdND5xvHX.SdROb1uFwLUBwtybGpDV0k3pEo2S2z5WbtWluW'),
(64, 'Ben ', 'Decat', 'ben@gmail.com', '', '$2y$12$zb4u.HgdfRB1ymhpc95glu6GY6Ot4Mh2xt6YPY3y5PhfrLzLKxlI2'),
(65, 'Bert', 'Van Doren', 'bert@gmail.com', '', '$2y$12$vkTsfcd8/Au5qKwcoouR0urc6T9uMjJrvCxAA8S2DcRcVb2IzeVSi'),
(66, 'Fenne', 'Geeraerts', 'fenne@gmail.com', '', '$2y$12$dLO8a7aTr99lYuUnqvSuMeDWLLDTRKaKxk1LNwQc49tPxTGZgAjPu'),
(67, 'Jos', 'Bos', 'jos@gmail.com', '', '$2y$12$PkUJ2qo14pfZtqXcsgM6beMDuVRMM/zQ90mUQQNAEgZ1cxkkDeeSe'),
(68, 'Jos', 'Joskes', 'josj@gmail.com', '', '$2y$12$4vsF5PAlUAOw8SymTsHJzeyTtz.ww7BsPjnoTW7MjCwdPnF8kA7Fu'),
(69, 'Jasper', 'Nestor', 'jasper@gmail.com', '', '$2y$12$EsmL/Pmb2WgzydHDJbig3epbTE.eaHMC/Ae60zxfybgbo/ZJF3cyu'),
(70, 'Senne', 'Berg', 'senne@gmail.com', '', '$2y$12$AkjQgFZB3Ivbd.bJUSuUR.iKbjGOnHu6zuVWEtWbxlB0cauH73l3i'),
(71, 'Joris', 'Huang', 'joris@gmail.com', '', '$2y$12$qvtkTGFQIC7w1e803Y0bPusMbC87bY5Y9ZuKZ711VVVp14plAtBzy'),
(72, 'Kjell', 'Knapen', 'kjell@gmail.com', '', '$2y$12$Yueyz13bxScbVgS9o0lgKePtS84yCUZmh5EjWd6yfo9on0FnD/Oeu'),
(73, 'Luc', 'VDA', 'luc@gmail.com', '', '$2y$12$fqI.tePMmUHrjrWPxdfZTeKSJq9tKWhhWdhmo/mco84Gvkiw3d6t.'),
(74, 'Yann', 'VDA', 'yann@gmail.com', '', '$2y$12$JFZy8F3e/ZtfFulHZ.7KH.B2l/sc76OKj.ycO.3xNBT3kP0fqHSCK'),
(75, 'Lieve', 'Steens', 'lieve@gmail.com', '', '$2y$12$iSDFIix8ONHTD4KGAn3BHe6v.TDUAXgKntldsINOfb8uAlZ4AbvMG'),
(76, 'Lore', 'Cornet', 'lore@gmail.com', '', '$2y$12$F5/oBgrPrioNtEnOhJOcnO63xTL/1C0gg5tV3ZP6OYvHfdv0u2c9K'),
(77, 'Ronald', 'DB', 'ronald@gmail.com', '', '$2y$12$qXZP8Ocn1exoPC/XKi/obOrCw1AMuRdUwtxq4.L8L6A6rnqiX7AQO'),
(78, 'Laurens', 'DR', 'laurens@gmail.com', '', '$2y$12$q.78HvZLEvnUn5VYvpb0EuURAtgEy/hCYcP.ARo4bZIoRKn9QOeQa'),
(79, 'Joke', 'Schouw', 'joke@gmail.com', '', '$2y$12$VpKAlq1LVjPGHxZVOyh6AOmCO9nrOYr0ZVki10UBz1tH2u8XqW78y'),
(80, 'Dorien', 'Macke', 'dorien@gmail.com', '', '$2y$12$9NDw69oZWlUIMOqUAfo45.kc/QYvsQkxuht/Fo7CwD0Xe3IMLe.SO'),
(81, 'Lowieke', 'Janse', 'lowieke@gmail.com', 'ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0		\n\r\Z\Z $.\' \",#(7),01444\'9=82<.342ÿÛ\0C			\r\r2!!22222222222222222222222222222222222222222222222222ÿÀ\08€\"\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0\0ÿÄ\0B\0\0\0\0!1AQa\"q‘2¡±BÁÑáð#Rñ3b$rCc‚’4S%¢²ÿÄ\0\Z\0\0\0\0\0\0\0\0\0\0\0\0ÿÄ\0%\0\0\0\0\0\0!1A\"2QaqBÿÚ\0\0\0?\0øFS3û\"JÄ¢JÙ”9XÈà˜Ô±„R³•åDï…``RH%@l!¡ÐT¤‰ÙÂ†jð¢NØ\\#eÄe\0JíSºâDØÊ„Balû­¡Ü ÖŽWÂ”º#d(\n#²áìŠ2\"\n0Þë‚íP†˜’Ù	niE¬®™XËP¢èÀR@', '$2y$11$xYHXUXQ0QHoWWuFd1skiO.5QW7vBad30yMzMJFadZAYwcgynBThn.'),
(85, 'Joost', 'Hans', 'joost@gmail.com', '', '$2y$12$JWBMHCXIRies/tpjKM6bsO.jKzk03PIHJrLMJbK1XFHbpIyYKCozy'),
(86, 'Hanna', 'Tolenaren', 'hanna@gmail.com', '', '$2y$12$iWni4CCVfmwyBMW7Wg9KCuvZ3PRkkamXdi6ZAPRrU.05MRwIe7I26');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users_Topics`
--

CREATE TABLE `Users_Topics` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `topics_id` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Users_Topics`
--

INSERT INTO `Users_Topics` (`id`, `email`, `topics_id`) VALUES
(14, 'lieve@gmail.com', '1'),
(15, 'lieve@gmail.com', '3'),
(16, 'lieve@gmail.com', '5'),
(17, 'laurens@gmail.com', '1'),
(18, 'laurens@gmail.com', '2'),
(19, 'laurens@gmail.com', '4'),
(20, 'joke@gmail.com', '1'),
(21, 'joke@gmail.com', '3'),
(22, 'joke@gmail.com', '5'),
(23, 'dorien@gmail.com', '1'),
(24, 'dorien@gmail.com', '3'),
(25, 'dorien@gmail.com', '4'),
(26, 'lowie@gmail.com', '1'),
(27, 'lowie@gmail.com', '3'),
(28, 'lowie@gmail.com', '4'),
(29, 'lowie@gmail.com', '5'),
(30, 'lowie@gmail.com', '6'),
(31, 'hans@gmail.com', '1'),
(32, 'hans@gmail.com', '3'),
(33, 'hans@gmail.com', '4'),
(34, 'joost@gmail.com', '1'),
(35, 'joost@gmail.com', '3'),
(36, 'joost@gmail.com', '4'),
(37, 'joost@gmail.com', '5'),
(38, 'hanna@gmail.com', '1'),
(39, 'hanna@gmail.com', '2'),
(40, 'hanna@gmail.com', '5'),
(41, 'hanna@gmail.com', '6');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `items_topics`
--
ALTER TABLE `items_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Topics`
--
ALTER TABLE `Topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Users_Topics`
--
ALTER TABLE `Users_Topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `items_topics`
--
ALTER TABLE `items_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `Topics`
--
ALTER TABLE `Topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT voor een tabel `Users_Topics`
--
ALTER TABLE `Users_Topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
