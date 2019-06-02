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
<table width="700" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td style="padding:0 0 0 6px;">
  		<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
		<td width="50%"><img src="/images/shop/cart_t.jpg" alt="구매하기이미지타이틀" /></td>
		<td width="50%" valign="bottom" align="right" style="font-size:11px; color:#727272;">HOME > 쇼핑몰 > <b>구매하기</b></td>
		</tr>
		</table>
	</td>
   </tr>
   <tr>
    <td height="20">&nbsp;</td>
   </tr>
      <tr>
    <td>&nbsp;</td>
   </tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
<div id="LGD_ACTIVEX_DIV"/> 
<? if ($od_settle_case == "무통장") { ?>
<form name=frmorderreceipt method=post action='./order_update.php' onsubmit="return frmorderreceipt_check(this)" autocomplete="off">
<? } else 	{ ?>
<form method="post" id="LGD_PAYINFO" action="/module/payres.php">
<? } ?>
<input type=hidden name=od_amount    value='<?=$tot_amount?>'>
<input type=hidden name=od_send_cost value='<?=$od_send_cost ?>'>
<input type=hidden name=od_name      value='<?=$od_name?>'>
<input type=hidden name=od_pwd       value='<?=$od_pwd?>'>
<input type=hidden name=od_tel       value='<?=$od_tel?>'>
<input type=hidden name=od_hp        value='<?=$od_hp?>'>
<input type=hidden name=od_zip1      value='<?=$od_zip1?>'>
<input type=hidden name=od_zip2      value='<?=$od_zip2?>'>
<input type=hidden name=od_addr1     value='<?=$od_addr1?>'>
<input type=hidden name=od_addr2     value='<?=$od_addr2?>'>
<input type=hidden name=od_email     value='<?=$od_email?>'>
<input type=hidden name=od_b_name    value='<?=$od_b_name?>'>
<input type=hidden name=od_b_tel     value='<?=$od_b_tel?>'>
<input type=hidden name=od_b_hp      value='<?=$od_b_hp?>'>
<input type=hidden name=od_b_zip1    value='<?=$od_b_zip1?>'>
<input type=hidden name=od_b_zip2    value='<?=$od_b_zip2?>'>
<input type=hidden name=od_b_addr1   value='<?=$od_b_addr1?>'>
<input type=hidden name=od_b_addr2   value='<?=$od_b_addr2?>'>
<input type=hidden name=od_hope_date value='<?=$od_hope_date?>'>
<input type=hidden name=od_memo      value='<?=htmlspecialchars2(stripslashes($od_memo))?>'>
<input type=hidden name=s_on_uid value='<?=$s_on_uid?>'>
<input type=hidden name=mem_id value='<?=$_SESSION[userid]?>'>
<input type=hidden name=od_settle_case value='<?=$od_settle_case?>'>


<!-- --------------------------------------LGT 결제모듈s-------------------------------------- -->												   
<?  
$od_id = get_new_od_id();
$CST_PLATFORM               = "test";      //LG텔레콤 결제 서비스 선택(test:테스트, service:서비스)
$CST_MID                    = "kyfuel";           //상점아이디(LG텔레콤으로 부터 발급받으신 상점아이디를 입력하세요)
$LGD_OID					=  $od_id;
$LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;  //상점아이디(자동생성)
$LGD_CUSTOM_SKIN            = "blue";                               //상점정의 결제창 스킨 (red, blue, cyan, green, yellow)
$configPath 				= $_SERVER["DOCUMENT_ROOT"]."/module/lgdacom"; 							//LG텔레콤에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정. 	  
$LGD_TIMESTAMP              = date(YmdHms);       

require_once($_SERVER["DOCUMENT_ROOT"]."/module/lgdacom/XPayClient.php");
$xpay = &new XPayClient($configPath, $LGD_PLATFORM);
$xpay->Init_TX($LGD_MID);

$LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);
$LGD_CUSTOM_PROCESSTYPE = "TWOTR";
$LGD_CASNOTEURL				= $default["site_url"]."/module/lgdacom/cas_noteurl.php"; 
?>
	
