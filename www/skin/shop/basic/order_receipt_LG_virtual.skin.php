<!-- ################## [ LG 실시간계좌이체 결제 스킨 - START ] ################## -->
<!-- ------------------------------------------------------------- [ 장바구니 - START ] ------------------------------------------------------------- -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:10px;">
	<tr>
		<td height="15" align=""><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" />  <span class="style1">장바구니</span></td>
	</tr>
	<tr>
		<td>
			<!--구매상품내역 테이블 시작 -->
			<?
			$s_page = "order_form.php";
			
			if($_POST[tmp_on_uid]){
				if($_SESSION[ss_od_on_uid]) $s_on_uid = $_SESSION[ss_od_on_uid];
			}else $s_on_uid = $_SESSION[ss_on_uid];

			include "./shopbag_inc.php";
			$f_tot_amount = display_amount($tot_amount);
			$f_tot_amount_len = strlen($f_tot_amount);
			//echo $tot_amount."ddd";
			?>
			<!--구매상품내역 테이블 끝    -->
		</td>
	</tr>
</table>
<!-- ------------------------------------------------------------- [ 장바구니 - END ] ------------------------------------------------------------- -->


<!-- ------------------------------------------------------------- [ 결제모듈설정- START ] ------------------------------------------------------------- -->
<? if ($od_settle_case == "가상계좌") { ?>
<!-- --------------------------------------LGT 결제모듈s-------------------------------------- -->	
<?
$gubun = "SC0040";
$od_id = get_new_od_id();
$CST_PLATFORM				= $GnShop["pg_status"];		//	LG유플러스 결제 서비스 선택(test:테스트, service:서비스)
$CST_MID						= $GnShop["LG_pg_id"];		//	상점아이디(LG유플러스으로 부터 발급받으신 상점아이디를 입력하세요)
$LGD_MID						= (("test" == $CST_PLATFORM)?"t":"").$CST_MID;  //상점아이디(자동생성)
$LGD_OID						= $od_id;				//	주문번호(상점정의 유니크한 주문번호를 입력하세요)
$LGD_AMOUNT					= $od_amount;		//	결제금액("," 를 제외한 결제금액을 입력하세요)
$LGD_BUYER						= $od_name;			//	구매자명
$LGD_PRODUCTINFO			= $it_only_name;			//	상품명
$LGD_BUYEREMAIL				= $od_email;				//	구매자 이메일
$LGD_TIMESTAMP				= date(YmdHms);                   //	타임스탬프
$LGD_CUSTOM_SKIN			= "blue";                               //	상점정의 결제창 스킨 (red, blue, cyan, green, yellow)
$LGD_MERTKEY					= $GnShop["LG_pg_key"];									//상점MertKey(mertkey는 상점관리자 -> 계약정보 -> 상점정보관리에서 확인하실수 있습니다)
$configPath 						= $_SERVER[DOCUMENT_ROOT]."/module/lgxpay/lgdacom"; 						//LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정.
$LGD_BUYERID					= $_SESSION[userid];										//구매자 아이디
$LGD_BUYERIP					= $_SERVER["REMOTE_ADDR"];       //구매자IP

/* 가상계좌(무통장) 결제 연동을 하시는 경우 아래 LGD_CASNOTEURL 을 설정하여 주시기 바랍니다. */
$LGD_CASNOTEURL	   = "http://".$_SERVER[SERVER_NAME]."/module/lgxpay/cas_noteurl.php";

/*
	 *************************************************
	 * 2. MD5 해쉬암호화 (수정하지 마세요) - BEGIN
	 * MD5 해쉬암호화는 거래 위변조를 막기위한 방법입니다.
	 * MD5 해쉬데이터 암호화 검증을 위해
	 * LG유플러스에서 발급한 상점키(MertKey)를 환경설정 파일(lgdacom/conf/mall.conf)에 반드시 입력하여 주시기 바랍니다.
*/
require_once($_SERVER[DOCUMENT_ROOT]."/module/lgxpay/lgdacom/XPayClient.php");
$xpay = &new XPayClient($configPath, $LGD_PLATFORM);
$xpay->Init_TX($LGD_MID);

$LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);			
$LGD_CUSTOM_PROCESSTYPE = "TWOTR";
?>

