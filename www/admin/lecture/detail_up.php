<?
include "../head.php";

if(!$tno) alert("�߸��� �����Դϴ�.","./list.php");

$sql = "update Gn_Lecture_History set status = '$status' where tno = '$tno'";
sql_query($sql);

goto_url("./detail_view.php?tno=$tno&no=$no&sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&page=$page");

?>