<?
include "../head.php";

$PG_table = $GnTable["bbsgroup"];
$JO_table = "";

for ($i=0; $i<count($_POST[gr_id]); $i++) 
{

	$sql = " update $PG_table
                set gr_name = '{$_POST[gr_name][$i]}'
              where gr_id = '{$_POST[gr_id][$i]}' ";
    sql_query($sql);

}

goto_url("./bbs_group_list.php?page=$page&sort1=$sort1&sort2=$sort2");
?>
