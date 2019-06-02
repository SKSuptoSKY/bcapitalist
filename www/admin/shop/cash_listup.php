<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";
isAdmin();

include "../head.php";

for ($i=0; $i<count($_POST[cash_id]); $i++) 
{

	$sql = " update shop_cash
                set cash_state       = '{$_POST[cash_state][$i]}' 
              where cash_id = '{$_POST[cash_id][$i]}' ";
    sql_query($sql);

}

goto_url("./cash_list.php?page=$page&sort1=$sort1&sort2=$sort2");
?>
