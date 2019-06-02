<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopdelivery"];
$JO_table = "";

$sql_common .= "set dl_company = '$dl_company',
                    dl_url = '$dl_url',
                    dl_tel = '$dl_tel',
					de_code = '$de_code',
                    dl_order = '$dl_order' ";

if ($mode == "W") {
    $sql = " alter table $PG_table auto_increment=1 ";
    @mysql_query($sql);

    $sql = " insert $PG_table $sql_common ";
    sql_query($sql);

    $dl_id = mysql_insert_id();
} else if ($mode == "E") {
    $sql = " update $PG_table $sql_common where dl_id = '$id' ";
    sql_query($sql);
} else if ($mode == "D") {
	// Master 삭제
	$sql = " delete from $PG_table where dl_id = '$id' ";
    sql_query($sql);
}

goto_url("./delive_list.php");
?>
