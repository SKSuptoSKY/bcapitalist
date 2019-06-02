<?
include "../head.php";
include "./../shop/lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopsell"];
$PG_table2 = $GnTable["shopitem"];

$sql_where =" where 1 ";

if ($stx != "") {
    if ($sfl != "") {
        $sql_search.=" and $sfl like '%$stx%' ";
    }
	else {
		$sql_search.=" and se_it_id like '%$stx%' ";
	}
}


//날짜검색코드s
/*
if ($fmDt) {
	if ($fmDt==$toDt) {
		$sql_search.=" and pay_date like '{$fmDt}%' ";
		$g_wdate_like=1;
	}
	else {
		$sql_search.=" and pay_date>='{$fmDt}' ";
	}
}
if ($toDt) {
	if ($fmDt==$toDt) {
		if (!$g_wdate_like) {
			$sql_search.=" and g_wdate like '{$fmDt}%' ";
		}
	}
	else {
		$sql_search.=" and g_wdate<='{$toDt}' ";
	}
}
*/
//날짜검색코드e

$sql_common = " from {$PG_table} a left join {$PG_table2} b on (a.se_it_id=b.it_id) $sql_where $sql_search";


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
    $sst  = "se_total_num";
    $sod = "desc";
}
$sql_order = "order by $sst $sod ";

// 출력할 레코드를 얻음
$sql  = " select *
           $sql_common
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

$no_img="/images/no_img.jpg";
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
}

$list_total = count($list);

$qstr  = "sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx";

//순위
if ($page==1) {
	$rank_num=1;
} else {
	$rank_num=$rows*$page-$rows+1;
}
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./sell_update.php?mode=D&page=<?=$page?>&se_no=" +code;
}
function func_state(no,state) {
    if(confirm("해당결제를 승인하시겠습니까?"))
	document.location.href = "./forder_update.php?mode=E&page=<?=$page?>&fo_state="+state+"&fo_no=" +no;
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 상품별 매출</font></strong>
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
					<td width="50"></td>
					<td width="" align=center>
						<script src="/css/calendar-eraser_lim.js" type="text/javascript" charset="EUC-KR"></script>
						<link rel="stylesheet" href="/css/calendar-eraser_lim.css" />
						<!--
						<input name="fmDt" type="text" size="10" value="<?=$fmDt?>" readonly onfocus="showCalendarControl(this);"> ~
						<input name="toDt" type="text" size="10" value="<?=$toDt?>" readonly onfocus="showCalendarControl(this);">
						-->
						<select name=sfl>
							<option value='it_id' <? if ($sfl=="it_id") {?>selected<? } ?>>상품코드
							<option value='it_name' <? if ($sfl=="it_name") {?>selected<? } ?>>상품명
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
			<form name=fitemlistupdate method=post action="./game_listupdate.php" autocomplete='off'>
			<input type=hidden name=sca  value="<?=$sca?>">
			<input type=hidden name=sst  value="<?=$sst?>">
			<input type=hidden name=sod  value="<?=$sod?>">
			<input type=hidden name=sfl  value="<?=$sfl?>">
			<input type=hidden name=stx  value="<?=$stx?>">
			<input type=hidden name=page value="<?=$page?>">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
					<td width="8%">관리</td>
					<td width="10%" height=25><?=subject_sort_link("ca_id", "sca=$sca")?>분류</td>
					<td width="10%"><?=subject_sort_link("it_id", "sca=$sca")?>상품코드</a></td>
					<td width=""><?=subject_sort_link("it_name", "sca=$sca")?>상품명</a></td>
					<td width="10%"><?=subject_sort_link("se_total_num", "sca=$sca")?>판매수</a></td>
					<td width="10%"><?=subject_sort_link("se_total_amount", "sca=$sca")?>총매출액(원)</a></td>
				</tr>
				<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="javascript:chkDel('<?=$list[$i]["se_no"]?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td><?=category_name($list[$i]["ca_id"])?></td>
					<td><?=$list[$i]["se_it_id"]?></td>
					<td><?=$list[$i]["it_name"]?></td>
					<td><?=$list[$i]["se_total_num"]?></td>
					<td><?=number_format($list[$i]["se_total_amount"])?></td>
				</tr>
			<?
				} 
			?>
			<? if($i==0) { ?>
				<tr>
					<td colspan="20" align="center" height="80" bgcolor="#FFFFFF">등록된 제품이 없습니다.</td>
				</tr>
			<? } ?>
			</table>

			<table width="100%">
				<tr>
					<td align="center" style="padding-top:20px;"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>