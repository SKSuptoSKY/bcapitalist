<?
if(!isset($mode)) {
	$page_loc="order";
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

	$PG_table = $GnTable["shoporder"];
	$JO_table = $GnTable["shopcart"];

if($findword != "") $sql_search = "and `".$findType."` like '%".$findword."%' ";

// 배송회사리스트 ---------------------------------------------
$delivery_options = "";
$sql = " select * from {$GnTable[shopdelivery]} order by dl_order ";
$result = sql_query($sql);
for($i=0; $row=mysql_fetch_array($result); $i++) {
    $delivery_options .= "<option value='$row[dl_id]'>$row[dl_company]";
}
// 배송회사리스트 end ---------------------------------------------

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
    $sst  = "od_id";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

$sql_common = "from $PG_table where (od_receipt_bank>0 or od_receipt_card>0) and (od_invoice='' and od_invoice_time = '0000-00-00 00:00:00')";

// 출력할 레코드를 얻음
$sql  = " select * 
           $sql_common 
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql);

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?")) 
	document.location.href = "./PAGECODE_update.php?mode=D&page=<?=$page?>&id=" +code;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 입금확인 리스트</font></strong> (일괄수정시 배송회사, 운송장번호, 발송시간이 모두입력된 상품만 수정됩니다.)
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
	<tr><td height="20" align=right style="padding:10px"><a href="./inpay_list.php?mode=excel&<?=$qstr?>">리스트엑셀다운</a></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
<form name=fcategorylist method='post' action='./inpay_listup.php' autocomplete='off' style="margin:0px;">
<input type=hidden name=page  value='<? echo $page ?>'>
<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
<input type=hidden name=sort2 value='<? echo $sort2 ?>'>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6"> 
					<td width="60" height="30" align="center"><strong>주문번호</strong></td>
					<td width="60"align="center"><strong>수하인명</strong></td>
					<td width="180" align="center"><strong>주소</strong></td>
					<td width="80" align="center"><strong>전화번호</strong></td>
					<td width="80" align="center"><strong>핸드폰</strong></td>
					<td width="80" align="center"><strong>배송회사</strong></td>
					<td width="100" align="center"><strong>운송장번호</strong></td>
					<td width="180" align="center"><strong>발송시간</strong></td>
				</tr>
			<?
				for ($i=0; $row=mysql_fetch_array($result); $i++)
				{
			?>
					<input type=hidden name='od_id[<?=$i?>]' value='<?=$row[od_id]?>'>
					<input type=hidden name='on_uid[<?=$i?>]' value='<?=$row[on_uid]?>'>
					<input type=hidden name='mb_id[<?=$i?>]' value='<?=$row[mb_id]?>'>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td height="25" align="center"><a href="/admin/shop/order_view.php?od_id=<?=$row[od_id]?>"><?=$row[od_id]?></a></td>
					<td align="center"><?=$row[od_b_name]?></td>
					<td align="center"><?="$row[od_b_addr1] $row[od_b_addr2]"?>[<?="$row[od_b_zip1]-$row[od_b_zip1]"?>]</td>
					<td align="center"><?=$row[od_b_tel]?></td>
					<td align="center"><?=$row[od_b_hp]?></td>
					<td align="center">
						<select name=<?="dl_id[$i]"?>>
						<option value=''>--------
						<?=$delivery_options?>
						</select>
					</td>
					<td align="center">
						<input type=text size=10 name='od_invoice[<?=$i?>]' value='<? echo is_null_time($row[od_invoice]) ? "" : $od[od_invoice]; ?>'>
					</td>
					<td align="center">	
						<input type=text name='od_invoice_time_<?=$i?>' maxlength=19 value='<? echo is_null_time($row[od_invoice_time]) ? "" : $od[od_invoice_time]; ?>'>
						<input type=checkbox name=od_invoice_chk_<?=$i?>
						value="<? echo date("Y-m-d H:i:s", time()); ?>"
						onclick="if (this.checked == true) this.form.od_invoice_time_<?=$i?>.value=this.form.od_invoice_chk_<?=$i?>.value; else this.form.od_invoice_time_<?=$i?>.value = this.form.od_invoice_time_<?=$i?>.defaultValue;">
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
		<td height="50"><input type=submit class=btn1 value='일괄수정'></td>
	</tr>
</form>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>
<?
} else if($mode=="excel") { 

	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 
	Admin_check();
	include "./lib/lib.php"; // 확장팩 사용함수
	$PG_table = $GnTable["shoporder"];
	$JO_table = $GnTable["shopcart"];

	//header('Content-Type: text/x-csv');
    header('Content-Type: doesn/matter');
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename="운송장준비' . date("ymd", time()) . '.csv"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');

if (!$sst) 
{
    $sst  = "od_id";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

$sql_common = "from $PG_table where (od_receipt_bank>0 or od_receipt_card>0) and (od_invoice='' and od_invoice_time = '0000-00-00 00:00:00')";

// 출력할 레코드를 얻음
$sql  = " select * 
           $sql_common 
           $sql_order ";
$result = sql_query($sql);

	echo "받는 사람,전화번호,핸드폰,주소,우편번호,상품명,수량,특이사항\n";
		for ($i=0; $row=mysql_fetch_array($result); $i++)
		{
			$sql_cart = "select a.*, b.it_name from $JO_table a, {$GnTable[shopitem]} b where a.on_uid = '$row[on_uid]' and b.it_id = a.it_id";
			$result_cart = sql_query($sql_cart);
			for ($c=0; $cart=mysql_fetch_array($result_cart); $c++)
			{
				if($c<1) {
				echo '"' . $row[od_b_name] . '"' . ',';
				echo '"' . $row[od_b_tel] . '"' . ',';
				echo '"' . $row[od_b_hp] . '"' . ',';
				echo '"' . $row[od_b_addr1]." ".$row[od_b_addr2] . '"' . ',';
				echo '"' . $row[od_b_zip1]."-".$row[od_b_zip1] . '"' . ',';
				echo '"' . $cart[it_name] . '"' . ',';
				echo '"' . $cart[ct_qty] . '"' . ',';
				echo '"' . $row[od_memo] . '"' . ',';
				echo "\n";
				} else {
				echo '" ",';
				echo '" ",';
				echo '" ",';
				echo '" ",';
				echo '" ",';
				echo '"' . $cart[it_name] . '"' . ',';
				echo '"' . $cart[ct_qty] . '"' . ',';
				echo '" ",';
				echo "\n";
				}
			}
		}
		if ($i == 0)
			echo "자료가 없습니다.\n";
    exit;
}
?>