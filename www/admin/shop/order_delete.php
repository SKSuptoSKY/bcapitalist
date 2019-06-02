<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];
$CH_table = $GnTable["shophistory"];

if ($od_id && $on_uid)
{
    // 장바구니 삭제
    sql_query(" delete from $JO_table where on_uid = '$on_uid' ");

    // 카드결제내역 삭제
    sql_query(" delete from $CH_table where od_id = '$od_id' and on_uid = '$on_uid' ");

    // 주문서 삭제
    sql_query(" delete from $PG_table where od_id = '$od_id' and on_uid = '$on_uid' ");
}

if ($return_url)
{
    goto_url("$return_url");
}
else
{
    $qstr = "sel_ca_id=$sel_ca_id&sel_field=$sel_field&search=$search&sort1=$sort1&sort2=$sort2&page=$page";
    goto_url("./order_list.php?$qstr");
}
?>
