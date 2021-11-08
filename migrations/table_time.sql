CREATE TABLE `time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time(6) DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  `id_types_garbage` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_users`,`id_types_garbage`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4;