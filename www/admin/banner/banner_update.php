<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";

$PG_table = $GnTable["banner"];

if (!$bn_no) {
	$sql="select max(bn_no) as no_max from {$PG_table}";
	$row_max=sql_fetch($sql);
	$bn_no=$row_max["no_max"]+40;
}

$sql_values="
	bn_begin_time='$bn_begin_time',
	bn_end_time='$bn_end_time',
	bn_subject='$bn_subject',
	bn_category='$bn_category',
	bn_sort='$bn_sort',
	bn_link='$bn_link',
	bn_link_target='$bn_link_target',
	bn_content='$bn_content'
";

if ($bn_img_del) @unlink($_SERVER[DOCUMENT_ROOT]."/banner/item/{$bn_no}.jpg");
if ($_FILES[bn_img][name]) { 
	upload_file($_FILES[bn_img][tmp_name], $bn_no.".jpg",$_SERVER[DOCUMENT_ROOT]."/banner/item/"); 
}

if ($mode=="W") {
	$sql="insert {$GnTable[banner]} set bn_no='$bn_no', {$sql_values}";
	sql_query($sql,FALSE);
	alert ("등록되었습니다.","./banner_list.php");
}
else if ($mode=="E") {
	$sql="update {$GnTable[banner]} set {$sql_values} where bn_no='{$bn_no}'";
	sql_query($sql,FALSE);
	alert ("수정되었습니다.","./banner_list.php");
}
else if ($mode=="D") {
	$sql="delete from {$GnTable[banner]} where bn_no='{$bn_no}'";
	sql_query($sql,FALSE);

	@unlink($_SERVER[DOCUMENT_ROOT]."/banner/item/{$bn_no}.jpg");
	alert ("삭제되었습니다.","./banner_list.php");
}
?>