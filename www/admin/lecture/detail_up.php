<?
include "../head.php";

if(!$tno) alert("잘못된 접근입니다.","./list.php");

$sql = "update Gn_Lecture_History set status = '$status' where tno = '$tno'";
sql_query($sql);

goto_url("./detail_view.php?tno=$tno&no=$no&sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&page=$page");

?>