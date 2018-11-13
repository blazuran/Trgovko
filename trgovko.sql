-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2018 at 10:50 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trgovko`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Title` varchar(100) COLLATE utf16_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Title`) VALUES
(1, 'comp');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `ID` int(11) NOT NULL,
  `Products_ID` int(11) NOT NULL,
  `Users_ID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `ID` int(11) NOT NULL,
  `Title` varchar(100) COLLATE utf16_slovenian_ci NOT NULL,
  `Categories_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `ID` int(11) NOT NULL,
  `url` varchar(2000) COLLATE utf16_slovenian_ci NOT NULL,
  `Title` varchar(50) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `Products_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Title` varchar(300) COLLATE utf16_slovenian_ci NOT NULL,
  `ProductURL` varchar(2000) COLLATE utf16_slovenian_ci NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Description` text COLLATE utf16_slovenian_ci,
  `Stores_ID` int(11) DEFAULT NULL,
  `Categories_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_has_filters`
--

CREATE TABLE `products_has_filters` (
  `ID` int(11) NOT NULL,
  `Products_ID` int(11) NOT NULL,
  `Filters_ID` int(11) NOT NULL,
  `HasFilter` int(10) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `ID` int(11) NOT NULL,
  `Name` varchar(300) COLLATE utf16_slovenian_ci NOT NULL,
  `StoreURL` varchar(2000) COLLATE utf16_slovenian_ci NOT NULL,
  `LogoURL` varchar(2000) COLLATE utf16_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`ID`, `Name`, `StoreURL`, `LogoURL`) VALUES
(1, 'BigBang', 'https://www.bigbang.si', NULL),
(2, 'BigBang', 'https://www.bigbang.si', NULL),
(3, 'BigBang', 'https://www.bigbang.si', NULL),
(4, 'BigBang', 'https://www.bigbang.si', NULL),
(5, 'BigBang', 'https://www.bigbang.si', NULL),
(6, 'BigBang', 'https://www.bigbang.si', NULL),
(7, 'BigBang', 'https://www.bigbang.si', NULL),
(8, 'BigBang', 'https://www.bigbang.si', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf16_slovenian_ci NOT NULL,
  `LastName` varchar(100) COLLATE utf16_slovenian_ci NOT NULL,
  `Email` varchar(255) COLLATE utf16_slovenian_ci NOT NULL,
  `Password` char(128) COLLATE utf16_slovenian_ci NOT NULL,
  `Admin` int(10) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `LastName`, `Email`, `Password`, `Admin`) VALUES
(2, 'Jure', 'Mrkic', 'mrkic@mail.com', '1234', 0000000000),
(3, 'Zan', 'Oblak', 'oblak@mail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 0000000000),
(4, 'Zan ', 'Oblak', 'o@mail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 0000000000),
(5, 'Jan', 'Oblak', 'j@mail.com', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 0000000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD UNIQUE KEY `Title_UNIQUE` (`Title`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`ID`,`Products_ID`,`Users_ID`),
  ADD KEY `fk_Products_has_Users_Users1_idx` (`Users_ID`),
  ADD KEY `fk_Products_has_Users_Products_idx` (`Products_ID`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD KEY `fk_Filters_Categories1_idx` (`Categories_ID`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD KEY `fk_Pictures_Products1_idx` (`Products_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD KEY `fk_Products_Stores1_idx` (`Stores_ID`),
  ADD KEY `fk_Products_Categories1_idx` (`Categories_ID`);

--
-- Indexes for table `products_has_filters`
--
ALTER TABLE `products_has_filters`
  ADD PRIMARY KEY (`ID`,`Products_ID`,`Filters_ID`),
  ADD KEY `fk_Products_has_Filters_Filters1_idx` (`Filters_ID`),
  ADD KEY `fk_Products_has_Filters_Products1_idx` (`Products_ID`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1779;

--
-- AUTO_INCREMENT for table `products_has_filters`
--
ALTER TABLE `products_has_filters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_Products_has_Users_Products` FOREIGN KEY (`Products_ID`) REFERENCES `products` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Products_has_Users_Users1` FOREIGN KEY (`Users_ID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `filters`
--
ALTER TABLE `filters`
  ADD CONSTRAINT `fk_Filters_Categories1` FOREIGN KEY (`Categories_ID`) REFERENCES `categories` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_Pictures_Products1` FOREIGN KEY (`Products_ID`) REFERENCES `products` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_Products_Categories1` FOREIGN KEY (`Categories_ID`) REFERENCES `categories` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Products_Stores1` FOREIGN KEY (`Stores_ID`) REFERENCES `stores` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products_has_filters`
--
ALTER TABLE `products_has_filters`
  ADD CONSTRAINT `fk_Products_has_Filters_Filters1` FOREIGN KEY (`Filters_ID`) REFERENCES `filters` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Products_has_Filters_Products1` FOREIGN KEY (`Products_ID`) REFERENCES `products` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
