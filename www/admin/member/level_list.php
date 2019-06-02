<?
	include "../head.php";

	$PG_table = $GnTable["memberlevel"];
	$JO_table = "";

	$sql_search = " where 1 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1) 
{
    $sort1  = "leb_level";
    $sort2 = "desc";
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
	document.location.href = "./level_update.php?mode=D&page=<?=$page?>&id=" +code;
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

<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr> 
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
				<form name=searchForm method=get action="<?=$PHP_SELF;?>">
				<input type=hidden name=level value="<?=$level;?>">
					<td align="right">
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="leb_level" <?if($findType=="leb_level"){?>selected<?}?>>등급</option>
							<option value="leb_name" <?if($findType=="leb_name"){?>selected<?}?>>등급명</option>
							<? /*?>
							<? if ($sitemenu["mn_shop_use"]) { ?>
							<option value="leb_dc" <?if($findType=="leb_dc"){?>selected<?}?>>할인율</option>
							<? } ?>
							<? */?>
						</select>
						<input type="text" name="findword" value="<?=$findword?>" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
						<input type=image src="/btn/btn_search.gif" border="0" align="absmiddle">
					</td>
				</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td align="center">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6"> 
					<td width=100><a href="./level_form.php?mode=W"><img src="/btn/btn_newup.gif" border=0></a></td>
					<td>등급</td>
					<td>등급명</td>
					<? /*?>
					<? if ($sitemenu["mn_shop_use"]) { ?>
					<td>할인율</td>
					<? } ?>
					<? */?>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;">
						<a href="level_form.php?mode=E&id=<?=$list[$i][leb_id];?>"><font color="#0033FF">수정</font></a> / <a href="javascript:chkDel('<?=$list[$i][leb_level]?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td><?=$list[$i][leb_level];?></td>
					<td><?=$list[$i][leb_name];?></td>
					<? /*?>
					<? if ($sitemenu["mn_shop_use"]) { ?>
					<td><?=$list[$i][leb_dc];?></td>
					<? } ?>
					<? */?>
				</tr>
			<? } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>