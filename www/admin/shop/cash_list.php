<?
$page_loc="order";
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopreceipt"];
$JO_table = $GnTable["member"];

if($findword != "") $sql_search = "and `".$findType."` like '%".$findword."%' ";

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
    $sst  = "cash_id";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";

$sql_common = " $PG_table a, $JO_table c where a.cash_mid = c.mem_id ";

// 출력할 레코드를 얻음
$sql  = " select a.*, c.mem_name, c.mem_code from 
           $sql_common 
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($row[cash_type] =="01") $list[$i][cash_type]="소득공제용";
		else if($row[cash_type] =="02")  $list[$i][cash_type]="지출증빙용";
}

$list_total = count($list);

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 현금영수증 발급 리스트</font></strong>
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
		<form name=fcategorylist method='post' action='./cash_listup.php' autocomplete='off' style="margin:0px;">
		<input type=hidden name=page  value='<? echo $page ?>'>
		<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
		<input type=hidden name=sort2 value='<? echo $sort2 ?>'>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6"> 
					<td height="30" align="center"><strong>주문번호</strong></td>
					<td align="center"><strong>주문자명</strong></td>
					<td align="center"><strong>거래구분</strong></td>
					<td align="center"><strong>공급가액</strong></td>
					<td align="center"><strong>부가세</strong></td>
					<td align="center"><strong>영수금액</strong></td>
					<td align="center"><strong>발급일자</strong></td>
					<td align="center"><strong>상태</strong></td>
					<td align="center"><strong>취소상태</strong></td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
				<input type=hidden name='cash_id[<?=$i?>]' value='<?=$row[cash_id]?>'>
					<td height="25" align="center"><a href="/admin/shop/order_view.php?od_id=<?=$row[od_id]?>"><?=$row[od_id]?></a></td>
					<td align="center"><a href="/admin/member/view.php?num=<?=$row[num]?>"><?=$row[username]?></a></td>
					<td align="center"><?=$row[cash_type]?></td>
					<td align="center"><?=number_format($row[cash_item])?></td>
					<td align="center"><?=number_format($row[cash_vp])?></td>
					<td align="center"><?=number_format($row[cash_all])?></td>
					<td align="center"><?=date("Y/m/d H시",$row[cash_time])?></td>
					<td align="center">
						<? if($row[cash_state]=="발급취소") {?>
								<font color=gray>발급취소</font>
						<? } else if($row[cash_state]=="발급실패") {?>
								<font color="#000000">발급실패</font>
						<? } else if($row[cash_state]=="발급") {?>
								<font color="#ff0000">발급</font>
						<? } else { echo $row[cash_state]; }?>
					</td>
					<td align="center">
						<? if($row[cash_state]!="발급취소") {?>
							<a href="./cash_cancel.php?id=<?=$row[cash_id]?>">취소하기</a>
						<? } else {?>
							<font color=gray><?=date("Y/m/d H시",$row[cash_ctime])?></font>
						<? } ?>
					</td>
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
		<td width=50%><input type=submit class=btn1 value='일괄수정'></td>
		<td height="50" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>