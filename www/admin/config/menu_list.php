<?
include "../head.php";
$PG_table = $GnTable["menu"];

//DB불러옴
$sql="select * from $PG_table";
$row=sql_fetch($sql);

// 구분자로 저장된 상품 옵션 체크내역을 배열로 저장 
$option_type_arr = @explode("|",$row["mn_shop_option_type"]);
?>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 사이트메뉴관리</font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form name="F" method="post" action="./menu_update.php" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">

<!-- ------------------------------------------------------------- [ default - Start ] ------------------------------------------------------------- -->
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:0 auto;">
	<tr>
		<td width="55%" valign="top">
			<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#F0F0F0" align="center"> 
					<td width="25%">기본</td>
					<td>메모</td>
					<td width="20%">사용여부</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>통계관리</td>
					<td><input type="text" name="mn_counter_memo" value="<?=$row["mn_counter_memo"]?>" size="51"></td>
					<td>
						<input type="radio" name="mn_counter_use" value="1" <? if ($row["mn_counter_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_counter_use" value="0" <? if (!$row["mn_counter_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>배너관리</td>
					<td><input type="text" name="mn_banner_memo" value="<?=$row["mn_banner_memo"]?>" size="51"></td>
					<td>
						<input type="radio" name="mn_banner_use" value="1" <? if ($row["mn_banner_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_banner_use" value="0" <? if (!$row["mn_banner_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>

				<tr bgcolor="#FFFFFF" align="center"> 
					<td>팝업관리</td>
					<td><input type="text" name="mn_popup_memo" value="<?=$row["mn_popup_memo"]?>" size="51"></td>
					<td>
						<input type="radio" name="mn_popup_use" value="1" <? if ($row["mn_popup_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_popup_use" value="0" <? if (!$row["mn_popup_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>

				<tr bgcolor="#FFFFFF" align="center"> 
					<td>설문조사관리</td>
					<td><input type="text" name="mn_poll_memo" value="<?=$row["mn_poll_memo"]?>" size="51"></td>
					<td>
						<input type="radio" name="mn_poll_use" value="1" <? if ($row["mn_poll_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_poll_use" value="0" <? if (!$row["mn_poll_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>

				<tr bgcolor="#FFFFFF" align="center"> 
					<td>회원 그룹메일 관리</td>
					<td></td>
					<td>
						<input type="radio" name="mn_group_mail_use" value="1" <? if ($row["mn_group_mail_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_group_mail_use" value="0" <? if (!$row["mn_group_mail_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>중복로그인</td>
					<td>&nbsp</td>
					<td>
						<input type="radio" name="duplicate_login" value="1" <? if ($row["duplicate_login"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="duplicate_login" value="0" <? if (!$row["duplicate_login"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
			</table>
		</td>		
	</tr>
</table>
<!-- ------------------------------------------------------------- [ default - End ] ------------------------------------------------------------- -->


<!-- ------------------------------------------------------------- [ product - Start ] ------------------------------------------------------------- -->
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:0 auto; padding-top:20px;">
	<tr>
		<td width="55%" valign="top">
			<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#F0F0F0" align="center"> 
					<td width="25%">제품관리</td>
					<td>메모</td>
					<td width="20%">사용여부</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>제품관리</td>
					<td><input type="text" name="mn_product_memo" value="<?=$row["mn_product_memo"]?>" size="51"></td>
					<td>
						<input type="radio" name="mn_product_use" value="1" <? if ($row["mn_product_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_product_use" value="0" <? if (!$row["mn_product_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
			</table>
		</td>		
	</tr>
</table>
<!-- ------------------------------------------------------------- [ product - End ] ------------------------------------------------------------- -->


<!-- ------------------------------------------------------------- [ shop - Start ] ------------------------------------------------------------- -->
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:0 auto; padding-top:20px;">
	<tr>
		<td width="55%" valign="top">
			<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#F0F0F0" align="center"> 
					<td width="25%">쇼핑몰</td>
					<td>메모</td>
					<td width="20%">사용여부</td>
				</tr>

				<tr bgcolor="#FFFFFF" align="center"> 
					<td>쇼핑몰관리</td>
					<td><input type="text" name="mn_shop_memo" value="<?=$row["mn_shop_memo"]?>" size="51"></td>
					<td>
						<input type="radio" name="mn_shop_use" value="1" <? if ($row["mn_shop_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_shop_use" value="0" <? if (!$row["mn_shop_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>결제모듈관리설정</td>
					<td> - 제작중 - </td>
					<td>
						<input type="radio" name="mn_shopmodule_use" value="1" <? if ($row["mn_shopmodule_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_shopmodule_use" value="0" <? if (!$row["mn_shopmodule_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>상품옵션사용</td>
					<td>
						<input type="checkbox" value="1" name="mn_shop_option_type_1" style="vertical-align:middle;" <? if ($option_type_arr["0"]) {?>checked<? } ?>>단일옵션사용&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" value="1" name="mn_shop_option_type_2" style="vertical-align:middle;" <? if ($option_type_arr["1"]) {?>checked<? } ?>>다중옵션사용&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" value="1" name="mn_shop_option_type_3" style="vertical-align:middle;" <? if ($option_type_arr["2"]) {?>checked<? } ?>>다중원가포함옵션사용
					</td>
					<td>
						<input type="radio" name="mn_shop_option_use" value="1" <? if ($row["mn_shop_option_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_shop_option_use" value="0" <? if (!$row["mn_shop_option_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>관련상품</td>
					<td> - 제작중 - </td>
					<td>
						<input type="radio" name="mn_shop_related_use" value="1" <? if ($row["mn_shop_related_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_shop_related_use" value="0" <? if (!$row["mn_shop_related_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>매출통계</td>
					<td><!-- <input type="text" name="mn_statistics_memo" value="<?=$row["mn_statistics_memo"]?>" size="51"> --></td>
					<td>
						<input type="radio" name="mn_statistics_use" value="1" <? if ($row["mn_statistics_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_statistics_use" value="0" <? if (!$row["mn_statistics_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>상품후기</td>
					<td><!-- <input type="text" name="mn_shop_review_memo" value="<?=$row["mn_shop_review_memo"]?>" size="51"> --></td>
					<td>
						<input type="radio" name="mn_shop_review_use" value="1" <? if ($row["mn_shop_review_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_shop_review_use" value="0" <? if (!$row["mn_shop_review_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>상품Q&A</td>
					<td><!-- <input type="text" name="mn_shop_qna_memo" value="<?=$row["mn_shop_qna_memo"]?>" size="51"> --></td>
					<td>
						<input type="radio" name="mn_shop_qna_use" value="1" <? if ($row["mn_shop_qna_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="mn_shop_qna_use" value="0" <? if (!$row["mn_shop_qna_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>적립금관리</td>
					<td>&nbsp</td>
					<td>
						<input type="radio" name="point_use" value="1" <? if ($row["point_use"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="point_use" value="0" <? if (!$row["point_use"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>상품타입사용관리</td>
					<td>&nbsp</td>
					<td>
						<input type="radio" name="use_type" value="1" <? if ($row["use_type"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="use_type" value="0" <? if (!$row["use_type"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>배송비관리</td>
					<td>&nbsp</td>
					<td>
						<input type="radio" name="trans_pay" value="1" <? if ($row["trans_pay"]) {?>checked<? } ?>> 사용 &nbsp;
						<input type="radio" name="trans_pay" value="0" <? if (!$row["trans_pay"]) {?>checked<? } ?>> 미사용
					</td>
				</tr>
			</table>
		</td>		
	</tr>
</table>
<!-- ------------------------------------------------------------- [ shop - End ] ------------------------------------------------------------- -->

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" border=0>
		</td>
	</tr>
</table>
</form>