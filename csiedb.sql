-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2015 年 07 月 15 日 14:42
-- 伺服器版本: 5.6.20
-- PHP 版本： 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `csiedb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `advertisment`
--

CREATE TABLE IF NOT EXISTS `advertisment` (
`adId` int(11) NOT NULL,
  `logoPath` varchar(100) NOT NULL COMMENT 'logo儲存位置',
  `logoUrl` varchar(100) NOT NULL COMMENT 'logo網址',
  `logoTitle` varchar(50) NOT NULL COMMENT 'logo描述'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 資料表的匯出資料 `advertisment`
--

INSERT INTO `advertisment` (`adId`, `logoPath`, `logoUrl`, `logoTitle`) VALUES
(4, 'uploads/c7890eb50813282681863800cd80343f.jpg', 'http://google.com', 'QAQ');

-- --------------------------------------------------------

--
-- 資料表結構 `file`
--

CREATE TABLE IF NOT EXISTS `file` (
`fileId` int(11) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `filePath` varchar(1000) NOT NULL,
  `fileClass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `file_category`
--

CREATE TABLE IF NOT EXISTS `file_category` (
`fileClass` int(11) NOT NULL,
  `fileClassName` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 資料表的匯出資料 `file_category`
--

INSERT INTO `file_category` (`fileClass`, `fileClassName`) VALUES
(1, '法令規章'),
(2, '系上文件下載'),
(3, '程式設計能力檢定'),
(4, '大學部相關表格'),
(5, '研究所相關表格'),
(6, '系網相關表格');

-- --------------------------------------------------------

--
-- 資料表結構 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
`groupId` int(11) NOT NULL,
  `groupName` varchar(100) NOT NULL,
  `model` tinyint(1) NOT NULL,
  `news_token` tinyint(1) DEFAULT NULL COMMENT '公告管理權限',
  `group_token` tinyint(1) DEFAULT NULL COMMENT '群組管理權限',
  `member_token` tinyint(1) DEFAULT NULL COMMENT '成員管理權限',
  `file_token` tinyint(1) DEFAULT NULL COMMENT '檔案管理權限',
  `page_token` tinyint(1) DEFAULT NULL COMMENT '頁面管理權限',
  `ad_token` tinyint(1) DEFAULT NULL COMMENT '廣告權限'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 資料表的匯出資料 `group`
--

INSERT INTO `group` (`groupId`, `groupName`, `model`, `news_token`, `group_token`, `member_token`, `file_token`, `page_token`, `ad_token`) VALUES
(1, '管理員', 1, 1, 1, 1, 1, 1, 1),
(3, '本系生', 1, 0, NULL, 1, NULL, NULL, NULL),
(4, '行政人員', 1, 1, NULL, NULL, 1, NULL, NULL),
(5, '校友', 0, 0, 0, 0, 0, 1, 1),
(6, '超強群組', 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `account` varchar(100) NOT NULL COMMENT '帳號primary',
  `password` varchar(100) NOT NULL COMMENT 'password',
  `groupId` int(11) NOT NULL COMMENT 'group表的FK',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `email` varchar(100) DEFAULT NULL,
  `forget_token` varchar(32) NOT NULL,
  `createTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`account`, `password`, `groupId`, `name`, `email`, `forget_token`, `createTime`) VALUES
('40043140', 'asdfJKL123', 1, '黃西河', '40043140@gm.nfu.edu.tw', '', '2014-11-24 22:02:55'),
('40043145', '123456789', 1, '趙承瑋', '', '', '2014-08-05 21:00:45'),
('piece601', '123', 6, '駭客', 'piece601@hotmail.com', '4e4d0da2018325936f6c93359787416e', '2015-01-06 17:05:03');

-- --------------------------------------------------------

--
-- 資料表結構 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`newsId` int(11) NOT NULL COMMENT '公告的PK',
  `newsTitle` varchar(100) NOT NULL,
  `newsContent` text NOT NULL,
  `newsDate` date NOT NULL,
  `newsClass` varchar(100) NOT NULL,
  `newsAuthor` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 資料表的匯出資料 `news`
--

INSERT INTO `news` (`newsId`, `newsTitle`, `newsContent`, `newsDate`, `newsClass`, `newsAuthor`) VALUES
(1, '測試公告', '<p>ya</p>', '2014-08-04', 'csie', ''),
(4, 'test', '<p>tset</p>', '2014-08-04', 'activity', ''),
(5, 'test', '<p>test</p>', '2014-08-04', 'activity', ''),
(6, 'adsdasd', '<p>asdasdasd</p>', '2014-08-04', 'activity', ''),
(7, '幹人日ㄓ', '<p>鳥哥</p>', '2014-08-04', 'csie', ''),
(8, '無敵夏令營', '<p>淫蕩</p>', '2014-08-04', 'other', ''),
(9, '臥草', '<p>臥草幹</p>', '2014-08-04', 'csie', ''),
(10, '學校公告1', '<p>學校公告</p>', '2014-08-04', 'school', ''),
(11, '學校公告2', '<p>學校公告2</p>', '2014-08-04', 'school', ''),
(12, '學校公告3', '<p>學校公告3</p>', '2014-08-04', 'school', ''),
(13, '學校公告4', '<p>學校公告4</p>', '2014-08-04', 'school', ''),
(14, '學校公告5', '<p>學校公告</p>', '2014-08-04', 'school', ''),
(15, '學校公告6', '<p>學校公告</p>', '2014-08-04', 'school', ''),
(16, '學校公告7', '<p>學校公告</p>', '2014-08-04', 'school', ''),
(17, '學校公告8', '<p>學校公告</p>', '2014-08-04', 'school', ''),
(18, '學校公告9', '<p>學校公告</p>', '2014-08-04', 'school', ''),
(19, '學校公告10', '<p>學校公告</p>\n\n<p>&nbsp;</p>\n\n<p><a href="http://GOOGLE.COM.TW">XXXX</a></p>\n', '2014-08-04', 'school', ''),
(20, '學校公告11', '<p>學校公告11</p>', '2014-08-04', 'school', ''),
(22, 'X', '<p>X</p>', '2014-08-05', 'other', ''),
(23, 'test', '<p>&nbsp;</p>\n\n<blockquote>\n<p>This is a <span style="color:#00FF00"><span style="font-family:trebuchet ms,helvetica,sans-serif"><span style="font-size:26px">test</span></span></span>&nbsp;.</p>\n</blockquote>\n\n<p>午餐吃什麼?</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n', '2014-08-05', 'other', ''),
(25, 'tests', '<p>testsetes</p>', '2014-08-06', 'activity', '王小明'),
(26, 'tset', '<p>test</p>', '2014-09-17', 'activity', '王小明'),
(27, 'test', '<p>sss</p>', '2014-10-01', 'activity', '趙承瑋');

-- --------------------------------------------------------

--
-- 資料表結構 `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
  `newsClass` varchar(20) NOT NULL,
  `newsClassName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `news_category`
--

INSERT INTO `news_category` (`newsClass`, `newsClassName`) VALUES
('', '全部公告'),
('activity', '活動公告'),
('csie', '系務公告'),
('other', '其它公告'),
('school', '學校公告');

-- --------------------------------------------------------

--
-- 資料表結構 `news_file`
--

CREATE TABLE IF NOT EXISTS `news_file` (
`newsFileId` int(11) NOT NULL,
  `newsFileName` varchar(100) NOT NULL,
  `newsFilePath` varchar(100) NOT NULL,
  `newsId` int(11) NOT NULL COMMENT '公告的PK'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 資料表的匯出資料 `news_file`
--

INSERT INTO `news_file` (`newsFileId`, `newsFileName`, `newsFilePath`, `newsId`) VALUES
(1, 'lf2', 'uploads/d8b136920c732d1ade66632e80311443.zip', 21),
(2, '豆漿', 'uploads/eab8f01177cfa06f247070cc55352efb.pdf', 21),
(3, 'ＸＤ', 'uploads/500f7eeac169bce628023082f3f81d77.jpg', 11),
(4, '', 'uploads/cde18ac87fab496c94bf53a3ab1c9581.jpg', 28),
(5, '', 'uploads/c7cdce060e748ceee9cf57454aba48b5.jpg', 28);

-- --------------------------------------------------------

--
-- 資料表結構 `page`
--

CREATE TABLE IF NOT EXISTS `page` (
`pageId` int(11) NOT NULL,
  `pageName` varchar(100) NOT NULL,
  `pageClass` varchar(100) NOT NULL,
  `pageContent` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 資料表的匯出資料 `page`
--

INSERT INTO `page` (`pageId`, `pageName`, `pageClass`, `pageContent`) VALUES
(1, '教育目標與核心能力', '2', '<p>安安</p>'),
(2, '系所介紹', '2', '<p>資訊安安黑客系所很牛Ｂ</p>'),
(3, '系所位置', '2', '<p>不告訴你XD</p>'),
(4, 'test', '9', '<p>test</p>'),
(5, 'GG', '9', '<p>GG</p>'),
(7, '沒有校友就不會有專區了啊', '8', '<p>哈哈哈哈哈哈</p>'),
(8, '認證完畢就可以畢業了', '7', '<p>認證完畢就可以畢業了</p>'),
(9, '計劃趕不上變化', '6', '<p>變化趕不上計劃</p>'),
(10, '有設備也不借你拉 哈哈哈', '5', '<p>哈屁</p>'),
(11, '教授', '3', '<p>秘密</p>'),
(12, 'asd', '11', '<p>XDD</p>');

-- --------------------------------------------------------

--
-- 資料表結構 `page_category`
--

CREATE TABLE IF NOT EXISTS `page_category` (
`pageClass` int(11) NOT NULL,
  `pageClassName` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 資料表的匯出資料 `page_category`
--

INSERT INTO `page_category` (`pageClass`, `pageClassName`) VALUES
(2, '系所簡介'),
(3, '本系成員'),
(4, '課程規劃'),
(5, '實驗設備'),
(6, '相關計劃'),
(7, '工程認證'),
(8, '校友專區'),
(9, '網站功能'),
(11, 'XDDDD');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `advertisment`
--
ALTER TABLE `advertisment`
 ADD PRIMARY KEY (`adId`);

--
-- 資料表索引 `file`
--
ALTER TABLE `file`
 ADD PRIMARY KEY (`fileId`);

--
-- 資料表索引 `file_category`
--
ALTER TABLE `file_category`
 ADD PRIMARY KEY (`fileClass`);

--
-- 資料表索引 `group`
--
ALTER TABLE `group`
 ADD PRIMARY KEY (`groupId`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`account`);

--
-- 資料表索引 `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`newsId`);

--
-- 資料表索引 `news_category`
--
ALTER TABLE `news_category`
 ADD PRIMARY KEY (`newsClass`);

--
-- 資料表索引 `news_file`
--
ALTER TABLE `news_file`
 ADD PRIMARY KEY (`newsFileId`);

--
-- 資料表索引 `page`
--
ALTER TABLE `page`
 ADD PRIMARY KEY (`pageId`);

--
-- 資料表索引 `page_category`
--
ALTER TABLE `page_category`
 ADD PRIMARY KEY (`pageClass`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `advertisment`
--
ALTER TABLE `advertisment`
MODIFY `adId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- 使用資料表 AUTO_INCREMENT `file`
--
ALTER TABLE `file`
MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `file_category`
--
ALTER TABLE `file_category`
MODIFY `fileClass` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 使用資料表 AUTO_INCREMENT `group`
--
ALTER TABLE `group`
MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 使用資料表 AUTO_INCREMENT `news`
--
ALTER TABLE `news`
MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告的PK',AUTO_INCREMENT=28;
--
-- 使用資料表 AUTO_INCREMENT `news_file`
--
ALTER TABLE `news_file`
MODIFY `newsFileId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- 使用資料表 AUTO_INCREMENT `page`
--
ALTER TABLE `page`
MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- 使用資料表 AUTO_INCREMENT `page_category`
--
ALTER TABLE `page_category`
MODIFY `pageClass` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
