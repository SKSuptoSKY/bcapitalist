<?
$page_loc="order";
include "../lib/lib.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];

if($ptype=="today")
{
	$fr_date = date("Y-m-d",time());
	$to_date = date("Y-m-d",time());
} else
if($ptype=="tomon")
{
	$fr_date = date("Y-m-01",time());
	$to_date = date("Y-m-31",time());
}

if ($ct_status) {

	if($ct_status=="주문") {
		$status_search = "and (od_temp_bank > 0 or od_temp_card > 0) and (od_receipt_card = 0 and od_receipt_bank = 0) and od_cancel_card = 0 and od_refund_amount = 0";
	} else
	if($ct_status=="입금") {
		$status_search = "and (od_receipt_card > 0 or od_receipt_bank > 0) and (od_invoice_time = '0000-00-00 00:00:00' or od_invoice='')";
	} else
	if($ct_status=="배송") {
		$status_search = "and (od_invoice_time > '0000-00-00 00:00:00' or od_invoice > 0)";
	} else {
		$ct_status="전체";
		$status_search = " ";
	}

} else {
	$ct_status="전체";
		$status_search = " ";
}

if ($pay_type) {
	if($pay_type=="cash") {
		$status_search .= " and od_bank_account != '카드결제' ";
	} else
	if($pay_type=="card") {
		$status_search .= " and od_bank_account = '카드결제'";
	}else {
		$pay_type="all";
		$status_search .= " ";
	}
} else {
	$pay_type="all";
	$status_search .= " ";
}

	if ($case == 1) {
		$type_print = " od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
	} else {
		$type_print = " od_id between '$fr_od_id' and '$to_od_id' ";
	}

	$sql = "select count(*) as cnt from $PG_table where $type_print $status_search ";
	$result = sql_query($sql);
	$row=mysql_fetch_array($result);
	$totalorder = $row[cnt];

	$sql = "select * from $PG_table where $type_print $status_search";
	$result = sql_query($sql);

