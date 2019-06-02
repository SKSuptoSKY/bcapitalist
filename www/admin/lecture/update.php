<?
include "../head.php";


$lec_pay = str_replace(',','',$lec_pay);
$lec_tax = $lec_pay * 0.1;

$lec_frDT .= " 00:00:00";
$lec_enDT .= " 23:59:59";

$input_value ="
	lec_subject		= '$lec_subject',
	lec_frDT		= '$lec_frDT',
	lec_enDT		= '$lec_enDT',
	lec_pay			= '$lec_pay',
	lec_order		= '$lec_order',
	lec_use			= '$lec_use',
	lec_tax			= '$lec_tax'
	";

if ($mode=="W"){
	$input_value .= ", lec_regist = '$datetime', lec_modify = '$datetime'";
    $sql = " insert Gn_Lecture set $input_value";
    sql_query($sql);
}
else if ($mode=="E")
{
	$input_value .= ", lec_modify = '$datetime'";
	$sql = " update Gn_Lecture set $input_value where lec_no = '$lec_no' ";
	sql_query($sql);
}else if ($mode=="D"){
	$ex_sql = " select count(*) as cnt from Gn_Lecture_History where order_lec = '$lec_no' and status = '결제완료' ";
	$ex = sql_fetch($ex_sql);
	
	if($ex[cnt] != 0){
		alert('신청내용이 있으므로 삭제할 수 없습니다.','./list.php');
	} else {
		$sql = " delete from Gn_Lecture where lec_no = '$lec_no' ";
		sql_query($sql);
	}

}

$qstr = "$qstr&sca=$sca&page=$page";

if($mode=="W") alert('강의가 등록되었습니다.','./list.php');
if($mode=="E") alert('강의가 수정되었습니다.','./list.php');
if($mode=="D") alert('강의가 삭제되었습니다.','./list.php');

?>


