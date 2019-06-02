<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopconfig"];
$JO_table = "";

if ($mode == "U") {

	$input = "
					shop_name		= '$shop_name',
					shop_url			= '$shop_url',
					shop_tel			= '$shop_tel',
					shop_skin		= '$shop_skin',
					mimg_width		= '$mimg_width',
					mimg_height		= '$mimg_height',
					simg_width		= '$simg_width',
					simg_height		= '$simg_height',
					admin_email		= '$admin_email',
					use_bank			= '$use_bank',
					use_card			= '$use_card',
					use_trans			= '$use_trans',
					use_virtual		= '$use_virtual',
					use_phon			= '$use_phon',

					sms_text1			= '$sms_text1',				
					sms_text2			= '$sms_text2',				
					sms_text3			= '$sms_text3',				
					sms_text4			= '$sms_text4',				
					sms_text5			= '$sms_text5',				
					sms_text6			= '$sms_text6',				
					sms_text7			= '$sms_text7',

					use_bill			= '$use_bill',
					use_vat			= '$use_vat',
					bankinfo			= '$bankinfo',
					cardsys_mid		= '$cardsys_mid',

					present_pay		= '$present_pay',
					present_item		= '$present_item'
				";
	
	if ($sitemenu["use_type"]) {
		$input .= "	, 
						use_type1		= '$use_type1',
						use_type2		= '$use_type2',
						use_type3		= '$use_type3',
						use_type4		= '$use_type4',
						use_type5		= '$use_type5'
					";
	}

	if ($sitemenu["point_use"]) {					
		$input .= "	, 
						point_chk				= '$point_chk',
						point_use				= '$point_use',
						point_max_use		= '$point_max_use',
						point_min_use		= '$point_min_use'
					";
	}

	if ($sitemenu["trans_pay"]) {					
		$input .= "	, 
						trans_all		= '$trans_all',
						trans_pay		= '$trans_pay'
					";
	}
	
	if ($sitemenu["mn_shopmodule_use"]) {			
		$input .= "	, 
						pg_status				= '$pg_status',
						pg_module			= '$pg_module',
						LG_pg_id				= '$LG_pg_id',
						LG_pg_key			= '$LG_pg_key',
						LG_pg_casurl			= '$LG_pg_casurl',
						INI_pg_id				= '$INI_pg_id',
						KCP_pg_id			= '$KCP_pg_id'
					";
	}
	
	if($GnShop["site"]=="") {
		$sql =" insert $PG_table set $input , site = '{$default[site_code]}' ";
	} else {
		$sql =" update $PG_table set $input where site = '{$default[site_code]}' ";
	}
	sql_query($sql);

	//글이 등록되어 List로 이동
	alert("적용되었습니다.","/admin/shop/index.php");
}

