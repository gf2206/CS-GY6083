-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2024 at 03:37 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u778390814_FinalProj1`
--
CREATE DATABASE IF NOT EXISTS `u778390814_FinalProj1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u778390814_FinalProj1`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `p_checkIn`$$
CREATE DEFINER=`u778390814_root`@`127.0.0.1` PROCEDURE `p_checkIn` (IN `reservation_ID` INT)   BEGIN
set transaction isolation level serializable;
SELECT reserved_roomTypeID INTO @roomTypeID
FROM reservation
WHERE id_reservation = reservation_ID;

SELECT f_findAvailRoom(@roomTypeID) INTO @roomID;

UPDATE reservation SET room_id_room = @roomID WHERE id_reservation = reservation_ID;
UPDATE room SET roomStatus_id_roomStatus = 2 WHERE id_room = @roomID; -- Set room as occupied
commit;
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `f_findAvailRoom`$$
CREATE DEFINER=`u778390814_root`@`127.0.0.1` FUNCTION `f_findAvailRoom` (`room_type_ID` INT) RETURNS INT(11) DETERMINISTIC BEGIN

SELECT id_room INTO @roomID 
FROM room AS r 
WHERE r.roomStatus_id_roomStatus=1 
AND r.roomType_id_roomType=room_type_ID 
ORDER BY roomNum ASC LIMIT 1; -- Vacant room

RETURN @roomID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE `guest` (
  `id_guest` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL
) ;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id_guest`, `firstName`, `lastName`, `address1`, `address2`, `email`, `phone`) VALUES
(1, 'Bob', 'Jones', '12345 Main St.', 'Long Beach NY, 11561', 'bobjo@yahoo.netops', '516-432-6254'),
(2, 'Monica', 'Lall', '3421 Hanes Ct', 'Larkin, TN 33456', 'minical@gmail.com', '777-234-1234'),
(3, 'Betty', 'Sedan', '67 Mock Lines', 'Banta, VT 56478', 'betty123@rr.com', '876-987-2344'),
(4, 'Janie', 'Jones', '309 Band Ave.', 'Lost, CT 01324', 'jj@redux.com', '762-345-2121'),
(5, 'Liza', 'Lanten', '2 Box St.', 'Lazlo, TX 77654', 'llanten@lantenprod.com', '545-678-9543'),
(7, 'Harry', 'Pockey', '23 Balvach', 'Jones City, ID 73245', 'hpock@gmail.com', '212-342-3499'),
(8, 'Xi', 'Lin', '22 Fifth Ave.', 'NY, NY 10019', 'xi@cusing.com', '212-333-4455'),
(9, 'Test', 'Phone', '123 W. Main', 'Law, KS 01234', 'g@g.com', '423-122-1223'),
(10, 'Test', 'Phone2', '12 W W', 'Blo, MT 43211', 'g@go.com', '213-213-2133'),
(11, 'Michael', 'Ching', '712 Fifth Ave.', 'Suite 33D', 'bfifemayrfd@gmail.com', '949-689-7233'),
(14, 'Submit', 'Test', '12 L Ln', 'Rocky, NV 02345', 'sub@sub.com', '432-765-1111'),
(15, 'Trigger', 'Test', '12 Trigger Ct.', 'Trigger, NM 77777', 'trigger@rewardmem.com', '123-456-7890'),
(16, 'Test2', 'Trigger2', 'Trigger Ln', 'Trigger, OH 12345', 'trigger@trigger.com', '123-567-3456'),
(18, 'Sold', 'Out1', '1 Test St.', 'Test, MN', 'test@test1.com', '123-456-7890'),
(20, 'New', 'Guest', '12 G Ln', 'NY, NY 10019', 'gfgg@test.com', '332-234-2334');

