--
-- Base de données : `mds-planning`
--

-- Suppression de la base de données si elle existe
DROP DATABASE IF EXISTS `mds_planning`;

-- Création de la base de données
CREATE DATABASE `mds_planning`;
USE `mds_planning`;


DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `created_at` DATETIME NOT NULL,
    `created_by` VARCHAR(255),
    `updated_at` DATETIME,
    `updated_by` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class`(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_grade` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `created_at` DATETIME NOT NULL,
    `created_by` VARCHAR(255),
    `updated_at` DATETIME,
    `updated_by` VARCHAR(255),
    FOREIGN KEY (`id_grade`) REFERENCES grade(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
    `created_at` DATETIME NOT NULL,
    `created_by` VARCHAR(255),
    `updated_at` DATETIME,
    `updated_by` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_class`INT NOT NULL,
    `id_session` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `duration` INT,
    `color` VARCHAR(7),
    `is_option` BOOLEAN NOT NULL DEFAULT FALSE,
    `created_at` DATETIME NOT NULL,
    `created_by` VARCHAR(255),
    `updated_at` DATETIME,
    `updated_by` VARCHAR(255),
    FOREIGN KEY (`id_class`) REFERENCES class(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_session`) REFERENCES session(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher`(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `lastname` VARCHAR(255) NOT NULL,
    `firstname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `description` TEXT,
    `created_at` DATETIME NOT NULL,
    `created_by` VARCHAR(255),
    `updated_at` DATETIME,
    `updated_by` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `module_teacher`;
CREATE TABLE IF NOT EXISTS `module_teacher` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_teacher` INT NOT NULL,
    `id_module` INT NOT NULL,
    FOREIGN KEY (`id_teacher`) REFERENCES teacher(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_module`) REFERENCES module(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE IF NOT EXISTS `lesson` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_module` INT NOT NULL,
    `description` TEXT,
    `is_hp` BOOLEAN NOT NULL DEFAULT FALSE,
    `date_start` DATETIME NOT NULL,
    `date_end`DATETIME NOT NULL,
    `created_at` DATETIME NOT NULL,
    `created_by` VARCHAR(255),
    `updated_at` DATETIME,
    `updated_by` VARCHAR(255),
    FOREIGN KEY (`id_module`) REFERENCES module(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    