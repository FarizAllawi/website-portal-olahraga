-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2021 pada 02.50
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_olahraga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `league`
--

CREATE TABLE `league` (
  `id` int(10) NOT NULL,
  `name_league` varchar(150) NOT NULL,
  `sport_type` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `league`
--

INSERT INTO `league` (`id`, `name_league`, `sport_type`, `created_at`, `updated_at`) VALUES
(1, 'Liga 1', 1, '2021-12-08 01:09:49', '0000-00-00 00:00:00'),
(2, 'Liga Champion', 1, '2021-12-08 01:10:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
--

CREATE TABLE `media` (
  `id` int(10) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `news_slug` varchar(100) NOT NULL,
  `news_status` enum('draft','published') NOT NULL,
  `news_tags` text DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `sport_type` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `player_type`
--

CREATE TABLE `player_type` (
  `id` int(10) NOT NULL,
  `sport_type` int(10) NOT NULL,
  `player_type` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(3) NOT NULL,
  `user_id` int(10) NOT NULL,
  `news_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sport_athlete`
--

CREATE TABLE `sport_athlete` (
  `id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `age` int(3) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `backNumber` int(3) NOT NULL,
  `height` int(3) NOT NULL,
  `weight` int(3) NOT NULL,
  `date_birth` date NOT NULL,
  `playerType_id` int(10) NOT NULL,
  `sport_club` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sport_club`
--

CREATE TABLE `sport_club` (
  `id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `sport_league` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sport_match`
--

CREATE TABLE `sport_match` (
  `id` int(10) NOT NULL,
  `sport_club_1` int(10) NOT NULL,
  `sport_club_2` int(10) NOT NULL,
  `club_1_score` int(10) NOT NULL,
  `club_2_score` int(10) NOT NULL,
  `match_date` datetime NOT NULL,
  `match_status` enum('draft','published') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sport_type`
--

CREATE TABLE `sport_type` (
  `id` int(10) NOT NULL,
  `name_type` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sport_type`
--

INSERT INTO `sport_type` (`id`, `name_type`, `created_at`, `updated_at`) VALUES
(1, 'Football', '2021-12-08 00:21:28', '0000-00-00 00:00:00'),
(4, 'Basket', '2021-12-08 00:37:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `role` enum('admin','editor','user','guest') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `email`, `password`, `gender`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Fariz allawi ghozi', 'fariz.allawi', 'farizallawi24@gmail.com', 'password', 'male', 'admin', '2021-12-07 19:00:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor`
--

CREATE TABLE `visitor` (
  `id` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `user_agent` text NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_type` (`sport_type`);

--
-- Indeks untuk tabel `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sport_type` (`sport_type`);

--
-- Indeks untuk tabel `player_type`
--
ALTER TABLE `player_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_type` (`sport_type`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indeks untuk tabel `sport_athlete`
--
ALTER TABLE `sport_athlete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playerType_id` (`playerType_id`),
  ADD KEY `sport_club` (`sport_club`);

--
-- Indeks untuk tabel `sport_club`
--
ALTER TABLE `sport_club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_league` (`sport_league`);

--
-- Indeks untuk tabel `sport_match`
--
ALTER TABLE `sport_match`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_club_1` (`sport_club_1`),
  ADD KEY `sport_club_2` (`sport_club_2`);

--
-- Indeks untuk tabel `sport_type`
--
ALTER TABLE `sport_type`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `league`
--
ALTER TABLE `league`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `player_type`
--
ALTER TABLE `player_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sport_athlete`
--
ALTER TABLE `sport_athlete`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sport_club`
--
ALTER TABLE `sport_club`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sport_match`
--
ALTER TABLE `sport_match`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sport_type`
--
ALTER TABLE `sport_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `league`
--
ALTER TABLE `league`
  ADD CONSTRAINT `league_ibfk_1` FOREIGN KEY (`sport_type`) REFERENCES `sport_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