<input type="hidden" name="CST_PLATFORM"                value="<?= $CST_PLATFORM ?>">                   <!-- 테스트, 서비스 구분 -->
<input type="hidden" name="CST_MID"                     value="<?= $CST_MID ?>">                        <!-- 상점아이디 -->
<input type="hidden" name="LGD_MID"                     value="<?= $LGD_MID ?>">                        <!-- 상점아이디 -->
<input type="hidden" name="LGD_OID"                     value="<?= $LGD_OID ?>">                        <!-- 주문번호 --><!--장바구니 아이디-->
<input type="hidden" name="LGD_BUYER"                   value="<?= $LGD_BUYER ?>">           			<!-- 구매자 -->
<input type="hidden" name="LGD_PRODUCTINFO"             value="<?=$LGD_PRODUCTINFO?>">     			<!-- 상품정보 -->
<input type="hidden" name="LGD_AMOUNT"                  value="<?=$LGD_AMOUNT?>">                     <!-- 결제금액 -->
<input type="hidden" name="LGD_BUYEREMAIL"              value="<?= $LGD_BUYEREMAIL ?>">                 <!-- 구매자 이메일 -->
<input type="hidden" name="LGD_CUSTOM_SKIN"             value="<?= $LGD_CUSTOM_SKIN ?>">                <!-- 결제창 SKIN -->
<input type="hidden" name="LGD_CUSTOM_PROCESSTYPE"      value="<?= $LGD_CUSTOM_PROCESSTYPE ?>">         <!-- 트랜잭션 처리방식 -->
<input type="hidden" name="LGD_TIMESTAMP"               value="<?= $LGD_TIMESTAMP ?>">                  <!-- 타임스탬프 -->
<input type="hidden" name="LGD_HASHDATA"                value="<?= $LGD_HASHDATA ?>">                   <!-- MD5 해쉬암호값 -->
<input type="hidden" name="LGD_PAYKEY"                  id="LGD_PAYKEY">                                <!-- LG텔레콤 PAYKEY(인증후 자동셋팅)-->
<input type="hidden" name="LGD_VERSION"         		value="PHP_XPay_1.0">							<!-- 버전정보 (삭제하지 마세요) -->
<input type="hidden" name="LGD_BUYERID"                value="<?= $_SESSION[userid] ?>">					<!--유저아이디-->
<input type="hidden" name="LGD_BUYERADDRESS"                value="<? echo sprintf("(%s-%s) %s %s", $od_zip1, $od_zip2, $od_addr1, $od_addr2); ?>"><!--구매자 주소-->
<input type="hidden" name="LGD_BUYERPHONE"                value="<?= $od_hp ?>">						<!--구매자 헨드폰-->
<input type="hidden" name="LGD_RECEIVER"                value="<?= $od_b_name ?>">					<!--수취인 이름-->
<input type="hidden" name="LGD_RECEIVERPHONE"                value="<?= $od_b_hp ?>">					<!--수취인 전화번호-->
<input type="hidden" name="LGD_ESCROW_USEYN"                value="Y">					<!--수취인 전화번호-->
<input type="hidden" name="LGD_CASNOTEURL"          	value="<?= $LGD_CASNOTEURL ?>">
<input type="hidden" name="LGD_BUYERSSN"          	value="<?= $od_pwd ?>">
<!-- --------------------------------------LGT 결제모듈e-------------------------------------- -->

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
          	<col width="120" />
            <col width="" />
              <tr>
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
              </tr>
            <tr>
                <td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ결제금액</td>
                <td style='padding-left:5px;'>
                   - 신용카드 결제시 보안을 위하여 한번더 결제 버튼을 클릭해주십시오.
                </td>
            </tr>
			<tr><td height='1' colspan='2' bgcolor='#E7E7E7'> </td></tr>
            <?
            $f_tot_amount_len -= 2; // "원" 길이만큼 뺀다
            $receipt_amount = number_format($tot_amount - $od_receipt_point);
			$member = Get_member($_SESSION['userid']);
			$mem_point = $member['mem_point'];
            if ($GnShop['point_chk']==TRUE&&$mem_point>0) {
				$receipt_point = ceil($total_money / $GnShop['point_use']);
				$receipt_point = ($mem_point>=$receipt_point)?$receipt_point:$mem_point;

				
				//2009.7.7 무통장일때만 적립금 사용하게끔 (전체일경우 지우면 됩니다.)
				if ($od_settle_case == "무통장") {
           ?>
		    <tr>
                <td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ적립금사용</td>
                <td style='padding-left:5px;'>
                	<input type=text name=od_receipt_point value='0' size='<?=$f_tot_amount_len?>' style='text-align:right;ime-mode:disabled;' class=edit onFocus='this.value = no_comma(this.value); this.select();' onBlur="OdReceiptPoint(this,'<?=$receipt_point?>');compute_amount(this.form, this);">점
                    (<?=display_point($receipt_point)?> 까지 사용 가능)


					
                </td>
            </tr>
			<tr><td height='1' colspan='2' bgcolor='#E7E7E7'> </td></tr>
            <?
				}
            }
			?>

            <?  if ($od_settle_case == "무통장") {
                // 은행계좌를 배열로 만든후
                $str = explode("\n", $default[bankinfo]);
                $bank_account = "\n<select name=od_bank_account>\n";
                $bank_account .= "<option value=''>--------------- 선택하십시오 ---------------\n";
                $bank_account .= Shop_BankList();
                $bank_account .= "</select> ";

                echo "<tr>";
                echo "<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ무통장입금액</td>";
                echo "<td style='padding-left:5px;'><input type=text name=od_receipt_bank value='$receipt_amount' size='$f_tot_amount_len' style='text-align:right; border-style:none; background-color:#F9F9F9;' class=point readonly>원</td>";
                echo "</tr><tr><td height='1' colspan='2' bgcolor='#E7E7E7'> </td></tr><tr>";
                echo "<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ계좌번호</td><td style='padding-left:5px;'>$bank_account</td>";
                echo "</tr><tr><td height='1' colspan='2' bgcolor='#E7E7E7'> </td></tr><tr>";
                echo "<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ입금자 이름</td>";
                echo "<td style='padding-left:5px;'><input type=text name=od_deposit_name class=edit size=10 maxlength=20 value='$od_name'> (주문하시는분과 입금자가 다를 경우)</td>";
                echo "</tr>\n";
                $receipt_amount = 0;
            }

			?>

            <? if ($od_settle_case == "실시간 계좌이체") {
                $border_style = "";
                if ($od_receipt_bank == "") $border_style = " border-style:none;";
			?>
            <tr>
				<input type=hiddne name="LGD_CUSTOM_USABLEPAY" value="SC0030">
                <input type=hidden name=od_bank_account value='실시간 계좌이체'>
                <input type=hidden name=od_deposit_name value='<?=$od_name?>'>
                <td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ실시간 계좌이체</td>
                <td style='padding-left:5px;'><input type=text name=od_receipt_bank value='<?=$receipt_amount?>' size='<?=$f_tot_amount_len?>' style='text-align:right; border-style:none; background-color:#F9F9F9;' class=point readonly>원
            </tr>
            <?
                $receipt_amount = 0;
            }
			?>

            <? if ($od_settle_case == "신용카드") {
                $border_style = "";
                if ($od_receipt_bank == "") $border_style = " border-style:none;";
			?>
            <tr>
                <td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ신용카드</td>
                <td style='padding-left:5px;'><?=number_format($LGD_AMOUNT)?>원
				<input type=hidden name="LGD_CUSTOM_USABLEPAY" value="SC0010">
            </tr>
            <?
                $receipt_amount = 0;
            }
            ?>
			  <tr><td height='1' colspan='2' bgcolor='#E7E7E7'> </td></tr>
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

