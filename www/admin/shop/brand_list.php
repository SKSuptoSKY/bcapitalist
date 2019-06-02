<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopbrand"];
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
    $sort1  = "br_id";
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
	if($row[br_use]==TRUE) $list[$i][view] = "<font color=red>공개중</font>"; else $list[$i][view]  = "<font color=gray>비공개</font>";
	$br_img = "";
	if ($row[br_url] && $row[br_url] != "http://")
		$br_img .= "<a href='$row[br_url]' target=_blank>";
	$br_img .= "<img src='/shop/data/brand/$row[br_id]' border='0' alt='$row[br_alt]'></a>";
	$list[$i]["IMG"] = $br_img;
}

$list_total = count($list);

$qstr = "findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?")) 
	document.location.href = "./brand_update.php?mode=D&page=<?=$page?>&id=" +code;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 브랜드</font></strong>
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
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6"> 
					<td width=100><a href="./brand_form.php?mode=W"><img src="/btn/btn_newup.gif" border=0></a></td>
					<td>ID</td>
					<td>이미지</td>
					<td>브랜드명</td>
					<td>주소</td>
					<td>보이기</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;">
						<a href="brand_form.php?mode=E&id=<?=$list[$i][br_id];?>"><font color="#0033FF">수정</font></a> / 
						<a href="javascript:chkDel('<?=$list[$i][br_id];?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td align=center><?=$list[$i][br_id]?></td>
					<td><?=$list[$i]["IMG"]?></td>
					<td><?=$list[$i][br_name]?></td>
					<td><?=$list[$i][br_url]?></td>
					<td><?=$list[$i][view]?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>