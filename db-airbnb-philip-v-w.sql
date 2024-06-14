-- table address
CREATE TABLE IF NOT EXISTS `address`
(
    `id`       INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `address`  VARCHAR(255),
    `zip_code` VARCHAR(255),
    `country`  VARCHAR(255),
    `phone`    VARCHAR(255)
);

-- table user
CREATE TABLE IF NOT EXISTS `user`
(
    `id`         INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email`      VARCHAR(255) NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `lastname`   VARCHAR(255) NOT NULL,
    `firstname`  VARCHAR(255) NOT NULL,
    `is_active`  BOOLEAN      NOT NULL DEFAULT 1,
    `address_id` INT(11),
    FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
);

-- table type
CREATE TABLE IF NOT EXISTS `type`
(
    `id`         INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `label`      VARCHAR(255) NOT NULL,
    `image_path` VARCHAR(255),
    `is_active`  BOOLEAN      NOT NULL DEFAULT 1
);

-- table residence
CREATE TABLE IF NOT EXISTS `residence`
(
    `id`              INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title`           VARCHAR(255) NOT NULL,
    `description`     TEXT,
    `price_per_night` FLOAT        NOT NULL,
    `nb_rooms`        INT(11),
    `nb_beds`         INT(11),
    `nb_baths`        INT(11),
    `nb_travelers`    INT(11),
    `is_active`       BOOLEAN      NOT NULL DEFAULT 1,
    `type_id`         INT(11),
    `user_id`         INT(11),
    `address_id`      INT(11),
    FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
);

-- table media
CREATE TABLE IF NOT EXISTS `media`
(
    `id`           INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `image_path`   VARCHAR(255),
    `residence_id` INT(11),
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`)
);

-- table equipment
CREATE TABLE IF NOT EXISTS `equipment`
(
    `id`         INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `label`      VARCHAR(255) NOT NULL,
    `image_path` VARCHAR(255)
);

-- table residence_equipment
CREATE TABLE IF NOT EXISTS `residence_equipment`
(
    `residence_id` INT(11) NOT NULL,
    `equipment_id` INT(11) NOT NULL,
    PRIMARY KEY (`residence_id`, `equipment_id`),
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`)
);

-- table reservation
CREATE TABLE IF NOT EXISTS `reservation`
(
    `id`           INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `date_start`   DATE    NOT NULL,
    `date_end`     DATE    NOT NULL,
    `nb_adults`    INT(11),
    `nb_children`  INT(11),
    `price_total`  INT     NOT NULL,
    `residence_id` INT(11),
    `user_id`      INT(11),
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

-- table favorite
CREATE TABLE IF NOT EXISTS `favorite`
(
    `id`           INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `residence_id` INT(11) NOT NULL,
    `user_id`      INT(11) NOT NULL,
    `is_active`    BOOLEAN NOT NULL DEFAULT 1,
    FOREIGN KEY (`residence_id`) REFERENCES `residence` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);
