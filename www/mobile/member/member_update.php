<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

$PG_table = $GnTable["member"];
$JO_table = $GnTable["memberlevel"];
if($mode == Null){
	goto_url('/mobile/main.php');
}
/////// DB에 들어갈 값들을 변환합니다.
	$mem_content = addslashes($mem_content);
	for ($i=1; $i<=5; $i++) {
		$exvalue = "exe_".$i;
		$exe[$i] = addslashes($$exvalue);
	}
	if($mem_pass==TRUE) {
		$mem_pass = sql_password($mem_pass);
		$PlusInput = ", mem_pass = '$mem_pass'";
	}
	$mem_birth = $mem_birth_y."-".$mem_birth_m."-".$mem_birth_d;
	$mem_tel = $mem_tel01."-".$mem_tel02."-".$mem_tel03;
	$mem_phone = $mem_phone01."-".$mem_phone02."-".$mem_phone03;
	$mem_fax = $mem_fax01."-".$mem_fax02."-".$mem_fax03;

/////// DB에 들어갈 값들을 정리합니다.
$input_value = "
	mem_nick				=  '$mem_nick',
	mem_post				=  '$mem_post',
	mem_add1				=  '$mem_add1',
	mem_add2				=  '$mem_add2',
	mem_tel				=  '$mem_tel',
	mem_phone			=  '$mem_phone',
	mem_fax				=  '$mem_fax',
	mem_email				=  '$mem_email',
	mem_home			=  '$mem_home',
	mem_birth				=  '$mem_birth',
	mem_btype			=  '$mem_btype',
	mem_sex				=  '$mem_sex',
	mem_remail			=  '$mem_remail',
	mem_sms				=  '$mem_sms',
	mem_content			=  '$mem_content',
	com_num				=  '$com_num',
	com_ceo				=  '$com_ceo',
	com_charge			=  '$com_charge',
	com_cphone			=  '$com_cphone',
	com_post				=  '$com_post',
	com_add1				=  '$com_add1',
	com_add2				=  '$com_add2',
	exe_1				=  '{$exe[1]}',
	exe_2				=  '{$exe[2]}',
	exe_3				=  '{$exe[3]}',
	exe_4				=  '{$exe[4]}',
	exe_5				=  '{$exe[5]}',
	mem_chu				=  '$mem_chu'
	$PlusInput
";

//////////////////////////////////////////////////////////////
/////////////// 회원 이미지 파일 여기부터 /////////////////
	if($photo_del=="1") {
		// 이미지 삭제
		@unlink("$G_member[data_dir]/$id");
	}

	/////// 올라온 파일을 이름을 바꿔올립니다.
	if ($_FILES[photo][name])
	{
		upload_file($_FILES[photo][tmp_name], $id, $G_member[data_dir]);
	}
/////////////// 회원 이미지 파일 여기까지 /////////////////
//////////////////////////////////////////////////////////////

	// 회원정보를 불러옵니다.
	$sql = " select * from $PG_table where mem_id = '$id' ";
	$chm = sql_fetch($sql);

