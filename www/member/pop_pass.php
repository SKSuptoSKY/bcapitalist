<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

	$PG_table = $GnTable["member"];
	$Gmember = Get_member($_SESSION["userid"]);
	if($Gmember==TRUE)
	{
		$ititme = date("Y-m-d H:i:s",time() - 86400);
		if($Gmember[first_regist] > $ititme)
		{
			alert_close("회원가입후 24시간 이내에는 탈퇴하실 수 없습니다.");
		}
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>패스워드 확인</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 16px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;} 
A:hover    {text-decoration:none;      color:#7EABD2;}
img { border:0; }
</style>
<script language="Javascript">
function login_chk(form)
{
	if(!form.mb_id.value) {
		alert('아이디를 입력해주세요.');
		form.mb_id.focus();
		return;
	}

	if(!form.mb_pass.value) {
		alert('비밀번호를 입력해주세요.');
		form.mb_pass.focus();
		return;
	}

	form.action = "/member/member_update.php?mode=BREAK";
    form.submit();
}
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="420" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td align="center"><table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="/member/images/idpwok_title.gif" width="400" height="52"></td>
        </tr>
        <tr> 
          <td height="15">&nbsp;</td>
        </tr>
        <tr> 
          <td align="center">
            안전한 회원탈퇴를 위하여 고객님의 <font color="#FF6600"><strong>비밀번호</strong></font>를 입력하여 주십시오. <br>
			비밀번호가 다를경우 탈퇴하실 수 없습니다.
		</td>
        </tr>
        <tr> 
          <td height="5"> </td>
        </tr>
        <tr>
          <form name="F" action="javascript:login_chk(document.F);" autocomplete="off" style="margin:0px;"  method="post">
		  <input type="hidden" name="mb_id" value="<?=$_SESSION[userid]?>">
            <td align="center"><table width="100%" border="0" cellpadding="8" cellspacing="5" bgcolor="#F2F2F2">
                <tr>
                  <td align="left" bgcolor="#F7F7F7" style="padding-left:10px">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><strong>ㆍ패스워드확인</strong></td>
							<td><input type="password" name="mb_pass" style="width:135; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"></td>
							<td><input type=image src="/btn/btn_search.gif" border="0" align="absmiddle"></td>
						</tr>
					</table>
                  </td>
                </tr>
              </table></td>
          </form>
        </tr>
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
