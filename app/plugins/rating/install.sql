# required #
CREATE TABLE `ratings` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` char(36) NOT NULL default '',
  `model_id` char(36) NOT NULL default '',  
  `model` varchar(100) NOT NULL default '',
  `rating` tinyint(2) unsigned NOT NULL default '0',
  `name` varchar(100) default '',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY (`id`),
  KEY `rating` (`model_id`,`model`,`rating`,`name`)
);

# optional #
CREATE TABLE `foobars` (
  `id` varchar(36) NOT NULL default '',
  `user_id` varchar(100) NOT NULL default '',
  `foo` int(11) NOT NULL default '0',
  `bar` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;