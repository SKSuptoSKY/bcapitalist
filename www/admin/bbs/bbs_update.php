<?
	$page_loc = "site";
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
	title				=  '$title',
	skin				=  '$skin',
	width				=  '$width',
	page_rows			=  '$page_rows',
	page_block			=  '$page_block',
	listcount			=  '$listcount',
	listsubject			=  '$listsubject',
	imgsize				=  '$imgsize',
	fileupnum			=  '$fileupnum',
	page_loc			=  '{$_POST[page_loc]}',
	head				=  '$head',
	headtag				=  '$headtag',
	foot				=  '$foot',
	foottag				=  '$foottag',
	copymove			=  '$copymove',
	use_view			=  '$use_view',
	use_spam			=  '$use_spam',
	use_comment			=  '$use_comment',
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
	view				=  '$view'
";

if($mode=="E") {
referer_check();
	$sql = " update $PG_table set $input_value where code = '$id' ";
	sql_query($sql);
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

	// 게시판 삭제시 해당 게시판 디렉토리 모두 삭제 mj
	directoryDelete($code);
}

    goto_url("./bbs_list.php?page=$page&$qstr");
?>