?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 쇼핑몰 환경관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name=fshopform method=post action="/admin/shop/index.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="U">

	<tr>
		<td valign="top" width="50%">
			<table class="basic_table" width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width="150">
			<colgroup width="">
				<tr bgcolor="#FFFFFF">
					<td colspan="2" style="padding-left:10px">
						<b> * 기본 환경 설정</b>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">쇼핑몰명</td>
					<td>
						<input type="text"  name="shop_name" value="<?=$GnShop[shop_name]?>" style="width:100%; height:19px;" class="text">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">도메인</td>
					<td>
						<input type="text"  name="shop_url" value="<?=$GnShop[shop_url]?>" style="width:100%; height:19px;" class="text">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">쇼핑몰 대표전화번호</td>
					<td>
						<input type="text"  name="shop_tel" value="<?=$GnShop[shop_tel]?>" style="width:200px; height:19px;" class="text">
						<span style="font-size:8pt; color:blue;">ex) 070-1234-5678</span>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">관리자메일</td>
					<td>
						<input type="text"  name="admin_email" value="<?=$GnShop[admin_email]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">은행계좌정보</td>
					<td>
						<textarea name="bankinfo" rows="3" style="width:100%;" class=text><?=$GnShop[bankinfo]?></textarea>
					</td>
				</tr>
				
				<? if ($sitemenu["point_use"]) { ?>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">포인트사용</td>
					<td>
						<input type=checkbox name=point_chk value='1' <?=($GnShop[point_chk] ? "checked" : "");?>> 사용
						
						<table>
							<col width="100"></col>
							<col width="130"></col>
							<col width=""></col>
							<tr>
								<td>적립포인트</td>
								<td><input type="text" name="point_use" style="width:80px;text-align:right;" value="<?=$GnShop[point_use]?>">%</td>
								<td><span style="font-size:8pt; color:#045FB4;">상품구입시 상품가격의 입력된 %만큼 적립됩니다.</span></td>
							</tr>
							<tr>
								<td>최대사용포인트</td>
								<td><input type="text" name="point_max_use" style="width:80px;text-align:right;" value="<?=$GnShop[point_max_use]?>">%</td>
								<td><span style="font-size:8pt; color:#045FB4;">상품구입시 상품가격의 입력된 %만큼 적립금이 사용가능합니다.</span></td>
							</tr>
							<tr>
								<td>최소사용포인트</td>
								<td><input type="text" name="point_min_use" style="width:80px;text-align:right;" value="<?=$GnShop[point_min_use]?>">Point</td>
								<td><span style="font-size:8pt; color:#045FB4;">상품구입시 사용가능한 최소 적립금입니다.</span></td>
							</tr>
						</table>
					</td>
				</tr>
				<? } ?>
				<!--
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">세금계산서</td>
					<td>
						<input type=radio name=use_bill value='1' <?=($GnShop[use_bill] ? "checked" : "");?>> 발행
						<input type=radio name=use_bill value='0' <?=($GnShop[use_bill]==FALSE ? "checked" : "");?>> 미발행
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">부가세</td>
					<td>
						<input type=radio name=use_vat value='1' <?=($GnShop[use_vat] ? "checked" : "");?>> 포함
						<input type=radio name=use_vat value='0' <?=($GnShop[use_vat]==FALSE ? "checked" : "");?>> 미포함
					</td>
				</tr>
				-->
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">중간이미지 (뷰이미지)</td>
					<td>
						가로 <input type=text name="mimg_width" value="<?=($GnShop[mimg_width]>0)?$GnShop[mimg_width]:'400';?>" size=4 class="text"> *
						세로 <input type=text name="mimg_height" value="<?=($GnShop[mimg_height]>0)?$GnShop[mimg_height]:'300';?>" size=4 class="text">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">작은이미지 (리스트)</td>
					<td>
						가로 <input type=text name="simg_width" value="<?=($GnShop[simg_width]>0)?$GnShop[simg_width]:'140';?>" size=4 class="text"> *
						세로 <input type=text name="simg_height" value="<?=($GnShop[simg_height]>0)?$GnShop[simg_height]:'140';?>" size=4 class="text">
					</td>
				</tr>
				<? if ($sitemenu["trans_pay"]) { ?>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">배송비</td>
					<td>
						<input type=text name="trans_pay" value='<?=$GnShop[trans_pay] ?>' size=10 class="text">원 / 구매금액&nbsp;&nbsp;
						<input type=text name="trans_all" value='<?=$GnShop[trans_all] ?>' size=10 class="text">원 이상 무료배송
					</td>
				</tr>
				<? } ?>
				<? if ($sitemenu["use_type"]) { ?>			   
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">추출타입사용</td>
					<td>
						<input type="checkbox" name="use_type1" value="1" <?=($GnShop[use_type1] ? "checked" : "");?>> 메인추출상품&nbsp;
						<input type="checkbox" name="use_type2" value="1" <?=($GnShop[use_type2] ? "checked" : "");?>> 신상품&nbsp;
						<input type="checkbox" name="use_type3" value="1" <?=($GnShop[use_type3] ? "checked" : "");?>> 베스트상품&nbsp;
						<input type="checkbox" name="use_type4" value="1" <?=($GnShop[use_type4] ? "checked" : "");?>> 히트상품&nbsp;
					</td>
				</tr>
				<? } ?>
			</table>
		</td>
	</tr>
