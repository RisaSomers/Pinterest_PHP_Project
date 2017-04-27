-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 27 apr 2017 om 19:28
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `pinterest_php`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `boardID` int(11) unsigned NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `imageurl` varchar(9999) DEFAULT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `boardTitle` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boardcontainspost`
--

CREATE TABLE IF NOT EXISTS `boardcontainspost` (
  `containsPostID` int(11) unsigned NOT NULL,
  `boardID` int(11) DEFAULT NULL,
  `postID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `comments` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_item`, `comments`) VALUES
(1, 42, 3, 'Hallo'),
(2, 42, 59, 'hallo'),
(3, 42, 59, 'sdqs'),
(4, 42, 59, 'hjdsiq'),
(5, 42, 59, 'dskqljf'),
(6, 42, 59, 'dfihqsl'),
(7, 42, 59, 'hjsdkq'),
(8, 42, 59, 'hjdisqf'),
(9, 42, 59, 'hallo'),
(10, 42, 59, 'fgdhjs'),
(11, 42, 59, 'hgfdksjafg'),
(12, 42, 59, 'jfdskh'),
(13, 42, 59, 'jdfjhsfeq'),
(14, 42, 59, 'weeral'),
(15, 42, 59, 'khjdfsjqdfsj'),
(16, 42, 59, 'lkjkdskjjkldj'),
(17, 42, 59, 'iouqdsf'),
(18, 42, 44, 'jhdhdsfjlds'),
(19, 42, 59, 'kjldjkdkjd'),
(20, 42, 59, 'jkjdkjdkjl'),
(21, 42, 43, 'grfdsfds'),
(22, 42, 59, 'fgdfdgssf'),
(23, 42, 59, 'ddqdsqdsdf'),
(24, 42, 59, 'dsqsddsqds'),
(25, 42, 59, 'klklklk'),
(26, 42, 59, 'hallo avatar'),
(27, 42, 59, 'hallo avatar'),
(28, 42, 59, 'AVATAR'),
(29, 42, 59, 'halloooo'),
(30, 42, 59, 'HEY'),
(31, 42, 59, 'heyhey'),
(32, 42, 59, 'halllooooooo'),
(33, 42, 59, 'jhshlfjldshjhldfs'),
(34, 42, 59, 'hjkdhjdhjd'),
(35, 42, 59, 'dsdlkjdjkl'),
(36, 42, 62, 'kljjkdfsklj');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dislikes`
--

CREATE TABLE IF NOT EXISTS `dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

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
-- Tabelstructuur voor tabel `followlist`
--

CREATE TABLE IF NOT EXISTS `followlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_a` int(11) NOT NULL,
  `user_id_b` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `Url` longtext,
  `Beschrijving` varchar(2000) NOT NULL,
  `uploaded` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Gegevens worden geëxporteerd voor tabel `items`
--

INSERT INTO `items` (`id`, `user_id`, `Image`, `Url`, `Beschrijving`, `uploaded`, `status`, `points`) VALUES
(22, 72, '347b70ad4a62a5c5851cace08f36ae65.jpg', '', 'Cute black pug', 0, 1, 0),
(23, 72, '7131224c59b7973b2b143dc132d0b972.jpeg', '', 'Look the eyes', 0, 1, 0),
(24, 72, '48b13d221e11869dbc266658c2718e32.jpg', '', 'Yellow', 0, 1, 0),
(25, 72, '14d8600161fd27aeb8d3cb7198781bf9.jpg', '', 'Blue babedie babeda', 0, 1, 0),
(26, 72, 'd04ff43b94332890c92c428d26eb7934.jpg', '', 'Black pugles', 0, 1, 0),
(27, 72, 'c6ac6954a974a2061085d11b830cd0e9.jpg', '', 'smile', 0, 1, 0),
(28, 72, '5ce5fc7dd2295147b13e73c456645e8a.JPG', '', 'Look up', 0, 1, 0),
(29, 72, 'f36b420e4d48af97534ef826dda961ea.jpg', '', 'baby', 0, 1, 0),
(30, 72, 'ef90e803c3051784f66b4bdeb8955e91.jpg', '', 'Twin', 0, 1, 0),
(32, 72, 'ad69baab1414c422b6927cb2650cd09a.jpg', '', 'red', 0, 1, 0),
(33, 72, '5abda4b2104625448e7c90834b042ef1.jpg', '', 'Howdy', 0, 1, 0),
(34, 85, 'e506356dcb01d6a7309939c16d84b751.jpg', '', 'tongetje', 0, 1, 0),
(35, 85, '9c92fbcd7d5e5e5d8ea7dca5dc61a37d.jpg', '', 'fat', 0, 1, 0),
(36, 85, 'e453c430ab60f7818d0b50fe7fb69cf9.jpg', '', 'shy', 0, 1, 0),
(37, 85, '119f9969cc6dff5280a139ce65e147af.jpg', '', 'got3', 0, 1, 0),
(38, 85, '7477d8c2976c11f55304dcfe7adbb27d.jpg', '', 'black pugles', 0, 1, 0),
(39, 85, '563cdf9152c527b8b5448be6ec2c2443.jpg', '', 'proud', 0, 1, 0),
(40, 85, 'c3e1903627d621fd36f6e10cc91e2293.jpg', '', 'cowboy', 0, 1, 0),
(41, 85, 'e453842484580fadcce87f934aa2c9ec.jpeg', '', 'hello', 0, 1, 0),
(42, 85, '02db9cded3eea6ef638358702afae71e.jpg', '', 'lay down', 0, 1, 0),
(43, 85, '77aad3e37ec154c2326f9c7c8bc50103.jpg', '', 'cool', 0, 1, 0),
(44, 85, '3a218ad317919028cc0d4262ab057eeb.jpg', '', 'cute', 0, 1, 0),
(50, 88, NULL, 'https://pbs.twimg.com/profile_images/2631415338/9bce37ad7fe14dd716df81942294348c_400x400.png', 'Gaming logo', 0, 0, 1),
(51, 88, '228137c5486d6457530b51a441689035.png', NULL, 'This is a picture of myself', 0, 1, 0),
(53, 87, NULL, 'http://vignette3.wikia.nocookie.net/divine-reality/images/b/b8/General_Graardor.png/revision/latest?cb=20140128071535', 'Boss monsters of an MMORPG', 0, 1, 0),
(58, 89, NULL, 'http://vignette2.wikia.nocookie.net/2007scape/images/0/0b/Shark_detail.png/revision/latest?cb=20160214063425', 'kk', 1492972413, 0, 1),
(59, 42, '307c71e8aca5fb58a503669a2e64bbdd.png', NULL, 'jej', 1492980999, 1, 0),
(62, 42, 'ef7967130ec27de3c6e179dc48b15fea.png', NULL, 'kids', 1493116404, 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `items_topics`
--

CREATE TABLE IF NOT EXISTS `items_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `items_topics`
--

