<?
include "../head.php";
include "./lib/lib.php"; // lib 로드

for ($i=0; $i<count($_POST[tno]); $i++) 
{
    $sql = "update Gn_Lecture_History
               set		status	= '{$status[$i]}'
             where tno   = '{$_POST[tno][$i]}' ";
    sql_query($sql);
}


goto_url("./detail_list.php?no=$no&sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&page=$page");
?>
