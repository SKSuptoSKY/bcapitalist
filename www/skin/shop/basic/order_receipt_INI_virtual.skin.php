<!-- ################## [ LG 실시간계좌이체 결제 스킨 - START ] ################## -->

<!-- ------------------------------------------------------------- [ 장바구니 - START ] ------------------------------------------------------------- -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:10px;">
	<tr>
		<td height="15" align=""><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" style="padding-top:7px;" />  <span class="style1">장바구니</span></td>
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

<?
$od_id = get_new_od_id();

// 이니시스 상점 아이디 관리자연동용 ----------------------------------
// 관리자 서비스 상태가 테스트 일때
if($GnShop["pg_status"] == "test") {
	$INI_id = "INIpayTest";		//테스트용 상점ID
} 
// 관리자 서비스 상태가 서비스 일때
else if($GnShop["pg_status"] == "service") 
{	
	$INI_id = $GnShop["INI_pg_id"];
}

?>

<script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script>
<script language=javascript>
StartSmartUpdate();
</script>
<!------------------------------------------------------------------------------- 
* 웹SITE 가 https를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js를 사용 
* 웹SITE 가 Unicode(UTF-8)를 이용하면 http://plugin.inicis.com/pay61_secuni_cross.js를 사용 
* 웹SITE 가 https, unicode를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js 사용 
--------------------------------------------------------------------------------> 
<!---------------------------------------------------------------------------------- 
※ 주의 ※
 상단 자바스크립트는 지불페이지를 실제 적용하실때 지불페이지 맨위에 위치시켜 
 적용하여야 만일에 발생할수 있는 플러그인 오류를 미연에 방지할 수 있습니다.

<script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script> 
  <script language=javascript>
  StartSmartUpdate();	// 플러그인 설치(확인)
  </script>
-----------------------------------------------------------------------------------> 


<script language=javascript>

var openwin;

