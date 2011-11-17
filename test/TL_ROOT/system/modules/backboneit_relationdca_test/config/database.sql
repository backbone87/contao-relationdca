-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

CREATE TABLE `tl_backboneit_relationdca_test_own` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `onetoone` int(10) unsigned NULL default NULL,
  `manytoone` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `tl_backboneit_relationdca_test_own_ux_onetoone` (`onetoone`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_backboneit_relationdca_test_foreign` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `onetoone` int(10) unsigned NULL default NULL,
  `onetomany` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `tl_backboneit_relationdca_test_onetoone_ux_onetoone` (`onetoone`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_backboneit_relationdca_test_onetoone` (
  `ownCol` int(10) unsigned NOT NULL default '0',
  `foreignCol` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `attributeA` varchar(255) NOT NULL default '',
  `attributeB` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ownCol`),
  UNIQUE KEY `tl_backboneit_relationdca_test_onetoone_ux_foreignCol` (`foreignCol`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_backboneit_relationdca_test_onetomany` (
  `ownCol` int(10) unsigned NOT NULL default '0',
  `foreignCol` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `attributeA` varchar(255) NOT NULL default '',
  `attributeB` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`foreignCol`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_backboneit_relationdca_test_manytoone` (
  `ownCol` int(10) unsigned NOT NULL default '0',
  `foreignCol` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `attributeA` varchar(255) NOT NULL default '',
  `attributeB` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ownCol`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_backboneit_relationdca_test_manytomany` (
  `ownCol` int(10) unsigned NOT NULL default '0',
  `foreignCol` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `attributeA` varchar(255) NOT NULL default '',
  `attributeB` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ownCol`, `foreignCol`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
