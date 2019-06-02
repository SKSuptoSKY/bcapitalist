<?
$page_loc = "site";
include "../head.php";

$cate_array = array('국문','영문');

$PG_table = "Gn_Curriculum_File";

$sql_search = " where f_type='$type' ";

$sql_order = "order by f_no asc";


// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table $sql_search";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함



// 출력할 레코드를 얻음
$sql  = " select * from $PG_table
		   $sql_search
           $sql_order
		   limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
}

$list_total = count($list);

?>

<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./update.php?mode=D&page=<?=$page?>&f_id=" +code;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 파일 관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="30%" border="0" cellspacing="0" cellpadding="0" align="left">
	<tr>
		<td style="padding-left:10px;">
			<table width="100%" cellpadding="6" cellspacing="1" border="0" bgcolor="#cccccc">
				<tr>
					<td bgcolor="#F7F7F7" width="50" align="center"><strong>분류</strong></td>
						<?for($i=0; $i < count($cate_array); $i++){?>
							<td bgcolor="#ffffff" align="center" style="<?=($type == $i)?'font-weight:bold;color:#000082':'';?>">
							<a href="<?=$_SERVER[PHP_SELF]?>?type=<?=$i?>"><?=$cate_array[$i]?></a></td>
						<?}?>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
					<td width=120>
						<?if($list_total<2 && ($type==0 || $type==1)){?><a href="./form.php?mode=W&type=<?=$type?>"><img src="/btn/btn_newup.gif" border=0></a><?}?>
					</td>
					<td>페이지</td>
					<td>파일 다운로드</td>
				</tr>
			<?	for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;padding-left:5px;" align="center">
						<a href="form.php?mode=E&id=<?=$list[$i][f_id];?>&type=<?=$type?>&page=<?=$page?>"><font color="#0033FF">수정</font></a> 
						<!-- /<a href="javascript:chkDel('<?=$list[$i][f_id]?>')"><font color="#FF3300">삭제</font></a> -->
					</td>
					<td><?=$list[$i]["f_subject"]?></td>
					<td>
					<a href="/admin/lib/download.php?fileurl=/curriculum/data/item/<?=$list[$i]["f_id"]?>&filename=<?=$list[$i]["f_real_name"]?>">
					<?=$list[$i]["f_real_name"]?>
					</a>
					</td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? }?>
			<table width="100%">
				<tr>
					<td width="50%" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
</form>