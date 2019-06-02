<?
	include "../head.php";

	$PG_table = $GnTable["online"];

	$sql_search = " where type = '$type' ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1) 
{
    $sort1  = "regist";
    $sort2 = "desc";
}
$sql_order = "order by $sort1 $sort2";


// 출력할 레코드를 얻음
$sql  = " select * from $PG_table $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($list[$i][visiteDate]==TRUE) $list[$i][visiteDate] = date("Y/m/d H시",$row[visiteDate]);
		else $list[$i][visiteDate] = "";
	if($row[viewch]==FALSE) $list[$i][view] = "<font color=red>미확인</font>"; else $list[$i][view]  = "<font color=gray>확인</font>";
}

$list_total = count($list);

$qstr = "type=$type&findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(id) {
    if(confirm("삭제하면 복구하실 수 없습니다.\n삭제하시겠습니까?")) 
	document.location.href = "./online_up.php?mode=D&type=<?=$type?>&page=<?=$page?>&num=" +id;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 온라인신청관리</font></strong>
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
			<input type=hidden name="type" value="<?=$type?>">
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
					<td>
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="username" <?if($findType=="username"){?>selected<?}?>>이름</option>
							<option value="phone" <?if($findType=="phone"){?>selected<?}?>>전화번호</option>
						</select> 
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">
						&nbsp;&nbsp;
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
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
					<td width="80">비고</td>
					<td>작성자</td>
					<td>제목</td>
					<td>전화번호</td>
					<td>핸드폰</td>
					<td>팩스</td>
					<td>이메일</td>
					<td>방문예정일</td>
					<td>확장1</td>
					<td>확장2</td>
					<td>등록일</td>
					<td>확인여부</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;">
						<a href="./online_view.php?mode=E&type=<?=$type?>&num=<?=$list[$i][num];?>"><font color="#0033FF">확인</font></a> / 
						<a href="javascript:chkDel('<?=$list[$i][num];?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td><?=$list[$i][username]?></td>
					<td><?=$list[$i][subject]?></td>
					<td><?=$list[$i][phone]?></td>
					<td><?=$list[$i][mobile]?></td>
					<td><?=$list[$i][fax]?></td>
					<td><?=$list[$i][email]?></td>
					<td style="color:red"><?=$list[$i][visiteDate];?></td>
					<td><?=$list[$i][option1]?></td>
					<td><?=$list[$i][option2]?></td>
					<td><?=date("Y/m/d H시",$list[$i][regist]);?></td>
					<td><?=$list[$i][view];?></td>
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