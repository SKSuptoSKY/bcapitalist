<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

//세션이 있으면 멤버 폴더로 이동
if($_SESSION["userlevel"] >= 100) goto_url("./admin.php");
else if( Login_check() && $_SESSION["userlevel"] < 100) goto_url("./logout.php");

if(isset($userid) && isset($passwd)) {
	sess_init($userid, $passwd,$userlevel);
	if($_SESSION["userlevel"] == 100) goto_url('./admin.php'); else alert("최종관리자로만 로그인이 가능합니다.","/admin/");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>관리자님 환영합니다.</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<script language=javascript>
function login_chk(form) {
	if(!form.userid.value) {
		alert('아이디를 입력하세요');
		form.userid.focus();
		return false;
	}
	if(!form.passwd.value) {
		alert('비밀번호를 입력하세요');
		form.passwd.focus();
		return false;
	}
	return true;
}
</script>
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 16px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;} 
A:hover    {text-decoration:none;      color:#E0820A;}
img { border:0; }
</style>

<body leftmargin="0" topmargin="0" onLoad="document.F.userid.focus();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0.">
<form name=F action="<?=$PHP_SELF;?>" method=post onSubmit="return login_chk(this)">
  <tr>
    <td><table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#E6E6E6">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#F7F7F7">
              <tr>
                <td bgcolor="#FFFFFF"><table width="300" border="0" align="center" cellpadding="3" cellspacing="0">
                    <tr> 
                      <td width="81" align="right"><strong>아이디</strong></td>
                        <td width="128" rowspan="3"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td height="5" align="center"><input type="text" name="userid" style="width:120;height:19px;color:#666666;font-size:9pt;background-color:#ffffff;border:1 #DFDFDF solid;ime-mode:inactive;" tabindex="1"></td>
                            </tr>
                            <tr> 
                              <td height="5"> </td>
                            </tr>
                            <tr> 
                              <td align="center"><input type="password" name="passwd" style="width:120; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" tabindex="2"></td>
                            </tr>
                          </table></td>
                      <td width="73" rowspan="3"><input type=image src="/admin/images/login_btn.gif" border="0" tabindex="3"></td>
                    </tr>
                    <tr> 
                      <td height="5"> </td>
                    </tr>
                    <tr> 
                      <td align="right"><strong>패스워드</strong></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
 </form>
</table>
</body>
</html>
