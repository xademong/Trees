/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.16 : Database - trees
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `compounds` */

DROP TABLE IF EXISTS `compounds`;

CREATE TABLE `compounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medias` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `compounds` */

/*Table structure for table `medias` */

DROP TABLE IF EXISTS `medias`;

CREATE TABLE `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_type` enum('image','audio','video') NOT NULL DEFAULT 'image',
  `content_type` varchar(255) NOT NULL,
  `content_length` int(11) NOT NULL,
  `local_url` varchar(1000) NOT NULL,
  `cdn_url` varchar(1000) NOT NULL,
  `creator` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `mixable` tinyint(1) NOT NULL DEFAULT '1',
  `acl` varchar(255) NOT NULL DEFAULT 'public',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `medias` */

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `msg_type` tinyint(4) NOT NULL,
  `msg_status` enum('SENT','READ') NOT NULL DEFAULT 'SENT',
  `sub_title` varchar(255) NOT NULL,
  `msg_text` text NOT NULL,
  `has_attachment` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewed_date` datetime DEFAULT NULL,
  `sound_effect` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `auto_msg` varchar(1000) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` mediumint(6) NOT NULL,
  `number` bigint(20) NOT NULL,
  `full_number` bigint(26) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_image` varchar(1000) DEFAULT NULL,
  `cdn_url` varchar(1000) DEFAULT NULL,
  `code` int(4) NOT NULL,
  `device_token` varchar(64) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;