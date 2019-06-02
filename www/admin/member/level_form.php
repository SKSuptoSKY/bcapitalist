<?
	include "../head.php";

	$PG_table = $GnTable["memberlevel"];
	$JO_table = "";

if($mode=="E") {
	$title_page = "회원 등급 수정";

	$sql = " select * from $PG_table where leb_id = '$id' ";
    $view = sql_fetch($sql);

} else if($mode=="W") {
	$title_page = "회원 등급 등록";

}

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language='javascript'>
function fcategoryformcheck(f)
{
        if (f.leb_name.value == '') {
            alert("등급명을 입력하셔야 합니다.");
            return false;
        }
        if (f.leb_level.value == '') {
            alert("등급 코드를 입력하셔야 합니다.");
            return false;
        }
		if (f.leb_level.value > 100) {
            alert("관리등급보다 높은 등급은 지정할 수 없습니다.");
            return false;
        }
    return true;
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 회원 등급 관리</font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form name=F method=post action="./level_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="leb_id" value="<?=$view[leb_id];?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">

<table width="620" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">등급</td>
		<td>
			<input type="text"  name="leb_level" value="<?=$view[leb_level]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">등급명</td>
		<td>
			<input type="text"  name="leb_name" value="<?=$view[leb_name]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
		</td>
	</tr>
	<? /*?>
	<? if ($sitemenu["mn_shop_use"]) { ?>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">할인율</td>
		<td>
			<input type="text"  name="leb_dc" value="<?=$view[leb_dc]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
		</td>
	</tr>
	<? } ?>
	<? */?>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./level_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>