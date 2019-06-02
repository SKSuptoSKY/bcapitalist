<style type="text/css">
<!--
.Tb_line { border-bottom: 1px solid #999999 }
.T_icon { font-size:11px; color:red }
.style1 {
	text-align:left;
	color: #000000;
	font-weight: bold;
}
-->
.mypage_tbl{border-top:2px solid #ddd; }
.mypage_tbl th{text-align:left; background:#fafafa; height:28px; border-bottom:1px solid #dfdfdf; color:#333; }
.mypage_tbl td{text-align:left;border-bottom:1px solid #ddd;}
</style>
<table width="810" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td style="padding:0 6px 0 6px;" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10"> </td>
  </tr>
  <tr>
    <td>

            <!--구매상품내역 테이블 시작 -->
			<?
				$s_page = "";
				$s_on_uid = $_SESSION[ss_temp_on_uid];
				$od_id = $od[od_id];

				include "./shopbag_inc.php";
			?>
            <!--구매상품내역 테이블 끝    -->

	</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="30" align="left" style="padding-left:20px;"><span class="style1">주문자 정보</span></td>
        </tr>

        <tr>
          <td height="8"> </td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_tbl">

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 주문하시는분</th>
                <td width="79%" style="padding-left:20px;"> <?=$od[od_name] ?></td>
              </tr>

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 전화번호</th>
                <td width="79%" style="padding-left:20px;"> <?=$od[od_tel] ?></td>
              </tr>

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 휴대전화</th>
                <td width="79%" style="padding-left:20px;"> <?=$od[od_hp]?></td>
              </tr>

              <tr>
                <th width="21%" height="24" style="padding-left:20px;"> 이메일</th>
                <td width="79%" style="padding-left:20px;"> <?=$od[od_email]?></td>
              </tr>

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 주소</th>
                <td width="79%" style="padding-left:20px;"> <? echo sprintf("(%s) %s %s", $od[od_zip], $od[od_addr1], $od[od_addr2]); ?></td>
              </tr>

            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="30" align="left" style="padding-left:20px;"><span class="style1">배송지 정보</span></td>
        </tr>

        <tr>
          <td height="8"> </td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_tbl">

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 받으시는분</th>
                <td width="79%" style="padding-left:20px;"> <?=$od[od_b_name]?></td>
              </tr>

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 전화번호</th>
                <td width="79%" style="padding-left:20px;"> <?=$od[od_b_tel]?></td>
              </tr>
              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 휴대전화</th>
                <td width="79%" style="padding-left:20px;"> <?=$od[od_b_hp] ?></td>
              </tr>

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 주소</th>
                <td width="79%" style="padding-left:20px;"> <? echo sprintf("(%s) %s %s", $od[od_b_zip], $od[od_b_addr1], $od[od_b_addr2]); ?></td>
              </tr>

              <tr>
                <th width="21%" height="25" style="padding-left:20px;"> 요청사항</th>
                <td width="79%" style="padding-left:20px;"> <? echo nl2br(htmlspecialchars2($od[od_memo])); ?></td>
              </tr>

            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="30" align="left" style="padding-left:20px;"><span class="style1">결제정보</span></td>
        </tr>

        <tr>
          <td height="8"> </td>
        </tr>
        <tr>
          <td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mypage_tbl">
			<col width="21%">
			<col width="79%">
				<!-- ------------------------------------------------------------- [ 포인트입금 - START ] ------------------------------------------------------------- -->
				<? if ($od[od_receipt_point] > 0) { ?>
				<tr>
					<th height=25  style='padding-left:20px;'>포인트입금</font></th>
					<td style='padding-left:20px;'><? echo display_point($od[od_receipt_point]) ?></td>
				</tr>
				<? } ?>

				<!-- ------------------------------------------------------------- [ 무통장 - START ] ------------------------------------------------------------- -->
				<? if ($od[od_settle_case]=="무통장") { ?>
				<tr>
					<th height=25  style='padding-left:20px; text-align:left;'> 무통장입금액</font></th>
					<td style='padding-left:20px;'>
						<?=display_amount($od[od_temp_bank]-$od[od_receipt_point]);?>					</td>
				</tr>
				<tr>
					<th height=25  style='padding-left:20px; text-align:left;'> 계좌번호 </font></th>
					<td style='padding-left:20px;'><? echo $od[od_bank_account]; ?></td>
				</tr>
				<tr>
					<th height=25  style='padding-left:20px; text-align:left;'> 입금하시는분</font></th>
					<td style='padding-left:20px;'><? echo $od[od_deposit_name]; ?></td>
				</tr>
				<? } ?>

				<!-- ------------------------------------------------------------- [ 신용카드 - START ] ------------------------------------------------------------- -->
				<? if ($od[od_settle_case]=="신용카드") { ?>
				<tr>
					<th height=25  style='padding-left:20px; text-align:left;'> 신용카드</font></th>
					<td style='padding-left:20px;'><? echo display_amount($od[od_receipt_card]) ?></td>
				</tr>
				<? } ?>

				<!-- ------------------------------------------------------------- [ 가상계좌 - START ] ------------------------------------------------------------- -->
				<? if ($od[od_settle_case]=="가상계좌") { ?>
				<tr>
					<th height=25  style='padding-left:20px;'> 입금예정금액</font></th>
					<td style='padding-left:20px;'>
						<?=display_amount($od[od_temp_bank]-$od[od_receipt_point]);?>					</td>
				</tr>
				<tr>
					<th height=25  style='padding-left:20px;'> 입금하실 계좌번호</font></th>
					<td style='padding-left:20px;'><? echo $od[od_bank_account]; ?></td>
				</tr>
				<tr>
					<th height=25  style='padding-left:20px;'> 입금하시는분</font></th>
					<td style='padding-left:20px;'><? echo $od[od_deposit_name]; ?></td>
				</tr>
				<? } ?>

				<!-- ------------------------------------------------------------- [ 계좌이체 - START ] ------------------------------------------------------------- -->
				<? if ($od[od_settle_case]=="계좌이체") { ?>
				<tr>
					<th height=25  style='padding-left:20px;'> 계좌이체금액</font></th>
					<td style='padding-left:20px;'>
						<?=display_amount($od[od_receipt_bank])?>					</td>
				</tr>
				<? } ?>

				<!-- ------------------------------------------------------------- [ 휴대폰 - START ] ------------------------------------------------------------- -->
				<? if ($od[od_settle_case]=="휴대폰") { ?>
				<tr>
					<th height=25  style='padding-left:20px;'> 휴대폰</font></th>
					<td style='padding-left:20px;'><? echo display_amount($od[od_receipt_card]) ?></td>
				</tr>
				<? } ?>
				<tr>
					<th widtd="21%" height=25  style='padding-left:20px; text-align:left;'> 주문번호</th>
					<td widtd="79%" style='padding-left:20px;'><font color=#B60F04><b><?=$od[od_id]?></b></font></td>
				</tr>
            </table>
			</td>
        </tr>
      </table>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
		<a href="/shop/myorder_list.php"><div style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">확인</div></a>
        <?
		/*
        if ($od[od_temp_card]) {
            include "./ordercard_scrip.inc.php";
            echo "<input type='image' src='/image/order/button/payment.gif' border=0 onclick='OpenWindow();'>";
        } else if ($od[od_temp_bank] && $od[od_bank_account] == "실시간 계좌이체")  {
            include "./orderiche_scrip.inc.php";
            echo "<input type='image' src='/btn/btn_payment.gif' border=0 onclick='OpenWindow();'>";
        } else {
            echo "<a href='/shop/myorder_list.php'><img src='/btn/btn_ok.gif' border=0 align=absmiddle></a>";
        }
		*/
        ?>
    </td>
  </tr>
</table></td>
   </tr>
   <tr>
    <td height="50" align="center">&nbsp;</td>
   </tr>
  </table>
    <script type="text/javascript">
  <!--
	alert("회원이 아니신 경우 주문서 조회시 필요한\n\n주문번호('<?=$od[od_id]?>') 입력이 필요합니다.\n\n참고하시기 바랍니다");
  //-->
  </script>