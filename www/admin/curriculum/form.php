<?
$page_loc = "files";
include "../head.php";

$PG_table = " Gn_Curriculum_File ";

if($mode=="E") {
	$sql = " select * from $PG_table where f_id = '$id' ";
	$view = sql_fetch($sql);

	if (!$view[f_id])
		alert("자료가 없습니다.");

	$title_page = " 파일 수정";

} else if($mode=="W") {
	$title_page = " 파일 추가";
}

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function fitemformcheck(form) {
	if (form.f_subject.value == '') {
		alert("제목을 입력하세요.");
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
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"><?=$title_page?></font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form name=WriteForm method=post action="./update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="page" value="<?=$page?>">
<input type="hidden" name="type" value="<?=$type?>">
<?if($mode=="W"){?>
<input type=hidden name="f_id" value="<?=time()?>">
<?}else{?>
<input type=hidden name="f_id" value="<?=$id?>">
<?}?>

<table width="50%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">페이지</td>
		<td>
			<!-- <input type="text"  name="f_subject" value="<?=$view[f_subject]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> -->
			<?=$view[f_subject]?>
			<input type="hidden" name="f_subject" value="<?=$view[f_subject]?>">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">파일</td>
		<td>
			<input type="file"  name="f_file" style="width:100%; height:20px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
			<?if($view[f_real_name]){?>
			<br><?=$view[f_real_name]?><input type="checkbox" name="file_del" value='1'>삭제
			<?}?>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./list.php?type=<?=$type?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>