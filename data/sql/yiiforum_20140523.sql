ALTER TABLE  `board` ADD  `columns` SMALLINT NOT NULL DEFAULT  '0' AFTER  `description` ,
ADD  `sort_num` INT NOT NULL DEFAULT  '0' AFTER  `columns` ,
ADD  `redirect_url` VARCHAR( 128 ) NULL DEFAULT NULL AFTER  `sort_num` ,
ADD  `target` VARCHAR( 32 ) NOT NULL DEFAULT  '_blank' AFTER  `redirect_url` ,