INSERT INTO `items_topics` (`id`, `item`, `topic`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `item_inappropriate`
--

CREATE TABLE IF NOT EXISTS `item_inappropriate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

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
(40, 59, 42);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `image` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden geëxporteerd voor tabel `topics`
--

INSERT INTO `topics` (`id`, `name`, `image`) VALUES
(1, 'Logo design', 'https://s-media-cache-ak0.pinimg.com/564x/4b/0f/1c/4b0f1c458e70541db2391b919622b1c7.jpg'),
(2, 'Design', 'https://s-media-cache-ak0.pinimg.com/564x/89/ab/da/89abda2d1c25b83aa09fb4180a7b4673.jpg'),
(3, 'Grafische ontwerp', 'https://s-media-cache-ak0.pinimg.com/564x/03/9a/49/039a4999b10eb1d446e0dd5eaff18fba.jpg'),
(4, 'Bedrijfsdesign', 'https://s-media-cache-ak0.pinimg.com/564x/d5/b1/d4/d5b1d408fdef446a6c38053dcf60c725.jpg'),
(5, 'Branding', 'https://s-media-cache-ak0.pinimg.com/564x/bb/cd/bc/bbcdbcdfac67590e4b8f2afe8e2a3ac3.jpg'),
(6, 'Illustraties', 'https://s-media-cache-ak0.pinimg.com/564x/88/51/a3/8851a3c55901da3c340cb0058e5313ca.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `avatar`, `password`) VALUES
(42, 'Thomas', 'Corbeel', 'thomas@gmail.com', 'uploads/be024fe661d471e854727039e9f97daf.png', '$2y$12$ykM.o5NFZ1cym55H5hIFJuwOcceLZkDrHceRtbkx.KF9GjWr0/gQ6'),
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
(87, 'Yoeri', 'Schoeter', 'schoeter.yoeri@hotmail.com', '', '$2y$12$eWXXbqHY/gk8U0qzZMhwLu6TZcA.6L/jPdvqRStuN9IOVTG8Mcp2y'),
(88, 'robbe', 'reygel', 'robbe.reygel@telenet.be', '', '$2y$12$3ZPO.h8oBfYBwYylXWYnee4XXo4uHg4UBI3UuHS8BpSjzfNk7yEH2'),
(89, 'karel', 'schoeter', 'schoeter.karel@hotmail.com', '', '$2y$12$IhMg6SoM9TB/4q5fChAX1OmhTFceS085kanSu2y1Pn2ptrtbBEaju'),
(90, 'Bryan', 'Verlinden', 'bryan.verlinden@gmail.com', '', '$2y$12$/qTPzcUIePNVgUxrvvHIxeacYwH5VPb..bO5kXgaoffgdXjD0eZCW'),
(91, 'Joske', 'vermeulen', 'joske@gmail.com', '', '$2y$12$csRP0Gmpwiy6eIYZdaOtKuOWkMDn8yA6Q3x/NmjHC.krAb2EAQQU2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users_topics`
--

CREATE TABLE IF NOT EXISTS `users_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `topics_id` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Gegevens worden geëxporteerd voor tabel `users_topics`
--

INSERT INTO `users_topics` (`id`, `email`, `topics_id`) VALUES
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
(49, 'schoeter.yoeri@hotmail.com', '6'),
(50, 'robbe.reygel@telenet.be', '1'),
(51, 'schoeter.karel@hotmail.com', '1'),
(52, 'bryan.verlinden@gmail.com', '1'),
(53, 'bryan.verlinden@gmail.com', '2'),
(54, 'bryan.verlinden@gmail.com', '3'),
(55, 'bryan.verlinden@gmail.com', '4'),
(56, 'bryan.verlinden@gmail.com', '5'),
(57, 'joske@gmail.com', '1'),
(58, 'joske@gmail.com', '2'),
(59, 'joske@gmail.com', '3'),
(60, 'joske@gmail.com', '4'),
(61, 'joske@gmail.com', '5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