function pay(frm)
{
	// MakePayMessage()를 호출함으로써 플러그인이 화면에 나타나며, Hidden Field
	// 에 값들이 채워지게 됩니다. 일반적인 경우, 플러그인은 결제처리를 직접하는 것이
	// 아니라, 중요한 정보를 암호화 하여 Hidden Field의 값들을 채우고 종료하며,
	// 다음 페이지인 INIsecureresult.php로 데이터가 포스트 되어 결제 처리됨을 유의하시기 바랍니다.

	if(document.ini.clickcontrol.value == "enable")
	{
		
		if(document.ini.goodname.value == "")  // 필수항목 체크 (상품명, 상품가격, 구매자명, 구매자 이메일주소, 구매자 전화번호)
		{
			alert("상품명이 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if(document.ini.buyername.value == "")
		{
			alert("구매자명이 빠졌습니다. 필수항목입니다.");
			return false;
		} 
		else if(document.ini.buyeremail.value == "")
		{
			alert("구매자 이메일주소가 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if(document.ini.buyertel.value == "")
		{
			alert("구매자 전화번호가 빠졌습니다. 필수항목입니다.");
			return false;
		}
		else if( ( navigator.userAgent.indexOf("MSIE") >= 0 || navigator.appName == 'Microsoft Internet Explorer' ) &&  (document.INIpay == null || document.INIpay.object == null) )  // 플러그인 설치유무 체크
		{
			alert("\n이니페이 플러그인 128이 설치되지 않았습니다. \n\n안전한 결제를 위하여 이니페이 플러그인 128의 설치가 필요합니다. \n\n다시 설치하시려면 Ctrl + F5키를 누르시거나 메뉴의 [보기/새로고침]을 선택하여 주십시오.");
			return false;
		}
		else
		{
			/******
			 * 플러그인이 참조하는 각종 결제옵션을 이곳에서 수행할 수 있습니다.
			 * (자바스크립트를 이용한 동적 옵션처리)
			 */
			
						 
			if (MakePayMessage(frm))
			{
				disable_click();
				openwin = window.open("/module/inicis/sample/childwin.html","childwin","width=299,height=149");		
				return true;
			}
			else
			{
				if( IsPluginModule() )     //plugin타입 체크
   				{
					alert("결제를 취소하셨습니다.");
				}
				return false;
			}
		}
	}
	else
	{
		return false;
	}
}



function enable_click()
{
	document.ini.clickcontrol.value = "enable"
}

function disable_click()
{
	document.ini.clickcontrol.value = "disable"
}

function focus_control()
{
	if(document.ini.clickcontrol.value == "disable")
		openwin.focus();
}
</script>


<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>



<!-- ------------------------------------------------------------- [ 결제모듈설정- START ] ------------------------------------------------------------- -->
<? if ($od_settle_case == "가상계좌") { ?>

<?
/* INIsecurepaystart.php
 *
 * 이니페이 웹페이지 위변조 방지기능이 탑재된 결제요청페이지.
 * 코드에 대한 자세한 설명은 매뉴얼을 참조하십시오.
 * <주의> 구매자의 세션을 반드시 체크하도록하여 부정거래를 방지하여 주십시요.
 *
 * http://www.inicis.com
 * Copyright (C) 2006 Inicis Co., Ltd. All rights reserved.
 */

    /****************************
     * 0. 세션 시작				*
    ****************************/
	//	session_start(); 					//주의:파일 최상단에 위치시켜주세요!!

    /**************************
     * 1. 라이브러리 인클루드 *
     **************************/
    require($_SERVER["DOCUMENT_ROOT"]."/module/inicis/libs/INILib.php");

    /***************************************
     * 2. INIpay50 클래스의 인스턴스 생성  *
     ***************************************/
    $inipay = new INIpay50;

    /**************************
     * 3. 암호화 대상/값 설정 *
     **************************/
    $inipay->SetField("inipayhome", $_SERVER["DOCUMENT_ROOT"]."/module/inicis");       // 이니페이 홈디렉터리(상점수정 필요)
    $inipay->SetField("type", "chkfake");      // 고정 (절대 수정 불가)
    $inipay->SetField("debug", "true");        // 로그모드("true"로 설정하면 상세로그가 생성됨.)
    $inipay->SetField("enctype","asym"); 			//asym:비대칭, symm:대칭(현재 asym으로 고정)
    /**************************************************************************************************
     * admin 은 키패스워드 변수명입니다. 수정하시면 안됩니다. 1111의 부분만 수정해서 사용하시기 바랍니다.
     * 키패스워드는 상점관리자 페이지(https://iniweb.inicis.com)의 비밀번호가 아닙니다. 주의해 주시기 바랍니다.
     * 키패스워드는 숫자 4자리로만 구성됩니다. 이 값은 키파일 발급시 결정됩니다.
     * 키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오.
     **************************************************************************************************/
	$inipay->SetField("admin", "1111"); 				// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
    $inipay->SetField("checkopt", "false"); 			//base64함:false, base64안함:true(현재 false로 고정)

		//필수항목 : mid, price, nointerest, quotabase
		//추가가능 : INIregno, oid
		//*주의* : 	추가가능한 항목중 암호화 대상항목에 추가한 필드는 반드시 hidden 필드에선 제거하고 
		//          SESSION이나 DB를 이용해 다음페이지(INIsecureresult.php)로 전달/셋팅되어야 합니다.
    $inipay->SetField("mid", $INI_id);				// 상점아이디
    $inipay->SetField("price", $od_amount);               // 가격
    $inipay->SetField("nointerest", "no");             //무이자여부(no:일반, yes:무이자)
    $inipay->SetField("quotabase", "lumpsum:00:02:03:04:05:06:07:08:09:10:11:12");//할부기간

    /********************************
     * 4. 암호화 대상/값을 암호화함 *
     ********************************/
    $inipay->startAction();

    /*********************
     * 5. 암호화 결과  *
     *********************/
 		if( $inipay->GetResult("ResultCode") != "00" ) 
		{
			echo $inipay->GetResult("ResultMsg");
			exit(0);
		}

    /*********************
     * 6. 세션정보 저장  *
     *********************/
		$_SESSION['INI_MID'] = $INI_id;	//상점ID
		$_SESSION['INI_ADMIN'] = "1111";			// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
		$_SESSION['INI_PRICE'] = $od_amount;     //가격 
		$_SESSION['INI_RN'] = $inipay->GetResult("rn"); //고정 (절대 수정 불가)
		$_SESSION['INI_ENCTYPE'] = $inipay->GetResult("enctype"); //고정 (절대 수정 불가)

?>


<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 onload="javascript:enable_click()" onFocus="javascript:focus_control()"><center>

<!-- ------------------------------------------------------------- [ 이니시스 히든 - Start ] ------------------------------------------------------------- -->
<form name=ini method=post action="/module/inicis/sample/INIsecureresult.php" onSubmit="return pay(this)"> 
<input type=hidden name="gopaymethod" value='onlyvbank'> <!-- 결 제 방 법 -->
<input type=hidden name=goodname size=20 value="<?=$it_only_name?>"><!-- 상 품 명 -->
<input type=hidden name=buyername size=20 value="<?=$od_name?>"><!-- 성 명 -->
<input type=hidden name=buyeremail size=20 value="<?=$od_email?>"><!-- 전 자 우 편 -->
<input type=hidden name=buyertel size=20 value="<?=$od_b_hp?>"><!-- 전 자 우 편 -->

<!-- 기타설정 -->
<input type=hidden name=currency size=20 value="WON">

<!--
SKIN : 플러그인 스킨 칼라 변경 기능 - 5가지 칼라(ORIGINAL/BLUE중 택1, GREEN, YELLOW, RED, PURPLE )  기본/파랑, 녹색, 노랑, 빨강, 보라색
HPP : 컨텐츠 또는 실물 결제 여부에 따라 HPP(1)과 HPP(2)중 선택 적용(HPP(1):컨텐츠, HPP(2):실물).
Card(0): 신용카드 지불시에 이니시스 대표 가맹점인 경우에 필수적으로 세팅 필요 ( 자체 가맹점인 경우에는 카드사의 계약에 따라 설정) - 자세한 내용은 메뉴얼  참조.
OCB : OK CASH BAG 가맹점으로 신용카드 결제시에 OK CASH BAG 적립을 적용하시기 원하시면 "OCB" 세팅 필요 그 외에 경우에는 삭제해야 정상적인 결제 이루어짐.
no_receipt : 은행계좌이체시 현금영수증 발행여부 체크박스 비활성화 (현금영수증 발급 계약이 되어 있어야 사용가능)
-->
<input type=hidden name=acceptmethod size=20 value="HPP(1):Card(0):OCB:receipt:cardpoint">


<!--
상점 주문번호 : 무통장입금 예약(가상계좌 이체),전화결재 관련 필수필드로 반드시 상점의 주문번호를 페이지에 추가해야 합니다.
결제수단 중에 은행 계좌이체 이용 시에는 주문 번호가 결제결과를 조회하는 기준 필드가 됩니다.
상점 주문번호는 최대 40 BYTE 길이입니다.
주의:절대 한글값을 입력하시면 안됩니다.
-->
<input type=hidden name=oid size=40 value="<?=$od_id?>">


<!--
플러그인 좌측 상단 상점 로고 이미지 사용
이미지의 크기 : 90 X 34 pixels
플러그인 좌측 상단에 상점 로고 이미지를 사용하실 수 있으며,
주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 상단 부분에 상점 이미지를 삽입할수 있습니다.
-->
<!--input type=hidden name=ini_logoimage_url  value="http://[사용할 이미지주소]"-->

<!--
좌측 결제메뉴 위치에 이미지 추가
이미지의 크기 : 단일 결제 수단 - 91 X 148 pixels, 신용카드/ISP/계좌이체/가상계좌 - 91 X 96 pixels
좌측 결제메뉴 위치에 미미지를 추가하시 위해서는 담당 영업대표에게 사용여부 계약을 하신 후
주석을 풀고 이미지가 있는 URL을 입력하시면 플러그인 좌측 결제메뉴 부분에 이미지를 삽입할수 있습니다.
-->
<!--input type=hidden name=ini_menuarea_url value="http://[사용할 이미지주소]"-->

<!--
플러그인에 의해서 값이 채워지거나, 플러그인이 참조하는 필드들
삭제/수정 불가
uid 필드에 절대로 임의의 값을 넣지 않도록 하시기 바랍니다.
-->
<input type=hidden name=ini_encfield value="<?php echo($inipay->GetResult("encfield")); ?>">
<input type=hidden name=ini_certid value="<?php echo($inipay->GetResult("certid")); ?>">
<input type=hidden name=quotainterest value="">
<input type=hidden name=paymethod value="">
<input type=hidden name=cardcode value="">
<input type=hidden name=cardquota value="">
<input type=hidden name=rbankcode value="">
<input type=hidden name=reqsign value="DONE">
<input type=hidden name=encrypted value="">
<input type=hidden name=sessionkey value="">
<input type=hidden name=uid value=""> 
<input type=hidden name=sid value="">
<input type=hidden name=version value=4000>
<input type=hidden name=clickcontrol value="">

<!-- ------------------------------------------------------------- [ 이니시스 히든 - End ] ------------------------------------------------------------- -->



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
								<td height="30"><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" style="padding-top:7px;" />  <span class="style1">주문자 정보</span></td>
							</tr>
							
							<tr>
								<td height="8"> </td>
							</tr>
							<tr>
								<td>
									<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="mypage_tbl">
										<col width="150" />
										<col width="" />
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 주문하시는분</th>
											<td  style="padding-left:20px;"> <?=$od_name?></td>
										</tr>
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 전화번호</th>
											<td  style="padding-left:20px;"> <?=$od_tel?></td>
										</tr>
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 휴대전화</th>
											<td  style="padding-left:20px;"> <?=$od_hp?></td>
										</tr>
										
										<tr>
											<th  height="24" bgcolor="#F9F9F9" style="padding-left:20px;"> 이메일</th>
											<td  style="padding-left:20px;"> <?=$od_email?></td>
										</tr>
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 주소</th>
											<td  style="padding-left:20px;"> <? echo sprintf("(%s) %s %s", $od_zip, $od_addr1, $od_addr2); ?></td>
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
								<td height="30"><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" style="padding-top:7px;" />  <span class="style1">배송지 정보</span></td>
							</tr>
							
							<tr>
								<td height="8"> </td>
							</tr>
							<tr>
								<td>
									<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="mypage_tbl">
										<col width="150">
										<col width="">
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;">  받으시는분</th>
											<td  style="padding-left:20px;"> <?=$od_b_name?></td>
										</tr>
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 전화번호</th>
											<td  style="padding-left:20px;"> <?=$od_b_tel?></td>
										</tr>
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 휴대전화</th>
											<td  style="padding-left:20px;"> <?=$od_b_hp?></td>
										</tr>
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 주소</th>
											<td  style="padding-left:20px;"> <? echo sprintf("(%s) %s %s", $od_b_zip, $od_b_addr1, $od_b_addr2); ?></td>
										</tr>
										
										<tr>
											<th  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 요청사항</th>
											<td  style="padding-left:20px;"> <? echo nl2br(htmlspecialchars2(stripslashes($od_memo))); ?></td>
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
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mt20">
				<tr>
					<td height="30"><img src="<?=$GnShop["skin_url"]?>/images/icon_gray.jpg" style="padding-top:7px;" />  <span class="style1">결제정보</span></td>
				</tr>
				
				<tr>
					<td height="8"> </td>
				</tr>
				<tr>
					<td>
						<!-- 테이블의 시작 -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="mypage_tbl">
							<col width="120" />
							<col width="" />
							
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
							<th height=25 bgcolor='#F9F9F9' style='padding-left:20px;'> 가상계좌</th>
							<td style='padding-left:20px;'><input type="text" id="LGD_AMOUNT" name="LGD_AMOUNT" value='<?=$receipt_amount?>' size='<?=$f_tot_amount_len?>' style='text-align:left; border-style:none; background-color:#F9F9F9;' class=point readonly>원
							<input type=hidden name="LGD_CUSTOM_FIRSTPAY" value="SC0040">
							</tr>
							<?
							$receipt_amount = 0;
							}
							?>

							
							<? if($radiobutton!="필요없음"){?>
							<input type='hidden' name='radiobutton' value="<?=$radiobutton?>">
							<tr style="border:dashed 1px #cccccc;display:none;">
								<td bgcolor="#F9F9F9" colspan="2">
									<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										
										<tr>
											<td width="15%" height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 회사명</td>
											<td width="35%" style="padding-left:20px;"><input name="office_name" type="text" style="width:100px;" value="<?=$office_name?>" maxlength="20"></td>
											<td width="15%" style="padding-left:20px;"> 업태/종류</td>
											<td width="35%" style="padding-left:20px;"><input name="office_kind" type="text" style="width:100px;" value="<?=$office_kind?>" maxlength="20"></td>
										</tr>
										
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 대표자성명</td>
											<td style="padding-left:20px;"> <input name="office_ceo" type="text" style="width:100px;" value="<?=$office_ceo?>" maxlength="20"></td>
											<td style="padding-left:20px;"> 사업자등록번호</td>
											<td style="padding-left:20px;">
												<input name="office_num1" value="<?=$office_num1?>" type="text" style="width:50px;" maxlength="3"> -
												<input name="office_num2" value="<?=$office_num2?>" type="text"  style="width:30px;" maxlength="2"> -
												<input name="office_num3" value="<?=$office_num3?>" type="text" style="width:70px;" maxlength="5">
											</td>
										</tr>
										
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 품목</td>
											<td style="padding-left:20px;"> <input name="office_make" type="text" style="width:100px;" value="<?=$office_make?>" maxlength="20"></td>
											<td style="padding-left:20px;"> 회사전화</td>
											<td style="padding-left:20px;"><input name="office_tell" type="text" style="width:100px;" value="<?=$office_tell?>" maxlength="20"></td>
										</tr>
										
										<tr>
											<td  height="25" bgcolor="#F9F9F9" style="padding-left:20px;"> 홈페이지 URL</td>
											<td colspan="3" style="padding-left:20px;"> <input name="office_hompageurl" type="text" value="<?=$office_hompageurl?>"  style="width:300px;"></td>
										</tr>
										
										<tr>
											<td  height="80" rowspan="2" bgcolor="#F9F9F9" style="padding-left:20px;"> 사업장 주소</td>
											<td colspan="3" style="padding-left:20px;">
												<input name="office_post" type="text" value="<?=$office_post?>"  style="width:100px;">
												<a href="#asd" onclick="autoAddress('office_post','office_addr1','office_addr2','frmorderreceipt');"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a>
											</td>
										</tr>
										<tr>
										<td colspan="3" style="padding-left:20px;">
											<input type=text name=office_addr1 value="<?=$office_addr1?>" size=35 maxlength=50 class=edit readonly  style="width:300px;"><br>
											<input type=text name=office_addr2 value="<?=$office_addr2?>" size=20 maxlength=50 class=edit  style="width:120px;"> [나머지주소입력]
										</td>
										</tr>
										
									</table>
									<!-- 테이블의 끝 -->
								</td>
							</tr>
							
							<? }?>
							
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
