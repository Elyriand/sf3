CREATE TABLE `tickets` (
  `event_name` varchar(255) NOT NULL DEFAULT '',
  `event_description` text NOT NULL,
  `event_date` datetime NOT NULL,
  `bought_at_price` int(10) unsigned NOT NULL,
  `price_currency` char(3) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
