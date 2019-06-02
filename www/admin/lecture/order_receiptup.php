<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = "Gn_Lecture_History";

$pay_mny = str_replace(',','',$pay_mny);
$cancel_mny = str_replace(',','',$cancel_mny);

$sql = " update $PG_table
            set pay_mny = '$pay_mny',
				pay_date = '$pay_date',
				account_name = '$account_name'
          where tno = '$tno' ";
sql_query($sql);


$qstr = "sort1=$sort1&sort2=$sort2&sel_field=$sel_field&search=$search&page=$page";

goto_url("./order_view.php?tno=$tno&$qstr");
?>