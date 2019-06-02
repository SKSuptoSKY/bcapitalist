<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.php"; ?>
<script language='javascript'>
function writeChk(form) {
    if (typeof(form.username) != 'undefined') {
		if(!form.username.value) {
			alert('작성자명을 입력하세요');
			form.username.focus();
			return false;
		}
	}
	if (typeof(form.subject) != 'undefined') {
		if(!form.subject.value) {
			alert('글 제목을 입력하세요');
			form.subject.focus();
			return false;
		}
	}
	if (typeof(form.content) != 'undefined') {
		if(!form.content.value) {
			alert('글 내용을 입력하세요');
			form.content.focus();
			return false;
		}
	}
	if (typeof(form.phone) != 'undefined') {
		if(!form.phone.value) {
			alert('전화번호를 입력하세요');
			form.phone.focus();
			return false;
		}
	}
	if (typeof(form.mobile) != 'undefined') {
		if(!form.mobile.value) {
			alert('핸드폰번호를 입력하세요');
			form.mobile.focus();
			return false;
		}
	}
	if (typeof(form.email) != 'undefined') {
		if(!form.email.value) {
			alert('이메일을 입력하세요');
			form.email.focus();
			return false;
		}
	}
	if (typeof(form.retime_y) != 'undefined') {
		if(!form.retime_y.value) {
			alert('방문예정일을 입력하세요');
			form.retime_y.focus();
			return false;
		}
		if(!form.retime_m.value) {
			alert('방문예정일을 입력하세요');
			form.retime_m.focus();
			return false;
		}
		if(!form.retime_d.value) {
			alert('방문예정일을 입력하세요');
			form.retime_d.focus();
			return false;
		}
		if(!form.retime_h.value) {
			alert('방문예정일을 입력하세요');
			form.retime_h.focus();
			return false;
		}
	}
	if(form.ch_flag.checked == false){
		alert('개인정보취급방침 동의에 체크해주세요');
		form.ch_flag.focus();
		return false;
	}

	<?if($default[ssl_flag] == "Y"){?>
		form.action = "<?=$ssl_url?>/online/online_update.php";
	<? }else{ ?>
		form.action = "/online/online_update.php";
	<? } ?>

	form.submit();
	return;
}


/* ------------------------------------------------------------- [ 이메일 정규식 체크 - Start ] ------------------------------------------------------------- */
function blur_email_input(value){
	$.ajax({
		type:"POST",
		url:"/GnAjax/check_valid/email_value.php",

		data:
		{
			email: value
		},

		success:function(result) {
			if (result=="true"){
				$("#email_valid_result_area").css("color","blue").html("사용가능한 이메일 주소입니다.")
			} else {
				$("#email_valid_result_area").css("color","#ff0000").html("이메일 형식이 올바르지 않습니다.");
				$("#email").attr("value","");
			}
		}
	});
};
/* ------------------------------------------------------------- [ 이메일 정규식 체크 - End ] ------------------------------------------------------------- */
</script>



<div id="contents">


<form name="writeform" id="test" method="post" enctype="multipart/form-data" validate="UTF-8" onsubmit="writeChk(this); return false;">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="type" value="<?=$type?>">
<input type="hidden" name="url" value="<?=$PHP_SELF?>?<?=$QUERY_STRING?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->


<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="mobile_onlineForm">
	<colgroup>
		<col width="30%"/>
		<col width="70%"/>
	</colgroup>
	<tr>
		<th>이름</th>
		<td><input type="text" name="username" class="inputType" style="width:95%;height:25px;"></td>
    </tr>
    <tr>
		<th>핸드폰번호</th>
		<td><input type="text" name="mobile" size="70"  class="inputType" style="width:95%;height:25px;"></td>
    </tr>
    <tr>
		<th>이메일</th>
		<td >
			<input type="text" id="email" name="email" style="width:95%;height:25px;" class="inputType" onblur="blur_email_input(this.value);">
			<!-- 이메일형식 정규식 체크 출력부 -->
			&nbsp;<span id="email_valid_result_area"></span>
		</td>
    </tr>
    <tr>
		<th>신청내용</th>
		<td><textarea name="content" cols="82" rows="10" class="textarea inputType" style="width:95%;"></textarea></td>
    </tr>
    <tr>
		<th>첨부파일</th>
		<td><input type="file" name="userfile1"></td>
    </tr>
  </table><br>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td height="10" colspan="3"></td>
		</tr>
		<tr>
			<td width="10"></td>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><textarea style="width:95%;height:180px;" class="inputType"><?=$online_ch_text?></textarea></td>
					</tr>
					<tr>
						<td height="10"></td>
					</tr>
					<tr>
						<td><input type="checkbox" name="ch_flag" id="ch_flag" style="border:0px; vertical-align:middle;"> 개인정보취급방침 동의</td>
					</tr>
					<tr><td height="35" colspan="3" bgcolor="#ffffff"></td></tr>
					<tr><td height="1" colspan="3" bgcolor="#353638"></td></tr>
				</table>
			</td>
		</tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" align="center" class="online_btn">
		<tr height="100">
			<td valign="middle">
				<input type="submit" value="확인" class="btn_ok_online">
				<a href="javascript:document.writeform.reset();">
					<div class="btn_cancel_online">취소</div>
				</a>
			</td>
		</tr>
	</table>

</form>


</div>


<style>
.mobile_onlineForm{border-top:2px solid #353638; }
.mobile_onlineForm th{font-weight:bold; color:#222; font-size:13px; border-bottom:1px solid #d8d8d8; padding:5px 0; height:25px;}
.mobile_onlineForm td{border-bottom:1px solid #d8d8d8; padding:5px 0;  height:25px;}
.inputType{border:1px solid #cccccc; -webkit-border-radius:0px;  -webkit-appearance:none; }
.online_bb{}
.online_bure {background-color:#fbfcfe;}
.form_input1{background:#fff;}
.textarea {border: 1px solid #d6d9de; width:90%; height:150px; background:#fff; color:#676767; font-size:12px;}
.retime {border: 1px solid #d6d9de; width:50px; height:20px; color:#676767; font-size:12px;}
.btn_ok_online{float:left; margin-right:5px;  width:70px; height:27px; background:#555; border:none; color:#fff; cursor:pointer; line-height:25px; -webkit-border-radius:0px;  -webkit-appearance:none; }
.btn_cancel_online{width:70px; height:25px; background:#fff; cursor:hand; border:1px solid #bbb; display:inline-block; line-height:25px; float:left; margin-left:5px; color:#000; text-align:center; }
</style>

<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.php";
?>

