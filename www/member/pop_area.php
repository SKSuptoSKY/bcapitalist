<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

	$PG_table = $GnTable["zipname"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>주소찾기</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 16px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;}
A:hover    {text-decoration:none;      color:#7EABD2;}
img { border:0; }
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
function checkform(V){
	location.href="<?=$PHP_SELF;?>?form=<?=$form?>&target=<?=$target;?>&sido="+V;
}

function copyValue(form){

	var val;

	val = form.gugun[form.gugun.selectedIndex].value;

	opener.document.<?=$form?>.<?=$target?>.value = val;
	opener.document.<?=$form?>.<?=$target?>.focus();
	window.close();
}

function captureReturnKey(e) {
if(e.keyCode==13 && e.srcElement.type != 'textarea')
return false;
}

//-->
</SCRIPT>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="502" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td align="center"><table width="485" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="/member/images/address_title.gif" width="485" height="52"></td>
        </tr>
        <tr>
          <td height="8"> </td>
        </tr>
        <tr>
          <td><table border="0" cellpadding="8" cellspacing="0" bgcolor="#F7F7F7" align=center>
              <tr>
                <td align="center" colspan=3>해당주소를 선택하세요.</td>
              </tr>
              <tr>
				<td>
		<!-- 검색 폼 -->
		<form name=address_1 method="get" onKeyDown="return captureReturnKey(event)" onSubmit="return  copyValue(this);">
		<input type=hidden name="target" value="<?=$target;?>">
		<input type=hidden name="form" value="<?=$form;?>">
					<select name="sido" onChange="checkform(this.value);">
						<option value="">-시도--</option>
					<?
						$sql = " select distinct sido from $PG_table ORDER BY sido";
						$view = sql_fetch($sql);
						$result = sql_query($sql,FALSE);
						for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
							$value =$row["sido"];
							if($value==$sido) $select = "selected"; else $select = "";
					?>
						<option value="<?=$value;?>" <?=$select?>><?=$value;?></option>
					<? }?>
					</select>
				</td>
				<td>
					<select name="gugun">
					<?
					if($sido==TRUE) {
					?>
						<option value="<?=$sido;?>"><?=$sido;?> 전체</option>
					<?
						$sql = " select distinct gu from $PG_table where sido='$sido' ORDER BY gu";
						$view = sql_fetch($sql);
						$result = sql_query($sql,FALSE);
						for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
							$value =$sido." ".$row["gu"];
					?>
						<option value="<?=$value;?>"><?=$row["gu"];?></option>
					<?  } } else { ?>
						<option value="">-구군--</option>
					<? } ?>
					</select>
				</td>
				<td>
					<input type=image src="/btn/icon_use.gif" border="0">
				</td>
              </tr>
            </table></td>
        </tr>
		</form>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="80%"><img src="images/address_check_foot.gif" width="386" height="20"></td>
                <td width="20%" align="right"><a href="javascript:window.close()"><img src="images/foot_close_btn.gif" width="99" height="20"></a></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
