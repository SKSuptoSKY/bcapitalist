<?
$page_loc="lecture";
include "../lib/lib.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = "Gn_Lecture_History";
$JO_table = "Gn_Lecture";

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
		$type_print = " order_date between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
	} else {
		$type_print = " od_id between '$fr_od_id' and '$to_od_id' ";
	}

	$sql = "select count(*) as cnt from $PG_table where $type_print $status_search and status = '결제완료'";
	$result = sql_query($sql);
	$row=mysql_fetch_array($result);
	$totalorder = $row[cnt];

	$sql = "select * from $PG_table where $type_print $status_search and status = '결제완료' order by order_date desc";
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
    echo iconv('utf-8','euc-kr',"출력할 내역이 없습니다.");
    exit;
}

?>
<?
if ($case == 1)
    echo "<p><b>[ $fr_date - $to_date $ct_status 내역 ]</b>";
else
    echo "<p><b>[ $fr_od_id - $to_od_id $ct_status 내역 ]</b>";
?>
			<table bgcolor="#FFCF9C" border=1 cellpadding=3 cellspacing=1 align=center>
				<tr height=30 align=center bgcolor="#FFE7D6">
					<td width="25" rowspan="2">번호</td>
					<td width="50" rowspan="2">주문번호</td>
					<td width="80" rowspan="2">신청자</td>
					<td width="50" rowspan="2">결제방법</td>
					<td width="457">주문내역</td>
					<td width="50" rowspan="2">상태</td>
					<td width="100" rowspan="2">연락처</td>
				</tr>
				<tr height=30 align=center bgcolor="#FFE7D6">
					<td>
						<table bgcolor="#FFCF9C" border=1 cellpadding=3 cellspacing=1 width="457">
							<tr>
								<td width="250" align="center" bgcolor="#FFE7D6">강의명</td>
								<td width="50" align="center" bgcolor="#FFE7D6">정가</td>
								<td width="60" align="center" bgcolor="#FFE7D6">부가세</td>
								<td width="67" align="center" bgcolor="#FFE7D6">총 금액</td>
							</tr>
						</table>
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
		$sql = "select * from Gn_Lecture where lec_no = '$row[order_lec]'";
		$lec = sql_fetch($sql);

		$vat = $row[order_pay] * 0.1;
?>

				<tr <?=$bgcolor?>>
					<td width="25" align="center"><?=$i?></td>
					<td align="center"><?=$row[order_idxx]?></td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[order_name]?></td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[type]?></td>
					<td align="center">
						<table bgcolor="#FFCF9C" border=1 cellpadding=3 cellspacing=1 width="457">
							<tr <?=$bgcolor?> width="457">
								<td align="center" cellpadding=0 cellspacing=0 width="250">
									<?=$lec[lec_subject]?>
								</td>
								<td align="center" width="50">
									<?=number_format($row[order_pay])?>
								</td>
								<td align="center" width="60">
									<?=number_format($vat)?>
								</td>
								<td align="center" width="67">
									<?=number_format($row[pay_mny])?>
								</td>
							</tr>
						</table>
					</td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[status]?></td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[order_mobile]?></td>
				</tr>

<?
					$totalcost += $row[pay_mny];
					//$totalcost = $totalcost + $row['od_temp_bank'] + $row['od_temp_card'];
					$total_card += $row[card_mny];
					$total_cash += $row[bank_mny];

					$tot_tot_qty++;
					if($row[bank_mny]) $tot_bank_qty ++;
					if($row[card_mny]) $tot_card_qty++;
					}
					if($i==0) {
?>
			    <tr bgcolor=#f9f9f9>
					<td colspan="7" align="center" height="50" valign="middle">
						입력된 자료가 없습니다.
					</td>
			    </tr>
<?
	}
	if($ct_status!="주문"){
?>
    <tr>
		<td bgcolor=#FFFFFF colspan=4></td>
        <td colspan=3 bgcolor=#FFFFFF>
            <table width="" cellpadding=2 cellspacing=0 border=1 bordercolordark='white' bordercolorlight='gray' align=right>
            <tr>
                <td colspan=4 align=right><b>카 드 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_card_qty)?></td>
                <td align=right width=80><?=number_format($total_card);?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=4 align=right><b>입 금 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_bank_qty)?></td>
                <td align=right width=80><?=number_format($total_cash);?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=4 align=right><b>전 체 합 계</b> &nbsp;</td>
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
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
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
					<td width="80" rowspan="2">신청자</td>
					<td width="50" rowspan="2">결제방법</td>
					<td width="457">주문내역</td>
					<td width="50" rowspan="2">상태</td>
					<td width="100" rowspan="2">연락처</td>
				</tr>
				<tr height=30 align=center bgcolor="#FFE7D6">
					<td>
						<table bgcolor="#FFCF9C" border=0 cellpadding=3 cellspacing=1 width="457">
							<tr>
								<td width="250" align="center" bgcolor="#FFE7D6">강의명</td>
								<td width="50" align="center" bgcolor="#FFE7D6">정가</td>
								<td width="60" align="center" bgcolor="#FFE7D6">부가세</td>
								<td width="67" align="center" bgcolor="#FFE7D6">총 금액</td>
							</tr>
						</table>
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
		$sql = "select * from Gn_Lecture where lec_no = '$row[order_lec]'";
		$lec = sql_fetch($sql);

		$vat = $row[order_pay] * 0.1;
?>

				<tr <?=$bgcolor?>>
					<td width="25" align="center"><?=$i?></td>
					<td align="center"><?=$row[order_idxx]?></td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[order_name]?></td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[type]?></td>
					<td align="center">
						<table bgcolor="#FFCF9C" border=0 cellpadding=3 cellspacing=1 width="457">
							<tr <?=$bgcolor?> width="457">
								<td align="center" cellpadding=0 cellspacing=0 width="250">
									<?=$lec[lec_subject]?>
								</td>
								<td align="center" width="50">
									<?=number_format($row[order_pay])?>
								</td>
								<td align="center" width="60">
									<?=number_format($vat)?>
								</td>
								<td align="center" width="67">
									<?=number_format($row[pay_mny])?>
								</td>
							</tr>
						</table>
					</td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[status]?></td>
					<td align="center" cellpadding=0 cellspacing=0><?=$row[order_mobile]?></td>
				</tr>
<?
					$totalcost += $row[pay_mny];
					//$totalcost = $totalcost + $row['od_temp_bank'] + $row['od_temp_card'];
					$total_card += $row[card_mny];
					$total_cash += $row[bank_mny];

					$tot_tot_qty++;
					if($row[bank_mny]) $tot_bank_qty ++;
					if($row[card_mny]) $tot_card_qty++;
					}
					if($i==0) {
?>
			    <tr bgcolor=#f9f9f9>
					<td colspan="7" align="center" height="50" valign="middle">
						입력된 자료가 없습니다.
					</td>
			    </tr>
<?
	}
	if($ct_status!="주문"){
?>
    <tr>
        <td colspan=7 bgcolor=#FFFFFF>
            <table width="" cellpadding=2 cellspacing=0 border=1 bordercolordark='white' bordercolorlight='gray' align=right>
            <tr>
                <td colspan=2 align=right><b>카 드 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_card_qty)?></td>
                <td align=right width=80><?=number_format($total_card);?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=2 align=right><b>입 금 합 계</b> &nbsp;</td>
                <td align=center width=50><?=number_format($tot_bank_qty)?></td>
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
