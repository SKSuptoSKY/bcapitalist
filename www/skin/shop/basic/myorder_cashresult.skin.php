<script language=javascript> // 성공값이 y일경우엔 영수증팝업 띄움
<!--
function show_receipt() // 영수증 출력 
	{
		if("<?=$Success?>"== "y"){
	     	
   		   document.cash_pay.submit();
			}
		else
		{
			alert("해당하는 결제내역이 없습니다");
		}
	}
	//영수증 출력끝
-->
</script>


<table width="728" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
                <td height="22" valign="bottom"><img src="/images/btn_location.gif"> 
                  home  &gt; 결제하기 &gt; 현금영수증</td>
           </tr>
           <tr>
            <td background="/images/copy_page_main_dot.gif"><img src="/images/copy_page_main_dot.gif"></td>
           </tr>
         </table></td>
                          </tr>
  <tr> 
    <td height="7"> </td>
  </tr>
                          <tr> 
                            
    <td>
	
            <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td><img src="/shop/images/title_cash.jpg" width="106" height="29"></td>
              </tr>
            </table>
			<!--구매상품내역 테이블 시작 -->
			<?
				$s_on_uid = $on_uid;
				$s_page = "myorder_view.php";
				include "./shopbag_inc.php";
			?>

		<table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td style="padding:5px">
					<font size=2><b>현금영수증처리결과</b></font>
				</td>
			</tr>
			<tr bgcolor="#848FF1">
				<td height="2" bgcolor="#E3D7C4"></td>
			</tr>
			<tr>
				<td>
				<table width="630" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td bgcolor="#F5F2EF" style="padding:5px" width=120>&nbsp;&nbsp;&nbsp;&nbsp;<b>결제종류 
            : </b> </b></font></td>
          <td style="padding:5px"> 
            <?php
	if($Pay_kind == "cash-appr")
	{
		echo "현금영수증발행요청";
	}	
	else if($Pay_kind == "cash-cncl")
	{
		echo "현금영수증취소요청";
	}
?>
          </td>
        <tr> 
          <td bgcolor="#F5F2EF" style="padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;<b>거래자구분 
            : </b> </td>
          <td style="padding:5px"> 
            <?php
	if($Gubun_cd == "01")
	{
		echo "소득공제용";
	}	
	else if($Gubun_cd == "02")
	{
		echo "사업자지출증빙용";
	}
?>
          </td>
        </tr>
        <tr> 
          <td bgcolor="#F5F2EF" style="padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;<b>결제방식 
            : </b> </td>
          <td style="padding:5px"> 
            <?php
	if($Pay_type == "1")
	{
		echo "무통장입금";
	}	
	else if($Pay_type == "2")
	{
		echo "계좌이체";
	}
?>
          </td>
        <tr> 
          <td bgcolor="#F5F2EF" style="padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;<b>주문번호 
            : </b> </td>
          <td style="padding:5px">
            <?=$Ord_No?>
          </td>
        </tr>
        <tr> 
          <td bgcolor="#F5F2EF" style="padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;<b>승인번호 
            : </b> </td>
          <td style="padding:5px">
            <?=$Adm_no?>
          </td>
        </tr>
        <tr> 
          <td bgcolor="#F5F2EF" style="padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;<b>영수금액 
            : </b> </td>
          <td style="padding:5px">공&nbsp;급&nbsp;가&nbsp;액 : 
            <?=number_format($deal_won)?>
            원<br>
            부가가치세 : 
            <?=number_format($Amttex)?>
            원<br>
            영&nbsp;수&nbsp;금&nbsp;액 : 
            <?=number_format($Amtcash)?>
            원</td>
        </tr>
        <tr> 
          <td bgcolor="#F5F2EF" style="padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;<b>성공여부 
            : </b> </td>
          <td style="padding:5px">
            <?if($Success == "y"){?>
            성공
            <?} else {?>
            <font color=red>실패</font>(
            <?=$rResMsg?>
            )
            <?}?>
          </td>
        </tr>
      </table>
				</td>
			</tr>
			<tr bgcolor="#848FF1">
				<td height="2" bgcolor="#E3D7C4"></td>
			</tr>
		</table>
<!---------------------영수증 출력을 위해 넘겨줄 데이터------------------------->
<form name=cash_pay method=post action=myorder_cashreceipt.php 	target="_blank">
<input type=hidden name=Retailer_id value="<?=$Retailer_id?>">
<input type=hidden name=Ord_No value="<?=$Ord_No?>">
<input type=hidden name=Cust_no value="<?=$Cust_no?>">
<input type=hidden name=Adm_no value="<?=$Adm_no?>">
<input type=hidden name=Success value="<?=$Success?>">
<input type=hidden name=Resp_msq value="<?=$rResMsg?>">
<input type=hidden name=Alert_msg1 value="<?=$Alert_msg1?>">
<input type=hidden name=Alert_msg2 value="<?=$Alert_msg2?>">
<input type=hidden name=deal_won value="<?=$deal_won?>">
<input type=hidden name=Amttex value="<?=$Amttex?>">
<input type=hidden name=Amtadd value="<?=$Amtadd?>">
<input type=hidden name=Amtcash value="<?=$Amtcash?>">
<input type=hidden name=prod_nm value="<?=$prod_nm?>">
<input type=hidden name=prod_set value="<?=$prod_set?>">
<input type=hidden name=Gubun_cd value="<?=$Gubun_cd?>">
<input type=hidden name=Pay_kind value="<?=$Pay_kind?>">
<input type=hidden name=Confirm_no value="<?=$Confirm_no?>">
<input type=hidden name=Org_adm_no value="<?=$Org_adm_no?>">
</form>

            <br>
            <table height="50" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="308" align="center"><img src="/member/images/btn_iss.jpg" width="85" height="26" border="0"  onclick="javascript:show_receipt();"  style="cursor:hand"><a href="myorder_list.php"><img src="/member/images/btn_cancel.jpg" width="85" height="26" border="0"></a></td>
              </tr>
</form>
           </table></td>
                          </tr>
                        </table>



