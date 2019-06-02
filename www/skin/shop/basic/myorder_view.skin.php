<style type="text/css">
<!--
.Tb_line { border-bottom: 1px solid #999999 }
.T_icon { font-size:11px; color:red }
.style1 {
color: #000000;
font-weight: bold;
}
-->
.shop_boardtb th{text-align:left;}
</style>
<!-- 테이블의 시작 -->
<table width="810" border="0" cellspacing="0" cellpadding="0">

<tr>
<td height="20"></td>
</tr>
<tr>
<td>
<!-- 테이블의 시작 -->
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
	<td class="onlin_noline">
	<!--구매상품내역 테이블 시작 -->
	<?
	$s_on_uid = $od[on_uid];
	$s_page = "myorder_view.php";
	include "./shopbag_inc.php";
	?>
	<!--구매상품내역 테이블 끝    -->	</td>
	</tr>
	<tr>
	  <td height="50" align="center" >&nbsp;
	  </td>
	  </tr>
	<tr>
	  <td>
	<!-- 테이블의 시작 -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr>
		<td height="30"><span class="style1">주문자 정보</span></td>
		</tr>
		<tr>
		<td >
		<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardtb">

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 주문하시는분</th>
			<td width="79%" style="padding-left:20px;"> <?=$od[od_name] ?></td>
			</tr>

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 전화번호</th>
			<td width="79%" style="padding-left:20px;"> <?=$od[od_tel] ?></td>
			</tr>

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 휴대전화</th>
			<td width="79%" style="padding-left:20px;"> <?=$od[od_hp]?></td>
			</tr>

			<tr>
			<th width="21%" height="24"  style="padding-left:20px;"> 이메일</th>
			<td width="79%" style="padding-left:20px;"> <?=$od[od_email]?></td>
			</tr>

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 주소</th>
			<td width="79%" style="padding-left:20px;"> <? echo sprintf("(%s-%s) %s %s", $od[od_zip1], $od[od_zip2], $od[od_addr1], $od[od_addr2]); ?></td>
			</tr>

			</table>
		<!-- 테이블의 끝 -->		</td>
		</tr>
		</table>
	<!-- 테이블의 끝 -->	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<!-- 테이블의 시작 -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td height="30"><span class="style1">배송지 정보</span></td>
		</tr>
		<tr>
		<td >
		<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardtb">

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 받으시는분</th>
			<td width="79%" style="padding-left:20px;"> <?=$od[od_b_name]?></td>
			</tr>

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 전화번호</th>
			<td width="79%" style="padding-left:20px;"> <?=$od[od_b_tel]?></td>
			</tr>

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 휴대전화</th>
			<td width="79%" style="padding-left:20px;"> <?=$od[od_b_hp] ?></td>
			</tr>

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 주소</th>
			<td width="79%" style="padding-left:20px;"> <? echo sprintf("(%s-%s) %s %s", $od[od_b_zip1], $od[od_b_zip2], $od[od_b_addr1], $od[od_b_addr2]); ?></td>
			</tr>

			<tr>
			<th width="21%" height="25"  style="padding-left:20px;"> 요청사항</th>
			<td width="79%" style="padding-left:20px;"> <? echo nl2br(htmlspecialchars2($od[od_memo])); ?></td>
			</tr>

			</table>
		<!-- 테이블의 끝 -->		</td>
		</tr>
		</table>
	<!-- 테이블의 끝 -->	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<!-- 테이블의 시작 -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<tr>
		<td height="30"><span class="style1">결제정보</span></td>
		</tr>
		<tr>
		<td >
		<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardtb">

			<? if ($od[od_receipt_point] > 0) { ?>
			<tr>
			<th height=25 align="left" style='padding-left:15px;'>포인트입금</font></td>
			<td style='padding-left:5px;' ><? echo display_point($od[od_receipt_point]) ?></td>
			</tr>
			<? } ?>
			<? if ($od[od_settle_case] =="무통장" ) { ?>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>무통장입금액</font></td>
			<td style='padding-left:5px;'><? echo display_amount($od[od_temp_bank] - $od[od_receipt_point]) ?></td>
			</tr>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>계좌번호</font></td>
			<td style='padding-left:5px;'><? echo $od[od_bank_account]; ?></td>
			</tr>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>입금하시는분</font></td>
			<td style='padding-left:5px;'><? echo $od[od_deposit_name]; ?></td>
			</tr>
			<? } ?>

			<? if ($od[od_settle_case]=="신용카드") { ?>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>신용카드 :</font></td>
			<td style='padding-left:5px;'><? echo display_amount($od[od_receipt_card]) ?></td>
			</tr>
			<? } ?>

			<? if ($od[od_settle_case] =="가상계좌" ) { ?>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>입금하실금액</font></td>
			<td style='padding-left:5px;'><? echo display_amount($od[od_temp_bank] - $od[od_receipt_point]) ?></td>
			</tr>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>입금하실 계좌번호</font></td>
			<td style='padding-left:5px;'><? echo $od[od_bank_account]; ?></td>
			</tr>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>입금하시는분</font></td>
			<td style='padding-left:5px;'><? echo $od[od_deposit_name]; ?></td>
			</tr>
			<? } ?>

			<? if ($od[od_settle_case] =="계좌이체" ) { ?>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' style='padding-left:15px;'>계좌이체금액 : </font></td>
			<td style='padding-left:5px;'><? echo display_amount($od[od_receipt_bank]) ?></td>
			</tr>
			<tr>
			<? } ?>

			<? if ($od[od_settle_case]=="휴대폰") { ?>
			<tr>
			<th height=25 align="left" bgcolor='#F9F9F9' align="left" style='padding-left:15px;'> 휴대폰 :</font></td>
			<td style='padding-left:5px;'><? echo display_amount($od[od_receipt_card]) ?></td>
			</tr>
			<? } ?>

			<tr>
			<th width="21%" align="left" height=25 bgcolor='#F9F9F9' style='padding-left:15px;'><font color=#B60F04> <b>주문번호 : </b></font></th>
			<td width="79%" align="left" style='padding-left:5px;'><font color=#B60F04><b><?=$od[od_id]?></b></font>
			<?if( $od[od_cancel_flag] == 1){?>

			<?}else if(($od[od_receipt_bank] > 0 || $od[od_receipt_card] > 0)){?>
				<span style="color:#ff0000"> &nbsp;(* 입금 처리 후 취소가 불가능합니다. 취소시 고객센터에 문의주세요)</span>
			<? }else{ ?>
				<a href="javascript:;" onclick="order_cancel('<?=$od[od_id]?>','<?=$od[on_uid]?>')"><span style="color:#0000ff">[주문취소]</span></a>
			<? } ?>
			</td>
			</tr>

			</table>
		<!-- 테이블의 끝 -->		</td>
		</tr>
		</table>
	<!-- 테이블의 끝 -->	</td>
	</tr>
	<tr>
	<td height=10></td>
	</tr>
	<? if($od[od_invoice]==TRUE) { ?>
	<tr>
	<td>
	<!-- 테이블의 시작 -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td height="8"> </td>
		</tr>
		<tr>
		<td >
		<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardtb">
			<tr>
				<th width="150" height=25 bgcolor='#F9F9F9' style='padding-left:5px;'> 배송회사 :</font></th>
				<td style='padding-left:5px;'><?=$dec[dl_company]?></td>
			</tr>
			<tr>
				<th width="150" height=25 bgcolor='#F9F9F9' style='padding-left:5px;'> 배송사연락처 :</font></th>
				<td style='padding-left:5px;'><?=$dec[dl_tel]?></td>
			</tr>
			<tr>
				<th height=25 bgcolor='#F9F9F9' style='padding-left:5px;'> 배송일자 :</font></th>
				<td style='padding-left:5px;'><?=$od[od_invoice_time]?></td>
			</tr>
			<tr>
				<th height=25 bgcolor='#F9F9F9' style='padding-left:5px;'> 운송장번호 :</font></th>
				<td style='padding-left:5px;'><a href="<?=$dec[dl_url]?><?=$od[od_invoice]?>" target="_blank"><?=$od[od_invoice]?></a></td>
			</tr>
			</table>
		<!-- 테이블의 끝 -->		</td>
		</tr>
		</table>
	<!-- 테이블의 끝 -->	</td>
	</tr>
	<tr>
	<td height=10></td>
	</tr>
	<? } ?>
	<tr>
	<td align=center>
	<a href="myorder_list.php"><div class="btn_list" style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">목록보기</div></a>
	<? if($ch[od_id] == "" && $od[od_receipt_bank] && $od[od_bank_time] > $cash_checktime) { ?>
	&nbsp;<!--a href="#asd" onclick="cashcheck();"><img src="/member/images/btn_cash.jpg" width="99" height="26" border="0"></a-->
	<? } ?>	</td>
	</tr>
	</table>
<!-- 테이블의 끝 -->
</td>
</tr>
<tr>
<td height="50" align="center">&nbsp;</td>
</tr>
</table>
<script type="text/javascript">
<!--
	function order_cancel(od_id,on_uid){
		if(confirm('정말 취소 하시겠습니까?')){
			document.location.href="./cancel_update.php?od_id="+od_id+"&on_uid="+on_uid;
		}
		return false;
	}
//-->
</script>
<!-- 테이블의 끝 -->
