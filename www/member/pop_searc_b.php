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
	//주민번호 체크
	if (!form.ssn1.value) {		alert("주민번호 앞자리 6자를 입력하세요."); 	form.ssn1.focus();	return false; }
	if (!form.ssn2.value) {		alert("주민번호 앞자리 7자를 입력하세요."); 	form.ssn2.focus();	return false; }
	if(!form.ssn1.value || !form.ssn2.value) {
		alert('주민등록번호를 바르게 입력하세요');
		form.ssn1.value='';
		form.ssn2.value='';
		form.ssn1.focus();
		return false;
	}
		
	var reginum = form.ssn1.value.concat(form.ssn2.value);
	var weight = '234567892345'; // 자리수 weight 지정 
	var len = reginum.length; 
	var sum = 0; 
		
	if (len != 13) { 
		alert('주민등록번호를 바르게 입력하세요');
		form.ssn1.value='';
		form.ssn2.value='';
		form.ssn1.focus();
		return false; 
	} 
		
	for (var i = 0; i < 12; i++) { 
		sum = sum + (reginum.substr(i,1)*weight.substr(i,1)); 
	} 
		
	var rst = sum%11; 
	var result = 11 - rst; 
		
	if (result == 10) {result = 0;} 
	else if (result == 11) {result = 1;} 
		
	var jumin = reginum.substr(12,1); 
	
	if (result != jumin) {
		alert('주민등록번호를 바르게 입력하세요');
		form.ssn1.value='';
		form.ssn2.value='';
		form.ssn1.focus();
		return false;
	} 
}
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="420" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td align="center"><table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="/member/images/idpw_title.gif" width="400" height="52"></td>
        </tr>
        <tr> 
          <td height="15">&nbsp;</td>
        </tr>
<? if($mode!="SEARCH") { ?>
        <tr> 
          <td align="center">고객님의 <font color="#FF6600"><strong>주민등록번호</strong></font>를 
            입력하여 주십시오. <br>
            임시 비밀번호가 고객님의 가입하신 <strong><font color="#FF6600">이메일로 발송</font></strong>됩니다.</td>
        </tr>
        <tr> 
          <td height="5"> </td>
        </tr>
        <tr>
          <form name="F" method="post" action="<?=$PHP_SELF;?>" onsubmit="return this_it(this)">
		  <input type="hidden" name="mode" value="SEARCH">
            <td align="center"><table width="100%" border="0" cellpadding="8" cellspacing="5" bgcolor="#F2F2F2">
                <tr>
                  <td align="left" bgcolor="#F7F7F7" style="padding-left:10px">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><strong>ㆍ이름</strong></td>
							<td><input type="text" name="mem_name" maxlength=10 style="width:135; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"></td>
							<td rowspan="2"><input type=image src="/btn/btn_search.gif" border="0" align="absmiddle"></td>
						</tr>
						<tr>
							<td><strong>ㆍ주민등록번호</strong></td>
							<td><input type="text" name="ssn1" maxlength=6 style="width:60; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> - <input type="password" name="ssn2" maxlength=7 style="width:60; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"></td>
						</tr>
					</table>
                  </td>
                </tr>
              </table></td>
          </form>
        </tr>
<?
	} else {
		// 변수를 정리합니다.
			$mb_name = $_POST[mem_name];
			$mb_sch = sql_password($_POST[ssn1].$_POST[ssn2]);

			$sql = " select * from $PG_table where mem_name = '$mb_name' and mem_sch = '$mb_sch' ";
			$member = sql_fetch($sql);

		if($member==TRUE) {
			$newPass = substr(md5(rand(0,9)),0,8);
			$PassUP = sql_password($newPass);

			// 새로운 비밀번호로 변경합니다.
			$sql = " update $PG_table set mem_pass = '$PassUP' where mem_id = '{$member[mem_id]}' ";
			sql_query($sql);

			$to = $member["mem_name"];
			$Receiver = $member["mem_email"];
			$fname = $default["site_name"];
			$fmail = $default["admin_email"];

			$subject = "요청하신 아이디와 임시 비밀번호 입니다.";

			ob_start();
			include $_SERVER["DOCUMENT_ROOT"]."{$G_member[skin_url]}/search_idpw.skin.php";
			$content = ob_get_contents();
			ob_end_clean();
			mailer($fname, $fmail, $Receiver, $subject, $content, 1);
?>
			<tr> 
				<td height=80 align="center">등록하신 메일(<?=$member[mem_email];?>)로 보내드렸습니다.<br>분실하지 않도록 유의하여 주시기 바랍니다.</td>
			</tr>
	<? } else {?>	
			<tr> 
				<td align="center">검색하신 정보와 일치하는 내용의 회원이 없습니다.<br>다시 한번확인하여 주시기 바랍니다.</td>
			</tr>
			<tr> 
				<td align="center" height=73><a href="<?=$PHP_SELF;?>"><img src="/btn/btn_search.gif"></a></td>
			</tr>
	<? } ?>
<? } ?>
			<tr> 
				<td height="15">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="/member/images/idpw_check_foot.gif" width="301" height="20"></td>
							<td><a href="javascript:window.close();"><img src="images/foot_close_btn.gif" width="99" height="20"></a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>
