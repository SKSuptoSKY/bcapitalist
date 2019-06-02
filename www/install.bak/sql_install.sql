-- phpMyAdmin SQL Dump
-- version 2.8.0.3
-- http://www.phpmyadmin.net
-- 
-- 호스트: localhost
-- 처리한 시간: 12-07-26 10:55 
-- 서버 버전: 5.0.92
-- PHP 버전: 5.2.17
-- 
-- 데이터베이스: `idb02595`
-- 

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Banner`
-- 

CREATE TABLE `Gn_Banner` (
  `bn_no` int(11) NOT NULL auto_increment,
  `bn_begin_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `bn_end_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `bn_subject` text NOT NULL,
  `bn_category` varchar(100) NOT NULL,
  `bn_content` text NOT NULL,
  `bn_link` varchar(255) NOT NULL,
  `bn_link_target` varchar(50) NOT NULL,
  `bn_sort` int(11) NOT NULL,
  PRIMARY KEY  (`bn_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Config`
-- 

CREATE TABLE `Gn_Board_Config` (
  `code` int(11) NOT NULL auto_increment,
  `boardgroup` varchar(100) NOT NULL default '',
  `dbname` varchar(50) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `skin` varchar(100) NOT NULL default '',
  `width` int(4) NOT NULL default '0',
  `page_rows` int(2) NOT NULL default '0',
  `page_block` int(2) NOT NULL default '0',
  `listcount` int(2) NOT NULL default '0',
  `listsubject` int(11) NOT NULL default '0',
  `imgsize` int(4) NOT NULL default '0',
  `sum_width` int(150) NOT NULL,
  `sum_height` int(130) NOT NULL,
  `sum_resize` int(1) NOT NULL,
  `sum_flag` int(1) NOT NULL,
  `fileupnum` int(4) NOT NULL default '0',
  `fileupsize` int(11) NOT NULL default '0',
  `page_loc` varchar(255) NOT NULL default '',
  `head` varchar(255) NOT NULL default '',
  `headtag` text,
  `foot` varchar(255) NOT NULL default '',
  `foottag` text,
  `category` varchar(255) NOT NULL default '',
  `copymove` longtext NOT NULL,
  `use_view` int(1) NOT NULL default '1',
  `use_spam` int(1) NOT NULL default '1',
  `use_comment` int(1) NOT NULL default '1',
  `use_category` int(1) NOT NULL default '1',
  `use_category_top` int(1) NOT NULL default '0',
  `use_secret` int(1) NOT NULL default '1',
  `use_asecret` int(1) NOT NULL default '1',
  `use_html` int(1) NOT NULL default '1',
  `use_notice` int(1) NOT NULL default '1',
  `use_data` int(1) NOT NULL default '1',
  `use_reply` int(1) NOT NULL default '1',
  `use_best` int(1) NOT NULL default '1',
  `use_combest` int(1) NOT NULL default '1',
  `use_kakotalk` int(1) NOT NULL default '0',
  `use_kakostory` int(1) NOT NULL default '0',
  `use_facebook` int(1) NOT NULL default '0',
  `use_twitter` int(1) NOT NULL default '0',
  `level_html` int(3) NOT NULL default '0',
  `view_list` int(1) NOT NULL default '1',
  `view_sort` int(1) NOT NULL default '0',
  `level_list` int(3) NOT NULL default '0',
  `level_write` int(3) NOT NULL default '0',
  `level_reple` int(3) NOT NULL default '0',
  `level_view` int(3) NOT NULL default '0',
  `level_com` int(3) NOT NULL default '0',
  `level_notice` int(3) NOT NULL default '100',
  `point_write` int(5) NOT NULL default '20',
  `point_replay` int(5) NOT NULL default '10',
  `point_comment` int(5) NOT NULL default '5',
  `point_chu` int(5) NOT NULL default '2',
  `boardsort` int(11) NOT NULL,
  `view` int(1) NOT NULL default '1',
  `regist` int(11) NOT NULL default '0',
  `site` varchar(100) NOT NULL default '',
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Item_notice`
-- 

