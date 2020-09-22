-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Sep 2020 pada 07.18
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
-- Database: `bestore-mall`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id_invoice` int(11) NOT NULL,
  `id_patner` int(11) NOT NULL,
  `ongkos_kirim` int(8) NOT NULL,
  `total_dibayar` int(11) NOT NULL,
  `digit_terakhir` int(3) NOT NULL,
  `metode_kurir` varchar(25) NOT NULL,
  `metode_bayar` varchar(25) NOT NULL,
  `bukti_bayar` varchar(125) NOT NULL,
  `tgl_beli` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tgl_batas` varchar(50) NOT NULL,
  `status_invoice` enum('1','2','3','4','5','6','7','8') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_invoice`
--

INSERT INTO `tb_invoice` (`id_invoice`, `id_patner`, `ongkos_kirim`, `total_dibayar`, `digit_terakhir`, `metode_kurir`, `metode_bayar`, `bukti_bayar`, `tgl_beli`, `tgl_batas`, `status_invoice`) VALUES
(2009141, 20090001, 30000, 8000, 712, 'jne', 'BCA', '', '2020-09-18 21:18:45', '2020-09-15 20:14:14', '1'),
(2009152, 20090001, 30000, 108000, 895, 'jne', 'BCA', '1600189634.png', '2020-09-18 22:03:17', '2020-09-16 19:06:06', '7'),
(2009163, 20090002, 10000, 1300000, 987, 'JNE', 'BCA', '123.jpg', '2020-09-18 22:22:50', '2020-09-17 06:21:00', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_produk`
--

CREATE TABLE `tb_jenis_produk` (
  `id_jenis_produk` int(11) NOT NULL,
  `id_kategori_sub` int(8) NOT NULL,
  `nama_jenis_produk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_produk`
--

INSERT INTO `tb_jenis_produk` (`id_jenis_produk`, `id_kategori_sub`, `nama_jenis_produk`) VALUES
(1, 1, 'Kursi Tamu'),
(2, 1, 'Kursi Lipat'),
(3, 1, 'Air Bag'),
(4, 2, 'Meja Lipat'),
(5, 2, 'Meja Anak-Anak'),
(6, 3, 'Tas Gunung'),
(7, 4, 'Brilly Bag'),
(8, 5, 'Korean Bagpack');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(45) NOT NULL,
  `img_kategori` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `img_kategori`) VALUES
(1, 'Furniture', 'furniture.png'),
(2, 'Bag', 'bag.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori_sub`
--

CREATE TABLE `tb_kategori_sub` (
  `id_kategori_sub` int(11) NOT NULL,
  `id_kategori` int(8) NOT NULL,
  `nama_kategori_sub` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori_sub`
--

INSERT INTO `tb_kategori_sub` (`id_kategori_sub`, `id_kategori`, `nama_kategori_sub`) VALUES
(1, 1, 'Kursi'),
(2, 1, 'Meja'),
(3, 2, 'Tas Ransel Pria'),
(4, 2, 'Tas Kulit Pria'),
(5, 2, 'Tas Ransel Wanita');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_patner` int(11) NOT NULL,
  `qty` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `id_produk`, `id_patner`, `qty`) VALUES
(53, 15, 20091, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_toko` int(8) NOT NULL,
  `nama_produk` varchar(75) NOT NULL,
  `harga` int(8) NOT NULL,
  `deskripsi` text NOT NULL,
  `berat` int(8) NOT NULL,
  `jns_produk` int(8) NOT NULL,
  `stok` int(8) NOT NULL,
  `status_stok` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_toko`, `nama_produk`, `harga`, `deskripsi`, `berat`, `jns_produk`, `stok`, `status_stok`) VALUES
(15, 0, 'Soap Clone ', 8000, 'Sabun Kecantikan', 40, 4, 0, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk_img`
--

CREATE TABLE `tb_produk_img` (
  `id_produk_img` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_img` varchar(75) NOT NULL,
  `nama_folder` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk_img`
--

INSERT INTO `tb_produk_img` (`id_produk_img`, `id_produk`, `nama_img`, `nama_folder`) VALUES
(17, 15, '16001969031.jpeg', '@bestore-product'),
(19, 15, 'soap-1.jpeg', '@bestore-product'),
(20, 15, 'soap-2.jpeg', '@bestore-product'),
(21, 15, 'soap-3.jpeg', '@bestore-product'),
(22, 15, 'soap-4.jpeg', '@bestore-product'),
(23, 15, 'soap-5.jpeg', '@bestore-product');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk_video`
--

CREATE TABLE `tb_produk_video` (
  `id_produk_video` int(11) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `nama_video` varchar(70) NOT NULL,
  `nama_folder` varchar(45) NOT NULL,
  `nama_thumb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `id_penjual` int(8) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `logo_img` varchar(50) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `nama_folder` varchar(50) NOT NULL,
  `sub-domain` varchar(145) NOT NULL,
  `status_toko` enum('1','2') NOT NULL,
  `create-date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `id_penjual`, `nama_toko`, `logo_img`, `no_telp`, `alamat`, `kota`, `nama_folder`, `sub-domain`, `status_toko`, `create-date`) VALUES
(0, 0, 'Bestore Product', 'profile-bestore.png', '', '', '', '@bestore-product', '', '1', '0000-00-00 00:00:00'),
(17, 20091, 'Rizky Fashion', '', '', '', '', 'rizky-fashion', 'rizky-fashion', '2', '2020-09-10 04:20:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_patner` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `qty` int(8) NOT NULL,
  `status_transaksi` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_produk`, `id_patner`, `id_invoice`, `qty`, `status_transaksi`) VALUES
(2009141, 15, 20090001, 2009141, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `tb_jenis_produk`
--
ALTER TABLE `tb_jenis_produk`
  ADD PRIMARY KEY (`id_jenis_produk`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_kategori_sub`
--
ALTER TABLE `tb_kategori_sub`
  ADD PRIMARY KEY (`id_kategori_sub`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `jns_produk` (`jns_produk`);

--
-- Indeks untuk tabel `tb_produk_img`
--
ALTER TABLE `tb_produk_img`
  ADD PRIMARY KEY (`id_produk_img`);

--
-- Indeks untuk tabel `tb_produk_video`
--
ALTER TABLE `tb_produk_video`
  ADD PRIMARY KEY (`id_produk_video`);

--
-- Indeks untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_produk`
--
ALTER TABLE `tb_jenis_produk`
  MODIFY `id_jenis_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori_sub`
--
ALTER TABLE `tb_kategori_sub`
  MODIFY `id_kategori_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_produk_img`
--
ALTER TABLE `tb_produk_img`
  MODIFY `id_produk_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_produk_video`
--
ALTER TABLE `tb_produk_video`
  MODIFY `id_produk_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`jns_produk`) REFERENCES `tb_jenis_produk` (`id_jenis_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