<? if ($od_settle_case == "무통장") { ?>
    <td align="center"><a href="javascript:frmorderreceipt_check(document.frmorderreceipt);"><img src="/skin/shop/basic/images/btn_payment.jpg" border=0></a>
<? } else 	{ ?>
    <td align="center"><!--<a href="javascript:frmorderreceipt_check(document.frmorderreceipt);">--><img src="/skin/shop/basic/images/btn_payment.jpg" border=0 style=cursor:hand onclick="doPay_ActiveX();"></a>
<? } ?>
	
	</td>
  </tr>
</form>
</table></td>
   </tr>
   <tr>
    <td height="50" align="center">&nbsp;</td>
   </tr>
  </table>


<script language='javascript'>
function frmorderreceipt_check(f) {
	errmsg = "";
	errfld = "";

	//settle_amount = parseFloat(f.od_amount.value) + parseFloat(f.od_send_cost.value);
	settle_amount = parseFloat(f.od_amount.value);
	od_receipt_bank = 0;
	od_receipt_card = 0;
	od_receipt_point = 0;

	if (typeof(f.od_receipt_card) != 'undefined')
	{
		od_receipt_card = parseFloat(no_comma(f.od_receipt_card.value));
		if (od_receipt_card < <?=(int)($default[de_card_max_amount])?>)
		{
			alert("신용카드 결제액은 <?=display_amount($default[de_card_max_amount])?> 이상 가능합니다.");
			f.od_receipt_card.focus();
			return;
		}
	}

	if (typeof(f.od_receipt_bank) != 'undefined'){
		od_receipt_bank = parseFloat(no_comma(f.od_receipt_bank.value));
		if (f.od_bank_account.value == "" && od_receipt_bank > 0){
			alert("무통장으로 입금하실 은행 계좌번호를 선택해 주십시오.");
			f.od_bank_account.focus();
			return;
		}

		if (f.od_deposit_name.value.length < 2){
			alert("입금자분 이름을 입력해 주십시오.");
			f.od_deposit_name.focus();
			return;
		}
	}
	
	if (typeof(f.od_receipt_point) != 'undefined'){
		od_receipt_point = parseFloat(no_comma(f.od_receipt_point.value));
	}
	
	sum = od_receipt_bank + od_receipt_card + od_receipt_point;
	
	if (settle_amount != sum){
		alert("입력하신 입금액 합계와 결제금액이 같지 않습니다.");
		return;
	}

	// 음수일 경우 오류
	if (od_receipt_point < 0 || od_receipt_card < 0 || od_receipt_bank < 0)
	{
		alert("금액은 음수로 입력하실 수 없습니다.");
		return;
	}

	str_card = "";
	str = "총 결제하실 금액 " + f.od_settle_amount.value + " 중에서\n\n";
	if (typeof(f.od_receipt_point) != 'undefined')
		str += "포인트 : " + f.od_receipt_point.value + "원\n\n";
	if (typeof(f.od_receipt_card) != 'undefined')
	{
		str += "신용카드 : " + f.od_receipt_card.value + "원\n\n";
	}
	if (typeof(f.od_receipt_bank) != 'undefined')
		str += "<?=$od_settle_case?> : " + f.od_receipt_bank.value + "원\n\n";
	str += "으로 입력 하셨습니다.\n\n"+
		   "금액이 올바른지 확인해 주십시오."+str_card;


	sw_submit = confirm(str);
	if (sw_submit == false)
		return;

	f.submit();
}

