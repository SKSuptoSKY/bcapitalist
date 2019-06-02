<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";

isAdmin();

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
		$status_search = " ";
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

	$sql = "select count(*) as cnt from shop_order where $type_print $status_search ";
	$result = sql_query($sql);
	$row=mysql_fetch_array($result);
	$totalorder = $row[cnt];

	$sql = "select * from shop_order where $type_print $status_search";
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
	<table>
<? 	for($i=1; $row=mysql_fetch_array($result); $i++) { ?>
		<tr>
			<td>
				<table width=300>
					<tr height=30>
						<td align=left><?=$row[od_b_zip1]?>-<?=$row[od_b_zip2]?></td>
					</tr>
					<tr height=30>
						<td><?=$row[od_b_addr1]?> <?=$row[od_b_addr2]?></td>
					</tr align=left>
					<tr height=30>
						<td align=center><?=$row[od_b_name]?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr ><td height=18></td></tr>
<? } ?>
	</table>
<?
    exit;
}
/////////////////////////// 화면에 출력할 경우 /////////////////////////////////////////
$result = mysql_query($sql) or die(mysql_error());
if (!$totalorder) {
    echo "<script>alert('출력할 내역이 없습니다.'); window.close();</script>";
    exit;
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
	<table>
<? 	for($i=1; $row=mysql_fetch_array($result); $i++) { ?>
		<tr>
			<td>
				<table width=300>
					<tr height=30>
						<td align=left><?=$row[od_b_zip1]?>-<?=$row[od_b_zip2]?></td>
					</tr>
					<tr height=30>
						<td><?=$row[od_b_addr1]?> <?=$row[od_b_addr2]?></td>
					</tr align=left>
					<tr height=30>
						<td align=center><?=$row[od_b_name]?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr ><td height=18></td></tr>
<? } ?>
	</table>
<br><br>

<center><a href="JavaScript:window.close()">닫 기</a></center>

</body>
</html>
