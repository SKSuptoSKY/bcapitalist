<?
////////// 메모 페이지 추가코드 여기부터 //////////////////////////

////////// 메모 페이지 추가코드 여기까지 //////////////////////////
?>
<script language="javascript">
function writeChk(form) {
	if(!form.c_writer.value) {
		alert("덧글작성자를 입력하세요");
		form.c_writer.focus();
		return;
	}
	if(!form.c_content.value) {
		alert("덧글내용을 입력하세요");
		form.c_content.focus();
		return;
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

function deleteChk(url) {
	yes_no = confirm('삭제하시면 다시 복구하실 수 없습니다.\n\n삭제하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때 
		if(url==true) {
		} else {
			location.href=url;
		}
	} 
}

function saveChk(url) {
	yes_no = confirm('저장하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때 
		if(url==true) {
		} else {
			location.href=url;
		}
	} 
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
		<td class="title" width="120"><?=$Page_Title?> 쪽지 목록</td>
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
	<tr><td height="2" bgcolor="#086CC0" colspan="5"></td></tr>
	<tr height="28" align="center" bgcolor="#F1F1F1">
		<td class="title">보낸이</td>
		<td class="title">받는이</td>
		<td class="title"><?=$Page_Title?>날</td>
	<?if($mode=="RECV") { ?>
		<td class="title">읽은날</td>
	<? }  ?>
		<td class="title">비고</td>
	</tr>
	<tr><td height="2" bgcolor="#086CC0" colspan="5"></td></tr>
<? for ($i=0; $i<$list_total; $i++) { ?>
	<tr height="28" align="center">
		<td><? if($mode=="SEND") { ?><a href="./memo_form.php?id=<?=$list[$i]["m_recv_id"]?>"><?=$list[$i]["recv_name"]?></a><?} else {?><?=$list[$i]["recv_name"]?><? } ?></td>
		<td><?=$list[$i]["send_name"]?></td>
		<td><a href="<?=$list[$i]["Url_view"]?>"><?if($mode=="SAVE"){ echo $list[$i]["save_time"]; }else{ echo $list[$i]["send_time"]; }?></a></td>
	<?if($mode=="RECV") { ?>
		<td><a href="<?=$list[$i]["Url_view"]?>"><?=$list[$i]["read_time"]?></a></td>
	<? } ?>
		<td><a href="javascript:deleteChk('<?=$list[$i]["Url_dele"]?>')">[삭제]</a> <?if($mode!="SAVE") { ?><a href="javascript:saveChk('<?=$list[$i]["Url_save"]?>')">[저장]</a><?}?></td>
	</tr>
	<tr><td height="1" bgcolor="#F1F1F1" colspan="5"></td></tr>
<? } ?>
<? if($i==0) { ?>
	<tr height="28" align="center">
		<td height="80" valign="center" colspan="5"><?=$Page_Title?> 쪽지가 없습니다.</td>
	</tr>
<? } ?>
	<tr><td height="2" bgcolor="#086CC0" colspan="5"></td></tr>
	<tr height="28" align="center">
		<td height="30" valign="center" colspan="5"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?mode=$mode&page=");?></td>
	</tr>
</table>