<!-- ################## [ LG input - START - START ] ################## -->
<form method="post" name="LGD_PAYINFO" id="LGD_PAYINFO" action="<?=$ssl_url?>/module/lgxpay/payres.php">
<input type="hidden" name ="CST_PLATFORM"						value="<?= $CST_PLATFORM ?>">								<!-- 테스트, 서비스 구분 -->
<input type="hidden" name ="CST_MID"									value="<?= $CST_MID ?>">										<!-- 상점아이디 -->
<input type="hidden" id="LGD_MID" name ="LGD_MID"									value="<?= $LGD_MID ?>">										<!-- 상점아이디 -->
<input type="hidden" id="LGD_OID" name ="LGD_OID"									value="<?= $LGD_OID ?>">										<!-- 주문번호 -->
<input type="hidden" name ="LGD_BUYER"							value="<?= $LGD_BUYER ?>">									<!-- 구매자 -->
<input type="hidden" name ="LGD_PRODUCTINFO"					value="<?= $LGD_PRODUCTINFO ?>">						<!-- 상품정보 -->
<!-- <input type="hidden" name ="LGD_AMOUNT"							value="<?= $LGD_AMOUNT ?>"> -->								<!-- 결제금액 -->
<input type="hidden" name ="LGD_BUYEREMAIL"					value="<?= $LGD_BUYEREMAIL ?>">							<!-- 구매자 이메일 -->
<input type="hidden" name ="LGD_CUSTOM_SKIN"					value="<?= $LGD_CUSTOM_SKIN ?>">						<!-- 결제창 SKIN -->
<input type="hidden" name ="LGD_CUSTOM_PROCESSTYPE"	value="<?= $LGD_CUSTOM_PROCESSTYPE ?>">			<!-- 트랜잭션 처리방식 -->
<input type="hidden" id="LGD_TIMESTAMP" name ="LGD_TIMESTAMP"						value="<?= $LGD_TIMESTAMP ?>">							<!-- 타임스탬프 -->
<input type="hidden"	id="LGD_HASHDATA" name ="LGD_HASHDATA"						value="<?= $LGD_HASHDATA ?>">								<!-- MD5 해쉬암호값 -->
<input type="hidden" name ="LGD_PAYKEY"	id="LGD_PAYKEY">																			<!-- LG유플러스 PAYKEY(인증후 자동셋팅)-->
<input type="hidden" name ="LGD_VERSION"         				value="PHP_XPay_1.0">											<!-- 버전정보 (삭제하지 마세요) -->
<input type="hidden" name = "LGD_BUYERIP"						value="<?= $LGD_BUYERIP ?>">								<!-- 구매자IP -->
<input type="hidden" name = "LGD_BUYERID"						value="<?= $LGD_BUYERID ?>">								<!-- 도메인명 -->
<input type="hidden" name = "OrderDomain"							value="<?= $_POST[OrderDomain] ?>">						<!-- 구매자ID -->
<input type="hidden" name = "OrderTelNo1"							value="<?= $_POST[OrderTelNo1] ?>">						<!-- 연락처 (전화) -->
<input type="hidden" name = "OrderTelNo"								value="<?= $_POST[OrderTelNo] ?>">							<!-- 연락처 (HP) -->
<input type="hidden" name = "LGD_CUSTOM_FIRSTPAY"			value="SC0040">														<!-- 초기 결제수단 -->
<input type="hidden" name = "LGD_CUSTOM_USABLEPAY";		value="<?=$gubun?>">		<!-- 특정 결제 수단만 보이게 하기 -->
<input type="hidden" name="LGD_ESCROW_USEYN"				value="Y">																<!-- 에스크로사용유무 -->
<input type="hidden" name="LGD_ESCROW_GOODCODE"		value="Y">																<!-- 에스크로상품코드 -->

