<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopbrand"];
$JO_table = "";

if($mode=="E") {
	$title_page = "브랜드 수정";

	$sql = " select * from $PG_table where br_id = '$id' ";
	$view = sql_fetch($sql);

} else if($mode=="W") {
	$title_page = "브랜드 등록";

	$view[br_url] = "http://";
}

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function fitemformcheck(form) {
	if(!form.br_name.value) {
		alert('브랜드명을 입력하세요');
		form.br_name.focus();
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

<form name=WriteForm method=post action="./brand_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="type"  value="<?=$type?>">
<input type=hidden name="id"  value="<?=$id?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">이미지</td>
		<td>
			<input type=file name=br_bimg size=40 class=text>
			<?
			$bimg = "/shop/data/brand/{$view[br_id]}";
			if (file_exists($DOCUMENT_ROOT.$bimg) && $view[br_id]) {
				$size = getimagesize($DOCUMENT_ROOT.$bimg);
				echo "<img src='$bimg' border=1> <input type=checkbox name=br_bimg_del value='1'>삭제";
			}
			?>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">브랜드명</td>
		<td>
			<input type="text" name="br_name" size=80 value='<?=$view[br_name]?>' class=text>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">링크</td>
		<td>
			<input type="text"  name="br_url" value="<?=$view[br_url]?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">출력순서</td>
		<td>
			<?=order_select("br_order", $view[br_order])?>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px;">보이기</td>
		<td><input type=checkbox name='br_use' <? echo ($view[br_use] || $mode=="W") ? "checked" : ""; ?> value='1'> 체크하셔야 페이지에서 보입니다.</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./brand_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>