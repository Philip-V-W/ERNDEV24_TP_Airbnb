-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: db-airbnb-philip-v-w
-- ------------------------------------------------------
-- Server version	5.7.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address`
(
    `id`       int(11)      NOT NULL AUTO_INCREMENT,
    `address`  varchar(255) NOT NULL,
    `city`     varchar(255) NOT NULL,
    `zip_code` varchar(255) NOT NULL,
    `country`  varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 53
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address`
    DISABLE KEYS */;
INSERT INTO `address`
VALUES (36, '4274 Shady Pines Drive', 'Jonesville', '24263', 'United States'),
       (37, '1646 Mulberry Street', 'Conroe', '24263', 'Nepal'),
       (38, '3421 Farnum Road', 'Saint Clair', '30303', 'United Kingdom'),
       (39, '2377 Centennial Farm Road', 'Kiron', '51448', 'France'),
       (40, '3927 Woodstock Drive', 'Anaheim', '92801', 'Netherlands'),
       (41, '1044 Oakridge Lane', 'Levittow', '11756', 'France'),
       (52, '23', '23', '23', '23');
/*!40000 ALTER TABLE `address`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment`
(
    `id`         int(11)      NOT NULL AUTO_INCREMENT,
    `label`      varchar(255) NOT NULL,
    `image_path` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 27
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment`
    DISABLE KEYS */;
INSERT INTO `equipment`
VALUES (1, 'Wifi', 'assets/equipment_icons/wifi.svg'),
       (2, 'TV', 'assets/equipment_icons/tv.svg'),
       (3, 'Kitchen', 'assets/equipment_icons/kitchen.svg'),
       (4, 'Washer', 'assets/equipment_icons/washer.svg'),
       (5, 'Free parking', 'assets/equipment_icons/free-parking.svg'),
       (6, 'Paid Parking', 'assets/equipment_icons/paid-parking.svg'),
       (7, 'Air conditioning', 'assets/equipment_icons/air-conditioning.svg'),
       (8, 'Dedicated workspace', 'assets/equipment_icons/dedicated-workspace.svg'),
       (9, 'Pool', 'assets/equipment_icons/pool.svg'),
       (10, 'Hot tub', 'assets/equipment_icons/hot-tub.svg'),
       (11, 'Patio', 'assets/equipment_icons/patio.svg'),
       (12, 'BBQ grill', 'assets/equipment_icons/bbq-grill.svg'),
       (13, 'Outdoor dining area', 'assets/equipment_icons/outdoor-dining-area.svg'),
       (14, 'Fire pit', 'assets/equipment_icons/fire-pit.svg'),
       (15, 'Pool table', 'assets/equipment_icons/pool-table.svg'),
       (16, 'Indoor fireplace', 'assets/equipment_icons/indoor-fireplace.svg'),
       (17, 'Piano', 'assets/equipment_icons/piano.svg'),
       (18, 'Exercise equipment', 'assets/equipment_icons/exercice-equipment.svg'),
       (19, 'Lake access', 'assets/equipment_icons/lake-access.svg'),
       (20, 'Beach access', 'assets/equipment_icons/beach-access.svg'),
       (21, 'Ski-in/Ski-out', 'assets/equipment_icons/ski-in-ski-out.svg'),
       (22, 'Outdoor shower', 'assets/equipment_icons/outdoor-shower.svg'),
       (23, 'Smoke alarm', 'assets/equipment_icons/smoke-alarm.svg'),
       (24, 'First aid kit', 'assets/equipment_icons/first-aid-kit.svg'),
       (25, 'Fire extinguisher', 'assets/equipment_icons/fire-extinguisher.svg'),
       (26, 'Carbon monoxide alarm', 'assets/equipment_icons/carbon-monoxide-alarm.svg');
/*!40000 ALTER TABLE `equipment`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite`
(
    `id`           int(11)    NOT NULL AUTO_INCREMENT,
    `residence_id` int(11)    NOT NULL,
    `user_id`      int(11)    NOT NULL,
    `is_active`    tinyint(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    KEY `residence_id` (`residence_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media`
(
    `id`           int(11) NOT NULL AUTO_INCREMENT,
    `image_path`   varchar(255) DEFAULT NULL,
    `residence_id` int(11)      DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `residence_id` (`residence_id`),
    CONSTRAINT `media_ibfk_1` FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 104
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media`
    DISABLE KEYS */;
