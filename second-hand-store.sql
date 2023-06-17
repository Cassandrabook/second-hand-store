-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 13 jun 2023 kl 12:23
-- Serverversion: 5.7.39
-- PHP-version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `second-hand-store`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `size` varchar(32) NOT NULL,
  `price` float NOT NULL,
  `seller_id` int(11) NOT NULL,
  `sold` tinyint(1) NOT NULL,
  `date_sold` datetime DEFAULT NULL,
  `submitted_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `size`, `price`, `seller_id`, `sold`, `date_sold`, `submitted_date`) VALUES
(1, 'Valentino Garavani Rockstud pumps', '39', 3500, 1, 0, NULL, '2023-05-25 00:00:00'),
(2, 'Celine skärp vintage', '85', 995, 1, 1, '2023-06-13 11:29:38', '2023-05-25 00:00:00'),
(3, 'Polo Ralph Lauren Cayson slides sandaler', '36', 550, 2, 1, '2023-06-13 11:31:26', '2023-05-27 00:00:00'),
(4, 'Saint Laurent pumps', '37', 2795, 3, 0, NULL, '2023-05-31 00:00:00'),
(5, 'Burberry Brit kappa', '36', 5595, 4, 1, '2023-06-13 11:32:39', '2023-05-27 00:00:00'),
(6, 'Hermes polotröja', '36', 3950, 4, 1, '2023-06-13 11:33:42', '2023-05-23 00:00:00'),
(7, 'Red Valentino Shorts', 'S', 950, 2, 0, NULL, '2023-05-23 00:00:00'),
(8, 'Christian Dior tröja kashmir', 'M', 3895, 3, 0, NULL, '2023-05-15 00:00:00'),
(9, 'Valentino Garavani Rockrunner sneakers', '44', 2650, 5, 1, '2023-06-13 11:34:33', '2023-05-18 00:00:00'),
(10, 'Bottega Veneta herr sandaler 45', '45', 2500, 5, 1, '2023-06-13 11:37:04', '2023-05-25 00:00:00'),
(11, 'Off White c/o Virgil Abloh jacka', 'L', 5950, 5, 0, NULL, '2023-05-31 00:00:00'),
(13, 'Ralph Lauren Collection sandaler', '37', 1650, 4, 0, NULL, '2023-06-04 00:00:00'),
(14, 'Bottega Veneta Curve sandaletter', '41', 5950, 1, 0, NULL, '2023-06-12 10:09:12'),
(15, 'Burberry teddy bear coat kappa', '36', 13500, 2, 1, '2023-06-13 11:37:10', '2023-06-12 10:11:20'),
(16, 'Balenciaga kjol', '38', 7500, 2, 0, NULL, '2023-06-13 14:18:48');

-- --------------------------------------------------------

--
-- Tabellstruktur `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `sellers`
--

INSERT INTO `sellers` (`id`, `firstname`, `lastname`, `email`) VALUES
(1, 'Cassandra', 'Book', 'Cassandra@gmail.com'),
(2, 'Ida', 'Danielsson', 'ida@gmail.com'),
(3, 'Nikita', 'Andersson', 'nikita@gmail.com'),
(4, 'Anna', 'Lindgren', 'anna@gmail.com'),
(5, 'Jesper', 'Söderhielm', 'jesper@gmail.com');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Index för tabell `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT för tabell `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
