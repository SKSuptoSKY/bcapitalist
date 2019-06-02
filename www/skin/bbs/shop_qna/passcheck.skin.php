<script language=javascript>
function writeChk(form) {
	if(!form.passwd.value) {
		alert('비밀번호를 입력하세요');
		form.passwd.focus();
		return false;
	}
	return true;
}
</script>

<? if($Table=="notice") { ?>
<h2><img src="/images/title/tit_util05.gif" alt="공지사항" /></h2>
<? } ?>
<? if($Table=="qnaboard") { ?>
<h2><img src="/images/title/tit_util06.gif" alt="문의게시판" /></h2>
<? } ?>
<div class="pass_box">

<form name="writeform" id="test" method="post" action="<?=$NextAction?>" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="mode" value="<?=$type?>">
<input type="hidden" name="tbl" value="<?=$Table?>">
<input type="hidden" name="num" value="<?=$num?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
	<table width="300" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="30">▒▒▒▒ 비밀번호 확인이 필요합니다. ▒▒▒▒</td>
		</tr>
		<tr>
			<td height="30">비밀번호를 입력하세요</td>
		</tr>
		<tr>
			<td align="right" height="50">
			<b><font color="555555">비밀번호 :</font></b> <input type="password" name="passwd" style="border:0; border-bottom:1px solid #e1e1e1">
			</td>
		</tr>
		<tr>
			<td align="right" height="40">
			<input type="submit" value="ok~!" class="btn">
			<input type="button" value="back" class="btn" onclick="history.back();">
			</td>
		</tr>
	</table>
</form>
</div>