--
-- Triggers `guest`
--
DROP TRIGGER IF EXISTS `guest_AFTER_INSERT`;
DELIMITER $$
CREATE TRIGGER `guest_AFTER_INSERT` AFTER INSERT ON `guest` FOR EACH ROW BEGIN
    INSERT INTO rewardMember (guest_id_guest)
    VALUES (NEW.id_guest);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guestFolio`
--

DROP TABLE IF EXISTS `guestFolio`;
CREATE TABLE `guestFolio` (
  `id_guestFolio` int(11) NOT NULL,
  `discounts` decimal(10,2) DEFAULT NULL,
  `addCharges` decimal(10,2) DEFAULT NULL,
  `subTotal` decimal(10,2) DEFAULT NULL,
  `ccNum` int(11) DEFAULT NULL,
  `finalBill` decimal(10,2) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `reservation_id_reservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guestFolio`
--

INSERT INTO `guestFolio` (`id_guestFolio`, `discounts`, `addCharges`, `subTotal`, `ccNum`, `finalBill`, `paid`, `reservation_id_reservation`) VALUES
(1, NULL, NULL, 100.00, NULL, NULL, 0, 41),
(3, -50.00, 0.00, 100.00, 2147483647, 50.00, 1, 22),
(4, NULL, NULL, 330.00, NULL, NULL, 0, 19),
(6, 0.00, 10.00, 175.00, 2147483647, 185.00, 1, 37);

-- --------------------------------------------------------

--
-- Stand-in structure for view `guest_folio_no_cc`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `guest_folio_no_cc`;
CREATE TABLE `guest_folio_no_cc` (
`firstName` varchar(45)
,`lastName` varchar(45)
,`checkOutDate` datetime
,`resRate` decimal(10,2)
,`roomNum` varchar(45)
,`finalBill` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `MostBookedGuest`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `MostBookedGuest`;
CREATE TABLE `MostBookedGuest` (
`firstName` varchar(45)
,`lastName` varchar(45)
,`TotalReservations` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `checkedOut` tinyint(1) NOT NULL DEFAULT 0,
  `source` varchar(45) DEFAULT NULL,
  `reserved_roomTypeID` int(11) NOT NULL,
  `resDate` datetime NOT NULL DEFAULT current_timestamp(),
  `checkInDate` datetime DEFAULT NULL,
  `checkOutDate` datetime DEFAULT NULL,
  `guest_id_guest` int(11) NOT NULL,
  `room_id_room` int(11) DEFAULT NULL,
  `resRate` decimal(10,2) NOT NULL DEFAULT 100.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `active`, `checkedOut`, `source`, `reserved_roomTypeID`, `resDate`, `checkInDate`, `checkOutDate`, `guest_id_guest`, `room_id_room`, `resRate`) VALUES
(1, 1, 0, 'Website', 1, '2024-04-30 13:46:28', '2024-05-01 13:46:28', '2024-05-03 13:46:28', 1, 1, 100.00),
(5, 1, 0, 'Walk In', 2, '2024-05-01 02:49:43', '2024-05-05 00:11:12', '2024-07-05 00:00:00', 8, 11, 105.00),
(6, 0, 1, 'Walk In', 1, '2024-05-01 02:49:47', '2024-05-03 00:00:00', '2024-05-04 22:29:56', 8, 8, 100.00),
(8, 1, 0, 'Web', 3, '2024-05-01 02:49:50', '2024-05-01 00:00:00', '2024-05-02 00:00:00', 8, NULL, 120.00),
(9, 1, 0, 'Website', 3, '2024-05-01 02:49:55', '2024-05-03 00:00:00', '2024-05-04 00:00:00', 8, 16, 120.00),
(10, 1, 0, 'Web', 1, '2024-05-01 02:49:56', '2024-05-03 00:00:00', '2024-05-04 00:00:00', 8, 9, 100.00),
(19, 0, 1, 'Website', 2, '2024-05-02 01:22:03', '2024-05-01 13:46:28', '2024-05-05 01:54:27', 4, 10, 110.00),
(22, 0, 1, 'Website', 4, '2024-05-02 02:33:12', '2024-07-01 13:46:28', '2024-05-05 00:57:28', 7, 19, 130.00),
(26, 1, 0, 'Website', 4, '2024-05-01 00:00:00', '2024-07-05 00:00:00', '2024-07-06 00:00:00', 8, NULL, 130.00),
(29, 1, 0, 'Website', 5, '2024-05-01 00:00:00', '2024-07-01 00:00:00', '2024-07-03 00:00:00', 10, 13, 150.00),
(30, 0, 0, 'Website', 6, '2024-05-01 00:00:00', '2024-05-03 20:52:54', '2024-05-04 03:33:15', 3, 22, 175.00),
(31, 1, 0, 'Website', 7, '2024-05-01 00:00:00', '2024-08-01 00:00:00', '2024-03-03 00:00:00', 5, 1, 110.00),
(32, 1, 0, 'Website', 6, '2024-05-03 00:00:00', '2024-08-05 00:00:00', '2024-08-06 00:00:00', 11, 2, 175.00),
(33, 1, 0, 'Website', 6, '2024-05-01 00:00:00', '2024-07-01 00:00:00', '2024-07-03 00:00:00', 5, 23, 175.00),
(34, 0, 0, 'Website', 8, '2024-05-03 00:00:00', '2024-05-03 21:24:47', '2024-05-04 21:19:20', 9, 4, 120.00),
(36, 0, 0, 'Website', 6, '2024-05-03 00:00:00', '2024-07-14 00:00:00', '2024-05-04 03:37:13', 11, NULL, 175.00),
(37, 0, 1, 'Website', 6, '2024-05-03 00:00:00', '2024-05-04 03:39:39', '2024-05-06 00:06:18', 2, 22, 175.00),
(38, 1, 0, 'Walk In', 7, '2024-05-04 00:00:00', '2024-05-05 20:52:34', '2024-09-02 00:00:00', 15, 3, 110.00),
(39, 1, 0, 'Website', 5, '2024-05-04 00:00:00', '2024-05-04 15:10:11', '2024-05-05 00:00:00', 5, 14, 150.00),
(40, 1, 0, 'Walk In', 6, '2024-05-04 00:00:00', '2024-05-04 15:54:03', '2024-05-06 00:00:00', 5, 24, 175.00),
(41, 0, 1, 'Walk In', 8, '2024-05-04 00:00:00', '2024-05-04 15:55:35', '2024-05-05 00:23:50', 5, 5, 120.00),
(42, 0, 0, 'Web', 8, '2024-05-04 00:00:00', '2024-05-04 15:57:32', '2024-05-04 15:59:45', 5, 6, 120.00),
(43, 1, 0, 'Walk In', 8, '2024-05-04 00:00:00', '2024-05-04 16:00:24', '2024-05-05 00:00:00', 5, 6, 120.00),
(44, 1, 1, 'Website', 1, '2024-05-05 00:00:00', '2024-05-05 21:10:54', '2024-05-05 21:09:30', 18, 8, 100.00),
(46, 1, 0, 'Walk In', 3, '2024-05-05 00:00:00', '2024-05-06 00:05:25', '2024-05-07 00:00:00', 2, 17, 100.00),
(47, 1, 0, 'Website', 5, '2024-05-05 00:00:00', '2024-05-06 02:58:35', '2024-07-06 00:00:00', 20, 15, 100.00);

--
-- Triggers `reservation`
--
DROP TRIGGER IF EXISTS `trg_CheckoutDate_BEFORE_CHECKOUT_RES`;
DELIMITER $$
CREATE TRIGGER `trg_CheckoutDate_BEFORE_CHECKOUT_RES` BEFORE UPDATE ON `reservation` FOR EACH ROW BEGIN
    IF OLD.active = 1 AND NEW.active = 0 THEN
        SET NEW.checkOutDate = NOW();
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_CreateFolio`;
DELIMITER $$
CREATE TRIGGER `trg_CreateFolio` AFTER UPDATE ON `reservation` FOR EACH ROW BEGIN
    IF NEW.checkedOut = 1 AND OLD.checkedOut = 0 THEN
        INSERT INTO guestFolio (reservation_id_reservation, subTotal) 
        VALUES (NEW.id_reservation, NEW.resRate*(DATEDIFF(NEW.checkOutDate,NEW.checkInDate)-1));
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_chekInDate_BEFORE_UPDATE_RES`;
DELIMITER $$
CREATE TRIGGER `trg_chekInDate_BEFORE_UPDATE_RES` BEFORE UPDATE ON `reservation` FOR EACH ROW BEGIN
    IF OLD.room_id_room IS NULL AND NEW.room_id_room IS NOT NULL THEN
        -- Set checkInDate to the current timestamp when room_id_room is updated from NULL to not NULL
        SET NEW.checkInDate = NOW();
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_rewardMember_AFTER_UPDATE_RES`;
DELIMITER $$
CREATE TRIGGER `trg_rewardMember_AFTER_UPDATE_RES` AFTER UPDATE ON `reservation` FOR EACH ROW BEGIN
    IF OLD.room_id_room IS NULL AND NEW.room_id_room IS NOT NULL THEN 
        UPDATE rewardMember 
        SET pointsTotal = pointsTotal + 10 
        WHERE guest_id_guest = OLD.guest_id_guest;
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_roomStatus_AFTER_CHECKOUT`;
DELIMITER $$
CREATE TRIGGER `trg_roomStatus_AFTER_CHECKOUT` AFTER UPDATE ON `reservation` FOR EACH ROW BEGIN
    IF NEW.active = 0 THEN
        UPDATE room 
        SET roomStatus_id_roomStatus = 1
        WHERE id_room = OLD.room_id_room;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rewardMember`