// 1.04.01
// MS엑셀 CSV 데이터로 다운로드 받음
if ($csv) {
    //header('Content-Type: text/x-csv');
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename="' . date("ymd", time()) . '.xls"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
$result = mysql_query($sql) or die(mysql_error());
if (!$totalorder) {
    echo "출력할 내역이 없습니다.";
    exit;
}

?>
<?
if ($case == 1)
    echo "<p><b>[ $fr_date - $to_date $ct_status 내역 ]</b>";
else
    echo "<p><b>[ $fr_od_id - $to_od_id $ct_status 내역 ]</b>";
?>
			<table bgcolor="#FFCF9C" border=1>
			<tr height=30 align=center bgcolor="#FFE7D6">
				<td width="25" rowspan="2">번호</td>
				<td width="50" rowspan="2">주문번호</td>
				<td width="80" rowspan="2">받으시는분</td>
				<td width="457">주문내역</td>
				<td width="120" rowspan="2">받으시는분 주소</td>
				<td width="80" rowspan="2">주문하신분</td>
				<td width="70" rowspan="2">운송장번호</td>
				<td width="150" rowspan="2">배송지요청사항</td>

			</tr>
			<tr height=30 align=center bgcolor="#FFE7D6">

				<td>
				<table bgcolor="#FFCF9C" border=0 cellpadding=3 cellspacing=1 width="457"><tr>
                <td width="250" align="center" bgcolor="#FFE7D6">상품</td>
                <td width="50" align="center" bgcolor="#FFE7D6">정가</td>
                <td width="30" align="center" bgcolor="#FFE7D6">수량</td>
                <td width="60" align="center" bgcolor="#FFE7D6">구분</td>
                <td width="67" align="center" bgcolor="#FFE7D6">금액</td>

				</tr></table>
				</td>

			</tr>
<?
	$totalcost = 0;
	$total_card = 0;
	$total_cash = 0;

	$tot_tot_qty = 0;
	$tot_card_qty = 0;
	$tot_cash_qty = 0;


	for($i=1; $row=mysql_fetch_array($result); $i++) {
		$tot_sell_amount = 0;
		if($i%2) $bgcolor = "bgcolor=#FFCF9C";
			else $bgcolor = "bgcolor=#FFFBF7";
?>

			<tr <?=$bgcolor?>>
				<td width="25" align="center"><?=$i?></td>
				<td align="center">
					<?=$row[od_id]?>
				</td>
				<td align="center" cellpadding=0 cellspacing=0>
					<?=$row[od_name]?><br><?=$row[od_tel]?>
				</td>
				<td align="center">
				<table border=1 width="457">
			<?
				// $s_on_uid 로 현재 장바구니 자료 쿼리
				$sql_cart = " select a.ct_id,
								a.it_opt1,
								a.it_opt2,
								a.it_opt3,
								a.it_opt4,
								a.it_opt5,
								a.it_opt6,
								a.ct_amount,
								a.ct_paytype,
								a.ct_present,
								a.ct_point,
								a.ct_qty,
								a.ct_status,
								a.ap_id,
								a.bi_id,
								b.it_id,
								b.it_name,
								b.it_pay,
								b.ca_id
						   from $JO_table a,
								{$GnTable[shopitem]} b
						  where a.on_uid = '$row[on_uid]'
							and a.it_id  = b.it_id
						  order by a.ct_id ";
				$result_cart = sql_query($sql_cart);
				$bgc = 0;
				for ($j=0; $cart=mysql_fetch_array($result_cart); $j++) {

					$paytype = $default_paytype[$cart[ct_paytype]];	// 구매가격 타입을 출력합니다.
					//$sell_amount = $cart[ct_amount] * $cart[ct_qty];
					$sell_amount = $cart[ct_amount];
					$tot_sell_amount += $sell_amount;
			?>
				<tr <?=$bgcolorcart?>>
					<td align="center" cellpadding=0 cellspacing=0 width="250">
						<?=$cart[it_name]?><?=print_item_options($cart[it_id], $cart[it_opt1], $cart[it_opt2], $cart[it_opt3], $cart[it_opt4], $cart[it_opt5], $cart[it_opt6]);?>
					</td>
					<td align="center" width="50">
						<?=number_format($cart[ct_amount])?>
					</td>
					<td align="center" width="30">
						<?=$cart[ct_qty]?>
					</td>

					<td align="center" width="60">
						<?=$paytype?>
					</td>
					<td align="center" cellpadding=0 cellspacing=0 width="67">
						<?=number_format($sell_amount)?>
					</td>

				</tr>
				<?
					if($cart[ct_present]) {
						$present = explode("|", $cart[ct_present]);

						for($p=0; $present[$p]; $p++) {

							$present_item = explode(",", $present[$p]);
							$sql_get = "select it_name, it_pay from {$GnTable[shopitem]} where it_id = '$present_item[0]' ";
							$item_get = sql_fetch($sql_get);

							$paytype = $default_paytype[p];
				?>
				<tr <?=$bgcolorcart?>>
					<td align="center" cellpadding=0 cellspacing=0 width="250">
						<?=$item_get[it_name]?>
					</td>
					<td align="center" width="50">
						<?=number_format($item_get[it_pay])?>
					</td>
					<td align="center" width="30">
						<?=$present_item[1]?>
					</td>

					<td align="center" width="60">
						<?=$paytype?>
					</td>
					<td align="center" cellpadding=0 cellspacing=0 width="67">
						<?=number_format(0)?>
					</td>

				</tr>
				<?
							$bgc++;
						}
					}
				?>
			<?
						$bgc++;
					}
			?>
			<?
				if($row[od_present]) {

				$presents = explode(",", $row[od_present]);
				$sql_pt = "select it_name, it_pay from {$GnTable[shopitem]} where it_id = '$presents[0]' ";
				$result_pt = sql_query($sql_pt);
				$pt=mysql_fetch_array($result_pt);

				$paytype = $default_paytype[p];
			?>
				<tr <?=$bgcolorcart?>>
					<td align="center" cellpadding=0 cellspacing=0 width="250">
						<?=$pt[it_name]?><?=print_item_options($cart[it_id], $cart[it_opt1], $cart[it_opt2], $cart[it_opt3], $cart[it_opt4], $cart[it_opt5], $cart[it_opt6]);?>
					</td>
					<td align="center" width="50">
						<?=number_format($pt[it_pay])?>
					</td>
					<td align="center" width="30">
						<?=$presents[1]?>
					</td>

					<td align="center" width="60">
						<?=$paytype?>
					</td>
					<td align="center" cellpadding=0 cellspacing=0 width="67">
						<?=number_format(0)?>
					</td>

				</tr>
			<?
				}
				$tot_sell_amount = $tot_sell_amount + $row[od_send_cost] - $row[od_dc_amount]
			?>

				<tr><td colspan="5" align="right">
					<? if($row[od_send_cost]) { ?>
					배송료 : <?=number_format($row[od_send_cost])?>&nbsp;&nbsp;&nbsp;<br>
					<? } ?>
					<? if($row[od_dc_amount]) { ?>
					DC : <?=number_format($row[od_dc_amount])?>&nbsp;&nbsp;&nbsp;<br>
					<? } ?>
					합계 : <?=number_format($row['od_temp_bank']+$row['od_temp_card'])?>&nbsp;&nbsp;&nbsp;<br>
					
					<? if($row[od_settle_case]=="신용카드") { ?>
						카드 결제액: <?=number_format($row[od_receipt_card])?>&nbsp;&nbsp;&nbsp;
					<? } else if($row[od_settle_case]=="계좌이체") { ?>
						실시간 계좌이체금액 : <?=number_format($row[od_receipt_bank])?>&nbsp;&nbsp;&nbsp;
					<? } else if($row[od_settle_case]=="가상계좌") { ?>
						가상계좌 입금액: <?=number_format($row[od_receipt_bank])?>&nbsp;&nbsp;&nbsp;
					<? } else if($row[od_settle_case]=="무통장") { ?>
							무통장 입금액: <?=number_format($row[od_receipt_bank])?>&nbsp;&nbsp;&nbsp;
					<?	} ?>
				</td></tr>
				</table>
				</td>

				<td align="center" cellpadding=0 cellspacing=0 width="120">
					<?=$row[od_b_addr1]?> <?=$row[od_b_addr2]?>
				</td>

				<td align="center" cellpadding=0 cellspacing=0 width="80">
					<?=$row[od_name]?><br><?=$row[od_tel]?><br><?=$row[od_hp]?>
				</td>

				<td align="center" cellpadding=0 cellspacing=0 width="70">
					<?=$row[od_invoice]?>
				</td>

				<td align="center" cellpadding=0 cellspacing=0 width="60">
					<?=$row[od_memo]?>
				</td>

			</tr>
<?
					$totalcost = $totalcost + $tot_sell_amount ;
					//$totalcost = $totalcost + $row['od_temp_bank'] + $row['od_temp_card'];
					$total_card += $row[od_receipt_card];
					$total_cash += $row[od_receipt_bank];

					$tot_tot_qty++;
					if($row[od_receipt_bank]) $tot_cash_qty ++;
					if($row[od_receipt_card]) $tot_card_qty++;
	}
	if($i==0) {
?>
			    <tr bgcolor=#f9f9f9>
					<td colspan="8" align="center" height="50" valign="middle">
						입력된 자료가 없습니다.
					</td>
			    </tr>
<?
	}
	if($ct_status!="주문"){
?>
    <tr>
		<td bgcolor=#FFFFFF colspan=5></td>
        <td colspan=3 bgcolor=#FFFFFF>
           <table width="" cellpadding=2 cellspacing=0 border=1 bordercolordark='white' bordercolorlight='gray' align=right>
            <tr>
                <td colspan=2 align=right><b>카 드 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_card_qty)?></td>
                <td align=right width=80><?=number_format($total_card);?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=2 align=right><b>입 금 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_cash_qty)?></td>
                <td align=right width=80><?=number_format($total_cash);?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=2 align=right><b>전 체 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($totalorder)?></td>
                <td align=right width=80><?=number_format($totalcost)?>&nbsp;</td>
            </tr>
            </table>
        </td>
    </tr>