function compute_amount(f, fld)
{
	x = no_comma(fld.value);
	if (isNaN(x))
	{
		alert("숫자가 아닙니다.");
		fld.value = fld.defaultValue;
		fld.focus();
		return;
	}
	else if (x == "")
		x = 0;
	x = parseFloat(x);

	// 100점 미만 버림
	if (fld.name == "od_receipt_point") {
		x = parseInt(x / 100) * 100;
	}

	fld.value = number_format(String(x));

	//settle_amount = parseFloat(f.od_amount.value) + parseFloat(f.od_send_cost.value);
	settle_amount = parseFloat(f.od_amount.value);
	
	od_receipt_bank = 0;
	od_receipt_card = 0;
	od_receipt_point = 0;

	if (typeof(f.od_receipt_bank) != 'undefined')
		od_receipt_bank = parseFloat(no_comma(f.od_receipt_bank.value));

	if (typeof(f.od_receipt_card) != 'undefined')
		od_receipt_card = parseFloat(no_comma(f.od_receipt_card.value));

	if (typeof(f.od_receipt_point) != 'undefined')
		od_receipt_point   = parseFloat(no_comma(f.od_receipt_point.value));

	sum = od_receipt_bank + od_receipt_card + od_receipt_point;

	// 입력합계금액이 결제금액과 같지 않다면
	if (sum != settle_amount)
	{
		if (fld.name == 'od_receipt_point')
		{
			if (typeof(f.od_receipt_bank) != 'undefined')
			{
				od_receipt_bank = settle_amount - (od_receipt_point + od_receipt_card);
				f.od_receipt_bank.value = number_format(String(od_receipt_bank));
			}
			else if (typeof(f.od_receipt_card) != 'undefined')
			{
				od_receipt_card = settle_amount - (od_receipt_point + od_receipt_bank);
				f.od_receipt_card.value = number_format(String(od_receipt_card));
			}
			else
			{
				f.od_receipt_point.value = number_format(String(od_receipt_point));
			}
		}
		else if (fld.name == 'od_receipt_card')
		{
			if (typeof(f.od_receipt_bank) != 'undefined')
			{
				od_receipt_bank = settle_amount - (od_receipt_point + od_receipt_card);
				f.od_receipt_bank.value = number_format(String(od_receipt_bank));
			}
			else
			{
				f.od_receipt_card.value = number_format(String(od_receipt_card));
			}
		}
		else if (fld.name == 'od_receipt_bank')
		{
			if (typeof(f.od_receipt_point) == 'undefined')
			{
				if (typeof(f.od_receipt_card) == 'undefined') {
					;
				} else {
					od_receipt_card = settle_amount - od_receipt_bank;
					f.od_receipt_card.value = number_format(String(od_receipt_card));
				}
			}
		}
		return;
	}
}
function OdReceiptPoint(fid,v){
	var c = Number(fid.value);
	var v = Number(v);
	
	if(c&&v){
		if(v < c){
			alert(v+"포인트 보다 적어야 합니다.");
			fid.value = '';
		}
	}
}
</script>

