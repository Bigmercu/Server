
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `time` datetime NOT NULL,
  `openid` text NOT NULL,
  PRIMARY KEY (`time`),
  UNIQUE KEY `time` (`time`),
  KEY `id` (`id`),
  KEY `time_2` (`time`),
  KEY `time_3` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


