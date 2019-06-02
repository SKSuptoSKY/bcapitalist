<?
$page_loc="order";
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];


//검색
$sql_search = " where 1";
if ($findword != "")
{
	if ($findType != "")
    {
    	$sql_search .= " and a.$findType ='$findword' ";
        $where = " and ";
    }
}

if($stt != "") $sql_search .= " and b.ct_status ='".$stt."' ";

if ($fmDt && $toDt) {
	if ($fmDt==$toDt) $sql_search.=" and DATE_FORMAT(a.od_time,'%Y-%m-%d') =  '".$fmDt."' ";
	else $sql_search.=" and (DATE_FORMAT(a.od_time,'%Y-%m-%d') >= '".$fmDt."' and DATE_FORMAT(a.od_time,'%Y-%m-%d') <= '".$toDt."')";
}
else {
	if ($fmDt) $sql_search.=" and DATE_FORMAT(a.od_time,'%Y-%m-%d') >='".$fmDt."' ";
	else if ($toDt) $sql_search.=" and DATE_FORMAT(a.od_time,'%Y-%m-%d') <= '".$toDt."' ";
}


if ($findType == "")  $findType = "od_time";
if ($sort1 == "") $sort1 = "od_time";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from $PG_table a 
				left join $JO_table b on (a.on_uid=b.on_uid)
				left join $GnTable[shopitem] c on (b.it_id=c.it_id)
                $sql_search ";
$sql = " select * ".$sql_common;
$ex_sql = $sql;

$result = sql_query($sql);
$total_count = mysql_num_rows($result);

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

	$sql  = " select a.od_id, b.*,a.od_name, a.mb_id , c.it_name
           $sql_common
           order by $sort1 $sort2
           limit $from_record, $rows ";

