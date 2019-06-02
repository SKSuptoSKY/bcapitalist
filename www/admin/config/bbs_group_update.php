<?
include "../head.php";

$PG_table = $GnTable["bbsgroup"];
$JO_table = "";

/////// DB에 들어갈 값들을 변환합니다.
	$gr_id = strtolower($gr_id);
	$p_subject = addslashes($p_subject);
	$p_info = addslashes($p_info);

/////// DB에 들어갈 값들을 정리합니다.
$input_value = "
	gr_name		=  '$gr_name'
";

if($mode=="E") {
referer_check();
	$sql = " update $PG_table set $input_value where gr_id = '$id' ";
	sql_query($sql);
}

if($mode=="D") {
// 하위분류가 있는지 체크합니다.
	// 분류의 길이
	$len = strlen($id);
	$sql = " select COUNT(*) as cnt from $PG_table
			  where SUBSTRING(gr_id,1,$len) = '$id'
				and gr_id <> '$id' ";
	$row = sql_fetch($sql);

	if ($row[cnt] > 0) alert("이 분류에 속한 하위 분류가 있으므로 삭제 할 수 없습니다.\\n\\n하위분류를 우선 삭제하여 주십시오.");
	
	//삭제되는 그룹인 페이지,게시판 그룹값 초기화
	$sql = " update $GnTable[bbsconfig] set boardgroup='' where boardgroup = '$id' ";
	sql_query($sql);
	$sql = " update $GnTable[pageitem] set pg_group='' where pg_group = '$id' ";
	sql_query($sql);

	$sql = " delete from $PG_table where gr_id = '$id' ";
	sql_query($sql);
}

if($mode=="W") {
referer_check();
	$sql = " insert $PG_table set gr_id = '$gr_id', $input_value ";
	sql_query($sql);
}

	goto_url("./bbs_group_list.php?page=$page&$qstr");
?>
