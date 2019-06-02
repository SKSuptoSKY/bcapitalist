<?
include "../head.php";
include "./../shop/lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopsell"];


if ($mode=="D") {
	$sql="delete from {$PG_table} where se_no='{$se_no}' ";
	sql_query($sql);
	alert ("삭제되었습니다.");
}
