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
<td>
<!-- 테이블의 시작 -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
	<td height="30" align=""><span class="style1">주문서 작성</span></td>
	</tr>
	<tr>
	<td>
	<!--구매상품내역 테이블 시작 -->
	<?
	$s_page = "order_form.php";

	if($_GET[tmp_on_uid]){
		if($_SESSION[ss_od_on_uid]) $s_on_uid = $_SESSION[ss_od_on_uid];
	}else $s_on_uid = $_SESSION[ss_on_uid];

	?>
	<? include "./shopbag_inc.php"; ?>

	<!--구매상품내역 테이블 끝    -->				</td>
	</tr>
	<!-- 폼의 시작 -->
	<form name="forderform" method="post" action="<?=$ssl_url?>/shop/order_receipt.php" onsubmit="return forderform_check(this);">
	<!-- <input type="text" name="od_amount" value='<?=$tot_amount?>'> -->
	<input type="hidden" name="od_send_cost" value='<?=$send_cost?>'>
	<input type="hidden" name="tmp_on_uid" value='<?=$_GET[tmp_on_uid]?>'>
	<tr>
	<td>
	<!-- 테이블의 시작 -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td height="30"><span class="style1">주문자 정보</span></td>
		</tr>
		<tr>
		<td >
		<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td height="2" colspan="2" bgcolor="#aaa"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 주문하시는분</td>
			<td width="79%" style="padding-left:5px;"> <input type="text" name="od_name" maxlength="20" size="23"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" value="<?=$_SESSION["username"]?>"></td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px;  background-color:#f5f5f5;  font-weight:bold; color:#222;padding-left:20px;"> 전화번호</td>
			<td width="79%" style="padding-left:5px;"> <input name="od_tel" type="text" id="mtel1"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" value="<?=$_SESSION["phone"]?>" maxlength="20"></td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 휴대전화</td>
			<td width="79%" style="padding-left:5px;"> <input name="od_hp" type="text" id="mtel1"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" value="<?=$_SESSION["mobile"]?>" maxlength="20"></td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 이메일</td>
			<td width="79%" style="padding-left:5px;"> <input name="od_email" type="text" id="email"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" value="<?=$_SESSION["email"]?>" size="28" maxlength="50">
			[예] master@master.com</td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<? if (!Login_check() ) { // 비회원이면 ?>
			<tr>
			<td width="21%" height="24"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 비밀번호</td>
			<td width="79%" style="padding-left:5px;"> <input type=password name=od_pwd class=edit maxlength=20  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" ></td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<? } ?>
			<tr>
			<td width="21%" height="85" rowspan="2"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 주소</td>
			<td width="79%" style="padding-left:5px;padding-top:7px;"> <input name="od_zip" id="od_zip" type="text" id="hzip01"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" value="<?=$_SESSION["post"]?>" size="10" readonly>

			<!-- <a href="#asd" onclick="autoAddress('od_zip','od_addr1','od_addr2','forderform');"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a> -->
			<!-- <a href="#asd" onclick="win_zip('forderform', 'od_zip', 'od_addr1', 'od_addr2');" align="absmiddle"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a> -->

			<a href="#asd" onclick="openDaumPostcode('od_zip','od_addr1','od_addr2');">
			<img src="/btn/btn_address.gif" border="0" style="cursor:pointer" align="absmiddle">
			</a>

			</td>
			</tr>
			<tr>
			<td height="65" style="padding-left:5px;"><input type=text name=od_addr1 id=od_addr1 size=35 maxlength=50 value='<?=$_SESSION["address1"]?>' class=form_input1   style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" readonly>
			<br>
			<input type=text name=od_addr2 id=od_addr2 size=35 maxlength=50 value='<?=$_SESSION["address2"]?>' class=form_input  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff;margin-top:5px;">
			[나머지주소입력]</td>
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
		<td height="30"><span class="style1">배송지 정보</span></td>
		</tr>
		<tr>
		<td >
		<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td height="2" colspan="2" bgcolor="#aaa"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 정보동일확인</td>
			<td width="79%" style="padding-left:5px;"> <input type=checkbox name=same onclick="javascript:gumae2baesong(document.forderform);" style="border:0">
			주문자와 정보동일</td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 받으시는분</td>
			<td width="79%" style="padding-left:5px;"> <input name="od_b_name" type="text" id="getname"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" size="23" maxlength="20"></td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 전화번호</td>
			<td width="79%" style="padding-left:5px;"> <input type=text name=od_b_tel class=edit maxlength="20"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff"></td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 휴대전화</td>
			<td width="79%" style="padding-left:5px;"> <input type=text name=od_b_hp class=edit  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" maxlength="20"></td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="85" rowspan="2"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 주소</td>
			<td width="79%" style="padding-left:5px;padding-top:7px;">
			<input name="od_b_zip" type="text"  id="od_b_zip"  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff" size="10" readonly>

			<!-- <a href="#asd" onclick="autoAddress('od_b_zip','od_b_addr1','od_b_addr2','forderform');"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a> -->
			<!-- <a href="#asd" onclick="win_zip('forderform', 'od_b_zip', 'od_b_addr1', 'od_b_addr2');" align="absmiddle"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a> -->

			<a href="#asd" onclick="openDaumPostcode('od_b_zip','od_b_addr1','od_b_addr2');">
			<img src="/btn/btn_address.gif" border="0" style="cursor:pointer" align="absmiddle">
			</a>

			</td>
			</tr>
			<tr>
			<td height="65"style="padding-left:5px;">
			<input type=text name=od_b_addr1 id=od_b_addr1 class="form_input1"  maxlength=50 class=edit readonly  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff"><br>
			<input type=text name=od_b_addr2 id=od_b_addr2 size=35 maxlength=50 class=form_input  style="height:24px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 24px; BACKGROUND-COLOR: #ffffff;margin-top:5px;">
			[나머지주소입력]</td>
			</tr>
			<tr bgcolor="#E7E7E7">
			<td height="1" colspan="2"> </td>
			</tr>
			<tr>
			<td width="21%" height="80"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 요청사항</td>
			<td width="79%" style="padding-left:5px;"> <textarea name=od_memo rows=4 cols=60 class=edit></textarea></td>
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
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>
	<!-- 테이블의 시작 -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="30"><span class="style1">결제정보</span></td>
		</tr>
		<tr>
		<td >
		<!-- 테이블의 시작 -->


		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="od">
			<tr><td height="2" colspan="2" bgcolor="#aaa"> </td></tr>

			<?
			/* ------------------------------------------------------------- [ 관리자 적립금 기능 사용 + 회원적립금 0원이상 - START ] ------------------------------------------------------------- */
			$f_tot_amount_len -= 2; // "원" 길이만큼 뺀다
			$member = Get_member($_SESSION['userid']);
			$mem_point = $member['mem_point'];
			if ($GnShop['point_chk']==TRUE && $mem_point>0)
			{
				$receipt_prod_point=($total_money*$GnShop['point_max_use'])/100;
				if ($receipt_prod_point<=$mem_point) $receipt_point=$receipt_prod_point;
				else $receipt_point=$mem_point;
				?>
				<tr>
					<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 적립금사용</td>
					<td width="79%" style="padding-left:5px;">

						<table width="100%">
							<col width="150" />
							<col width="" />
							<tr style="border-bottom:1px solid #ececec;">
								<td align="left" colspan="2" >
									<input type=text name=od_receipt_point value='0' size='<?=$f_tot_amount_len?>' style='width:60px; height:20px; text-align:right;ime-mode:disabled; margin-top:10px;' class=edit onFocus='this.value = no_comma(this.value); this.select();' onchange="OdReceiptPoint(this,'<?=$receipt_point?>');oder_min_point(this.form, this, this.value, '<?=$GnShop['point_min_use']?>');"> 포인트 사용
								</td>
							</tr>
							<tr style="border-bottom:1px solid #ececec;">
								<th align="left">최대 사용가능 적립금 : </th>
								<td align="left"><?=display_point($receipt_point)?></td>
							</tr>
							<tr style="border-bottom:1px solid #ececec;">
								<th align="left" >최소 사용가능 적립금 : </th>
								<td align="left"><?=number_format($GnShop['point_min_use'])?> 포인트</td>
							</tr>
							<tr>
								<th align="left">My Point : </th>
								<td align="left"><?=number_format($mem_point)?> 포인트</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr><td height="1" colspan="2" bgcolor="#E7E7E7"> </td></tr>
				<?
			}
			/* ------------------------------------------------------------- [ 관리자 적립금 기능 사용 + 회원적립금 0원이상 - End ] ------------------------------------------------------------- */
			?>
			<tr>
				<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 결제예정금액</td>
				<td width="79%" style="padding-left:5px;">
					<input type="text" name="od_amount" value='<?=$tot_amount?>'  style="text-align:right; padding-right:10px; width:120px; border:0px;" readonly="readonly">원
				</td>
			</tr>
			<tr><td height="1" colspan="2" bgcolor="#E7E7E7"> </td></tr>


			<tr>
				<td width="21%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 결제방법</td>
				<td width="79%" style="padding-left:5px;">
				<!-- -------------------------------------------------------------------------- [ 관리자 연동 - 결제방식 선택 - Start ] ------------------------------------------------------------------------------------------ -->
				<? if($GnShop["use_bank"]) { ?><input type="radio" class="radd srch_input" name="od_settle_case" value="무통장" checked="checked"> 무통장입금<br><? } ?>
				<? if($sitemenu["mn_shopmodule_use"]) { ?>
					<? if($GnShop["use_card"]) { ?><input type="radio" class="radd srch_input" name="od_settle_case" value="신용카드"  style='vertical-align:middle;'> 신용카드 결제<br><? } ?>
					<? if($GnShop["use_trans"]) { ?><input type="radio" class="radd srch_input" name="od_settle_case" value="계좌이체" style='vertical-align:middle;'> 실시간 계좌이체<br><? } ?>
					<? if($GnShop["use_virtual"]) { ?><input type="radio" class="radd srch_input" name="od_settle_case" value="가상계좌" style='vertical-align:middle;'> 가상계좌<br><? } ?>
					<!-- <input type="radio" class="radd srch_input" name="od_settle_case" value="휴대폰" style='vertical-align:middle;'> 휴대폰<br> -->
				<? } ?>
				<!-- -------------------------------------------------------------------------- [ 관리자 연동 - 결제방식 선택 - End ] ------------------------------------------------------------------------------------------- -->
				</td>
			</tr>
			<tr><td height="1" colspan="2" bgcolor="#E7E7E7"> </td></tr>
			<!--tr>
			<td height="35"  style="padding-left:5px;"> 영수증발행여부</td>
			<td style="padding-left:5px;">
			<input name='radiobutton' type='radio' class='radd' value='필요없음' onclick="businessdec();" checked> 필요없음&nbsp;
			<input name='radiobutton' type='radio' class='radd' value='현금영수증' onclick="businessdec();"> 현금영수증&nbsp;
			<input name='radiobutton' type='radio' class='radd' value='세금계산서' onclick="businessdec();"> 세금계산서 발행(사업자)                </td>
			</tr-->
			<tr id="layerbusiness" style="border:dashed 1px #cccccc;display:none;">
			<td  colspan="2">
			<!-- 테이블의 시작 -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td height="2" colspan="4" bgcolor="#E7E7E7"> </td>
				</tr>
				<tr>
				<td width="15%" height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 회사명</td>
				<td width="35%" style="padding-left:5px;"><input name="office_name" type="text" style="width:100px;" maxlength="20"></td>
				<td width="15%" style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 업태/종류</td>
				<td width="35%" style="padding-left:5px;"><input name="office_kind" type="text" style="width:100px;" maxlength="20"></td>
				</tr>
				<tr bgcolor="#E7E7E7">
				<td height="1" colspan="4"> </td>
				</tr>
				<tr>
				<td  height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 대표자성명</td>
				<td style="padding-left:5px;"> <input name="office_ceo" type="text" style="width:100px;" maxlength="20"></td>
				<td style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 사업자등록번호</td>
				<td style="padding-left:5px;">
				<input name="office_num1" type="text" style="width:50px;" maxlength="3"> -
				<input name="office_num2" type="text"  style="width:30px;" maxlength="2"> -
				<input name="office_num3" type="text" style="width:70px;" maxlength="5">                        </td>
				</tr>
				<tr bgcolor="#E7E7E7">
				<td height="1" colspan="4"> </td>
				</tr>
				<tr>
				<td  height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 품목</td>
				<td style="padding-left:5px;"> <input name="office_make" type="text" style="width:100px;" maxlength="20"></td>
				<td style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 회사전화</td>
				<td style="padding-left:5px;"><input name="office_tell" type="text" style="width:100px;" maxlength="20"></td>
				</tr>
				<tr bgcolor="#E7E7E7">
				<td height="1" colspan="4"> </td>
				</tr>
				<tr>
				<td  height="35"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 홈페이지 URL</td>
				<td colspan="3" style="padding-left:5px;"> <input name="office_hompageurl" type="text"  style="width:300px;"></td>
				</tr>
				<tr bgcolor="#E7E7E7">
				<td height="1" colspan="4"> </td>
				</tr>
				<tr>
				<td  height="80" rowspan="2"  style="padding-left:5px; background-color:#f5f5f5; font-weight:bold; color:#222; padding-left:20px;"> 사업장 주소</td>
				<td colspan="3" style="padding-left:5px;">
				<input name="office_post" type="text"  style="width:100px;">
				<a href="#asd" onclick="autoAddress('office_post','office_addr1','office_addr2','forderform');"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a>                        </td>
				</tr>
				<tr>
				<td colspan="3" style="padding-left:5px;">
				<input type=text name=office_addr1 size=35 maxlength=50 class=edit readonly  style="width:300px;"><br>
				<input type=text name=office_addr2 size=20 maxlength=50 class=edit  style="width:120px;"> [나머지주소입력]</td>
				</tr>
				<tr>
				<td height="2" colspan="4" bgcolor="#E7E7E7"> </td>
				</tr>
				</table>
			<!-- 테이블의 끝 -->
			</td>
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
	<td align="center">
		<input type="submit" border="0" onclick="return writeChk(writeform)" value="다음" style="width:70px; height:27px; background:#f8f8f8;  font-weight:700; border:1px solid #dbdbdb; color:#111111; text-align:center; line-height:1.5; vertical-align:top; cursor:pointer;">&nbsp;
		<a href="./list.php"><div class="btn_list" style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">목록</div></a>
	</td>
	</tr>
	</form>
	<!-- 폼의 끝 -->

	</table>
<!-- 테이블의 끝 -->
</td>
</tr>
<tr>
<td height="50" align="center">&nbsp;</td>
</tr>
</table>
<!-- 테이블의 끝 -->


<script type='text/javascript'>
function OdReceiptPoint(fid,v)
{
	var c = Number(fid.value);
	var v = Number(v);
	if(c&&v)
	{
		if(v < c)
		{
			alert("최대 "+v+"포인트 보다 작아야 합니다.");
			fid.value = '';
		}
	}
}

// 적립금 최소 사용가능 금액 검사 20140828 mj ----------------------------------------------------------
function oder_min_point(f,fld,this_value,order_min_point) {
	var value = no_comma(this_value);	//	쉼표제거

	f.od_amount.value = <?=$tot_amount?>;		//	결제금액을 다시 원상복구 해놓는다.

	if ( eval(value) > 0)
	{
		// 최소사용가능금액보다 적립금이 적으면
		if ( eval(value) < eval(order_min_point) ) {
			f.od_amount.value = <?=$tot_amount?>;		//	결제금액을 다시 원상복구 해놓는다.
			alert("적립금은 최소 "+order_min_point+"Point 이상부터 사용 가능합니다.");
			f.od_receipt_point.value = 0;	//	적립금 입력필드 0으로 초기화
		}
		// 적립금을 차감한 나머지 금액을 출력
		else
		{
			compute_amount(f, fld);		//	적립금금액만큼 차감한 최종 결제 금액 출력
		}
	}

}
// ------------------------------------------------------------------------------------------------------------------


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
	//fld.value = number_format(String(x));
	fld.value = String(x);
	//settle_amount = parseFloat(f.od_amount.value) + parseFloat(f.od_send_cost.value);
	settle_amount = parseFloat(f.od_amount.value);
	od_amount = 0;
	od_receipt_card = 0;
	od_receipt_point = 0;
	if (typeof(f.od_amount) != 'undefined')
		od_amount = parseFloat(no_comma(f.od_amount.value));
	if (typeof(f.od_receipt_card) != 'undefined')
		od_receipt_card = parseFloat(no_comma(f.od_receipt_card.value));
	if (typeof(f.od_receipt_point) != 'undefined')
		od_receipt_point   = parseFloat(no_comma(f.od_receipt_point.value));
	sum = od_amount + od_receipt_card + od_receipt_point;
	// 입력합계금액이 결제금액과 같지 않다면
	if (sum != settle_amount)
	{
		if (fld.name == 'od_receipt_point')
		{
			if (typeof(f.od_amount) != 'undefined')
			{
				od_amount = settle_amount - (od_receipt_point + od_receipt_card);
				f.od_amount.value = od_amount;
			}
			else if (typeof(f.od_receipt_card) != 'undefined')
			{
				od_receipt_card = settle_amount - (od_receipt_point + od_amount);
				f.od_receipt_card.value = od_receipt_card;
			}
			else
			{
				f.od_receipt_point.value = od_receipt_point;
			}
		}
		else if (fld.name == 'od_receipt_card')
		{
			if (typeof(f.od_amount) != 'undefined')
			{
				od_amount = settle_amount - (od_receipt_point + od_receipt_card);
				f.od_amount.value = od_amount;
			}
			else
			{
				f.od_receipt_card.value = od_receipt_card;
			}
		}
		else if (fld.name == 'od_amount')
		{
			if (typeof(f.od_receipt_point) == 'undefined')
			{
				if (typeof(f.od_receipt_card) == 'undefined') {
					;
				} else {
					od_receipt_card = settle_amount - od_amount;
					f.od_receipt_card.value = od_receipt_card;
				}
			}
		}
		return;
	}
}




