<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopcategory"];
$JO_table = "";

	$sql_search = " where 1 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = 40;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1)
{
    $sort1  = "ca_id";
    $sort2 = "asc";
}
$sql_order = "order by $sort1 $sort2";


// 출력할 레코드를 얻음
$sql  = " select * from $PG_table
		   $sql_search
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($row[p_view]==TRUE) $list[$i][view] = "<font color=red>공개중</font>"; else $list[$i][view]  = "<font color=gray>비공개</font>";
}

$list_total = count($list);

$qstr = "findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./category_update.php?mode=D&page=<?=$page?>&id=" +code;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 카테고리 관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
					<td>
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="ca_id" <?if($findType=="ca_id"){?>selected<?}?>>분류코드</option>
							<option value="ca_name" <?if($findType=="ca_name"){?>selected<?}?>>분류명</option>
						</select>
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?$findword?>"> <input type=image src='/btn/btn_search.gif' align="absmiddle">
					</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
					<td width=120><a href="./category_form.php?mode=W"><img src="/btn/btn_newup.gif" border=0></a></td>
					<td width=80>분류코드</td>
					<td>분류명</td>
					<td width=80>판매가능</td>
					<td width=80>상품보기</td>
				</tr>
<form name=fcategorylist method='post' action='./category_listup.php' autocomplete='off' style="margin:0px;">
<input type=hidden name=page  value='<? echo $page ?>'>
<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
<input type=hidden name=sort2 value='<? echo $sort2 ?>'>
			<?
				for ($i=0; $i<$list_total; $i++) {
					$s_level = "";
					$level = strlen($list[$i][ca_id]) / 2 - 1;
					if ($level > 0) // 2단계 이상
					{
						$s_level = "&nbsp;&nbsp;<img src='/btn/icon_cate.gif' border=0 width=17 height=15 align=absmiddle alt='".($level+1)."단계 분류'>";
						for ($k=1; $k<$level; $k++)
							$s_level = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $s_level;
						$style = " class='text'";
					}
					else // 1단계
					{
						$style = " style='width:90%;border:1 solid; border-color:#0071BD;' ";
					}
			?>
				<tr align="center" bgcolor="#FFFFFF">
				<input type=hidden name='ca_id[<?=$i?>]' value='<?=$list[$i][ca_id]?>'>
					<td style="font-weight:bold;padding-left:5px;" align="left">
						<a href="category_form.php?mode=E&id=<?=$list[$i][ca_id];?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i][ca_id];?>')"><font color="#FF3300">삭제</font></a>
					<? if($level<5) { ?> /
						<a href="category_form.php?mode=W&id=<?=$list[$i][ca_id];?>"><font color="#0C9060">하위</font></a>
					<? } ?>
					</td>
					<td><?=$list[$i]["ca_id"]?></td>
					<td align="left"><?=$s_level?> <input type=text name='ca_name[<?=$i?>]' value='<?=get_text($list[$i][ca_name])?>' title='<?=$list[$i][ca_id]?>' required itemname='분류명' <?=$style?>></td>
					<td><input type=checkbox name='ca_use[<?=$i?>]' <?=($list[$i][ca_use] ? "checked" : "")?> value='1'></td>
					<td><a href='./item_list.php?sca=<?=$list[$i][ca_id]?>'>보기</a></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } else { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="30"><input type=submit class=btn1 value='일괄수정'></td>
				</tr>
			<? } ?>
</form>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>
