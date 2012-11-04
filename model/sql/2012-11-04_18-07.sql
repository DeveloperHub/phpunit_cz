-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_categories` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `perex` text COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  `status` enum('publish','private','preparation') COLLATE utf8_czech_ci NOT NULL,
  `tags` text COLLATE utf8_czech_ci NOT NULL COMMENT '# is delimiter',
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `id_users` (`id_users`),
  KEY `id_categories` (`id_categories`),
  CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `articles_ibfk_4` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `articles`;
INSERT INTO `articles` (`id`, `id_users`, `id_categories`, `date`, `title`, `perex`, `content`, `status`, `tags`) VALUES
(1,	1,	1,	'2012-11-04 16:34:09',	'PHPUnit – anotace',	'Anotace je forma metadat, která se uvádějí ke zdrojovému kódu. PHP nemá specializované funkce pro anotování zrojového kódu.',	'Anotace je forma metadat, která se uvádějí ke zdrojovému kódu. PHP nemá specializované funkce pro anotování zrojového kódu. Ovšem máme možnost přidat anotace do phpDoc a pomocí reflexe k nim přistupovat a tak řídit běh programu a nastavit chování metod. Pokud píšeme testy v PHPUnit, můžeme k jednotlivým testovacím metodám přidat anotaci do phpDoc a tak říci, jak se má PHPUnit při zpracování o anotované metody zachovat. Některé anotace v rámci testování můžeme uvádět i k testovanému kódu.',	'publish',	'selenium#phpunit'),
(2,	1,	4,	'2012-11-04 16:35:17',	'PHPUnit Command-Line',	'V milém článku jsem ukázal, jak spustit jednotkový test PHPUnit v terminálu.',	'V milém článku jsem ukázal, jak spustit jednotkový test PHPUnit v terminálu. A však spouštění testů můžeme ovlivnit přepínači, které nám dovolí například spouštět testy, které jsou v dané skupině, z výsledků tvořit report pokrytí testované aplikace testy, obarvovat výstupy v příkazové řádce a mnoho dalšího.',	'publish',	'testing#github');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `categories`;
INSERT INTO `categories` (`id`, `name`) VALUES
(1,	'Anotace'),
(2,	'Asertační metody'),
(3,	'Instalace / konfigurace'),
(4,	'Příkazová řádka');

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_articles` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `author_name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `author_url` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `author_ip` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `date` datetime NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_articles` (`id_articles`),
  KEY `parent` (`parent`),
  CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`parent`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_articles`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `comments`;

DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `target` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `visible` (`visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `links`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `password` char(40) COLLATE utf8_czech_ci NOT NULL,
  `role` enum('admin','guest') COLLATE utf8_czech_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `hash_key` char(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `ban` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `login` (`login`),
  KEY `password` (`password`),
  KEY `hash_key` (`hash_key`),
  KEY `ban` (`ban`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

TRUNCATE `users`;
INSERT INTO `users` (`id`, `login`, `password`, `role`, `name`, `email`, `hash_key`, `ban`) VALUES
(1,	'admin',	'd033e22ae348aeb5660fc2140aec35850c4da997',	'admin',	'Administrátor',	'admin@phpunit.cz',	NULL,	0);

-- 2012-11-04 18:07:50