INSERT INTO `media`
VALUES (37, 'uploads/a97b34a78f809be073ee18124c5bef15.webp', 28),
       (38, 'uploads/6140093158b71d1acd4b9a80a96099b9.webp', 28),
       (39, 'uploads/ece0ebc66a39e3b022da747394f3d42e.webp', 28),
       (40, 'uploads/104ed620bc734f1163a202a2d04ddd59.webp', 28),
       (41, 'uploads/27eab02c03b08d8418aab5b41b34e436.webp', 28),
       (42, 'uploads/c441346ee47bd829e18d1a87c16d09bc.webp', 28),
       (43, 'uploads/2613ebc5ddaa8fc8d5d54871e6230a35.webp', 28),
       (44, 'uploads/1db61121bd91e28b624b455f4a7883be.webp', 28),
       (45, 'uploads/5c4cbd2b57359d890a8c28b7cff66b1a.webp', 28),
       (46, 'uploads/dc0bbc59e64bb9c6d2f2ec4648b96ff4.webp', 28),
       (47, 'uploads/96769f182bd534a6df1f9b3e67d53c72.webp', 29),
       (48, 'uploads/da04e20efff1fcdb57132f167770d878.webp', 29),
       (49, 'uploads/dc9e69c4d6242bf472aa07babeb0e117.webp', 29),
       (50, 'uploads/50028f89c99900931d242e6c31e26035.webp', 29),
       (51, 'uploads/a59433d50c73c63941a701059364a573.webp', 29),
       (52, 'uploads/59ea77c099bf220be7b33b0440919c5d.webp', 29),
       (53, 'uploads/65b05e7296a0df0b0d285ece35f19187.webp', 29),
       (54, 'uploads/a34689a277c8fcfe8d0eeb1e6d57a9f6.webp', 29),
       (55, 'uploads/55e1fc70735a63064c55afe6a6918bf6.webp', 29),
       (56, 'uploads/7b2612aa47682e0ca4b1469de19fc19a.webp', 30),
       (57, 'uploads/01cca8f5cd498662e146f07f37079ed5.webp', 30),
       (58, 'uploads/316cf7284bda34cc869273b1bd1c83a4.webp', 30),
       (59, 'uploads/232bd09ff6eb21a06732978cd4a470b2.webp', 30),
       (60, 'uploads/688ea2ebaf10963213b0b4fbce2241a9.webp', 30),
       (61, 'uploads/9737bca73ca85b0ce69e0cf7fb4088ad.webp', 30),
       (62, 'uploads/52b1618e419b901cd302d0fb86216667.webp', 30),
       (63, 'uploads/0286c17de708a1d9fd1306c1b4ef3f72.webp', 30),
       (64, 'uploads/55e3a17a9f1bf5e1d839ee6d95f7306e.webp', 30),
       (65, 'uploads/56b716056f1b1720b92f90d946c4e2cf.webp', 30),
       (66, 'uploads/acf3840205b84decb5335778355f9662.webp', 30),
       (67, 'uploads/5a6900ad828c33bbf7ecb698b2517c00.webp', 31),
       (68, 'uploads/22ec21058c6121c48d1f0c603fe1ebde.webp', 31),
       (69, 'uploads/c0684629012e25ef046f60cf27729d6a.webp', 31),
       (70, 'uploads/e532664ef5ae226edebe7086ea748556.webp', 31),
       (71, 'uploads/1f94b275ce05cd50fdeac9c38bc3e5a6.webp', 31),
       (72, 'uploads/32159cf2927e6b003257ca1684990ecf.webp', 31),
       (73, 'uploads/ba8a77fc8d43bcea1778c37a9d367e7a.webp', 31),
       (74, 'uploads/e6bc3e7a1be62cdf98abf8837dfc115d.webp', 31),
       (75, 'uploads/00f7845a760726b3bb2d8f0596b6f050.webp', 32),
       (76, 'uploads/dd97651ab463ceb38c2b22e259738ede.webp', 32),
       (77, 'uploads/3d83771a44ab4751702c6a5f8092f42f.webp', 32),
       (78, 'uploads/8842e99d2a69f974bab6e419260a6286.webp', 32),
       (79, 'uploads/51edaecb4ac8ba53a2875f06bd59abfe.webp', 32),
       (80, 'uploads/3022c7fd2282a5d95f8b79c82a3f9487.webp', 32),
       (81, 'uploads/7d9bcfad50dd5dbecd3ad462dec055a0.webp', 32),
       (82, 'uploads/003907406db12f172f4f0d4a8ee6bf9b.webp', 33),
       (83, 'uploads/6497c55b2155d45d0a7765d9a856b39c.webp', 33),
       (84, 'uploads/da176b984dada7d673cd18e767583288.webp', 33),
       (85, 'uploads/de8e7e5e372c2b943ebfe8c7a7a11bef.webp', 33),
       (86, 'uploads/f8bcb36a96d93022b7f59961a1b7195b.webp', 33),
       (87, 'uploads/f54f2412243aa8583fc6205056bec00a.webp', 33),
       (88, 'uploads/185d44c326b982a589e5e872c318d620.webp', 33);