<? /*
<input type="hidden" name="LGD_ESCROW_GOODNAME"		value="<?= $LGD_PRODUCTINFO ?>">						<!-- 에스크로상품명 -->
<input type="hidden" name="LGD_ESCROW_GOODID"			value="Y">																<!-- 에스크로상품번호 -->
<input type="hidden" name="LGD_ESCROW_UNITPRICE"			value="Y">																<!-- 에스크로상품금액 -->
<input type="hidden" name="LGD_ESCROW_QUANTITY"			value="Y">																<!-- 에스크로상품수량 -->
<input type="hidden" name="LGD_ESCROW_ZIPCODE"			value="Y">																<!-- 에스크로배송지우편번호 -->
<input type="hidden" name="LGD_ESCROW_ADDRESS1"			value="Y">																<!-- 에스크로배송지주소동까지 -->
<input type="hidden" name="LGD_ESCROW_ADDRESS2"			value="Y">																<!-- 에스크로배송지주소상세 -->
<input type="hidden" name="LGD_ESCROW_BUYERPHONE"	value="Y">																<!-- 에스크로구매자휴대폰번호 -->
*/ ?>
<!-- 가상계좌(무통장) 결제연동을 하시는 경우  할당/입금 결과를 통보받기 위해 반드시 LGD_CASNOTEURL 정보를 LG 텔레콤에 전송해야 합니다. -->
<input type="hidden" name="LGD_CASNOTEURL"					value="<?= $LGD_CASNOTEURL ?>">							<!-- 가상계좌 NOTEURL -->

<!-- 해쉬데이터 재 생성용 추가 히든 -->
<input type="hidden" id="HASH_CONFIG_LGD_MID" name="HASH_CONFIG_LGD_MID" value="<?=$xpay->config[$LGD_MID]?>">
<!-- /* ------------------------------------------------------------- [ // LG input - END ] ------------------------------------------------------------- */ -->
<!-- 상점 관리자에 쌓기 위한 히든 -->
<input type=hidden name="od_amount"		value='<?=$od_amount?>'>
<input type=hidden name="od_send_cost"	value='<?=$od_send_cost ?>'>
<input type=hidden name="od_name"		value='<?=$od_name?>'>
<input type=hidden name="od_pwd"			value='<?=$od_pwd?>'>
<input type=hidden name="od_tel"			value='<?=$od_tel?>'>
<input type=hidden name="od_hp"			value='<?=$od_hp?>'>
<input type=hidden name="od_zip"			value='<?=$od_zip?>'>
<input type=hidden name="od_zip1"			value='<?=$od_zip1?>'>
<input type=hidden name="od_zip2"			value='<?=$od_zip2?>'>
<input type=hidden name="od_addr1"		value='<?=$od_addr1?>'>
<input type=hidden name="od_addr2"		value='<?=$od_addr2?>'>
<input type=hidden name="od_email"		value='<?=$od_email?>'>
<input type=hidden name="od_b_name"		value='<?=$od_b_name?>'>
<input type=hidden name="od_b_tel"			value='<?=$od_b_tel?>'>
<input type=hidden name="od_b_hp"			value='<?=$od_b_hp?>'>
<input type=hidden name="od_b_zip"		value='<?=$od_b_zip?>'>
<input type=hidden name="od_b_zip1"		value='<?=$od_b_zip1?>'>
<input type=hidden name="od_b_zip2"		value='<?=$od_b_zip2?>'>
<input type=hidden name="od_b_addr1"	value='<?=$od_b_addr1?>'>
<input type=hidden name="od_b_addr2"	value='<?=$od_b_addr2?>'>
<input type=hidden name="od_hope_date"	value='<?=$od_hope_date?>'>
<input type=hidden name="od_memo"		value='<?=htmlspecialchars2(stripslashes($od_memo))?>'>
<input type=hidden name="s_on_uid"		value='<?=$s_on_uid?>'>
<input type=hidden name="mem_id"			value='<?=$_SESSION[userid]?>'>
<input type=hidden name="od_settle_case" value='<?=$od_settle_case?>'>
<input type=hidden name="od_receipt_point" value='<?=$od_receipt_point?>'>
<input type=hidden name="od_settle_amount" value='<?=$f_tot_amount ?>'>
<!-- ##################   [ 상점 관리자에 쌓기 위한 히든 - END ]  ################## -->
<? } ?>
<!-- ------------------------------------------------------------- [ 결제모듈설정 - END ] ------------------------------------------------------------- -->


