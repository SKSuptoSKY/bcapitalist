<?
	$page_loc = "site";
	include "../head.php";

$PG_table = $GnTable["bbsconfig"];
$JO_table = "";

	$sql_search = " where 1 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.

 if (!$sitemenu["mn_shop_review_use"]) {
	$sql_search.= "and dbname !='shop_review' ";
 }
 if (!$sitemenu["mn_shop_qna_use"]) {
	$sql_search.= "and dbname !='shop_qna' ";
 }

	if($findword) $sql_search .= "and $findType like '%$findword%' ";
	if($bgr) $sql_search.= "and boardgroup='{$bgr}' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1) 
{
    $sort1  = "dbname";
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
	if($row[view]==TRUE) $list[$i][view] = "<font color=red>공개중</font>"; else $list[$i][view]  = "<font color=gray>비공개</font>";
	$count_sql = " select count(*) as cnt from {$GnTable[bbsitem]}{$list[$i][dbname]}";
	$count_row = sql_fetch($count_sql,FALSE);
	$list[$i][total] = $count_row[cnt];
}

$list_total = count($list);

$qstr = "findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function BoardClear(code) {
	yes_no = confirm('게시판의 모든 글이 삭제됩니다.\n\n게시판을 비우시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때 
		location.href='./bbs_update.php?mode=C&page=<?=$page?>&code='+code;
	} 
} 
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 게시판 관리 리스트</font></strong>
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
						<select name="bgr" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="">- 메뉴선택 - </option>
							<?=group_select($bgr);?>
						</select>
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
							<option value="dbname" <?if($findType=="dbname"){?>selected<?}?>>테이블명</option>
							<option value="skin" <?if($findType=="skin"){?>selected<?}?>>스킨명</option>
							<option value="page_loc" <?if($findType=="page_loc"){?>selected<?}?>>페이지코드</option>
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
					<td width=100>관리</td>
					<td>테이블명</td>
					<td>게시판제목</td>
					<td>메뉴명</td>
					<td>스킨명</td>
					<td>페이지코드</td>
					<td>등록글</td>
					<td>비우기</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;">
						<a href="./bbs_form.php?mode=E&id=<?=$list[$i][code];?>&page=<?=$page?>"><font color="#0033FF">수정</font></a>
					</td>
					<td><?=$list[$i][dbname]?></td>
					<td><a href="/bbs/board.php?tbl=<?=$list[$i][dbname]?>" target="_blank"><?=$list[$i][title]?></a></td>
					<td><?=group_name($list[$i][boardgroup])?></td>
					<td><?=$list[$i][skin]?></td>
					<td><?=$list[$i][page_loc]?></td>
					<td><?=$list[$i][total]?></td>
					<td><a href="javascript:BoardClear('<?=$list[$i][dbname];?>')">비우기</a></td>
				</tr>
			<? } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>