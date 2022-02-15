-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 15 Lut 2022, 13:40
-- Wersja serwera: 10.3.22-MariaDB-0+deb10u1
-- Wersja PHP: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `test_dj`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `shipment` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `shipping_total` float NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `uuid`, `shipment`, `payment`, `client_id`, `shipping_total`, `status`, `date`) VALUES
(1, '9d0afc1b-0f04-521f-8e6a-0a8bb322d68e', 'BY_NOON', 'CASH', 'ES-468', 7.14, 'ORDER_COMPLETED', '2022-01-12 13:56:28'),
(2, 'ae297088-4bce-53b8-aeb4-b4a6cffd6201', 'BY_NOON', 'TRANSFER', 'ES-468', 1.99, 'ORDER_COMPLETED', '2022-01-18 13:54:03'),
(3, 'da72865d-9f37-5d61-a303-0c1768c259aa', 'BY_NOON', 'TRANSFER', 'KG-997', 10.12, 'ORDER_CANCELLED', '2022-01-18 13:54:03'),
(4, '82c57a61-96cf-5d21-87b7-0053cbb3a4ec', 'REGULAR', 'CASH', 'KG-997', 13.5, 'ORDER_CANCELLED', '2022-01-18 13:54:03'),
(5, '8f699689-5887-5a68-82c5-2f700853a4c7', 'BY_NOON', 'CASH', 'AW-001', 15.99, 'ORDER_RETURNED', '2022-01-03 12:00:00'),
(6, '545e2f18-ef89-52ed-a558-5c52173a02fc', 'SATURDAY', 'CASH', 'AW-001', 14.99, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-01-18 13:54:03'),
(7, '1560015d-1296-5c00-8de8-8856d6bf83c3', 'SATURDAY', 'CASH', 'AW-001', 1.23213e25, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-01-18 13:54:03'),
(8, '9a6cbf54-f9a0-5842-8181-ff1a76111a85', 'SATURDAY', 'CASH', 'ES-468', 7, 'ORDER_CANCELLED', '2022-01-12 13:56:28'),
(9, '1877430c-d28a-5f9b-b3ce-cd58e5c7ed30', 'SATURDAY', 'CASH', 'AW-001', 11.99, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-07 10:26:35'),
(10, '7011fd7d-2bf9-4bf4-bba7-f3307c8568b4', 'BY_NOON', 'TRANSFER', 'ES-468', 2.13213e28, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-07 10:28:39'),
(11, '29c0c2c4-3e9f-4482-9c52-7c2fdffa3da0', 'BY_NOON', 'CASH', 'ES-468', 1.99, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-07 10:29:12'),
(12, 'e326a706-326f-40af-9438-83977eaf76ab', 'SATURDAY', 'CASH', 'ES-468', 1.99, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-07 10:29:31'),
(13, '40376e12-f9fd-4edb-9045-fc172d9e6aec', 'SATURDAY', 'TRANSFER', 'AW-001', 9.31, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-07 10:53:14'),
(14, '1f48a658-a73a-4bca-9bae-0d83b5011ac2', 'SATURDAY', 'CASH', 'WP-123', 123, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-07 15:32:44'),
(15, '46a34058-cc53-4678-a67d-6bd4eb0e4c6a', 'BY_NOON', 'CASH', 'AW-001', 13, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-07 15:32:57'),
(16, '1a157636-b8d9-529e-bea0-9810210680dd', 'REGULAR', 'CASH', 'ES-468', 1.23213e20, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-12-04 13:54:21'),
(17, '14776cc1-cda6-4896-911b-9704a3f6163f', 'SATURDAY', 'CASH', 'AW-001', 1.1, 'ORDER_COMPLETED', '2022-02-15 06:28:15'),
(18, '5201e33d-ee6a-4d58-a4ec-1d9710c3fec7', 'SATURDAY', 'TRANSFER', 'BP-002', 14.43, 'ORDER_PROCESSED', '2022-02-15 06:29:36'),
(19, '8a63a673-9f71-4537-86e3-6d0a2fd98aae', 'BY_NOON', 'CASH', 'BP-123', 15, 'ORDER_TRANSFERED_TO_CARRIER', '2022-02-15 06:30:37'),
(20, '4a9bee29-e28e-4331-830f-f2645f7887fe', 'REGULAR', 'TRANSFER', 'DJ-696', 13.15, 'ORDER_DELIVERED', '2022-02-15 06:31:00'),
(21, '6414c33e-e61f-42d7-a006-7bb5617c3c5b', 'BY_NOON', 'TRANSFER', 'DJ-696', 9.99, 'ORDER_PROCESSED', '2022-02-15 06:31:28'),
(22, '8faafae9-7668-45a0-a433-ad3466703546', 'REGULAR', 'CASH', 'DJ-696', 13.15, 'ORDER_RETURNED', '2022-02-15 06:31:49'),
(23, '1e973259-2726-42d1-8676-ca31e9ba7c1e', 'SATURDAY', 'TRANSFER', 'KM-001', 13.99, 'ORDER_COMPLETED', '2022-02-15 06:38:27'),
(24, '32303e62-3f53-4078-a568-604c2dc13983', 'BY_NOON', 'CASH', 'KM-002', 15.99, 'ORDER_COMPLETED', '2022-02-15 06:38:41'),
(25, 'd94fec80-5067-4f34-bc03-90f66202760a', 'REGULAR', 'TRANSFER', 'KM-003', 13.99, 'ORDER_TRANSFERED_TO_CARRIER', '2022-02-15 06:39:12'),
(26, 'c70880c6-7d89-4a15-abd2-aed72fb6c48f', 'BY_NOON', 'CASH', 'AW-002', 15.99, 'ORDER_TRANSFERED_TO_FULFILLER', '2022-02-15 06:39:31');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;