<!-- ------------------------------------------------------------- [ 디자인 - START ] ------------------------------------------------------------- -->
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

<!-- 테이블의 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<!-- 테이블의 시작 -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
								<td bgcolor="#F9F9F9">
									<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<col width="150" />
										<col width="" />
										<tr>
											<td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ주문하시는분</td>
											<td  style="padding-left:5px;"> <?=$od_name?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ전화번호</td>
											<td  style="padding-left:5px;"> <?=$od_tel?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ휴대전화</td>
											<td  style="padding-left:5px;"> <?=$od_hp?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="24" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ이메일</td>
											<td  style="padding-left:5px;"> <?=$od_email?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ주소</td>
											<td  style="padding-left:5px;"> <? echo sprintf("(%s) %s %s", $od_zip, $od_addr1, $od_addr2); ?></td>
										</tr>
										<tr>
											<td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
										</tr>
									</table>
									<!-- 테이블의 끝 -->
								</td>
							</tr>
						</table>
						<!-- 테이블의 끝 -->
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<!-- 테이블의 시작 -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
								<td bgcolor="#F9F9F9">
									<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<col width="150">
										<col width="">
										<tr>
											<td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;"> ㆍ받으시는분</td>
											<td  style="padding-left:5px;"> <?=$od_b_name?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ전화번호</td>
											<td  style="padding-left:5px;"> <?=$od_b_tel?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ휴대전화</td>
											<td  style="padding-left:5px;"> <?=$od_b_hp?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ주소</td>
											<td  style="padding-left:5px;"> <? echo sprintf("(%s) %s %s", $od_b_zip, $od_b_addr1, $od_b_addr2); ?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ요청사항</td>
											<td  style="padding-left:5px;"> <? echo nl2br(htmlspecialchars2(stripslashes($od_memo))); ?></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="2"> </td>
										</tr>
										<tr>
											<td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
										</tr>
									</table>
									<!-- 테이블의 끝 -->
								</td>
							</tr>
						</table>
						<!-- 테이블의 끝 -->
					</td>
				</tr>
			</table>
			<!-- 테이블의 끝 -->
		</td>
	</tr>
</table>
<!-- 테이블의 끝 -->


