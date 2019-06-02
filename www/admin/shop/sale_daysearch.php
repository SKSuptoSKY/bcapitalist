<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";
?>
<style type="text/css">

	body{font-family:굴림, Gulim;font-size:12px; text-decoration:none;};
	td{font-family:굴림, Gulim;font-size:12px; text-decoration:none;};
	a:link{color:#676666; font-family:굴림, arial;font-size:12px; text-decoration:none;};
	a:visited{color:#676666; font-family:굴림, arial;font-size:12px; text-decoration:none;};	
	a:hover{color:red; font-family:굴림, arial;font-size:12px; text-decoration:none;}

</style>
<html>
<head>
<title>seoullit.com</title>
<body>

<center><br>

<script language="javascript">

   function dochange(url)
   {
   	document.form1.action=url;
	document.form1.submit();
   }
   
</script>

<?
if ($sale_search_y=="") {
  $isdate	= date("Y-m-d",time());
} else  {
  $isdata = mktime(0,0,0,$sale_search_m,$sale_search_d,$sale_search_y);
  $isdate =  date("Y-m-d",$isdata);
}
?>

			<table bgcolor="#FFCF9C" border=0 cellpadding=3 cellspacing=1>
			<tr height=30 align=center bgcolor="#FFE7D6">
				<td width="25" rowspan="2">번호</td>
				<td width="50" rowspan="2">주문번호</td>
				<td width="80" rowspan="2">받으시는분</td>				
				<td width="457">주문내역</td>
				<td width="120" rowspan="2">받으시는분 주소</td>
				<td width="80" rowspan="2">주문하신분</td>
				<td width="70" rowspan="2">운송장번호</td>
				<td width="60" rowspan="2">배송지요청사항</td>

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

	$sql = "select count(*) as cnt from shop_order where left(od_time,10) = '$isdate' and (od_receipt_card > 0 or od_receipt_bank > 0)";
	$result = sql_query($sql);
	$row=mysql_fetch_array($result);
	$totalorder = $row[cnt];

	$sql = "select * from shop_order where left(od_time,10) = '$isdate' and (od_receipt_card > 0 or od_receipt_bank > 0)";
	$result = sql_query($sql);

	for($i=0; $row=mysql_fetch_array($result); $i++) {
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
						   from shop_cart a, 
								shop_item b
						  where a.on_uid = '$row[on_uid]'
							and a.it_id  = b.it_id
						  order by a.ct_id ";
				$result_cart = sql_query($sql_cart);
				$bgc = 0;
				for ($j=0; $cart=mysql_fetch_array($result_cart); $j++) {	

					if($bgc%2) $bgcolorcart = "bgcolor=#FFFBF7";
						else $bgcolorcart = "bgcolor=#FFFBF7";
					$paytype = $default_paytype[$cart[ct_paytype]];	// 구매가격 타입을 출력합니다.
					$sell_amount = $cart[ct_amount] * $cart[ct_qty];
					$tot_sell_amount += $sell_amount;
			?>
				<tr <?=$bgcolorcart?>>
					<td align="center" cellpadding=0 cellspacing=0 width="250">
						<?=$cart[it_name]?>
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
							$sql_get = "select it_name, it_pay from shop_item where it_id = '$present_item[0]' ";
							$item_get = sql_fetch($sql_get);

							$paytype = $default_paytype[3];
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

					if($bgc%2) $bgcolorcart = "bgcolor=#FFFBF7";
						else $bgcolorcart = "bgcolor=#FFFBF7";

				$presents = explode(",", $row[od_present]);
				$sql_pt = "select it_name, it_pay from shop_item where it_id = '$presents[0]' ";
				$result_pt = sql_query($sql_pt);
				$pt=mysql_fetch_array($result_pt);

				$paytype = $default_paytype[3];
			?>
				<tr <?=$bgcolorcart?>>
					<td align="center" cellpadding=0 cellspacing=0 width="250">
						<?=$pt[it_name]?>
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
			?>

				<tr><td colspan="5" align="right">
				<? if($row[od_send_cost]) { ?>
				배송료 : <?=number_format($row[od_send_cost])?>&nbsp;&nbsp;&nbsp;<br>
				<? } ?>
				<? if($row[od_dc_amount]) { ?>
				DC : <?=number_format($row[od_dc_amount])?>&nbsp;&nbsp;&nbsp;<br>
				<? } ?>
				<? if($row[od_receipt_card]) { ?>
				카드 : <?=number_format($row[od_receipt_card])?>&nbsp;&nbsp;&nbsp;<br>
				<? } ?>
				<? if($row[od_receipt_bank]) { ?>
				현금 : <?=number_format($row[od_receipt_bank])?>&nbsp;&nbsp;&nbsp;<br>
				<? } ?>
				합계 : <?=number_format($tot_sell_amount + $row[od_send_cost])?>&nbsp;&nbsp;&nbsp;
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
					$totalcost = $totalcost + $tot_sell_amount + $row[od_send_cost];
					$total_card += $row[od_receipt_bank];
					$total_cash += $row[od_receipt_card];
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
?>
</table>
</br>

			카드판매액 \<?=number_format($total_card);?> + 현금판매액 \<?=number_format($total_cash);?> = 총판매액 : \<?=number_format($totalcost)?>원
<br><br>

<a href="JavaScript:window.close()">닫 기</a>

</body>

</html>