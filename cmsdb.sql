-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2020 pada 17.21
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kd_barang` varchar(30) NOT NULL,
  `foto_barang` varchar(50) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `jumlah_barang` int(12) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `kd_barang`, `foto_barang`, `deskripsi`, `harga_beli`, `harga_jual`, `jumlah_barang`, `tanggal_pembelian`) VALUES
(18, 'kursi game', 'A0001', NULL, 'ku', '675', '2333', 3, '2020-03-17'),
(19, 'meja', 'A0002', NULL, 'meja', '399', '3000', 8, '2020-02-23'),
(22, 'ryco', 'A0003', NULL, 'roycoy', '3000', '4000', 4, '2020-02-26'),
(23, 'gula', 'A0004', NULL, 'gula', '1000', '20000', 3, '2020-03-18'),
(27, 'beras', 'A0006', NULL, 'beras', '3000', '240000', 7, '2020-02-27'),
(28, 'mie rebus', 'A0007', NULL, 'mie', '30000', '50000', 15, '2020-02-29'),
(30, 'Teh Bandulan', 'A0008', NULL, 'kotak gelas', '20000', '23000', 6, '2020-04-27'),
(31, 'Sabun cuci tangan', 'A0009', NULL, 'ss', '4000', '9000', 7, '2020-05-01'),
(32, 'Kopi tora', 'A0010', NULL, 's', '1000', '2000', 9, '2020-02-06'),
(33, 'Biskuit', 'A0011', NULL, 'dsd', '2000', '5000', 6, '2020-04-29'),
(34, 'Garam', 'A0012', NULL, 'dsd', '1000', '3000', 4, '2020-02-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_cust` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_kontak` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_cust`, `nama_customer`, `alamat`, `no_kontak`) VALUES
(2, 'Toko Sembako', 'Toko Sembako', 251878787);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_m` int(11) NOT NULL,
  `kd_m` varchar(22) NOT NULL,
  `nama_m` varchar(30) NOT NULL,
  `email_m` varchar(30) NOT NULL,
  `telp` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_m`, `kd_m`, `nama_m`, `email_m`, `telp`) VALUES
(1, 'M0001', 'Amailia', 'amai@hmm.com', '88777'),
(2, 'M0002', 'Ivan', 'ivan@ttt.com', '98888'),
(3, 'm0003', 'ecvi', 'evi@jj.com', '34888'),
(5, 'M0004', 'Ninis', 'ninis@emm.com', '34555'),
(6, 'M0005', 'Wibi', 'wibi@rrr.com', '76588');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_kontak` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `jumlah_pembelian` int(12) NOT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_tr` int(50) NOT NULL,
  `kd_trans` varchar(30) NOT NULL,
  `id_cust` int(11) NOT NULL DEFAULT 0,
  `nama_cust` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `kembali` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_tr`, `kd_trans`, `id_cust`, `nama_cust`, `tanggal`, `total_harga`, `bayar`, `kembali`) VALUES
(1, '20200511170146', 2, 'Ivan', '2020-02-11', '299333', '300000', '667'),
(3, '20200511171309', 1, 'Amailia', '2020-03-11', '279000', '280000', '1000'),
(4, '20200511171502', 6, 'Wibi', '2020-04-11', '110000', '120000', '10000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_barang`
--

CREATE TABLE `tr_barang` (
  `id` int(40) NOT NULL,
  `kd_tr` varchar(40) NOT NULL,
  `id_cust` int(30) NOT NULL,
  `kd_cust` varchar(30) DEFAULT NULL,
  `nama_cust` varchar(40) NOT NULL,
  `kd_barang` varchar(30) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` decimal(20,0) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_barang`
--

INSERT INTO `tr_barang` (`id`, `kd_tr`, `id_cust`, `kd_cust`, `nama_cust`, `kd_barang`, `nama_barang`, `harga`, `jumlah`, `sub_total`, `tanggal`) VALUES
(1, '20200511170146', 2, 'M0002', 'Ivan', 'A0003', 'ryco', '4000', 1, '4000', '2020-02-11'),
(2, '20200511170146', 2, 'M0002', 'Ivan', 'A0001', 'kursi game', '2333', 1, '2333', '2020-02-11'),
(3, '20200511170146', 2, 'M0002', 'Ivan', 'A0002', 'meja', '3000', 1, '3000', '2020-02-11'),
(4, '20200511170146', 2, 'M0002', 'Ivan', 'A0006', '', '240000', 1, '240000', '2020-02-11'),
(9, '20200511171309', 1, 'M0001', 'Amailia', 'A0006', 'beras', '240000', 1, '240000', '2020-03-11'),
(10, '20200511171309', 1, 'M0001', 'Amailia', 'A0008', 'Sabun cuci tangan', '23000', 1, '23000', '2020-03-11'),
(11, '20200511171309', 1, 'M0001', 'Amailia', 'A0009', 'ryco', '9000', 1, '9000', '2020-03-11'),
(12, '20200511171309', 1, 'M0001', 'Amailia', 'A0003', 'meja', '4000', 1, '4000', '2020-03-11'),
(13, '20200511171309', 1, 'M0001', 'Amailia', 'A0002', '', '3000', 1, '3000', '2020-03-11'),
(14, '20200511171502', 6, 'M0005', 'Wibi', 'A0012', 'Garam', '3000', 1, '3000', '2020-04-11'),
(15, '20200511171502', 6, 'M0005', 'Wibi', 'A0011', 'Biskuit', '5000', 1, '5000', '2020-04-11'),
(16, '20200511171502', 6, 'M0005', 'Wibi', 'A0004', 'gula', '20000', 1, '20000', '2020-04-11'),
(17, '20200511171502', 6, 'M0005', 'Wibi', 'A0007', 'mie rebus', '50000', 1, '50000', '2020-04-11'),
(18, '20200511171502', 6, 'M0005', 'Wibi', 'A0008', 'Teh Bandulan', '23000', 1, '23000', '2020-04-11'),
(19, '20200511171502', 6, 'M0005', 'Wibi', 'A0009', 'Sabun cuci tangan', '9000', 1, '9000', '2020-04-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `username`, `password`, `last_login`, `level`) VALUES
(2, 'amanda', 'amanda@gmail.com', 'amanda', '2394eeac9fc3db56189a894e221220b6089e78d3', '2018-05-05 12:53:30', 2),
(7, 'reza', 'reza@www', 'reza', 'b96dbf74436b3f73db2f27c2fb7c966eb1f47360', '2020-03-15 17:15:13', 2),
(9, 'SuperAdmin', 'sa@wert', 'sa', '3608a6d1a05aba23ea390e5f3b48203dbb7241f7', '2020-05-13 11:45:00', 1),
(10, 'sapio', 'sapi@ee.com', 'sapi', '5deb8ad84bc0859c2df64ebfa11d21c447ade46b', '2020-04-05 15:46:18', 2),
(11, 'amai', 'amai@rr.com', 'amaioon', 'df86f4ee267ccb9fedbcb63c1278c1b1a4778229', '2020-03-19 08:25:39', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kd_barang` (`kd_barang`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_m`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `FK_barang_pembelian` (`id_barang`),
  ADD KEY `FK_customer_pembelian` (`id_customer`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_tr`);

--
-- Indeks untuk tabel `tr_barang`
--
ALTER TABLE `tr_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_tr` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tr_barang`
--
ALTER TABLE `tr_barang`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `FK_barang_pembelian` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_customer_pembelian` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_cust`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