//////////////////////////////////////////////////////////////
////////////////////// 회원정보 수정 ///////////////////////
if($mode=="INFO") {
referer_check();
	//세션이 없으면 멤버 폴더로 이동
	if($_SESSION["userlevel"]<10) alert("로그인후 이용하실 수 있습니다.", "/member/login.php?URL=/member/member_form.php?mode=INFO");

	$sql = " update $PG_table set $input_value, last_modify = '$datetime' where mem_id = '$id' ";
	sql_query($sql);

	if($URL==FALSE) $URL = "/mobile/member/member_form.php?mode=INFO";
	alert("회원정보가 수정되었습니다.", $URL);
}
////////////////////// 회원정보 수정 ///////////////////////
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
//////////////////////// 회원 탈퇴 //////////////////////////
if($mode=="BREAK") {
	if($_SESSION[userlevel]=="100") {
		alert("관리자 등급의 회원은 탈퇴할 수 없습니다");
	}

	$Gmember = Get_member($_SESSION["userid"]);
	if($Gmember==TRUE)
	{
		if(sql_password($mb_pass) != $Gmember["mem_pass"])
		{
			alert_close("비밀번호가 맞지 않습니다.", "/mobile/member/logout.php");
		}
	// 가입후 24시간이 지나야 탈퇴할 수 있습니다.
		if(date("Y-m-d H:i:s",$now-86400) < $Gmember["first_regist"])
		{
			alert_close("가입하신후 바로 탈퇴 하실 수 없습니다.");
		}
	}

	$input_value = "
		mem_leb				=  '0',
		mem_pass				=  '',
		mem_name			=  '탈퇴회원',
		mem_sch				=  '',
		mem_nick				=  '탈퇴회원',
		mem_post				=  '',
		mem_add1				=  '',
		mem_add2				=  '',
		mem_tel				=  '',
		mem_phone			=  '',
		mem_fax				=  '',
		mem_email				=  '',
		mem_home			=  '',
		mem_birth				=  '',
		mem_btype			=  '',
		mem_remail			=  '',
		mem_sms				=  '',
		mem_content			=  '',
		com_num				=  '',
		com_ceo				=  '',
		com_charge			=  '',
		com_cphone			=  '',
		com_post				=  '',
		com_add1				=  '',
		com_add2				=  '',
		exe_1				=  '',
		exe_2				=  '',
		exe_3				=  '',
		exe_4				=  '',
		exe_5				=  '',
		last_modify			=  '$datetime'
	";

	$sql = " update $PG_table set $input_value where mem_id = '{$_SESSION[userid]}' ";
	sql_query($sql);

	// 회원파일 삭제
	@unlink("$G_member[data_dir]/{$_SESSION[userid]}");

	sess_kill();
	alert_close("그동안 이용해 주셔서 감사합니다.", "/mobile/main.php");
}
//////////////////////// 회원 탈퇴 //////////////////////////
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
//////////////////////// 회원 가입 //////////////////////////
if($mode=="JOIN") {
referer_check();
	//세션이 있으면 멤버 폴더로 이동
	if($_SESSION["userlevel"] > 0) alert("이미 로그인 정보가 있습니다.", "/mobile/main.php");

	if($mem_leb==FALSE) {
		$input_value .= ", mem_leb = '10' ";
	} else {
		$input_value .= ", mem_leb = '$mem_leb' ";
	}

	$sql = " insert $PG_table set mem_id = '$id', mem_sch = '$mem_sch', mem_name = '$mem_name', $input_value, first_regist = '$datetime', join_ip = '$_SERVER[REMOTE_ADDR]' , site = '{$default[site_code]}'";
	sql_query($sql);

	// 회원가입 축하 적립금지급
	if($default["use_point"]==TRUE && $default["join_point"]>0) {
		input_point($default["join_point"],"회원가입해주셔서 감사합니다",$id);
	}

	/// 회원인증을 사용할경우
	if($default["mail_check"]==TRUE) {
		$Checkpass = substr(md5(rand(0,9)),0,10);
		$mail_check_href = $default["site_url"]."/mobile/member/member/login.php?PasCode=$Checkpass&URL=";
	} else {
		// 회원인증 일자를 강제로 넣어줍니다.
		$sql = " update $PG_table set mem_check = '$datetime' where mem_id = '$id' ";
		sql_query($sql);
	}
	
		// 가입축하 메일을 보냅니다.
			$to = $_POST["mem_nick"];
			$Receiver = $_POST["mem_email"];
			$fname = $default["site_name"];
			$fmail = $default["admin_email"];
			if(!$default["admin_email"]) $fmail = "master@".$_SERVER[SERVER_NAME];	// 20141222 추가 mj
			$subject = "$to 님 회원가입 감사합니다.";

			ob_start();
			include $_SERVER["DOCUMENT_ROOT"]."{$G_member[skin_url]}/join_mail.skin.php";
			$content = ob_get_contents();
			ob_end_clean();
		
		if($default[email_flag] == "오픈컴"){
			 include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
			 $mail = new Smtp("121.78.91.210");
			 $mail->send($to."|".$Receiver, $fname."|".$fmail, $subject, $content);	
		}else{
			  mailer($fname, $fmail, $Receiver, $subject, $content, 1);
		}

	if($URL==FALSE) $URL = "/mobile/member/login.php";
	alert("가입해 주셔서 감사합니다.", $URL);
}
//////////////////////// 회원 가입 //////////////////////////
//////////////////////////////////////////////////////////////
?>