-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Sep 2020 pada 07.56
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bestore-main`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(8) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `status_akun` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username`, `password`, `status_akun`) VALUES
(1, 'Admin 1', 'adm1', 'superAdmin000', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nest`
--

CREATE TABLE `tb_nest` (
  `id_nest` int(11) NOT NULL,
  `id_wlc` int(11) NOT NULL,
  `id_invite` int(11) NOT NULL,
  `id_invited` int(11) NOT NULL,
  `date-joined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `kode_paket` varchar(20) NOT NULL,
  `nilai` int(8) NOT NULL,
  `icon-status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `nama_paket`, `kode_paket`, `nilai`, `icon-status`) VALUES
(1, 'Free', 'FE', 0, 'Class-Army.svg'),
(2, 'Army', 'AR', 200000, 'Class-Army.svg'),
(3, 'Drone', 'DE', 700000, 'Class-Drone.svg'),
(4, 'Queen', 'QN', 2000000, 'Class-Queen.svg'),
(5, 'BHVC', 'BHVC', 0, 'Class-Army.svg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_patner`
--

CREATE TABLE `tb_patner` (
  `id_patner` int(11) NOT NULL,
  `nama_patner` varchar(50) NOT NULL,
  `email_patner` varchar(70) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(155) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `jns_bank` varchar(20) NOT NULL,
  `no_rek` varchar(75) NOT NULL,
  `an` varchar(75) NOT NULL,
  `alamat` text NOT NULL,
  `status_paket` int(5) NOT NULL,
  `kode_ref` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_patner`
--

INSERT INTO `tb_patner` (`id_patner`, `nama_patner`, `email_patner`, `username`, `password`, `foto`, `no_hp`, `jns_bank`, `no_rek`, `an`, `alamat`, `status_paket`, `kode_ref`) VALUES
(20091, 'Rizky Afdhillah', 'kiky7.yxz@gmail.com', 'rizky1', '$2y$10$VBBPrTpLT60bob6mwHq1M.9oUsul2suf3sQ0PgsXaG.GtFnR35Pl.', '', '', '', '', '', 'HKSN', 5, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wlc`
--

CREATE TABLE `tb_wlc` (
  `id_wlc` int(11) NOT NULL,
  `nama_wlc` varchar(50) NOT NULL,
  `email_wlc` varchar(70) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(155) NOT NULL,
  `no_hp` int(14) NOT NULL,
  `kode_ref` varchar(70) NOT NULL,
  `date-created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_nest`
--
ALTER TABLE `tb_nest`
  ADD PRIMARY KEY (`id_nest`),
  ADD KEY `tb_nest_ibfk_1` (`id_wlc`),
  ADD KEY `id_invited` (`id_invited`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tb_patner`
--
ALTER TABLE `tb_patner`
  ADD PRIMARY KEY (`id_patner`),
  ADD KEY `status_paket` (`status_paket`);

--
-- Indeks untuk tabel `tb_wlc`
--
ALTER TABLE `tb_wlc`
  ADD PRIMARY KEY (`id_wlc`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_nest`
--
ALTER TABLE `tb_nest`
  MODIFY `id_nest` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_nest`
--
ALTER TABLE `tb_nest`
  ADD CONSTRAINT `tb_nest_ibfk_1` FOREIGN KEY (`id_wlc`) REFERENCES `tb_wlc` (`id_wlc`),
  ADD CONSTRAINT `tb_nest_ibfk_2` FOREIGN KEY (`id_invited`) REFERENCES `tb_patner` (`id_patner`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
