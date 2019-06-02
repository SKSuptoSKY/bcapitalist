<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
$mode = (($_POST[mode])?$_POST[mode]:$_GET[mode]);

if($mode == "mailing_send"){

	$fname = $default["site_name"];
	$site_root = $default["site_url"];
	$mail_root = $default["site_url"]."/mail";
	$fmail = $default["admin_email"];


	if(!$mail_num){
		if(!$fmail){
			alert("기본환경설정 - 관리자메일주소를 입력해 주세요.");
		}
		if($skin_type == "1"){
			include "../../../mail/mail_admin.php";
		}else if($skin_type == "2"){
			$body = $m_content;
		}
		$content = $body;

		$rand = rand(100,999);
		$mail_num = date("ymdHi")."-".$rand;
		$content = addslashes($content);
		$date = mktime();

		$sql = sql_query("insert into Gn_Mailing (mail_num, subject, content, mailheaders, send_date) values('$mail_num', '$m_subject', '$content', '$mailheaders', '$date');");

	}else{
		$sql = sql_query("select * from Gn_Mailing where mail_num='$mail_num'");
		$arr = mysql_fetch_array($sql);
		$subject = $arr[subject];
		$content = $arr[content];
		$mailheaders = $arr[mailheaders];
	}
		if($default[email_flag] == "오픈컴"){
			include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
			$mail = new Smtp("121.78.91.210");
		}

	$count=0;
	$sql = sql_query("select * from Gn_Mailing_List where result is NULL limit 500");
	while($arr = mysql_fetch_array($sql)){
		$content = stripslashes($content);

		if($default[email_flag] == "오픈컴"){
			//$Re = $mail->send($arr[user_name]."|".$arr[mem_email], $fname."|".$fmail, $m_subject, $content);
			$Re = $mail->send($fname."|".$fmail, $arr[user_name]."|".$arr[mem_email], $m_subject, $content);
		}else{
			//$Re = mailer($arr[user_name], $arr[email], $fmail, $m_subject, $content, 1);
			$Re = mailer($fname, $fmail,$arr[email], $m_subject, $content, 1);
		}
		if($Re) sql_query("update Gn_Mailing_List set mail_num='$mail_num', result='succeed' where idx='$arr[idx]'");
		else sql_query("update Gn_Mailing_List set mail_num='$mail_num', result='fail' where idx='$arr[idx]'");
		$count++;
	}

	$cSql = sql_query("select * from Gn_Mailing_List where result is NULL");
	$cNum = mysql_num_rows($cSql);
	if($cNum>0){
		cfm_go("계속 발송하시겠습니까?", "발송이 중단되었습니다.", $PHP_SELF."?mode=mailing_send&mail_num=$mail_num");
	}else{
		alert2("발송이 완료되었습니다.");
		f_go("../../member/mailing_result.php");
	}




}
?>

