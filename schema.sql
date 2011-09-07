CREATE TABLE `searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(45) DEFAULT NULL,
  `results` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
