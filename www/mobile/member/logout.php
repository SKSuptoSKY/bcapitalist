<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 
	sql_query("update {$GnTable[member]} set mb_sess_flag='' where mem_id='".$_SESSION[userid]."'");
	sess_kill();
	
	if(!$_SERVER['HTTP_REFERER']) $_SERVER['HTTP_REFERER'] = "/mobile";
	$URL = ($URL)?$URL:$_SERVER['HTTP_REFERER'];
	alert("로그아웃 되었습니다.", $URL);
?>