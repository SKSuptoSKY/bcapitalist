<?
	include "../head.php";

$PG_table = $GnTable["member"];
$JO_table = $GnTable["memberlevel"];

	$sql_search = " where mem_leb = 0 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = $default[page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1) 
{
    $sort1  = "first_regist";
    $sort2 = "desc";
}
$sql_order = "order by $sort1 $sort2";


// 출력할 레코드를 얻음
$sql  = " select a.*, b.leb_name from $PG_table a left join $JO_table b on (a.mem_leb = b.leb_level)
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($list[$i][mem_sex]=="m") { $list[$i][mem_sex] = "남"; } else { $list[$i][mem_sex] = "여"; }
}

$list_total = count($list);

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(id) {
    if(confirm("회원을 삭제하면 게시판 및 기타 프로그램에서는 삭제되지 않습니다.\n\n연결된 타 프로그램에 오류가 발생할 수 있습니다.\n\n삭제하시겠습니까?")) 
	document.location.href = "./member_update.php?mode=D&page=<?=$page?>&id=" +id;
}
function chkExe(id) {
    if(confirm("탈퇴하시면 같은 아이디로는 가입하실 수 없습니다.\n탈퇴하시겠습니까?")) 
	document.location.href = "./member_update.php?mode=X&page=<?=$page?>&id=" +id;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 회원관리</font></strong>
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
							<option value="mem_name" <?if($findType=="mem_name"){?>selected<?}?>>이름</option>
							<option value="mem_id" <?if($findType=="mem_id"){?>selected<?}?>>아이디</option>
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
					<td width=100></td>
					<td>아이디</td>
					<td>성별</td>
					<td>가입일</td>
					<td>최근접속일</td>
					<td>탈퇴일</td>
					<td>방문횟수</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;">
						<a href="javascript:chkDel('<?=$list[$i][mem_id];?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td><?=$list[$i][mem_id]?></td>
					<td><?=$list[$i][mem_sex]?></td>
					<td><?=substr($list[$i][first_regist],0,10)?></td>
					<td><?=substr($list[$i][last_regist],0,10)?></td>
					<td><?=substr($list[$i][last_modify],0,10)?></td>
					<td><?=number_format($list[$i][visited])?></td>
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