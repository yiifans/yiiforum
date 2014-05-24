ALTER TABLE  `board` CHANGE  `modify_time`  `modify_time` TIMESTAMP NULL DEFAULT NULL ;
ALTER TABLE  `board` ADD  `user_id` INT NULL DEFAULT  '0' AFTER  `modify_time` ,
ADD  `user_name` VARCHAR( 32 ) NULL DEFAULT NULL AFTER  `user_id` ,
ADD  `thread_id` INT NULL DEFAULT  '0' AFTER  `user_name` ,
ADD  `thread_title` VARCHAR( 256 ) NULL DEFAULT NULL AFTER  `thread_id` ;