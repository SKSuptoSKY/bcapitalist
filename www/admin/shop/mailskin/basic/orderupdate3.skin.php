<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$charset?>">
<link rel="stylesheet" href="http://<?=$_SERVER[SERVER_NAME]?>/css/style.css" type="text/css">
<title>고객님께 주문서 메일 드리기</title>
</head>

<style>
body, th, td, form, input, select, text, textarea, caption { font-size: 12px; font-family:굴림;}
</style>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<Table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
			<Table width="720px;" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td align="right" class="title"><?=$default[site_name]?></td>
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
					<td style="border:2px solid #ebebeb;" height="47px;" >
						<table width="" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="25px;"></td>
								<td><strong >주문일자</strong></td>
								<td width="15px;"></td>
								<td><strong><?=date("Y m.d")?></strong></td>
								<Td style="color:#dddddd; padding-left:15px; padding-right:15px;">|</td>
								<td><strong >주문번호</strong></td>
								<td width="15px;"></td>
								<td><strong style="color:#05c300;"><?=$LGD_OID?></strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="30px;"></td>
				</tr>
				<tr>
					<td valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="0" valign="top"  class="tbl_type">
							<colgroup>
								<col />
								<col width="20%"/>
								<? if($sitemenu["point_use"]==TRUE && $Get_Login==TRUE) {  ?>
									<col width="12%"/>
								<? } ?>
								<col width="12%"/>
							</colgroup>
							<tr>
								<th style="padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:1px solid #e2e2e5;">상품정보</th>
								<th style="padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:1px solid #e2e2e5;">삼품금액(수량)</td>
								<? if($sitemenu["point_use"]==TRUE && $Get_Login==TRUE) {  ?>
									<th style="padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:1px solid #e2e2e5;">적립금</th>
								<? } ?>
								<th style="background:#f7f7f7;padding:10px 0 10px 0;border-top:2px solid #383d4a; font-weight:bold; border-bottom:1px solid #e2e2e5;" >소계</th>
							</tr>
						    <? for ($i=0; $i<count($list); $i++) { ?>							
								<tr>
									<td style="padding-left:25px;padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;" valign="top">
										<Table width="" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td style="padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;"><?=$list[$i][it_simg]?></td>
												<td style="padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;" width="30px;"></td>
												<td style="padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;" valign="top" valign="top">
													<table width="100%" cellpadding="0" cellspacing="0" border="0">
														<tr>
															<td style="padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;">
																<?=$list[$i][it_name]?>
																<p style="font-size:11px; color:#b6b7bc;"><?=$list[$i][it_opt]?></p>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
									<td style="padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;" align="center"><?=display_amount($list[$i][ct_amount])?><br/>(<?=number_format($list[$i][ct_qty])?>개)</td>
									<? if($sitemenu["point_use"]==TRUE && $Get_Login==TRUE) {  ?>
										<td style="padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;" align="center"><?=display_amount($list[$i][stotal_point])?></td>
									<? } ?>
									<td style="background:#f7f7f7; text-align:center; font-weight:bold;padding:7px 0 7px 0;border-top:1px solid #e5e5e5;color:#4c4c4c; border-bottom:none; border-top:none; line-height:18px;"><?=display_amount($list[$i][stotal_amount])?></td>
								</tr>
								<tr>
									<td height="1" bgcolor="#cccccc" colspan="<?=($sitemenu["point_use"]==TRUE && $Get_Login==TRUE)?"4":"3";?>"></td>
								</tr>
							<? } ?>
						</table>
					</td>
				</tr>
				<tr>
					<td height="40px;"></td>
				</tr>
				<tr>
					<td align="right">
						<Table width="" cellpadding="0" cellspacing="0" border="0">
							<? if($sitemenu["point_use"]==TRUE && $Get_Login==TRUE) {  ?>
							<Tr>
								<td>적립금</td>
								<Td width="10px;"></td>
								<td style="font-weight:bold;"><?=display_amount($ttotal_point)?></td>
							</tr>
							<? } ?>
							<tr>
								<td height="10px;"></td>
							</tr>
							  <? if ($od_send_cost > 0) { // 배송비가 있다면 ?>
							<Tr>
								<td>배송비</td>
								<Td width="10px;"></td>
								<td style="font-weight:bold;"><?=display_amount($od_send_cost)?></td>
							</tr>
							<? } ?>
							<tr>
								<td height="10px;"></td>
							</tr>
							<Tr>
								<td>총계</td>
								<Td width="10px;"></td>
								<td style="font-weight:bold; color:#05c300; font-size:16px;"><?=display_amount($ttotal_amount)?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="20px;"></td>
				</tr>
				<tr>
					<td style="border:1px dashed #e2e2e5;" > </td>
				</tr>
				<tr>
					<td height="40px;"></td>
				</tr>
				<tr>
					<td><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/cash_title1.jpg"></td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tbl_type2">
							<colgroup>
								<col width="20%"/>
								<col width="80%"/>
							</colgroup>
                        <? if ($od_settle_case=="신용카드") { ?>
							<tr>
								<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">신용카드 결제액</th>
								<td style="border-top:2px solid #383d4a;padding-left:5px;"><?=display_amount($od_receipt_card)?></td>
							</tr>
                        <? } ?>
						<? if ($od_settle_case=="계좌이체") { ?>
							<tr>
								<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">계좌이체 금액</th>
								<td style="border-top:2px solid #383d4a;padding-left:5px;"><?=display_amount($od_receipt_card)?></td>
							</tr>
                        <? } ?>
						<? if ($od_settle_case=="가상계좌") { ?>
							<tr>
								<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">가상계좌 입금예정 금액</th>
								<td style="border-top:2px solid #383d4a;padding-left:5px;"><?=display_amount($od_temp_bank	)?></td>
							</tr>
                        <? } ?>
						<? if ($od_settle_case=="무통장") { ?>							
							<tr>
								<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">무통장 입금예정액</th>
								<td style="border-top:2px solid #383d4a;padding-left:5px;"><?=display_amount($od_temp_bank	)?></td>
							</tr>
						<? } ?>
                        <? if ($od_receipt_point > 0) { ?>
							<tr>
								<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">포인트 입금액</th>
								<td style="border-top:2px solid #383d4a;padding-left:5px;"><?=display_point($od_receipt_point)?></td>
							</tr>
                        <? } ?>
						<? if ($od_receipt_bank > 0) { ?>		
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">계좌번호</th>
								<td style="padding-left:5px;"><?=$od_bank_account?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">입금자 이름</th>
								<td style="padding-left:5px;"><?=$od_deposit_name?></td>
							</tr>
						<? } ?>
						</table>
					</td>
				</tr>
				<tr>
					<td height="30px;"></td>
				</tr>
				<tr>
					<td>
						<Table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/cash_title2.jpg"></td>
								<td align="right" style="font-size:11px;">상세한 내용은 주문서 조회 화면에서 확인하실 수 있습니다.&nbsp;&nbsp;
								<!-- <a href="http://<?=$_SERVER[SERVER_NAME]?>/n_shop/myorder_view.php?od_id=<?=$LGD_OID?>&on_uid=<?=$s_on_uid?>" target="_blank"> -->
								<a href="http://<?=$_SERVER[SERVER_NAME]?>/shop/login_order.php?URL=/shop/myorder_list.php" target="_blank">
									<img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/go.jpg" align="absmiddle" border="0">
								</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tbl_type2">
							<colgroup>
								<col width="20%"/>
								<col width="80%"/>
							</colgroup>
							<tr>
								<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">이름</th>
								<td style="border-top:2px solid #383d4a;padding-left:5px;"><?=$od_name?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">전화번호</th>
								<td style="padding-left:5px;"><?=$od_tel?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">핸드폰</th>
								<td style="padding-left:5px;"><?=$od_hp?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">주소</th>
								<td style="padding-left:5px;"><?=$od_addr1?><br> <?=$od_addr2?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="30px;"></td>
				</tr>
				<tr>
					<td>
						<Table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/cash_title3.jpg"></td>
								<td align="right" style="font-size:11px;">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tbl_type2">
							<colgroup>
								<col width="20%"/>
								<col width="80%"/>
							</colgroup>
							<tr>
								<th style="border-top:2px solid #383d4a;padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">이름</th>
								<td style="border-top:2px solid #383d4a;padding-left:5px;"><?=$od_b_name?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">전화번호</th>
								<td style="padding-left:5px;"><?=$od_tel?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">핸드폰</th>
								<td style="padding-left:5px;"><?=$od_hp?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">주소</th>
								<td style="padding-left:5px;"><?=$od_addr1?> <br><?=$od_addr2?></td>
							</tr>
							<tr>
								<th style="padding:10px 0 10px 0; background:#f9f9f9; text-align:center;">전하실 말씀</th>
								<td style="padding-left:5px;word-break:break-all;"><?=$od_memo?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="25px;"></td>
				</tr>
				<tr>
					<td align="center"><a href="http://<?=$_SERVER[SERVER_NAME]?>" target="_blank"><img src="http://<?=$_SERVER[SERVER_NAME]?>/images/shop/homego.jpg" border="0"></a></td>
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
