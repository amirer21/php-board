CREATE TABLE `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`username` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;
