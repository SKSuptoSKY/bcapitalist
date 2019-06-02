<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopdelivery"];
$JO_table = "";

// 테이블의 전체 레코드수만 얻음
$sql = " select COUNT(*) from $PG_table";
$row = sql_fetch($sql);
$total_count = $row[0];

$sql = "select * from $PG_table order by dl_order , dl_id desc ";
$result = sql_query($sql);
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
	document.location.href = "./delive_update.php?mode=D&page=<?=$page?>&id=" +code;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 배송회사 관리 리스트</font></strong>
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
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align="center">
				<tr align="center" bgcolor="#F6F6F6">
					<td width=100><a href="./delive_form.php?mode=W"><img src="/btn/btn_newup.gif" border=0></a></td>
					<td width=100>ID</td>
					<td>배송회사명</td>
					<td width=200>고객센터</td>
					<td width=150>배송사코드</td>
					<td width=100>순서</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;">
						<a href="delive_form.php?mode=E&id=<?=$list[$i][dl_id];?>"><font color="#0033FF">수정</font></a> / 
						<a href="javascript:chkDel('<?=$list[$i][dl_id];?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td align=center><?=$list[$i][dl_id]?></td>
					<td><?=stripslashes($list[$i][dl_company])?></td>
					<td align=center><?=$list[$i][dl_tel]?></td>
					<td align=center><?=$list[$i][de_code]?></td>
					<td align=center><?=$list[$i][dl_order]?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } ?>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>