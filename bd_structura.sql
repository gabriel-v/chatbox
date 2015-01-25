SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `chat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `chat`;

DROP TABLE IF EXISTS `mesaje`;
CREATE TABLE IF NOT EXISTS `mesaje` (
  `id_mesaj` bigint(20) unsigned NOT NULL,
  `expeditor` bigint(20) NOT NULL,
  `destinatar` bigint(20) NOT NULL,
  `text` text CHARACTER SET utf16 COLLATE utf16_romanian_ci NOT NULL,
  `data` datetime NOT NULL,
  `citit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `sesiuni`;
CREATE TABLE IF NOT EXISTS `sesiuni` (
  `id_sesiune` bigint(20) unsigned NOT NULL,
  `cheie_sesiune` varchar(512) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `id_utilizator` bigint(20) NOT NULL,
  `inceput` datetime NOT NULL,
  `sfarsit` datetime DEFAULT NULL,
  `adresa_ip` tinytext NOT NULL,
  `browser` tinytext NOT NULL,
  `platforma` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `utilizatori`;
CREATE TABLE IF NOT EXISTS `utilizatori` (
  `id` bigint(20) unsigned NOT NULL,
  `nume` tinytext CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  `hash` varchar(512) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `data_ire` datetime NOT NULL,
  `activ` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `mesaje`
  ADD PRIMARY KEY (`id_mesaj`), ADD UNIQUE KEY `id` (`id_mesaj`);

ALTER TABLE `sesiuni`
  ADD PRIMARY KEY (`id_sesiune`), ADD UNIQUE KEY `id` (`id_sesiune`);

ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);


ALTER TABLE `mesaje`
  MODIFY `id_mesaj` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `sesiuni`
  MODIFY `id_sesiune` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `utilizatori`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;