<?
	}
?>
</table>
<?
    exit;
}
/////////////////////////// 화면에 출력할 경우 /////////////////////////////////////////
$result = mysql_query($sql) or die(mysql_error());
if (!$totalorder) {
	alert_close("출력할 내역이 없습니다.");
}
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=<?=$charset?>">
<title>주문내역</title>
<style>
    body, table, tr, td, p { font-size:9pt; }
</style>
</head>
<body bgcolor=ffffff leftmargin=0 topmargin=0 marginheight=0 marginwidth=0>

<?
if ($case == 1)
    echo "<br><p><b>[ $fr_date - $to_date $ct_status 내역 ]</b>";
else
    echo "<br><p><b>[ $fr_od_id - $to_od_id $ct_status 내역 ]</b>";
?>
			<table bgcolor="#FFCF9C" border=0 cellpadding=3 cellspacing=1 align=center>
			<tr height=30 align=center bgcolor="#FFE7D6">
				<td width="25" rowspan="2">번호</td>
				<td width="50" rowspan="2">주문번호</td>
				<td width="80" rowspan="2">받으시는분</td>
				<td width="457">주문내역</td>
				<td width="120" rowspan="2">받으시는분 주소</td>
				<td width="80" rowspan="2">주문하신분</td>
				<td width="70" rowspan="2">운송장번호</td>
				<td width="150" rowspan="2">배송지요청사항</td>

			</tr>
			<tr height=30 align=center bgcolor="#FFE7D6">

				<td>
				<table bgcolor="#FFCF9C" border=0 cellpadding=3 cellspacing=1 width="457"><tr>
                <td width="250" align="center" bgcolor="#FFE7D6">상품</td>
                <td width="50" align="center" bgcolor="#FFE7D6">정가</td>
                <td width="30" align="center" bgcolor="#FFE7D6">수량</td>
                <td width="60" align="center" bgcolor="#FFE7D6">구분</td>
                <td width="67" align="center" bgcolor="#FFE7D6">금액</td>

				</tr></table>
				</td>

			</tr>
