DROP TABLE IF EXISTS `auth_token`;
CREATE TABLE IF NOT EXISTS `auth_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(225) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active,2-InActive',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1-Login, 2- Reser PWD',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` text NOT NULL,
  `event_time` datetime NOT NULL,
  `event_lat` varchar(100) NOT NULL,
  `event_long` varchar(100) NOT NULL,
  `event_address` varchar(300) NOT NULL,
  `event_city` varchar(300) NOT NULL,
  `event_country` varchar(300) NOT NULL,
  `event_state` varchar(300) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-public,2-private',
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events_invites`
--

DROP TABLE IF EXISTS `events_invites`;
CREATE TABLE IF NOT EXISTS `events_invites` (
  `events_invites_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`events_invites_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Active 2- Inactive 3-Deleted',
  PRIMARY KEY (`user_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;
COMMIT;