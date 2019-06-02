<?
	include $DOCUMENT_ROOT."/admin/lib/libvm.php";
	include $DOCUMENT_ROOT."/admin/shop/lib/shop_lib.php";

	isAdmin();
	include "../head.php";

$sql = "select *
         from shop_cash
        where cash_id = '$id' ";
$result = sql_query($sql);
$ch = mysql_fetch_array($result);
mysql_free_result($result);
if ($ch[cash_state] == "발급취소"){
		alert("이미 발급취소 내역이 있습니다.");
}

if($ch[cash_type]=="01") $cashPay_text = "소득공제용";
	else  $cashPay_text = "지출증빙용";

if($ch[cash_type]=="01") $cashPay_type = "1";
	else  $cashPay_type = "2";
?>
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
				
		if (form_name.Org_adm_no.value == ""){
			alert("원거래 승인번호를 입력해 주세요.");
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
	   if(confirm("현금영수증을 발행 취소하시겠습니까?"))
	   { 
	       form_name.submit();
		   return true;	
		
	   } else {
		return false;
	   }

	}
	   
-->
</script>


<table width="790" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td height="1" bgcolor="#E0E0E0"> </td>
				</tr>
				<tr>                       
					<td height="30" bgcolor="f5f5f5" style="padding-left:5px;"><strong><font color="#004080"><img src="../btn/images/bu_blue.gif" width="10" height="9"> 현금영수증 발급 취소</font></strong></td>
				</tr>
				<tr> 
					<td height="1" bgcolor="#E0E0E0"> </td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td height="8"> </td>
	</tr>
</table>

			<table width="630" border="0" cellspacing="0" cellpadding="0" align=center>
				<tr bgcolor="#848FF1">
					<td height="2" bgcolor="#848FF1" colspan="4"></td>
				</tr>
<form name=cash_pay method=post action=cash_ing.php>
<input type=hidden name=Pay_kind value="cash-cncl">
<!-----------------단말기 번호는 7005037001 셋팅함 (수정불가)----------------------->
<input type=hidden name=Cat_id value="7005037001">
<!-----------------결제방식 무통장입금으로 셋팅함 무통장입금-1 , 계좌이체-2 -------------------------->
<input type=hidden name=Pay_type value="<?=$cashPay_type?>">
<input type=hidden style=width:100px name=Retailer_id maxlength=20 value="<?=$default[allthegate_mid]?>"> <!-- 상점아이디 -->
<input type=hidden style=width:100px name=Cust_no	 value="<?=$ch[cash_mid] ?>"> <!-- 회원아이디 -->
<input type=hidden style=width:100px name=Order_no	 value="<?=$ch[od_id]?>">  <!-- 주문번호 -->
<input type=hidden style=width:100px name=on_uid	 value="<?=$ch[on_uid]?>">  <!-- 주문번호 확장 -->
<input type=hidden style=width:100px name=Amtcash	 value="<?=$ch[cash_all]?>">  <!-- 결제금액 -->
<input type=hidden style=width:100px name=deal_won  value="<?=$ch[cash_item]?>">  <!-- 공급가액 -->
<input type=hidden style=width:100px name=Amttex	 value="<?=$ch[cash_vp]?>">  <!-- 부가가치세 -->
<input type=hidden style=width:100px name=Amtadd	 value="0">  <!-- 봉사료 -->
<input type=hidden style=width:100px name=prod_nm	 value="<?=$ch[cash_itname]?>"> <!-- 상품명 -->
<input type=hidden style=width:100px name=prod_set	 value="<?=$ch[cash_itset]?>"> <!-- 상품수량 -->

<input type=hidden style=width:100px name=od_name	 value="<?=$ch[od_name] ?>"> <!-- 주문자명 -->
<input type=hidden style=width:100px name=Confirm_no value="<?=$ch[cash_confirm] ?>"> <!-- 신분확인번호 -->
<input type=hidden style=width:100px name=Gubun_cd value="<?=$ch[cash_type]?>"> <!-- 영수증구분 -->
<input type=hidden style=width:100px name=cash_id value="<?=$ch[cash_id]?>"> <!-- DB ID -->
<input type=hidden style=width:100px name=Org_adm_no value="<?=$ch[cash_succno]?>"> <!-- 원거래승인번호 -->
<!-- 공급가액 -->

              <tr> 
				<td width="130" bgcolor="#EBEDFF" height="25" ><font color=#FF0000>&nbsp;&nbsp;&nbsp;&nbsp;<b>주문번호 : </font></b></td>
				<td colspan="3"  class="orderlist01"><font color=#FF0000><b><?=$ch[od_id]?></font></b></td>
			</tr>
			<tr> 
				<td width="130" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;신분확인번호 :</font></td>
				<td colspan="3"  class="orderlist01">*************</td>
			</tr>
			<tr> 
				<td width="130" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;발급일자 :</font></td>
				<td colspan="3"  class="orderlist01"><?=date("Y/m/d H시",$row[cash_time])?></td>
			</tr>
			<tr> 
				<td width="130" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;원거래승인번호 :</font></td>
				<td colspan="3"  class="orderlist01"><?=$ch[cash_succno]?></td>
			</tr>
			<tr> 
				<td width="130" bgcolor="#EBEDFF" height="25" ><font color="#4954B7">&nbsp;&nbsp;&nbsp;&nbsp;영수증구분 :</font></td>
				<td colspan="3"  class="orderlist01"><?=$cashPay_text?></td>
			</tr>
			<tr bgcolor="#848FF1">
				<td height="2" bgcolor="#848FF1" colspan="4"></td>
			</tr>
            </table>
            <br>
            <table border="0" cellspacing="0" cellpadding="0" height="50" align=center>
              <tr> 
                <td width="308" align="center"><input type=button value="영수증 발급 취소하기" onclick="javascript:send_form()"></td>
              </tr>
</form>
           </table>

<? include "../foot.php" ;?>		