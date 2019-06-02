<?
include "../head.php";
include "./lib/lib.php";

$sql_search = "and d_it_id='$it_id' ";
$sql_common = " from $EX_table where 1 $sql_search";

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
    $sst  = "d_no";
    $sod = "desc";
}
$sql_order = "order by d_sort desc, $sst $sod";

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

$qstr  = "it_id=$it_id";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./item_detail_update.php?mode=D&d_it_id=<?=$it_id?>&page=<?=$page?>&d_no=" +code;
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> [ <?=get_it_value($it_id, "it_name")?> ] 추가 등록관리</font></strong>
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
			<form name=fitemlistupdate method=post action="./item_detail_listup.php" autocomplete='off'>
			<input type=hidden name="page" value="<?=$page?>">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#E6E6E6">

					<td width=80><a href='./item_detail_form.php?mode=W&it_id=<?=$it_id?>'><img src="/btn/btn_newup.gif" border=0 title='제품등록'></a></td>
					<td width=70 height=25>제품코드</td>
					<td width=70 height=25>확장1</td>
					<td width=70 height=25>확장2</td>
					<td width=70 height=25>확장3</td>
					<td width=70 height=25>확장4</td>
					<td width=70 height=25>확장5</td>
					<td width=70 height=25>확장6</td>
					<td width=70 height=25>확장7</td>
					<td width=70 height=25>확장8</td>
					<td width=70 height=25>확장9</td>
					<td width=70 height=25>확장10</td>
					<td width=70 height=25>원본 파일명</td>
					<td width=80 height=25>업로드된 실제파일명</td>
					<td width=60>노출순서</td>
					<td width=60>노출여부</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<input type="hidden" name="d_it_id[<?=$i?>]" value="<?=$list[$i]["d_it_id"]?>">
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="./item_detail_form.php?mode=E&d_no=<?=$list[$i]["d_no"]?>&<?=$qstr?>&page=<?=$page?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i]["d_no"]?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td align="center"><?=$list[$i]["d_it_id"]?></td>
					<td align="center"><?=$list[$i]["d_ex1"]?></td>
					<td align="center"><?=$list[$i]["d_ex2"]?></td>
					<td align="center"><?=$list[$i]["d_ex3"]?></td>
					<td align="center"><?=$list[$i]["d_ex4"]?></td>
					<td align="center"><?=$list[$i]["d_ex5"]?></td>
					<td align="center"><?=$list[$i]["d_ex6"]?></td>
					<td align="center"><?=$list[$i]["d_ex7"]?></td> 
					<td align="center"><?=$list[$i]["d_ex8"]?></td>
					<td align="center"><?=$list[$i]["d_ex9"]?></td>
					<td align="center"><?=$list[$i]["d_ex10"]?></td>
					<td align="center"><?=$list[$i]["d_file_oname"]?></td>
					<td align="center"><?=$list[$i]["d_file_rname"]?></td>
					<td align="center"><?=$list[$i]["d_sort"]?></td>
					<td align="center"><?=$list[$i]["d_use"]=="1" ? "노출" : "노출안함";?></td>
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
					<td width="100%" align="center"><img src="/btn/btn_list.gif" style="cursor:pointer;" onclick="javascript:history.go('-1');"></td>
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