<script language = 'javascript'>
<!--
/*
 * 상점결제 인증요청후 PAYKEY를 받아서 최종결제 요청.
 */
function doPay_ActiveX(){
    ret = xpay_check(document.getElementById('LGD_PAYINFO'), '<?= $CST_PLATFORM ?>');

    if (ret=="00"){     //ActiveX 로딩 성공
        var LGD_RESPCODE        = dpop.getData('LGD_RESPCODE');       //결과코드
        var LGD_RESPMSG         = dpop.getData('LGD_RESPMSG');        //결과메세지

        if( "0000" == LGD_RESPCODE ) { //인증성공
            var LGD_PAYKEY      = dpop.getData('LGD_PAYKEY');         //LG텔레콤 인증KEY
            var msg = "인증결과 : " + LGD_RESPMSG + "\n";
            msg += "LGD_PAYKEY : " + LGD_PAYKEY +"\n\n";
            document.getElementById('LGD_PAYKEY').value = LGD_PAYKEY;
            //alert(msg);
            document.getElementById('LGD_PAYINFO').submit();
        } else { //인증실패
            alert("인증이 실패하였습니다. " + LGD_RESPMSG);
            /*
             * 인증실패 화면 처리
             */
        }
    } else {
        alert("LG텔레콤 전자결제를 위한 ActiveX 설치 실패");
        /*
         * 인증실패 화면 처리
         */
    }
}

function isActiveXOK(){
	if(lgdacom_atx_flag == true){
    	document.getElementById('LGD_BUTTON1').style.display='none';
        document.getElementById('LGD_BUTTON2').style.display='';
	}else{
		document.getElementById('LGD_BUTTON1').style.display='';
        document.getElementById('LGD_BUTTON2').style.display='none';	
	}
}
window.onload = "isActiveXOK();"
//-->
</script>
<script language="javascript" src="<?= $_SERVER['SERVER_PORT']!=443?"http":"https" ?>://xpay.lgdacom.net<?=($CST_PLATFORM == "test")?($_SERVER['SERVER_PORT']!=443?":7080":":7443"):""?>/xpay/js/xpay.js" type="text/javascript"></script>