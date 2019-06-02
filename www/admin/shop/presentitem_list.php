<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoppresent"];
$JO_table = $GnTable["shopitem"];

$type = "1";   ///////////// 타입을 구분합니다. 0 => 구매가격별 증정품 , 1 => 개별상품별 증정품

$sql_common = " from $PG_table where pr_type = " . $type;

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
    $sst  = "pr_id";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";

	$page_title = "<a href='./presentpay_list.php?type=0'>구매 가격 증정품</a>&nbsp;&nbsp;&nbsp;&nbsp;<b>개별 상품 증정품</b>";
	$sql_common = "from $PG_table a, $JO_table b, $JO_table c where a.pr_type = " . $type ." and b.it_id = a.item_num and c.it_id = a.pritem_num";

// 출력할 레코드를 얻음
$sql  = " select  a.* , b.it_name as item_name, c.it_name as pritem_name 
           $sql_common
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($row[p_view]==TRUE) $list[$i][view] = "<font color=red>공개중</font>"; else $list[$i][view]  = "<font color=gray>비공개</font>";
}

$list_total = count($list);

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?")) 
	document.location.href = "./present_formupdate.php?mode=D&page=<?=$page?>&id=" +code;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$page_title?></font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" cellpadding=0 cellspacing=0>
	<tr>
		<td width="50%"></td>
		<td width="50%" align="right">건수 : <? echo $total_count ?></td>
	</tr>
</table>

<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align="center">
<form name=fpresentlist method='post' action='./present_listupdate.php' autocomplete='off' style="margin:0px;">
<input type=hidden name=page  value='<? echo $page ?>'>
<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
<input type=hidden name=sort2 value='<? echo $sort2 ?>'>
<input type=hidden name=type value='<? echo $type ?>'>
<tr align="center" bgcolor="#F6F6F6">
	<td width=100><a href="./present_form.php?mode=W&type=<?=$type?>"><img src="/btn/btn_newup.gif" border=0></a></td>
	<td width='' height=25><?=subject_sort_link("item_name");?>적용상품</a></td>
	<td width=''><?=subject_sort_link("pritem_name");?>증정품</a></td>
	<td width=100 align=center><?=subject_sort_link("odto_pay");?>적용가격</a></td>
	<td width=100 align=center><?=subject_sort_link("pr_num");?>증정갯수</a></td>
	<td width=25 align=center><?=subject_sort_link("pr_state");?>상태</a></td>
</tr>
<? for ($i=0; $i<$list_total; $i++) { ?>
	<tr align="center" bgcolor="#FFFFFF"> 
	<input type=hidden name='pr_id[<?=$i?>]' value='<?=$list[$i][pr_id];?>'>
		<td style="font-weight:bold;">
			<a href="present_form.php?mode=E&id=<?=$list[$i][pr_id];?>"><font color="#0033FF">수정</font></a> / 
			<a href="javascript:chkDel('<?=$list[$i][pr_id];?>')"><font color="#FF3300">삭제</font></a>
		</td>
		<td align=left><a href='./item_form.php?mode=E&it_id=<?=$list[$i][item_num]?>'><?=cut_str($list[$i][item_name],25)?></a></td>
		<td align=left><a href='./item_form.php?mode=E&it_id=<?=$list[$i][pritem_num]?>'><?=cut_str($list[$i][pritem_name],25)?></a></td>
		<td align=center><input type=text name='odto_pay[<?=$i?>]' value='<?=number_format($list[$i][odto_pay])?>' title='<?=$list[$i][pr_id]?>' itemname='분류명' size=10></td>
		<td align=center><input type=text name='pr_num[<?=$i?>]' value='<?=number_format($list[$i][pr_num])?>' title='<?=$list[$i][pr_num]?>' itemname='증정갯수' size=5></td>
		<td align=center><input type=checkbox name='pr_state[<?=$i?>]' <?=($list[$i][pr_state] ? "checked" : "")?> value='1'></td>
	</tr>
<? } ?>
<? if($i==0) { ?>
	<tr align="center" bgcolor="#FFFFFF">
		<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
	</tr>
<? } ?>
</table>


<table width=100%>
<tr>
    <td width=50%><input type=submit class=btn1 value='일괄수정'></td>
    <td width=50% align=right>
		<?=get_paging(10, $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?>
	</td>
</tr>
</form>
</table>