-- table address
CREATE TABLE IF NOT EXISTS `address`
(
    `id`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `address`  VARCHAR(255)     NOT NULL,
    `city`     VARCHAR(255)     NOT NULL,
    `zip_code` VARCHAR(255)     NOT NULL,
    `country`  VARCHAR(255)     NOT NULL
);

-- table user
CREATE TABLE IF NOT EXISTS `user`
(
    `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email`      VARCHAR(255)     NOT NULL,
    `password`   VARCHAR(255)     NOT NULL,
    `lastname`   VARCHAR(255)     NOT NULL,
    `firstname`  VARCHAR(255)     NOT NULL,
    `phone`      VARCHAR(255)     NOT NULL,
    `is_active`  BOOLEAN          NOT NULL DEFAULT 1,
    `address_id` INT(11) UNSIGNED,
    FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
);

-- table type
CREATE TABLE IF NOT EXISTS `type`
(
    `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `label`      VARCHAR(255)     NOT NULL,
    `image_path` VARCHAR(255),
    `is_active`  BOOLEAN          NOT NULL DEFAULT 1
);

-- Insert data into type table
INSERT INTO `type` (`id`, `label`, `is_active`)
VALUES (1, 'House', 1),
       (2, 'Apartment', 1),
       (3, 'Barn', 1),
       (4, 'Boat', 1),
       (5, 'Cabin', 1),
       (6, 'Castle', 1),
       (7, 'Cave', 1),
       (8, 'Dome', 1),
       (9, 'Farm', 1),
       (10, 'Tent', 1);

-- table residence
CREATE TABLE IF NOT EXISTS `residence`
(
    `id`              INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title`           VARCHAR(11)      NOT NULL,
    `description`     TEXT,
    `price_per_night` INT(11) UNSIGNED NOT NULL,
    `size`            INT(11) UNSIGNED NOT NULL,
    `nb_rooms`        INT(11) UNSIGNED NOT NULL,
    `nb_beds`         INT(11) UNSIGNED NOT NULL,
    `nb_baths`        INT(11) UNSIGNED NOT NULL,
    `nb_guests`       INT(11) UNSIGNED NOT NULL,
    `is_active`       BOOLEAN          NOT NULL DEFAULT 1,
    `type_id`         INT(11) UNSIGNED,
    `user_id`         INT(11) UNSIGNED,
    `address_id`      INT(11) UNSIGNED,
    FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
);

-- table media
CREATE TABLE IF NOT EXISTS `media`
(
    `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `image_path`   VARCHAR(255)     NULL,
    `residence_id` INT(11) UNSIGNED,
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`)
);

-- table equipment
CREATE TABLE IF NOT EXISTS `equipment`
(
    `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `label`      VARCHAR(255)     NOT NULL,
    `image_path` VARCHAR(255)
);

-- Insert data into equipment table
INSERT INTO `equipment` (`id`, `label`, `image_path`)
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
       (18, 'Exercise equipment', 'assets/equipment_icons/exercise-equipment.svg'),
       (19, 'Lake access', 'assets/equipment_icons/lake-access.svg'),
       (20, 'Beach access', 'assets/equipment_icons/beach-access.svg'),
       (21, 'Ski-in/Ski-out', 'assets/equipment_icons/ski-in-ski-out.svg'),
       (22, 'Outdoor shower', 'assets/equipment_icons/outdoor-shower.svg'),
       (23, 'Smoke alarm', 'assets/equipment_icons/smoke-alarm.svg'),
       (24, 'First aid kit', 'assets/equipment_icons/first-aid-kit.svg'),
       (25, 'Fire extinguisher', 'assets/equipment_icons/fire-extinguisher.svg'),
       (26, 'Carbon monoxide alarm', 'assets/equipment_icons/carbon-monoxide-alarm.svg');


-- table residence_equipment
CREATE TABLE IF NOT EXISTS `residence_equipment`
(
    `residence_id` INT(11) UNSIGNED NOT NULL,
    `equipment_id` INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (`residence_id`, `equipment_id`),
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`)
);

-- table reservation
CREATE TABLE IF NOT EXISTS `reservation`
(
    `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `date_start`   DATE             NOT NULL,
    `date_end`     DATE             NOT NULL,
    `nb_adults`    INT(11) UNSIGNED NULL,
    `nb_children`  INT(11) UNSIGNED NULL,
    `price_total`  INT UNSIGNED     NOT NULL,
    `residence_id` INT(11) UNSIGNED,
    `user_id`      INT(11) UNSIGNED,
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

-- table favorite
CREATE TABLE IF NOT EXISTS `favorite`
(
    `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `residence_id` INT(11) UNSIGNED NOT NULL,
    `user_id`      INT(11) UNSIGNED NOT NULL,
    `is_active`    BOOLEAN          NOT NULL DEFAULT 1,
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);