<?
	$totalcost = 0;
	$total_card = 0;
	$total_cash = 0;

	$tot_tot_qty = 0;
	$tot_card_qty = 0;
	$tot_cash_qty = 0;

	for($i=1; $row=mysql_fetch_array($result); $i++) {
		$tot_sell_amount = 0;
		if($i%2) $bgcolor = "bgcolor=#FFFBF7";
			else $bgcolor = "bgcolor=#FFFBF7";
?>

			<tr <?=$bgcolor?>>
				<td width="25" align="center"><?=$i?></td>
				<td align="center">
					<?=$row[od_id]?>
				</td>
				<td align="center" cellpadding=0 cellspacing=0>
					<?=$row[od_name]?><br><?=$row[od_tel]?>
				</td>
				<td align="center">
				<table bgcolor="#FFCF9C" border=0 cellpadding=3 cellspacing=1 width="457">
			<?
				// $s_on_uid 로 현재 장바구니 자료 쿼리
				$sql_cart = " select a.ct_id,
								a.it_opt1,
								a.it_opt2,
								a.it_opt3,
								a.it_opt4,
								a.it_opt5,
								a.it_opt6,
								a.ct_amount,
								a.ct_paytype,
								a.ct_present,
								a.ct_point,
								a.ct_qty,
								a.ct_status,
								a.ap_id,
								a.bi_id,
								b.it_id,
								b.it_name,
								b.it_pay,
								b.ca_id
						   from $JO_table a,
								{$GnTable[shopitem]} b
						  where a.on_uid = '$row[on_uid]'
							and a.it_id  = b.it_id
						  order by a.ct_id ";
				$result_cart = sql_query($sql_cart);
				$bgc = 0;
				for ($j=0; $cart=mysql_fetch_array($result_cart); $j++) {

					if($bgc%2) $bgcolorcart = "bgcolor=#FFFBF7";
						else $bgcolorcart = "bgcolor=#FFFBF7";
					$paytype = $default_paytype[$cart[ct_paytype]];	// 구매가격 타입을 출력합니다.
					//$sell_amount = $cart[ct_amount] * $cart[ct_qty];
					$sell_amount = $cart[ct_amount];
					$tot_sell_amount += $sell_amount;
			?>
				<tr <?=$bgcolorcart?>>
					<td align="center" width="250" cellpadding=0 cellspacing=0>
						<?=$cart[it_name]?><?=print_item_options($cart[it_id], $cart[it_opt1], $cart[it_opt2], $cart[it_opt3], $cart[it_opt4], $cart[it_opt5], $cart[it_opt6]);?>
					</td>
					<td align="center" width="50">
						<?=number_format($cart[ct_amount])?>
					</td>
					<td align="center" width="30">
						<?=$cart[ct_qty]?>
					</td>

					<td align="center" width="60">
						<?=$paytype?>
					</td>
					<td align="center" cellpadding=0 cellspacing=0 width="67">
						<?=number_format($sell_amount)?>
					</td>

				</tr>
				<?
					if($cart[ct_present]) {
						$present = explode("|", $cart[ct_present]);

						for($p=0; $present[$p]; $p++) {

							if($bgc%2) $bgcolorcart = "bgcolor=#FFFBF7";
								else $bgcolorcart = "bgcolor=#FFFBF7";

							$present_item = explode(",", $present[$p]);
							$sql_get = "select it_name, it_pay from {$GnTable[shopitem]} where it_id = '$present_item[0]' ";
							$item_get = sql_fetch($sql_get);

							$paytype = $default_paytype[p];
				?>
				<tr <?=$bgcolorcart?>>
					<td align="center" cellpadding=0 cellspacing=0>
						<?=$item_get[it_name]?>
					</td>
					<td align="center" width="50">
						<?=number_format($item_get[it_pay])?>
					</td>
					<td align="center" width="30">
						<?=$present_item[1]?>
					</td>

					<td align="center" width="60">
						<?=$paytype?>
					</td>
					<td align="center" cellpadding=0 cellspacing=0>
						<?=number_format(0)?>
					</td>

				</tr>
				<?
							$bgc++;
						}
					}
				?>
			<?
						$bgc++;
					}
			?>
			<?
				if($row[od_present]) {

					if($bgc%2) $bgcolorcart = "bgcolor=#FFFBF7";
						else $bgcolorcart = "bgcolor=#FFFBF7";

				$presents = explode(",", $row[od_present]);
				$sql_pt = "select it_name, it_pay from {$GnTable[shopitem]} where it_id = '$presents[0]' ";
				$result_pt = sql_query($sql_pt);
				$pt=mysql_fetch_array($result_pt);

				$paytype = $default_paytype[p];
			?>
				<tr <?=$bgcolorcart?>>
					<td align="center" cellpadding=0 cellspacing=0>
						<?=$pt[it_name]?>
					</td>
					<td align="center">
						<?=number_format($pt[it_pay])?>
					</td>
					<td align="center">
						<?=$presents[1]?>
					</td>

					<td align="center">
						<?=$paytype?>
					</td>
					<td align="center" cellpadding=0 cellspacing=0>
						<?=number_format(0)?>
					</td>

				</tr>
			<?
				}
				$tot_sell_amount = $tot_sell_amount + $row[od_send_cost] - $row[od_dc_amount]
			?>

				<tr><td colspan="5" align="right">
						<? if($row[od_send_cost]) { ?>
						배송료 : <?=number_format($row[od_send_cost])?>&nbsp;&nbsp;&nbsp;<br>
						<? } ?>
						<? if($row[od_dc_amount]) { ?>
						DC : <?=number_format($row[od_dc_amount])?>&nbsp;&nbsp;&nbsp;<br>
						<? } ?>
						합계 : <?=number_format($row['od_temp_bank']+$row['od_temp_card'])?>&nbsp;&nbsp;&nbsp;<br><!--$tot_sell_amount-->

						<? if($row[od_settle_case]=="신용카드") { ?>
							카드 결제액: <?=number_format($row[od_receipt_card])?>&nbsp;&nbsp;&nbsp;
						<? } else if($row[od_settle_case]=="계좌이체") { ?>
							실시간 계좌이체금액 : <?=number_format($row[od_receipt_bank])?>&nbsp;&nbsp;&nbsp;
						<? } else if($row[od_settle_case]=="가상계좌") { ?>
							가상계좌 입금액: <?=number_format($row[od_receipt_bank])?>&nbsp;&nbsp;&nbsp;
						<? } else if($row[od_settle_case]=="무통장") { ?>
								무통장 입금액: <?=number_format($row[od_receipt_bank])?>&nbsp;&nbsp;&nbsp;
						<?	} ?>
				</td></tr>
				</table>
				</td>

				<td align="center" cellpadding=0 cellspacing=0>
					<?=$row[od_b_addr1]?> <?=$row[od_b_addr2]?>
				</td>

				<td align="center" cellpadding=0 cellspacing=0>
					<?=$row[od_name]?><br><?=$row[od_tel]?><br><?=$row[od_hp]?>
				</td>

				<td align="center" cellpadding=0 cellspacing=0>
					<?=$row[od_invoice]?>
				</td>

				<td align="center" cellpadding=0 cellspacing=0>
					<?=$row[od_memo]?>
				</td>

			</tr>
<?
					$totalcost = $totalcost + $tot_sell_amount;
					//$totalcost = $totalcost + $row['od_temp_bank'] + $row['od_temp_card'];
					$total_card += $row[od_receipt_card];
					$total_cash += $row[od_receipt_bank];

					$tot_tot_qty++;
					if($row[od_receipt_bank]) $tot_cash_qty ++;
					if($row[od_receipt_card]) $tot_card_qty++;
	}
	if($i==0) {
?>
			    <tr bgcolor=#f9f9f9>
					<td colspan="8" align="center" height="50" valign="middle">
						입력된 자료가 없습니다.
					</td>
			    </tr>
<?
	}
	if($ct_status!="주문"){
?>
    <tr>
        <td colspan=8 bgcolor=#FFFFFF>
            <table width="" cellpadding=2 cellspacing=0 border=1 bordercolordark='white' bordercolorlight='gray' align=right>
            <tr>
                <td colspan=2 align=right><b>카 드 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_card_qty)?></td>
                <td align=right width=80><?=number_format($total_card);?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=2 align=right><b>입 금 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_cash_qty)?></td>
                <td align=right width=80><?=number_format($total_cash);?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=2 align=right><b>전 체 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($totalorder)?></td>
                <td align=right width=80><?=number_format($totalcost)?>&nbsp;</td>
            </tr>
            </table>
        </td>
    </tr>
<?
	}
?>
</table>

<br><br>

<center><a href="JavaScript:window.close()">닫 기</a></center>

</body>
</html>
