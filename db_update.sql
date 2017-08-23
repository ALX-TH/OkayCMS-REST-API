CREATE TABLE IF NOT EXISTS `ok_restapi` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `token_expire` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