--

DROP TABLE IF EXISTS `rewardMember`;
CREATE TABLE `rewardMember` (
  `id_rewardMember` int(11) NOT NULL,
  `dateJoined` datetime NOT NULL,
  `level` varchar(10) NOT NULL DEFAULT 'Bronze',
  `pointsTotal` int(11) NOT NULL DEFAULT 0,
  `guest_id_guest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rewardMember`
--

INSERT INTO `rewardMember` (`id_rewardMember`, `dateJoined`, `level`, `pointsTotal`, `guest_id_guest`) VALUES
(1, '2024-05-03 02:52:00', 'Bronze', 20, 8),
(2, '2024-05-03 17:09:00', 'Bronze', 0, 1),
(3, '2024-05-03 17:09:21', 'Bronze', 20, 2),
(4, '2024-05-03 17:09:31', 'Bronze', 10, 3),
(5, '2024-05-03 17:09:46', 'Gold', 60, 4),
(6, '2024-05-03 17:09:57', 'Gold', 70, 5),
(7, '2024-05-03 17:10:08', 'Bronze', 10, 7),
(8, '2024-05-03 17:10:19', 'Bronze', 10, 9),
(9, '2024-05-03 17:10:41', 'Bronze', 10, 10),
(10, '2024-05-03 17:10:47', 'Bronze', 10, 11),
(11, '2024-05-03 17:10:53', 'Bronze', 0, 14),
(12, '0000-00-00 00:00:00', 'Bronze', 10, 15),
(13, '0000-00-00 00:00:00', 'Bronze', 0, 16),
(15, '0000-00-00 00:00:00', 'Bronze', 10, 18),
(17, '0000-00-00 00:00:00', 'Gold', 50, 20);

--
-- Triggers `rewardMember`
--
DROP TRIGGER IF EXISTS `SetLevelBeforeInsert`;
DELIMITER $$
CREATE TRIGGER `SetLevelBeforeInsert` BEFORE UPDATE ON `rewardMember` FOR EACH ROW BEGIN
    SET NEW.level =
        CASE
            WHEN NEW.pointsTotal >= 50 THEN 'Gold'
            WHEN NEW.pointsTotal >= 30 THEN 'Silver'
            ELSE 'Bronze'
        END;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `roomNum` varchar(45) NOT NULL,
  `roomType_id_roomType` int(11) NOT NULL,
  `roomStatus_id_roomStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `roomNum`, `roomType_id_roomType`, `roomStatus_id_roomStatus`) VALUES
(1, '100', 7, 2),
(2, '200', 7, 2),
(3, '300', 7, 2),
(4, '110', 8, 1),
(5, '210', 8, 1),
(6, '310', 8, 1),
(7, '120', 1, 2),
(8, '220', 1, 2),
(9, '320', 1, 2),
(10, '130', 2, 1),
(11, '230', 2, 2),
(12, '330', 2, 1),
(13, '140', 5, 2),
(14, '240', 5, 2),
(15, '340', 5, 2),
(16, '150', 3, 2),
(17, '250', 3, 2),
(18, '350', 3, 1),
(19, '160', 4, 1),
(20, '260', 4, 1),
(21, '360', 4, 3),
(22, '170', 6, 1),
(23, '270', 6, 2),
(24, '370', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roomStatus`
--

DROP TABLE IF EXISTS `roomStatus`;
CREATE TABLE `roomStatus` (
  `id_roomStatus` int(11) NOT NULL,
  `roomStatus` varchar(45) NOT NULL DEFAULT 'Vacant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roomStatus`
--

INSERT INTO `roomStatus` (`id_roomStatus`, `roomStatus`) VALUES
(1, 'Vacant'),
(2, 'Occupied'),
(3, 'Dirty'),
(4, 'Out of Service'),
(5, 'Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `roomType`
--

DROP TABLE IF EXISTS `roomType`;
CREATE TABLE `roomType` (
  `id_roomType` int(11) NOT NULL,
  `roomTypeName` varchar(45) NOT NULL,
  `roomTypeDesc` varchar(45) NOT NULL,
  `adaCompliant` tinyint(4) DEFAULT 0,
  `rate` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roomType`
--

INSERT INTO `roomType` (`id_roomType`, `roomTypeName`, `roomTypeDesc`, `adaCompliant`, `rate`) VALUES
(1, 'Single Queen', 'Single Queen Room', 0, 100.00),
(2, 'Single King', 'Single King Room', 0, 110.00),
(3, 'Double Queen', 'Double Queen Room', 0, 120.00),
(4, 'Double King', 'Double King Room', 0, 130.00),
(5, 'Jr. Suite', 'Jr. Suite Room', 0, 150.00),
(6, 'Deluxe Suite', 'Deluxe Suite Room', 0, 175.00),
(7, 'Single Queen ADA', 'Single Queen Room - ADA Compliant', 1, 110.00),
(8, 'Single King ADA', 'Single King Room - ADA Compliant', 1, 120.00),
(10, 'Penthouse', 'Penthouse Suite Extra', 1, 600.00);

-- --------------------------------------------------------

--
-- Structure for view `guest_folio_no_cc`
--
DROP TABLE IF EXISTS `guest_folio_no_cc`;

DROP VIEW IF EXISTS `guest_folio_no_cc`;
CREATE ALGORITHM=UNDEFINED DEFINER=`u778390814_root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `guest_folio_no_cc`  AS SELECT `guest`.`firstName` AS `firstName`, `guest`.`lastName` AS `lastName`, `reservation`.`checkOutDate` AS `checkOutDate`, `reservation`.`resRate` AS `resRate`, `room`.`roomNum` AS `roomNum`, `guestFolio`.`finalBill` AS `finalBill` FROM (((`guest` join `reservation` on(`guest`.`id_guest` = `reservation`.`guest_id_guest`)) join `guestFolio` on(`reservation`.`id_reservation` = `guestFolio`.`reservation_id_reservation`)) join `room` on(`reservation`.`room_id_room` = `room`.`id_room`)) ;

-- --------------------------------------------------------

--
-- Structure for view `MostBookedGuest`
--
DROP TABLE IF EXISTS `MostBookedGuest`;

DROP VIEW IF EXISTS `MostBookedGuest`;
CREATE ALGORITHM=UNDEFINED DEFINER=`u778390814_root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `MostBookedGuest`  AS SELECT `g`.`firstName` AS `firstName`, `g`.`lastName` AS `lastName`, count(0) AS `TotalReservations` FROM (`guest` `g` join `reservation` `r` on(`g`.`id_guest` = `r`.`guest_id_guest`)) GROUP BY `g`.`id_guest` ORDER BY count(0) DESC LIMIT 0, 1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id_guest`);

--
-- Indexes for table `guestFolio`
--
ALTER TABLE `guestFolio`
  ADD PRIMARY KEY (`id_guestFolio`),
  ADD KEY `fk_guestFolio_reservation1` (`reservation_id_reservation`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `fk_reservation_guest_idx` (`guest_id_guest`),
  ADD KEY `fk_reservation_room1_idx` (`room_id_room`);

--
-- Indexes for table `rewardMember`
--
ALTER TABLE `rewardMember`
  ADD PRIMARY KEY (`id_rewardMember`),
  ADD KEY `fk_rewardMember_guest1_idx` (`guest_id_guest`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD UNIQUE KEY `roomNum` (`roomNum`),
  ADD KEY `fk_room_roomType1_idx` (`roomType_id_roomType`),
  ADD KEY `fk_room_roomStatus1_idx` (`roomStatus_id_roomStatus`);

--
-- Indexes for table `roomStatus`
--
ALTER TABLE `roomStatus`
  ADD PRIMARY KEY (`id_roomStatus`);

--
-- Indexes for table `roomType`
--
ALTER TABLE `roomType`
  ADD PRIMARY KEY (`id_roomType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id_guest` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guestFolio`
--
ALTER TABLE `guestFolio`
  MODIFY `id_guestFolio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `rewardMember`
--
ALTER TABLE `rewardMember`
  MODIFY `id_rewardMember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `roomStatus`
--
ALTER TABLE `roomStatus`
  MODIFY `id_roomStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomType`
--
ALTER TABLE `roomType`
  MODIFY `id_roomType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guestFolio`
--
ALTER TABLE `guestFolio`
  ADD CONSTRAINT `fk_guestFolio_reservation1` FOREIGN KEY (`reservation_id_reservation`) REFERENCES `reservation` (`id_reservation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_guest` FOREIGN KEY (`guest_id_guest`) REFERENCES `guest` (`id_guest`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_room1` FOREIGN KEY (`room_id_room`) REFERENCES `room` (`id_room`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rewardMember`
--
ALTER TABLE `rewardMember`
  ADD CONSTRAINT `fk_rewardMember_guest1` FOREIGN KEY (`guest_id_guest`) REFERENCES `guest` (`id_guest`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_roomStatus1` FOREIGN KEY (`roomStatus_id_roomStatus`) REFERENCES `roomStatus` (`id_roomStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_room_roomType1` FOREIGN KEY (`roomType_id_roomType`) REFERENCES `roomType` (`id_roomType`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
