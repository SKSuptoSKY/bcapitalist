<script language="JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->
</script>
<script language=javascript>
//승인 취소시 승인번호 입력칸여부
function check_cash(){

  if (document.cash_pay.Pay_kind.value == "cash-appr"){
		    document.cash_pay.Org_adm_no.disabled = true;
			document.cash_pay.Org_adm_no.style.background = "silver";
		
}  else if (document.cash_pay.Pay_kind.value == "cash-cncl"){
		    document.cash_pay.Org_adm_no.disabled = false;
			document.cash_pay.Org_adm_no.style.background = "white";
		}
}
</script>

<script language=javascript>

<!--
function GBC1(){
		
	document.cash_pay.Gubun_cd.value="01" // 소비자 소득공제용
	
}

function GBC2(){
		
	document.cash_pay.Gubun_cd.value="02" // 사업자 지출증빙용
	
				
}

	function send_form(){	

	form_name = document.cash_pay;  
	
	// 주민(핸드폰)번호 체크 - 주민(핸드폰)번호 13(10,11)자리입력시 체크함
	if (form_name.Gubun_cd.value =="01"){
	  	alert("소득공제용 현금영수증을 선택했습니다.");
    	if( !(form_name.Confirm_no.value.length == 10 || form_name.Confirm_no.value.length == 11 || form_name.Confirm_no.value.length == 13)) {
			alert("주민등록번호 13자리 또는 핸드폰 번호 10,11자리를 입력하세요.");
			return false;
	    }
	    if(form_name.Confirm_no.value.length == 13) {
		  	var obj = form_name.Confirm_no.value;
          	var sum=0;
                	
           	for(i=0;i<8;i++) { sum+=obj.substring(i,i+1)*(i+2); }
                	
           	for(i=8;i<12;i++) { sum+=obj.substring(i,i+1)*(i-6); }
                	
	       	sum=11-(sum%11);
               	
		   	if (sum>=10) { sum-=10; }
              	
           	if (obj.substring(12,13) != sum || (obj.substring(6,7) !=1 && obj.substring(6,7) != 2))	{
           	    alert("주민등록번호에 오류가 있습니다. 다시 확인하십시오.");
           	    return false;
		   	}
        }	       
    }

	 // 사업자 번호 체크 - 사업자번호10자리 입력시  체크함
		
	 if (form_name.Gubun_cd.value =="02"){
		  alert("지출증빙용 현금영수증을 선택했습니다.");	
		if(form_name.Confirm_no.value.length != 10)
		{
			alert("사업자번호 10자리를 입력하세요.");
			return false;
		} 
		else if(form_name.Confirm_no.value.length == 10) {
		   
	        var  obj = form_name.Confirm_no.value;
    			var sum = 0; 

    			var getlist =new Array(10); 

    			var chkvalue =new Array("1","3","7","1","3","7","1","3","5"); 

    			for(var i=0; i<10; i++) { getlist[i] = obj.substring(i, i+1); } 

    			for(var i=0; i<9; i++) { sum += getlist[i]*chkvalue[i]; } 

    			sum = sum + parseInt((getlist[8]*5)/10);  

    			sidliy = sum % 10; 

    			sidchk = 0; 

    			if(sidliy != 0) { sidchk = 10 - sidliy; } 

    			else { sidchk = 0; } 

    			if(sidchk != getlist[9]){
    				alert("사업자등록번호에 오류가 있습니다. 다시 확인하십시오.");    
    				return;
    			}
    			     	
	        } 
		 }
       //입력확인스크립트
	    if (form_name.Pay_kind.value == ""){
			alert("결제종류를 입력해 주세요.");
			return false;
		}	

		if (form_name.Retailer_id.value == ""){
			alert("서비스아이디를 입력해 주세요.");
			return false;
		}		
	
		if (form_name.Cust_no.value == ""){
			alert("회원아이디를 입력해 주세요.");
			return false;
		}	
		
		if (form_name.Order_no.value == ""){
			alert("주문번호를 입력해 주세요.");
			return false;
		}	
		
		if (form_name.Amtcash.value == ""){
			alert("거래금액을 입력해 주세요.");
			return false;
		}	

		if (form_name.Amttex.value == ""){
		    alert("부가가치세를 입력해 주세요.");
	     	return false;
		}

		if (form_name.Amtadd.value == ""){
		    alert("봉사료를 입력해 주세요.");
		    return false;
		}	

		if (form_name.Confirm_no.value ==""){
		    alert("신분확인번호 를 입력해 주세요");
			return false;
		}
					 
	// 결제금액이 5000 원 이상이어야 함
	// 현금결제금액 합산은 아래의 자바스크립트를 통해 반드시 확인 하도록 하시기 바라며, 
	// 아래의 자바스크립트를 사용하지 않아 발생된 문제는 상점에 책임이 있습니다.
	   var sum_deal = eval(form_name.deal_won.value) + eval(form_name.Amttex.value) + eval(form_name.Amtadd.value);
       if(form_name.Amtcash.value != sum_deal)
       {
	 	   alert("결제금액이 맞지 않습니다.");
		   return false;
	   }
	   else if(sum_deal < 5000)
	   {
		   alert("총결제금액이 5천원 이상이어야 현금영수증 발행이 가능합니다.");
		   return false;
	   }
	 //중복요청 방지를 위해서 confirm 을 실행해야함
	   if(confirm("현금영수증을 발행하시겠습니까?"))
	   { 
	       form_name.submit();
		   return true;	
		
	   } else {
		return false;
	   }

	}
	   
