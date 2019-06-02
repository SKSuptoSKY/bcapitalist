<html>
<head>
<title>*** 주문프린트 ***</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<link rel="stylesheet" type="text/css" href="./css/2005_s.css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="660" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" height="28" bgcolor="#484D8F">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center" height="3" bgcolor="#A7A9C9"></td>
  </tr>
  <tr> 
    <td align="center"> 
      <table width="630" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="30">&nbsp;</td>
        </tr>
        <tr> 
          <td><img src="image/order/subtitle01.gif" width="140" height="31"></td>
        </tr>
      </table>
            <!--구매상품내역 테이블 시작 -->
			<?
				$s_page = "";
				$ss_on_uid = $id;
				$od_id = $od[od_id];

				include "./shopbag_inc.php";
			?>
            <!--구매상품내역 테이블 끝    -->
            <table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30">&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="image/order/subtitle02.gif" width="140" height="31"></td>
              </tr>
            </table>
            <!--주문고객정보 -->
			<table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="100" height="2" bgcolor="#848FF1"></td>
                <td width="215" height="2" bgcolor="#848FF1"></td>
                <td width="100" height="2" bgcolor="#848FF1"></td>
                <td width="215" height="2" bgcolor="#848FF1"></td>
              </tr>
              <tr> 
                <td height="30" bgcolor="#EBEDFF" align="left"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;주문하신 분</font></td>
                <td class="orderlist01"><? echo $od[od_name] ?></td>
                <td bgcolor="#EBEDFF" align="left"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;E-mail</font></td>
                <td class="orderlist01"><? echo $od[od_email] ?></td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
              </tr>
              <tr> 
                <td  bgcolor="#EBEDFF" height="30" align="left"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;연락처1</font></td>
                <td  colspan="3" class="orderlist01"> <? echo $od[od_tel] ?></td>
                </td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
              </tr>
              <tr> 
                <td  bgcolor="#EBEDFF" height="30" align="left"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;연락처2</font></td>
                <td  colspan="3" class="orderlist01"> <? echo $od[od_hp] ?></td>
                </td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
              </tr>
              <tr> 
                <td  bgcolor="#EBEDFF" height="30" align="left"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;주소</font></td>
                <td  colspan="3" class="orderlist01">
					<? echo sprintf("(%s-%s) %s %s", $od[od_zip1], $od[od_zip2], $od[od_addr1], $od[od_addr2]); ?>
				</td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
                <td  height="1"></td>
              </tr>
            </table>
            <table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30">&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="image/order/subtitle03.gif" width="140" height="31"></td>
              </tr>
            </table>
            <!--배송지정보 -->
            <table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr bgcolor="#848FF1"> 
                <td width="100" height="2"></td>
                <td width="530" height="2"></td>
              </tr>
              <tr> 
                <td height="30" bgcolor="#EBEDFF" align="left"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;받으시는 분</font></td>
                <td height="16" class="orderlist01">
                 <? echo $od[od_b_name]; ?></td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td height="1"></td>
                <td height="1"></td>
              </tr>
              <tr> 
                <td height="30" bgcolor="#EBEDFF"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;연락처1 </font></td>
                <td height="16" class="orderlist01"> 
                 <? echo $od[od_b_tel] ?></td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td height="1"></td>
                <td height="1"></td>
              </tr>
              <tr> 
                <td height="30" bgcolor="#EBEDFF"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;연락처2 </font></td>
                <td height="16" class="orderlist01"> 
                  <? echo $od[od_b_hp] ?></td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td height="1"></td>
                <td height="1"></td>
              </tr>
              <tr> 
                <td height="30" bgcolor="#EBEDFF"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;주소</font></td>
                <td height="16"  class="orderlist01"> 
					<? echo sprintf("(%s-%s) %s %s", $od[od_b_zip1], $od[od_b_zip2], $od[od_b_addr1], $od[od_b_addr2]); ?>
                </td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td height="1"></td>
                <td height="1"></td>
              </tr>
              <tr> 
                <td height="30" bgcolor="#EBEDFF"><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;요청사항</font></td>
                <td height="50"  class="orderlist01"> 
                  <? echo nl2br(htmlspecialchars2($od[od_memo])); ?>
				</td>
              </tr>
              <tr bgcolor="#D8D8D8"> 
                <td height="1"></td>
                <td height="1"></td>
              </tr>
            </table>
            <table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30">&nbsp;</td>
              </tr>
              <tr> 
                <td><img src="image/order/subtitle04.gif" width="140" height="31"></td>
              </tr>
            </table>
            <!--결제방법 -->
            <table width="630" border="0" cellspacing="0" cellpadding="0">
              <tr bgcolor="#848FF1"> 
                <td height="2"></td>
                <td height="2"></td>
                <td height="2"></td>
                <td height="2"></td>
              </tr>
			<? if ($od[od_receipt_point] > 0) { ?>
              <tr> 
				<td width="100" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;포인트입금</font></td>
				<td colspan="3"  class="orderlist01"><? echo display_point($od[od_receipt_point]) ?></td>
			</tr>
			<? } ?>

			<? if ($od[od_temp_bank] > 0) { ?>
              <tr> 
				<td width="100" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;무통장입금액 : </font></td>
				<td colspan="3"  class="orderlist01"><? echo display_amount($od[od_temp_bank]) ?></td>
			</tr>
              <tr> 
				<td width="100" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;계좌번호 : </font></td>
				<td colspan="3"  class="orderlist01"><? echo $od[od_bank_account]; ?></td>
			</tr>
              <tr> 
				<td width="100" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp; 입금자 이름 : </font></td>
				<td colspan="3"  class="orderlist01"><? echo $od[od_deposit_name]; ?></td>
			</tr>
			<? } ?>

			<? if ($od[od_temp_card] > 0) { ?>
              <tr> 
				<td width="100" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;신용카드 :</font></td>
				<td colspan="3"  class="orderlist01"><? echo display_amount($od[od_temp_card]) ?></td>
			</tr>
			<? } ?>
              <tr> 
				<td width="100" bgcolor="#EBEDFF" height="25" ><font color=#FF0000>&nbsp;&nbsp;&nbsp;&nbsp;<b>주문번호 : </font></b></td>
				<td colspan="3"  class="orderlist01"><font color=#FF0000><b><?=$od[od_id]?></font></b></td>
			</tr>
              <tr bgcolor="#D8D8D8"> 
                <td height="1"></td>
                <td height="1"></td>
                <td height="1"></td>
                <td height="1"></td>
              </tr>
            </table>
      <br>
      <br>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td align="center"><a href="#" onclick="print();"><img src="image/order/button/print.gif" width="101" height="30" border="0"></a><a href=# onclick=self.close();><img src="image/order/button/close.gif" width="101" height="30" border="0" hspace="2"></a></td>
        </tr>
      </table>
      <br>
      <img src="image/order/print_info.gif" width="550" height="80"> <br>
      <br>
    </td>
  </tr>
</table>
</body>
</html>
