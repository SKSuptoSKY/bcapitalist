<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoppresent"];
$JO_table = $GnTable["shopitem"];

for ($i=0; $i<count($_POST[pr_id]); $i++) 
{
	$odto_pay		= str_replace(',','',$_POST[odto_pay][$i]); 

	$sql = " update $PG_table
                set odto_pay       = '$odto_pay', 
					 pr_num       = '{$_POST[pr_num][$i]}',
                     pr_state        = '{$_POST[pr_state][$i]}'
              where pr_id = '{$_POST[pr_id][$i]}' ";
    sql_query($sql);

}

if(!$type) {
	goto_url("./presentpay_list.php?page=$page&sort1=$sort1&sort2=$sort2");
} else {
	goto_url("./presentitem_list.php?page=$page&sort1=$sort1&sort2=$sort2");
}
?>
