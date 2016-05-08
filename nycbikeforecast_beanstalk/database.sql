#DB


CREATE TABLE IF NOT EXISTS `stationBeanList` (
  `parseTime` BIGINT(20) NOT NULL,
  `executionTime` BIGINT(20) NOT NULL,
  `id` INT  NOT NULL,
  `stationName` VARCHAR(255) NOT NULL,
  `availableDocks` SMALLINT NOT NULL,
  `totalDocks` SMALLINT NOT NULL,
  `latitude` DECIMAL(11,8) NOT NULL,
  `longitude` DECIMAL(11,8) NOT NULL,
  `statusValue` VARCHAR(255) NOT NULL,
  `statusKey` SMALLINT,
  `availableBikes` SMALLINT NOT NULL,
  `stAddress1` VARCHAR(255),
  `stAddress2` VARCHAR(255),
  `city` VARCHAR(255),
  `postalCode` VARCHAR(255),
  `location` VARCHAR(255),
  `altitude` DECIMAL(11,8),
  `testStation` VARCHAR(255),
  `lastCommunicationTime` VARCHAR(255),
  `landMark` VARCHAR(255),
  KEY `id_idx` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


SELECT DISTINCT `id`, `stationName`, `latitude`, `longitude`, `stAddress1` FROM `stationBeanList` ORDER BY `id` ASC

SELECT
`parseTime`, `executionTime`, `availableBikes` , `availableDocks` , `totalDocks` , `statusKey` , `statusValue` , `testStation` , `lastCommunicationTime`
FROM
`stationBeanList`
WHERE
`id` = 72
ORDER BY `parseTime` ASC


SELECT DISTINCT `parseTime` FROM `stationBeanList` ORDER BY `parseTime` ASC;

SELECT
`parseTime`, `executionTime`, `availableBikes` , `availableDocks` , `totalDocks` , `statusKey` , `statusValue` , `testStation` , `lastCommunicationTime`
FROM
`stationBeanList`
WHERE
`parseTime` = parseTime
ORDER BY `id` ASC