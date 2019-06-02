<?
	include "../head.php";
?>
<?
$PG_table = $GnTable["member"];
$JO_table = $GnTable["memberlevel"];

if($mode=="E") {
	$title_page = "회원정보 수정";

	$sql = " select * from $PG_table where mem_id = '$id' ";
	$view = sql_fetch($sql);

	$mem_photo = Get_photo($G_member["data_url"]."/".$view["mem_id"],"myphoto",100,125);
} else if($mode=="W") {
	$title_page = "회원정보 등록";

}

$qstr = "findType=".urlencode($findType)."&findword=".urlencode($findword)."&sort1=$sort1&sort2=$sort2";
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function fitemformcheck(form) {
	<? if($mode=="W") { ?>
		if(!form.mem_name.value) {
			alert('성함을 입력하세요');
			return false;
		}
	<? } ?>
	if(form.newpass.value != ""){
		if(strLen(form.newpass,5,10,"비밀번호를 ") == false) {
			form.newpass.value='';
			return false;
		}
	}
	return true;
}

function PhotoView(form)
{
	if (form.photo.value) {
		form.myphoto.src = form.photo.value;
	}
}
//-->  
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"><?=$title_page?></font></strong>
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
<form name=F method=post action="./member_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="type"  value="<?=$type?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="page"  value="<?=$page?>">
	<tr>
		<td valign="top">
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">아이디</td>
					<td>
			<? if($mode=="E") { ?>
						<?=$view[mem_id]?><input type=hidden name="id"  value="<?=$id?>">
			<? } else if($mode=="W") { ?>
						<input type="text"  name="id" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
			<? } ?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">이름</td>
					<td>
			<? if($mode=="E") { ?>
						<?=$view[mem_name]?>
			<? } else if($mode=="W") { ?>
						<input type="text"  name="mem_name" value="<?=$view[mem_name]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
			<? } ?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">닉네임</td>
					<td>
						<input type="text"  name="mem_nick" value="<?=$view[mem_nick]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">비밀번호</td>
					<td>
						<input type="text" name="newpass" style="width:30%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" maxlength="15">
						<font color="red">* 변경할 경우에만 입력하세요</font> [영문/숫자 5자 이상 ~ 15자 이하입니다]
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">주소</td>
					<td>
						<input type="text"  name="mem_post" id="mem_post" value="<?=$view[mem_post]?>" style="width:100px; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" readonly> 
						<!-- 기존 코딩 <img src="/btn/btn_address.gif" border="0" style="cursor:hand" onclick="autoAddress('mem_post','mem_add1','mem_add2','F')" align="absmiddle"> -->
						<!-- <img src="/btn/btn_address.gif" border="0" style="cursor:hand" onclick="win_zip('F', 'mem_post', 'mem_add1', 'mem_add2');" align="absmiddle"> -->
						<!-- new post -->
						<a href="#asd" onclick="openDaumPostcode('mem_post','mem_add1','mem_add2');"><!-- ID 적용 -->
						<img src="/btn/btn_address.gif" border="0" style="cursor:pointer" align="absmiddle">
						</a>
						<!-- new post -->
						<input type="text"  name="mem_add1" id="mem_add1" value="<?=$view[mem_add1]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" readonly>
						<input type="text"  name="mem_add2" id="mem_add2" value="<?=$view[mem_add2]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">전화번호</td>
					<td>
						<input type="text"  name="mem_tel" value="<?=$view[mem_tel]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">핸드폰번호</td>
					<td>
						<input type="text"  name="mem_phone" value="<?=$view[mem_phone]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">팩스번호</td>
					<td>
						<input type="text"  name="mem_fax" value="<?=$view[mem_fax]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">이메일</td>
					<td>
						<input type="text"  name="mem_email" value="<?=$view[mem_email]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">홈페이지</td>
					<td>
						<input type="text"  name="mem_home" value="<?=$view[mem_home]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">생년월일</td>
					<td>
						<?=date_select($view[mem_birth], "mem_birth", 0, 100,"0000"); // 오늘을 기준으로 100년 전부터 옵션값을 출력합니다.?>
						( <input type="radio" name="mem_btype" value="+" <?if($view[mem_btype]=="+"){?>checked<?}?>>양력 
						<input type="radio" name="mem_btype" value="-" <?if($view[mem_btype]=="-"){?>checked<?}?>>음력 )
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">성별</td>
					<td>
						<input type="radio" name="mem_sex" value="m" <?if($view[mem_sex]=="m"){?>checked<?}?>>남 
						<input type="radio" name="mem_sex" value="w" <?if($view[mem_sex]=="w"){?>checked<?}?>>여
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">정보메일</td>
					<td>
						<input type="checkbox" name="mem_remail" value="y" <?if($view[mem_remail]=="y"){?>checked<?}?> align="absmiddle"> 수신
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">SMS</td>
					<td>
						<input type="checkbox" name="mem_sms" value="y" <?if($view[mem_sms]=="y"){?>checked<?}?> align="absmiddle"> 수신
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">관리자 메모</td>
					<td>
						<textarea name="mem_content" rows="5" style="width:100%; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"><?=$view[mem_content]?></textarea>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top" width="40%">
			<?/*?>
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">회원파일</td>
					<td align="center">
						<table width="7" border="0" cellpadding="1" cellspacing="1" bgcolor="CCCCCC">
							<tr>
								<td width="10" bgcolor="#FFFFFF"><?=$mem_photo?></td>
							</tr>
						</table>
						(적정해상도 100*125)<br>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">회원파일업로드</td>
					<td>
						<input type="file" name="photo"  style="width:90%;" onFocus="PhotoView(this.form);">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">사업자번호</td>
					<td>
						<input type="text"  name="com_num" value="<?=$view[com_num]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">대표자</td>
					<td>
						<input type="text"  name="com_ceo" value="<?=$view[com_ceo]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">담당자</td>
					<td>
						<input type="text"  name="com_charge" value="<?=$view[com_charge]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">담당자전화번호</td>
					<td>
						<input type="text"  name="com_cphone" value="<?=$view[com_cphone]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">회사주소</td>
					<td>
						<input type="text"  name="com_post" id="com_post" value="<?=$view[com_post]?>" style="width:100px; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" readonly> 
						<!-- 기존 우편번호 소스 <img src="/btn/btn_address.gif" border="0" style="cursor:hand" onclick="autoAddress('com_post','com_add1','com_add2','F')" align="absmiddle"> -->
						<!-- <img src="/btn/btn_address.gif" border="0" style="cursor:hand" onclick="win_zip('F', 'com_post', 'com_add1', 'com_add2');" align="absmiddle"> -->
						<!-- new post -->
						<a href="#asd" onclick="openDaumPostcode('com_post','com_add1','com_add2');"><!-- ID 적용 -->
						<img src="/btn/btn_address.gif" border="0" style="cursor:pointer" align="absmiddle">
						</a>
						<!-- new post -->
						<input type="text"  name="com_add1" id="com_add1" value="<?=$view[com_add1]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" readonly>
						<input type="text"  name="com_add2" id="com_add2" value="<?=$view[com_add2]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
			</table>
			<table><tr><td height=10></td></tr></table>
			<?*/?>
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">회원등급</td>
					<td>
						<input type=hidden name=oldlev value=<?=$view[mem_leb]?>>
						<select  name=mem_leb>
							<?=Get_level($view[mem_leb]);?>
						</select>
					</td>
				</tr>
				<? if ($sitemenu["mn_shop_use"]) { ?>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">적립금</td>
					<td>
						<?=number_format($view[mem_point])?>
					</td>
				</tr>
				<? } ?>
			<? for ($i=1; $i<=5; $i++) { ?>
				<? if($default["mex{$i}_title"]==TRUE) {?>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;padding-right:10px"><?=$default["mex{$i}_title"]?></td>
					<td>
						<input type="text"  name="exe_<?=$i?>" value="<?=$view["exe_{$i}"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<? } ?>
			<? } ?>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">가입인증</td>
					<td>
						<?if(is_null_time($view[mem_check])==FALSE) echo $view[mem_check]?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">가입일자</td>
					<td>
						<?=$view[first_regist]?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">가입IP</td>
					<td>
						<?=$view[join_ip]?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">최근정보수정일</td>
					<td>
						<?if(is_null_time($view[last_modify])==FALSE) echo $view[last_modify]?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">최근접속일</td>
					<td>
						<?if(is_null_time($view[last_regist])==FALSE) echo $view[last_regist]?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">최근접속IP</td>
					<td>
						<?=$view[login_ip]?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">접속횟수</td>
					<td>
						<?=number_format($view[visited])?>
					</td>
				</tr>
				<?/*?>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">추천인</td>
					<td>
						<input type="text"  name="mem_chu" value="<?=$view[mem_chu]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<?*/?>
			</table>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_modify.gif" border=0>
			<a href="./member_list.php?<?=$qstr?>&page=<?=$page?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>