<?
include "../head.php";


$PG_table = $GnTable["pageitem"];


$sql_values="
	pg_code='{$pg_code}',
	pg_group='{$pg_group}',
	pg_subject='{$pg_subject}',
	pg_content='{$pg_content}'
";

/*
if ($bn_img_del) @unlink($_SERVER[DOCUMENT_ROOT]."/banner/item/{$bn_no}.jpg");
if ($_FILES[bn_img][name]) { 
	upload_file($_FILES[bn_img][tmp_name], $bn_no.".jpg",$_SERVER[DOCUMENT_ROOT]."/banner/item/"); 
}
*/

if ($mode=="W") {
	if ($pg_code) {
		$sql="select count(*) as cnt from {$PG_table} where pg_code='{$pg_code}'";
		$row_cnt=sql_fetch($sql);
		if ($row_cnt[cnt]) alert ("이미 등록된 코드입니다.","javascript:history.go(-1)");
	}
	$sql="insert into {$PG_table} set {$sql_values}, 	pg_wdate='{$datetime}' ";
	sql_query($sql,FALSE);
	alert ("등록되었습니다.","./page_list.php?{$qstr}&page={$page}");
}
else if ($mode=="E") {
	$sql="update {$PG_table} set {$sql_values} where pg_no='{$pg_no}'";
	sql_query($sql,FALSE);
	alert ("수정되었습니다.","./page_list.php?{$qstr}&page={$page}");
}
else if ($mode=="D") {
	$sql="delete from {$PG_table} where pg_no='{$pg_no}'";
	sql_query($sql,FALSE);

	//@unlink($_SERVER[DOCUMENT_ROOT]."/banner/item/{$bn_no}.jpg");
	alert ("삭제되었습니다.","./page_list.php?{$qstr}&page={$page}");
}
?>