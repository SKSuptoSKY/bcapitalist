<?
$page_loc="order";
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shophistory"];
$JO_table = $GnTable["shoporder"];

$where = " where ";
$sql_search = "";
if ($findword != "")
{
	if ($findType != "")
    {
    	$sql_search .= " $where $findType like '%$findword%' ";
        $where = " and ";
    }
}

if ($findType == "")  $findType = "a.od_id";
if ($sort1 == "") $sort1 = "od_id";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from $PG_table a
                left join $JO_table b on (a.od_id = b.od_id)
                $sql_search ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

$sql  = " select a.*,
                 concat(a.cd_trade_ymd, ' ', a.cd_trade_hms) as cd_app_time
           $sql_common
           order by $sort1 $sort2
           limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($row[p_view]==TRUE) $list[$i][view] = "<font color=red>공개중</font>"; else $list[$i][view]  = "<font color=gray>비공개</font>";
}

$list_total = count($list);

$qstr1 = "sel_ca_id=$sel_ca_id&sel_field=$sel_field&search=$search";
$qstr  = "$qstr1&sort1=$sort1&sort2=$sort2&page=$page";
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 카드결제리스트</font></strong> (* 신용카드로 승인한 내역이며 주문번호를 클릭하시면 주문상세 페이지로 이동합니다.)
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=sort1 value="<? echo $sort1 ?>">
			<input type=hidden name=page value="<?=$page?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center">
						<img src="/btn/icon_search.gif" border="0" align="absmiddle">
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value='a.od_id'>주문번호
							<option value='cd_app_no'>승인번호
							<option value='cd_opt01'>결제자
						</select>
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>"> <input type=image src='/btn/btn_search.gif' align="absmiddle">
					</td>				
					<td align="right">건수 : <?=$total_count ?>&nbsp;</td>
				</tr>
			</table>
			</form>
		</td>		
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
					<td width=110><a href="<? echo title_sort("od_id") . "&$qstr1"; ?>">주문번호</a></td>
					<td width='' ><a href="<? echo title_sort("cd_amount") . "&$qstr1"; ?>">승인금액</a></td>
					<td width=110><a href="<? echo title_sort("cd_app_no") . "&$qstr1"; ?>">승인번호</a></td>
					<td width=110><a href="<? echo title_sort("cd_app_rt") . "&$qstr1"; ?>">승인결과</a></td>
					<td width=120><a href="<? echo title_sort("cd_app_time") . "&$qstr1"; ?>">승인일시</a></td>
					<td width=110><a href="<? echo title_sort("cd_opt01") . "&$qstr1"; ?>">결제자</a></td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td><a href='./order_view.php?od_id=<?=$list[$i][od_id]?>'><U><?=$list[$i][od_id]?></U></a></td>
					<td><?=display_amount($list[$i][cd_amount])?></td>
					<td><?=$list[$i][cd_app_no]?></td>
					<td><?=$list[$i][cd_app_rt]?></td>
					<td><?=$list[$i][cd_app_time]?></td>
					<td><?=$list[$i][cd_ip]?></td>
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
		<td height="50" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>