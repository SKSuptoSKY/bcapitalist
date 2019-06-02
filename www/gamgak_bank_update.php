<?
if(!$_POST[order_lec]) alert('잘못된 접근입니다.',"/curriculum.php");

$sql = "select * from Gn_Lecture where lec_no = '$order_lec'";
$lec = sql_fetch($sql);

$bank_name = iconv("EUC-KR","UTF-8",$bank_name);

$sql = "insert into Gn_Lecture_History set
		tno				= '$tno',
		order_idxx		= '$ordr_idxx',
		type			= '계좌이체',
		bank_code		= '{$bank_code}',
		bank_name		= '{$bank_name}',
		bank_pay		= '{$bk_mny}',
		cash_no			= '{$cash_no}'
		app_time		= '{$app_time}',
		status			= '결제완료',
		order_date		= '$datetime',
		pay_mny			= '{$bk_mny}',
		pay_date		= '$app_time',
		order_name		= '{$buyr_name}',
		order_company	= '{$_POST[order_company]}',
		order_email		= '{$buyr_mail}',
		order_mobile	= '{$buyr_tel1}',
		order_coment	= '{$_POST[order_coment]}',
		order_lec		= '$order_lec',
		order_ip		= '$REMOTE_ADDR',
		order_pay		= '$lec[lec_pay]',
		order_tax		= '$lec[lec_tax]',
		order_subejct	= '$lec[lec_subject]'
		";
$res_flag = sql_query($sql);

if($res_flag == 1) $bSucc = "true";
else $bSucc = "false";

?>