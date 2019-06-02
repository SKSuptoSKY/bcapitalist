<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
<script type="text/javascript" src="/skin/member/basic/member_ajax.js"></script>
<script type="text/javascript" src="/addr_zip/Uzipjs/UzipJs.js"></script>

<form name="member" method="POST" action="javascript:member_submit(document.member);" enctype="multipart/form-data" autocomplete="off">
<!------------------########## 주요히든필드 *수정하지마세요* ############-------------------------------->
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="URL" value="<?=$URL?>">
<input type="hidden" name="idCk" id="idCk">
<input type="hidden" name="nickCk" id="nickCk">
<input type="hidden" name="EmailCk" id="EmailCk">
<? if($mode=="JOIN") { ?>
<input type="hidden" name="mem_sch" value="<?=$mem_sch?>">
<? } ?>
<!------------------########## 주요히든필드 *수정하지마세요* ############-------------------------------->

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="right" colspan="2" style="padding:5px;"><span style="font-weight:bold;">별표시(<span style="color:#ff0000">*</span>)는 필수 입력사항입니다.</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr>
		<!--td rowspan="11" width="250" align="center">
			<table width="7" border="0" cellpadding="1" cellspacing="1" bgcolor="CCCCCC">
				<tr>
					<td width="10" bgcolor="#FFFFFF"><?=Get_photo($mem_photo,"myphoto",100,125);?></td>
				</tr>
			</table>
			(적정해상도 100*125)<br>
			<input type="file" name="photo"  style="width:50%; background-color:#ffffff; border:0 D9D9D9 solid; color:#FFFFFF" onFocus="PhotoView(this.form);"> <?=$mem_photo_dele?>
		</td-->
		<td width="116" height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 아이디 <span style="color:#ff0000">*</span></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="200"><input type="text" name="id" id="id" style="width:150; height:19px; border:1 D9D9D9 solid"  value="<?=$mem[mem_id]?>" <? if ($mode=='INFO') { echo "readonly style='background-color:#dddddd;'"; } ?>
                    <? if ($mode=='JOIN') { echo "onblur='CheckID(this);'"; } ?>></td>
					<td><span id="join_id_result">[영문/숫자 5자이상 15자이하입니다]</span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 성명 <span style="color:#ff0000">*</span></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
		<?if($mode == "JOIN"){?>
			<input type="text" name="mem_name" value="<?=$mem[mem_name]?>" style='background-color:#ffffff;'  style="width:150; height:19px; border:1 D9D9D9 solid">
		<? }else{ ?>
			<input type="hidden" name="mem_name" value="<?=$mem[mem_name]?>" ><?=$mem[mem_name]?>
		<? } ?>
			</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 닉네임 <span style="color:#ff0000">*</span></td>
		<td width="644" bgcolor="#FFFFFF" style="padding-left:5px;"><table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="200"><input type="text"  name="mem_nick" value="<?=$mem[mem_nick]?>" style="width:150px; height:19px; background-color:#ffffff; border:1 D9D9D9 solid" onBlur="CheckNick(this);"></td>
				<td><span id="join_nick_result">[한글/영문/숫자 2자 이상 ~ 6자 이하입니다]</span></td>
			</tr>
		</table></td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 비밀번호 <span style="color:#ff0000">*</span></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;"><input type="password" name="mem_pass" style="width:50%; height:19px; background-color:#ffffff; border:1 D9D9D9 solid;" maxlength="10"> [영문/숫자 5자 이상 ~ 10자 이하입니다]</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 비밀번호 확인 <span style="color:#ff0000">*</span></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;"><input type="password" name="mem_passChk" style="width:50%;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength="10"> 
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 이메일 <span style="color:#ff0000">*</span></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;"><table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="320"><input type="text" name="mem_email" value="<?=$mem[mem_email]?>" style="width:300;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" onBlur="CheckEmail(this);"></td>
				<td><span id="join_email_result"></span></td>
			</tr>
		</table></td>
	</tr>
	<tr bgcolor="#EBEBEB"> <td height="1" colspan="2"></td></tr>
	<tr>
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 홈페이지</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;"><input type="text" name="mem_home" value="<?=$mem[mem_home]?>" style="width:300;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid"></td>
	</tr>
	<tr bgcolor="#EBEBEB"> <td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 생년월일</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<?=date_select($mem[mem_birth], "mem_birth", 0, 100,"0000"); // 오늘을 기준으로 100년 전부터 옵션값을 출력합니다.?>
			( <input type="radio" name="mem_btype" value="+" <?if($mem[mem_btype]=="+"){?>checked<?}?>>양력 
			<input type="radio" name="mem_btype" value="-" <?if($mem[mem_btype]=="-"){?>checked<?}?>>음력 )
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"> <td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 연락처 </td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="text" name="mem_tel01" value="<?=$mem_tel[0]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=3> - 
			<input type="text" name="mem_tel02" value="<?=$mem_tel[1]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=4> - 
			<input type="text" name="mem_tel03" value="<?=$mem_tel[2]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=4>
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 휴대폰<span style="color:#ff0000">*</span></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="text" name="mem_phone01" value="<?=$mem_phone[0]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=3> - 
			<input type="text" name="mem_phone02" value="<?=$mem_phone[1]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=4> - 
			<input type="text" name="mem_phone03" value="<?=$mem_phone[2]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=4>
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 팩스번호</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="text" name="mem_fax01" value="<?=$mem_fax[0]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=3> - 
			<input type="text" name="mem_fax02" value="<?=$mem_fax[1]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=4> - 
			<input type="text" name="mem_fax03" value="<?=$mem_fax[2]?>" style="width:30;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" maxlength=4>
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="70" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 주소</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="text"  name="mem_post" value="<?=$mem[mem_post]?>" style="width:100px;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" readonly> <img src="<?=$G_member["skin_url"]?>/images/btn_address.gif" border="0" style="cursor:hand" onclick="win_zip('member', 'mem_post', 'mem_add1', 'mem_add2');" align="absmiddle">
			<input type="text"  name="mem_add1" value="<?=$mem[mem_add1]?>" style="width:100%;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid" readonly>
			<input type="text"  name="mem_add2" value="<?=$mem[mem_add2]?>" style="width:200;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid"> [나머지주소입력]
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 성별 <span style="color:#ff0000">*</span></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="radio" name="mem_sex" value="m" <?if($mem[mem_sex]=="m"){?>checked<?}?>>남 
			<input type="radio" name="mem_sex" value="w" <?if($mem[mem_sex]=="w"){?>checked<?}?>>여
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 정보메일</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="checkbox" name="mem_remail" value="y" <?if($mem[mem_remail]=="y"){?>checked<?}?> align="absmiddle"> 수신
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- SMS</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="checkbox" name="mem_sms" value="y" <?if($mem[mem_sms]=="y"){?>checked<?}?> align="absmiddle"> 수신
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
	<? for ($i=1; $i<=5; $i++) { ?>
		<? if($default["mex{$i}_title"]==TRUE) {?>
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- <?=$default["mex{$i}_title"]?></td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="text"  name="exe_<?=$i?>" value="<?=$mem["exe_{$i}"]?>" style="width:100%;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid">
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
		<? } ?>
	<? } ?>
