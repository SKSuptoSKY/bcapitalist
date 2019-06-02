<?
include "../head.php";

$PG_table = $GnTable["bbsgroup"];
$JO_table = "";

if($mode=="E") {
	$sql = " select * from $PG_table where gr_id = '$id' ";
	$view = sql_fetch($sql);

	if (!$view[gr_id])
		alert("자료가 없습니다.");

	$title_page = $view[gr_name] . " 수정";

} else if($mode=="W") {
	$len = strlen($id);
	if ($len == 10)
		alert("메뉴를 더 이상 추가할 수 없습니다.\\n\\n5단계 메뉴까지만 가능합니다.");

	$len2 = $len + 1;

	$sql = " select MAX(SUBSTRING(gr_id,$len2,2)) as max_subid from $PG_table
			  where SUBSTRING(gr_id,1,$len) = '$id' ";
	$row = sql_fetch($sql);

	$subid = base_convert($row[max_subid], 36, 10);
	$subid += 36;
	if ($subid >= 36 * 36)
	{
		//alert("메뉴를 더 이상 추가할 수 없습니다.");
		// 빈상태로
		$subid = "  ";
	}
	$subid = base_convert($subid, 10, 36);
	$subid = substr("00" . $subid, -2);
	$subid = $id . $subid;

	$sublen = strlen($subid);

	if ($id) // 2단계이상 메뉴
	{
		$sql = " select * from $PG_table where gr_id = '$id' ";
		$ca = sql_fetch($sql);
		$title_page = $view[gr_name] . " 하위메뉴추가";
		$view[gr_name] = "";
	}
	else // 1단계 메뉴
	{
		$title_page = "1단계메뉴추가";
		$view[ca_use] = 1;
		$view[ca_explan_html] = 1;
		$view[ca_img_width]  = $GnShop[simg_width];
		$view[ca_img_height] = $GnShop[simg_height];
		$view[ca_list_mod] = 4;
		$view[ca_list_row] = 5;
		$view[ca_stock_qty] = 99999;
	}
	$view[ca_skin] = "list.skin.10.php";
}

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function fitemformcheck(form) {
	if (form.mode.value == "") {
		if (form.gr_id.value == '') {
			alert("코드가 없으면 생성 할 수 없습니다.");
			return false;
		}
		if (form.gr_name.value == '') {
			alert("메뉴명을 입력하셔햐 합니다.");
			return false;
		}
	} else {
		if (form.gr_name.value == '') {
			alert("메뉴명을 입력하셔햐 합니다.");
			return false;
		}
	}
	return true;
}

function inputch(form) {
	if(form.inputuse.checked==true) form.ca_input.disabled = false;
		else form.ca_input.disabled = true;
}
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

<form name=WriteForm method=post action="./bbs_group_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="type"  value="<?=$type?>">
<input type=hidden name="id"  value="<?=$id?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">

<table width="800" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">메뉴코드</td>
		<td>
		<? if ($mode == "W") { ?>
			<input type=text class=ed id=gr_id name=gr_id itemname='메뉴코드' size='<?=$sublen?>' maxlength='<?=$sublen?>' minlength='<?=$sublen?>' nospace alphanumeric value='<?=$subid?>' readonly>
		<? } else { ?>
			<input type=hidden name=gr_id value='<?=$view[gr_id]?>'><?=$view[gr_id]?>
			<!--<a href='./item_list.php?gr_id=<?=$view[gr_id]?>'>상품리스트</a>-->
		<? } ?>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">메뉴명</td>
		<td>
			<input type="text"  name="gr_name" value="<?=$view[gr_name]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./bbs_group_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>

<script language='javascript'>
	document.WriteForm.gr_name.focus();
</script>