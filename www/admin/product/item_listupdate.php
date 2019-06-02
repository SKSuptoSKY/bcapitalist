<?
include "../head.php";
include "./lib/lib.php"; // lib 로드

// 판매가격 일괄수정
for ($i=0; $i<count($_POST[it_id]); $i++) 
{
    $sql = "update $PG_table 
               set ca_id				= '{$_POST[ca_id][$i]}',
                   it_name			= '{$_POST[it_name][$i]}',
                   it_pay				= '{$_POST[it_pay][$i]}',
                   it_epay			= '{$_POST[it_epay][$i]}',
                   it_stock			= '{$_POST[it_stock][$i]}',
                   it_use				= '{$_POST[it_use][$i]}',
                   it_order			= '{$_POST[it_order][$i]}'
             where it_id   = '{$_POST[it_id][$i]}' ";
    sql_query($sql);
}

goto_url("./item_list.php?sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&page=$page");
?>
