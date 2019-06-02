<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

$PG_table = $GnTable["member"];

if($type=="mem_id") {
	$search_type = "아이디";
	$ch_script = "
		if(isEnglish(form.searchword) == false) { form.searchword.value=''; form.searchword.focus(); return false; }
		if(strLen(form.searchword,4,15) == false) { form.searchword.value=''; form.searchword.focus(); return false; }
	";
} else if($type=="mem_nick") {
	$search_type = "닉네임";
	$ch_script = "if(isKorean(form.searchword) == false) { form.searchword.focus(); return false; }";
} else if($type=="mem_email") {
	$search_type = "이메일";
	$ch_script = "if(chkMail(form.searchword) == false) { form.searchword.focus(); return false; }";
} else {
	alert_close("죄송합니다. 정상적인 접근이 아닙니다.");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>중복확인</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<style type="text/css">
	td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 16px;}
	A:link     {text-decoration:none;      color:#666666;}
	A:visited  {text-decoration:none;      color:#666666;}
	A:active   {text-decoration:none;      color:#666666;} 
	A:hover    {text-decoration:none;      color:#7EABD2;}
	img { border:0; }
</style>
<script language='javascript' src='/admin/lib/javascript.js'></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function checkform(form){
		if (!form.searchword.value){
			alert("검색할 단어를 입력해 주세요.");
			form.searchword.focus();
			return false;
		}
		<?=$ch_script?>
		return true;
	}

	function use_it(id){
		opener.document.<?=$form?>.<?=$target1?>.value = id;
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
<table width="420" border="0" cellspacing="0" cellpadding="8">
	<tr>
		<td align="center">
			<table width="400" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td><img src="/member/images/search_title.gif" border="0"></td>
				</tr>
				<tr> 
					<td height="25">&nbsp;</td>
				</tr>
<? if(!$searchword) { ?>
			<!-- 검색 폼 -->
				<FORM name="loginForm" METHOD="get" onsubmit="return checkform(this);">
				<input type="hidden" name="form" value="<?=$form;?>">
				<input type="hidden" name="type" value="<?=$type;?>">
				<input type="hidden" name="target1" value="<?=$target1;?>">
				<tr> 
					<td align="center"><strong>사용</strong>하시고자 하는 <strong><?=$search_type?></strong>를 입력하세요. </td>
				</tr>
				<tr> 
					<td height="25">&nbsp;</td>
				</tr>
				<tr>
					<td align="center"><input type="text" name="searchword" style="width:150; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> <input type=image src="/btn/btn_search.gif" border="0" align="absmiddle"> </td>
				</tr>
				</form>
				<tr> 
					<td height="25">&nbsp;</td>
				</tr>
<?
	} else { 
		$sql = " select count(*) as cnt from $PG_table where $type = '$searchword' ";
		$check = sql_fetch($sql);
	if(!$check[cnt]) {
?>
				<tr> 
					<td height="40" align="center" style="border-bottom:1px solid #d3d3d3">선택하신 <strong><?=$searchword;?></strong>는 사용가능합니다.<br>사용하시겠습니까? </td>
				</tr>
				<tr> 
					<td height="45" align="center"> <a href="javascript:use_it('<?=$searchword;?>');" onfocus="this.blur()"><img src="/btn/icon_use.gif" border=0 align="absmiddle"></a> <a href="<?=$PHP_SLEF;?>?target1=<?=$target1;?>&form=<?=$form;?>&type=<?=$type;?>" onfocus="this.blur()"> <img src="/btn/icon_research.gif" align="absmiddle" border="0"> </a></td>
				</tr>
	<? }else { ?>
				<FORM name="loginForm" METHOD="get" onsubmit="return checkform(this);">
				<input type="hidden" name="form" value="<?=$form;?>">
				<input type="hidden" name="type" value="<?=$type;?>">
				<input type="hidden" name="target1" value="<?=$target1;?>">
				<tr> 
					<td height="50" align="center" style="border-bottom:1px solid #d3d3d3"> 선택하신 <strong><?=$searchword;?></strong>는 이미 등록되어 있습니다.<br>다른 아이디를 사용하여 주시기 바랍니다. </td>
				</tr>
				<tr> 
					<td height="40" align="center"><input type="text" name="searchword" class=input> <input name="image" type=image src="/btn/btn_search.gif" align="absmiddle" border="0"> </td>
				</tr>
				</form>
	<? } ?>
<? } ?>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="/member/images/idpw_check_foot.gif" width="301" height="20"></td>
								<td><a href="javascript:window.close()"><img src="/member/images/foot_close_btn.gif" width="99" height="20" border="0"></a></td>
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
