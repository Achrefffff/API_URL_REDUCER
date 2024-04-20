CREATE TABLE `urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `long_url` varchar(2048) NOT NULL,
  `short_url` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_url` (`short_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
