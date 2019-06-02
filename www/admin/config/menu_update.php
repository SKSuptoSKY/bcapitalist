<?
include "../head.php";
$PG_table = $GnTable["menu"];

//DB저장
$sql="select count(*) as cnt from {$PG_table}";
$row_cnt=sql_fetch($sql);

// 옵션 체크박스 구분자 추가 저장
$mn_shop_option_type = $mn_shop_option_type_1."|".$mn_shop_option_type_2."|".$mn_shop_option_type_3;

$sql_values="
	mn_banner_memo='{$mn_banner_memo}',
	mn_banner_use='{$mn_banner_use}',
	mn_popup_memo='{$mn_popup_memo}',
	mn_popup_use='{$mn_popup_use}',
	mn_poll_memo='{$mn_poll_memo}',
	mn_poll_use='{$mn_poll_use}',
	mn_shop_memo='{$mn_shop_memo}',
	mn_shop_use='{$mn_shop_use}',
	mn_shopmodule_use='{$mn_shopmodule_use}',
	mn_product_memo='{$mn_product_memo}',
	mn_product_use='{$mn_product_use}',
	mn_shop_review_memo='{$mn_shop_review_memo}',
	mn_shop_review_use='{$mn_shop_review_use}',
	mn_shop_qna_memo='{$mn_shop_qna_memo}',
	mn_shop_qna_use='{$mn_shop_qna_use}',
	mn_shop_option_use='{$mn_shop_option_use}',
	mn_shop_option_type='{$mn_shop_option_type}',
	mn_shop_related_use='{$mn_shop_related_use}',
	mn_group_mail_use='{$mn_group_mail_use}',
	mn_counter_memo='{$mn_counter_memo}',
	mn_counter_use='{$mn_counter_use}',
	mn_statistics_memo='{$mn_statistics_memo}',
	mn_statistics_use='{$mn_statistics_use}',
	point_use='{$point_use}',
	use_type='{$use_type}',
	trans_pay='{$trans_pay}',
	mn_sms_memo='{$mn_sms_memo}',
	mn_sms_use='{$mn_sms_use}',
	duplicate_login='{$duplicate_login}'
";

if ($row_cnt["cnt"]>0) {
	$sql="update {$PG_table} set {$sql_values}";
}
else {
	$sql="insert {$PG_table} set {$sql_values}";
}
sql_query($sql);

alert ("수정되었습니다.","./menu_list.php");
?>