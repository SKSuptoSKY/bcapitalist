<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopcategory"];
$JO_table = $GnTable["shopitem"];

/////// DB에 들어갈 값들을 변환합니다.
	$ca_id = strtolower($ca_id);
	$p_subject = addslashes($p_subject);
	$p_info = addslashes($p_info);

/////// DB에 들어갈 값들을 정리합니다.
$input_value = "
	ca_name		=  '$ca_name',
	ca_skin			=  '$ca_skin',
	ca_input		=  '$ca_input',
	ca_use			=  '$ca_use'
";

@chmod("/shop/data/design", 0707);

/////// 파일 삭제 선택시
	if ($ca_timg_del) @unlink("/shop/data/design/{$id}_Top");

/////// 올라온 파일을 올립니다.
if ($_FILES[ca_timg][name]) { upload_file($_FILES[ca_timg][tmp_name], $id."_Top", $GnShop["data_dir"]."/design"); }

if($mode=="E") {
referer_check();
	$sql = " update $PG_table set $input_value where ca_id = '$id' ";
	sql_query($sql);
}

if($mode=="D") {
// 하위분류가 있는지 체크합니다.
	// 분류의 길이
	$len = strlen($id);
	$sql = " select COUNT(*) as cnt from $PG_table
			  where SUBSTRING(ca_id,1,$len) = '$id'
				and ca_id <> '$id' ";
	$row = sql_fetch($sql);
	if ($row[cnt] > 0)
		alert("이 분류에 속한 하위 분류가 있으므로 삭제 할 수 없습니다.\\n\\n하위분류를 우선 삭제하여 주십시오.");
// 관련 상품이 있는지 체크합니다.
	$str = $comma = "";
	$sql = " select it_id from $JO_table where ca_id = '$id' ";
	$result = sql_query($sql);
	$i=0;
	while ($row = mysql_fetch_array($result))
	{
		$i++;
		if ($i % 10 == 0) $str .= "\\n";
		$str .= "$comma$row[it_id]";
		$comma = " , ";
	}

	if ($str)
		alert("이 분류와 관련된 상품이 총 {$i} 건 존재하므로 상품을 삭제한 후 분류를 삭제하여 주십시오.\\n\\n$str");

	$sql = " delete from $PG_table where ca_id = '$id' ";
	sql_query($sql);
}

if($mode=="W") {
referer_check();
	$sql = " insert $PG_table set ca_id = '$ca_id', $input_value ";
	sql_query($sql);
}

	goto_url("./category_list.php?page=$page&$qstr");
?>
