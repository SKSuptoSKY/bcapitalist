<!-- ################## [ 무통장 결제 스킨 - START ] ################## -->
<!-- ------------------------------------------------------------- [ 장바구니 - START ] ------------------------------------------------------------- -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:10px;">
	<tr>
		<td height="15" align=""><span class="style1">장바구니</span></td>
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
.shop_boardtb th{text-align:left; text-indent:10px; }
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mt20">
	<tr>
		<td align="left">
			<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<!-- 테이블의 시작 -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="30"><span class="style1">주문자 정보 </span></td>
							</tr>
							<tr>
								<td height="8"> </td>
							</tr>
							<tr>
								<td>
								<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardtb">
										<col width="150" />
										<col width="" />
										<tr>
											<th  height="25" style="padding-left:5px;">주문하시는분</th>
											<td  style="padding-left:5px;"> <?=$od_name?></td>
										</tr>

										<tr>
											<th  height="25" style="padding-left:5px;">전화번호</th>
											<td  style="padding-left:5px;"> <?=$od_tel?></td>
										</tr>

										<tr>
											<th  height="25" style="padding-left:5px;">휴대전화</th>
											<td  style="padding-left:5px;"> <?=$od_hp?></td>
										</tr>

										<tr>
											<th  height="25" style="padding-left:5px;">이메일</th>
											<td  style="padding-left:5px;"> <?=$od_email?></td>
										</tr>

										<tr>
											<th  height="25" style="padding-left:5px;">주소</td>
											<td  style="padding-left:5px;"> <? echo sprintf("(%s) %s %s", $od_zip, $od_addr1, $od_addr2); ?></td>
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
								<td height="30"><span class="style1">배송지 정보 </span></td>
							</tr>
							<tr>
								<td height="8"> </td>
							</tr>
							<tr>
								<td>
									<!-- 테이블의 시작 -->
									<table width="100%" class="shop_boardtb" border="0" cellspacing="0" cellpadding="0">
										<col width="150">
										<col width="">

										<tr>
											<th  height="25" style="padding-left:5px;">받으시는분</th>
											<td  style="padding-left:5px;"> <?=$od_b_name?></td>
										</tr>
										<tr>
											<th  height="25" style="padding-left:5px;">전화번호</th>
											<td  style="padding-left:5px;"> <?=$od_b_tel?></td>
										</tr>
										<tr>
											<th  height="25" style="padding-left:5px;">휴대전화</th>
											<td  style="padding-left:5px;"> <?=$od_b_hp?></td>
										</tr>
										<tr>
											<th  height="25" style="padding-left:5px;">주소</th>
											<td  style="padding-left:5px;"> <? echo sprintf("(%s) %s %s", $od_b_zip, $od_b_addr1, $od_b_addr2); ?></td>
										</tr>
										<tr>
											<th  height="25" style="padding-left:5px;">요청사항</th>
											<td  style="padding-left:5px;"> <? echo nl2br(htmlspecialchars2(stripslashes($od_memo))); ?></td>
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
		</td>
	</tr>
</table>



<!-- ------------------------------------------------------------- [ 기존 결제정보 - START ] ------------------------------------------------------------- -->
<?
if ($od_settle_case == "무통장") { $gubun = "SC0040"; ?>
<form name=frmorderreceipt method=post action='./order_update.php' >
<input type=hidden name=od_amount    value='<?=$od_amount?>'>
<input type=hidden name=od_send_cost value='<?=$od_send_cost ?>'>
<input type=hidden name=od_name      value='<?=$od_name?>'>
<input type=hidden name=od_pwd       value='<?=$od_pwd?>'>
<input type=hidden name=od_tel       value='<?=$od_tel?>'>
<input type=hidden name=od_hp        value='<?=$od_hp?>'>
<input type=hidden name=od_zip      value='<?=$od_zip?>'>
<input type=hidden name=od_zip1      value='<?=$od_zip1?>'>
<input type=hidden name=od_zip2      value='<?=$od_zip2?>'>
<input type=hidden name=od_addr1     value='<?=$od_addr1?>'>
<input type=hidden name=od_addr2     value='<?=$od_addr2?>'>
<input type=hidden name=od_email     value='<?=$od_email?>'>
<input type=hidden name=od_b_name    value='<?=$od_b_name?>'>
<input type=hidden name=od_b_tel     value='<?=$od_b_tel?>'>
<input type=hidden name=od_b_hp      value='<?=$od_b_hp?>'>
<input type=hidden name=od_b_zip    value='<?=$od_b_zip?>'>
<input type=hidden name=od_b_zip1    value='<?=$od_b_zip1?>'>
<input type=hidden name=od_b_zip2    value='<?=$od_b_zip2?>'>
<input type=hidden name=od_b_addr1   value='<?=$od_b_addr1?>'>
<input type=hidden name=od_b_addr2   value='<?=$od_b_addr2?>'>
<input type=hidden name=od_hope_date value='<?=$od_hope_date?>'>
<input type=hidden name=od_memo      value='<?=htmlspecialchars2(stripslashes($od_memo))?>'>
<input type=hidden name=s_on_uid value='<?=$s_on_uid?>'>
<input type=hidden name=mem_id value='<?=$_SESSION[userid]?>'>
<input type=hidden name=od_settle_case value='<?=$od_settle_case?>'>
<input type=hidden name="od_receipt_point" value='<?=$od_receipt_point?>'>
<input type=hidden name="od_settle_amount" value='<?=$f_tot_amount ?>'>
<? } ?>

