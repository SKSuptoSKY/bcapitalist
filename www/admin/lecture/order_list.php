<?
$page_loc="lecture";
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

//검색
$sql_search = " where 1";
if ($findword != "")
{
	if ($findType != "")
    {
    	$sql_search .= " and $findType LIKE '%$findword%' ";
        $where = " and ";
    }
}

if ($stt) {
	if ($stt=="1") $sql_search.=" and b.ct_status='주문' ";
	else if ($stt=="2") $sql_search.=" and b.ct_status='준비' ";
	else if ($stt=="3") $sql_search.=" and b.ct_status='배송' ";
	else if ($stt=="4") $sql_search.=" and b.ct_status='완료' ";
	else if ($stt=="5") $sql_search.=" and b.ct_status='취소' ";
	else if ($stt=="6") $sql_search.=" and b.ct_status='반품' ";
}

if ($fmDt && $toDt) {
	if ($fmDt==$toDt) $sql_search.=" and DATE_FORMAT(order_date,'%Y-%m-%d') =  '".$fmDt."' ";
	else $sql_search.=" and (DATE_FORMAT(order_date,'%Y-%m-%d') >= '".$fmDt."' and DATE_FORMAT(order_date,'%Y-%m-%d') <= '".$toDt."')";
}
else {
	if ($fmDt) $sql_search.=" and DATE_FORMAT(order_date,'%Y-%m-%d') >='".$fmDt."' ";
	else if ($toDt) $sql_search.=" and DATE_FORMAT(order_date,'%Y-%m-%d') <= '".$toDt."' ";
}



if ($findType == "")  $findType = "order_date";
if ($sort1 == "") $sort1 = "pay_date";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from Gn_Lecture_History
                $sql_search ";
$result = sql_query(" select * ".$sql_common);
$total_count = mysql_num_rows($result);

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

$sql  = " select * $sql_common
           order by $sort1 $sort2
           limit $from_record, $rows ";
$result = sql_query($sql);
$qstr1 = "sel_ca_id=$sel_ca_id&findType=$findType&findword=$findword";
$qstr = "$qstr1&sort1=$sort1&sort2=$sort2&page=$page";

