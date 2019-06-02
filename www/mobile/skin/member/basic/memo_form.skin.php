<?
////////// 메모 페이지 추가코드 여기부터 //////////////////////////

////////// 메모 페이지 추가코드 여기까지 //////////////////////////
?>
<script language="javascript">
function writeChk(form) {
	if(!form.send_id.value) {
		alert("받는 사람의 아이디를 입력하세요");
		form.send_id.focus();
		return false;
	}
	if(!form.memo.value) {
		alert("쪽지내용을 입력하세요");
		form.memo.focus();
		return false;
	}
    if (typeof(form.passwd) != 'undefined') {
		if(!form.passwd.value) {
			alert('비밀번호를 입력하세요. 수정 삭제시 반듯이 필요합니다.');
			form.passwd.focus();
			return false;
		}
	}

	form.submit();
}
</script>
<style type="text/css">
td.title {
	font-family: "돋음";
	font-size: 9pt;
	line-height: 17px;
	color:#086CC0;
	font-weight:bold;
}
</style>

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="2" bgcolor="#086CC0"></td></tr>
	<tr height="30" align="center" bgcolor="#F1F1F1">
		<td class="title" width="120">쪽지보내기</td>
	</tr>
	<tr><td height="2" bgcolor="#086CC0"></td></tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="30" align="right" style="padding-right:5px">
			<?=$_SESSION["nickname"]?>님의
			<a href="./memo.php?mode=SEND">[받은쪽지함]</a>
			<a href="./memo.php?mode=RECV">[보낸쪽지함]</a>
			<a href="./memo.php?mode=SAVE">[저장쪽지함]</a>
			<a href="./memo_form.php">[쪽지보내기]</a>
		</td>
	</tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name="writeform" id="test" method="post" action="/member/memo_update.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
<input type="hidden" name="mode" value="W">
	<tr><td height="2" bgcolor="#086CC0" colspan="4"></td></tr>
	<tr height="28" bgcolor="#F1F1F1">
		<td width="85" class="title" align="center">받는이 ID<br></td>
		<td style="padding:5px">
			<input type="text" name="send_id" value="<?=$id?>" class="text" style="width=100%"><br>
			<font style="font-size:8pt;color:red">* 여러명에서 보낼경우 콤마(,)로 구분하세요 예) ID1,ID2</font>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#086CC0" colspan="4"></td></tr>
	<tr height="28" bgcolor="#F1F1F1">
		<td class="title" align="center">쪽지내용</td>
		<td style="padding:5px"><textarea name="memo" rows="18" class="text" style="width=100%"></textarea></td>
	</tr>
	<tr><td height="2" bgcolor="#086CC0" colspan="4"></td></tr>
	<tr><td height="50" colspan="4" align="center"><input type="image" src="/btn/btn_send.gif" border="0"></td></tr>
</form>
</table>