</table>


<!-- ------------------------------------------------------------- [ 결제모듈 관련 추가 - START ] ------------------------------------------------------------- -->

<table class="module_table" width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<col width="150"></col>
	<col width=""></col>
	<!-- ################## [ 결제모듈 관리 사용함 설정 - START ] ################## -->
	<? if ($sitemenu["mn_shopmodule_use"]) { ?>
		<tr>
			<td colspan="2" valign="top" style="padding-left:10px; padding-top:20px;">
				<b> * 결제모듈 설정</b>
			</td>
		</tr>	
		<tr>
			<td bgcolor="#F0F0F0" style="padding-left:10px">서비스상태</td>
			<td>
				<input type="radio" name="pg_status" value="test" <? if($GnShop[pg_status]=="test" || $GnShop[pg_status]=="") { ?>checked="checked"<? }?>style="vertical-align:middle;">TEST&nbsp;&nbsp;
				<input type="radio" name="pg_status" value="service" <? if($GnShop[pg_status]=="service") { ?>checked="checked"<? }?>style="vertical-align:middle;">SERVICE&nbsp;&nbsp;
				<span style="font-size:8pt; color:#ff0000;">* 주의 : SERVICE 선택시 실제 결제가 진행됩니다. </span>
			</td>
		</tr>
		<tr><td colspan="2" valign="top" style="padding-top:5px;"></td></tr>	
		<tr>
			<td bgcolor="#F0F0F0" style="padding-left:10px;" bgcolor="#E0E0E0">결제사 선택</td>
			<td valign="middle" height="50">
				<input type="radio" name="pg_module" value="" onclick="pg_select('no');" <? if($GnShop[pg_module]=="") { ?>checked="checked"<? }?> class="text" style="vertical-align:middle;">
				사용안함&nbsp;&nbsp;
				<input type="radio" name="pg_module" value="LG" onclick="pg_select('display_lg');" <? if($GnShop[pg_module]=="LG") { ?>checked="checked"<? }?> class="text" style="vertical-align:middle;">
				LG U+ OpenXPay&nbsp;&nbsp;
				<input type="radio" name="pg_module" value="INICIS" onclick="pg_select('display_inicis');" <? if($GnShop[pg_module]=="INICIS") { ?>checked="checked"<? }?> class="text" style="vertical-align:middle;">
				INICIS&nbsp;&nbsp;
				<input type="radio" name="pg_module" value="KCP" onclick="pg_select('display_kcp');" <? if($GnShop[pg_module]=="KCP") { ?>checked="checked"<? }?> class="text" style="vertical-align:middle;">
				KCP&nbsp;&nbsp;
			</td>
		</tr>
		
		<!-- ------------------------------------------------------------- [ LG - START ] ------------------------------------------------------------- -->
		<tr class="pg_menu display_lg" style="display:none;">
			<td bgcolor="#F6CED8" style="padding-left:10px">결제모듈 버젼</td>
			<td>
				LGU+_XPay <br>
				+ OpenXPay <br>
				+ escrow 배송정보 등록
			</td>
		</tr>
		<tr class="pg_menu display_lg" style="display:none;">
			<td bgcolor="#F6CED8" style="padding-left:10px">상점관리자</td>
			<td>
				<span style="font-size:9pt;"><a href="https://pgweb.uplus.co.kr/pg/wmp/LoginMertAdmin.jsp" target="_blank"><span style="color:#ff0000;">[LG 상점관리자 바로가기]</span></a></span>
			</td>
		</tr>
		<tr class="pg_menu display_lg" style="display:none;" bgcolor="#FFFFFF">
			<td bgcolor="#F6CED8" style="padding-left:10px">LG U+ 상점ID</td>
			<td>
				<input type="text"  name="LG_pg_id" value="<?=$GnShop[LG_pg_id]?>" style="width:200px; height:22px; " class="text"><br>
				<span style="font-size:8pt; ">* 상점아이디(LG유플러스으로 부터 발급받으신 상점아이디를 입력) </span><br>
				<span style="font-size:8pt; ">* 입력 예 : <span style="color:#045FB4;">lgdacomxpay</span></span>
			</td>
		</tr>
		<tr class="pg_menu display_lg" style="display:none;" bgcolor="#FFFFFF">
			<td bgcolor="#F6CED8" height="50" style="padding-left:10px">LGD_MERTKEY</td>
			<td>
				<input type="text"  name="LG_pg_key" value="<?=$GnShop[LG_pg_key]?>" style="width:45%; height:22px; " class="text"><br>
				<span style="font-size:8pt; ">* 입력 예 : <span style="color:#045FB4;">95160cce09854ef44d2edb2bfb05f9f3</span></span>
			</td>
		</tr>
		<tr class="pg_menu display_lg" style="display:none;" bgcolor="#FFFFFF">
			<td bgcolor="#F6CED8" style="padding-left:10px">LGD_CASNOTEURL</td>
			<td>
				<input type="text"  name="LG_pg_casurl" value="<?=$GnShop[LG_pg_casurl]?>" style="width:45%; height:22px; " class="text"><br>
				<span style="font-size:8pt; ">* 가상계좌 자동 입금확인 처리등의 연동을 원하시는 경우 모듈내의 cas_noteurl.php의 절대경로를  설정하여 주시기 바랍니다. </span><br>
				<span style="font-size:8pt; ">* 입력 예 : <span style="color:#045FB4;">http://gamgakdesign.com/module/lgxpay/cas_noteurl.php</span></span>
			</td>
		</tr>
		<tr class="pg_menu display_lg" style="display:none;" bgcolor="#FFFFFF">
			<td bgcolor="#F6CED8" height="50" style="padding-left:10px">필수 : mall.conf 수정</td>
			<td>
				<span style="font-size:9pt; ">* mall.conf 파일을 반드시 해당업체 정보로 직접 수정해야 합니다. <br>
					<span style="color:#ff0000;">* 파일경로 : /module/lgxpay/lgdacom/conf/mall.conf</span></span> <br>
					<span style="color:#045FB4;">
						log_dir <br>
						상점아이디=MertKey <br>
						t상점아이디 = MertKey
					</span>
				</span> 
				<br><br>
				<img src="/module/lgxpay/example.gif">
			</td>
		</tr>

		<!-- ------------------------------------------------------------- [ INICIS - START ] ------------------------------------------------------------- -->
		<tr class="pg_menu display_inicis" style="display:none;">
			<td bgcolor="#DFEDF8" style="padding-left:10px">결제모듈 버젼</td>
			<td>
				INIpay V5.0 (TX) <br>
				+ 가상계좌 수신모듈
			</td>
		</tr>
		<tr class="pg_menu display_inicis" style="display:none;">
			<td bgcolor="#DFEDF8" style="padding-left:10px">상점관리자</td>
			<td>
				<span style="font-size:9pt;"><a href="https://iniweb.inicis.com" target="_blank"><span style="color:#ff0000;">[이니시스 상점관리자 바로가기]</span></a></span>
			</td>
		</tr>
		<tr class="pg_menu display_inicis" style="display:none;">
			<td bgcolor="#DFEDF8" style="padding-left:10px">INICIS 상점 ID</td>
			<td>
				<input type="text"  name="INI_pg_id" value="<?=$GnShop[INI_pg_id]?>" style="width:200px; height:22px; " class="text"><br>
				<span style="font-size:8pt; ">* 상점아이디(INICIS 로부터 발급받으신 상점아이디를 입력)</span><br>
				<span style="font-size:8pt; color:#ff0000;">* 필수 : 이니시스 상점 계약후 발급받은 key파일을 결제모듈 폴더에 업로드 해야 합니다.</span><br>
				<span style="font-size:8pt; color:#ff0000;">* 모듈 FTP 경로 : /module/inicis/key/</span><br>
			</td>
		</tr>
		<tr class="pg_menu display_inicis" style="display:none;">
			<td bgcolor="#DFEDF8" style="padding-left:10px">가상계좌입금통보URL</td>
			<td>
				<span style="font-size:8pt; ">
					* 가상계좌 자동 입금확인 처리등의 연동을 원하시는 경우 <br>
					* 모듈의 /module/inicis/vacctinput.php 페이지의 URL이 이니시스 가맹점관리자페이지 <span style="color:blue">[거래내역 - 가상계좌 - 입금통보방식선태]</span> 에 아래와 같은 형태로 미리 등록되어있어야 처리가 가능합니다.<br>
					<br>
					<span style="font-size:9pt;"><a href="https://iniweb.inicis.com" target="_blank">[이니시스 상점관리자 바로가기]</a></span>
					<br><br>
					<img src="/module/inicis/example.png">
				</span>
			</td>
		</tr>
		<tr class="pg_menu display_inicis" style="display:none;">
			<td bgcolor="#DFEDF8" style="padding-left:10px">INICIS 서버환경테스트</td>
			<td>
				<span style="font-size:8pt; ">* 서버환경체크 팝업창에 아래와같이 4가지항목이 모두 available 상태여야 합니다.</span><br>
				<a href="/module/inicis/sample/check.php" target="_blank"> <span style="font-size:9pt; color:red;">[서버환경 체크하기]</span></a><br>
				<span style="font-size:8pt; color:blue;">
					XML functions are available.<br>
					OPENSSL functions are available.<br>
					SOCKET functions are available.<br>
					MCRYPT functions are available.<br>
				</span>
			</td>
		</tr>

		<!-- ------------------------------------------------------------- [ KCP - START ] ------------------------------------------------------------- -->
		<tr class="pg_menu display_kcp" style="display:none;">
			<td bgcolor="#CEF6E3" style="padding-left:10px">결제모듈 버젼</td>
			<td>
				Ver 6.0 [AX-HUB Version]
			</td>
		</tr>
		<tr class="pg_menu display_kcp" style="display:none;">
			<td bgcolor="#CEF6E3" style="padding-left:10px">상점관리자</td>
			<td>
				<span style="font-size:9pt;"><a href="http://admin.kcp.co.kr" target="_blank"><span style="color:#ff0000;">[KCP 상점관리자 바로가기]</span></a></span>
			</td>
		</tr>
		<tr class="pg_menu display_kcp" style="display:none;">
			<td bgcolor="#CEF6E3" style="padding-left:10px">KCP 상점 ID</td>
			<td>
				<input type="text"  name="KCP_pg_id" value="<?=$GnShop[KCP_pg_id]?>" style="width:200px; height:22px;" class="text"><br>
				<span style="font-size:8pt; ">* 가상계좌 자동 입금확인 처리등의 연동을 원하시는 경우 <br>
					<span style="color:#045FB4;">* 모듈의 common_return페이지의 URL이 KCP 가맹점관리자페이지 [쇼핑몰관리 - 정보변경 - 공통URL 정보]에 미리 등록되어있어야 처리가 가능합니다.</span>
				</span>
			</td>
		</tr>
		
		<!-- ------------------------------------------------------------- [ 결제방식 - START ] ------------------------------------------------------------- -->
		<tr>
			<td colspan="2" valign="top" style="padding-left:10px; padding-top:20px;">
				<b> * 결제방식 설정</b>
			</td>
		</tr>	
		<tr bgcolor="#FFFFFF">
			<td bgcolor="#F0F0F0" style="padding-left:10px;">결제방식선택</td>
			<td>
				<input type="checkbox" name="use_bank" style="vertical-align:middle;" value="1" <? if($GnShop[use_bank]=="1" || "0") { ?>checked="checked" <? } ?>>무통장입금(결제모듈 비연동)&nbsp;
				<input type="checkbox" name="use_card" style="vertical-align:middle;" value="1" <? if($GnShop[use_card]=="1" || "0") { ?>checked="checked" <? } ?>>신용카드&nbsp;
				<input type="checkbox" name="use_trans" style="vertical-align:middle;" value="1" <? if($GnShop[use_trans]=="1" || "0") { ?>checked="checked" <? } ?>>계좌이체&nbsp;
				<input type="checkbox" name="use_virtual" style="vertical-align:middle;" value="1" <? if($GnShop[use_virtual]=="1" || "0") { ?>checked="checked" <? } ?>>가상계좌&nbsp;
				<!-- <input type="checkbox" name="use_phon" style="vertical-align:middle;" value="1" <? if($GnShop[use_phon]=="1" || "0") { ?>checked="checked" <? } ?>>휴대폰 -->
			</td>
		</tr>

	<!-- ################## [ 결제모듈 관리 사용안함 설정 - START ] ################## -->
	<? } else { ?>
		<tr>
			<td colspan="2" valign="top" style="padding-left:10px; padding-top:20px;">
				<b> * 결제방식 설정</b>
			</td>
		</tr>	
		<tr bgcolor="#FFFFFF">
			<td bgcolor="#F0F0F0" style="padding-left:10px;">결제방식</td>
			<td>
				<input type="hidden" name="use_bank" value="1">
				무통장입금(결제모듈 비연동)&nbsp;<!-- 결제모듈 관리 사용안할시 무통장 고정 -->
			</td>
		</tr>
	<? } ?>
