<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.php"; ?>
<script type="text/javascript" src="/GnAjax/member/js/member_ajax.js"></script>
<script type="text/javascript" src="/addr_zip/Uzipjs/UzipJs.js"></script>

<form name="member" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="member_submit(document.member); return false">
<!------------------########## 주요히든필드 *수정하지마세요* ############-------------------------------->
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="URL" value="<?=$URL?>">
<input type="hidden" name="idCk" id="idCk">
<input type="hidden" name="passCk" id="passCk" <?if($mode=="INFO") { ?>value="Y"<? } ?>>
<input type="hidden" name="nickCk" id="nickCk">
<input type="hidden" name="EmailCk" id="EmailCk">
<? if($mode=="JOIN") { ?>
<input type="hidden" name="mem_sch" value="<?=$mem_sch?>">
<? } ?>
<input type="hidden" name="mem_email" id="mem_email" value="<?=$mem[mem_email]?>">

<input type="hidden" name="mem_nick" value="<?=$mem[mem_nick]?>">
<!------------------########## 주요히든필드 *수정하지마세요* ############-------------------------------->

<style type="text/css">
.member_info{border-top:1px solid #888888}
.member_info th{height:35px; border-bottom:1px solid #dddddd; text-align:left; padding:5px 10px; color:#333333; }
.member_info td{border-bottom:1px solid #dddddd; padding-left:15px; height:35px; padding:5px 10px; }
input.input_txt{border:1px solid #d3d3d3; height:26px; text-indent:5px; -webkit-border-radius:0px;  -webkit-appearance:none; }
select{height:28px; border:1px solid #d3d3d3; -webkit-border-radius:0px; }
.btn_member_mobile1{-webkit-border-radius:0px;  -webkit-appearance:none; width:200px; height:35px; font-size:13px; font-weight:bold; color:#333333;
background:#ffffff; border:1px solid #555555; }
</style>


<?if($mode=="JOIN"){?>
<h4 class="h4_title mt30">회원 가입</h4>
<?}else{?>
<h4 class="h4_title mt30">회원 정보 수정</h4>
<?}?>

<p style="text-align:right"><span style="font-weight:bold;">별표시(<span style="color:#ff0000">*</span>)는 필수 입력사항입니다.</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="member_info mt5">
	<colgroup>
		<col width="25%"/>
		<col width="75%"/>
	</colgroup>
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
		<th>아이디 <span style="color:#ff0000">*</span></th>
		<td>
			<input type="text" name="id" id="id" class="input_txt" value="<?=$mem[mem_id]?>" <? if ($mode=='INFO') { echo "readonly style='background-color:#eeeeee; width:95%'"; } ?>
			<? if ($mode=='JOIN') { echo "onblur='CheckID(this);'"; } ?>><br />
			<span id="join_id_result">[영문/숫자 5자이상 15자이하입니다]</span>
		</td>
	</tr>
	<tr>
		<th>성명 <span style="color:#ff0000">*</span></th>
		<td>
		<?if($mode == "JOIN"){?>
			<input type="text" name="mem_name" value="<?=$mem[mem_name]?>" class="input_txt" onBlur="fill_nickname(this.value);">
		<? }else{ ?>
			<input type="hidden" name="mem_name" value="<?=$mem[mem_name]?>" ><?=$mem[mem_name]?>
		<? } ?>
			</td>
	</tr>
	<tr>
		<th>비밀번호 <span style="color:#ff0000">*</span></th>
		<td>
			<input type="password" name="mem_pass" class="input_txt mt5" style="width:95%" maxlength="20" onchange="CheckPASS(this);">
			<br><span id="join_pass_result" style="display:block; margin-bottom:5px;">[영문+숫자+특수문자 5자 이상 ~ 20자 이하입니다]</span>
		</td>
	</tr>
	<tr>
		<th>비밀번호<br />확인 <span style="color:#ff0000">*</span></th>
		<td><input type="password"  class="input_txt" style="width:95%" name="mem_passChk"  maxlength="20">
		</td>
	</tr>
	<tr>
		<th>이메일 <span style="color:#ff0000">*</span></th>
		<td style="padding-bottom:3px">
			<? if($mem[mem_email] != "") { $email_arr = explode("@",$mem[mem_email]); } ?>
			<input type="text" name="email1" value="<?=$email_arr[0]?>" class="input_txt mt3" style="width:42%;" onblur="check_email(this.form);" /> @
			<input type="text" name="email2" value="<?=$email_arr[1]?>" class="input_txt" style="width:45%;" onblur="check_email(this.form);" />

			<select name="domain" onChange="select_domain(this.form, this.value);" class="mt5 mb5" style="width:95%;">
				<option value="">직접입력</option>
				<? $domain_arr = array("naver.com", "daum.net", "hotmail.com", "nate.com", "yahoo.co.kr", "paran.com", "empas.com", "dreamwiz.net", "freechal.com", "lycos.co.kr", "korea.com", "gmail.com", "hanmir.com"); ?>
				<?for($i=0; $i<sizeof($domain_arr); $i++){?>
					<option value="<?=$domain_arr[$i]?>">
					<?=$domain_arr[$i]?>
					</option>
				<? } ?>
			</select>
			<br><span id="join_email_result"></span>
		</td>
	</tr>
	<tr>
		<th>홈페이지</th>
		<td><input type="text" name="mem_home" value="<?=$mem[mem_home]?>" class="input_txt" style="width:95%"></td>
	</tr>
	<tr>
		<th>생년월일</th>
		<td>
			<?=date_select($mem[mem_birth], "mem_birth", 0, 100,"0000"); // 오늘을 기준으로 100년 전부터 옵션값을 출력합니다.?><br />
			<div class="mt5 mb5">
				( <input type="radio" name="mem_btype" style="vertical-align:middle" value="+" <?if($mem[mem_btype]=="+"){?>checked<?}?>> 양력
				<input type="radio" name="mem_btype" style="vertical-align:middle" class="md5" value="-" <?if($mem[mem_btype]=="-"){?>checked<?}?>> 음력 )
			</div>
		</td>
	</tr>
	<tr>
		<th>연락처 </th>
		<td>
			<input type="text" name="mem_tel01" value="<?=$mem_tel[0]?>" class="input_txt" style="width:25%" maxlength=3> -
			<input type="text" name="mem_tel02" value="<?=$mem_tel[1]?>" class="input_txt" style="width:30%" maxlength=4> -
			<input type="text" name="mem_tel03" value="<?=$mem_tel[2]?>" class="input_txt" style="width:30%" maxlength=4>
		</td>
	</tr>
	<tr>
		<th>휴대폰<span style="color:#ff0000">*</span></th>
		<td>
			<input type="text" name="mem_phone01" value="<?=$mem_phone[0]?>" class="input_txt" style="width:25%" maxlength=3> -
			<input type="text" name="mem_phone02" value="<?=$mem_phone[1]?>" class="input_txt" style="width:30%" maxlength=4> -
			<input type="text" name="mem_phone03" value="<?=$mem_phone[2]?>" class="input_txt" style="width:30%" maxlength=4>
		</td>
	</tr>
	<tr>
		<th>팩스번호</th>
		<td>
			<input type="text" name="mem_fax01" value="<?=$mem_fax[0]?>" class="input_txt" style="width:25%" maxlength=3> -
			<input type="text" name="mem_fax02" value="<?=$mem_fax[1]?>" class="input_txt" style="width:30%" maxlength=4> -
			<input type="text" name="mem_fax03" value="<?=$mem_fax[2]?>" class="input_txt" style="width:30%" maxlength=4>
		</td>
	</tr>
	<tr>
		<th>주소</th>
		<td>
			<input type="text"  name="mem_post" id="mem_post" value="<?=$mem[mem_post]?>" style="width:100px;" class="input_txt mt5" readonly>
			<!-- <img src="<?=$G_member["skin_url"]?>/images/btn_address.gif" border="0" style="cursor:hand" onclick="win_zip('member', 'mem_post', 'mem_add1', 'mem_add2');" align="absmiddle"> -->
			<a href="#asd" onclick="openDaumPostcode('mem_post','mem_add1','mem_add2');"><!--  -->
			<img src="<?=$G_member["skin_url"]?>/images/btn_address.gif" border="0" style="cursor:pointer; vertical-align:middle" align="absmiddle">
			</a>
			<input type="text"  name="mem_add1" id="mem_add1" value="<?=$mem[mem_add1]?>" style="width:90%;" class="input_txt mt3" readonly>
			<input type="text"  name="mem_add2" id="mem_add2" value="<?=$mem[mem_add2]?>" style="width:70%;" class="input_txt mt3 mb5"> [나머지주소입력]
		</td>
	</tr>
	<tr>
		<th>성별 <span style="color:#ff0000">*</span></th>
		<td>
			<input type="radio" name="mem_sex" style="vertical-align:middle" value="m" <?if($mem[mem_sex]=="m"){?>checked<?}?>> 남
			<input type="radio" name="mem_sex" style="vertical-align:middle" value="w" class="md10"<?if($mem[mem_sex]=="w"){?>checked<?}?>> 여
		</td>
	</tr>
	<tr>
		<th>정보메일</th>
		<td>
			<input type="checkbox" name="mem_remail" style="vertical-align:middle" value="y" <?if($mem[mem_remail]=="y"){?>checked<?}?> align="absmiddle"> 수신
		</td>
	</tr>
	<tr>
		<th>SMS</th>
		<td>
			<input type="checkbox" name="mem_sms" style="vertical-align:middle" value="y" <?if($mem[mem_sms]=="y"){?>checked<?}?> align="absmiddle"> 수신
		</td>
	</tr>
	<? for ($i=1; $i<=5; $i++) { ?>
		<? if($default["mex{$i}_title"]==TRUE) {?>
	<tr>
		<th>- <?=$default["mex{$i}_title"]?></th>
		<td>
			<input type="text"  name="exe_<?=$i?>" value="<?=$mem["exe_{$i}"]?>" style="width:90%;" class="input_txt">
		</td>
	</tr>
		<? } ?>
	<? } ?>
<? if($mode=="JOIN") { ?>
	<!--tr>
		<td height="35" bgcolor="#ffffff" style="padding-left:10px; font-color:#333333; background:#f3f3f3; font-weight:700;">- 추천인</td>
		<td bgcolor="#FFFFFF" style="padding-left:15px;">
			<input type="text"  name="mem_chu" value="<?=$mem[mem_chu]?>" style="width:100%;  height:19px; background-color:#ffffff; border:1px #D9D9D9 solid">
		</td>
	</tr>
	<tr bgcolor="#d8d8d8"><td height="1" colspan="2"></td></tr-->
<? } else { ?>
	<!--tr>
		<td height="35" bgcolor="#ffffff" style="padding-left:10px; font-color:#333333; background:#f3f3f3; font-weight:700;">- 추천인</td>
		<td bgcolor="#FFFFFF" style="padding-left:15px;">
			<?=$mem[mem_chu]?>
		</td>
	</tr>
	<tr bgcolor="#d8d8d8"><td height="1" colspan="2"></td></tr-->
	<tr>
		<th>회원등급</th>
		<td><?=$mem[leb_name]?></td>
	</tr>
<? } ?>
</table>
<table align="center">
	<tr>
		<td height=100>
<? if($mode=="JOIN") { ?>
			<input type="submit" value="확인" class="btn_member_mobile1">
<? } else { ?>
			<input type="submit" value="수정하기" class="btn_member_mobile1">
<? } ?>
		</td>
	</tr>
</table>
</form>

<script type="text/javascript">
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
	if(form.passCk.value != "Y") {
		alert('패스워드를 다시 입력해주십시요.');
		form.mem_pass.value="";
		form.mem_pass.focus();
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
		if(strLen(form.mem_pass,5,20,"비밀번호를 ") == false) {
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
		form.action = "<?=$ssl_url?>/mobile/member/member_update.php";
	<? }else{ ?>
		form.action = "./member_update.php";
	<? } ?>

    form.submit();
}


/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	이메일 중복, 정규식 검사 - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	이메일관련 인풋의 onblur, onchange 하는 시점에 지정한 함수를 호출
|
|	function check_email(form)			:	ajax 이메일 정규식 체크, 결과 span텍스트 출력 + return함수호출
|	function select_domain(form, value)	:	이메일 도메인 셀렉트박스 변경 감지
|	function out_full_email(value)			:	지정한 영역에 최종 이메일값 출력
|
|	DOM 선택자 ---------------------------------------------------------------------------------
|	email1			:	이메일 아이디 입력란의 인풋네임
|	email2			:	이메일 도메인 입력란의 인풋네임
|	#mem_email	:	update 페이지에서 처리하기 위한 최종 이메일인풋영역의 아이디
|
|	2015 - MJ */

// 이메일 중복 및 정규식 체크
function check_email(form)
{
	// ----------------------------------------------------------------------------------------------
	// 이메일 인풋 설정
	var email1_value		=	form.email1.value;
	var email2_value		=	form.email2.value;
	// ----------------------------------------------------------------------------------------------

	// ----------------------------------------------------------------------------------------------
	// 두 인풋의 벨류값을 조합하여 이메일 생성
	var email = email1_value+"@"+email2_value;
	// ----------------------------------------------------------------------------------------------

	// ----------------------------------------------------------------------------------------------
	// 이메일 중복및 정규식 체크 (기존 감각 이메일체크 ajax)
	CheckEmail_New(email);

	// return
	out_full_email(email);
	// ----------------------------------------------------------------------------------------------
}

// 이메일(도메인) 셀렉트 박스 변경
function select_domain(form, value)
{
	// ----------------------------------------------------------------------------------------------
	// 셀렉트 박스 변경시 선택한값으로 email2 영역채움
	if(value) {
		form.email2.value = value;
	} else {
		form.email2.value = "";
		form.email2.focus();
	}
	// ----------------------------------------------------------------------------------------------

	// ----------------------------------------------------------------------------------------------
	// 이메일 체크함수 호출
	check_email(form);
	// ----------------------------------------------------------------------------------------------
}

// 최종 이메일 출력
function out_full_email(value)
{
	$("#mem_email").val(value);
}

/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	이메일 중복, 정규식 검사 - End
|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */


// 닉네임 성명으로 자동채우기
function fill_nickname(mem_name) {
	document.member.mem_nick.value = mem_name;
	document.member.nickCk.value = "Y";
}
</script>

<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.php";
?>