-->
</script>


<table width="695" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
                <td height="22" valign="bottom"><img src="<?=$GnShop["skin_url"]?>/images/btn_location.gif" /> 
                  Home  &gt; 결제하기 &gt; 현금영수증</td>
           </tr>
           <tr>
            <td background="/images/copy_page_main_dot.gif"></td>
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
				$s_on_uid = $od[on_uid];
				$s_page = "myorder_view.php";
				include "./shopbag_inc.php";
			?>
			<!--구매상품내역 테이블 끝    -->
		   <div align=right><span class=small>주문:주문대기 , 준비:상품준비중 , 배송:배송중 , 완료:배송완료&nbsp;&nbsp;</span></div><p>
            <!--구매상품내역 테이블 끝    -->

			<table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td><img src="/shop/images/title_cash.jpg" width="106" height="29"></td>
              </tr>
              <tr bgcolor="#848FF1"> 
                <td height="2" bgcolor="E3D7C4"></td>
              </tr>
			<tr>
				<td bgcolor="#F5F2EF" style="padding:10px">
					1)신분확인번호는 구분기호없이 숫자만 입력하여 주십시오.<br>
      2)소득공제용신청시 신분확인번호에 주민(핸드폰)번호를 소득지출증빙용선택시 사업자번호를 입력하여 주십시오.</td>
			</tr>
			<tr bgcolor="#848FF1">
				<td height="2" bgcolor="E3D7C4"></td>
			</tr>
            </table>
            <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">

