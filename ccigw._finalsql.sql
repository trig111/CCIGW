SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `liu11121_ccigw`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_access`
--

CREATE TABLE IF NOT EXISTS `db_access` (
  `accessid` int(11) NOT NULL AUTO_INCREMENT,
  `readaccess` int(11) NOT NULL,
  `allowview` tinyint(1) NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowreply` tinyint(1) NOT NULL DEFAULT '0',
  `allowupdate` tinyint(1) NOT NULL DEFAULT '0',
  `allowdelete` tinyint(1) NOT NULL DEFAULT '0',
  `allowgetattach` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostattach` tinyint(1) NOT NULL DEFAULT '0',
  `allowsearch` tinyint(1) NOT NULL DEFAULT '0',
  `allowsetreadperm` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`accessid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `db_access`
--

INSERT INTO `db_access` (`accessid`, `readaccess`, `allowview`, `allowpost`, `allowreply`, `allowupdate`, `allowdelete`, `allowgetattach`, `allowpostattach`, `allowsearch`, `allowsetreadperm`, `type`) VALUES
(1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'guest'),
(2, 10, 1, 0, 1, 0, 0, 1, 0, 1, 0, 'user'),
(3, 100, 1, 1, 1, 1, 1, 1, 1, 1, 0, 'morderator'),
(4, 255, 1, 1, 1, 1, 1, 1, 1, 1, 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `db_events`
--

CREATE TABLE IF NOT EXISTS `db_events` (
  `eventsid` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `readaccess` int(11) NOT NULL,
  `body` mediumtext NOT NULL,
  `categoryid` int(11) NOT NULL,
  `createtime` datetime NOT NULL,
  `uid` int(11) NOT NULL,
  `startime` date DEFAULT NULL,
  `endtime` date DEFAULT NULL,
  `maxmember` int(11) NOT NULL,
  `lastedit` datetime DEFAULT NULL,
  PRIMARY KEY (`eventsid`),
  KEY `uid` (`uid`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `db_events`
--

INSERT INTO `db_events` (`eventsid`, `subject`, `readaccess`, `body`, `categoryid`, `createtime`, `uid`, `startime`, `endtime`, `maxmember`, `lastedit`) VALUES
(1, 'Event 4311', 0, 'Hello , This is a event222222 . We should meet at 4 oclock 2121', 4, '0000-00-00 00:00:00', 1, NULL, NULL, 0, '2014-06-15 13:08:21'),
(8, 'Event 4311', 0, 'Hello , This is a event222222 . We should meet at 4 oclock 2121', 4, '0000-00-00 00:00:00', 1, NULL, NULL, 0, '2014-06-15 13:08:21'),
(9, 'Event 4311', 0, 'Hello , This is a event222222 . We should meet at 4 oclock 2121', 4, '0000-00-00 00:00:00', 1, NULL, NULL, 0, '2014-06-15 13:08:21'),
(13, 'wocaowocao wocaocaocao', 20, 'lalalallala', 4, '2014-06-16 01:10:11', 8, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_evtreply`
--

CREATE TABLE IF NOT EXISTS `db_evtreply` (
  `eventsreplyid` int(11) NOT NULL AUTO_INCREMENT,
  `eventsid` int(11) NOT NULL,
  `body` mediumtext,
  `uid` int(11) NOT NULL,
  `replytime` datetime NOT NULL,
  `lastedit` datetime DEFAULT NULL,
  PRIMARY KEY (`eventsreplyid`),
  KEY `uid` (`uid`),
  KEY `eventsid` (`eventsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `db_evtreply`
--

INSERT INTO `db_evtreply` (`eventsreplyid`, `eventsid`, `body`, `uid`, `replytime`, `lastedit`) VALUES
(14, 1, '<p>dfasdsf</p>', 1, '2014-06-15 04:57:03', NULL),
(15, 1, '<p>sdfasfasdf</p>', 1, '2014-06-15 04:57:38', NULL),
(16, 1, '<p>dfasfasdf</p>', 1, '2014-06-15 04:59:38', NULL),
(23, 1, '<p>dfsf</p>', 1, '2014-06-15 05:27:42', NULL),
(53, 9, '<p>Hello</p>', 8, '2014-06-15 23:54:25', NULL),
(54, 13, '<p>lklk</p>', 8, '2014-06-16 13:14:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_news`
--

CREATE TABLE IF NOT EXISTS `db_news` (
  `newsid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `readaccess` int(11) NOT NULL,
  `subject` mediumtext NOT NULL,
  `createtime` datetime NOT NULL,
  `body` varchar(255) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `lastedit` datetime DEFAULT NULL,
  PRIMARY KEY (`newsid`),
  KEY `uid` (`uid`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `db_news`
--

INSERT INTO `db_news` (`newsid`, `uid`, `readaccess`, `subject`, `createtime`, `body`, `categoryid`, `lastedit`) VALUES
(4, 1, 0, 'update news2dfas', '0000-00-00 00:00:00', 'update body test22222', 4, '2014-06-15 17:22:33'),
(5, 2, 3, 'NFGMFsf', '2014-06-15 02:01:22', '547546547s', 2, NULL),
(8, 1, 0, 'News 333', '0000-00-00 00:00:00', 'News contentdfas', 4, '2014-06-15 17:44:48'),
(9, 1, 20, 'News title', '2014-06-15 17:44:54', 'News content1313', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_regevt`
--

CREATE TABLE IF NOT EXISTS `db_regevt` (
  `regid` int(11) NOT NULL AUTO_INCREMENT,
  `eventsid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `registertime` datetime NOT NULL,
  `numberofpeople` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `remarks` mediumtext NOT NULL,
  `lastedit` datetime DEFAULT NULL,
  PRIMARY KEY (`regid`),
  KEY `uid` (`uid`),
  KEY `eventsid` (`eventsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE IF NOT EXISTS `db_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `accessid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `identifier` char(20) DEFAULT NULL,
  `expiry_time` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `accessid` (`accessid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`uid`, `accessid`, `username`, `userpass`, `email`, `firstname`, `lastname`, `gender`, `phonenumber`, `address`, `status`, `created`, `lastlogin`, `identifier`, `expiry_time`) VALUES
(1, 3, 'testuser1', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'dasdasfas', '', '', 'm', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2014-06-16 01:54:43'),
(2, 1, 'test1212121', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2121212121212121', '21212', 'dfasfas', 'm', 'dsaf34', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2014-06-16 01:54:43'),
(5, 1, 'testuser0', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'dasffadsfsdfsd', '', '', 'm', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2014-06-16 03:17:56'),
(8, 4, 'preney', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'preney@uwindsor.ca', 'paul', 'preney', 'm', '', '', 1, '2014-06-15 23:07:05', '2014-06-16 14:43:11', NULL, NULL),
(9, 1, 'ang', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'sparkingurl@hotmail.com', '', '', 'f', '', '', 0, '2014-06-15 23:17:02', NULL, '8477', '2014-06-16 23:18:37'),
(10, 1, 'loppol', 'd32deffad307a4578cfb581d3377a24407f513bd', 'loppol@live.cn', '', '', 'm', '', '', 0, '2014-06-16 14:45:38', NULL, '0419', '2014-06-17 14:45:38'),
(11, 1, 'whp', '0162798252435081a58a7dbc8960fec66ccb7727', 'wang18z@uwindsor.ca', '', '', 'm', '', '', 0, '2014-06-16 17:24:55', NULL, '8702', '2014-06-17 17:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `id_category`
--

CREATE TABLE IF NOT EXISTS `id_category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(255) NOT NULL,
  PRIMARY KEY (`categoryid`),
  UNIQUE KEY `categoryname` (`categoryname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `id_category`
--

INSERT INTO `id_category` (`categoryid`, `categoryname`) VALUES
(4, 'EDUCATION'),
(1, 'RENT'),
(2, 'SELL');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `db_events`
--
ALTER TABLE `db_events`
  ADD CONSTRAINT `db_events_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `db_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `db_events_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `id_category` (`categoryid`) ON UPDATE CASCADE;

--
-- Constraints for table `db_evtreply`
--
ALTER TABLE `db_evtreply`
  ADD CONSTRAINT `db_evtreply_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `db_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `db_evtreply_ibfk_2` FOREIGN KEY (`eventsid`) REFERENCES `db_events` (`eventsid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_news`
--
ALTER TABLE `db_news`
  ADD CONSTRAINT `db_news_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `db_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `db_news_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `id_category` (`categoryid`) ON UPDATE CASCADE;

--
-- Constraints for table `db_regevt`
--
ALTER TABLE `db_regevt`
  ADD CONSTRAINT `db_regevt_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `db_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `db_regevt_ibfk_2` FOREIGN KEY (`eventsid`) REFERENCES `db_events` (`eventsid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_user`
--
ALTER TABLE `db_user`
  ADD CONSTRAINT `db_user_ibfk_1` FOREIGN KEY (`accessid`) REFERENCES `db_access` (`accessid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
