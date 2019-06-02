<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.php";
?>

<form name="form" method="POST" autocomplete="off" onsubmit="check_form(document.form); return false">
<input type="hidden" name="mode" value="JOIN">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
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


		<div class="btnWrap mt30" style="text-align:center;">
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
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.php";
?>