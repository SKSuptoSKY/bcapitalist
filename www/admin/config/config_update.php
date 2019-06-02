<?
	include "../head.php";

$PG_table = $GnTable["bbsconfig"];
$JO_table = "";

$copymove = "";
for($i=0;$i<count($bbscm);$i++){
	if($i==0) $copymove.= $bbscm[$i];
	else $copymove.= "=".$bbscm[$i];
}

/////// DB에 들어갈 값들을 정리합니다.
$input_value = "
	dbname				=  '$dbname',
	boardgroup		=  '$boardgroup',
	title				=  '$title',
	skin				=  '$skin',
	width				=  '$width',
	page_rows			=  '$page_rows',
	page_block			=  '$page_block',
	listcount			=  '$listcount',
	listsubject			=  '$listsubject',
	imgsize				=  '$imgsize',
	sum_width			=  '$sum_width',
	sum_height		=  '$sum_height',
	sum_resize		=  '$sum_resize',
	sum_flag		=  '$sum_flag',
	fileupnum			=  '$fileupnum',
	fileupsize			=  '$fileupsize',
	page_loc			=  '{$_POST[page_loc]}',
	head				=  '$head',
	headtag				=  '$headtag',
	foot				=  '$foot',
	foottag				=  '$foottag',
	category			=  '$category',
	copymove			=  '$copymove',
	use_view			=  '$use_view',	
	use_spam			=  '$use_spam',
	use_comment			=  '$use_comment',
	use_category		=  '$use_category',
	use_category_top		=  '$use_category_top',
	use_secret			=  '$use_secret',
	use_asecret			=  '$use_asecret',
	use_html			=  '$use_html',
	use_notice			=  '$use_notice',
	use_data			=  '$use_data',
	use_reply			=  '$use_reply',
	use_best			=  '$use_best',
	use_combest			=  '$use_combest',
	use_kakotalk			=  '$use_kakotalk',
	use_kakostory			=  '$use_kakostory',
	use_facebook			=  '$use_facebook',
	use_twitter			=  '$use_twitter',
	view_list			=  '$view_list',
	view_sort			=  '$view_sort',
	level_list			=  '$level_list',
	level_write			=  '$level_write',
	level_reple			=  '$level_reple',
	level_view			=  '$level_view',
	level_com			=  '$level_com',
	level_html			=  '$level_html',
	level_notice		=  '$level_notice',
	point_write			=  '$point_write',
	point_replay		=  '$point_replay',
	point_comment		=  '$point_comment',
	point_chu			=  '$point_chu',
	view				=  '$view'
";

if($mode=="E") {
referer_check();
	$sql = " update $PG_table set $input_value where code = '$id' ";
	sql_query($sql);
} 

if($mode=="D") {
	$sql = " delete from $PG_table where dbname = '$code' ";
	sql_query($sql);
	// 게시판 테이블을 삭제합니다.
	$sql = " DROP TABLE IF EXISTS {$GnTable[bbsitem]}$code ";
	sql_query($sql);
	// 게시판 댓글 테이블을 삭제합니다.
	$sql = " DROP TABLE IF EXISTS {$GnTable[bbscomm]}$code ";
	sql_query($sql,false);
	
	// 기존 폴더와 파일들을 삭제 하지 않아 FTP에 그대로 남아있는 문제
	// 디렉토리 및 하위 모든 파일 일괄삭제 추가 : 20141103 mj
	$dir = $_SERVER['DOCUMENT_ROOT']."/bbs/data/".$code;
	directoryDelete($dir);

	//에디터 이미지 삭제 
}

if($mode=="C") {
	$check = sql_fetch("select * from $PG_table where dbname = '$code' ");
	@exec("rm -rf ".$_SERVER['DOCUMENT_ROOT']."/bbs/data/".$code);
	@mkdir($_SERVER['DOCUMENT_ROOT']."/bbs/data/".$code, 0707);
	@chmod($_SERVER['DOCUMENT_ROOT']."/bbs/data/".$code, 0707);
	// 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
	$file = $_SERVER['DOCUMENT_ROOT']."/bbs/data/".$code. "/index.php";
	$f = @fopen($file, "w");
	@fwrite($f, "");
	@fclose($f);
	@chmod($file, 0707);
	
	sql_query("delete from {$GnTable[bbsfile]} where bf_table='".$code."' ");
 	sql_query("TRUNCATE TABLE {$GnTable[bbsitem]}$code ");
	sql_query("TRUNCATE TABLE {$GnTable[bbscomm]}$code ");
}

