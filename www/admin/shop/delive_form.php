<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopdelivery"];
$JO_table = "";

if($mode=="E") {
	$title_page = "배송회사 수정";

	$sql = " select * from $PG_table where dl_id = '$id' ";
	$view = sql_fetch($sql);

	if (!$view[dl_id]) alert("등록된 자료가 없습니다.");

} else if($mode=="W") {
	$title_page = "배송회사 등록";

	$view[dl_url] = "http://";
}

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function fitemformcheck(form) {
	if(!form.dl_company.value) {
		alert('배송회사명을 입력하세요');
		form.dl_company.focus();
		return false;
	}
	return true;
}
//-->
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$title_page?></font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form name=WriteForm method=post action="./delive_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="type"  value="<?=$type?>">
<input type=hidden name="id"  value="<?=$id?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">배송회사명</td>
		<td><input type=text class=text name=dl_company value='<? echo stripslashes($view[dl_company]) ?>' required itemname="배송회사명"></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">화물추적 URL</td>
		<td><input type=text class=text name=dl_url size=40 value='<? echo stripslashes($view[dl_url]) ?>'></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">고객센터 전화</td>
		<td><input type=text class=text name=dl_tel value='<? echo stripslashes($view[dl_tel]) ?>'></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">배송사 코드</td>
		<td><input type=text class=text name=de_code value='<? echo stripslashes($view[de_code]) ?>'></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">출력 순서</td>
		<td>
			<?=order_select("dl_order", $view[dl_order])?>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./delive_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>