<?php

$db_constants = [
	"server" => "localhost:3306",
	"user" => "root",
	"database" => "sms_gateway",
	"password" => "hot/leo/1244/06", 
];

function getConnection($consts)
{
	$db_constants = $consts;
	$con = new mysqli($db_constants["server"], $db_constants["user"], $db_constants["password"], $db_constants["database"]);

    if($con->connect_error)
        throw new Exception("Error connecting to the database. ".$con->connect_error, 1);
    return $con;
}


function getPartialConnection($consts)
{
	$db_constants = $consts;

	$con = new mysqli($db_constants["server"], $db_constants["user"], $db_constants["password"]);

	if($con->connect_error) {
		throw new Exception("Error connecting to the database server. ".$con->connect_error, 1);
	}

	return $con;
}

function init($db)
{
	createDb($db);
	createTables($db);
}

function createTables($db)
{
	$userQuery = "CREATE TABLE IF NOT EXISTS `sms_gateway`.`user` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `username` VARCHAR(45) NOT NULL,
	  `email_address` VARCHAR(100) NOT NULL,
	  `password` VARCHAR(200) NOT NULL,
	  `created_at` INT NULL,
	  `updated_at` INT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
	  UNIQUE INDEX `email_address_UNIQUE` (`email_address` ASC))
	ENGINE = InnoDB";

	$messageQuery = "CREATE TABLE IF NOT EXISTS `sms_gateway`.`message` (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `text_message` TEXT NOT NULL,
	  `recipient` VARCHAR(15) NOT NULL,
	  `status` VARCHAR(45) NOT NULL,
	  `created_at` INT NULL,
	  `update_at` INT NULL,
	  `user_id` INT NOT NULL,
	  PRIMARY KEY (`id`),
	  INDEX `fk_message_user_idx` (`user_id` ASC),
	  CONSTRAINT `fk_message_user`
	    FOREIGN KEY (`user_id`)
	    REFERENCES `sms_gateway`.`user` (`id`)
	    ON DELETE CASCADE
	    ON UPDATE CASCADE)
	ENGINE = InnoDB";

	$userProfileQuery = "CREATE TABLE IF NOT EXISTS `sms_gateway`.`user_profile` (
	  `user_id` INT NOT NULL,
	  `name` VARCHAR(100) NULL,
	  INDEX `fk_user_profile_user1_idx` (`user_id` ASC),
	  PRIMARY KEY (`user_id`),
	  CONSTRAINT `fk_user_profile_user1`
	    FOREIGN KEY (`user_id`)
	    REFERENCES `sms_gateway`.`user` (`id`)
	    ON DELETE CASCADE
	    ON UPDATE CASCADE)
	ENGINE = InnoDB";

	$con = getConnection($db);

	$rs = $con->query($userQuery);

	if($rs === false) {
		echo $con->error;
	}

	$rs = $con->query($messageQuery);

	if($rs === false) {
		echo $con->error;
	}

	$rs = $con->query($userProfileQuery);

	if($rs === false) {
		echo $con->error;
	}

}

function createDb($db)
{
	// create the database if not exists
	$query = "CREATE SCHEMA IF NOT EXISTS `sms_gateway` DEFAULT CHARACTER SET utf8";

	$con = getPartialConnection($db);

	$rs = $con->query($query);

	if($rs === false) {
		echo $con->error;
	}
}


init($db_constants);