<form name=cash_pay method=post action=myorder_cashing.php>
<input type=hidden name=Pay_kind value="cash-appr">
<!-----------------단말기 번호는 7005037001 셋팅함 (수정불가)----------------------->
<input type=hidden name=Cat_id value="7005037001">
<!-----------------결제방식 무통장입금으로 셋팅함 무통장입금-1 , 계좌이체-2 -------------------------->
<input type=hidden name=Pay_type value="<?=$cashPay_type?>">
<input type=hidden style=width:100px name=Retailer_id maxlength=20 value="<?=$default[cardsys_mid]?>"> <!-- 상점아이디 -->
<input type=hidden style=width:100px name=Cust_no	 value="<?=$od[mb_id] ?>"> <!-- 회원아이디 -->
<input type=hidden style=width:100px name=Order_no	 value="<?=$od[od_id]?>">  <!-- 주문번호 -->
<input type=hidden style=width:100px name=on_uid	 value="<?=$od[on_uid]?>">  <!-- 주문번호 확장 -->
<input type=hidden style=width:100px name=Amtcash	 value="<?=$getpay_all?>">  <!-- 결제금액 -->
<input type=hidden style=width:100px name=deal_won  value="<?=$getpay_item?>">  <!-- 공급가액 -->
<input type=hidden style=width:100px name=Amttex	 value="<?=$getpay_vp?>">  <!-- 부가가치세 -->
<input type=hidden style=width:100px name=Amtadd	 value="0">  <!-- 봉사료 -->
<input type=hidden style=width:100px name=prod_nm	 value="<?=$itcash_name."등 총".$i."건"?>"> <!-- 상품명 -->
<input type=hidden style=width:100px name=prod_set	 value="<?=$tot_items_qty?>"> <!-- 상품수량 -->

<input type=hidden style=width:100px name=od_name	 value="<?=$od[od_name] ?>"> <!-- 회원아이디 -->
<!-- 공급가액 -->

              <tr> 
				<td width="100" bgcolor="#F5F2EF" height="25" ><font color=#FF0000>&nbsp;&nbsp;&nbsp;&nbsp;<b>주문번호 : </font></b></td>
				<td colspan="3"  class="orderlist01"><font color=#FF0000><b><?=$od[od_id]?></font></b></td>
			</tr>
			<? if ($od[od_receipt_bank] > 0) { ?>
              <tr> 
				
    <td width="100" bgcolor="#F5F2EF" height="25" >&nbsp;&nbsp;&nbsp;&nbsp;무통장입금액 
      : </td>
				<td colspan="3"  class="orderlist01"><? echo display_amount($od[od_temp_bank]) ?></td>
			</tr>
              <tr> 
				
    <td width="100" bgcolor="#F5F2EF" height="25" >&nbsp;&nbsp;&nbsp;&nbsp;계좌번호 
      :<font color="#4954B7">&nbsp; </font></td>
				<td colspan="3"  class="orderlist01"><? echo $od[od_bank_account]; ?></td>
			</tr>
              <tr> 
				
    <td width="100" bgcolor="#F5F2EF" height="25" >&nbsp;&nbsp;&nbsp;&nbsp;입금자 
      이름 : </td>
				<td colspan="3"  class="orderlist01"><? echo $od[od_deposit_name]; ?></td>
			</tr>
			<? } ?>
			<tr> 
				
    <td width="100" bgcolor="#F5F2EF" height="25" >&nbsp;&nbsp;&nbsp;&nbsp;신분확인번호 
      :</td>
				<td colspan="3"  class="orderlist01"><input type=text style=width:100px name=Confirm_no value=""></td>
			</tr>
			<tr> 
				
    <td width="100" bgcolor="#F5F2EF" height="25" >&nbsp;&nbsp;&nbsp;&nbsp;영수증구분 
      :</td>
				<td colspan="3"  class="orderlist01">
					☞&nbsp;&nbsp;소득공제용<input type=radio name=Gubun_cd value="01" Onclick= "javascript:GBC1()">&nbsp;&nbsp;&nbsp;&nbsp;
					☞&nbsp;지출증빙용<input type=radio name=Gubun_cd value="02" Onclick= "javascript:GBC2()">
				</td>
			</tr>
              <tr bgcolor="#D8D8D8"> 
                <td height="1"></td>
                <td height="1"></td>
                <td height="1"></td>
                <td height="1"></td>
              </tr>
            </table>
            <br>
            <table height="50" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                
    <td width="308" align="center"><img src="/member/images/btn_iss.jpg" width="85" height="26" border="0"  onClick="javascript:send_form()"  style="cursor:hand"><a href="myorder_list.php"><img src="/member/images/btn_cancel.jpg" width="85" height="26" border="0"></a></td>
              </tr>
</form>
           </table>	
	
	
</td>
                          </tr>
                        </table>						
						

