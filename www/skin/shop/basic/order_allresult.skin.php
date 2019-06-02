<style type="text/css">
<!--
.Tb_line { border-bottom: 1px solid #999999 }
.T_icon { font-size:11px; color:red }
.style1 {
	color: #000000;
	font-weight: bold;
}
-->
</style>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr> 
         <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td><img src="/images/subimg/subimgnamho.jpg" /></td>
		        </tr>
				<tr>
					<td height="30" class="naviall"><img src="<?=$GnShop["skin_url"]?>/images/add_icon.gif"><a href="../main.php">&nbsp;HOME</a>  &gt; <span class="navi2">주문하기</span></td>
				</tr>
<tr><td><img src="<?=$GnShop["skin_url"]?>/images/addr_line.gif"></td></tr>				
			</table></td>
     </tr>
	<tr> 
		<td height="10"></td>
	</tr>

   <tr> 
                            
    <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td>

            <!--구매상품내역 테이블 시작 -->
			<?
				$s_page = "";
				$s_on_uid = $on_uid;
				$od_id = $od[od_id];

				include "./shopbag_inc.php";
			?>
            <!--구매상품내역 테이블 끝    -->

	</td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="30"><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" />  <span class="style1">주문자 정보</span></td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#E6E6E6"> </td>
        </tr>
        <tr> 
          <td height="8"> </td>
        </tr>
        <tr> 
          <td bgcolor="#F9F9F9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ주문하시는분</td>
                <td width="79%" style="padding-left:5px;"> <? echo $od[od_name] ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ전화번호</td>
                <td width="79%" style="padding-left:5px;"> <? echo $od[od_tel] ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ휴대전화</td>
                <td width="79%" style="padding-left:5px;"> <? echo $od[od_hp] ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="24" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ이메일</td>
                <td width="79%" style="padding-left:5px;"> <? echo $od[od_email] ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ주소</td>
                <td width="79%" style="padding-left:5px;"> <? echo sprintf("(%s-%s) %s %s", $od[od_zip1], $od[od_zip2], $od[od_addr1], $od[od_addr2]); ?></td>
              </tr>
              <tr> 
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
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
          <td height="30"><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" />  <span class="style1">배송지 정보</span></td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#E6E6E6"> </td>
        </tr>
        <tr> 
          <td height="8"> </td>
        </tr>
        <tr> 
          <td bgcolor="#F9F9F9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ받으시는분</td>
                <td width="79%" style="padding-left:5px;"> <? echo $od[od_b_name]; ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ전화번호</td>
                <td width="79%" style="padding-left:5px;"> <? echo $od[od_b_tel] ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ휴대전화</td>
                <td width="79%" style="padding-left:5px;"> <? echo $od[od_b_hp] ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ주소</td>
                <td width="79%" style="padding-left:5px;"> <? echo sprintf("(%s-%s) %s %s", $od[od_b_zip1], $od[od_b_zip2], $od[od_b_addr1], $od[od_b_addr2]); ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td width="21%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ요청사항</td>
                <td width="79%" style="padding-left:5px;"> <? echo nl2br(htmlspecialchars2($od[od_memo])); ?></td>
              </tr>
              <tr bgcolor="#E7E7E7"> 
                <td height="1" colspan="2"> </td>
              </tr>
              <tr> 
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
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
          <td height="30"><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" />  <span class="style1">결제정보</span></td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#E6E6E6"> </td>
        </tr>
        <tr> 
          <td height="8"> </td>
        </tr>
        <tr> 
          <td bgcolor="#F9F9F9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
              </tr>
            <tr>
                <td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ결제금액</td>
                <td style='padding-left:5px;'>
                    <?=$od[od_id]?>
                </td>
            </tr>
			<? if ($od[od_receipt_point] > 0) { ?>
              <tr> 
				<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ포인트입금</td>
				<td style='padding-left:5px;'><? echo display_point($od[od_receipt_point]) ?></td>
			</tr>
			<? } ?>

			<? if ($od[od_temp_bank] > 0) { ?>
              <tr> 
				<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ무통장입금액 : </td>
				<td style='padding-left:5px;'><? echo display_amount($od[od_temp_bank]) ?></td>
			</tr>
              <tr> 
				<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ계좌번호 : </td>
				<td style='padding-left:5px;'><? echo $od[od_bank_account]; ?></td>
			</tr>
              <tr> 
				<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ입금자 이름 : </td>
				<td style='padding-left:5px;'><? echo $od[od_deposit_name]; ?></td>
			</tr>
			<? } ?>

			<? if ($od[od_temp_card] > 0) { ?>
              <tr> 
				<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ신용카드 :</td>
				<td style='padding-left:5px;'><? echo display_amount($od[od_temp_card]) ?></td>
			</tr>
			<? } ?>
              <tr> 
                <td height='2' colspan='2' bgcolor='#E7E7E7'> </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
	<td align="center"><a href="./list.php"><img src="/btn/btn_confirm.gif"border="0" hspace="2"></a></td>
  </tr>
</table></td>
                          </tr>
                        </table>
						
						
						
