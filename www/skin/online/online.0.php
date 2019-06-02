<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
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


<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="onlineForm_relative">
	<colgroup>
		<col width="25%"/>
		<col width="*"/>
	</colgroup>
	<tr>
		<th>이름</th>
		<td><input type="text" name="username" class="form_input1" style="width:95%;"></td>
	</tr>
	<tr>
		<th>핸드폰번호</th>
		<td><input type="text" name="mobile" size="70"  class="form_input1" style="width:95%;"></td>
	</tr>
	<tr>
		<th>이메일</th>
		<td>
			<input type="text" id="email" name="email" style="width:95%;" class="form_input1" onblur="blur_email_input(this.value);">
			<!-- 이메일형식 정규식 체크 출력부 -->
			&nbsp;<span id="email_valid_result_area"></span>
		</td>
	</tr>
	<tr>
		<th>신청내용</th>
		<td><textarea name="content" cols="82" rows="5" class="textarea" style="width:95%;"></textarea></td>
	</tr>
	<tr>
		<th>첨부파일</th>
		<td><input type="file" name="userfile1"  class="form_input1" style="width:95%;"></td>
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
						<td><textarea style="width:98%;height:180px; font-family:NanumGothic; color:#888888; border:1px solid #ddd"><?=$online_ch_text?></textarea></td>
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
				<input type="submit" value="확인" class="btn_R_black">
				<a href="javascript:document.writeform.reset();">
					<div class="btn_R_white">취소</div>
				</a>
			</td>
		</tr>
	</table>

</form>


</div>
<?
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>

<style>
.form_input1{background:#fff; height:28px; font-size:13px; -webkit-border-radius:0px;  -webkit-appearance:none; }
.textarea {border: 1px solid #d6d9de; width:90%; height:150px; background:#fff; color:#676767; -webkit-border-radius:0px;  -webkit-appearance:none; }
.retime {border: 1px solid #d6d9de; width:50px; height:20px; color:#676767;}

.onlineForm_relative{border-top:2px solid #333333; }
.onlineForm_relative th{text-align:left; height:45px; border-bottom:1px solid #dddddd; padding-left:10px; color:#333333; box-sizing:border-box;}
.onlineForm_relative td{height:45px; padding:8px 0; border-bottom:1px solid #dddddd; box-sizing:border-box;}

.btn_R_white{width:100px; height:34px; background:#ffffff; font-size:14px; color:#333333; font-weight:bold; border:1px solid #777777; text-align:center; line-height:32px; display:inline-block; vertical-align:middle; -webkit-border-radius:0px;  -webkit-appearance:none;  box-sizing:border-box;}
.btn_R_black{width:100px; height:34px; background:#333333; font-size:14px; color:#ffffff; font-weight:bold; border:1px solid #333333;  text-align:center; line-height:32px; display:inline-block;vertical-align:middle; -webkit-border-radius:0px;  -webkit-appearance:none;  box-sizing:border-box;cursor:pointer;}


/* 반응형 모바일 */
@media screen and (max-width : 640px) {
.btn_R_white{width:80px; height:30px; font-size:13px; line-height:28px;}
.btn_R_black{width:80px; height:30px; font-size:13px; line-height:28px; cursor:pointer;}
}
</style>