<? if($mode=="JOIN") { ?>
	<!--tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 추천인</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<input type="text"  name="mem_chu" value="<?=$mem[mem_chu]?>" style="width:100%;  height:19px; background-color:#ffffff; border:1 D9D9D9 solid">
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr-->
<? } else { ?>
	<!--tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 추천인</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<?=$mem[mem_chu]?>
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr-->
	<tr> 
		<td height="30" bgcolor="#ffffff" style="padding-left:10; font-color:#333333">- 회원등급</td>
		<td bgcolor="#FFFFFF" style="padding-left:5px;">
			<?=$mem[leb_name]?>
		</td>
	</tr>
	<tr bgcolor="#EBEBEB"><td height="1" colspan="2"></td></tr>
<? } ?>
</table>
<table align="center">
	<tr>
		<td height=50>
<? if($mode=="JOIN") { ?>
			<input type=image src="/btn/btn_ok.gif" border=0 style="border:0px;">
<? } else { ?>
			<input type=image src="/btn/btn_modify.gif" border=0 style="border:0px;">
<? } ?>
		</td>
	</tr>
</table>
</form>

<script language="Javascript">
<?if($mode == "INFO"){?>
	document.member.idCk.value = "Y";
	document.member.nickCk.value = "Y";
	document.member.EmailCk.value = "Y";

<? } ?>
function PhotoView(form)
{
	if (form.photo.value) {
		form.myphoto.src = form.photo.value;
	}
}

