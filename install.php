<?php
include "config.php";
$init = "CREATE TABLE `mods` (
	`NAME` TEXT(64) DEFAULT '' COMMENT 'name for the mod',
	`DESC` TEXT(2000) COMMENT 'descriptions for the mod',
	`DOWNLOAD` TEXT(1000) COMMENT 'download link for the mod',
	`ID` INT NOT NULL AUTO_INCREMENT COMMENT 'mod id',
    primary key (ID)
) ENGINE=InnoDB;";

$init2 = "CREATE TABLE `accounts` (
    `username` varchar(24) NOT NULL,
  	`password` varchar(255) NOT NULL,
    `banned` boolean DEFAULT false,
	`ID` INT NOT NULL AUTO_INCREMENT COMMENT 'acc id',
    primary key (ID)
) ENGINE=InnoDB;";

$inits = [$init, $init2];

if(!file_exists(".installed")){
    $conn = new mysqli($servername, $username, $password);
    $conn-> select_db($database);
    foreach($inits as $tablecreate){
        if ($conn->query($tablecreate) === TRUE) {
            echo "Database initialized!";
        } else {
            die ("Error initializing database: " . $conn->error);
        }
    }
    file_put_contents(".installed", "the database has been initialized");
    $conn->close();
}
else echo("DB has already been initialized, no need to do it again.");