<!-- ################## [ 하단 결제정보 : 결제유형(카드,무통장,계좌이체) 별로 아래 코드가 다르니 덮어쓰지 않게 주의 - ] ################## -->
<!-- 테이블의 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
					<td bgcolor="#F9F9F9">
						<!-- 테이블의 시작 -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<col width="120" />
							<col width="" />
							<tr>
								<td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
							</tr>
							
							<?
							$f_tot_amount_len -= 2; // "원" 길이만큼 뺀다
							$receipt_amount = $od_amount;
							$member = Get_member($_SESSION['userid']);
							$mem_point = $member['mem_point'];
							if ($GnShop['point_chk']==TRUE && $od_receipt_point>0) 
							{
								?>
								<tr>
									<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ적립금사용</th>
									<td style='padding-left:5px;'>
										<?=number_format($od_receipt_point)?> Point
									</td>
								</tr>
								<?
							}
							?>

							<? if ($od_settle_case == "가상계좌") {
							$border_style = "";
							if ($od_receipt_bank == "") $border_style = " border-style:none;";
							?>
							<tr>
							<td height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>ㆍ가상계좌</td>
							<td style='padding-left:5px;'><input type="text" id="LGD_AMOUNT" name="LGD_AMOUNT" value='<?=$receipt_amount?>' size='<?=$f_tot_amount_len?>' style='text-align:left; border-style:none; background-color:#F9F9F9;' class=point readonly>원
							<input type=hidden name="LGD_CUSTOM_FIRSTPAY" value="SC0040">
							</tr>
							<?
							$receipt_amount = 0;
							}
							?>

							<tr><td height='1' colspan='2' bgcolor='#E7E7E7'> </td></tr>
							<? if($radiobutton!="필요없음"){?>
							<input type='hidden' name='radiobutton' value="<?=$radiobutton?>">
							<tr style="border:dashed 1px #cccccc;display:none;">
								<td bgcolor="#F9F9F9" colspan="2">
									<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="2" colspan="4" bgcolor="#E7E7E7"> </td>
										</tr>
										<tr>
											<td width="15%" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ회사명</td>
											<td width="35%" style="padding-left:5px;"><input name="office_name" type="text" style="width:100px;" value="<?=$office_name?>" maxlength="20"></td>
											<td width="15%" style="padding-left:5px;">ㆍ업태/종류</td>
											<td width="35%" style="padding-left:5px;"><input name="office_kind" type="text" style="width:100px;" value="<?=$office_kind?>" maxlength="20"></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="4"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ대표자성명</td>
											<td style="padding-left:5px;"> <input name="office_ceo" type="text" style="width:100px;" value="<?=$office_ceo?>" maxlength="20"></td>
											<td style="padding-left:5px;">ㆍ사업자등록번호</td>
											<td style="padding-left:5px;">
												<input name="office_num1" value="<?=$office_num1?>" type="text" style="width:50px;" maxlength="3"> -
												<input name="office_num2" value="<?=$office_num2?>" type="text"  style="width:30px;" maxlength="2"> -
												<input name="office_num3" value="<?=$office_num3?>" type="text" style="width:70px;" maxlength="5">
											</td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="4"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ품목</td>
											<td style="padding-left:5px;"> <input name="office_make" type="text" style="width:100px;" value="<?=$office_make?>" maxlength="20"></td>
											<td style="padding-left:5px;">ㆍ회사전화</td>
											<td style="padding-left:5px;"><input name="office_tell" type="text" style="width:100px;" value="<?=$office_tell?>" maxlength="20"></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="4"> </td>
										</tr>
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ홈페이지 URL</td>
											<td colspan="3" style="padding-left:5px;"> <input name="office_hompageurl" type="text" value="<?=$office_hompageurl?>"  style="width:300px;"></td>
										</tr>
										<tr bgcolor="#E7E7E7">
											<td height="1" colspan="4"> </td>
										</tr>
										<tr>
											<td  height="80" rowspan="2" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ사업장 주소</td>
											<td colspan="3" style="padding-left:5px;">
												<input name="office_post" type="text" value="<?=$office_post?>"  style="width:100px;">
												<a href="#asd" onclick="autoAddress('office_post','office_addr1','office_addr2','frmorderreceipt');"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a>
											</td>
										</tr>
										<tr>
										<td colspan="3" style="padding-left:5px;">
											<input type=text name=office_addr1 value="<?=$office_addr1?>" size=35 maxlength=50 class=edit readonly  style="width:300px;"><br>
											<input type=text name=office_addr2 value="<?=$office_addr2?>" size=20 maxlength=50 class=edit  style="width:120px;"> [나머지주소입력]
										</td>
										</tr>
										<tr>
											<td height="2" colspan="4" bgcolor="#E7E7E7"> </td>
										</tr>
									</table>
									<!-- 테이블의 끝 -->
								</td>
							</tr>
							<tr><td height='1' colspan='2' bgcolor='#E7E7E7'> </td></tr>
							<? }?>
							<tr>
								<td height='2' colspan='2' bgcolor='#E7E7E7'> </td>
							</tr>
						</table>
						<!-- 테이블의 끝 -->
					</td>
				</tr>
			</table>
			<!-- 테이블의 끝 -->
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<? if ($od_settle_case=="가상계좌") { ?>
	<tr>
		<td align="center"><INPUT TYPE="image" SRC="/skin/shop/basic/images/btn_payment.jpg" onclick="doPay_ActiveX();"></td>
	</tr>
	<? } ?>
</table>
<!-- 테이블의 끝 -->
</form>
<!-- 폼의 끝 -->

