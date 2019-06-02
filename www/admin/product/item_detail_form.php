<?
include "../head.php";
include "./lib/lib.php";

$title_page = "추가";

if ($mode=="W") {
	$title_page .= "입력";

} else if ($mode=="E") {
	$title_page .= "수정";
	$sql = " select * from $EX_table where d_no = '$d_no' ";

	$detail = sql_fetch($sql);
	$it_id = $detail["d_it_id"];

} else {
	alert("잘못된 경로로 접근하셨습니다.");
}


$qstr = "it_id=$it_id&sca=$sca&page=$page";
?>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9">  [ <?=get_it_value($it_id, "it_name")?> ] <?=$title_page?></font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form name=WriteForm method=post action="./item_detail_update.php" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="d_no" value="<?=$d_no?>">
<input type=hidden name="sca" value="<?=$sca?>">
<input type="hidden" name="it_id" value="<?=$detail[d_it_id]?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">제품코드</td>
		<td>
			<?=$it_id?>
			<input type="hidden" name="d_it_id" value="<?=$it_id?>">
		</td>
	</tr>
</table>

<br>
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장1</td>
		<td>
			<input type="text"  name="d_ex1" value="<?=$detail[d_ex1]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장2</td>
		<td>
			<input type="text"  name="d_ex2" value="<?=$detail[d_ex2]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장3</td>
		<td>
			<input type="text"  name="d_ex3" value="<?=$detail[d_ex3]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장4</td>
		<td>
			<input type="text"  name="d_ex4" value="<?=$detail[d_ex4]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장5</td>
		<td>
			<input type="text"  name="d_ex5" value="<?=$detail[d_ex5]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장6</td>
		<td>
			<input type="text"  name="d_ex6" value="<?=$detail[d_ex6]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장7</td>
		<td>
			<input type="text"  name="d_ex7" value="<?=$detail[d_ex7]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장8</td>
		<td>
			<input type="text"  name="d_ex8" value="<?=$detail[d_ex8]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장9</td>
		<td>
			<input type="text"  name="d_ex9" value="<?=$detail[d_ex9]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">확장10</td>
		<td>
			<input type="text"  name="d_ex10" value="<?=$detail[d_ex10]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>
</table>

<br>
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">이미지등록</td>
		<td>
			<input type="file" name="fileup" style="width:200px; height:25px;" class="text" value="<?=$detail[d_file_oname]?>">
			<? if($detail[d_file_oname]!="") { ?>
				 기존 파일 : <?=$detail[d_file_oname]?> &nbsp;&nbsp;
				<input type="checkbox" name="delet_file" value="D" />삭제
			<? } ?>
		</td>
	</tr>

	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">노출여부</td>
		<td>
			<input type="checkbox" name='d_use' <? echo ($detail[d_use] || $mode=="W") ? "checked" : ""; ?> value='1'> 예
		</td>
	</tr>

	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">노출순서</td>
		<td>
			<input type="text" name='d_sort' value="<?=$detail[d_sort]?>" size="5"> &nbsp; <span style="color:#ff0000;">* 숫자가 클수록 상위에 게시됩니다.</span>
		</td>
	</tr>

</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" border=0>
			<a href="./item_detail_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>