<!-- 테이블의 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mt20">
	<tr>
		<td>
			<!-- 테이블의 시작 -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="30" > <span class="style1">결제정보 </span></td>
				</tr>
				<tr>
					<td height="8"> </td>
				</tr>
				<tr>
					<td>
						<!-- 테이블의 시작 -->
						<table width="100%" class="shop_boardtb" border="0" cellspacing="0" cellpadding="0">
							<col width="150" />
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
									<th height=25 bgcolor='#F9F9F9' style='padding-left:5px;'>적립금사용</th>
									<td style='padding-left:5px;'>
										<?=number_format($od_receipt_point)?> Point
									</td>
								</tr>
								<?
							}
							?>

							<?
							if ($od_settle_case == "무통장") {
							// 은행계좌를 배열로 만든후
							$str = explode("\n", $default[bankinfo]);
							$bank_account = "\n<select name=od_bank_account>\n";
							$bank_account .= "<option value=''>--------------- 선택하십시오 ---------------\n";
							$bank_account .= Shop_BankList();
							$bank_account .= "</select> ";
							echo "<tr>";
							echo "<th height=25 style='padding-left:5px;'>무통장입금액</th>";
							echo "<td style='padding-left:5px;'><input type=text name=od_receipt_bank value='$receipt_amount' size='$f_tot_amount_len' style='text-align:right; border-style:none; background-color:#F9F9F9;' class=point readonly>원</td>";
							echo "</tr><tr>";
							echo "<th height=25 style='padding-left:5px;'>계좌번호</td><td style='padding-left:5px;'>$bank_account</td>";
							echo "</tr><tr>";
							echo "<th height=25 style='padding-left:5px;'>입금자 이름</td>";
							echo "<td style='padding-left:5px;'><input type=text name=od_deposit_name class=edit size=10 maxlength=20 value='$od_name'> (주문하시는분과 입금자가 다를 경우)</td>";
							echo "</tr>\n";
							$receipt_amount = 0;
							}
							?>


							<? if($radiobutton!="필요없음"){?>
							<input type='hidden' name='radiobutton' value="<?=$radiobutton?>">
							<tr style="border:dashed 1px #cccccc;display:none;">
								<td colspan="2">
									<!-- 테이블의 시작 -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="15%" height="25" style="padding-left:5px;">회사명</td>
											<td width="35%" style="padding-left:5px;"><input name="office_name" type="text" style="width:100px;" value="<?=$office_name?>" maxlength="20"></td>
											<td width="15%" style="padding-left:5px;">업태/종류</td>
											<td width="35%" style="padding-left:5px;"><input name="office_kind" type="text" style="width:100px;" value="<?=$office_kind?>" maxlength="20"></td>
										</tr>

										<tr>
											<td  height="25" style="padding-left:5px;">대표자성명</td>
											<td style="padding-left:5px;"> <input name="office_ceo" type="text" style="width:100px;" value="<?=$office_ceo?>" maxlength="20"></td>
											<td style="padding-left:5px;">사업자등록번호</td>
											<td style="padding-left:5px;">
												<input name="office_num1" value="<?=$office_num1?>" type="text" style="width:50px;" maxlength="3"> -
												<input name="office_num2" value="<?=$office_num2?>" type="text"  style="width:30px;" maxlength="2"> -
												<input name="office_num3" value="<?=$office_num3?>" type="text" style="width:70px;" maxlength="5">
											</td>
										</tr>

										<tr>
											<td  height="25" style="padding-left:5px;">품목</td>
											<td style="padding-left:5px;"> <input name="office_make" type="text" style="width:100px;" value="<?=$office_make?>" maxlength="20"></td>
											<td style="padding-left:5px;">회사전화</td>
											<td style="padding-left:5px;"><input name="office_tell" type="text" style="width:100px;" value="<?=$office_tell?>" maxlength="20"></td>
										</tr>

										<tr>
											<td  height="25" style="padding-left:5px;">홈페이지 URL</td>
											<td colspan="3" style="padding-left:5px;"> <input name="office_hompageurl" type="text" value="<?=$office_hompageurl?>"  style="width:300px;"></td>
										</tr>

										<tr>
											<td  height="80" rowspan="2" style="padding-left:5px;">사업장 주소</td>
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
	<? if ($od_settle_case=="무통장") { ?>
	<tr>
		<td align="center"><a href="javascript:frmorderreceipt_check(document.frmorderreceipt);"><div  style="width:80px; height:28px; background:#be0000; color:#ffffff; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block; font-size:13px; ">결제하기</div></a></td>
	</tr>
	<? } ?>
</table>
<!-- 테이블의 끝 -->

</form>
<!-- 폼의 끝 -->


<? if ($od_settle_case == "무통장") { ?>
<script type='text/javascript'>

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

</script>
<?			}?>
