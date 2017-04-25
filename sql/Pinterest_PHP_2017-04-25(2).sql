-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 25 apr 2017 om 12:19
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
-- Tabelstructuur voor tabel `board`
--

CREATE TABLE `board` (
  `boardID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `imageurl` varchar(9999) DEFAULT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `boardTitle` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boardContainsPost`
--

CREATE TABLE `boardContainsPost` (
  `containsPostID` int(11) UNSIGNED NOT NULL,
  `boardID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `comments` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_item`, `comments`) VALUES
(1, 42, 3, 'Hallo');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `dislikes`
--

INSERT INTO `dislikes` (`id`, `user_id`, `post_id`) VALUES
(2, 88, 42),
(3, 88, 41),
(4, 88, 39),
(5, 88, 35),
(23, 87, 53);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `Url` varchar(200) NOT NULL,
  `Beschrijving` varchar(2000) NOT NULL,
  `uploaded` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `items`
--

INSERT INTO `items` (`id`, `user_id`, `Image`, `Url`, `Beschrijving`, `uploaded`) VALUES
(22, 72, '347b70ad4a62a5c5851cace08f36ae65.jpg', '', 'Cute black pug', 0),
(23, 72, '7131224c59b7973b2b143dc132d0b972.jpeg', '', 'Look the eyes', 0),
(24, 72, '48b13d221e11869dbc266658c2718e32.jpg', '', 'Yellow', 0),
(25, 72, '14d8600161fd27aeb8d3cb7198781bf9.jpg', '', 'Blue babedie babeda', 0),
(26, 72, 'd04ff43b94332890c92c428d26eb7934.jpg', '', 'Black pugles', 0),
(27, 72, 'c6ac6954a974a2061085d11b830cd0e9.jpg', '', 'smile', 0),
(28, 72, '5ce5fc7dd2295147b13e73c456645e8a.JPG', '', 'Look up', 0),
(29, 72, 'f36b420e4d48af97534ef826dda961ea.jpg', '', 'baby', 0),
(30, 72, 'ef90e803c3051784f66b4bdeb8955e91.jpg', '', 'Twin', 0),
(32, 72, 'ad69baab1414c422b6927cb2650cd09a.jpg', '', 'red', 0),
(33, 72, '5abda4b2104625448e7c90834b042ef1.jpg', '', 'Howdy', 0),
(34, 85, 'e506356dcb01d6a7309939c16d84b751.jpg', '', 'tongetje', 0),
(35, 85, '9c92fbcd7d5e5e5d8ea7dca5dc61a37d.jpg', '', 'fat', 0),
(36, 85, 'e453c430ab60f7818d0b50fe7fb69cf9.jpg', '', 'shy', 0),
(37, 85, '119f9969cc6dff5280a139ce65e147af.jpg', '', 'got3', 0),
(38, 85, '7477d8c2976c11f55304dcfe7adbb27d.jpg', '', 'black pugles', 0),
(39, 85, '563cdf9152c527b8b5448be6ec2c2443.jpg', '', 'proud', 0),
(40, 85, 'c3e1903627d621fd36f6e10cc91e2293.jpg', '', 'cowboy', 0),
(41, 85, 'e453842484580fadcce87f934aa2c9ec.jpeg', '', 'hello', 0),
(42, 85, '02db9cded3eea6ef638358702afae71e.jpg', '', 'lay down', 0),
(43, 85, '77aad3e37ec154c2326f9c7c8bc50103.jpg', '', 'cool', 0),
(44, 85, '3a218ad317919028cc0d4262ab057eeb.jpg', '', 'cute', 0);

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
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(2, 44, 88),
(3, 43, 88),
(4, 40, 88),
(5, 50, 88),
(6, 37, 88),
(7, 36, 88),
(37, 53, 88),
(38, 53, 89),
(39, 58, 89),
(40, 58, 87),
(42, 59, 87);

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
(75, 'Lieveke', 'Steens', 'lieveke@gmail.com', '', '$2y$11$JjjmSSgJn1IuU28DYBNJuukx.7f8/i5V7yiU5FJ1nRczkSdeIykQG'),
(76, 'Lore', 'Cornet', 'lore@gmail.com', '', '$2y$12$F5/oBgrPrioNtEnOhJOcnO63xTL/1C0gg5tV3ZP6OYvHfdv0u2c9K'),
(77, 'Ronald', 'DB', 'ronald@gmail.com', '', '$2y$12$qXZP8Ocn1exoPC/XKi/obOrCw1AMuRdUwtxq4.L8L6A6rnqiX7AQO'),
(78, 'Laurens', 'DR', 'laurens@gmail.com', '', '$2y$12$q.78HvZLEvnUn5VYvpb0EuURAtgEy/hCYcP.ARo4bZIoRKn9QOeQa'),
(79, 'Joke', 'Schouw', 'joke@gmail.com', '', '$2y$12$VpKAlq1LVjPGHxZVOyh6AOmCO9nrOYr0ZVki10UBz1tH2u8XqW78y'),
(80, 'Dorien', 'Macke', 'dorien@gmail.com', '', '$2y$12$9NDw69oZWlUIMOqUAfo45.kc/QYvsQkxuht/Fo7CwD0Xe3IMLe.SO'),
(85, 'Joost', 'Hans', 'joost@gmail.com', '', '$2y$11$KxbFahkprIvbfTDhY1kY5OSdcGTDhUUrgO9FUkyU2Zgbca.p9l9vG'),
(86, 'Hanna', 'Tolenaren', 'hanna@gmail.com', '', '$2y$12$iWni4CCVfmwyBMW7Wg9KCuvZ3PRkkamXdi6ZAPRrU.05MRwIe7I26'),
(87, 'Kevin', 'Boone', 'hello@moyadesign.be', '', '$2y$12$F/AY60RJc4iFlO1fIgPieOETd0QqCkIsuSu.BiGFhS05ZYtBzrKn2');

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
(41, 'hanna@gmail.com', '6'),
(42, 'bart@gmail.com', '1'),
(43, 'bart@gmail.com', '3'),
(44, 'bart@gmail.com', '5'),
(45, 'bob@gmail.com', '1'),
(46, 'bob@gmail.com', '3'),
(47, 'bob@gmail.com', '5'),
(48, 'bob@gmail.com', '6'),
(49, 'hello@moyadesign.be', '1'),
(50, 'hello@moyadesign.be', '2'),
(51, 'hello@moyadesign.be', '3'),
(52, 'hello@moyadesign.be', '4'),
(53, 'hello@moyadesign.be', '5'),
(54, 'hello@moyadesign.be', '6');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`boardID`),
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `boardContainsPost`
--
ALTER TABLE `boardContainsPost`
  ADD PRIMARY KEY (`containsPostID`),
  ADD KEY `postID` (`postID`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `dislikes`
--
ALTER TABLE `dislikes`
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
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
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
-- AUTO_INCREMENT voor een tabel `board`
--
ALTER TABLE `board`
  MODIFY `boardID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `boardContainsPost`
--
ALTER TABLE `boardContainsPost`
  MODIFY `containsPostID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT voor een tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT voor een tabel `items_topics`
--
ALTER TABLE `items_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT voor een tabel `Topics`
--
ALTER TABLE `Topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT voor een tabel `Users_Topics`
--
ALTER TABLE `Users_Topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `board`
--
ALTER TABLE `board`
  ADD CONSTRAINT `board_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`);

--
-- Beperkingen voor tabel `boardContainsPost`
--
ALTER TABLE `boardContainsPost`
  ADD CONSTRAINT `boardcontainspost_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `items` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