if($mode=="W") {
referer_check();

	/// 게시판 테이블을 이름을 생성합니다.
	$TableName = $GnTable["bbsitem"].$dbname;
	$CommName = $GnTable["bbscomm"].$dbname;

	/// 게시판 테이블 중복 체크
	$TableCheck = sql_db_check($TableName);

	if($TableCheck==TRUE) {
		alert("이미 같은 게시판이 존재합니다.");
	} else {	
		/// 게시판 테이블을 등록합니다.
		$sql = " insert $PG_table set $input_value , regist = '$istime' ,	site = '{$default[site_code]}'";
		sql_query($sql);

		/// 자료 폴더를 생성합니다.
			$data_dir = $G_board["data_dir"]."/$dbname";

			// 게시판 디렉토리 생성
			mkdir($data_dir, 0707);
			chmod($data_dir, 0707);

			// 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
			$file = $data_dir . "/index.php";
			$f = @fopen($file, "w");
			@fwrite($f, "");
			@fclose($f);
			@chmod($file, 0707);

		$sql_item = "
				CREATE TABLE $TableName (
				  b_no int NOT NULL auto_increment,
				  b_tno int NOT NULL ,
				  b_dep varchar(20) NOT NULL default '',
				  b_category varchar(30) NOT NULL default '',
				  b_member varchar(30) NOT NULL default '',
				  b_writer varchar(100) NOT NULL default '',
				  b_passwd varchar(50) NOT NULL default '',
				  b_subject varchar(255) NOT NULL default '',
				  b_email varchar(50) NOT NULL default '',
				  b_content longtext NOT NULL,
				  b_secret int(1) NOT NULL default '0',
				  b_notice int(1) NOT NULL default '0',
				  b_html int(1) NOT NULL default '0',
				  b_link1 varchar(255) NOT NULL default '',
				  b_link2 varchar(255) NOT NULL default '',
				  b_ex1 varchar(255) NOT NULL default '',
				  b_ex2 varchar(255) NOT NULL default '',
				  b_ex3 varchar(255) NOT NULL default '',
				  b_ex4 varchar(255) NOT NULL default '',
				  b_ex5 varchar(255) NOT NULL default '',
				  b_ex6 varchar(255) NOT NULL default '',
				  b_ex7 varchar(255) NOT NULL default '',
				  b_ex8 varchar(255) NOT NULL default '',
				  b_ex9 varchar(255) NOT NULL default '',
				  b_ex10 varchar(255) NOT NULL default '',
				  b_best int NOT NULL default '0',
				  b_bestid text NOT NULL,
				  b_hit int NOT NULL default '0',
				  b_modify datetime NOT NULL default '0000-00-00 00:00:00',
				  b_regist datetime NOT NULL default '0000-00-00 00:00:00',
				  b_addip varchar(20) NOT NULL default '',  				 
				  dbname varchar(50) NOT NULL default '$dbname',
				  site varchar(100) NOT NULL default '',
				  UNIQUE KEY b_no (b_no)
				) TYPE=MyISAM AUTO_INCREMENT=1
				";
		$sql_comm = "
				CREATE TABLE $CommName (
				  c_no int NOT NULL auto_increment,
				  c_bno int NOT NULL ,
				  c_tno int(11) NOT NULL,
				  c_dep varchar(20) NOT NULL,
				  c_member varchar(30) NOT NULL default '',
				  c_writer varchar(100) NOT NULL default '',
				  c_passwd varchar(50) NOT NULL default '',
				  c_subject varchar(255) NOT NULL default '',
				  c_content text NOT NULL,
				  c_ex1 varchar(255) NOT NULL default '',
				  c_ex2 varchar(255) NOT NULL default '',
				  c_ex3 varchar(255) NOT NULL default '',
				  c_ex4 varchar(255) NOT NULL default '',
				  c_ex5 varchar(255) NOT NULL default '',
				  c_ex6 varchar(255) NOT NULL default '',
				  c_ex7 varchar(255) NOT NULL default '',
				  c_ex8 varchar(255) NOT NULL default '',
				  c_ex9 varchar(255) NOT NULL default '',
				  c_ex10 varchar(255) NOT NULL default '',
				  c_best int NOT NULL default '0',
				  c_bestid text NOT NULL,
				  c_modify datetime NOT NULL default '0000-00-00 00:00:00',
				  c_regist datetime NOT NULL default '0000-00-00 00:00:00',
				  c_addip varchar(20) NOT NULL default '',
				  dbname varchar(50) NOT NULL default '$dbname',
				  site varchar(100) NOT NULL default '',
				  UNIQUE KEY c_no (c_no)
				) TYPE=MyISAM AUTO_INCREMENT=1
				";
		sql_query($sql_item);
		sql_query($sql_comm);
	}
}

    goto_url("./config_list.php?page=$page&$qstr");
?>