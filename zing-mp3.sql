-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 28, 2024 lúc 09:25 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `zing-mp3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `name`, `password`) VALUES
(1, 'ncthanh35@gmail.com', 'chithanh', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_singerlist`
--

CREATE TABLE `tb_singerlist` (
  `id_singer` int(11) NOT NULL,
  `nameSG` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `genderSG` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tb_singerlist`
--

INSERT INTO `tb_singerlist` (`id_singer`, `nameSG`, `genderSG`) VALUES
(2, 'Hồ quang Hiêu', 'Nam'),
(7, 'thành đạt', 'male'),
(8, 'Hoài Lâm', 'male'),
(9, 'nguyễn đình vũ', 'male'),
(10, 'trung quân', 'male'),
(14, 'trấn thành', 'male'),
(15, 'trung quân', 'male'),
(16, 'sơn tùng', 'male'),
(17, 'lâm chân khang', 'male');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_songlist`
--

CREATE TABLE `tb_songlist` (
  `id_song` int(11) NOT NULL,
  `nameS` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imageS` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_singer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tb_songlist`
--

INSERT INTO `tb_songlist` (`id_song`, `nameS`, `imageS`, `id_singer`) VALUES
(1, 'Ngày mai người ta lấy chồng', 'null ', 7),
(2, 'trung quân', '../asset/img/', 4),
(3, 'trung quân', '../asset/img/', 4),
(4, 'trung quen ', '../asset/img/zalo.png', 4);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tb_singerlist`
--
ALTER TABLE `tb_singerlist`
  ADD PRIMARY KEY (`id_singer`);

--
-- Chỉ mục cho bảng `tb_songlist`
--
ALTER TABLE `tb_songlist`
  ADD PRIMARY KEY (`id_song`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tb_singerlist`
--
ALTER TABLE `tb_singerlist`
  MODIFY `id_singer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tb_songlist`
--
ALTER TABLE `tb_songlist`
  MODIFY `id_song` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
