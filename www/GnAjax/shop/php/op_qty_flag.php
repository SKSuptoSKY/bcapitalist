<?
header("Content-type:text/plain; charset=utf-8");
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib2.php";

// echo "한글"로 출력하지 않는 이유는 Ajax 는 euc_kr 에서 한글을 제대로 인식하지 못하기 때문
// 여기에서 영문으로 echo 하여 Request 된 값을 Javascript 에서 한글로 메세지를 출력함


	$row = sql_fetch("select * from Gn_Shop_Add_option where itop_no = '".$_POST[itop_no]."'");
	if($row[itop_stock] == 0 && $row[itop_stock] != "") $row[itop_amount] = "품절";
	
	echo $row[itop_stock];


?>