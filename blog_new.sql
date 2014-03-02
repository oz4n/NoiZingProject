-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2014 at 02:51 AM
-- Server version: 5.5.35-MariaDB-log
-- PHP Version: 5.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `level` enum('A','O','U','T') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `salt`, `email`, `level`) VALUES
(1, 'ozan', 'admin', '769087kjlndljkashdoi', 'oz4n.rock@gmail.com', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('P','D') COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `parent_replay` int(11) DEFAULT '0',
  `like` int(11) DEFAULT '0',
  `unlike` int(11) DEFAULT '0',
  `country` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_buplic` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_post1_idx` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `author`, `email`, `url`, `content`, `status`, `create_time`, `parent_replay`, `like`, `unlike`, `country`, `ip_buplic`, `post_id`) VALUES
(1, 'melengo', 'm3l3ngo@gmail.com', 'http://www.google.com', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.', 'P', 1382207234, 0, 0, 0, NULL, NULL, 11),
(2, 'ozan', 'oz4n.rock@gmail.com', 'http://melengo.com', 'Koding di atas maksudnya meminta Yii supaya ketika me-render tampilan, tempat pertama yang dicari adalah webroot/themes/nightclub. Apabila ternyata file tersebut tidak ada di dalam folder “nightclub” baru dicari di webroot/protected/views. Karena itulah pengetikan nama di bagian config', 'P', 1382202234, 1, 0, 0, NULL, NULL, 11),
(3, 'fandi', 'fandi@gmail.com', 'http://fandi.com', 'consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'P', 1382207235, 0, 0, 0, NULL, NULL, 11),
(4, 'ahmad zaini', 'ozan.rock@yahoo.co.id', 'zaini.com', 'webroot/themes/nightclub. Apabila ternyata file tersebut tidak ada di dalam folder “nightclub” baru dicari di webroot/protected/views. Karena itulah pengetikan nama di bagian config', 'P', 1382207234, 1, 0, 0, NULL, NULL, 11),
(5, 'linux torpalds', 'linux@gmail.com', 'ozan.com', 'orta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed', 'P', 1382208972, 0, 0, 0, NULL, NULL, 11),
(6, 'ozan rock', 'linux@gmail.com', 'ozan.com', 'orta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed', 'P', 1382209052, 1, 0, 0, NULL, NULL, 11),
(7, 'inem oli', 'inem@gmail.com', 'http://google.com', 'According to Unidecode, from which most of the transliteration data has been derived, "Russian and Greek seem to work passably. But it works quite bad on Japanese and Thai."', 'P', 1382211230, 0, 0, 0, NULL, NULL, 13),
(8, 'kakek tai', 'kaken@gmail.com', 'kaken.com', 'FIFO mengacu pada FCFS (First Come First Server), paket data yang pertama datang akan diperoses telebih dahulu. Paket data yang keluar terlebih dahulu di masukkan ke dalam antrian FIFO kemudian dikeluarkan sesuai dengan urutan datangnya.', 'P', 1382211525, 0, 0, 0, NULL, NULL, 8),
(9, 'makan', 'makan@gmail.com', 'http://www.google.com', 'al dengan nama Open System Interconnection (OSI). Standard ini terdiri dari 7 (tujuh) lapisan protokol yang menjalankan fungsi komunikasi antara 2 (dua) komputer. Dalam TCP/IP hanya terdapat 4 (empat) lapisan, walaupun jumlahnya berbeda, namun semua fungsi dari la', 'P', 1382212889, 0, 0, 0, NULL, NULL, 6),
(10, 'jadul', 'ozan.rock@yahoo.co.id', 'yahoo.com', 'merupakan nilai default direction). Dan perhatikan, hal yang menarik adalah saat viewport kita besar kecilkan, flex items akan menyesuaikan dengan saat proporsional. Kita tidak perlu susah-susah mengatur besar space di antara flex items.', 'P', 1382243233, 0, 0, 0, NULL, NULL, 5),
(11, 'lolipop', 'lolipop@yahoo.com', 'lolipop.com', 'Transport layer Dalam lapisan ini menyediakan aliran kontrol, error kontrol, layanan untuk internetwork dan berfungsi sebagai antarmuka untuk aplikasi jaringan. Pada transport layer terdapat 2 (dua) protkol diantaranya:', 'P', 1382250858, 0, 0, 0, NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` text NOT NULL,
  `status` enum('E','D') NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `status` enum('default','other') NOT NULL,
  `position` int(11) DEFAULT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dropbox_account`
--

CREATE TABLE IF NOT EXISTS `dropbox_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(45) NOT NULL,
  `display_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `type` enum('M','C') NOT NULL DEFAULT 'C',
  `key` varchar(255) DEFAULT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `referral_link` varchar(45) NOT NULL,
  `quota_normal` int(11) NOT NULL DEFAULT '0',
  `quota_in_used` int(11) NOT NULL DEFAULT '0',
  `quota_in_shared` int(11) NOT NULL DEFAULT '0',
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dropbox_account`
--

INSERT INTO `dropbox_account` (`id`, `uid`, `display_name`, `email`, `type`, `key`, `secret`, `access_token`, `referral_link`, `quota_normal`, `quota_in_used`, `quota_in_shared`, `account_id`) VALUES
(1, 'asd', 'asd', 'asd', 'C', 'asd', 'asd', 'asd', 'asd', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dropbox_files`
--

CREATE TABLE IF NOT EXISTS `dropbox_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `files_uid` varchar(45) NOT NULL,
  `name` text NOT NULL,
  `status` enum('L','I') NOT NULL DEFAULT 'L',
  `path` text NOT NULL,
  `type` enum('img','document','video','sound') NOT NULL DEFAULT 'img',
  `mime_type` varchar(255) DEFAULT NULL,
  `url_share` text NOT NULL,
  `url_thumbnail_share` text,
  `dropbox_account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dropbox_files_dropbox_account1_idx` (`dropbox_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `dropbox_files`
--

INSERT INTO `dropbox_files` (`id`, `files_uid`, `name`, `status`, `path`, `type`, `mime_type`, `url_share`, `url_thumbnail_share`, `dropbox_account_id`) VALUES
(55, '144908828', '144908828.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/144908828.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/144908828.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/144908828.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/144908828.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/144908828.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/144908828.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/144908828.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/144908828.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/144908828.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/144908828.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/144908828.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/144908828.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/144908828.jpg"}}', 1),
(56, '556331202', '556331202.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/556331202.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/556331202.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/556331202.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/556331202.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/556331202.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/556331202.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/556331202.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/556331202.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/556331202.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/556331202.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/556331202.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/556331202.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/556331202.jpg"}}', 1),
(57, '1134046152', '1134046152.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/1134046152.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/1134046152.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/1134046152.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/1134046152.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/1134046152.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/1134046152.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/1134046152.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/1134046152.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/1134046152.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/1134046152.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/1134046152.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/1134046152.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/1134046152.jpg"}}', 1),
(58, '510332998', '510332998.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/510332998.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/510332998.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/510332998.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/510332998.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/510332998.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/510332998.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/510332998.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/510332998.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/510332998.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/510332998.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/510332998.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/510332998.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/510332998.jpg"}}', 1),
(59, '215223529', '215223529.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/215223529.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/215223529.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/215223529.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/215223529.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/215223529.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/215223529.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/215223529.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/215223529.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/215223529.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/215223529.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/215223529.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/215223529.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/215223529.jpg"}}', 1),
(60, '798564679', '798564679.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/798564679.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/798564679.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/798564679.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/798564679.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/798564679.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/798564679.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/798564679.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/798564679.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/798564679.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/798564679.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/798564679.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/798564679.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/798564679.jpg"}}', 1),
(61, '847841184', '847841184.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/847841184.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/847841184.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/847841184.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/847841184.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/847841184.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/847841184.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/847841184.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/847841184.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/847841184.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/847841184.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/847841184.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/847841184.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/847841184.jpg"}}', 1),
(62, '1028385850', '1028385850.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/1028385850.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/1028385850.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/1028385850.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/1028385850.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/1028385850.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/1028385850.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/1028385850.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/1028385850.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/1028385850.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/1028385850.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/1028385850.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/1028385850.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/1028385850.jpg"}}', 1),
(63, '538144632', '538144632.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/538144632.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/538144632.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/538144632.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/538144632.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/538144632.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/538144632.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/538144632.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/538144632.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/538144632.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/538144632.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/538144632.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/538144632.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/538144632.jpg"}}', 1),
(64, '1088545681', '1088545681.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/1088545681.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/1088545681.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/1088545681.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/1088545681.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/1088545681.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/1088545681.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/1088545681.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/1088545681.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/1088545681.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/1088545681.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/1088545681.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/1088545681.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/1088545681.jpg"}}', 1),
(65, '849610145', '849610145.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/849610145.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/849610145.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/849610145.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/849610145.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/849610145.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/849610145.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/849610145.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/849610145.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/849610145.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/849610145.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/849610145.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/849610145.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/849610145.jpg"}}', 1),
(66, '218884342', '218884342.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/218884342.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/218884342.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/218884342.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/218884342.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/218884342.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/218884342.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/218884342.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/218884342.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/218884342.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/218884342.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/218884342.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/218884342.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/218884342.jpg"}}', 1),
(67, '233154109', '233154109.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/233154109.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/233154109.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/233154109.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/233154109.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/233154109.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/233154109.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/233154109.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/233154109.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/233154109.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/233154109.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/233154109.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/233154109.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/233154109.jpg"}}', 1),
(68, '441539788', '441539788.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/441539788.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/441539788.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/441539788.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/441539788.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/441539788.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/441539788.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/441539788.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/441539788.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/441539788.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/441539788.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/441539788.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/441539788.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/441539788.jpg"}}', 1),
(69, '934068773', '934068773.jpg', 'L', 'C:\\wamp\\www\\yii-ebook\\protected\\config\\public\\../../../cache/images/orginal/934068773.jpg', 'img', 'image/jpeg', '/yii-ebook/cache/images/thumbnails/orginal/934068773.jpg', '{"orginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/orginal\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/orginal\\/934068773.jpg"},"T1024X768":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/1024X768\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/1024X768\\/934068773.jpg"},"T232X155":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/232X155\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/232X155\\/934068773.jpg"},"T255X255":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/255X255\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/255X255\\/934068773.jpg"},"T60X60":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/60X60\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/60X60\\/934068773.jpg"},"T800X534":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X534\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X534\\/934068773.jpg"},"T800X600":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/800X600\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/800X600\\/934068773.jpg"},"T100X74":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/100X74\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/100X74\\/934068773.jpg"},"torginal":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal\\/934068773.jpg"},"torginal_100":{"path":"C:\\\\wamp\\\\www\\\\yii-ebook\\\\protected\\\\config\\\\public\\\\..\\/..\\/..\\/cache\\/images\\/thumbnails\\/orginal_100\\/934068773.jpg","imgurl":"\\/yii-ebook\\/cache\\/images\\/thumbnails\\/orginal_100\\/934068773.jpg"}}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `path` text NOT NULL,
  `url` text NOT NULL,
  `type` enum('image','video','document') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `guest_book`
--

CREATE TABLE IF NOT EXISTS `guest_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `web_url` varchar(45) DEFAULT NULL,
  `content` text NOT NULL,
  `status` enum('P','D') NOT NULL DEFAULT 'D',
  `create_time` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

CREATE TABLE IF NOT EXISTS `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(15) NOT NULL,
  `type` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Published', 'p', 'PostStatus', 1),
(2, 'Draft', 'D', 'PostStatus', 2),
(3, 'Pending Approval	', 'D', 'CommentStatus', 1),
(4, 'Approved', 'P', 'CommentStatus', 2),
(5, 'Administrator', 'A', 'LevelStatus', 1),
(6, 'Operator', 'O', 'LevelStatus', 2),
(7, 'User', 'U', 'LevelStatus', 3),
(8, 'Male', 'M', 'GenderStatus', 1),
(9, 'Female', 'F', 'GenderStatus', 2),
(10, 'Enable', 'E', 'PostCommentStatus', 1),
(11, 'Disable', 'D', 'PostCommentStatus', 2),
(12, 'Enable', 'E', 'CategoryStatus', 1),
(13, 'Disable', 'D', 'CategoryStatus', 2),
(14, 'Page', 'page', 'PostType', 1),
(15, 'Info', 'info', 'PostType', 2),
(16, 'Enable', 'enable', 'PostShares', 1),
(17, 'Disable', 'disable', 'PostShares', 2),
(18, 'Yes', 'Y', 'PostCheked', 1),
(19, 'No', 'N', 'PostCheked', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nav_menu`
--

CREATE TABLE IF NOT EXISTS `nav_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `type` enum('category','pages','nav_link','component') NOT NULL,
  `slug` text NOT NULL,
  `position` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `status` enum('E','D') NOT NULL DEFAULT 'E',
  `term_id` varchar(45) NOT NULL,
  `term_taxonomy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nav_menu_term_taxonomy1_idx` (`term_taxonomy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `nav_menu`
--

INSERT INTO `nav_menu` (`id`, `name`, `type`, `slug`, `position`, `parent`, `status`, `term_id`, `term_taxonomy_id`) VALUES
(1, 'Home', 'component', '/site/default/index', 0, 0, 'E', '2', 1),
(2, 'Contact', 'component', 'contact/site/index', 2, 0, 'E', '3', 1),
(3, 'Guest Book', 'component', 'guestbook/site/index', 1, 0, 'E', '4', 1),
(4, 'ubuntu', 'category', 'ubuntu', 0, 0, 'E', '12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` text,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `pages_slug` text,
  `status` enum('P','D') NOT NULL,
  `icon` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `unlike` int(11) NOT NULL DEFAULT '0',
  `shares` enum('true','false') NOT NULL DEFAULT 'true',
  `comment_status` enum('E','D') DEFAULT NULL,
  `post_view` int(11) DEFAULT '0',
  `post_status` enum('pages','info') DEFAULT NULL,
  `files_uid` text,
  `cron_checked` enum('Y','N') NOT NULL DEFAULT 'Y',
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_account1_idx` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `slug`, `tags`, `pages_slug`, `status`, `icon`, `create_time`, `update_time`, `like`, `unlike`, `shares`, `comment_status`, `post_view`, `post_status`, `files_uid`, `cron_checked`, `account_id`) VALUES
(1, 'Iron Man sebentar lagi akan menjadi nyata!', '<p style="text-align: justify;">\n	 <span style="background-color: rgb(192, 80, 77); color: rgb(255, 255, 255);">Iron Man</span> sebentar lagi akan menjadi nyata! Pihak militer Amerika Serikat dikabarkan sedang mempersiapkan kostum tempur yang memiliki teknologi seperti kostum Iron Man, yaitu mampu menambahkan tenaga prajurit, melindungi dari tembakan, dilengkapi dengan senjata, dan bisa melihat di kondisi gelap (night vision).\n</p>\n<p style="text-align: justify;">\n	                         Tujuan dibuatnya kostum ini adalah agar militer Amerika mampu berjalan di tengah banyaknya hantaman peluru dalam medan pertempuran.\n</p>\n<p>\n	<!--more-->\n</p>\n<p style="text-align: justify;">\n	<span style="text-align: justify;">Kostum tersebut menggunakan komputer on-board yang bisa merespon situasi tertentu dan memberikan prajurit berbagai informasi tentang situasi tersebut. Senjata yang digunakan di kostum ini adalah senjata berpeluru cair, dimana peluru cair ini akan menjadi logam dalam sepersekian detik setelah ditembakkan. Teknologi amunisi ini menggunakan medan magnet dan elektrik yang kini sedang dikembangkan di MIT.</span>\n</p>\n<p style="text-align: justify;">\n	    ostum ini bakal menyediakan juga kebutuhan dasar prajurit seperti udara, oksigen, dan temperatur panas. Bagian dalam kostum akan mendeteksi suhu tubuh, detak jantung, dan level hidrasi prajurit, kemudian mengkondisikannya agar sang prajurit selalu berada dalam kondisi yang optimal.\n</p>\n<p>\n	<img src="/yii-ebook/cache/images/thumbnails/orginal/1028385850.jpg" alt="1028385850.jpg" file-uid="1028385850">\n</p>\n<p style="text-align: justify;">\n	ostum ini bakal menyediakan juga kebutuhan dasar prajurit seperti udara, oksigen, dan temperatur panas. Bagian dalam kostum akan mendeteksi suhu tubuh, detak jantung, dan level hidrasi prajurit, kemudian mengkondisikannya agar sang prajurit selalu berada dalam kondisi yang optimal.\n</p>\n<p style="text-align: justify;">\n	    stum tersebut menggunakan komputer on-board yang bisa merespon situasi tertentu dan memberikan prajurit berbagai informasi tentang situasi tersebut. Senjata yang digunakan di kostum ini adalah senjata berpeluru cair, dimana peluru cair ini akan menjadi logam dalam sepersekian detik setelah ditembakkan. Teknologi amunisi ini menggunakan medan magnet dan elektrik yang kini sedang dikembangkan di MIT.\n</p>', 'iron-man-sebentar-lagi-akan-menjadi-nyata', 'linux,ubuntu', 'linux', 'P', '/yii-ebook/cache/images/thumbnails/orginal/556331202.jpg', 1381388863, 1381388863, 0, 0, 'true', 'E', 0, 'info', '1028385850', 'Y', 1),
(3, 'Gol dari Morgan Amalfitano serta Saido Berahino', '<p style="text-align: justify;">\n	           Gol dari Morgan Amalfitano serta Saido Berahino yang bermain untuk West Brom membuat posisi United tak bergerak dengan tujuh poin di klasemen sementara Liga Primer, situasi yang sama pernah terjadi pada musim tahun 1989-90. Berita terkait City membantai Manchester United 4-1 Ferguson: Rooney sudah kembali Rooney memuji latihan di bawah Moyes Link terkait Topik terkait Sepakbola, liga primer United berikutnya akan menyambangi stadion klub Shakhtar Donetsk dalam putaran Liga Champions. "Pasti ada saatnya Klik Anda dapat hasil jelek di arena sepakbola, persoalannya adalah bagaimana Anda mengatasinya," kata Moyes. "Kami akan bangkit dan melihat ke depan untuk laga berikutnya. Ada banyak pertandingan dan Anda harus siap untuk yang berikutnya.\n</p>\n<p>\n	<!--more-->\n</p>\n<p>\n	 <img src="/yii-ebook/cache/images/thumbnails/orginal/510332998.jpg" alt="510332998.jpg" file-uid="510332998">\n</p>\n<p style="text-align: justify;">\n	<span style="text-align: justify;">"Saya khawatir setelah laga berakhir tetapi penyebabnya cuma karena kami main kurang bagus. Klik Kami bisa memperbaikinya." ''Layak'' Moyes, yang baru menang dua laga di Liga Primer sejak menempati posisinya sebagai pengganti pelatih Sir Alex Ferguson yang pensiun musim panas lalu, mengeluhkan penampilan di Liga Champions yang juga di bawah standar anak asuhnya. "Kami kurang rapat di lini pertahanan tapi kami juga kurang menyerang," kata mantan pelatih Everton ini pada BBC Sport. "Kami sebenarnya menguasai bola pada babak pertama tapi sebagian besar tak diolah dengan betul." Sebaliknya untuk WBA kemenangan ini juga baru yang kedua sepanjang musim ini di Liga Primer. Ini merupakan kemenangan pertama terhadap United di Old Trafford sejak 1978. Pelatih Steve Clarke nampaknya lebih suka menyebut hasil ini sebagai prestasi gemilang anak asuhnya ketimbang potret kacaunya pola permainan lawan. "Kami layak dapat banyak pujian," katanya. "Kami datang dengan (pemikiran) positif. Kami mendapat hasil akhir yang cukup baik melalui jendela transfer lalu dan harapannya para pendukung dan semua orang dapat melihat bahwa kami akan mempersembahan musim yang bagus lagi kali ini."</span>\n</p>', 'gol-dari-morgan-amalfitano-serta-saido-berahino', 'linux, ubuntu, ', 'linux', 'P', '/yii-ebook/cache/images/thumbnails/orginal/847841184.jpg', 1381434167, 1381434167, 0, 0, 'true', 'E', 0, 'info', '510332998', 'Y', 1),
(4, 'Proteksi CSS Dengan PHP', '<p style="text-align: justify;">\n	   CSS yang merupakan kependekan dari Cascading Style Sheets adalah kumpulan kode yang digunakan untuk mempercantik tampilan website, css mengatur suatu objek harus seperti apa, berwarna apa, bentuknya bagaimana, ukurannya seberapa besar, dan lain sebagainya. CSS Biasanya digunakan di html, php, asp, dan lain lain. Membuat CSS itu tergolong gampang-gampang susah. Dan pada suatu hari saya pernah kecolongan CSS Saya, dimana seseorang dengan mudahnya melakukan copy paste kode css dengan fitur View Page Source yang ada di browser, saya mencari cara proteksi css di google. Akhirnya saya menemukannya :D. Okay kita mulai mempelajarinya disini.\n</p>\n<!--more-->\n<p style="text-align: justify;">\n	 CSS Sudah diproteksi dengan bantuan session php, dimana jika session tidak ditemukan atau tidak cocok maka kode css tidak akan ditampilkan, namun browser hanya akan menampilkan tulisan “CSS PROTECTED”, sampai disini kode ini sudah oke, tetapi belum bisa digunakan.\n</p>\n<p>\n	<img src="/yii-ebook/cache/images/thumbnails/orginal/847841184.jpg" alt="847841184.jpg" file-uid="847841184">\n</p>\n<p style="text-align: justify;">\n	Tidak ada sistem yang sempurna, trik inipun tidak sepenuhnya memproteksi file css kita, misal dengan bantuan firebug kode css masih bisa dilihat, hal ini dikarenakan browser talah mendownload dahulu script css nya dan menyimpannya dikomputer kita untuk diproses oleh browser. Namun trik ini tetap ada gunanya, walaupun kita tidak bisa sepenuhnya membuat ini aman, setidaknya dengan ini sudah cukup menyulitkan orang untuk melakukan copy-paste kode seenaknya, terutama yang belum mengerti tools seperti firebug.\n</p>\n<p style="text-align: justify;">\n	Referensi: Bersumber dari teman, DozaCrack.org entah juga namanya doza crack. hehe Saya bertanya di facebook.\n</p>', 'proteksi-css-dengan-php', 'css', 'linux', 'P', '/yii-ebook/cache/images/thumbnails/orginal/1134046152.jpg', 1381673238, 1381673238, 0, 0, 'true', 'E', 0, 'info', '847841184', 'Y', 1),
(5, 'Tutorial Flexbox CSS3 Basic', '<p style="text-align: justify;">\n	 Kamu bisa lihat di alamat berikut ini http://cdpn.io/ekKqc. Flexbox Modules menjadikan class nav flex container dengan elemen sebagai flex items. Layout pun berubah menjadi menjalar horizontal dikarenakan direction yang dipilih row (dan memang nilai ini merupakan nilai default direction). Dan perhatikan, hal yang menarik adalah saat viewport kita besar kecilkan, flex items akan menyesuaikan dengan saat proporsional. Kita tidak perlu susah-susah mengatur besar space di antara flex items.\n</p>\n<!--more-->\n<p>\n	 <img src="/yii-ebook/cache/images/thumbnails/orginal/1088545681.jpg" alt="1088545681.jpg" file-uid="1088545681" style="opacity: 1;">\n</p>\n<p style="text-align: justify;">\n	 Kamu bisa lihat di alamat berikut ini <a href="http://cdpn.io/ekKqc.">http://cdpn.io/ekKqc.</a> Flexbox Modules menjadikan class nav flex container dengan elemen sebagai flex items. Layout pun berubah menjadi menjalar horizontal dikarenakan direction yang dipilih row (dan memang nilai ini merupakan nilai default direction). Dan perhatikan, hal yang menarik adalah saat viewport kita besar kecilkan, flex items akan menyesuaikan dengan saat proporsional. Kita tidak perlu susah-susah mengatur besar space di antara flex items.\n</p>', 'tutorial-flexbox-css3-basic', 'css, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/218884342.jpg', 1381673456, 1381673456, 0, 0, 'true', 'E', 0, 'info', '1088545681', 'Y', 1),
(6, 'Transport Control Protocol/Internet Protocol (TCP/IP)', '<p style="text-align: justify;">\n	Selama 1970-an, Defense Advanced Research Projects Agency (DARPA) mendanai University of California di Berkeley untuk mengmbangkan protokol TCP/IP. Karena sistem operasi Unix secara luas digunakan di universitas-universitas di seluruh negara, Unix adalah sistem operasi pertama yang menjalankan protokol TCP/IP. Pada akhirnya, selama bertahun-tahun, TCP / IP diadopsi sebagai komunikasi resmi Advanced Research Projects Agency network (ARPANet) protocol (Burns, 2003). Secara umum TCP/IP dikenal dengan jaringan yang beraneka ragam, yang berarti berbagai jenis perangkat komputasi jaringan yang terpasang. TCP/IP pada awalnya dirancang untuk memungkinkan berbagai jenis sistem komputer untuk berkomunikasi seolah-olah mereka adalah sistem yang sama (Naugle , 1999).\n</p>\n<!--more-->\n<p>\n	<img src="/yii-ebook/cache/images/thumbnails/orginal/556331202.jpg" alt="556331202.jpg" file-uid="556331202">\n</p>\n<p style="text-align: justify;">\n	Dalam arsitektur jaringan komputer, terdapat suatu lapisan-lapisan (layer) yang memiliki tugas spesifik serta memiliki protokol tersendiri. International Standard Organization (ISO) telah mengeluarkan suatu standard untuk arsitektur jaringan komputer yang dikenal dengan nama Open System Interconnection (OSI). Standard ini terdiri dari 7 (tujuh) lapisan protokol yang menjalankan fungsi komunikasi antara 2 (dua) komputer. Dalam TCP/IP hanya terdapat 4 (empat) lapisan, walaupun jumlahnya berbeda, namun semua fungsi dari lapisan-lapisan arsitektur OSI telah tercakup oleh arsitektur TCP/IP. Adapun rincian fungsi masing-masing layer arsitektur TCP/IP, diantaranya (Casad, 2012):\n</p>', 'transport-control-protocol-internet-protocol-tcp-ip', 'css, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/538144632.jpg', 1381673854, 1381673854, 0, 0, 'true', 'E', 0, 'info', '556331202', 'Y', 1),
(7, 'Network Access layer', '<p style="text-align: justify;">\n	Internet layer Dalam lapisan ini terdapat empat buah protokol yaitu IP (Internet Protocol) unreliable, connectionless, datagram delivery service. Protokol IP merupakan inti dari protokol TCP/IP. Seluruh data yang berasal dari protokol pada layer di atas IP harus dilewatkan, oleh protokol IP, dan dipancarkan sebagai paket IP, agar sampai ke tujuan. Dalam melakukan pengiriman data, IP memiliki sifat yang dikenal sebagai unreliable, connectionless, datagram delivery service\n</p>\n<!--more-->\n<p>\n	 <img src="/yii-ebook/cache/images/thumbnails/orginal/218884342.jpg" alt="218884342.jpg" file-uid="218884342" style="opacity: 1;">\n</p>\n<p style="text-align: justify;">\n	 Network Access layer Network Access layer Menyediakan sebuah antarmuka dengan jaringan fisik. Format data untuk media transmisi, pengiriman data berdasarkan alamat subnet, alamat hardware fisik dan menyediakan kontrol error ketika data dikirimkan pada jaringan fisik. Fungsi dalam lapisan ini adalah mengubah IP datagram ke frame yang ditransmisikan oleh network, dan memetakan IP Address ke physical address yang digunakan dalam jaringan.\n</p>\n<p style="text-align: justify;">\n	Internet layer Dalam lapisan ini terdapat empat buah protokol yaitu IP (Internet Protocol) unreliable, connectionless, datagram delivery service. Protokol IP merupakan inti dari protokol TCP/IP. Seluruh data yang berasal dari protokol pada layer di atas IP harus dilewatkan, oleh protokol IP, dan dipancarkan sebagai paket IP, agar sampai ke tujuan. Dalam melakukan pengiriman data, IP memiliki sifat yang dikenal sebagai unreliable, connectionless, datagram delivery service.\n</p>\n<p style="text-align: justify;">\n	 Transport layer Dalam lapisan ini menyediakan aliran kontrol, error kontrol, layanan untuk internetwork dan berfungsi sebagai antarmuka untuk aplikasi jaringan. Pada transport layer terdapat 2 (dua) protkol diantaranya:\n</p>', 'network-access-layer', 'networking', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/218884342.jpg', 1381674019, 1381674019, 0, 0, 'true', 'E', 0, 'info', '218884342', 'Y', 1),
(8, 'Metode Pengendalian Traffic Pada Jaringan Komputer', '<p style="text-align: justify;">\n	Dalam mengendalikan traffic seorang administrator jaringan bisa memilih beberapa metode tergantung dari situasi pada jaringan LAN atau backbone. Tiap traffic akan dikendalikan dengan metode tertentu yang akan berdampak pada kecepatan akses, jadi administrator jaringan perlu membaca dan mengerti bagian ini terlebih dahulu, beberapa metode pengendalian traffic sebagai berikut:\n</p>\n<!--more-->\n<p>\n	<img src="/yii-ebook/cache/images/thumbnails/orginal/849610145.jpg" alt="849610145.jpg" file-uid="849610145">\n</p>\n<p style="text-align: justify;">\n	Prioritas Pada metode prioritas paket data yang melintasi gateway diberikan prioritas berdasarkan port, alamat IP atau subnet. Jika traffic pada gateway sedang tinggi maka prioritas dengan nilai terendah (nailai paling rendah berarti prioritas tertinggi) akan di proses terlebih dahulu, sedangkan yang lainnya akan diberikan ke antrian atau dibuang. Metode perioritas paling cocok diterapkan pada koneksi Internet yang memiliki bandwidth sempit.\n</p>\n<p style="text-align: justify;">\n	FIFO Pada metode FIFO jika traffic melebihi nilai set maka paket data akan dimasukkan ke antrian, paket data tidak akan mengalami pembuangan hanya tertunda beberapa saat.\n</p>\n<p style="text-align: justify;">\n	Teknik antrian FIFO mengacu pada FCFS (First Come First Server), paket data yang pertama datang akan diperoses telebih dahulu. Paket data yang keluar terlebih dahulu di masukkan ke dalam antrian FIFO kemudian dikeluarkan sesuai dengan urutan datangnya.\n</p>', 'metode-pengendalian-traffic-pada-jaringan-komputer', 'networking, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/849610145.jpg', 1381674239, 1381674239, 0, 0, 'true', 'E', 0, 'info', '849610145', 'Y', 1),
(9, 'Daylight saving time (DST)', '<p style="text-align: justify;">\n	 Daylight saving time (DST), dan "Waktu musim panas" di sebagian besar Eropa, adalah praktek waktu setempat bergerak maju satu jam di musim semi dan mundur pada musim gugur. Ini musim semi dan musim gugur pergeseran untuk DST yang berbeda antara belahan utara dan Selatan. Awal DST di belahan utara adalah biasanya di Maret atau April (tergantung pada negara/benua), dan berakhir bulan Oktober atau November. Di belahan bumi selatan, perubahan yang berlawanan, dengan DST dimulai pada bulan Oktober dan berakhir Maret atau April.\n</p>\n<!--more-->\n<p>\n	<img src="/yii-ebook/cache/images/thumbnails/orginal/144908828.jpg" alt="144908828.jpg" file-uid="144908828">\n</p>\n<p style="text-align: justify;">\n	If you have searched images on Google recently, you might have noticed the interesting expanding preview for a larger image when you click on a thumbnail. It’s a really nice effect and it is very practical, making a search much easier. Today we want to show you how to create a similar effect on a thumbnail grid. The idea is to open a preview when clicking on a thumbnail and to show a larger image and some other content like a title, a description and a link. The interesting part is to calculate the correct preview height and to scroll the page to the right position. We’ll expand the preview in a way so that we can see the respective thumbnail row and cover the rest of the remaining page. Note that we don’t use very large images for the preview in the demo so you might see a lot of empty space on large monitors.\n</p>', 'daylight-saving-time-dst', 'css, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/144908828.jpg', 1381604030, 1381604030, 0, 0, 'true', 'E', 0, 'info', '144908828', 'Y', 1),
(10, 'Google recently, you might have noticed the interesting', '<p style="text-align: justify;">\n	 If you have searched images on Google recently, you might have noticed the interesting expanding preview for a larger image when you click on a thumbnail. Itâ€™s a really nice effect and it is very practical, making a search much easier. Today we want to show you how to create a similar effect on a thumbnail grid. The idea is to open a preview when clicking on a thumbnail and to show a larger image and some other content like a title, a description and a link. The interesting part is to calculate the correct preview height and to scroll the page to the right position. Weâ€™ll expand the preview in a way so that we can see the respective thumbnail row and cover the rest of the remaining page. Note that we donâ€™t use very large images for the preview in the demo so you might see a lot of empty space on large monitors.\n</p>\n<!--more-->\n<p>\n	<img src="/yii-ebook/cache/images/thumbnails/orginal/233154109.jpg" alt="233154109.jpg" file-uid="233154109">\n</p>\n<p style="text-align: justify;">\n	 If you have searched images on Google recently, you might have noticed the interesting expanding preview for a larger image when you click on a thumbnail. Itâ€™s a really nice effect and it is very practical, making a search much easier. Today we want to show you how to create a similar effect on a thumbnail grid. The idea is to open a preview when clicking on a thumbnail and to show a larger image and some other content like a title, a description and a link.\n</p>\n<p style="text-align: justify;">\n	 The interesting part is to calculate the correct preview height and to scroll the page to the right position. Weâ€™ll expand the preview in a way so that we can see the respective thumbnail row and cover the rest of the remaining page. Note that we donâ€™t use very large images for the preview in the demo so you might see a lot of empty space on large monitors.\n</p>', 'google-recently-you-might-have-noticed-the-interesting', 'css, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/233154109.jpg', 1381606184, 1381606184, 0, 0, 'true', 'E', 0, 'info', '233154109', 'Y', 1),
(11, 'Kita kemudian membuat skin yang diperlukan. ', '<p style="text-align: justify;">\n	 Kita kemudian membuat skin yang diperlukan. Skin yang merupakan milik kelas widget yang sama, akan disimpan di dalam sebuah file skrip PHP yang namanya berupa nama kelas widget. Semua file-file skin secara default akan disimpan di direktori protected/views/skins. Jika Anda ingin mengubahnya menjadi direktori lain, Anda bisa mengatur properti skinPath pada komponen widgetFactory. Misalnya, kita dapat membuat sebuah file bernama CLinkPager.php di direktori protected/views/skins yang isinya sebagai berikut,\n</p>\n<!--more-->\n<p>\n	 <img src="/yii-ebook/cache/images/thumbnails/orginal/441539788.jpg" alt="441539788.jpg" file-uid="441539788">\n</p>\n<p style="text-align: justify;">\n	Di atas, kita membuat dua buah skin untuk widget CLinkPager: default dan classic. Skin default merupakan skin yang dikenakan pada widget ClinkPager yang kita tidak spesifikasi secara eksplisit properti skin-nya. Sedangkan skin classic merupakan skin yang diaplikasikan ke sebuah widget CLinkPager yang properti skin diisi classic. Misalnya pada kode view di bawah, pager pertama akan menggunakan skin default dan pager yang kedua akan menggunakan skin classic:\n</p>', 'kita-kemudian-membuat-skin-yang-diperlukan', 'linux, css, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/441539788.jpg', 1382172620, 1382172620, 0, 0, 'true', 'E', 0, 'info', '441539788', 'Y', 1),
(12, 'CLinkPager yang properti skin diisi classic.', '<p style="text-align: justify;">\n	  Kita kemudian membuat skin yang diperlukan. Di atas, kita membuat dua buah skin untuk widget CLinkPager: default dan classic. Skin default merupakan skin yang dikenakan pada widget ClinkPager yang kita tidak spesifikasi secara eksplisit properti skin-nya. Sedangkan skin classic merupakan skin yang diaplikasikan ke sebuah widget CLinkPager yang properti skin diisi classic. Misalnya pada kode view di bawah, pager pertama akan menggunakan skin default dan pager yang kedua akan menggunakan skin classic:\n</p>\n<!--more-->\n<p>\n	<img src="/yii-ebook/cache/images/thumbnails/orginal/934068773.jpg" alt="934068773.jpg" file-uid="934068773" style="width: 748px;">\n</p>\n<p style="text-align: justify;">\n	 Di atas, kita membuat dua buah skin untuk widget CLinkPager: default dan classic. Skin default merupakan skin yang dikenakan pada widget ClinkPager yang kita tidak spesifikasi secara eksplisit properti skin-nya. Sedangkan skin classic merupakan skin yang diaplikasikan ke sebuah widget CLinkPager yang properti skin diisi classic. Misalnya pada kode view di bawah, pager pertama akan menggunakan skin default dan pager yang kedua akan menggunakan skin classic: Koding di atas maksudnya meminta Yii supaya ketika me-render tampilan, tempat pertama yang dicari adalah webroot/themes/nightclub. Apabila ternyata file tersebut tidak ada di dalam folder “nightclub” baru dicari di webroot/protected/views. Karena itulah pengetikan nama di bagian config dan nama folder jangan sampai salah. Setelah itu tinggal dicoba Web-nya. Web Anda sudah memiliki tampilan baru!\n</p>', 'clinkpager-yang-properti-skin-diisi-classic', 'linux, css, centos, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/934068773.jpg', 1382172775, 1382172775, 0, 0, 'true', 'E', 0, 'info', '934068773', 'Y', 1),
(13, 'Provides one-way string transliteration', '<p>\n	 Provides one-way string transliteration (romanization) and cleans file names during upload by replacing unwanted characters. Generally spoken, it takes Unicode text and tries to represent it in US-ASCII characters (universally displayable, unaccented characters) by attempting to transliterate the pronunciation expressed by the text in some other writing system to Roman letters.\n</p>\n<!--more-->\n<p>\n	 <img src="/yii-ebook/cache/images/thumbnails/orginal/798564679.jpg" alt="798564679.jpg" file-uid="798564679">\n</p>\n<p>\n	 According to Unidecode, from which most of the transliteration data has been derived, "Russian and Greek seem to work passably. But it works quite bad on Japanese and Thai."\n</p>', 'provides-one-way-string-transliteration', 'centos, ', 'ubuntu', 'P', '/yii-ebook/cache/images/thumbnails/orginal/798564679.jpg', 1382174343, 1382174343, 0, 0, 'true', 'E', 0, 'info', '798564679', 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `image` text,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profile_account1_idx` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `first_name`, `last_name`, `gender`, `address`, `about`, `birthday`, `image`, `account_id`) VALUES
(1, 'ozan', 'rock', 'M', 'mataram', '-', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `post_id` int(11) NOT NULL,
  `term_taxonomy_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`term_taxonomy_id`),
  KEY `fk_post_has_term_taxonomy_term_taxonomy1_idx` (`term_taxonomy_id`),
  KEY `fk_post_has_term_taxonomy_post1_idx` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`post_id`, `term_taxonomy_id`) VALUES
(1, 11),
(3, 11),
(3, 22),
(4, 11),
(5, 12),
(6, 12),
(6, 22),
(7, 12),
(8, 12),
(9, 12),
(10, 12),
(11, 12),
(12, 12),
(13, 12);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `autoload` enum('YES','NO') NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `description`, `frequency`) VALUES
(2, 'ubuntu', 'ubuntu', 3),
(4, 'linux', 'linux', 5),
(5, 'centos', 'centos', 3),
(6, 'css', '', 7),
(7, 'networking', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE IF NOT EXISTS `term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `slug` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`id`, `name`, `slug`) VALUES
(1, 'menu-1', 'null'),
(2, 'Home', '/pront/default/index'),
(3, 'Contact', 'contact/pront/index'),
(4, 'Guestbook', 'guestbook/pront/index'),
(11, 'Linux', 'linux'),
(12, 'ubuntu', 'ubuntu'),
(19, 'melengo', 'melengo'),
(20, 'Download', 'download');

-- --------------------------------------------------------

--
-- Table structure for table `term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `term_taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('category','page_category','pages','nav_menu','nav_link','component') NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `count` varchar(45) NOT NULL DEFAULT '0',
  `status` enum('E','D') NOT NULL DEFAULT 'D',
  `parent` int(11) NOT NULL DEFAULT '0',
  `term_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_term_taxonomy_term1_idx` (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`id`, `type`, `description`, `count`, `status`, `parent`, `term_id`) VALUES
(1, 'nav_menu', 'menu1', '0', 'E', 0, 1),
(2, 'component', 'home', '0', 'E', 0, 2),
(3, 'component', 'contact', '0', 'E', 0, 3),
(4, 'component', 'guestbook', '0', 'E', 0, 4),
(11, 'category', 'linux categories', '0', 'E', 0, 11),
(12, 'category', 'ubuntu category', '0', 'E', 11, 12),
(22, 'page_category', 'melengo', '0', 'E', 0, 19),
(23, 'pages', 'Download', '0', 'E', 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `position` int(11) DEFAULT '0',
  `layouts_position` enum('H','P','S','PM','CM') DEFAULT NULL,
  `status` enum('P','D') NOT NULL,
  `other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `name`, `position`, `layouts_position`, `status`, `other`) VALUES
(1, 'TagCloud', 3, 'P', 'P', NULL),
(2, 'RecentTweets', 1, 'P', 'P', NULL),
(3, 'RecentComments', 2, 'P', 'P', NULL),
(4, 'CategoriesCloud', 4, 'P', 'P', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dropbox_files`
--
ALTER TABLE `dropbox_files`
  ADD CONSTRAINT `fk_dropbox_files_dropbox_account1` FOREIGN KEY (`dropbox_account_id`) REFERENCES `dropbox_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nav_menu`
--
ALTER TABLE `nav_menu`
  ADD CONSTRAINT `fk_nav_menu_term_taxonomy1` FOREIGN KEY (`term_taxonomy_id`) REFERENCES `term_taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `relationships`
--
ALTER TABLE `relationships`
  ADD CONSTRAINT `fk_post_has_term_taxonomy_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_has_term_taxonomy_term_taxonomy1` FOREIGN KEY (`term_taxonomy_id`) REFERENCES `term_taxonomy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  ADD CONSTRAINT `fk_term_taxonomy_term1` FOREIGN KEY (`term_id`) REFERENCES `term` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
