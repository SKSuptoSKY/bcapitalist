<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];


$sql_search = "and poll_parent='$poll_parent' ";
$sql_common = " from $JO_table where 1 $sql_search";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 30;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sst)
{
    $sst  = "poll_num";
    $sod = "desc";
}
$sql_order = "order by poll_sort desc, $sst $sod";

// 출력할 레코드를 얻음
$sql  = " select *
           $sql_common
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
}

$list_total = count($list);

$qstr  = "poll_parent=$poll_parent";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./poll_question_update.php?mode=D&poll_parent=<?=$poll_parent?>&page=<?=$page?>&poll_num=" +code;
}

function poll_score(val) {
	var window_left = (screen.width-510)/2;
	//var window_top = (screen.height-220)/2;
	var window_top = (screen.height-500)/2;
	if(!val) val="";
	window.open('/admin/poll/poll_score.php?poll_num='+val,'POLL_SCORE',"width=630,height=300,status=no,scrollbars=yes,top=" + window_top + ",left=" + window_left); 
}

</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> [ <?=get_poll_value($poll_parent, "poll_subject")?> ] 문항 등록관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<script language='JavaScript' src='./lib/javascript.js'></script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<form name=fpolllistupdate method=post action="./poll_detail_listup.php" autocomplete='off'>
			<input type=hidden name="page" value="<?=$page?>">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#E6E6E6">

					<td width=80><a href='./poll_question_form.php?mode=W&poll_parent=<?=$poll_parent?>'><img src="/btn/btn_newup.gif" border=0 title='문항등록'></a></td>
					<td height=25>질문</td>
					<td width=80 height=25>결과보기</td>
					<td width=60>노출순서</td>
					<td width=60>노출여부</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<input type="hidden" name="poll_num[<?=$i?>]" value="<?=$list[$i]["poll_num"]?>">
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;height:30px;">
						<a href="./poll_question_form.php?mode=E&poll_num=<?=$list[$i]["poll_num"]?>&<?=$qstr?>&page=<?=$page?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i]["poll_num"]?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td align="center"><?=$list[$i]["poll_question"]?></td>
					<td align="center"><img src="../images/btn_view.gif" border="0" alt="보기" align="absmiddle" onclick="javascript:poll_score('<?=$list[$i]["poll_num"]?>');" style="cursor:pointer"></td>
					<td align="center"><?=$list[$i]["poll_sort"]?></td>
					<td align="center"><?=$list[$i]["poll_use"]=="1" ? "노출" : "노출안함";?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr>
					<td colspan="16" align="center" height="80" bgcolor="#FFFFFF">등록된 리스트가 없습니다.</td>
				</tr>
			<? } ?>
			</table>

			</form>
			<table width="100%">
				<tr>
					<td width="100%" align="right">
					<a href="./poll_list.php">
					<img src="/btn/btn_list.gif" style="cursor:pointer;">
					</a>
					</td>
				</tr>
			</table>

			<table width="100%">
				<tr>
					<td width="100%" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>