-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 27 Paź 2017, 13:43
-- Wersja serwera: 5.6.36
-- Wersja PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `elfreits_pingpong`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ppmatch`
--

CREATE TABLE IF NOT EXISTS `ppmatch` (
  `id` int(11) NOT NULL,
  `nameone` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `nametwo` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `scoreone` int(11) NOT NULL,
  `scoretwo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ppmatch`
--

INSERT INTO `ppmatch` (`id`, `nameone`, `nametwo`, `scoreone`, `scoretwo`) VALUES
(1, 'djdj', 'hjsdghdsgo', 3, 2),
(2, 'dzejson', 'jacva', 2, 1),
(3, 'Jfjd', 'Jdjd', 2, 4),
(4, 'Jfjd', 'Jdjd', 0, 0),
(5, 'Jfjd', 'Jdjd', 0, 0),
(6, 'zkjl', 'sdjsdg', 4, 2),
(7, 'zkjl', 'sdjsdg', 0, 0),
(8, 'zkjl', 'sdjsdg', 0, 0),
(9, 'patryk', 'michal', 6, 0),
(10, 'Patryk', 'Zdzisła', 7, 2),
(11, 'xdd', 'alesłabo', 0, 0),
(12, 'xdd', 'alesłabo', 0, 0),
(13, 'sfojsf', 'jiosgdjg', 7, 7),
(14, 'sfojsf', 'jiosgdjg', 0, 0),
(15, 'sfojsf', 'jiosgdjg', 0, 0),
(16, 'sfojsf', 'jiosgdjg', 0, 0),
(17, 'sfojsf', 'jiosgdjg', 0, 0),
(18, 'sfojsf', 'jiosgdjg', 0, 0),
(19, 'sfojsf', 'jiosgdjg', 0, 0),
(20, 'desk', 'sdlfsl', 21, 12),
(21, 'sdfasdf', 'zdzd', 3, 2),
(22, 'aofkap', 'psdj', 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ppmatch`
--
ALTER TABLE `ppmatch`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ppmatch`
--
ALTER TABLE `ppmatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
