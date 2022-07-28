-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2022 pada 08.25
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tambal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `edge`
--

CREATE TABLE `edge` (
  `id` int(11) NOT NULL,
  `vertex_before` int(11) NOT NULL,
  `vertex_after` int(11) NOT NULL,
  `jarak` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `edge`
--

INSERT INTO `edge` (`id`, `vertex_before`, `vertex_after`, `jarak`) VALUES
(1, 1, 4, 71.7154),
(2, 4, 1, 71.7154),
(3, 4, 3, 216.243),
(4, 3, 4, 216.243),
(5, 1, 2, 210.535),
(6, 2, 1, 210.535),
(7, 2, 3, 69.2721),
(8, 3, 2, 69.2721),
(9, 4, 5, 99.2873),
(10, 5, 4, 99.2873),
(11, 5, 6, 228.121),
(12, 6, 5, 228.121),
(13, 3, 6, 100.741),
(14, 6, 3, 100.741),
(15, 5, 7, 136.311),
(16, 7, 5, 136.311),
(17, 7, 8, 235.794),
(18, 8, 7, 235.794),
(19, 8, 6, 137.852),
(20, 6, 8, 137.852),
(21, 8, 12, 216.322),
(22, 12, 8, 216.322),
(23, 12, 11, 140.429),
(24, 11, 12, 140.429),
(27, 11, 6, 226.088),
(28, 6, 11, 226.088),
(29, 11, 10, 104.538),
(30, 10, 11, 104.538),
(31, 10, 3, 233.408),
(32, 3, 10, 233.408),
(33, 2, 9, 237.65),
(34, 9, 2, 237.65),
(35, 9, 10, 69.7369),
(36, 10, 9, 69.7369),
(37, 7, 13, 249.829),
(38, 13, 7, 249.829),
(39, 17, 13, 277.067),
(40, 13, 17, 277.067),
(41, 13, 14, 186.821),
(42, 14, 13, 186.821),
(43, 14, 15, 146.16),
(44, 15, 14, 146.16),
(45, 15, 16, 129.303),
(46, 16, 15, 129.303),
(47, 12, 16, 206.813),
(48, 16, 12, 206.813),
(49, 14, 18, 324.969),
(50, 18, 14, 324.969),
(51, 15, 21, 344.42),
(52, 21, 15, 344.42),
(53, 19, 18, 197.527),
(54, 18, 19, 197.527),
(55, 18, 21, 115.327),
(56, 21, 18, 115.327),
(61, 19, 13, 301.705),
(62, 13, 19, 301.705),
(63, 21, 23, 157.519),
(64, 23, 21, 157.519),
(65, 23, 16, 364.296),
(66, 16, 23, 364.296),
(67, 23, 24, 152.002),
(68, 24, 23, 152.002),
(69, 22, 24, 156.233),
(70, 24, 22, 156.233),
(71, 21, 22, 152.635),
(72, 22, 21, 152.635),
(73, 22, 20, 312.889),
(74, 20, 22, 312.889),
(75, 20, 19, 138.742),
(76, 19, 20, 138.742),
(77, 9, 25, 151.583),
(78, 25, 9, 151.583);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hasil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `id_user`, `hasil`) VALUES
(1, 92158299, '92158299,15,16,12,11,10,9,a69180736');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id`, `id_user`, `longitude`, `latitude`, `waktu`) VALUES
(1, '92158299', '112.0620992', '-6.8982761', '12:14:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `id_tambal` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'tutup'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `id_tambal`, `nama`, `alamat`, `longitude`, `latitude`, `status`) VALUES
(1, 'a82348532', 'Lighting', 'Kuto', '112.05525743048844', '-6.899178548460142', 'buka'),
(2, 'a69180736', 'Budi Eko', 'Kutore', '112.06456630572148', '-6.894494832805975', 'buka'),
(3, 'a17420722', 'Eko Prasetyo', 'Kutorejo 3', '112.07675555392484', '-6.902696804709819', 'buka'),
(4, 'a51628510', 'Syahrul', 'Jalan Pahlawan', '112.07605689756679', '-6.905825569913645', 'buka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `id_tambal` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `nama`, `gambar`, `password`, `role`, `id_tambal`) VALUES
(1, 'admin@gmail.com', '', '', '$2y$10$zxdSnpILIinf6uAI.ssBZ.vvhuhofZygfcX.zehjuPlwQWWa7pGIy', 1, '0'),
(2, 'budi@gmail.com', '', '', '$2y$10$0oNiYz6/Dc/kPs0QZTcEKuWwW30q/LQFV0k5Xe7L62saEW448h8SG', 2, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vertex`
--

CREATE TABLE `vertex` (
  `id` int(11) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vertex`
--

INSERT INTO `vertex` (`id`, `longitude`, `latitude`) VALUES
(1, '112.05700184846512', '-6.894027903277092'),
(2, '112.05637520174878', '-6.8958161627408145'),
(3, '112.05697225801822', '-6.89600790648656'),
(4, '112.05763379467095', '-6.894177440472404'),
(5, '112.05851133973539', '-6.894373151891486'),
(6, '112.05783233532719', '-6.896310788535857'),
(7, '112.05969979480687', '-6.894705873218939'),
(8, '112.05901324823202', '-6.896713895601167'),
(9, '112.05569101089912', '-6.897842589985416'),
(10, '112.05630278285861', '-6.897998991881977'),
(11, '112.05721549566442', '-6.898249638590912'),
(12, '112.05844451000604', '-6.8985755919591725'),
(13, '112.06188382175253', '-6.895294697772258'),
(14, '112.06122508183711', '-6.896842320897704'),
(15, '112.06070598036382', '-6.898051531971049'),
(16, '112.06023684666957', '-6.899117042057753'),
(17, '112.06289690969402', '-6.893014972930615'),
(18, '112.06405544895756', '-6.897645851596721'),
(19, '112.06453952867037', '-6.8959356851459575'),
(20, '112.06574560457403', '-6.8962866791044775'),
(21, '112.06376856805844', '-6.898643146499694'),
(22, '112.06509645470538', '-6.899025770112502'),
(23, '112.06341071041379', '-6.900014477063323'),
(24, '112.0647362568962', '-6.900384541933235'),
(25, '112.05525486488733', '-6.899135217822135');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `edge`
--
ALTER TABLE `edge`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vertex`
--
ALTER TABLE `vertex`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `edge`
--
ALTER TABLE `edge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `vertex`
--
ALTER TABLE `vertex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
