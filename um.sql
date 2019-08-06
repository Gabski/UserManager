-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 06 Sie 2019, 16:42
-- Wersja serwera: 10.1.37-MariaDB-0+deb9u1
-- Wersja PHP: 7.0.33-5+0~20190309015553.9+stretch~1.gbp4c6517

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `um`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addons`
--

CREATE TABLE `addons` (
  `id` int(5) UNSIGNED NOT NULL,
  `type` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `emplacement` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `addons`
--

INSERT INTO `addons` (`id`, `type`, `name`, `emplacement`) VALUES
(1, 'text', 'systemy testujące', 1),
(2, 'text', 'systemy raportowe', 1),
(3, 'checkbox', 'zna selenium', 1),
(4, 'text', 'środowiska ide', 2),
(5, 'text', 'języki programowania', 2),
(6, 'checkbox', 'zna mysql', 2),
(7, 'text', 'metodologie prowadzenia projektów', 3),
(8, 'text', 'systemy raportowe', 3),
(9, 'checkbox', 'zna scrum', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `attributes`
--

CREATE TABLE `attributes` (
  `id` int(5) UNSIGNED NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `user_id` int(5) NOT NULL,
  `addon_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `emplacements`
--

CREATE TABLE `emplacements` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `emplacements`
--

INSERT INTO `emplacements` (`id`, `name`) VALUES
(1, 'Tester'),
(2, 'Developer'),
(3, 'Project manager');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `last_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `emplacement` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emplacement` (`emplacement`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `addon_id` (`addon_id`);

--
-- Indexes for table `emplacements`
--
ALTER TABLE `emplacements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emplacement` (`emplacement`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `emplacements`
--
ALTER TABLE `emplacements`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
