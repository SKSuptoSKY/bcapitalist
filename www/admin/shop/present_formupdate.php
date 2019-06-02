<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoppresent"];
$JO_table = $GnTable["shopitem"];

if ($w == "") 
{
	sql_query(" alter table $PG_table auto_increment=1 ");

$odto_pay		= str_replace(',','',$odto_pay); 

    $sql = " insert $PG_table
                set 	pr_type			= '$type',
					 	item_num		= '$item_num', 
					 	odto_pay		= '$odto_pay', 
					 	pritem_num	= '$pritem_num', 
						pr_num			= '$pr_num', 
					 	pr_state			= '$pr_state' ";
    sql_query($sql);

	$pr_id = mysql_insert_id();
} 
else if ($w == "u") 
{

$odto_pay		= str_replace(',','',$odto_pay); 

	$sql = " update $PG_table
                set	item_num		= '$item_num', 
					 	odto_pay		= '$odto_pay', 
					 	pritem_num	= '$pritem_num', 
						pr_num			= '$pr_num', 
					 	pr_state			= '$pr_state' 
              where pr_id = '$pr_id' ";
    sql_query($sql);
} 
else if ($w == "d") 
{
    // 분류 삭제
    $sql = " delete from $PG_table where pr_id = '$pr_id' ";
    sql_query($sql);
}

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";

	if(!$type) goto_url("./presentpay_list.php?$qstr");
		else goto_url("./presentitem_list.php?$qstr");    
?>