function member_submit(form)
{
	 
	if(form.idCk.value != "Y") {
		alert('아이디를 다시 입력해주십시요.');
		form.id.value="";
		form.id.focus();
		return;
	}

	if(form.nickCk.value != "Y") {
		alert('닉네임을 다시 입력해주십시요.');
		form.mem_nick.value="";
		form.mem_nick.focus();
		return;
	}

	if(form.EmailCk.value != "Y") {
		alert('이메일을 다시 입력해주십시요.');
		form.mem_email.value="";
		form.mem_email.focus();
		return;
	}

	if(!form.id.value) {
		alert('아이디 값이 없습니다.');
		return;
	}

	if(!form.mem_nick.value) {
		alert('개인정보 보호를 위해 실명이 아닌 닉네임을 사용합니다.\n\n사이트내에서 사용하실 닉네임을 입력해주세요.');
        form.mem_nick.focus();
		return;
	}

	if(form.mode.value=="JOIN") {
		if(!form.mem_name.value) {
			alert('성명을 입력해주세요.');
			form.mem_name.focus();
			return;
		}		
		if(!form.mem_pass.value) {
			alert('사용하실 비밀번호를 반드시 입력하셔야 합니다.');
			form.mem_pass.focus();
			return;
		}
		if(!form.mem_passChk.value) {
			alert('사용하실 비밀번호를 확인 입력하셔야 합니다.');
			form.mem_passChk.focus();
			return;
		}
		if(!form.mem_passChk.value) {
			alert('사용하실 비밀번호를 확인 입력하셔야 합니다.');
			form.mem_passChk.focus();
			return;
		}
	}
	if(form.mem_pass.value != ""){
		if(strLen(form.mem_pass,5,10,"비밀번호를 ") == false) {
			form.mem_pass.value='';
			form.mem_passChk.value='';
			form.mem_pass.focus();
			return;
		}
	}

	if(!form.mem_email.value) {
		alert('개인회원정보를 메일로 발송해 드리므로, 반드시 메일주소를 입력해주세요.');
        form.mem_email.focus();
		return;
	}

	if(!form.mem_phone01.value || !form.mem_phone02.value || !form.mem_phone03.value) {
		alert('휴대폰를 모두 입력해주세요');
		return;
	}

	if(!ridiaChk(form.mem_sex,"성별을 선택하세요")) return;

	if (form.mem_pass.value != form.mem_passChk.value) {
        alert("패스워드가 같지 않습니다.");
        form.mem_passChk.focus();
        return;
    }

    if (typeof(form.mem_chu) != 'undefined') {
        if (form.id.value == form.mem_chu.value) {
            alert("본인을 추천할 수 없습니다.");
            form.mem_chu.focus();
            return;
        }
    }
	
	<?if($default[ssl_flag] == "Y"){?>
		form.action = "<?=$ssl_url?>/member/member_update.php";
	<? }else{ ?>
		form.action = "./member_update.php";
	<? } ?>

    form.submit();
}
</script>

<?
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; 
?>