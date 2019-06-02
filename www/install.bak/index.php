<?
include_once ("../admin/lib/config.php");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$charset?>">
<title>게시판 설치</title>
<style type="text/css">
<!--
.body {
	font-size: 12px;
}
.box {
    font-family:돋움체;
	font-size: 12px;
}
-->
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" align=center>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table border="0" cellspacing="0" cellpadding="0" align=center>
    <form name=frm method=post action="javascript:frm_submit(document.frm)" autocomplete="off">
    <tr> 
      <td valign="top" bgcolor="#FCFCFC">
        <table width="270" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
          <tr> 
            <td width="270" height="16"><strong>MySQL 정보입력 </strong><br>
              <br>
              <table width="270" border="0" cellpadding="0" cellspacing="0" class="body">
                <tr> 
                  <td width="80" align="right" height=30>Host :&nbsp;</td>
                  <td><input name="mysql_host" type="text" class="box" value="localhost"></td>
                </tr>
                <tr> 
                  <td width="80" align="right" height=30>User :&nbsp;</td>
                  <td><input name="mysql_user" type="text" class="box" style="ime-mode:inactive;"></td>
                </tr>
                <tr> 
                  <td width="80" align="right" height=30>Password :&nbsp;</td>
                  <td><input name="mysql_pass" type="text" class="box"></td>
                </tr>
                <tr> 
                  <td width="80" align="right" height=30>DB :&nbsp;</td>
                  <td><input name="mysql_db" type="text" class="box"></td>
                </tr>
              </table></td>
          </tr>
        </table>
		<br>
        <table width="270" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td align="right"> 
              <input type="submit" name="Submit2" value=" 다   음 ">
            </td>
          </tr>
        </table>
		</td>
    </form>
  </table>

<script language="JavaScript">
<!--
function frm_submit(f)
{
    if (f.mysql_host.value == "")
    {   
        alert("MySQL Host 를 입력하십시오."); f.mysql_host.focus(); return; 
    }
    else if (f.mysql_user.value == "")
    {
        alert("MySQL User 를 입력하십시오."); f.mysql_user.focus(); return; 
    }
    else if (f.mysql_db.value == "")
    {
        alert("MySQL DB 를 입력하십시오."); f.mysql_db.focus(); return; 
    }

    f.action = "./install_db.php";
    f.submit();

    return true;
}

// 영문자만 입력 가능   
function only_alpha() 
{
    var c = event.keyCode;
    if (!(c >= 65 && c <= 90 || c >= 97 && c <= 122)) {
        event.returnValue = false;
    }
}

document.frm.mysql_user.focus();
//-->
</script>

</body>
</html>