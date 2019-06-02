<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopcategory"];
$JO_table = "";

if($mode=="E") {
	$sql = " select * from $PG_table where ca_id = '$id' ";
	$view = sql_fetch($sql);

	if (!$view[ca_id])
		alert("자료가 없습니다.");

	$title_page = $view[ca_name] . " 수정";

} else if($mode=="W") {
	$len = strlen($id);
	if ($len == 10)
		alert("분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");

	$len2 = $len + 1;

	$sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from $PG_table
			  where SUBSTRING(ca_id,1,$len) = '$id' ";
	$row = sql_fetch($sql);

	$subid = base_convert($row[max_subid], 36, 10);
	$subid += 36;
	if ($subid >= 36 * 36)
	{
		//alert("분류를 더 이상 추가할 수 없습니다.");
		// 빈상태로
		$subid = "  ";
	}
	$subid = base_convert($subid, 10, 36);
	$subid = substr("00" . $subid, -2);
	$subid = $id . $subid;

	$sublen = strlen($subid);

	if ($id) // 2단계이상 분류
	{
		$sql = " select * from $PG_table where ca_id = '$id' ";
		$ca = sql_fetch($sql);
		$title_page = $view[ca_name] . " 하위분류추가";
		$view[ca_name] = "";
	}
	else // 1단계 분류
	{
		$title_page = "1단계분류추가";
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
		if (form.ca_id.value == '') {
			alert("코드가 없으면 생성 할 수 없습니다.");
			return false;
		}
		if (form.ca_name.value == '') {
			alert("분류명을 입력하셔햐 합니다.");
			return false;
		}
	} else {
		if (form.ca_name.value == '') {
			alert("분류명을 입력하셔햐 합니다.");
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

<form name=WriteForm method=post action="./category_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="type"  value="<?=$type?>">
<input type=hidden name="id"  value="<?=$id?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">분류코드</td>
		<td>
		<? if ($mode == "W") { ?>
			<input type=text class=ed id=ca_id name=ca_id itemname='분류코드' size='<?=$sublen?>' maxlength='<?=$sublen?>' minlength='<?=$sublen?>' nospace alphanumeric value='<?=$subid?>' readonly>
		<? } else { ?>
			<input type=hidden name=ca_id value='<?=$view[ca_id]?>'><?=$view[ca_id]?>
			<!--<a href='./item_list.php?ca_id=<?=$view[ca_id]?>'>상품리스트</a>-->
		<? } ?>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">분류명</td>
		<td>
			<input type="text"  name="ca_name" value="<?=$view[ca_name]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
		</td>
	</tr>
	<!--
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">스킨파일</td>
		<td>
			<select id=ca_skin name=ca_skin>
			<?
				echo get_file_options("^list.skin.(.*)\.php", $GnShop["skin_dir"]);
			?>
			</select>
			<script>document.getElementById('ca_skin').value='<?=$view[ca_skin]?>';</script>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">상단이미지</td>
		<td>
			<input type="file" name="ca_timg" style="width:90%; height:19px;" class="text">
			<?
			$img = "/shop/data/design/{$view[ca_id]}_Top";
			if (file_exists($_SERVER["DOCUMENT_ROOT"].$img)) {
				echo "<input type=checkbox name=ca_timg_del value='1'>삭제";
			}
			?>
		</td>
	</tr>
	-->
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px;">판매가능</td>
		<td><input type=checkbox name='ca_use' <? echo ($view[ca_use]) ? "checked" : ""; ?> value='1'> 체크하셔야 페이지에서 보입니다.</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./category_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>

<script language='javascript'>
	document.WriteForm.ca_name.focus();
</script>