<? if ($od_settle_case == "가상계좌") {?>
<script type='text/javascript'>
function frmorderreceipt_check(f) {
	errmsg = "";
	errfld = "";
	//settle_amount = parseFloat(f.od_amount.value) + parseFloat(f.od_send_cost.value);
	settle_amount = parseFloat(f.od_amount.value);
	LGD_AMOUNT = 0;
	od_receipt_card = 0;
	od_receipt_point = 0;
	if (typeof(f.od_receipt_card) != 'undefined')
	{
		od_receipt_card = parseFloat(no_comma(f.od_receipt_card.value));
		if (od_receipt_card < <?=(int)($default[de_card_max_amount])?>)
		{
			alert("결제액은 <?=display_amount($default[de_card_max_amount])?> 이상 가능합니다.");
			f.od_receipt_card.focus();
			return;
		}
	}
	if (typeof(f.LGD_AMOUNT) != 'undefined'){
		LGD_AMOUNT = parseFloat(no_comma(f.LGD_AMOUNT.value));
		if (f.od_bank_account.value == "" && LGD_AMOUNT > 0){
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
	// 음수일 경우 오류
	if (od_receipt_point < 0 || od_receipt_card < 0 || LGD_AMOUNT < 0)
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
	if (typeof(f.LGD_AMOUNT) != 'undefined')
		str += "<?=$od_settle_case?> : " + f.LGD_AMOUNT.value + "원\n\n";
	str += "으로 입력 하셨습니다.\n\n"+
		   "금액이 올바른지 확인해 주십시오."+str_card;
	sw_submit = confirm(str);
	if (sw_submit == false)
		return;
	f.submit();
}
</script>
<? } ?>

<script type = "text/javascript">
/*
 * 상점결제 인증요청후 PAYKEY를 받아서 최종결제 요청.
*/
function doPay_ActiveX(){

	ret = xpay_check(document.getElementById('LGD_PAYINFO'), '<?= $CST_PLATFORM ?>');
	if (ret=="00"){
		//ActiveX 로딩 성공
		var LGD_RESPCODE        = dpop.getData('LGD_RESPCODE');       //결과코드
		var LGD_RESPMSG         = dpop.getData('LGD_RESPMSG');        //결과메세지
		//alert(LGD_RESPCODE);
		//alert(LGD_RESPMSG);
		if( "0000" == LGD_RESPCODE ) {	//인증성공
			var LGD_PAYKEY      = dpop.getData('LGD_PAYKEY');         //LG유플러스 인증KEY
			var msg = "인증결과 : " + LGD_RESPMSG + "\n";
			msg += "LGD_PAYKEY : " + LGD_PAYKEY +"\n\n";
			document.getElementById('LGD_PAYKEY').value = LGD_PAYKEY;
			//alert(msg);
			document.getElementById('LGD_PAYINFO').submit();
		}
		else {
			//인증실패
			alert("인증이 실패하였습니다. " + LGD_RESPMSG);
			//self.close();
            /*
             * 인증실패 화면 처리
			*/
		}
	}
	else {
		alert("LG U+ 전자결제를 위한 ActiveX Control이  설치되지 않았습니다.");
        /*
         * 인증실패 화면 처리
		*/
		xpay_showInstall();
	}
}
//-->
</script>

<!--  xpay.js는 반드시 body 밑에 두시기 바랍니다. -->
<!--  UTF-8 인코딩 사용 시는 xpay.js 대신 xpay_utf-8.js 을  호출하시기 바랍니다.-->
<script language="javascript" src="<?= $_SERVER['SERVER_PORT']!=443?"http":"https" ?>://xpay.lgdacom.net<?=($CST_PLATFORM == "test")?($_SERVER['SERVER_PORT']!=443?":7080":":7443"):""?>/xpay/js/xpay_ub_utf-8.js" type="text/javascript"></script>
<!-- <script language="javascript" src="http//xpay.lgdacom.net:7443/xpay/js/xpay.js" type="text/javascript"></script> -->

<!-- <script language="javascript" src="<?= $_SERVER['SERVER_PORT']!=443?"http":"https" ?>://xpay.uplus.co.kr<?=($CST_PLATFORM == "test")?($_SERVER['SERVER_PORT']!=443?":7080":":7443"):""?>/xpay/js/xpay_ub_utf-8.js" type="text/javascript"></script> -->
