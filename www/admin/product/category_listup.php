<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["prodcategory"];
$JO_table = $GnTable["proditem"];

for ($i=0; $i<count($_POST[ca_id]); $i++) 
{

	$sql = " update $PG_table
                set ca_name = '{$_POST[ca_name][$i]}',
                     ca_use = '{$_POST[ca_use][$i]}'
              where ca_id = '{$_POST[ca_id][$i]}' ";
    sql_query($sql);

}

goto_url("./category_list.php?page=$page&sort1=$sort1&sort2=$sort2");
?>
