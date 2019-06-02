<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$charset?>">
<title>주문내역 처리 현황</title>
</head>

<style>
body, th, td, form, input, select, text, textarea, caption { font-size: 12px; font-family:굴림;}
.line {border: 1px solid #dfdfdf;}
</style>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<div style="padding-top:100px;"></div>
<Table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
			<Table width="720px;" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td align="right" style="font-size:15px; font-weight:bold;"><?=$default[site_name]?></td>
				</tr>
				<tr>
					<td height="15px;"></td>
				</tr>
				<tr>
					<Td style="border-top:2px solid #88bf4a;">&nbsp;</td>
				</tr>
				<tr>
					<td height="40px;"></td>
				</tr>
				<tr>
					<td><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/cash_title10.jpg"></td>
				</tr>
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="0"valign="top"  style="width:100%;">
							<colgroup>
								<col width="30%"/>
								<col width="30%"/>
								<col width="25%"/>
								<col width="15%"/>
							</colgroup>
							<tr>
								<th style="padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:2px solid #e2e2e5;">상품명</th>
								<th style="padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:2px solid #e2e2e5;">선택옵션</th>
								<th style="padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:2px solid #e2e2e5;">처리상태</th>
								<th style="background:#f7f7f7;padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:2px solid #e2e2e5;">수량</th>
							</tr>
							  <? for ($i=0; $i<count($cart_list); $i++) { ?>
									<tr align="center">
										<td style="padding:7px 0 7px 0;color:#4c4c4c; border-bottom:1px solid #e2e2e5;line-height:18px;"><a href='http://<?=$_SERVER[SERVER_NAME]?>/shop/item.php?it_id=<?=$cart_list[$i][it_id]?>' target="_blank"><?=$cart_list[$i][it_name]?></a></td>
										<td style="font-size:11px; color:#b6b7bc;padding:7px 0 7px 0;color:#4c4c4c; border-bottom:1px solid #e2e2e5; border-top:none; line-height:18px;"><?=$cart_list[$i][it_opt]?>&nbsp;</td>
										<td style="padding:7px 0 7px 0;color:#4c4c4c; border-bottom:1px solid #e2e2e5;line-height:18px;">주문</td>
										<td style="background:#f7f7f7;padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:1px solid #e2e2e5; border-top:none; line-height:18px;"><?=$cart_list[$i][ct_qty]?></td>
									</tr>
								<? } ?>
						</table>
					</td>
				</tr>
				<tr>
					<td height="40px;"></td>
				</tr>


				<? if (count($card_list)) { ?>
						<tr>
							<td style="font-size:13px; font-weight:bold; color:#67b706;" valign="top"><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/dot.jpg" align="absmiddle">신용카드 입금을 
              확인하였습니다</td>
						</tr>
						<tr>
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;">
									<colgroup>
										<col width="20%"/>
										<col width="80%"/>
									</colgroup>
									<tr>
										<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;border-bottom:1px solid #e7e7e7;">승인일시</th>
										<td style="border-top:2px solid #383d4a;padding:10px 0 10px 10px; border-bottom:none; border-top:2px solid #383d4a; line-height:18px;border-bottom:1px solid #e7e7e7;"><?=$card_list[od_card_time]?>  </td>
									</tr>
									<tr>
										<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;border-bottom:1px solid #e7e7e7;">승인금액</th>
										<td style="padding:10px 0 10px 10px; border-bottom:none; border-top:none; line-height:18px;border-bottom:1px solid #e7e7e7;"><?=$card_list[od_receipt_card]?>  </td>
									</tr>
								</table>
							</td>
						</tr>
				<? } ?>

				<? if (count($bank_list)) { ?>
						<tr>
							<td style="font-size:13px; font-weight:bold; color:#67b706;" valign="top"><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/dot.jpg" align="absmiddle">무통장 입금을 확인하였습니다</td>
						</tr>
						<tr>
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;">
									<colgroup>
										<col width="20%"/>
										<col width="80%"/>
									</colgroup>
									<tr>
										<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;border-bottom:1px solid #e7e7e7;">확인일시</th>
										<td style="border-top:2px solid #383d4a;padding:10px 0 10px 10px; border-bottom:none; border-top:2px solid #383d4a; line-height:18px;border-bottom:1px solid #e7e7e7;"> <?=$bank_list[od_bank_time]?>  </td>
									</tr>
									<tr>
										<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;border-bottom:1px solid #e7e7e7;">입금액</th>
										<td style="padding:10px 0 10px 10px; border-bottom:none; border-top:none; line-height:18px;border-bottom:1px solid #e7e7e7;"> <?=$bank_list[od_receipt_bank]?>  </td>
									</tr>
									<tr>
										<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;border-bottom:1px solid #e7e7e7;">입금자명</th>
										<td style="padding:10px 0 10px 10px; border-bottom:none; border-top:none; line-height:18px;border-bottom:1px solid #e7e7e7;"> <?=$bank_list[od_deposit_name]?></td>
									</tr>
								</table>
							</td>
						</tr>
				<? } ?>
				<tr>
					<td height="25px;"></td>
				</tr>
				<tr>
					<td align="center"><a href="http://<?=$_SERVER[SERVER_NAME]?>" target="_blank"><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/homego.jpg"></a></td>
				</tr>
				<tr>
					<td height="20px;"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


</body>
</html>