$result = sql_query($sql);
$qstr1 = "sel_ca_id=$sel_ca_id&findType=$findType&findword=$findword";
$qstr = "$qstr1&sort1=$sort1&sort2=$sort2&page=$page";
?>
<script language=javascript src="/admin/shop/lib/javascript.js"></script>
<script language="javascript">
function chkDel(od_id,on_uid,mb_id) {
    if(confirm("한번 삭제하신 자료는 절대 복구되지 않습니다.\n삭제하시겠습니까?"))
	document.location.href = "./order_delete.php?od_id="+od_id+"&on_uid="+on_uid+"&mb_id=" +mb_id + "&<?=$qstr1.$qstr?>";
}
</script>
<script src="/css/calendar-eraser_lim.js" type="text/javascript" charset="<?=$charset?>"></script>
<link rel="stylesheet" href="/css/calendar-eraser_lim.css" />
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 주문개별관리</font></strong>
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
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<td width="10%"><a href="<?=$_SERVER[PHP_SELF]?>">처음</a> &nbsp <a href="order_status_ex.php?ex_sql=<?=urlencode($ex_sql)?>">[엑셀출력]</a></td>
					<td align="center">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td style="padding:4,5,0,0" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
								<td style="padding-right:4px;">주문일: 
								  <input name="fmDt" type="text" size="10" value="<?=$fmDt?>" readonly onfocus="showCalendarControl(this);"> ~
								  <input name="toDt" type="text" size="10" value="<?=$toDt?>" readonly onfocus="showCalendarControl(this);">
								</td>
								<td style="padding:0 20px 0px 20px;">|</td>
								<td>
									<select name="stt" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
										<option value='' <?if(!$stt) {?>selected<?}?>>- 상품상태 -</option>
										<option value='주문' <?if($stt=="주문") {?>selected<?}?>>주문</option>
										<option value='상품준비중' <?if($stt=="상품준비중") {?>selected<?}?>>상품준비중</option>
										<option value='배송중' <?if($stt=="배송중") {?>selected<?}?>>배송중</option>
										<option value='완료' <?if($stt=="완료") {?>selected<?}?>>완료</option>							
										<option value='취소' <?if($stt=="취소") {?>selected<?}?>>취소</option>
										<option value='반품' <?if($stt=="반품") {?>selected<?}?>>반품</option>
										<option value='품절' <?if($stt=="품절") {?>selected<?}?>>품절</option>
									</select>
									<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
										<!--<option value='od_time' <?if($findType=="od_time") {?>selected<?}?>>주문일자</option>-->
										<option value='od_id' <?if($findType=="od_id") {?>selected<?}?>>주문번호</option>
										<option value='mb_id' <?if($findType=="mb_id") {?>selected<?}?>>회원 ID</option>
										<option value='od_name' <?if($findType=="od_name") {?>selected<?}?>>주문자</option>
										<!--
										<option value='od_paytype' <?if($findType=="od_paytype") {?>selected<?}?>>결제방법</option>
										<option value='od_b_name' <?if($findType=="od_b_name") {?>selected<?}?>>받는분</option>
										-->
									</select>
									<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>"> <input type=image src='/btn/btn_search.gif' align="absmiddle">
								</td>
							</tr>
						</table>
					</td>
					<td width=10% align=right>건수 : <?=$total_count ?>&nbsp;</td>
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
					<td width="7%"><a href='<?=title_sort("od_id", 1)."&$qstr1";?>'>주문번호</a></td>
					<td width="7%"><a href='<?=title_sort("mb_id")."&$qstr1"; ?>'>회원ID</a></td>
					<td width="7%"><a href='<?=title_sort("od_name")."&$qstr1";?>'>주문자</a></td>
					<td><a href='<?=title_sort("itemcount", 1)."&$qstr1";?>'>상품명</a></td>
					<td width="7%">판매가</td>
					<td width="7%">수량</td>
					<td width="7%">소계</td>
					<td width="7%">상태</td>
				</tr>
			<form name=frmorderlist method=post action="./order_update.php">
			<input type=hidden name=mode value="listup">
			<input type=hidden name=sort1 value="<? echo $sort1 ?>">
			<input type=hidden name=sort2 value="<? echo $sort2 ?>">
			<input type=hidden name=page  value="<? echo $page ?>">
			<?for ($i=0; $row=mysql_fetch_array($result); $i++) {
				$it_name = "<a href='/shop/item.php?it_id=$row[it_id]' target='_blank'>".stripslashes($row[it_name])."</a><br>";
				$it_name .= print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);

				$ct_amount[소계] = $row[ct_amount] * $row[ct_qty];
				$ct_point[소계] = $row[ct_point]      * $row[ct_qty];

				if ($row[ct_status]=='주문' || $row[ct_status]=='준비' || $row[ct_status]=='배송' || $row[ct_status]=='완료')
					$t_ct_amount[정상] += $row[ct_amount] * $row[ct_qty];
				else if ($row[ct_status]=='취소' || $row[ct_status]=='반품' || $row[ct_status]=='품절')
					$t_ct_amount[취소] += $row[ct_amount] * $row[ct_qty] + $od[od_send_cost];

				//$image = get_it_image("$row[it_id]_s", (int)($default[de_simg_width] / $image_rate), (int)($default[de_simg_height] / $image_rate), $row[it_id]);
					$image = img_resize_tag("/shop/data/item/{$row[it_id]}_l1",80,80);		
				?>
				<tr align="center" bgcolor="#FFFFFF">
					<td align=center><?=$row[od_id]?></td>
					<td align=center><?=($row[mb_id] == "")?"비회원":$row[mb_id];?></td>
					<td align=center><span title='<?=$od_deposit_name?>'><?=cut_str($row[od_name],8,"")?></span></td>
					<td align=left style="padding:5px;"><?=$image?> &nbsp <?=$it_name?></td>
					<td align=right><FONT COLOR=1275D3><?=number_format($row[ct_amount])?></font></td>
					<td align=right><?=$row[ct_qty]?></td>
					<td align=right><?=number_format($ct_amount[소계])?></td>
					<td align=right><FONT COLOR=1275D3><?=$row[ct_status]?></font></td>
				</tr>
			<?
				$tot_amount += 	$row[ct_amount];
				$tot_qty += 	$row[ct_qty];
				$tot_resumt_amount += 	$ct_amount[소계];
				} ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } ?>
			</form>
				<tr align="center"><td colspan="20"></td></tr>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="4" align="right">합계 : </td>
					<td align="right"><?=number_format($tot_amount)?></td>
					<td align="right"><?=$tot_qty?></td>
					<td align="right"><?=number_format($tot_resumt_amount)?></td>
					<td >&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>