CREATE TABLE `Gn_Board_Item_notice` (
  `b_no` int(11) NOT NULL AUTO_INCREMENT,
  `b_tno` int(11) NOT NULL,
  `b_dep` varchar(20) NOT NULL DEFAULT '',
  `b_category` varchar(30) NOT NULL DEFAULT '',
  `b_member` varchar(30) NOT NULL DEFAULT '',
  `b_writer` varchar(100) NOT NULL DEFAULT '',
  `b_passwd` varchar(50) NOT NULL DEFAULT '',
  `b_subject` varchar(255) NOT NULL DEFAULT '',
  `b_email` varchar(50) NOT NULL DEFAULT '',
  `b_content` longtext NOT NULL,
  `b_secret` int(1) NOT NULL DEFAULT '0',
  `b_notice` int(1) NOT NULL DEFAULT '0',
  `b_html` int(1) NOT NULL DEFAULT '0',
  `b_link1` varchar(255) NOT NULL DEFAULT '',
  `b_link2` varchar(255) NOT NULL DEFAULT '',
  `b_ex1` varchar(255) NOT NULL DEFAULT '',
  `b_ex2` varchar(255) NOT NULL DEFAULT '',
  `b_ex3` varchar(255) NOT NULL DEFAULT '',
  `b_ex4` varchar(255) NOT NULL DEFAULT '',
  `b_ex5` varchar(255) NOT NULL DEFAULT '',
  `b_ex6` varchar(255) NOT NULL DEFAULT '',
  `b_ex7` varchar(255) NOT NULL DEFAULT '',
  `b_ex8` varchar(255) NOT NULL DEFAULT '',
  `b_ex9` varchar(255) NOT NULL DEFAULT '',
  `b_ex10` varchar(255) NOT NULL DEFAULT '',
  `b_best` int(11) NOT NULL DEFAULT '0',
  `b_bestid` text NOT NULL,
  `b_hit` int(11) NOT NULL DEFAULT '0',
  `b_modify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `b_regist` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `b_addip` varchar(20) NOT NULL DEFAULT '',
  `dbname` varchar(50) NOT NULL DEFAULT 'notice',
  `site` varchar(100) NOT NULL DEFAULT '',
  UNIQUE KEY `b_no` (`b_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Comm_notice`
-- 

CREATE TABLE `Gn_Board_Comm_notice` (
  `c_no` int(11) NOT NULL AUTO_INCREMENT,
  `c_bno` int(11) NOT NULL,
  `c_tno` int(11) NOT NULL,
  `c_dep` varchar(20) NOT NULL,
  `c_member` varchar(30) NOT NULL DEFAULT '',
  `c_writer` varchar(100) NOT NULL DEFAULT '',
  `c_passwd` varchar(50) NOT NULL DEFAULT '',
  `c_subject` varchar(255) NOT NULL DEFAULT '',
  `c_content` text NOT NULL,
  `c_ex1` varchar(255) NOT NULL DEFAULT '',
  `c_ex2` varchar(255) NOT NULL DEFAULT '',
  `c_ex3` varchar(255) NOT NULL DEFAULT '',
  `c_ex4` varchar(255) NOT NULL DEFAULT '',
  `c_ex5` varchar(255) NOT NULL DEFAULT '',
  `c_ex6` varchar(255) NOT NULL DEFAULT '',
  `c_ex7` varchar(255) NOT NULL DEFAULT '',
  `c_ex8` varchar(255) NOT NULL DEFAULT '',
  `c_ex9` varchar(255) NOT NULL DEFAULT '',
  `c_ex10` varchar(255) NOT NULL DEFAULT '',
  `c_best` int(11) NOT NULL DEFAULT '0',
  `c_bestid` text NOT NULL,
  `c_modify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `c_regist` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `c_addip` varchar(20) NOT NULL DEFAULT '',
  `dbname` varchar(50) NOT NULL DEFAULT 'notice',
  `site` varchar(100) NOT NULL DEFAULT '',
  UNIQUE KEY `c_no` (`c_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Item_shop_review`
-- 

CREATE TABLE `Gn_Board_Item_shop_review` (
  `b_no` int(11) NOT NULL AUTO_INCREMENT,
  `b_tno` int(11) NOT NULL,
  `b_dep` varchar(20) NOT NULL DEFAULT '',
  `b_category` varchar(30) NOT NULL DEFAULT '',
  `b_member` varchar(30) NOT NULL DEFAULT '',
  `b_writer` varchar(100) NOT NULL DEFAULT '',
  `b_passwd` varchar(50) NOT NULL DEFAULT '',
  `b_subject` varchar(255) NOT NULL DEFAULT '',
  `b_email` varchar(50) NOT NULL DEFAULT '',
  `b_content` longtext NOT NULL,
  `b_secret` int(1) NOT NULL DEFAULT '0',
  `b_notice` int(1) NOT NULL DEFAULT '0',
  `b_html` int(1) NOT NULL DEFAULT '0',
  `b_link1` varchar(255) NOT NULL DEFAULT '',
  `b_link2` varchar(255) NOT NULL DEFAULT '',
  `b_ex1` varchar(255) NOT NULL DEFAULT '',
  `b_ex2` varchar(255) NOT NULL DEFAULT '',
  `b_ex3` varchar(255) NOT NULL DEFAULT '',
  `b_ex4` varchar(255) NOT NULL DEFAULT '',
  `b_ex5` varchar(255) NOT NULL DEFAULT '',
  `b_ex6` varchar(255) NOT NULL DEFAULT '',
  `b_ex7` varchar(255) NOT NULL DEFAULT '',
  `b_ex8` varchar(255) NOT NULL DEFAULT '',
  `b_ex9` varchar(255) NOT NULL DEFAULT '',
  `b_ex10` varchar(255) NOT NULL DEFAULT '',
  `b_best` int(11) NOT NULL DEFAULT '0',
  `b_bestid` text NOT NULL,
  `b_hit` int(11) NOT NULL DEFAULT '0',
  `b_modify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `b_regist` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `b_addip` varchar(20) NOT NULL DEFAULT '',
  `dbname` varchar(50) NOT NULL DEFAULT 'shop_review',
  `site` varchar(100) NOT NULL DEFAULT '',
  UNIQUE KEY `b_no` (`b_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Comm_shop_review`
-- 

CREATE TABLE `Gn_Board_Comm_shop_review` (
  `c_no` int(11) NOT NULL AUTO_INCREMENT,
  `c_bno` int(11) NOT NULL,
  `c_tno` int(11) NOT NULL,
  `c_dep` varchar(20) NOT NULL,
  `c_member` varchar(30) NOT NULL DEFAULT '',
  `c_writer` varchar(100) NOT NULL DEFAULT '',
  `c_passwd` varchar(50) NOT NULL DEFAULT '',
  `c_subject` varchar(255) NOT NULL DEFAULT '',
  `c_content` text NOT NULL,
  `c_ex1` varchar(255) NOT NULL DEFAULT '',
  `c_ex2` varchar(255) NOT NULL DEFAULT '',
  `c_ex3` varchar(255) NOT NULL DEFAULT '',
  `c_ex4` varchar(255) NOT NULL DEFAULT '',
  `c_ex5` varchar(255) NOT NULL DEFAULT '',
  `c_ex6` varchar(255) NOT NULL DEFAULT '',
  `c_ex7` varchar(255) NOT NULL DEFAULT '',
  `c_ex8` varchar(255) NOT NULL DEFAULT '',
  `c_ex9` varchar(255) NOT NULL DEFAULT '',
  `c_ex10` varchar(255) NOT NULL DEFAULT '',
  `c_best` int(11) NOT NULL DEFAULT '0',
  `c_bestid` text NOT NULL,
  `c_modify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `c_regist` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `c_addip` varchar(20) NOT NULL DEFAULT '',
  `dbname` varchar(50) NOT NULL DEFAULT 'shop_review',
  `site` varchar(100) NOT NULL DEFAULT '',
  UNIQUE KEY `c_no` (`c_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Item_shop_qna`
-- 

CREATE TABLE `Gn_Board_Item_shop_qna` (
  `b_no` int(11) NOT NULL AUTO_INCREMENT,
  `b_tno` int(11) NOT NULL,
  `b_dep` varchar(20) NOT NULL DEFAULT '',
  `b_category` varchar(30) NOT NULL DEFAULT '',
  `b_member` varchar(30) NOT NULL DEFAULT '',
  `b_writer` varchar(100) NOT NULL DEFAULT '',
  `b_passwd` varchar(50) NOT NULL DEFAULT '',
  `b_subject` varchar(255) NOT NULL DEFAULT '',
  `b_email` varchar(50) NOT NULL DEFAULT '',
  `b_content` longtext NOT NULL,
  `b_secret` int(1) NOT NULL DEFAULT '0',
  `b_notice` int(1) NOT NULL DEFAULT '0',
  `b_html` int(1) NOT NULL DEFAULT '0',
  `b_link1` varchar(255) NOT NULL DEFAULT '',
  `b_link2` varchar(255) NOT NULL DEFAULT '',
  `b_ex1` varchar(255) NOT NULL DEFAULT '',
  `b_ex2` varchar(255) NOT NULL DEFAULT '',
  `b_ex3` varchar(255) NOT NULL DEFAULT '',
  `b_ex4` varchar(255) NOT NULL DEFAULT '',
  `b_ex5` varchar(255) NOT NULL DEFAULT '',
  `b_ex6` varchar(255) NOT NULL DEFAULT '',
  `b_ex7` varchar(255) NOT NULL DEFAULT '',
  `b_ex8` varchar(255) NOT NULL DEFAULT '',
  `b_ex9` varchar(255) NOT NULL DEFAULT '',
  `b_ex10` varchar(255) NOT NULL DEFAULT '',
  `b_best` int(11) NOT NULL DEFAULT '0',
  `b_bestid` text NOT NULL,
  `b_hit` int(11) NOT NULL DEFAULT '0',
  `b_modify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `b_regist` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `b_addip` varchar(20) NOT NULL DEFAULT '',
  `dbname` varchar(50) NOT NULL DEFAULT 'shop_qna',
  `site` varchar(100) NOT NULL DEFAULT '',
  UNIQUE KEY `b_no` (`b_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Comm_shop_qna`
-- 

CREATE TABLE `Gn_Board_Comm_shop_qna` (
  `c_no` int(11) NOT NULL AUTO_INCREMENT,
  `c_bno` int(11) NOT NULL,
  `c_tno` int(11) NOT NULL,
  `c_dep` varchar(20) NOT NULL,
  `c_member` varchar(30) NOT NULL DEFAULT '',
  `c_writer` varchar(100) NOT NULL DEFAULT '',
  `c_passwd` varchar(50) NOT NULL DEFAULT '',
  `c_subject` varchar(255) NOT NULL DEFAULT '',
  `c_content` text NOT NULL,
  `c_ex1` varchar(255) NOT NULL DEFAULT '',
  `c_ex2` varchar(255) NOT NULL DEFAULT '',
  `c_ex3` varchar(255) NOT NULL DEFAULT '',
  `c_ex4` varchar(255) NOT NULL DEFAULT '',
  `c_ex5` varchar(255) NOT NULL DEFAULT '',
  `c_ex6` varchar(255) NOT NULL DEFAULT '',
  `c_ex7` varchar(255) NOT NULL DEFAULT '',
  `c_ex8` varchar(255) NOT NULL DEFAULT '',
  `c_ex9` varchar(255) NOT NULL DEFAULT '',
  `c_ex10` varchar(255) NOT NULL DEFAULT '',
  `c_best` int(11) NOT NULL DEFAULT '0',
  `c_bestid` text NOT NULL,
  `c_modify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `c_regist` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `c_addip` varchar(20) NOT NULL DEFAULT '',
  `dbname` varchar(50) NOT NULL DEFAULT 'shop_qna',
  `site` varchar(100) NOT NULL DEFAULT '',
  UNIQUE KEY `c_no` (`c_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_File`
-- 

CREATE TABLE `Gn_Board_File` (
  `bf_no` int(11) NOT NULL auto_increment,
  `bf_table` varchar(255) default NULL,
  `bf_tno` int(11) NOT NULL default '0',
  `bf_fno` int(11) NOT NULL default '0',
  `bf_save_name` varchar(255) default NULL,
  `bf_real_name` varchar(255) default NULL,
  `bf_down` int(11) NOT NULL default '0',
  `bf_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `site` varchar(100) NOT NULL default '',
  UNIQUE KEY `bf_no` (`bf_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Board_Group`
-- 

CREATE TABLE `Gn_Board_Group` (
  `gr_id` varchar(11) NOT NULL,
  `gr_name` varchar(255) NOT NULL
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Counter`
-- 

CREATE TABLE `Gn_Counter` (
  `con_id` int(11) NOT NULL auto_increment,
  `con_ip` varchar(30) NOT NULL default '',
  `con_date` date NOT NULL default '0000-00-00',
  `con_time` time NOT NULL default '00:00:00',
  `ref_url` text NOT NULL,
  `ref_site` varchar(255) NOT NULL default '',
  `get_page` varchar(255) NOT NULL default '',
  `get_query` text NOT NULL,
  `get_agent` varchar(255) NOT NULL default '',
  `site` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`con_id`),
  UNIQUE KEY `index1` (`con_ip`,`con_date`),
  KEY `index2` (`con_date`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Counter_Total`
-- 

CREATE TABLE `Gn_Counter_Total` (
  `today_cnt` int(11) NOT NULL,
  `ysday_cnt` int(11) NOT NULL,
  `tomon_cnt` int(11) NOT NULL,
  `ysmon_cnt` int(11) NOT NULL,
  `this_date` date NOT NULL,
  `total_cnt` int(11) NOT NULL
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Member`
-- 

CREATE TABLE `Gn_Member` (
  `mem_code` int(11) NOT NULL auto_increment,
  `mem_leb` int(4) NOT NULL default '0',
  `mem_id` varchar(30) NOT NULL default '',
  `mem_pass` varchar(50) NOT NULL default '',
  `mem_name` varchar(30) NOT NULL default '',
  `mem_nick` varchar(30) NOT NULL default '',
  `mem_sch` varchar(50) NOT NULL default '',
  `mem_post` varchar(7) NOT NULL default '',
  `mem_add1` varchar(255) NOT NULL default '',
  `mem_add2` varchar(30) NOT NULL default '',
  `mem_tel` varchar(15) NOT NULL default '',
  `mem_phone` varchar(15) NOT NULL default '',
  `mem_fax` varchar(15) NOT NULL default '',
  `mem_email` varchar(150) NOT NULL default '',
  `mem_home` varchar(150) NOT NULL default '',
  `mem_birth` date NOT NULL default '0000-00-00',
  `mem_btype` char(1) NOT NULL default '+',
  `mem_sex` char(1) NOT NULL default 'm',
  `mem_remail` char(1) NOT NULL default 'y',
  `mem_sms` char(1) NOT NULL default 'y',
  `mem_content` text NOT NULL,
  `mem_point` int(11) NOT NULL default '0',
  `mem_cash` int(11) NOT NULL default '0',
  `mshop_total` int(11) NOT NULL default '0',
  `mshop_count` int(11) NOT NULL default '0',
  `com_num` varchar(15) NOT NULL default '',
  `com_ceo` varchar(30) NOT NULL default '',
  `com_charge` varchar(30) NOT NULL default '',
  `com_cphone` varchar(15) NOT NULL default '',
  `com_post` varchar(7) NOT NULL default '0',
  `com_add1` varchar(255) NOT NULL default '',
  `com_add2` varchar(30) NOT NULL default '',
  `exe_1` varchar(255) NOT NULL default '',
  `exe_2` varchar(255) NOT NULL default '',
  `exe_3` varchar(255) NOT NULL default '',
  `exe_4` varchar(255) NOT NULL default '',
  `exe_5` varchar(255) NOT NULL default '',
  `mem_check` datetime NOT NULL default '0000-00-00 00:00:00',
  `mem_chu` varchar(30) NOT NULL default '',
  `first_regist` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_modify` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_regist` datetime NOT NULL default '0000-00-00 00:00:00',
  `join_ip` varchar(30) NOT NULL default '',
  `login_ip` varchar(30) NOT NULL default '',
  `visited` int(11) NOT NULL default '0',
  `site` varchar(100) NOT NULL default '',
  `mb_sess_flag` int(11) NOT NULL default '0',
  PRIMARY KEY  (`mem_code`),
  UNIQUE KEY `mem_id` (`mem_id`),
  KEY `first_regist` (`first_regist`),
  KEY `last_regist` (`last_regist`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Member_Level`
-- 

CREATE TABLE `Gn_Member_Level` (
  `leb_id` int(11) NOT NULL auto_increment,
  `leb_level` int(11) NOT NULL default '0',
  `leb_name` varchar(255) NOT NULL default '',
  `leb_dc` int(3) NOT NULL default '0',
  PRIMARY KEY  (`leb_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Member_Memo`
-- 

CREATE TABLE `Gn_Member_Memo` (
  `m_no` int(11) NOT NULL auto_increment,
  `m_recv_id` varchar(50) NOT NULL default '',
  `m_send_id` varchar(50) NOT NULL default '',
  `m_memo` text NOT NULL,
  `m_send_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_read_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_recv_del` int(1) NOT NULL default '0',
  `m_send_del` int(1) NOT NULL default '0',
  `m_addip` varchar(20) NOT NULL default '',
  `site` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`m_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Member_Point`
-- 

CREATE TABLE `Gn_Member_Point` (
  `p_id` int(11) NOT NULL auto_increment,
  `p_member` varchar(20) NOT NULL default '',
  `p_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `p_memo` varchar(255) NOT NULL default '',
  `p_point` int(11) NOT NULL default '0',
  `site` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`p_id`),
  KEY `index1` (`p_member`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Member_Semo`
-- 

CREATE TABLE `Gn_Member_Semo` (
  `m_no` int(11) NOT NULL auto_increment,
  `m_save_id` varchar(50) NOT NULL default '',
  `m_recv_id` varchar(50) NOT NULL default '',
  `m_send_id` varchar(50) NOT NULL default '',
  `m_memo` text NOT NULL,
  `m_send_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_read_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `m_save_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `site` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`m_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Menu`
-- 

CREATE TABLE `Gn_Menu` (
  `mn_no` int(11) NOT NULL AUTO_INCREMENT,
  `mn_banner_use` smallint(6) NOT NULL,
  `mn_banner_memo` varchar(255) NOT NULL,
  `mn_popup_use` smallint(6) NOT NULL,
  `mn_popup_memo` varchar(255) NOT NULL,
  `mn_poll_use` smallint(6) NOT NULL,
  `mn_poll_memo` varchar(255) NOT NULL,
  `mn_shop_use` smallint(6) NOT NULL,
  `mn_shopmodule_use` smallint(6) NOT NULL,
  `mn_shop_memo` varchar(255) NOT NULL,
  `mn_product_use` smallint(6) NOT NULL,
  `mn_product_memo` varchar(255) NOT NULL,
  `mn_shop_review_memo` varchar(255) NOT NULL,
  `mn_shop_review_use` smallint(6) NOT NULL,
  `mn_shop_qna_memo` varchar(255) NOT NULL,
  `mn_shop_qna_use` smallint(6) NOT NULL,
  mn_shop_option_use int(1) NOT NULL,
  mn_shop_option_type varchar(50) NOT NULL,
  mn_shop_related_use int(1) NOT NULL,
  `mn_group_mail_use` smallint(6) NOT NULL,
  `mn_counter_memo` varchar(255) NOT NULL,
  `mn_counter_use` smallint(6) NOT NULL,
  `mn_statistics_memo` varchar(255) NOT NULL,
  `mn_statistics_use` smallint(6) NOT NULL,
  `point_use` smallint(6) NOT NULL,
  `use_type` smallint(6) NOT NULL,
  `trans_pay` smallint(6) NOT NULL,
  `mn_sms_memo` varchar(255) NOT NULL,
  `mn_sms_use` smallint(6) NOT NULL,
  `duplicate_login` smallint(6) NOT NULL,
  PRIMARY KEY (`mn_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Newwin`
-- 

CREATE TABLE `Gn_Newwin` (
  `nw_id` int(11) NOT NULL auto_increment,
  `nw_begin_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `nw_end_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `nw_disable_hours` int(11) NOT NULL default '0',
  `nw_left` int(11) NOT NULL default '0',
  `nw_top` int(11) NOT NULL default '0',
  `nw_height` int(11) NOT NULL default '0',
  `nw_width` int(11) NOT NULL default '0',
  `nw_skin` varchar(150) NOT NULL default '',
  `nw_subject` text NOT NULL,
  `nw_content` text NOT NULL,
  `nw_content_html` tinyint(4) NOT NULL default '0',
  `nw_disable_layer` tinyint(4) NOT NULL,
  PRIMARY KEY  (`nw_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Online`
-- 

CREATE TABLE `Gn_Online` (
  `num` int(11) NOT NULL auto_increment,
  `type` int(5) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `phone` varchar(255) default NULL,
  `mobile` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `email` varchar(150) NOT NULL default '',
  `option1` varchar(255) default NULL,
  `option2` varchar(255) default NULL,
  `option3` varchar(255) default NULL,
  `option4` varchar(255) default NULL,
  `option5` varchar(255) default NULL,
  `content` text NOT NULL,
  `visiteDate` varchar(30) default NULL,
  `regist` varchar(30) default NULL,
  `userfile1` varchar(255) default NULL,
  `userfile2` varchar(255) default NULL,
  `userfile3` varchar(255) default NULL,
  `link1` varchar(150) default NULL,
  `link2` varchar(150) default NULL,
  `memo` text NOT NULL,
  `viewch` char(3) default '0',
  `site` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`num`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Page_Item`
-- 

CREATE TABLE `Gn_Page_Item` (
  `pg_no` int(11) NOT NULL auto_increment,
  `pg_subject` varchar(100) NOT NULL,
  `pg_content` text NOT NULL,
  `pg_wdate` datetime NOT NULL,
  `pg_code` varchar(100) NOT NULL,
  `pg_sort` int(11) NOT NULL,
  `pg_group` int(11) NOT NULL,
  PRIMARY KEY  (`pg_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Product_Category`
-- 

CREATE TABLE `Gn_Product_Category` (
  `ca_id` varchar(11) NOT NULL default '',
  `ca_name` varchar(255) NOT NULL default '',
  `ca_skin` varchar(255) NOT NULL default '',
  `ca_input` varchar(255) NOT NULL default '',
  `ca_use` int(3) NOT NULL default '0'
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Product_Config`
-- 

CREATE TABLE `Gn_Product_Config` (
  `shop_name` varchar(255) NOT NULL default '',
  `shop_skin` varchar(255) NOT NULL default '',
  `shop_inc_head` varchar(255) NOT NULL default '',
  `shop_inc_foot` varchar(255) NOT NULL default '',
  `mimg_width` int(4) NOT NULL default '400',
  `mimg_height` int(4) NOT NULL default '300',
  `simg_width` int(4) NOT NULL default '100',
  `simg_height` int(4) NOT NULL default '75',
  `shop_url` varchar(255) NOT NULL default '',
  `admin_email` varchar(255) NOT NULL default '',
  `use_bank` int(2) NOT NULL default '0',
  `use_real` int(2) NOT NULL default '0',
  `use_card` int(2) NOT NULL default '0',
  `use_phon` int(2) NOT NULL default '0',
  `bankinfo` varchar(255) NOT NULL default '',
  `point_chk` tinyint(1) NOT NULL default '0',
  `point_use` int(3) NOT NULL default '0',
  `use_bill` varchar(30) NOT NULL default '0',
  `use_vat` varchar(30) NOT NULL default '0',
  `cardsys_mid` varchar(50) NOT NULL default '',
  `explan_trans` text NOT NULL,
  `explan_chan` text NOT NULL,
  `explan_other` text NOT NULL,
  `trans_all` int(10) NOT NULL default '0',
  `trans_grub` varchar(255) default 'NULL',
  `trans_gpay` varchar(255) default 'NULL',
  `trans_pay` int(11) NOT NULL default '0',
  `present_pay` varchar(255) default 'NULL',
  `present_item` varchar(255) default 'NULL',
  `main_cont` text NOT NULL,
  `site` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`site`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Product_Item`
-- 

CREATE TABLE `Gn_Product_Item` (
  `it_id` varchar(10) NOT NULL default '',
  `ca_id` varchar(10) NOT NULL default '0',
  `it_name` varchar(255) NOT NULL default '',
  `it_gallery` tinyint(4) NOT NULL default '0',
  `it_brand` varchar(11) NOT NULL default '',
  `it_maker` varchar(255) NOT NULL default '',
  `it_origin` varchar(255) NOT NULL default '',
  `it_link1` varchar(255) NOT NULL default '',
  `it_link2` varchar(255) NOT NULL default '',
  `it_opt1_subject` varchar(255) NOT NULL default '',
  `it_opt2_subject` varchar(255) NOT NULL default '',
  `it_opt3_subject` varchar(255) NOT NULL default '',
  `it_opt4_subject` varchar(255) NOT NULL default '',
  `it_opt5_subject` varchar(255) NOT NULL default '',
  `it_opt6_subject` varchar(255) NOT NULL default '',
  `it_opt1` varchar(255) NOT NULL default '',
  `it_opt2` text NOT NULL,
  `it_opt3` text NOT NULL,
  `it_opt4` text NOT NULL,
  `it_opt5` text NOT NULL,
  `it_opt6` text NOT NULL,
  `it_type1` tinyint(4) NOT NULL default '0',
  `it_type2` tinyint(4) NOT NULL default '0',
  `it_type3` tinyint(4) NOT NULL default '0',
  `it_type4` tinyint(4) NOT NULL default '0',
  `it_type5` tinyint(4) NOT NULL default '0',
  `it_other1` varchar(100) NOT NULL default '0',
  `it_other2` varchar(100) NOT NULL default '0',
  `it_other3` varchar(100) NOT NULL default '0',
  `it_other4` varchar(100) NOT NULL default '0',
  `it_other5` varchar(100) NOT NULL default '0',
  `it_other6` varchar(100) NOT NULL default '0',
  `it_ex1` varchar(255) NOT NULL default '',
  `it_ex2` varchar(255) NOT NULL default '',
  `it_ex3` varchar(255) NOT NULL default '',
  `it_ex4` varchar(255) NOT NULL default '',
  `it_ex5` varchar(255) NOT NULL default '',
  `it_ex6` varchar(255) NOT NULL default '',
  `it_basic` text NOT NULL,
  `it_explan` mediumtext NOT NULL,
  `it_explan_html` tinyint(4) NOT NULL default '0',
  `it_cust_amount` int(11) NOT NULL default '0',
  `it_pay` int(11) NOT NULL default '0',
  `it_epay` int(11) NOT NULL default '0',
  `it_point` int(11) NOT NULL default '0',
  `it_sell_email` varchar(255) NOT NULL default '',
  `it_seller` varchar(255) NOT NULL default '',
  `it_use` tinyint(4) NOT NULL default '0',
  `it_stock` int(11) NOT NULL default '9999',
  `it_head_html` text NOT NULL,
  `it_tail_html` text NOT NULL,
  `it_hit` int(11) NOT NULL default '0',
  `it_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `it_ip` varchar(25) NOT NULL default '',
  `it_order` int(11) NOT NULL default '0',
  `it_tel_inq` tinyint(4) NOT NULL default '0',
  `it_file1` varchar(255) NOT NULL default '',
  `it_file2` varchar(255) NOT NULL default '',
  `it_file3` varchar(255) NOT NULL default '',
  `it_file4` varchar(255) NOT NULL default '',
  `it_file5` varchar(255) NOT NULL default '',
  `it_file6` varchar(255) NOT NULL default '',
  `it_file7` varchar(255) NOT NULL default '',
  `it_file8` varchar(255) NOT NULL default '',
  `it_file9` varchar(255) NOT NULL default '',
  `it_file10` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`it_id`),
  KEY `ca_id` (`ca_id`),
  KEY `it_name` (`it_name`),
  KEY `it_order` (`it_order`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Product_Detail`
-- 

CREATE TABLE `Gn_Product_Detail` (
  `d_no` int(11) unsigned NOT NULL auto_increment,
  `d_it_id` varchar(50) NOT NULL,
  `d_ex1` varchar(255) NOT NULL,
  `d_ex2` varchar(255) NOT NULL,
  `d_ex3` varchar(255) NOT NULL,
  `d_ex4` varchar(255) NOT NULL,
  `d_ex5` varchar(255) NOT NULL,
  `d_ex6` varchar(255) NOT NULL,
  `d_ex7` varchar(255) NOT NULL,
  `d_ex8` varchar(255) NOT NULL,
  `d_ex9` varchar(255) NOT NULL,
  `d_ex10` varchar(255) NOT NULL,
  `d_file_oname` varchar(255) NOT NULL,
  `d_file_rname` varchar(255) NOT NULL,
  `d_use` varchar(10) NOT NULL,
  `d_sort` int(11) NOT NULL,
  `d_regist` datetime NOT NULL,
  PRIMARY KEY  (`d_no`)
) ENGINE=MyISAM;


-- --------------------------------------------------------
-- 
-- 테이블 구조 `Gn_SearchWord`
-- 

CREATE TABLE `Gn_SearchWord` (
  `no` int(11) NOT NULL auto_increment,
  `command` text,
  `wdate` datetime default NULL,
  `num` int(11) default NULL,
  PRIMARY KEY  (`no`)
) ENGINE=MyISAM;


-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Add_option`
-- 
CREATE TABLE `Gn_Shop_Add_option` (
  `itop_no` int(11) NOT NULL auto_increment,
  `itop_it_id` int(11) NOT NULL,
  `itop_type` tinyint(4) NOT NULL,
  `itop_opt1` varchar(255) NOT NULL,
  `itop_opt2` varchar(255) NOT NULL,
  `itop_opt3` varchar(255) NOT NULL,
  `itop_opt4` varchar(255) NOT NULL,
  `itop_opt5` varchar(255) NOT NULL,
  `itop_amount_op` varchar(30) NOT NULL,
  `itop_amount` int(11) NOT NULL,
  `itop_stock` int(11) NOT NULL,
  `itop_flag` char(1) NOT NULL default '',
  PRIMARY KEY  (`itop_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_After`
-- 

CREATE TABLE `Gn_Shop_After` (
  `is_id` int(11) NOT NULL auto_increment,
  `it_id` varchar(10) NOT NULL default '0',
  `mb_id` varchar(20) NOT NULL default '',
  `is_name` varchar(20) NOT NULL default '',
  `is_score` tinyint(4) NOT NULL default '0',
  `is_subject` varchar(255) NOT NULL default '',
  `is_content` text NOT NULL,
  `is_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `is_ip` varchar(25) NOT NULL default '',
  `is_confirm` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`is_id`),
  KEY `index1` (`it_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Brand`
-- 

CREATE TABLE `Gn_Shop_Brand` (
  `br_id` int(11) NOT NULL default '0',
  `br_name` varchar(255) NOT NULL default '',
  `br_url` varchar(255) NOT NULL default '',
  `br_use` int(3) NOT NULL default '0',
  `br_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`br_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Cart`
-- 

CREATE TABLE `Gn_Shop_Cart` (
  `ct_id` int(11) NOT NULL auto_increment,
  `on_uid` varchar(32) NOT NULL default '',
  `ct_od_id` varchar(50) NOT NULL default '',
  `it_id` varchar(10) NOT NULL default '0',
  `ct_option_no` varchar(255) NOT NULL default '',
  `ct_option_qty` varchar(255) NOT NULL default '',
  `it_opt1` varchar(255) NOT NULL default '',
  `it_opt2` varchar(255) NOT NULL default '',
  `it_opt3` varchar(255) NOT NULL default '',
  `it_opt4` varchar(255) NOT NULL default '',
  `it_opt5` varchar(255) NOT NULL default '',
  `it_opt6` varchar(255) NOT NULL default '',
  `ct_status` enum('쇼핑','주문','준비','배송','완료','취소','반품','품절'),
  `ct_history` text NOT NULL,
  `ct_amount` int(11) NOT NULL default '0',
  `ct_paytype` int(11) NOT NULL default '0',
  `ct_present` varchar(255) NOT NULL default '',
  `ct_point` int(11) NOT NULL default '0',
  `ct_point_use` tinyint(4) NOT NULL default '0',
  `ct_stock_use` tinyint(4) NOT NULL default '0',
  `ct_point_use2` tinyint(4) NOT NULL default '0',
  `ct_qty` int(11) NOT NULL default '0',
  `ct_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ct_ip` varchar(25) NOT NULL default '',
  `ap_id` int(11) NOT NULL default '0',
  `bi_id` int(11) NOT NULL default '0',
  `op_name` varchar(200) NOT NULL,
  `ct_review` varchar(50) NOT NULL,
  `pg_no` varchar(50) NOT NULL,
  PRIMARY KEY  (`ct_id`),
  KEY `on_uid` (`on_uid`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Category`
-- 

CREATE TABLE `Gn_Shop_Category` (
  `ca_id` varchar(11) NOT NULL default '',
  `ca_name` varchar(255) NOT NULL default '',
  `ca_skin` varchar(255) NOT NULL default '',
  `ca_input` varchar(255) NOT NULL default '',
  `ca_use` int(3) NOT NULL default '0'
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Config`
-- 

CREATE TABLE `Gn_Shop_Config` (
  `shop_name` varchar(255) NOT NULL default '',
  `shop_skin` varchar(255) NOT NULL default '',
  `shop_inc_head` varchar(255) NOT NULL default '',
  `shop_inc_foot` varchar(255) NOT NULL default '',
  `mimg_width` int(4) NOT NULL default '400',
  `mimg_height` int(4) NOT NULL default '300',
  `simg_width` int(4) NOT NULL default '100',
  `simg_height` int(4) NOT NULL default '75',
  `shop_url` varchar(255) NOT NULL default '',
  `shop_tel` varchar(50) NOT NULL default '',
  `admin_email` varchar(255) NOT NULL default '',
  `use_bank` int(2) NOT NULL default '0',
  `use_card` int(2) NOT NULL default '0',
  `use_trans` int(2) NOT NULL default '0',
  `use_virtual` int(2) NOT NULL default '0',
  `use_phon` int(2) NOT NULL default '0',
  `bankinfo` varchar(255) NOT NULL default '',
  `point_chk` tinyint(1) NOT NULL default '0',
  `point_use` int(3) NOT NULL default '0',
  `point_min_use` int(11) NOT NULL default '0',
  `point_max_use` int(11) NOT NULL default '0',
  `use_bill` varchar(30) NOT NULL default '0',
  `use_vat` varchar(30) NOT NULL default '0',
  `cardsys_mid` varchar(50) NOT NULL default '',
  `use_type1` tinyint(4) NOT NULL default '0',
  `use_type2` tinyint(4) NOT NULL default '0',
  `use_type3` tinyint(4) NOT NULL default '0',
  `use_type4` tinyint(4) NOT NULL default '0',
  `use_type5` tinyint(4) NOT NULL default '0',
  `sms_text1` text NOT NULL,
  `sms_text2` text NOT NULL,
  `sms_text3` text NOT NULL,
  `sms_text4` text NOT NULL,
  `sms_text5` text NOT NULL,
  `sms_text6` text NOT NULL,
  `sms_text7` text NOT NULL,
  `explan_trans` text NOT NULL,
  `explan_chan` text NOT NULL,
  `explan_other` text NOT NULL,
  `trans_all` int(10) NOT NULL default '0',
  `trans_grub` varchar(255) default 'NULL',
  `trans_gpay` varchar(255) default 'NULL',
  `trans_pay` int(11) NOT NULL default '0',
  `present_pay` varchar(255) default 'NULL',
  `present_item` varchar(255) default 'NULL',
  `main_cont` text NOT NULL,
  `pg_status` varchar(50) default 'NULL',
  `pg_module` varchar(50) default 'NULL',
  `LG_pg_id` varchar(50) default 'NULL',
  `LG_pg_key` varchar(255) default 'NULL',
  `LG_pg_casurl` varchar(255) default 'NULL',
  `INI_pg_id` varchar(50) default 'NULL',
  `KCP_pg_id` varchar(50) default 'NULL',
  `site` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`site`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Coupon`
-- 

CREATE TABLE `Gn_Shop_Coupon` (
  `cp_no` int(11) NOT NULL auto_increment,
  `cp_content` text NOT NULL,
  PRIMARY KEY  (`cp_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Delivery`
-- 

CREATE TABLE `Gn_Shop_Delivery` (
  `dl_id` int(11) NOT NULL auto_increment,
  `dl_company` varchar(255) NOT NULL default '',
  `de_code` varchar(50) NOT NULL default '',
  `dl_url` varchar(255) NOT NULL default '',
  `dl_tel` varchar(255) NOT NULL default '',
  `dl_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`dl_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_History`
-- 

CREATE TABLE `Gn_Shop_History` (
  `cd_id` int(11) NOT NULL auto_increment,
  `od_id` varchar(10) NOT NULL default '',
  `on_uid` varchar(32) NOT NULL default '',
  `cd_mall_id` varchar(20) NOT NULL default '',
  `cd_amount` int(11) NOT NULL default '0',
  `cd_app_no` varchar(20) NOT NULL default '',
  `cd_app_rt` varchar(8) NOT NULL default '',
  `cd_trade_ymd` date NOT NULL default '0000-00-00',
  `cd_trade_hms` time NOT NULL default '00:00:00',
  `cd_quota` char(2) NOT NULL default '',
  `cd_opt01` varchar(255) NOT NULL default '',
  `cd_opt02` varchar(255) NOT NULL default '',
  `cd_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `cd_ip` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`cd_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Input`
-- 

CREATE TABLE `Gn_Shop_Input` (
  `u_id` int(11) NOT NULL auto_increment,
  `u_cid` varchar(32) NOT NULL default '',
  `u_uid` varchar(32) NOT NULL default '',
  `u_subject` text NOT NULL,
  `u_opt0` text NOT NULL,
  `u_opt1` text NOT NULL,
  `u_opt2` text NOT NULL,
  `u_opt3` text NOT NULL,
  `u_opt4` text NOT NULL,
  `u_opt5` text NOT NULL,
  `u_opt6` text NOT NULL,
  `u_opt7` text NOT NULL,
  `u_opt8` text NOT NULL,
  `u_opt9` text NOT NULL,
  `u_opt10` text NOT NULL,
  `u_opt11` text NOT NULL,
  `u_opt12` text NOT NULL,
  `u_opt13` text NOT NULL,
  `u_opt14` text NOT NULL,
  `u_opt15` text NOT NULL,
  PRIMARY KEY  (`u_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Inquire`
-- 

CREATE TABLE `Gn_Shop_Inquire` (
  `iq_id` int(11) NOT NULL auto_increment,
  `it_id` varchar(10) NOT NULL default '',
  `mb_id` varchar(20) NOT NULL default '',
  `iq_subject` varchar(255) NOT NULL default '',
  `iq_question` text NOT NULL,
  `iq_answer` text NOT NULL,
  `iq_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `iq_ip` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`iq_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Item`
-- 

CREATE TABLE `Gn_Shop_Item` (
  `it_id` varchar(10) NOT NULL default '',
  `ca_id` varchar(10) NOT NULL default '0',
  `it_name` varchar(255) NOT NULL default '',
  `it_gallery` tinyint(4) NOT NULL default '0',
  `it_brand` varchar(11) NOT NULL default '',
  `it_maker` varchar(255) NOT NULL default '',
  `it_origin` varchar(255) NOT NULL default '',
  `it_link1` varchar(255) NOT NULL default '',
  `it_link2` varchar(255) NOT NULL default '',
  `it_opt1_subject` varchar(255) NOT NULL default '',
  `it_opt2_subject` varchar(255) NOT NULL default '',
  `it_opt3_subject` varchar(255) NOT NULL default '',
  `it_opt4_subject` varchar(255) NOT NULL default '',
  `it_opt5_subject` varchar(255) NOT NULL default '',
  `it_opt6_subject` varchar(255) NOT NULL default '',
  `it_opt1` varchar(255) NOT NULL default '',
  `it_opt2` text NOT NULL,
  `it_opt3` text NOT NULL,
  `it_opt4` text NOT NULL,
  `it_opt5` text NOT NULL,
  `it_opt6` text NOT NULL,
  `it_opt_use` tinyint(4) NOT NULL default '0',
  `it_opt_use2` tinyint(4) NOT NULL default '0',
  `it_type1` tinyint(4) NOT NULL default '0',
  `it_type2` tinyint(4) NOT NULL default '0',
  `it_type3` tinyint(4) NOT NULL default '0',
  `it_type4` tinyint(4) NOT NULL default '0',
  `it_type5` tinyint(4) NOT NULL default '0',
  `it_ex1` varchar(255) NOT NULL default '',
  `it_ex2` varchar(255) NOT NULL default '',
  `it_ex3` varchar(255) NOT NULL default '',
  `it_ex4` varchar(255) NOT NULL default '',
  `it_ex5` varchar(255) NOT NULL default '',
  `it_ex6` varchar(255) NOT NULL default '',
  `it_other` varchar(255) NOT NULL default '',
  `it_basic` text NOT NULL,
  `it_explan` mediumtext NOT NULL,
  `it_explan2` mediumtext NOT NULL,
  `it_explan3` mediumtext NOT NULL,
  `it_explan_html` tinyint(4) NOT NULL default '0',
  `it_cust_amount` int(11) NOT NULL default '0',
  `it_pay` int(11) NOT NULL default '0',
  `it_epay` int(11) NOT NULL default '0',
  `it_point` int(11) NOT NULL default '0',
  `it_sell_email` varchar(255) NOT NULL default '',
  `it_seller` varchar(255) NOT NULL default '',
  `it_use` tinyint(4) NOT NULL default '0',
  `it_stock` int(11) NOT NULL default '9999',
  `it_head_html` text NOT NULL,
  `it_tail_html` text NOT NULL,
  `it_hit` int(11) NOT NULL default '0',
  `it_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `it_ip` varchar(25) NOT NULL default '',
  `it_order` int(11) NOT NULL default '0',
  `it_tel_inq` tinyint(4) NOT NULL default '0',
  `it_file1` varchar(255) NOT NULL default '',
  `it_file2` varchar(255) NOT NULL default '',
  `it_file3` varchar(255) NOT NULL default '',
  `it_file4` varchar(255) NOT NULL default '',
  `it_file5` varchar(255) NOT NULL default '',
  `it_file6` varchar(255) NOT NULL default '',
  `it_file7` varchar(255) NOT NULL default '',
  `it_file8` varchar(255) NOT NULL default '',
  `it_file9` varchar(255) NOT NULL default '',
  `it_file10` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`it_id`),
  KEY `ca_id` (`ca_id`),
  KEY `it_name` (`it_name`),
  KEY `it_order` (`it_order`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Order`
-- 

CREATE TABLE `Gn_Shop_Order` (
  `od_id` varchar(10) NOT NULL default '',
  `on_uid` varchar(32) NOT NULL default '',
  `od_mid` varchar(50) NOT NULL default '',
  `mb_id` varchar(20) NOT NULL default '',
  `od_mb_leb` int(11) NOT NULL default '0',
  `od_pwd` varchar(50) NOT NULL default '',
  `od_name` varchar(20) NOT NULL default '',
  `od_email` varchar(100) NOT NULL default '',
  `od_tel` varchar(20) NOT NULL default '',
  `od_hp` varchar(20) NOT NULL default '',
  `od_zip` char(5) NOT NULL default '',
  `od_zip1` char(3) NOT NULL default '',
  `od_zip2` char(3) NOT NULL default '',
  `od_addr1` varchar(100) NOT NULL default '',
  `od_addr2` varchar(100) NOT NULL default '',
  `od_deposit_name` varchar(20) NOT NULL default '',
  `od_b_name` varchar(20) NOT NULL default '',
  `od_b_tel` varchar(20) NOT NULL default '',
  `od_b_hp` varchar(20) NOT NULL default '',
  `od_b_zip` char(5) NOT NULL default '',
  `od_b_zip1` char(3) NOT NULL default '',
  `od_b_zip2` char(3) NOT NULL default '',
  `od_b_addr1` varchar(100) NOT NULL default '',
  `od_b_addr2` varchar(100) NOT NULL default '',
  `od_memo` text NOT NULL,
  `od_send_cost` int(11) NOT NULL default '0',
  `od_temp_bank` int(11) NOT NULL default '0',
  `od_temp_card` int(11) NOT NULL default '0',
  `od_receipt_bank` int(11) NOT NULL default '0',
  `od_receipt_card` int(11) NOT NULL default '0',
  `od_receipt_point` int(11) NOT NULL default '0',
  `od_bank_account` varchar(255) NOT NULL default '',
  `od_bank_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `od_card_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `od_cancel_card` int(11) NOT NULL default '0',
  `od_cancel_flag` tinyint(4) NOT NULL default '0',
  `od_dc_amount` int(11) NOT NULL default '0',
  `od_refund_amount` int(11) NOT NULL default '0',
  `od_shop_memo` text NOT NULL,
  `dl_id` int(11) NOT NULL default '0',
  `od_invoice` varchar(255) NOT NULL default '',
  `od_invoice_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `od_present` varchar(255) NOT NULL default '',
  `od_hope_date` date NOT NULL default '0000-00-00',
  `od_bill` int(1) NOT NULL default '0',
  `od_billcode` varchar(50) NOT NULL default '0',
  `od_billinfo` text NOT NULL,
  `od_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `od_ip` varchar(25) NOT NULL default '',
  `od_settle_case` varchar(100) NOT NULL default '',
  `LGD_ESCROWYN` varchar(10) NOT NULL default '',
  `LG_escrow` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`od_id`),
  KEY `index1` (`on_uid`),
  KEY `index2` (`mb_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Point`
-- 

CREATE TABLE `Gn_Shop_Point` (
  `po_id` int(11) NOT NULL auto_increment,
  `mb_id` varchar(20) NOT NULL default '',
  `po_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL default '',
  `po_point` int(11) NOT NULL default '0',
  PRIMARY KEY  (`po_id`),
  KEY `index1` (`mb_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Present`
-- 

CREATE TABLE `Gn_Shop_Present` (
  `pr_id` int(11) NOT NULL auto_increment,
  `pr_type` int(3) NOT NULL default '0',
  `item_num` varchar(11) NOT NULL default '0',
  `odto_pay` int(11) NOT NULL default '0',
  `pritem_num` varchar(11) NOT NULL default '0',
  `pr_num` int(11) NOT NULL default '0',
  `pr_state` int(2) NOT NULL default '0',
  PRIMARY KEY  (`pr_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Receipt`
-- 

CREATE TABLE `Gn_Shop_Receipt` (
  `cash_id` int(11) NOT NULL auto_increment,
  `od_id` varchar(10) NOT NULL default '',
  `on_uid` varchar(32) NOT NULL default '',
  `cash_itname` varchar(255) NOT NULL default '',
  `cash_itset` varchar(50) NOT NULL default '',
  `cash_mid` varchar(50) NOT NULL default '',
  `cash_mame` varchar(50) NOT NULL default '',
  `cash_type` varchar(20) NOT NULL default '0',
  `cash_confirm` int(20) NOT NULL default '0',
  `cash_item` int(11) NOT NULL default '0',
  `cash_vp` int(11) NOT NULL default '0',
  `cash_all` int(11) NOT NULL default '0',
  `cash_succ` char(3) NOT NULL default '0',
  `cash_succno` varchar(9) NOT NULL default '0',
  `cash_msg` varchar(40) NOT NULL default '0',
  `cash_state` varchar(50) NOT NULL default '',
  `cash_time` int(50) NOT NULL default '0',
  `cash_ctime` int(50) NOT NULL default '0',
  `cash_cenadmno` varchar(9) NOT NULL default '0',
  `cash_resmsg` varchar(40) NOT NULL default '0',
  `cash_ip` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`cash_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Sell`
-- 

CREATE TABLE `Gn_Shop_Sell` (
  `se_no` int(11) NOT NULL auto_increment,
  `se_it_id` int(11) NOT NULL default '0',
  `se_total_amount` int(11) NOT NULL default '0',
  `se_total_num` int(11) NOT NULL default '0',
  `se_wdate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`se_no`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Shop_Wish`
-- 

CREATE TABLE `Gn_Shop_Wish` (
  `wi_id` int(11) NOT NULL auto_increment,
  `mb_id` varchar(20) NOT NULL default '',
  `it_id` varchar(10) NOT NULL default '0',
  `it_opt_use` tinyint(4) NOT NULL,
  `it_opt_use2` tinyint(4) NOT NULL,
  `it_opt1` varchar(255) NOT NULL,
  `ct_amount` int(11) NOT NULL,
  `ct_qty` int(11) NOT NULL,
  `wi_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `wi_ip` varchar(25) NOT NULL default '',
  `wi_packing_pay` int(11) NOT NULL,
  PRIMARY KEY  (`wi_id`),
  KEY `index1` (`mb_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_SiteConfig`
-- 

CREATE TABLE `Gn_SiteConfig` (
  `title` varchar(255) NOT NULL default '',
  `site_name` varchar(255) NOT NULL default '',
  `site_url` varchar(255) NOT NULL default '',
  `ssl_flag` varchar(2) NOT NULL default '',
  `ssl_port` varchar(20) NOT NULL default '',
  `keyword` varchar(255) NOT NULL default '',
  `admin_email` varchar(255) NOT NULL default '',
  `mail_check` int(1) NOT NULL default '0',
  `email_flag` varchar(10) NOT NULL default '',
  `member_skin` varchar(50) NOT NULL default '',
  `member_stipulation` text NOT NULL,
  `member_privacy` text NOT NULL,
  `use_point` tinyint(4) NOT NULL default '0',
  `use_memo` tinyint(4) NOT NULL default '0',
  `join_point` int(11) NOT NULL default '0',
  `login_point` int(11) NOT NULL default '0',
  `memo_del` int(11) NOT NULL default '0',
  `visit_time` int(4) NOT NULL default '0',
  `page_rows` int(11) NOT NULL default '0',
  `page_list` int(11) NOT NULL default '0',
  `bank_info` text NOT NULL,
  `use_bank` tinyint(4) NOT NULL default '0',
  `use_iche` tinyint(4) NOT NULL default '0',
  `use_phone` tinyint(4) NOT NULL default '0',
  `use_ars` tinyint(4) NOT NULL default '0',
  `use_card` tinyint(4) NOT NULL default '0',
  `use_phbil` tinyint(4) NOT NULL default '0',
  `use_ebank` tinyint(4) NOT NULL default '0',
  `use_paper` tinyint(4) NOT NULL default '0',
  `cardsys_mid` varchar(50) NOT NULL default '',
  `cardsys_code` varchar(50) NOT NULL default '',
  `namesys_code` varchar(50) NOT NULL default '',
  `mex1_title` varchar(255) NOT NULL default '',
  `mex2_title` varchar(255) NOT NULL default '',
  `mex3_title` varchar(255) NOT NULL default '',
  `mex4_title` varchar(255) NOT NULL default '',
  `mex5_title` varchar(255) NOT NULL default '',
  `ex1_sub` varchar(255) NOT NULL default '',
  `ex2_sub` varchar(255) NOT NULL default '',
  `ex3_sub` varchar(255) NOT NULL default '',
  `ex4_sub` varchar(255) NOT NULL default '',
  `ex5_sub` varchar(255) NOT NULL default '',
  `ex6_sub` varchar(255) NOT NULL default '',
  `ex7_sub` varchar(255) NOT NULL default '',
  `ex8_sub` varchar(255) NOT NULL default '',
  `ex9_sub` varchar(255) NOT NULL default '',
  `ex10_sub` varchar(255) NOT NULL default '',
  `ex1` varchar(255) NOT NULL default '',
  `ex2` varchar(255) NOT NULL default '',
  `ex3` varchar(255) NOT NULL default '',
  `ex4` varchar(255) NOT NULL default '',
  `ex5` varchar(255) NOT NULL default '',
  `ex6` varchar(255) NOT NULL default '',
  `ex7` varchar(255) NOT NULL default '',
  `ex8` varchar(255) NOT NULL default '',
  `ex9` varchar(255) NOT NULL default '',
  `ex10` varchar(255) NOT NULL default '',
  `version` varchar(30) NOT NULL default '',
  `vuptime` varchar(50) NOT NULL default '',
  `site` varchar(100) NOT NULL default '',
  `cafe24_user_id` varchar( 255 ) NOT NULL COMMENT 'SMS 아이디.',
  `cafe24_secure` varchar( 255 ) NOT NULL COMMENT '인증키',
  `cafe24_sphone` varchar( 255 ) NOT NULL ,
  `cafe24_rphone` varchar( 255 ) NOT NULL ,
  `cafe24_testflag` varchar( 1 ) NOT NULL COMMENT '테스트 요청'
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Sms_write`
-- 

CREATE TABLE `Gn_Sms_write` (
  `sw_no` int(11) NOT NULL auto_increment,
  `sw_title` varchar(255) NOT NULL,
  `sw_content` text NOT NULL,
  `sw_use` tinyint(4) NOT NULL,
  PRIMARY KEY  (`sw_no`)
) ENGINE=MyISAM AUTO_INCREMENT=15 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Mailing`
-- 

CREATE TABLE `Gn_Mailing` (
  `idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mail_num` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text,
  `mailheaders` text,
  `send_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`idx`),
  KEY `idx` (`idx`),
  KEY `mail_num` (`mail_num`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 테이블 구조 `Gn_Mailing_List`
-- 

CREATE TABLE `Gn_Mailing_List` (
  `idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `send_date` int(8) DEFAULT NULL,
  `mail_num` varchar(100) DEFAULT NULL,
  `result` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idx`),
  KEY `user_name` (`user_name`),
  KEY `mail_num` (`mail_num`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 테이블 구조 `Gn_Rolling_Banner`
-- 

CREATE TABLE `Gn_Rolling_Banner` (
  `bn_no` int(11) NOT NULL auto_increment COMMENT '고유번호',
  `bn_subject` text NOT NULL COMMENT '제목',
  `type` varchar(50) NOT NULL COMMENT '타입',
  `bn_category` varchar(100) NOT NULL COMMENT '카테고리',
  `bn_content` text NOT NULL COMMENT '내용',
  `bn_dir` varchar(255) NOT NULL COMMENT '업로드디렉토리',
  `bn_oname` varchar(255) NOT NULL COMMENT '원본파일명',
  `bn_rname` varchar(255) NOT NULL COMMENT '수정파일명',
  `bn_link` varchar(255) NOT NULL COMMENT '링크URL',
  `bn_link_target` varchar(50) NOT NULL COMMENT '<a>링크 타겟',
  `bn_ex1` varchar(50) NOT NULL COMMENT '확장필드',
  `bn_ex2` varchar(50) NOT NULL COMMENT '확장필드',
  `bn_ex3` varchar(50) NOT NULL COMMENT '확장필드',
  `bn_ex4` varchar(50) NOT NULL COMMENT '확장필드',
  `bn_ex5` varchar(50) NOT NULL COMMENT '확장필드',
  `bn_sort` int(11) NOT NULL COMMENT '순서',
  PRIMARY KEY  (`bn_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 테이블 구조 `Gn_Poll`
-- 

CREATE TABLE `Gn_Poll` (
  `poll_num` int(15) NOT NULL auto_increment,
  `poll_subject` varchar(255) NOT NULL,
  `poll_content` text NOT NULL,
  `poll_question` int(11) NOT NULL,
  `poll_sdate` varchar(30) NOT NULL default '',
  `poll_edate` varchar(30) NOT NULL default '',
  `poll_state` varchar(10) NOT NULL,
  `poll_modify` datetime NOT NULL default '0000-00-00 00:00:00',
  `poll_regist` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`poll_num`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 테이블 구조 `Gn_Poll_Question`
-- 

CREATE TABLE `Gn_Poll_Question` (
  `poll_num` int(15) NOT NULL auto_increment,
  `poll_parent` int(11) NOT NULL,
  `poll_question` text NOT NULL,
  `poll_answer` varchar(255) NOT NULL,
  `poll_use` int(5) NOT NULL,
  `poll_sort` int(11) NOT NULL,
  `poll_regist` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`poll_num`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 테이블 구조 `Gn_Poll_Score`
-- 

CREATE TABLE `Gn_Poll_Score` (
  `poll_num` int(11) NOT NULL auto_increment,
  `poll_parent` int(11) NOT NULL default '0',
  `poll_user_id` varchar(255) NOT NULL,
  `poll_score` varchar(255) NOT NULL COMMENT '|*1*|는 문항에 대한 구분자 이며 | 는 문항에 대한 idx 와 답항에 대한 구분자',
  `poll_username` varchar(255) NOT NULL,
  `poll_phone` varchar(255) NOT NULL,
  `poll_mobile` varchar(255) NOT NULL,
  `poll_email` varchar(255) NOT NULL,
  `poll_ex1` varchar(255) NOT NULL,
  `poll_ex2` varchar(255) NOT NULL,
  `poll_ex3` varchar(255) NOT NULL,
  `poll_ex4` varchar(255) NOT NULL,
  `poll_ex5` varchar(255) NOT NULL,
  `memo` text NOT NULL,
  `poll_modify` datetime NOT NULL default '0000-00-00 00:00:00',
  `poll_regist` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`poll_num`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

