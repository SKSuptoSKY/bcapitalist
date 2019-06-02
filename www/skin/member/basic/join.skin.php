<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";
?>
<form name="form" method="POST" onsubmit="check_form(document.form); return false" autocomplete="off" >
<input type="hidden" name="mode" value="JOIN">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
   <? /*?>
	<tr>
      <td>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" >
		  <tr>
			  <td background="<?=$G_member["skin_url"]?>/images/left_back.gif"><img src="<?=$G_member["skin_url"]?>/images/left_back.gif"></td>
			  <td>
				<table width=100% border=0 align="center" cellpadding=0 cellspacing=3>
					 <tr bgcolor="#ffffff">
					 <td width="182">&nbsp;&nbsp;&nbsp;<b>* 이름</b></td>
					  <td width="">&nbsp;&nbsp;&nbsp; <input name="mem_name" type="text" style="width:180px; height:18px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid;ime-mode:active;" size="22"></td>
						<? if($juminch=="0") { ?>
			   <!--td  width="20%" rowspan=3 align="center"><img src="/btn/btn_truename.gif" name="Confirm" id="Confirm" onclick="RealNameCheck(document.form);" style="cursor:hand"></td-->
					<? } ?>
					 </tr>
					 <tr><td colspan="2" bgcolor="eeeeee" height="1"></td></tr>
					  <tr bgcolor="#ffffff">
						   <td>&nbsp;&nbsp;&nbsp;<b>* 주민등록번호</b></td>
							<td>&nbsp;&nbsp;&nbsp; <input name="ssn1" type="text" style="width:80px; height:18px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid;ime-mode:inactive;" onkeyup="javascript: numOnly(this,0);nextFocus('form','ssn1','ssn2');" maxlength=6>
				-
							<input name="ssn2" type="text" style="width:80px; height:18px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid;ime-mode:inactive;" onkeyup="javascript: numOnly(this,0);" maxlength=7></font>
							</td>
					   </tr>
				   </table>
				</td>
			</tr>
		</table>
	</td>
	</tr>
	<? */?>


<div class="join_wrap">
	<div class="inWrap">
		<div class="tbox1">
			<h4 class="boxTit">회원가입약관</h4>
			<div class="txt_scroll">
				<div class="txt_type">
					<?=stripslashes(nl2br($default[member_stipulation]));?>
				</div>
			</div>
		</div>
		<p class="agreement mt10">
			<input type="checkbox" value="1" name="agree" id="agree">&nbsp;<label for="agree"><span>회원가입약관을 읽었으며 내용에 동의합니다.</label>
		</p>

		<div class="tbox1 mt40">
			<h4 class="boxTit">개인정보취급방침</h4>
			<div class="txt_scroll trans2">
				<div class="txt_type">
					<div class="mt20" style="margin-bottom:20px">
					<?=stripslashes(nl2br($default[member_privacy]));?>

					</div>
				</div>
			</div>
		</div>
		<p class="agreement mt10">
			<input type="checkbox" value="1" name="agree2" id="agree2">&nbsp;<label for="agree2">개인정보취급방침을 읽었으며 내용에 동의합니다.</label>
		</p>
	</div>


	<div class="btnWrap center mt30">
		<input type="submit" value="확인" class="btnType btn1 color2">
	</div>

</div><!-- //join_wrap -->

 </table>
</form>



<script language="javascript">
function check_form(f) {
	if (!f.agree.checked) {
        alert("회원가입약관의 내용에 동의해야 회원가입 하실 수 있습니다.");
        f.agree.focus();
        return;
    }

    if (!f.agree2.checked) {
        alert("개인정보보호정책의 내용에 동의해야 회원가입 하실 수 있습니다.");
        f.agree2.focus();
        return;
    }

<? if($juminch=="0") { ?>
    if (f.juminch.value==0) {
        alert("실명확인을 해주셔야 합니다.");
        f.mem_name.focus();
        return;
    }
<? } ?>

    f.action = "./member_form.php";
    f.submit();
}

function RealNameCheck(form) {
	if (!form.mem_name.value) {
		alert("이름을 입력해주세요");
		form.mem_name.focus();
		return;
	}

	if (!form.ssn1.value || !form.ssn2.value) {
		alert("주민등록번호를 입력해주세요");
		form.ssn1.focus();
		return;
	}
	if (!chkSsn(form.ssn1,form.ssn2)) {
		alert("주민등록번호를 바르게 입력해주세요");
		form.ssn1.focus();
		return;
	}

	document.pageForm.userNm.value = form.mem_name.value;
	document.pageForm.userNo1.value = form.ssn1.value;
	document.pageForm.userNo2.value = form.ssn2.value;

	goIDCheck();
}
</script>

<?
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>