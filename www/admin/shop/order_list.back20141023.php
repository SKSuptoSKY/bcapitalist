<?
$page_loc="order";
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];

////////////////////////////////////////////////////////////////////////////////////
########### 여기서 장바구니를 비웁시다 ##################
////////////////////////////////////////////////////////////////////////////////////
$itime = time() - 8600;
$getime = date("Y-m-d H:i:s",$itime);
$sql = " select ct_id, on_uid from $JO_table where ct_status = '쇼핑' and ct_time < '$getime' ";
$result = sql_query($sql);
for ($i=0; $Dcart=mysql_fetch_array($result); $i++) {
	// 주문이 없는 장바구니 삭제
	sql_query(" delete from $JO_table where on_uid = '$Dcart[on_uid]' and ct_id = '$Dcart[ct_id]' ");
	// 삭제된 장바구니의 추가 입력사항을 삭제
	sql_query(" delete from {$GnTable[shopinput]} where u_uid = '$Dcart[on_uid]' and u_cid = '$Dcart[ct_id]' ");
}
////////////////////////////////////////////////////////////////////////////////////
########### 여기서 장바구니를 다 비웠습니다.###############
////////////////////////////////////////////////////////////////////////////////////


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

if ($stt) {
	if ($stt=="1") $sql_search.=" and b.ct_status='주문' ";
	else if ($stt=="2") $sql_search.=" and b.ct_status='준비' ";
	else if ($stt=="3") $sql_search.=" and b.ct_status='배송' ";
	else if ($stt=="4") $sql_search.=" and b.ct_status='완료' ";
	else if ($stt=="5") $sql_search.=" and b.ct_status='취소' ";
	else if ($stt=="6") $sql_search.=" and b.ct_status='반품' ";
}

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
                $sql_search ";
$result = sql_query(" select DISTINCT od_id ".$sql_common);
$total_count = mysql_num_rows($result);

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

