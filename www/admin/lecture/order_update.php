<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = "Gn_Lecture_History";

if($isnow=="") {
	$isnow = date("Y-m-d H:i:s");
}
$pay_mny = str_replace(',','',$pay_mny);
$cancel_mny = str_replace(',','',$cancel_mny);


if($mode=="memo"){

	$sql = " update $PG_table
				set order_memo = '$order_memo'
		        where tno = '$tno' ";
	sql_query($sql);
} else if($mode=="listup") {

}else {
	/*
	if($_POST[ct_status] == "취소"){
		 $sql =  " update $PG_table
					set status = '$ct_status',
						pay_mny = '0',
						cancel_mny = '$pay_mny' 
					where tno = '$tno'";
		sql_query($sql);
	} else if($_POST[ct_status] == "결제완료"){
		 $sql =  " update $PG_table
				set status = '$ct_status',
						pay_mny = '0',
						cancel_mny = '0' 
				where tno = '$tno'";
		sql_query($sql);
	} 
	*/
	/*
	$sql = "select count(*) as cnt from Gn_Lecture where lec_no = '$order_lec'";
	$res = sql_fetch($sql);

	if($res[cnt]==0 and $ct_status == "결제완료"){
		alert('현재 신청하신 강의가 존재하지 않아 상태를 변경할 수 없습니다.',"./order_view.php?tno=$tno&$qstr");
	}else {
		$sql =  " update $PG_table
			set status = '$ct_status'
			where tno = '$tno'";
		sql_query($sql);
	}
	*/

	$ct_history="\n{$ct_status}|$isnow|$REMOTE_ADDR";

	if($ct_status == "취소"){
		$sql = " update $PG_table
				set status = '$ct_status',
					cancel_mny = '$total_pay',
					ct_history = '$ct_history'
				where tno = '$tno'";
	}if($ct_status == "결제완료"){
		$sql = " update $PG_table
				set status = '$ct_status',
					pay_mny = '$total_pay',
					cancel_mny = '0',
					ct_history = '$ct_history'
				where tno = '$tno'";
	} else {
		$sql = " update $PG_table
				set status = '$ct_status',
					cancel_mny = '0',
					pay_mny = '0',
					ct_history = '$ct_history'
				where tno = '$tno'";
	}
	sql_query($sql);
 }

$qstr = "sort1=$sort1&sort2=$sort2&sel_field=$sel_field&search=$search&page=$page";
$url = "./order_view.php?tno=$tno&$qstr";

goto_url($url);
?>
