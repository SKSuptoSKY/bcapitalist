<?
include "../head.php";
include "./lib/lib.php"; // lib ·Îµå

for ($i=0; $i<count($_POST[lec_no]); $i++) 
{
	$lec_pay[$i] = str_replace(',','',$_POST[lec_pay][$i]);
    $sql = "update Gn_Lecture
               set		lec_pay		= '{$lec_pay[$i]}',
						lec_order	= '{$_POST[lec_order][$i]}',
						lec_use		= '{$_POST[lec_use][$i]}'
             where lec_no   = '{$_POST[lec_no][$i]}' ";
    sql_query($sql);
}

goto_url("./list.php?sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&page=$page");

?>