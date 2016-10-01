CREATE DATABASE `spacelog` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `sl_global` (
  `gid` int(11) NOT NULL COMMENT 'global id',
  `u_count` int(11) NOT NULL COMMENT 'user count',
  `e_count` int(11) NOT NULL COMMENT 'event count',
  `access` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'access',
  PRIMARY KEY (`gid`),
  UNIQUE KEY `gid_UNIQUE` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='space log global';

CREATE TABLE `sl_list` (
  `eid` int(11) NOT NULL COMMENT 'event id',
  `uid` int(11) NOT NULL COMMENT 'ref user id',
  `year` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'year',
  `month` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'month',
  `day` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'day',
  `start` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'list ending',
  `end` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'list ending',
  `stamp` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'time stamp',
  `event` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'event description',
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'event status',
  PRIMARY KEY (`eid`),
  UNIQUE KEY `eid_UNIQUE` (`eid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='space log event list';

CREATE TABLE `sl_profile` (
  `uid` int(11) NOT NULL COMMENT 'user id',
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user name',
  `spec` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user specs',
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password_hint` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='space log profile';
