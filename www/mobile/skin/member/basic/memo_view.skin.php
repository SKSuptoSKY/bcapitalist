<?
////////// 메모 페이지 추가코드 여기부터 //////////////////////////

////////// 메모 페이지 추가코드 여기까지 //////////////////////////
?>
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
		<td class="title" width="120"><?=$Page_Title?></td>
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
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center" style="word-break:break-all;">
	<tr><td height="2" bgcolor="#086CC0"></td></tr>
	<tr height="28" bgcolor="#F1F1F1">
		<td align="center" style="padding:5px"><font color="#086CC0"><?=$recv_name?></font> 님께서 <?=$send_time?> 에 보내신 쪽지 내용입니다. <?=$save_time?></td>
	</tr>
	<tr><td height="1" bgcolor="#086CC0"></td></tr>
	<tr height="28" bgcolor="#F1F1F1">
		<td width="500" style="padding:8px"><textarea name="memo" rows="18" class="text" style="width=100%;color:#666666; font-size:9pt; background-color:#F1F1F1; border:0 #DFDFDF solid"><?=$memo?></textarea></td>
	</tr>
	<tr><td height="2" bgcolor="#086CC0"></td></tr>
	<tr><td height="50" align="center"><a href="./memo.php?mode=<?=$mode?>&page=<?=$page?>"><img src="/btn/btn_ok.gif" border="0"></a></td></tr>
</table>