?>
<script language=javascript src="/admin/shop/lib/javascript.js"></script>
<script language="javascript">
function chkDel(tno) {
    if(confirm("한번 삭제하신 자료는 절대 복구되지 않습니다.\n삭제하시겠습니까?"))
	document.location.href = "./order_delete.php?tno="+tno+"&<?=$qstr1.$qstr?>";
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
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 주문서관리</font></strong>
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
					<td width="10%"><a href="./order_list.php">처음</a></td>
					<td align="center">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td style="padding:4,5,0,0" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
								<td style="padding-right:4px;">결제일: 
								  <input name="fmDt" type="text" size="10" value="<?=$fmDt?>" readonly onfocus="showCalendarControl(this);"> ~
								  <input name="toDt" type="text" size="10" value="<?=$toDt?>" readonly onfocus="showCalendarControl(this);">
								</td>
								<td style="padding:0 20px 0px 20px;">|</td>
								<td>
									<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
										<!--
										<option value='order_date' <?if($findType=="order_date") {?>selected<?}?>>결제일자</option>
										-->
										<!-- <option value='order_idxx' <?if($findType=="order_idxx") {?>selected<?}?>>주문번호</option> -->
										<!-- <option value='mb_id' <?if($findType=="mb_id") {?>selected<?}?>>회원 ID</option> -->
										<option value='order_name' <?if($findType=="order_name") {?>selected<?}?>>주문자</option>
										<option value='type' <?if($findType=="type") {?>selected<?}?>>결제방법</option>
										<option value='pay_mny' <?if($findType=="pay_mny") {?>selected<?}?>>결제금액</option>
										<!--
										<option value='od_b_name' <?if($findType=="od_b_name") {?>selected<?}?>>받는분</option>
										-->
										<!-- <option value='od_deposit_name' <?if($findType=="od_deposit_name") {?>selected<?}?>>입금자</option> -->
										<!--
										<option value='orderamount' <?if($findType=="orderamount") {?>selected<?}?>>주문금액</option>
										<option value='od_invoice_time' <?if($findType=="od_invoice_time") {?>selected<?}?>>발송일</option>
										-->
										<!-- <option value='od_invoice' <?if($findType=="od_invoice") {?>selected<?}?>>운송장번호</option> -->
										<!--
										<option value='od_b_addr1' <?if($findType=="od_b_addr1") {?>selected<?}?>>주소</option>
										<option value='od_tel' <?if($findType=="od_tel") {?>selected<?}?>>주문자연락처</option>
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
					<td width="7%">관리</td>
					<!-- <td width="7%"><a href='<?=title_sort("order_idxx", 1)."&$qstr1";?>'>주문번호</a></td> -->
					<td width="7%"><a href='<?=title_sort("order_name")."&$qstr1";?>'>주문자</a></td>
					<td width="10%"><a href='<?=title_sort("type", 1)."&$qstr1";?>'>결제방법</a></td>
					<td width="6%"><a href='<?=title_sort("pay_mny", 1)."&$qstr1";?>'><FONT COLOR="1275D3">결제금액</FONT></a></td>
					<td width="6%"><a href='<?=title_sort("cancel_mny", 1)."&$qstr1";?>'>취소금액</a></td>
					<!-- <td width="6%"><a href='<?=title_sort("od_dc_amount", 1)."&$qstr1";?>'>DC</a></td> -->
					<td width="11%"><a href='<?=title_sort("order_date", 1)."&$qstr1";?>'>결제일자</a></td>
					<td width="7%">상태</td>
					<!-- <td width="8%"><a href='<?=title_sort("od_invoice_time", 1)."&$qstr1";?>'>발송일</a></td> -->
				</tr>
			<form name=frmorderlist method=post action="./order_update.php">
			<input type=hidden name=mode value="listup">
			<input type=hidden name=sort1 value="<? echo $sort1 ?>">
			<input type=hidden name=sort2 value="<? echo $sort2 ?>">
			<input type=hidden name=page  value="<? echo $page ?>">
				<?
					$tot_itemcnt       = 0;
					$tot_orderamount   = 0;
					$tot_ordercancel   = 0;
					$tot_dc_amount     = 0;
					$tot_receiptamount = 0;
					$tot_receiptcancel = 0;
					$tot_misuamount    = 0;
					for ($i=0; $row=mysql_fetch_array($result); $i++) {
						$paygetotal = 0;
						$odrgetotal = 0;

						// 결제 수단
						$s_receipt_way = $s_br = "";
						if ($row[type]=="계좌이체") {
							$s_receipt_way = "계좌이체";
							//$s_receipt_way = cut_str($row[od_bank_account],8,"");
							$s_br = "<br>";
						}
						if ($row[type]=="신용카드") {
							$s_receipt_way = "신용카드";
							//$s_receipt_way = cut_str($row[od_bank_account],8,"");
							$s_br = "<br>";
						}

						if($row[order_memo]) $memo="<br><span title='$row[od_memo]' style='color:red'>[상담]</span>";
							else $memo="";

						$s_mod ="./order_view.php?tno=$row[tno]&$qstr";
						$order_state_option = "$row[status]";
				?>
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="<?=$s_mod?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$row[tno];?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<!-- <td align=center><?=$row[order_idxx]?></td> -->
					<td align=center><span><?=$row[order_name]?></span></td>
					<td align=center>
						<?=$row[type]?>
						<!--
						<?if($s_receipt_way=="가상계좌" || $s_receipt_way=="계좌이체" || $s_receipt_way=="신용카드"){?><a href="https://admin8.kcp.co.kr/assist/login.LoginAction.do" target="_blank" style="color:green;">[KCP 상점관리자 이동]</a><?}?>
						-->
					</td>
					<td align=right><FONT COLOR=1275D3><?=number_format($row[pay_mny])?></font></td>
					<td align=right><?=number_format($row[cancel_mny])?></td>
					<td align=center><?=str_replace('-','.',substr($row[order_date],2,14))?></td>
					<td align=center>
						<?=$order_state_option?>
					</td>
					<!-- <td align=center><?=$od_invoice_time?></td> -->
				</tr>
			<?
						$tot_itemcount     += $row[itemcount];
						$tot_orderamount   += $row[pay_mny];
						$tot_ordercancel   += $row[cancel_mny];
					}
				$tot_odcount          = $i;
				mysql_free_result($result);
			?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } ?>
			</form>
				<tr align="center"><td colspan="20"></td></tr>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan=2 align=center>합 계</td>
					<td align=center><?=(int)$tot_odcount?>건</td>
					<td align=right><FONT COLOR=1275D3><?=number_format($tot_orderamount)?></FONT></td>
					<td align=right><?=number_format($tot_ordercancel)?></td>
					<td colspan=3 align=center><!-- <input type="button" value="일괄수정" onclick="document.frmorderlist.submit();"> --></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>