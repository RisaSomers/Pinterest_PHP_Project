-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 27 mrt 2017 om 12:01
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
-- Tabelstructuur voor tabel `Topics`
--

CREATE TABLE `Topics` (
  `id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Image` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Topics`
--

INSERT INTO `Topics` (`id`, `Name`, `Image`) VALUES
(5, 'Huisdieren', 'https://www.instagram.com/p/BGpNha4PFvG/?taken-by=dreamywhiteslifestyle'),
(6, 'Architectuur', 'https://www.flickr.com/photos/89036201@N00/3052553849/in/set-72157622113379204'),
(7, 'Beroemdheden', 'http://edenliaothewomb.tumblr.com/post/131559770191/tom-hiddleston-photographed-by-david-burton-for'),
(8, 'Bruiloften', 'https://s-media-cache-ak0.pinimg.com/originals/7c/73/f9/7c73f90b566b42e09f0c490c6ab8cd44.jpg'),
(9, 'Buiten', 'https://www.instagram.com/p/BCVtWTBTcBQ/?taken-by=anamericanroadstory'),
(10, 'Design', 'https://dribbble.com/shots/2421831-Daily-UI-50-Android-Wear');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Topics`
--
ALTER TABLE `Topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Topics`
--
ALTER TABLE `Topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
