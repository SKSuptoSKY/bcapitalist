<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

	$PG_table = $GnTable["zipcode"];
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
function checkform(form){
	if(!form.dong.value){ alert("동이름을 입력해 주세요.");form.dong.focus(); return false}
	return true;
}

function copyValue(form){

	var val;

	if(form.address.value==""){ alert("주소를 선택하세요.");form.address.focus(); return false}

	val = form.address[form.address.selectedIndex].value.split("||");

	opener.document.<?=$form?>.<?=$target1?>.value = val[0];
	opener.document.<?=$form?>.<?=$target2?>.value = val[1];
	opener.document.<?=$form?>.<?=$target3?>.focus();
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
          <td><img src="images/address_title.gif" width="485" height="52"></td>
        </tr>
        <tr><td height="25">&nbsp;</td></tr>
		<!-- 검색 폼 -->
		<form name=address method="get" onSubmit="return checkform(this);">
        <input type=hidden name=mode	value="1">
		<input type=hidden name=form	value="<?=$form;?>">
		<input type=hidden name=target1 value="<?=$target1;?>">
		<input type=hidden name=target2 value="<?=$target2;?>">
		<input type=hidden name=target3 value="<?=$target3;?>">
        <tr> 
          <td align="center"><strong>동/읍/면</strong>의 이름을 입력하시고 <strong>'주소찾기'</strong>를 
            클릭하세요.<br>
            (예:둔산 또는 창녕읍 또는 홍동면)</td>
        </tr>
        <tr><td height="8"></td></tr>
        <tr> 
            <td align="center"> <input type="text" name="dong" style="width:150; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> 
              <input type=image src="/btn/btn_search.gif" border="0" align="absmiddle"> 
            </td>
        </tr>
        <tr><td height="8"></td></tr>
		</form>
		<? if($mode==TRUE){?>
        <form name=address_1 method="get" onKeyDown="return captureReturnKey(event)" onSubmit="return  copyValue(this);">
		<input type=hidden name=form	value="<?=$form;?>">
		<input type=hidden name=target1 value="<?=$target1;?>">
		<input type=hidden name=target2 value="<?=$target2;?>">
		<input type=hidden name=target3 value="<?=$target3;?>">
        <tr> 
          <td><table width="100%" border="0" cellpadding="8" cellspacing="0" bgcolor="#F7F7F7">
              <tr> 
                <td align="center">해당주소를 선택하세요.<br>
					<select name="address">
					<?
					if($dong) {
						$sql = " select * from $PG_table where dong LIKE '%$dong%' ORDER BY seq ";
						$result = sql_query($sql,FALSE);
						for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
							$postal = $row["zipcode"]."||".$row["sido"]." ".$row["gugun"]." ".$row["dong"];
							$address = $row["sido"]." ".$row["gugun"]." ".$row["dong"]." ".$row["bunji"];
					?>
						<option value="<?=$postal;?>"><?=$address;?></option>
					<? } }?>
					</select>
				</td>
              </tr>
            </table></td>
        </tr>
        <tr><td height="5"> </td></tr>
        <tr>
          <td align="center"><input type=image src="/btn/icon_use.gif" border="0">
            </td>
        </tr>
		</form>
        <? }else{?>
        <tr><td height="80">&nbsp;</td></tr>
        <? }?>
        <tr><td>&nbsp;</td></tr>
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

<div style="padding-top:100px;"></div>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
			<table width="429px;" cellpadding="0" cellspacing="0" border="0" align="center">
				<Tr>
					<td><img src="/member/images/adress_title.jpg"></td>
				</tr>
				<tr>
					<td style="border:2px solid #e5e5e5;" >
						<Table width="374" cellpadding="0" cellspacing="0" border="0" align="center">
							<tr>
								<Td height="13px;"></td>
							</tr>
							<tr>
								<td align="center"><img src="/member/images/adress_ment.jpg"></td>
							</tr>
							<tr>
								<td height="15px;"></td>
							</tr>
							<tr>
								<td style="border-top:1px solid #dedede;">&nbsp;</td>
							</tr>
							<tr>
								<td align="center">
									<table width="" cellpadding="0" cellspacing="0" border="0">
										<Tr>
											<td><input type="text" name="dong" style="width:213; height:21px; color:#666666; font-size:9pt; background-color:#ffffff; border:2 #cccccc solid"> </td>
											<td width="5"></td>
											<td><img src="/member/images/ad_search.jpg"></td>
										</tr>
									</table>
								</td>
							</tr>
							<Tr>
								<td height="20px;"></td>
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