/*!40000 ALTER TABLE `media`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation`
(
    `id`           int(11) NOT NULL AUTO_INCREMENT,
    `date_start`   date    NOT NULL,
    `date_end`     date    NOT NULL,
    `nb_adults`    int(11) DEFAULT NULL,
    `nb_children`  int(11) DEFAULT NULL,
    `price_total`  int(11) NOT NULL,
    `residence_id` int(11) DEFAULT NULL,
    `user_id`      int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `residence_id` (`residence_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 26
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation`
    DISABLE KEYS */;
INSERT INTO `reservation`
VALUES (21, '2024-07-07', '2024-07-14', 2, 2, 630, 28, 3),
       (22, '2024-08-15', '2024-09-21', 5, 0, 7400, 33, 3);
/*!40000 ALTER TABLE `reservation`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `residence`
--

DROP TABLE IF EXISTS `residence`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `residence`
(
    `id`              int(11)      NOT NULL AUTO_INCREMENT,
    `title`           varchar(255) NOT NULL,
    `description`     text,
    `price_per_night` int(11)      NOT NULL,
    `size`            int(11)               DEFAULT NULL,
    `nb_rooms`        int(11)               DEFAULT NULL,
    `nb_beds`         int(11)               DEFAULT NULL,
    `nb_baths`        int(11)               DEFAULT NULL,
    `nb_guests`       int(11)               DEFAULT NULL,
    `is_active`       tinyint(1)   NOT NULL DEFAULT '1',
    `type_id`         int(11)               DEFAULT NULL,
    `user_id`         int(11)               DEFAULT NULL,
    `address_id`      int(11)               DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `type_id` (`type_id`),
    KEY `user_id` (`user_id`),
    KEY `address_id` (`address_id`),
    CONSTRAINT `residence_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
    CONSTRAINT `residence_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    CONSTRAINT `residence_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 45
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `residence`
--

LOCK TABLES `residence` WRITE;
/*!40000 ALTER TABLE `residence`
    DISABLE KEYS */;
INSERT INTO `residence`
VALUES (28, 'Apartment with sea view',
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut autem, blanditiis delectus dolore ducimus eveniet exercitationem illo illum impedit, in ipsam molestias nisi optio porro repellat rerum tenetur totam!\r\n\r\nConsequatur dicta dolorum facilis libero molestias qui quisquam voluptatem. Ad architecto, blanditiis cum dignissimos excepturi facere odit? Consequatur corporis delectus dignissimos eligendi in ipsum odio, quidem ratione! A, eius, non.',
        90, 56, 5, 3, 2, 4, 1, 2, 1, 36),
       (29, 'Hill Top Lodge and Restaurant',
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut autem, blanditiis delectus dolore ducimus eveniet exercitationem illo illum impedit, in ipsam molestias nisi optio porro repellat rerum tenetur totam!\r\n\r\nConsequatur dicta dolorum facilis libero molestias qui quisquam voluptatem. Ad architecto, blanditiis cum dignissimos excepturi facere odit? Consequatur corporis delectus dignissimos eligendi in ipsum odio, quidem ratione! A, eius, non.',
        106, 25, 1, 1, 1, 2, 1, 5, 1, 37),
       (30, 'Cosy En-Suite Room With Views of Lakeland Fells',
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut autem, blanditiis delectus dolore ducimus eveniet exercitationem illo illum impedit, in ipsam molestias nisi optio porro repellat rerum tenetur totam!\r\n\r\nConsequatur dicta dolorum facilis libero molestias qui quisquam voluptatem. Ad architecto, blanditiis cum dignissimos excepturi facere odit? Consequatur corporis delectus dignissimos eligendi in ipsum odio, quidem ratione! A, eius, non.',
        150, 85, 8, 3, 4, 6, 1, 9, 1, 38),
       (31, 'Chateau BouffÃ©mont',
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut autem, blanditiis delectus dolore ducimus eveniet exercitationem illo illum impedit, in ipsam molestias nisi optio porro repellat rerum tenetur totam!\r\n\r\nConsequatur dicta dolorum facilis libero molestias qui quisquam voluptatem. Ad architecto, blanditiis cum dignissimos excepturi facere odit? Consequatur corporis delectus dignissimos eligendi in ipsum odio, quidem ratione! A, eius, non.',
        6908, 783, 15, 10, 6, 20, 1, 6, 2, 39),
       (32, 'SmÃ»k Lytse Bell Tent',
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut autem, blanditiis delectus dolore ducimus eveniet exercitationem illo illum impedit, in ipsam molestias nisi optio porro repellat rerum tenetur totam!\r\n\r\nConsequatur dicta dolorum facilis libero molestias qui quisquam voluptatem. Ad architecto, blanditiis cum dignissimos excepturi facere odit? Consequatur corporis delectus dignissimos eligendi in ipsum odio, quidem ratione! A, eius, non.',
        77, 15, 1, 1, 1, 2, 1, 10, 2, 40),
       (33, 'La Grotte du Moulin de la Motte Baudoin',
        'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut autem, blanditiis delectus dolore ducimus eveniet exercitationem illo illum impedit, in ipsam molestias nisi optio porro repellat rerum tenetur totam!\r\n\r\nConsequatur dicta dolorum facilis libero molestias qui quisquam voluptatem. Ad architecto, blanditiis cum dignissimos excepturi facere odit? Consequatur corporis delectus dignissimos eligendi in ipsum odio, quidem ratione! A, eius, non.',
        200, 82, 6, 2, 2, 4, 1, 7, 2, 41);