//  2009.3.21 Ki-hong Park
function businessdec(){
	if(document.forderform.radiobutton[1].checked==true || document.forderform.radiobutton[2].checked==true){
		document.getElementById("layerbusiness").style.display = "block";
	}else document.getElementById("layerbusiness").style.display = "none";
}
function forderform_check(f)
{
    errmsg = "";
    errfld = "";
    var deffld = "";
    check_field(f.od_name, "주문하시는 분 이름을 입력하십시오.");
    if (typeof(f.od_pwd) != 'undefined')
    {
        clear_field(f.od_pwd);
        if( (f.od_pwd.value.length<3) || (f.od_pwd.value.search(/([^A-Za-z0-9]+)/)!=-1) )
            error_field(f.od_pwd, "회원이 아니신 경우 주문서 조회시 필요한 비밀번호를 3자리 이상 입력해 주십시오.");
    }
    check_field(f.od_tel, "주문하시는 분 전화번호를 입력하십시오.");
    check_field(f.od_addr1, "우편번호 찾기를 이용하여 주문하시는 분 주소를 입력하십시오.");
    check_field(f.od_addr2, " 주문하시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_zip, "");
    clear_field(f.od_email);
    if(f.od_email.value=='' || f.od_email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1)
        error_field(f.od_email, "E-mail을 바르게 입력해 주십시오.");
    if (typeof(f.od_hope_date) != "undefined")
    {
        clear_field(f.od_hope_date);
        if (!f.od_hope_date.value)
            error_field(f.od_hope_date, "희망배송일을 선택하여 주십시오.");
    }
    check_field(f.od_b_name, "받으시는 분 이름을 입력하십시오.");
    check_field(f.od_b_tel, "받으시는 분 전화번호를 입력하십시오.");
    check_field(f.od_b_addr1, "우편번호 찾기를 이용하여 받으시는 분 주소를 입력하십시오.");
    check_field(f.od_b_addr2, "받으시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_b_zip, "");
    // 배송비를 받지 않거나 더 받는 경우 아래식에 + 또는 - 로 대입
    f.od_send_cost.value = parseInt(f.od_send_cost.value);
    if (errmsg)
    {
        alert(errmsg);
        errfld.focus();
        return false;
    }
    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }
/*
		if(f.office_name.value==""){
			alert("회사명을 입력하여 주십시오.");
			f.office_name.focus();
			return false;
		}
		if(f.office_kind.value==""){
			alert("업태/종류를 입력하여 주십시오.");
			f.office_kind.focus();
			return false;
		}
		if(f.office_ceo.value==""){
			alert("대표자성명을 입력하여 주십시오.");
			f.office_ceo.focus();
			return false;
		}
		if(f.office_num1.value==""||f.office_num2.value==""||f.office_num3.value==""){
			alert("사업자등록번호를 입력하여 주십시오.");
			f.office_num1.focus();
			return false;
		}
		if(f.office_make.value==""){
			alert("품목을 입력하여 주십시오.");
			f.office_make.focus();
			return false;
		}
		if(f.office_tell.value==""){
			alert("회사전화를 입력하여 주십시오.");
			f.office_tell.focus();
			return false;
		}
		if(f.office_post.value==""){
			alert("사업장 주소를 입력하여 주십시오.");
			autoAddress('office_post','office_addr1','office_addr2','forderform');
			return false;
		}
*/
    return true;
}
// 구매자 정보와 동일합니다.
function gumae2baesong(f)
{
	if (f.same.checked==true) {
		f.od_b_name.value = f.od_name.value;
		f.od_b_tel.value  = f.od_tel.value;
		f.od_b_hp.value   = f.od_hp.value;
		f.od_b_zip.value = f.od_zip.value;
		f.od_b_addr1.value = f.od_addr1.value;
		f.od_b_addr2.value = f.od_addr2.value;
	}
	else {
		f.od_b_name.value = "";
		f.od_b_tel.value  = "";
		f.od_b_hp.value   = "";
		f.od_b_zip.value = "";
		f.od_b_addr1.value = "";
		f.od_b_addr2.value = "";
	}
}
if (typeof(forderform.od_name) != 'undefined')
    forderform.od_name.focus();
else
    forderform.od_b_name.focus();
</script>

