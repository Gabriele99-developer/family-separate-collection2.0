CREATE TABLE `time` (
  `timeid` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time(6) DEFAULT NULL,
  `usersid` int(11) NOT NULL,
  `types_garbageid` int(11) NOT NULL,
  PRIMARY KEY (`timeid`,`usersid`,`types_garbageid`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;
