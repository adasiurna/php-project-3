CREATE DATABASE IF NOT EXISTS tvs;
USE tvs;

DROP TABLE IF EXISTS navigation;
DROP TABLE IF EXISTS `page`;



CREATE TABLE `page`(
   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
   `heading` CHAR(100) NOT NULL,
   `content` TEXT NOT NULL,
   `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE navigation(
   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
   `page_id` int(11) unsigned,
   `title` CHAR(30),
   PRIMARY KEY(`id`),
   FOREIGN KEY (page_id) REFERENCES page(id)
   ON UPDATE CASCADE
   ON DELETE CASCADE 

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO page(id, heading, content) 
VALUES (1, 'Lorem', 'Ipsum, chicken, drumstick, and so on'),
(2, 'Quick', 'brown fox jumps over the lazy dog.');

INSERT INTO navigation(page_id, title)
VALUES (1, 'Page 1'),
(2, 'Page 2');