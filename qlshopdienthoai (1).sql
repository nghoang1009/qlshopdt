-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 24, 2025 lúc 06:06 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlshopdienthoai`
--
DROP DATABASE IF EXISTS qlshopdienthoai;
CREATE DATABASE qlshopdienthoai;
USE qlshopdienthoai;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `madh` int(10) NOT NULL,
  `masp` int(10) NOT NULL,
  `sl` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`madh`, `masp`, `sl`) VALUES
(3, 35, 1),
(3, 38, 1),
(4, 35, 1),
(5, 36, 10),
(5, 38, 1),
(5, 39, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `madm` int(10) NOT NULL,
  `tendm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`madm`, `tendm`) VALUES
(1, 'Điện thoại'),
(5, 'Phụ kiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `madh` int(10) NOT NULL,
  `makh` int(10) NOT NULL,
  `ngaydat` date NOT NULL,
  `manv` int(10) NOT NULL,
  `trigia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`madh`, `makh`, `ngaydat`, `manv`, `trigia`) VALUES
(3, 32, '2025-12-24', 29, 39690000),
(4, 32, '2025-12-24', 29, 15000000),
(5, 32, '2025-12-24', 29, 206490000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `magio` int(10) NOT NULL,
  `makh` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`magio`, `makh`) VALUES
(5, 32);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang_item`
--

CREATE TABLE `giohang_item` (
  `maitem` int(10) NOT NULL,
  `magio` int(10) NOT NULL,
  `masp` int(10) NOT NULL,
  `sl` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `makh` int(10) NOT NULL,
  `tenkh` varchar(50) NOT NULL,
  `diachi` varchar(50) DEFAULT NULL,
  `sdt` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`makh`, `tenkh`, `diachi`, `sdt`) VALUES
(32, 'theanh', 'a', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` int(10) NOT NULL,
  `tennv` varchar(50) NOT NULL,
  `diachi` varchar(50) NOT NULL,
  `sdt` varchar(30) NOT NULL,
  `ns` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `tennv`, `diachi`, `sdt`, `ns`) VALUES
(29, 'Hùng', 'a', '0', '2025-12-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` int(10) NOT NULL,
  `tensp` varchar(50) NOT NULL,
  `gia` double NOT NULL,
  `sl` int(10) NOT NULL,
  `hang` varchar(30) NOT NULL,
  `baohanh` int(30) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `madm` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `gia`, `sl`, `hang`, `baohanh`, `ghichu`, `hinhanh`, `madm`) VALUES
(35, 'Samsung S22 Ultra', 15000000, 495, 'Samsung', 12, 'Samsung S22 Ultra 256Gb', '20251220195409galaxy-s22-ultra-burgundy.jpg.webp', 1),
(36, 'Iphone 16 Pro', 17500000, 189, 'Apple', 12, 'Iphone 16 Pro 256GB', '20251222160048iphone-16-pro-titan-tu-nhien.jpg.webp', 1),
(38, 'IPhone 17', 24690000, 97, 'Apple', 12, 'IPhone 17 Màu Tím', '20251222194325iphone-17-tim.jpg.webp', 1),
(39, 'IPhone 12', 6800000, 99, 'Apple', 12, 'IPhone 12 Màu Xanh', '20251224031427iphone-12-chinh-hang-blue.jpg.webp', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `matk` int(10) NOT NULL,
  `tentk` varchar(50) NOT NULL,
  `mk` varchar(50) NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`matk`, `tentk`, `mk`, `role`) VALUES
(1, 'admin', '123', 1),
(29, 'Hùng', '123456', 2),
(32, 'theanh', '123456', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `matt` int(10) NOT NULL,
  `madh` int(10) NOT NULL,
  `phuongthuc` varchar(50) NOT NULL COMMENT 'Tiền mặt, Chuyển khoản, Thẻ, Ví điện tử',
  `ngaythanhtoan` datetime NOT NULL,
  `sotien` double NOT NULL,
  `trangthai` varchar(30) NOT NULL COMMENT 'Chờ xác nhận, Đã thanh toán, Thất bại',
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke_doanhthu`
--

CREATE TABLE `thongke_doanhthu` (
  `matk` int(10) NOT NULL,
  `ngay` date NOT NULL,
  `tongsodh` int(10) NOT NULL DEFAULT 0 COMMENT 'Tổng số đơn hàng',
  `tongdoanhthu` double NOT NULL DEFAULT 0 COMMENT 'Tổng doanh thu',
  `tongkhachhang` int(10) NOT NULL DEFAULT 0 COMMENT 'Tổng khách hàng mua',
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke_khachhang`
--

CREATE TABLE `thongke_khachhang` (
  `matk` int(10) NOT NULL,
  `makh` int(10) NOT NULL,
  `tongsodh` int(10) NOT NULL DEFAULT 0 COMMENT 'Tổng số đơn hàng',
  `tongchitieu` double NOT NULL DEFAULT 0 COMMENT 'Tổng chi tiêu',
  `lanmuagannhat` date DEFAULT NULL,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke_nhanvien`
--

CREATE TABLE `thongke_nhanvien` (
  `matk` int(10) NOT NULL,
  `manv` int(10) NOT NULL,
  `thang` int(2) NOT NULL,
  `nam` int(4) NOT NULL,
  `sodhxuly` int(10) NOT NULL DEFAULT 0 COMMENT 'Số đơn hàng xử lý',
  `doanhthu` double NOT NULL DEFAULT 0 COMMENT 'Doanh thu từ đơn hàng xử lý',
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke_sanpham`
--

CREATE TABLE `thongke_sanpham` (
  `matk` int(10) NOT NULL,
  `masp` int(10) NOT NULL,
  `thang` int(2) NOT NULL,
  `nam` int(4) NOT NULL,
  `soluongban` int(10) NOT NULL DEFAULT 0,
  `doanhthu` double NOT NULL DEFAULT 0,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongso`
--

CREATE TABLE `thongso` (
  `mats` int(10) NOT NULL,
  `tents` varchar(50) NOT NULL,
  `masp` int(10) NOT NULL,
  `giatri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `thongso`
--

INSERT INTO `thongso` (`mats`, `tents`, `masp`, `giatri`) VALUES
(20, 'RAM', 36, '8GB'),
(21, 'RAM', 38, '8GB'),
(22, 'RAM', 35, '12GB');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vanchuyen`
--

CREATE TABLE `vanchuyen` (
  `mavc` int(10) NOT NULL,
  `madh` int(10) NOT NULL,
  `makh` int(10) NOT NULL,
  `ngaygiao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `vanchuyen`
--

INSERT INTO `vanchuyen` (`mavc`, `madh`, `makh`, `ngaygiao`) VALUES
(2, 4, 32, '2025-12-26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD KEY `masp` (`masp`),
  ADD KEY `madh` (`madh`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`madm`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madh`),
  ADD KEY `makh` (`makh`),
  ADD KEY `manv` (`manv`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`magio`),
  ADD KEY `makh` (`makh`);

--
-- Chỉ mục cho bảng `giohang_item`
--
ALTER TABLE `giohang_item`
  ADD PRIMARY KEY (`maitem`),
  ADD KEY `masp` (`masp`),
  ADD KEY `magio` (`magio`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `madm` (`madm`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`matk`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`matt`),
  ADD KEY `madh` (`madh`);

--
-- Chỉ mục cho bảng `thongke_doanhthu`
--
ALTER TABLE `thongke_doanhthu`
  ADD PRIMARY KEY (`matk`),
  ADD UNIQUE KEY `ngay` (`ngay`);

--
-- Chỉ mục cho bảng `thongke_khachhang`
--
ALTER TABLE `thongke_khachhang`
  ADD PRIMARY KEY (`matk`),
  ADD UNIQUE KEY `makh_unique` (`makh`),
  ADD KEY `makh` (`makh`);

--
-- Chỉ mục cho bảng `thongke_nhanvien`
--
ALTER TABLE `thongke_nhanvien`
  ADD PRIMARY KEY (`matk`),
  ADD UNIQUE KEY `unique_nv_thang_nam` (`manv`,`thang`,`nam`),
  ADD KEY `manv` (`manv`);

--
-- Chỉ mục cho bảng `thongke_sanpham`
--
ALTER TABLE `thongke_sanpham`
  ADD PRIMARY KEY (`matk`),
  ADD UNIQUE KEY `unique_sp_thang_nam` (`masp`,`thang`,`nam`),
  ADD KEY `masp` (`masp`);

--
-- Chỉ mục cho bảng `thongso`
--
ALTER TABLE `thongso`
  ADD PRIMARY KEY (`mats`),
  ADD KEY `thongso_ibfk_1` (`masp`);

--
-- Chỉ mục cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD PRIMARY KEY (`mavc`),
  ADD KEY `makh` (`makh`),
  ADD KEY `madh` (`madh`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `madm` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madh` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `magio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `giohang_item`
--
ALTER TABLE `giohang_item`
  MODIFY `maitem` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `makh` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `manv` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `matk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `matt` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongke_doanhthu`
--
ALTER TABLE `thongke_doanhthu`
  MODIFY `matk` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongke_khachhang`
--
ALTER TABLE `thongke_khachhang`
  MODIFY `matk` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongke_nhanvien`
--
ALTER TABLE `thongke_nhanvien`
  MODIFY `matk` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongke_sanpham`
--
ALTER TABLE `thongke_sanpham`
  MODIFY `matk` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongso`
--
ALTER TABLE `thongso`
  MODIFY `mats` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  MODIFY `mavc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`);

--
-- Các ràng buộc cho bảng `giohang_item`
--
ALTER TABLE `giohang_item`
  ADD CONSTRAINT `giohang_item_ibfk_1` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`),
  ADD CONSTRAINT `giohang_item_ibfk_2` FOREIGN KEY (`magio`) REFERENCES `giohang` (`magio`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `taikhoan` (`matk`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`manv`) REFERENCES `taikhoan` (`matk`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`madm`) REFERENCES `danhmuc` (`madm`);

--
-- Các ràng buộc cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `thanhtoan_ibfk_1` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongke_khachhang`
--
ALTER TABLE `thongke_khachhang`
  ADD CONSTRAINT `thongke_khachhang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongke_nhanvien`
--
ALTER TABLE `thongke_nhanvien`
  ADD CONSTRAINT `thongke_nhanvien_ibfk_1` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongke_sanpham`
--
ALTER TABLE `thongke_sanpham`
  ADD CONSTRAINT `thongke_sanpham_ibfk_1` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongso`
--
ALTER TABLE `thongso`
  ADD CONSTRAINT `thongso_ibfk_1` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD CONSTRAINT `vanchuyen_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `vanchuyen_ibfk_2` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
