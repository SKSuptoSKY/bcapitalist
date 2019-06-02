<?
	include "../head.php";

 if ($mode == "U")
{

	$member_stipulation = addslashes($member_stipulation);
	$member_privacy = addslashes($member_privacy);

		$sql =" update {$GnTable[config]}
					set	title	= '$title',
							site_name = '$site_name',
							site_url	= '$site_url',
							keyword	= '$keyword',
							ssl_flag	= '$ssl_flag',
							ssl_port	= '$ssl_port_num',
							admin_email	= '$admin_email',
							email_flag	= '$email_flag',
							mail_check		= '$mail_check',
							member_stipulation	= '$member_stipulation',
							member_privacy	= '$member_privacy',
							use_point	= '$use_point',
							use_memo	= '$use_memo',
							join_point	= '$join_point',
							login_point	= '$login_point',
							memo_del	= '$memo_del',
							visit_time	= '$visit_time',
							page_rows	= '$page_rows',
							page_list	= '$page_list',
							bank_info	= '$bank_info',
							use_bank	= '$use_bank',
							use_iche	= '$use_iche',
							use_phone	= '$use_phone',
							use_ars	= '$use_ars',
							use_card	= '$use_card',
							use_phbil	= '$use_phbil',
							use_ebank	= '$use_ebank',
							use_paper	= '$use_paper',
							cardsys_mid	= '$cardsys_mid',
							cardsys_code	= '$cardsys_code',
							namesys_code	= '$namesys_code',
							mex1_title	= '$mex1_title',
							mex2_title	= '$mex2_title',
							mex3_title	= '$mex3_title',
							mex4_title	= '$mex4_title',
							mex5_title	= '$mex5_title',
							ex1_sub	= '$ex1_sub',
							ex2_sub	= '$ex2_sub',
							ex3_sub	= '$ex3_sub',
							ex4_sub	= '$ex4_sub',
							ex5_sub	= '$ex5_sub',
							ex6_sub	= '$ex6_sub',
							ex7_sub	= '$ex7_sub',
							ex8_sub	= '$ex8_sub',
							ex9_sub	= '$ex9_sub',
							ex10_sub	= '$ex10_sub',
							ex1	= '$ex1',
							ex2	= '$ex2',
							ex3	= '$ex3',
							ex4	= '$ex4',
							ex5	= '$ex5',
							ex6	= '$ex6',
							ex7	= '$ex7',
							ex8	= '$ex8',
							ex9	= '$ex9',
							ex10	= '$ex10',
							cafe24_user_id	= '$cafe24_user_id',
							cafe24_secure	= '$cafe24_secure',
							cafe24_sphone	= '$cafe24_sphone',
							cafe24_rphone	= '$cafe24_rphone',
							cafe24_testflag	= '$cafe24_testflag'
				";
		sql_query($sql);

		//글이 등록되어 List로 이동
		alert("수정되었습니다.","/admin/config/index.php");
}
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 사이트환경관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="20"><font color="red">* 관계자외 수정금지</font></td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name=F method=post action="/admin/config/index.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="U">
	<tr>
		<td valign="top">
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=120>
			<colgroup width="">
				<tr bgcolor="#FFFFFF">
					<td colspan="2" style="padding-left:10px">
						<b> * 환경설정</b>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">홈페이지 타이틀</td>
					<td>
						<input type="text"  name="title" value="<?=$default[title]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">홈페이지명</td>
					<td>
						<input type="text"  name="site_name" value="<?=$default[site_name]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">도메인</td>
					<td>
						<input type="text"  name="site_url" value="<?=$default[site_url]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">SSL사용여부</td>
					<td><input type="checkbox" name="ssl_flag" value="Y" <?=($default[ssl_flag] == "Y")?"checked":"";?>>사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">SSL 포트번호</td>
					<td><input type="text" name="ssl_port_num" value="<?=$default[ssl_port]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">키워드</td>
					<td>
						<input type="text"  name="keyword" value="<?=$default[keyword]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"><br><font color="red">* ' ; ' 로 구분하여 여러개 등록 가능</font>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">관리자메일</td>
					<td>
						<input type="text"  name="admin_email" value="<?=$default[admin_email]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">메일발송설정</td>
					<td><input type="radio" name="email_flag" value="오픈컴" <?=($default[email_flag] == "오픈컴" || !$default[email_flag])?"checked":"";?>>오픈컴 <input type="radio" name="email_flag" value="타호스팅" <?=($default[email_flag] == "타호스팅")?"checked":"";?>>타호스팅 
					</td>
				</tr>

				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">카페24 아이디</td>
					<td>
						<input type="text"  name="cafe24_user_id" value="<?=$default[cafe24_user_id]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">카페24 인증키</td>
					<td>
						<input type="text"  name="cafe24_secure" value="<?=$default[cafe24_secure]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">카페24 발신번호</td>
					<td>
						<input type="text"  name="cafe24_sphone" value="<?=$default[cafe24_sphone]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">카페24 수신번호</td>
					<td>
						<input type="text"  name="cafe24_rphone" value="<?=$default[cafe24_rphone]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">카페24 SMS 상태</td>
					<td>
						<input type="radio" name="cafe24_testflag" value="Y" <?if($default[cafe24_testflag] == "Y"){?>checked<?}?>> TEST
						<input type="radio" name="cafe24_testflag" value="" <?if($default[cafe24_testflag] != "Y"){?>checked<?}?>> SERVICE
					</td>
				</tr>

				<!--
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">회원스킨</td>
					<td>
						<select name="member_skin">
							<?=Get_skin("member",$default[member_skin])?>
						</select>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">회원메일인증</td>
					<td>
						<input type=checkbox name=mail_check value='1' <?=($default[mail_check] ? "checked" : "");?>> 사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">쪽지사용</td>
					<td>
						<input type=checkbox name=use_memo value='1' <?=($default[use_memo] ? "checked" : "");?>> 사용
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">적립금사용</td>
					<td>
						<input type=checkbox name=use_point value='1' <?=($default[use_point])? "checked" : "";?>> 사용
					</td>
				</tr>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">쪽지보관일</td>
					<td>
						<input type="text"  name="memo_del" value="<?=$default[memo_del]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				-->
				<? if ($sitemenu["mn_shop_use"]) { ?>
				<!--
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">회원가입 적립금</td>
					<td>
						<input type="text"  name="join_point" value="<?=$default[join_point]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">로그인시 적립금</td>
					<td>
						<input type="text"  name="login_point" value="<?=$default[login_point]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				-->
				<? } ?>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">로그인 체크 시간</td>
					<td>
						<input type="text"  name="visit_time" value="<?=$default[visit_time]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">페이지당 목록수</td>
					<td>
						<input type="text"  name="page_rows" value="<?=$default[page_rows]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">페이지당 페이지수</td>
					<td>
						<input type="text"  name="page_list" value="<?=$default[page_list]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<!--
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">은행계좌정보</td>
					<td>
						<textarea name="bank_info" rows="3" style="width:100%;" class=text><?=$default[bank_info]?></textarea>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">결제방법</td>
					<td>
						<table cellpadding=0 cellspacing=0 border=0>
							<tr>
								<td>무통장입금 <input type=checkbox name=use_bank value='1' <?=($default[use_bank] ? "checked" : "");?>></td>
								<td rowspan=2 width=10></td>
								<td>계 좌 이 체 <input type=checkbox name=use_iche value='1' <?=($default[use_iche] ? "checked" : "");?>></td>
								<td rowspan=2 width=10></td>
								<td>핸드폰결제 <input type=checkbox name=use_phone value='1' <?=($default[use_phone] ? "checked" : "");?>></td>
								<td rowspan=2 width=10></td>
								<td>가 상 계 좌 <input type=checkbox name=use_ebank value='1' <?=($default[use_ebank] ? "checked" : "");?>></td>
							</tr>
							<tr>
								<td>A R S 결제 <input type=checkbox name=use_ars value='1' <?=($default[use_ars] ? "checked" : "");?>></td>
								<td>카 드 결 제 <input type=checkbox name=use_card value='1' <?=($default[use_card] ? "checked" : "");?>></td>
								<td>폰 빌 결 제 <input type=checkbox name=use_phbil value='1' <?=($default[use_phbil] ? "checked" : "");?>></td>
								<td>상품권결제 <input type=checkbox name=use_paper value='1' <?=($default[use_paper] ? "checked" : "");?>></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">결제사코드 1</td>
					<td>
						<input type="text"  name="cardsys_mid" value="<?=$default[cardsys_mid]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">결제사코드 2</td>
					<td>
						<input type="text"  name="cardsys_code" value="<?=$default[cardsys_code]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				-->
<!-- 				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">실명확인코드명</td>
					<td>
						<input type="text"  name="namesys_code" value="<?=$default[namesys_code]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr> -->
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">회원가입약관</td>
					<td>
						<textarea name="member_stipulation" rows="17" style="width:100%; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"><?=get_text(stripslashes($default[member_stipulation]));?></textarea>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#F0F0F0" style="padding-left:10px">개인정보취급방침</td>
					<td>
						<textarea name="member_privacy" rows="17" style="width:100%; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"><?=get_text(stripslashes($default[member_privacy]));?></textarea>
					</td>
				</tr>
			</table>
		</td>
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
function fitemformcheck(form)
{
    alert("수정하시겠습니까?");
    return true;
}
</script>