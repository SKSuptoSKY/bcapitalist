<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoppresent"];
$JO_table = $GnTable["shopitem"];

if ($mode == "E") 
{
	$title_page = "증정품 수정";

	$sql = " select * from $PG_table where pr_id = '$id' ";
	$view = sql_fetch($sql);
	if (!$view[pr_id]) 
		alert("자료가 없습니다.");
} else {
	$title_page = "증정품 추가";

	$view[pr_type] = $type;
}

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";

if ($view[pr_type]) $listurl = "./presentitem_list.php?".$qstr;
	else  $listurl = "./presentpay_list.php?".$qstr;
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function fitemformcheck(form) {
	if(!form.pritem_num.value) {
		alert('증정품을 선택하셔햐 합니다.');
		form.pritem_num.focus();
		return false;
	}
	return true;
}
document.WriteForm.pritem_num.focus();
//-->
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

<form name=WriteForm method=post action="./present_formupdate.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode"	value="<?=$mode?>">
<input type=hidden name="type"		value="<?=$view[pr_type]?>">
<input type=hidden name="id"			value="<?=$id?>">
<input type=hidden name="page"	value="<?=$page?>">
<input type=hidden name="sort1"	value="<?=$sort1?>">
<input type=hidden name="sort2"	value="<?=$sort2?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
<? if($view[pr_type]){ ?>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">적용상품</td>
		<td>
			<select name='item_num'>
				<? item_namelist($view[item_num]) ?>
			</select>
		</td>
	</tr>
<? } ?>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">증정품 <font color="#ff6600"> <b>*</b></font></td>
		<td>
			<select name='pritem_num'>
				<? item_namelist($view[pritem_num]) ?>
			</select>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">적용가격</td>
		<td>
			<input type="text"  name="odto_pay" value="<?=number_format($view[odto_pay])?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">증정갯수</td>
		<td>
			<input type="text"  name="pr_num" value="<?=number_format($view[pr_num])?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">증정적용</td>
		<td>
			<input type=checkbox name='pr_state' <? echo ($view[pr_state]) ? "checked" : ""; ?> value='1'> 체크하시면 증정품이 적용됩니다.
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="<?=$listurl?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>