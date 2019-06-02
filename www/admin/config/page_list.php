<?
include "../head.php";

$PG_table = $GnTable["pageitem"];

$where = " and ";
$sql_search = "";

$sql_search = " where 1 ";
if ($sfl == "")  $sfl = "pg_code";

if($stx) $sql_search.= "and $sfl like '%$stx%' ";
if($bgr) $sql_search.= "and pg_group='{$bgr}' ";
$sql_common = " from $PG_table $sql_search";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sst)
{
    $sst  = "pg_no";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

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

$qstr  = "sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./page_update.php?mode=D&page=<?=$page?>&pg_no=" +code;
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 제품목록 관리</font></strong>
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
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
					<td width="50"><a href='<?=$_SERVER[PHP_SELF]?>'>처음</a></td>
					<td width="" align=center>
						<select name="bgr" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="">- 메뉴선택 - </option>
							<?=group_select($bgr);?>
						</select>
						<select name=sfl>
							<option value='pg_code' <?if($sfl=="pg_code"){?>selected<?}?>>페이지코드
							<option value='pg_subject' <?if($sfl=="pg_subject"){?>selected<?}?>>제목
						</select>
						<? if ($sel_field) echo "<script> document.flist.sel_field.value = '$sel_field';</script>"; ?>
						<input type=text name=stx value='<?=$stx?>'>
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
					<td width="50" align="right">건수 : <? echo $total_count ?>&nbsp;</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<form name=fitemlistupdate method=post action="./page_listupdate.php" autocomplete='off'>
			<input type=hidden name=sca  value="<?=$sca?>">
			<input type=hidden name=sst  value="<?=$sst?>">
			<input type=hidden name=sod  value="<?=$sod?>">
			<input type=hidden name=sfl  value="<?=$sfl?>">
			<input type=hidden name=stx  value="<?=$stx?>">
			<input type=hidden name=page value="<?=$page?>">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
				<td width="10%" height="25"><a href='./page_form.php?mode=W'><img src="/btn/btn_newup.gif" border=0 title='제품등록'></a></td>
				<td width="10%"><?=subject_sort_link("pg_code", "sca=$sca")?>페이지코드</a></td>
				<td width="10%"><?=subject_sort_link("pg_group", "sca=$sca")?>그룹</a></td>
				<td width=''><?=subject_sort_link("pg_subject", "sca=$sca")?>제목</a></td>
				<td width='10%'><?=subject_sort_link("pg_wdate", "sca=$sca")?>등록일</a></td>
			</tr>
			<?
				for ($i=0; $i<$list_total; $i++) {
					$gallery = $list[$i][it_gallery] ? "Y" : "";

					$tmp_ca_list  = "<select id='ca_id_$i' name='ca_id[$i]'>" . $ca_list;
					$tmp_ca_list .= "<script language='javascript'>document.getElementById('ca_id_$i').value='{$list[$i][ca_id]}';</script>";
			?>
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="./page_form.php?mode=E&ca_id=<?=$list[$i]["ca_id"]?>&pg_no=<?=$list[$i]["pg_no"]?>&<?=$qstr?>&page=<?=$page?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i]["pg_no"]?>')"><font color="#FF3300">삭제</font></a> /
						<a href="<?=$list[$i]["URL"]?>" target="_blank"><font color="#0C9060">보기</font></a>
					</td>
					<td><?=$list[$i]["pg_code"]?></td>
					<td><?=group_name($list[$i]["pg_group"])?></td>
					<td align="left"><?=$list[$i]["pg_subject"]?></td>
					<td><?=$list[$i]["pg_wdate"]?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr>
					<td colspan="20" align="center" height="80" bgcolor="#FFFFFF">등록된 제품이 없습니다.</td>
				</tr>
			<? } ?>
			</table>

			<table width="100%">
				<tr>
					<td width="50%"><!--<input type="submit" value="일괄수정" accesskey="s">--></td>
					<td width="50%" align="right"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>