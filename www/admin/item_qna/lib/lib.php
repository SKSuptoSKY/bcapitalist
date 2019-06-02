<?
//공통변수
$page_loc = "shop";
include "../head.php";

$Table = "shop_qna";

$BoardSql = " select* from {$GnTable[bbsconfig]} where dbname = '$Table' ";
$Board_Admin = sql_fetch($BoardSql);
$html_title = $Board_Admin[title];

$PG_table = $GnTable["bbsitem"].$Table;
?>