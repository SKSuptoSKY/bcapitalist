<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopcoupon"];

if ($mode=="E") {
	$sql="update {$PG_table} set cp_content='{$cp_content}' where cp_no='1' ";
	$row=sql_fetch($sql);
	alert ("수정되었습니다.","./coupon_form.php?mode=E");
}