<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

if(!$_POST[lec_no]) alert('잘못된 접근입니다.',"/mobile/academy.php");

$sql = "select * from Gn_Lecture where lec_no = '$lec_no'";
$lec = sql_fetch($sql);

$sql = "insert into Gn_Lecture_History set
		type			= '무통장입금',
		status			= '미입금',
		order_date		= '$datetime',
		order_name		= '{$order_name}',
		order_company	= '{$order_company}',
		order_position	= '{$order_position}',
		order_email		= '{$order_email}',
		order_mobile	= '{$order_mobile}',
		order_referral		= '{$order_referral}',
		order_coment	= '{$order_content}',
		order_lec		= '$lec_no',
		order_ip		= '$REMOTE_ADDR',
		order_pay		= '$lec[lec_pay]',
		order_tax		= '$lec[lec_tax]',
		order_subject	= '$lec[lec_subject]',
		total_pay		= '$total_pay'
		";

if(sql_query($sql)) alert("수강신청이 정상적으로 등록되었습니다.","/mobile/resist.php");
else alert("오류가 발생했습니다.","/mobile/resist.php");

?>