</table>

<table width="100%">
	<tr>
		<td align="center" height="50">
			<input type="image" src="/btn/btn_modify.gif" border="0">
		</td>
	</tr>
</table>

</form>


<style type="text/css">
.basic_table td { padding:4px; }
.module_table { padding:10px; }
.module_table td { border-bottom:1px solid #E0E0E0; padding:7px;}
</style>

<script type='text/javascript'>
// 저장한 결제사로 출력하기
<? if ($GnShop[pg_module]=="LG") { ?>
	pg_select("display_lg");
<? } else if ($GnShop[pg_module]=="INICIS") { ?>
	pg_select("display_inicis");
<? } else if ($GnShop[pg_module]=="KCP") { ?>
	pg_select("display_kcp");
<? } ?>

function pg_select(value){
	$(".pg_menu").hide();
	$("."+value).show();
}

function fitemformcheck(form) {
	if (parseInt(form.point_max_use.value)>=100) {
		alert ("최대사용포인트는 100%보다 작아야합니다.");
		form.point_max_use.focus();
		return false;
	}
    if (confirm("수정하시겠습니까?")) {
		editor_wr_ok();
	    return true;
	} 
	else {
		return false;
	}
}

	function transgrub_add(fld)
	{
		var f = document.fshopform;
		var len = f.transgrub.length;
		var find = false;

		for (i=0; i<len; i++) {
			if (fld.options[fld.selectedIndex].value == f.transgrub.options[i].value) {
				find = true;
				break;
			}
		}

		// 같은 이벤트를 찾지못하였다면 입력
		if (!find) {
			f.transgrub.length += 1;
			f.transgrub.options[len].value = fld.options[fld.selectedIndex].value;
			f.transgrub.options[len].text  = fld.options[fld.selectedIndex].text;
		}

		transgrub_hidden();
	}

	function transgrub_del(fld)
	{
		if (fld.length == 0) {
			return;
		}

		if (fld.selectedIndex < 0)
			return;

		for (i=0; i<fld.length; i++) {
			// 선택된것과 값이 같다면 1을 더한값을 현재것에 복사
			if (fld.options[i].value == fld.options[fld.selectedIndex].value) {
				for (k=i; k<fld.length-1; k++) {
					fld.options[k].value = fld.options[k+1].value;
					fld.options[k].text  = fld.options[k+1].text;
				}
				break;
			}
		}
		fld.length -= 1;

		transgrub_hidden();
	}

	// hidden 값을 변경
	function transgrub_hidden()
	{
		var f = fshopform;

		var str = '';
		var comma = '';
		for (i=0; i<f.transgrub.length; i++) {
			str += comma + f.transgrub.options[i].value;
			comma = ',';
		}
		f.trans_grub.value = str;
	}
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
//////////////////////////////////////// 구매금액별 사은품   //////////////////////////////////////////////////////////////
	function Ppay_add(fld)
	{
		var f = document.fshopform;
		var len = f.relationselect_P.length;
		var find = false;

		for (i=0; i<len; i++) {
			if (fld.options[fld.selectedIndex].value == f.relationselect_P.options[i].value) {
				find = true;
				break;
			}
		}

		// 같은 이벤트를 찾지못하였다면 입력
		if (!find) {
			f.relationselect_P.length += 1;
			f.relationselect_P.options[len].value = fld.options[fld.selectedIndex].value;
			f.relationselect_P.options[len].text  = fld.options[fld.selectedIndex].text;
		}

		Ppay_hidden();
	}

	function Ppay_del(fld)
	{
		if (fld.length == 0) {
			return;
		}

		if (fld.selectedIndex < 0)
			return;

		for (i=0; i<fld.length; i++) {
			// 선택된것과 값이 같다면 1을 더한값을 현재것에 복사
			if (fld.options[i].value == fld.options[fld.selectedIndex].value) {
				for (k=i; k<fld.length-1; k++) {
					fld.options[k].value = fld.options[k+1].value;
					fld.options[k].text  = fld.options[k+1].text;
				}
				break;
			}
		}
		fld.length -= 1;

		Ppay_hidden();
	}

	// hidden 값을 변경
	function Ppay_hidden()
	{
		var f = fshopform;

		var str = '';
		var comma = '';
		for (i=0; i<f.relationselect_P.length; i++) {
			str += comma + f.relationselect_P.options[i].value;
			comma = ',';
		}
		f.present_pay.value = str;
	}
//////////////////////////////////////// 개별상품별 사은품   //////////////////////////////////////////////////////////////
	function Pitem_add(fld)
	{
		var f = document.fshopform;
		var len = f.relationselect_I.length;
		var find = false;

		for (i=0; i<len; i++) {
			if (fld.options[fld.selectedIndex].value == f.relationselect_I.options[i].value) {
				find = true;
				break;
			}
		}

		// 같은 이벤트를 찾지못하였다면 입력
		if (!find) {
			f.relationselect_I.length += 1;
			f.relationselect_I.options[len].value = fld.options[fld.selectedIndex].value;
			f.relationselect_I.options[len].text  = fld.options[fld.selectedIndex].text;
		}

		Pitem_hidden();
	}

	function Pitem_del(fld)
	{
		if (fld.length == 0) {
			return;
		}

		if (fld.selectedIndex < 0)
			return;

		for (i=0; i<fld.length; i++) {
			// 선택된것과 값이 같다면 1을 더한값을 현재것에 복사
			if (fld.options[i].value == fld.options[fld.selectedIndex].value) {
				for (k=i; k<fld.length-1; k++) {
					fld.options[k].value = fld.options[k+1].value;
					fld.options[k].text  = fld.options[k+1].text;
				}
				break;
			}
		}
		fld.length -= 1;

		Pitem_hidden();
	}

	// hidden 값을 변경
	function Pitem_hidden()
	{
		var f = fshopform;

		var str = '';
		var comma = '';
		for (i=0; i<f.relationselect_I.length; i++) {
			str += comma + f.relationselect_I.options[i].value;
			comma = ',';
		}
		f.present_item.value = str;
	}
</SCRIPT>
