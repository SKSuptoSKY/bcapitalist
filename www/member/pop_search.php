<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

	$PG_table = $GnTable["member"];

	//세션이 있으면 멤버 폴더로 이동
	if($_SESSION["userlevel"] > 0) alert_close("이미 로그인 정보가 있습니다.", "/");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>아이디/패스워드 찾기</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 16px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;}
A:hover    {text-decoration:none;      color:#7EABD2;}
img { border:0; }
</style>
<script language="javascript">
function this_it(form) {
		if(document.getElementById("search_type2").checked == true){
			if(!form.mem_id.value){
				alert("아이디를 입력해주세요");
				form.mem_id.focus();
				return false;
			}
		}
		if(!form.mem_name.value){
			alert("이름을 입력해주세요");
			form.mem_name.focus();
			return false;
		}
		if(!form.email1.value || !form.email2.value) {
			alert('이메일주소를 바르게 입력하세요');
			form.email1.value='';
			form.email2.value='';
			form.email1.focus();
			return false;
		}
	return true;
}
function form_ch(val){
	document.F.mem_id.value="";
	document.F.mem_name.value="";
	document.F.email1.value="";
	document.F.email2.value="";
	if(val == "1") {
		document.getElementById("mode1").style.display="none";
		document.getElementById("ment").src="/member/images/id_ment.jpg";
	}else{
		document.getElementById("mode1").style.display="block";
		document.getElementById("ment").src="/member/images/password_ment.jpg";
	}
}
</script>
</head>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
			<table width="429px;" cellpadding="0" cellspacing="0" border="0" align="center">
				<Tr>
					<td height="40px" style="font-size:18px; color:#333; "><b>아이디/비밀번호</b> 찾기</td>
				</tr>
				<tr>
					<td style="border:2px solid #e5e5e5;" >
						<form name="F" method="post" action="<?=$PHP_SELF;?>" onsubmit="return this_it(this)">
						<input type="hidden" name="mode" value="SEARCH">
						<Table width="374" cellpadding="0" cellspacing="0" border="0" align="center">
							<tr>
								<Td height="13px;"></td>
							</tr>
							<? if($mode!="SEARCH") { ?>
							<tr>
								<td>
									<Table width="" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td><input type="radio" name="search_type" id="search_type1" value="1" onFocus="blur()" checked onclick="form_ch('1')"></td>
											<td> <span style="font-weight:700">아이디 찾기</span></td>
											<Td width="40px;"></td>
											<td><input type="radio" name="search_type" id="search_type2" value="2" onFocus="blur()"   onclick="form_ch('2')"></td>
											<td>  <span style="font-weight:700">비밀번호 찾기</span></td>
										</tr>
									</table>
								</td>
							</tr>
							<Tr>
								<td height="15px;"></td>
							</tr>
							<tr>
								<td style="border-top:1px solid #dedede;">&nbsp;</td>
							</tr>
							<tr>
								<td height="10px;"></td>
							</tr>
								<tr id="mode1" style="display:none;">
									<td>
										<Table width="" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td width="70px" style="font-weight:700">아이디</td>
												<td><input type="text" name="mem_id" maxlength="15" style="width:109; height:21px; color:#666666; font-size:10pt; background-color:#ffffff; border:2 #cccccc solid"></td>
											</tr>
											<tr>
												<td height="5px;"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<Table width="" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td width="70px" style="font-weight:700">이름</td>
												<td><input type="text" name="mem_name" maxlength="15" style="width:109; height:21px; color:#666666; font-size:10pt; background-color:#ffffff; border:2 #cccccc solid"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="5px;"></td>
								</tr>
								<tr>
									<td>
										<Table width="" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td width="70px" style="font-weight:700">이메일주소</td>
												<td><input type="text" name="email1" style="width:109; height:21px; color:#666666; font-size:9pt; background-color:#ffffff; border:2 #cccccc solid"><img src="/member/images/email_line.jpg" align="absmiddle"><input type="text" name="email2" style="width:109; height:21px; color:#666666; font-size:9pt; background-color:#ffffff; border:2 #cccccc solid"></td>
											</tr>
										</table>
									</td>
								</tr>
								<Tr>
									<td height="15px;"></td>
								</tr>

								<tr>
									<td style="border-top:1px solid #dedede;">&nbsp;</td>
								</tr>
								<tr>
									<td height="5px;"></td>
								</tr>
								<Tr>
									<td align="center"><input type="submit" value="확인하기" style="background:#333; color:#fff; border:none; font-family:NanumGothic; width:80px; height:25px; "></td>
								</tr>
								<tr>
									<td height="20px;"></td>
								</tr>
								</form>
								<?
									} else {
										// 변수를 정리합니다.
										$mb_name = $_POST[mem_name];
										$mb_email = $_POST[email1]."@".$_POST[email2];
										$mem_id = $_POST[mem_id];

										// 아이디찾기
										if($search_type == "1") {
											$sql = " select * from $PG_table where mem_name = '$mb_name' and mem_email = '$mb_email'";
										}
										// 비밀번호 찾기
										if($search_type == "2") {
											$sql = " select * from $PG_table where mem_name = '$mb_name' and mem_email = '$mb_email' and mem_id='".$mem_id."' ";
										}
										$member = sql_fetch($sql);

										// 등록된 회원이라면
										if($member==TRUE) {

											################## [ 아이디 찾기 - START ] ##################
											if($search_type == "1") {
												$subject = "요청하신 아이디 입니다.";
											}

											################## [ 비밀번호찾기 - START ] ##################
											if($search_type == "2") {
												$newPass = substr(md5(rand(0,9)),0,8);
												$PassUP = sql_password($newPass);

												// 새로운 비밀번호로 변경합니다.
												$sql = " update $PG_table set mem_pass = '$PassUP' where mem_id = '{$member[mem_id]}' ";
												sql_query($sql);

												$subject = "요청하신 임시 비밀번호 입니다.";
											}

											$to = $member["mem_name"];
											$Receiver = $member["mem_email"];
											$fname = $default["site_name"];
											$fmail = $default["admin_email"];
											if(!$default["admin_email"]) $fmail = "master@".$_SERVER[SERVER_NAME];


											ob_start();
											// 아이디 찾기 스킨
											if($search_type == "1") {
												include $_SERVER["DOCUMENT_ROOT"]."{$G_member[skin_url]}/search_id.skin.php";
											}
											// 비밀번호 찾기 스킨
											if($search_type == "2") {
												include $_SERVER["DOCUMENT_ROOT"]."{$G_member[skin_url]}/search_idpw.skin.php";
											}
											$content = ob_get_contents();
											ob_end_clean();



											if($default[email_flag] == "오픈컴"){
												 include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
												 $mail = new Smtp("121.78.91.210");
												 $mail->send($to."|".$Receiver, $fname."|".$fmail, $subject, $content);
											}else{
												  mailer($fname, $fmail, $Receiver, $subject, $content, 1);
											}

											/*
											//구버전이라 오픈컴, 타호스팅 구분하는 기능이 들어있지 않기때문에 강제로 오픈컴 메일함수로 실행
											include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
											$mail = new Smtp("121.78.91.210");
											$mail->send($to."|".$Receiver, $fname."|".$fmail, $subject, $content);
											*/


											?>
											<tr>
												<td height=80 align="center">등록하신 메일(<?=$member[mem_email];?>)로 보내드렸습니다.<br>분실하지 않도록 유의하여 주시기 바랍니다.</td>
											</tr>
											<?
										}  else {
											?>
											<tr>
												<td align="center">검색하신 정보와 일치하는 내용의 회원이 없습니다.<br>다시 한번확인하여 주시기 바랍니다.</td>
											</tr>
											<tr>
												<td align="center" height=73><a href="<?=$PHP_SELF;?>"><span style="background:#333; color:#fff; width:80px; height:25px; display:block; line-height:2;">검색하기</span></a></td>
											</tr>
											<?
										}
									}
									?>
								</table>
							</td>
						</tr>
						<tr>
							<td align="right" style="padding-top:5px; ">아이디가 고객님의 가입하신 <b style="color:navy">이메일로 발송</b>됩니다.</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