$sql  = " select a.od_id,
           a.*, b.it_opt1, b.ct_status, ".$misuqry."
           $sql_common
           group by a.od_id
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
								<td style="padding-right:4px;">주문일: 
								  <input name="fmDt" type="text" size="10" value="<?=$fmDt?>" readonly onfocus="showCalendarControl(this);"> ~
								  <input name="toDt" type="text" size="10" value="<?=$toDt?>" readonly onfocus="showCalendarControl(this);">
								</td>
								<td style="padding:0 20px 0px 20px;">|</td>
								<td>
									<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
										<!--<option value='od_time' <?if($findType=="od_time") {?>selected<?}?>>주문일자</option>-->
										<option value='od_id' <?if($findType=="od_id") {?>selected<?}?>>주문번호</option>
										<option value='mb_id' <?if($findType=="mb_id") {?>selected<?}?>>회원 ID</option>
										<option value='od_name' <?if($findType=="od_name") {?>selected<?}?>>주문자</option>
										<!--
										<option value='od_paytype' <?if($findType=="od_paytype") {?>selected<?}?>>결제방법</option>
										<option value='od_b_name' <?if($findType=="od_b_name") {?>selected<?}?>>받는분</option>
										-->
										<option value='od_deposit_name' <?if($findType=="od_deposit_name") {?>selected<?}?>>입금자</option>
										<!--
										<option value='orderamount' <?if($findType=="orderamount") {?>selected<?}?>>주문금액</option>
										<option value='od_invoice_time' <?if($findType=="od_invoice_time") {?>selected<?}?>>발송일</option>
										-->
										<option value='od_invoice' <?if($findType=="od_invoice") {?>selected<?}?>>운송장번호</option>
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
					<td width="7%"><a href='<?=title_sort("od_id", 1)."&$qstr1";?>'>주문번호</a></td>
					<td width="7%"><a href='<?=title_sort("mb_id")."&$qstr1"; ?>'>회원ID</a></td>
					<td width="7%"><a href='<?=title_sort("od_name")."&$qstr1";?>'>주문자</a></td>
					<td width="10%"><a href='<?=title_sort("itemcount", 1)."&$qstr1";?>'>결제방법</a></td>
					<td width="6%"><a href='<?=title_sort("orderamount", 1)."&$qstr1";?>'><FONT COLOR="1275D3">주문금액</FONT></a></td>
					<td width="6%"><a href='<?=title_sort("ordercancel", 1)."&$qstr1";?>'>주문취소</a></td>
					<td width="6%"><a href='<?=title_sort("od_dc_amount", 1)."&$qstr1";?>'>DC</a></td>
					<td width="6%"><a href='<?=title_sort("receiptamount")."&$qstr1";?>'><FONT COLOR="1275D3">입금합계</font></a></td>
					<td width="6%"><a href='<?=title_sort("receiptcancel", 1)."&$qstr1";?>'>입금취소</a></td>
					<td width="6%"><a href='<?=title_sort("misu", 1)."&$qstr1";?>'><font color='#FF6600'>미수금</font></a></td>
					<td width="11%"><a href='<?=title_sort("od_time", 1)."&$qstr1";?>'>주문일자</a></td>
					<td width="7%">주문상태</td>
					<td width="8%"><a href='<?=title_sort("od_invoice_time", 1)."&$qstr1";?>'>발송일</a></td>
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
						if($row[ct_status]=="취소" || $row[ct_status]=="반품" || $row[ct_status]=="품절"){$row[misu]="0";}
						
						// 아이디별 주문 수량과 주문금액
						if($row[mb_id]){
							$sqltal = " select * from {$GnTable[member]} where mem_id = '$row[mb_id]' ";
							$memb = sql_fetch($sqltal);
							$odrgetotal = number_format($memb[countshop]);
							$paygetotal = number_format($memb[totalshop]);

							// 회원등급
								$leb_sql = "select leb_name from {$GnTable[memberlevel]} where leb_level = '$memb[mem_leb]'";
								$leb = sql_fetch($leb_sql);

								if($leb[leb_name]) $memleb = substr($leb[leb_name],0,4);
									else $memleb = "";

							//$s_idsc = "./member_orderlist.php?mb_id=$row[mb_id]";
							$order_isID = "<a href='/admin/member/member_form.php?mode=E&id=$row[mb_id]' target='_black'>$row[mb_id]</a>";
						} else {
							$sqltal = " select count(distinct od_id) as cnt, (sum(od_receipt_bank + od_receipt_card)) as ont from $PG_table where ( od_name = '$row[od_name]' and od_email = '$row[od_email]' ) and (od_invoice_time > '0000-00-00 00:00:00' or od_invoice > 0) ";
							$getotal = sql_fetch($sqltal);
							$odrgetotal = number_format($getotal[cnt]);
							$paygetotal = number_format($getotal[ont]);

							$order_isID = "<font color=#000000>비회원</font>";

							//$s_idsc = "./order_list.php?sort1=$sort1&sort2=$sort2&sel_field=od_name&search=$row[od_name]";
						}

						// 결제 수단
						$s_receipt_way = $s_br = "";
						if ($row[od_temp_bank] > 0 || $row[od_receipt_bank] > 0) {
							$s_receipt_way = "무통장입금";
							//$s_receipt_way = cut_str($row[od_bank_account],8,"");
							$s_br = "<br>";
						}

						if ($row[od_temp_card] > 0 || $row[od_receipt_card] > 0) {
							// 미수금이 없고 카드결제를 하지 않았다면 카드결제를 선택후 무통장 입금한 경우임
							if ($row[misuamount] <= 0 && $row[od_receipt_card] == 0)
								; // 화면 출력하지 않음
							else {
								$s_receipt_way .= $s_br."카드";
								if ($row[od_receipt_card] == 0)
									$s_receipt_way .= "<span class=small><span class=point style='font-size:8pt;'>(미승인)</span></span>";
								$s_br = "<br>";
							}
						}

						$od_time = str_replace('-','.',substr($row[od_time],2,14));
						$od_invoice_time = is_null_time($row[od_invoice_time]) ? "" : str_replace('-','.',substr($row[od_invoice_time],2,8));

						if($row[od_memo]) $memo="<br><span title='$row[od_memo]' style='color=red'>[상담]</span>";
							else $memo="";

						if ($row[od_receipt_point] > 0)
							$s_receipt_way .= $s_br."포인트";

						if($row[od_hp]) $od_tel = "$row[od_tel]<br>$row[od_hp]";
							else  $od_tel = "$row[od_tel]";

						$s_mod ="./order_view.php?od_id=$row[od_id]&$qstr";
						$s_del = icon("삭제", "javascript:del('./order_delete.php?od_id=$row[od_id]&on_uid=$row[on_uid]&mb_id=$row[mb_id]&$qstr');");

						if($row[ct_status]=="주문" || $row[ct_status]=="배송") {
								if($row[ct_status]=="주문") $order_state_value = array(0=>"주문", 1=>"준비");
								if($row[ct_status]=="배송") $order_state_value = array(0=>"배송", 1=>"완료");

								$order_state_option = "<select name='state[$i]'>";
								for($sop=0; $sop < count($order_state_value); $sop++) {
									if($row[ct_status]==$order_state_value[$sop]) $selected = "selected"; else $selected = "";
									$order_state_option .= "<option value='$order_state_value[$sop]' $selected>$order_state_value[$sop]";
								}
								$order_state_option .= "</select> <input type=checkbox name='od_ck[$i]' value='1'>";
						} else $order_state_option = "$row[ct_status]";
				?>
				<tr align="center" bgcolor="#FFFFFF">
					<input type=hidden name='od_id[<?=$i?>]' value='<?=$row[od_id]?>'>
					<input type=hidden name='mb_id[<?=$i?>]' value='<?=$row[mb_id]?>'>
					<td style="font-weight:bold;">
						<a href="<?=$s_mod?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$row[od_id];?>','<?=$row[on_uid];?>','<?=$row[mb_id];?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td align=center><?=$row[od_id]?></td>
					<td align=center><?=$order_isID?></td>
					<td align=center><span title='<?=$od_deposit_name?>'><?=cut_str($row[od_name],8,"")?></span></td>
					<td align=center><?=$s_receipt_way?></td>
					<td align=right><FONT COLOR=1275D3><?=number_format($row[orderamount])?></font></td>
					<td align=right><?=number_format($row[ordercancel])?></td>
					<td align=right><?=number_format($row[od_dc_amount])?></td>
					<td align=right><FONT COLOR=1275D3><?=number_format($row[receiptamount])?></font></td>
					<td align=right><?=number_format($row[receiptcancel])?></td>
					<td align=right><FONT COLOR='#FF6600'><?=number_format($row[misu])?></FONT></td>
					<td align=center><?=$row[od_time]?></td>
					<td align=center>
						<?=$order_state_option?>
					</td>
					<td align=center><?=$od_invoice_time?></td>
				</tr>
			<?
						$tot_itemcount     += $row[itemcount];
						$tot_orderamount   += $row[orderamount];
						$tot_ordercancel   += $row[ordercancel];
						$tot_dc_amount     += $row[od_dc_amount];
						$tot_receiptamount += $row[receiptamount];
						$tot_receiptcancel += $row[receiptcancel];
						$tot_misu          += $row[misu];
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
					<td colspan=4 align=center>합 계</td>
					<td align=center><?=(int)$tot_odcount?>건</td>
					<td align=right><FONT COLOR=1275D3><?=number_format($tot_orderamount)?></FONT></td>
					<td align=right><?=number_format($tot_ordercancel)?></td>
					<td align=right><?=number_format($tot_dc_amount)?></td>
					<td align=right><FONT COLOR=1275D3><?=number_format($tot_receiptamount)?></FONT></td>
					<td align=right><?=number_format($tot_receiptcancel)?></td>
					<td align=right><FONT COLOR=#FF6600><?=number_format($tot_misu)?></FONT></td>
					<td colspan=3 align=center><input type="button" value="일괄수정" onclick="document.frmorderlist.submit();"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>