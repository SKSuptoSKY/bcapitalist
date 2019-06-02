<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopconfig"];
$JO_table = "";

if ($mode == "U") {

	$input = "
					shop_name		= '$shop_name',
					shop_url		= '$shop_url',
					shop_skin		= '$shop_skin',
					mimg_width		= '$mimg_width',
					mimg_height		= '$mimg_height',
					simg_width		= '$simg_width',
					simg_height		= '$simg_height',
					admin_email		= '$admin_email',
					use_bank		= '$use_bank',
					use_real		= '$use_real',
					use_card		= '$use_card',";
	if ($sitemenu["use_type"]) {
		$input .= "		use_type1		= '$use_type1',
						use_type2		= '$use_type2',
						use_type3		= '$use_type3',
						use_type4		= '$use_type4',
						use_type5		= '$use_type5',";
	}
		$input .= "		sms_text1		= '$sms_text1',				
						sms_text2		= '$sms_text2',				
						sms_text3		= '$sms_text3',				
						sms_text4		= '$sms_text4',				
						sms_text5		= '$sms_text5',				
						sms_text6		= '$sms_text6',				
						sms_text7		= '$sms_text7',";
	if ($sitemenu["point_use"]) {					
		$input .= "	point_chk		= '$point_chk',
						point_use		= '$point_use',
						point_max_use		= '$point_max_use',
						point_min_use		= '$point_min_use',
						";
	}
		$input .= "		use_bill		= '$use_bill',
						use_vat			= '$use_vat',
						use_phon		= '$use_phon',
						bankinfo		= '$bankinfo',
						cardsys_mid		= '$cardsys_mid',";
	if ($sitemenu["trans_pay"]) {					
		$input .= "		trans_all		= '$trans_all',
						trans_pay		= '$trans_pay',";
	}
		$input .= "		present_pay		= '$present_pay',
						present_item	= '$present_item'
					";


	if($GnShop["site"]=="") {
		$sql =" insert $PG_table set
					$input ,
					site = '{$default[site_code]}'
				";
	} else {
		$sql =" update $PG_table set
					$input
					where site = '{$default[site_code]}'
				";
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
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF">
					<td colspan="2" style="padding-left:10px">
						<b> * 환경설정</b>
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
				<!--	
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">쇼핑몰스킨</td>
					<td>
						<select name="shop_skin">
							<?=Get_skin("shop",$GnShop[shop_skin])?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">결제방법</td>
					<td>
						<table cellpadding=0 cellspacing=0 border=0>
							<tr>
								<td>무통장입금 <input type=checkbox name=use_bank value='1' <?=($GnShop[use_bank] ? "checked" : "");?>></td>
								<td width="10"></td>
								<td>계 좌 이 체 <input type=checkbox name=use_real value='1' <?=($GnShop[use_real] ? "checked" : "");?>></td>
							</tr>
							<tr>
								<td>카 드 결 제 <input type=checkbox name=use_card value='1' <?=($GnShop[use_card] ? "checked" : "");?>></td>
								<td width="10"></td>
							
							</tr>
						</table>
					</td>
				</tr>
				-->
				<? if ($sitemenu["use_type"]) { ?>			   
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">상품타입사용</td>
					<td>
						<input type="checkbox" name="use_type1" value="1" <?=($GnShop[use_type1] ? "checked" : "");?>> 메인추출상품&nbsp;
						<input type="checkbox" name="use_type2" value="1" <?=($GnShop[use_type2] ? "checked" : "");?>> 신상품&nbsp;
						<input type="checkbox" name="use_type3" value="1" <?=($GnShop[use_type3] ? "checked" : "");?>> 베스트상품&nbsp;
						<input type="checkbox" name="use_type4" value="1" <?=($GnShop[use_type4] ? "checked" : "");?>> 히트상품&nbsp;
						<input type="checkbox" name="use_type5" value="1" <?=($GnShop[use_type5] ? "checked" : "");?>> 사은품제공상품
					</td>
				</tr>
				<? } ?>
				<? if ($sitemenu["point_use"]) { ?>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">포인트사용</td>
					<td>
						<input type=checkbox name=point_chk value='1' <?=($GnShop[point_chk] ? "checked" : "");?>> 사용
                        <div align="left">
                        적립포인트: <input type="text" name="point_use" style="width:80px;text-align:right;" value="<?=$GnShop[point_use]?>"> %
                        <font color="#FF0000">상품구입시 상품가격의 입력된 %만큼 적립됩니다.</font><br>
                        최대사용포인트: <input type="text" name="point_max_use" style="width:80px;text-align:right;" value="<?=$GnShop[point_max_use]?>"> %
                        <font color="#FF0000">상품구입시 상품가격의 입력된 %만큼 적립금이 사용가능합니다.</font><br>
						최소사용포인트: <input type="text" name="point_min_use" style="width:80px;text-align:right;" value="<?=$GnShop[point_min_use]?>"> Point
						<font color="#FF0000">상품구입시 사용가능한 최소 적립금입니다.</font><br>
                        </div>
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
					<td bgcolor="#F0F0F0" style="padding-left:10px">중간이미지<br>(뷰이미지)</td>
					<td>
						가로 <input type=text name="mimg_width" value="<?=($GnShop[mimg_width]>0)?$GnShop[mimg_width]:'400';?>" size=4 class="text"> *
						세로 <input type=text name="mimg_height" value="<?=($GnShop[mimg_height]>0)?$GnShop[mimg_height]:'300';?>" size=4 class="text">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">작은이미지<br>(리스트)</td>
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
				<!--
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">등급별 배송비</td>
					<td>
						<table cellpadding=0 cellspacing=0 border=0 align=center>
							<tr>
								<td align=center>
									<br>
									<select size=6 style='width:100px; background-color:#F6F6F6;' ondblclick="transgrub_add(this);">
										<?=Get_level("","SELECT")?>
									</select>
									<br>
									<FONT COLOR="#0E87F9">더블클릭하면 추가</FONT>
								</td>
								<td width=20 align=center>→</td>
								<td align=center>
									배송비 그룹<br>
									<select name=transgrub size=6 style='width:100px;' ondblclick="transgrub_del(this);">
										<?
											$str = "";
											$comma = "";
											$trans_grub = explode(",",$GnShop[trans_grub]);

											for ($i=0; $trans_grub[$i]!=NULL; $i++)
											{
												echo Get_level($trans_grub[$i],"SELECT","where leb_level = '$trans_grub[$i]'");
												$str .= $comma . $trans_grub[$i];
												$comma = ",";
											}
										?>
									</select>
									<br>
									<FONT COLOR="#FF6600">더블클릭하면 삭제</FONT>
									<input type='hidden' name='trans_grub' value='<?=$str?>'>
								</td>
								<td width=30 align=center>〓</td>
								<td valign=top align=center>
									배송비 상한가<br>
									<textarea name=trans_gpay rows=6 cols=12 class=ed><?=$GnShop[trans_gpay]?></textarea>
									<br>
									<FONT COLOR="#FF6600">Enter 키로 구분</FONT>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">금액별 사은품</td>
					<td>
						<table cellpadding=0 cellspacing=0 border=0 align=center>
							<tr>
								<td align=center>
									<br>
									<select size=6 style='width:100px; background-color:#F6F6F6;' ondblclick="Ppay_add(this);">
										<?=Get_level("","SELECT")?>
									</select>
									<br>
									<FONT COLOR="#0E87F9">더블클릭하면 추가</FONT>
								</td>
								<td width=20 align=center>→</td>
								<td align=center>
									<b><font color=red>적용회원</font></b><br>
									<select name=relationselect_P size=6 style='width:100px;' ondblclick="Ppay_del(this);">
										<?
											$str = "";
											$comma = "";

											$present_pay = explode(",",$GnShop[present_pay]);

											for ($i=0; $present_pay[$i]!=NULL; $i++)
											{
												echo Get_level($trans_grub[$i],"SELECT","where leb_level = '$present_pay[$i]'");
											$str .= $comma . $present_pay[$i];
											$comma = ",";
											}
										?>
									</select>
									<br>
									<FONT COLOR="#FF6600">더블클릭하면 삭제</FONT>
									<input type='hidden' name='present_pay' value='<?=$str?>'>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				-->
			</table>
		</td>
				<!--
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">상품별 사은품</td>
					<td>
						<table cellpadding=0 cellspacing=0 border=0 align=center>
							<tr>
								<td align=center>
									<br>
									<select size=6 style='width:100px; background-color:#F6F6F6;' ondblclick="Pitem_add(this);">
										<?=Get_level("","SELECT")?>
									</select>
									<br>
									<FONT COLOR="#0E87F9">더블클릭하면 추가</FONT>
								</td>
								<td width=20 align=center>→</td>
								<td align=center>
									<b><font color=red>적용회원</font></b><br>
									<select name=relationselect_I size=6 style='width:100px;' ondblclick="Pitem_del(this);">
										<?
											$str = "";
											$comma = "";

											$present_item = explode(",",$GnShop[present_item]);

											for ($i=0; $present_item[$i]!=NULL; $i++)
											{
												echo Get_level($trans_grub[$i],"SELECT","where leb_level = '$present_item[$i]'");
												$str .= $comma . $present_item[$i];
												$comma = ",";
											}
										?>
									</select>
									<br>
									<FONT COLOR="#FF6600">더블클릭하면 삭제</FONT>
									<input type='hidden' name='present_item' value='<?=$str?>'>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				-->
	</tr>
</table>

<table width=100%>
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_modify.gif" border=0>
		</td>
	</tr>
</table>
</form>

<script language='javascript'>
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
</script>
						<SCRIPT LANGUAGE="JavaScript">
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