/*!40000 ALTER TABLE `residence`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `residence_equipment`
--

DROP TABLE IF EXISTS `residence_equipment`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `residence_equipment`
(
    `residence_id` int(11) NOT NULL,
    `equipment_id` int(11) NOT NULL,
    PRIMARY KEY (`residence_id`, `equipment_id`),
    KEY `equipment_id` (`equipment_id`),
    CONSTRAINT `residence_equipment_ibfk_1` FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    CONSTRAINT `residence_equipment_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `residence_equipment`
--

LOCK TABLES `residence_equipment` WRITE;
/*!40000 ALTER TABLE `residence_equipment`
    DISABLE KEYS */;
INSERT INTO `residence_equipment`
VALUES (28, 1),
       (30, 1),
       (31, 1),
       (28, 2),
       (30, 2),
       (31, 2),
       (33, 2),
       (30, 3),
       (31, 3),
       (29, 4),
       (32, 4),
       (28, 6),
       (31, 6),
       (29, 7),
       (33, 7),
       (30, 8),
       (31, 8),
       (28, 10),
       (30, 11),
       (31, 11),
       (28, 12),
       (32, 12),
       (31, 13),
       (30, 14),
       (33, 14),
       (29, 15),
       (30, 15),
       (32, 15),
       (33, 15),
       (31, 16),
       (29, 17),
       (33, 17),
       (29, 18),
       (31, 18),
       (28, 20),
       (30, 20),
       (31, 20),
       (33, 20),
       (30, 21),
       (32, 21),
       (31, 22),
       (28, 23),
       (29, 23),
       (31, 23),
       (33, 23),
       (28, 24),
       (29, 24),
       (30, 24),
       (29, 25),
       (31, 25),
       (32, 25),
       (33, 25),
       (30, 26),
       (31, 26),
       (33, 26);
/*!40000 ALTER TABLE `residence_equipment`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type`
(
    `id`         int(11)      NOT NULL AUTO_INCREMENT,
    `label`      varchar(255) NOT NULL,
    `image_path` varchar(255)          DEFAULT NULL,
    `is_active`  tinyint(1)   NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 11
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type`
    DISABLE KEYS */;
INSERT INTO `type`
VALUES (1, 'House', NULL, 1),
       (2, 'Apartment', NULL, 1),
       (3, 'Barn', NULL, 1),
       (4, 'Boat', NULL, 1),
       (5, 'Cabin', NULL, 1),
       (6, 'Castle', NULL, 1),
       (7, 'Cave', NULL, 1),
       (8, 'Dome', NULL, 1),
       (9, 'Farm', NULL, 1),
       (10, 'Tent', NULL, 1);
/*!40000 ALTER TABLE `type`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user`
(
    `id`         int(11)      NOT NULL AUTO_INCREMENT,
    `email`      varchar(255) NOT NULL,
    `password`   varchar(255) NOT NULL,
    `lastname`   varchar(255) NOT NULL,
    `firstname`  varchar(255) NOT NULL,
    `phone`      varchar(255) NOT NULL,
    `is_active`  tinyint(1)   NOT NULL DEFAULT '1',
    `address_id` int(11)               DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `address_id` (`address_id`),
    CONSTRAINT `user_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user`
    DISABLE KEYS */;
INSERT INTO `user`
VALUES (1, 'admin@admin.com', '$2y$10$8p9RfEp8yAeqcet7uLC9P.NmwF/IcwpYziTzrO18MBRGH3v87sYQi', 'asdf', 'qwert',
        '01564684321321', 1, NULL),
       (2, 'wooden@joseph.com', '$2y$10$rGrNq21AdOGDNLxhnSD6COkqk5hQyajeu.gQvx3wosiHhU08xejlG', 'Wooden', 'Joseph',
        '0456776877', 1, NULL),
       (3, 'doe@john.com', '$2y$10$pTA/JXEb3ykOW62Snrv1TefENzpuwyf9A38A160ZTx.kBXpdda3Ke', 'Doe', 'John', '01657468435',
        1, NULL);
/*!40000 ALTER TABLE `user`
    ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2024-07-07 20:44:47
