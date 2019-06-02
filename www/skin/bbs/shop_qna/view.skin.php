<?
////////// 게시판 쓰기 페이지 추가코드 여기부터 //////////////////////////
?>

<script type="text/javascript">
var initBody
function beforePrint(){
	initBody = document.body.innerHTML;
	document.body.innerHTML = idPrint.innerHTML;
}
function afterPrint(){
	document.body.innerHTML = initBody;
}
window.onbeforeprint = beforePrint;
window.onafterprint = afterPrint;

function printArea(){
	window.print();
}
</script>

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
			location.href='<?=$Url["delete"]?>';
		}
	}
}
function ComdeleteChk(url) {
	yes_no = confirm('삭제하시면 다시 복구하실 수 없습니다.\n\n삭제하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때
		location.href=url;
	}
}
</script>



<table  width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td colspan="4">

<!-- <a href="/bbs/board.php?tbl=shop_qna" onfocus="this.blur()"><img src="/images/tabbbs/tab1_o.jpg"  border="0"/></a>  &nbsp;
<a href="/bbs/board.php?tbl=bbs52" onfocus="this.blur()"><img src="/images/tabbbs/tab2.jpg" onmouseover="src='/images/tabbbs/tab2_o.jpg'" onmouseout="src='/images/tabbbs/tab2.jpg'"  border="0"/></a> -->


</td></tr>
<tr><td height="20"></td></tr>
</table>



<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" class="shop_boardlist">
	<caption></caption>
	<col width="15%" />
	<col width="35%" />
	<col width="15%" />
	<col width="35%" />
	<tbody>
		<tr>
			<th>상품명</th>
			<td colspan="3"><?=get_it_name($view["b_ex2"],"SHOP")?></td>
		</tr>
		<tr>
			<th>제목</th>
			<td colspan="3"><?=$view["category"]?> <?=$view["subject"]?></td>
		</tr>
		<tr>
			<th>작성자</th>
			<td><?=$view["b_writer"]?></td>
			<th>작성일</th>
			<td><?=$view["b_regist"]?></td>
		</tr>
		<? if($linkUrl==TRUE) { ?>
		<tr height="30">
			<th>링크</th>
			<td colspan="3"><?=$linkUrl?></td>
		</tr>
		<? } ?>
		<? if($downTag==TRUE) { ?>
		<tr height="30">
			<th>첨부파일</th>
			<td colspan="3"><?=$downTag?></td>
		</tr>
		<? } ?>
		<tr>
			<td colspan="4" style="padding:10px" id="DivContents">
			<?=nl2br(html_entity_decode(str_replace("&nbsp;","　",str_replace("<br />","",$view["content"]))))?>
			</td>
		</tr>
	<tr>
</tbody>
</table>


<div class="shop_bd_btn">
	<div class="admin">
		<!-- <? if($Url["admin"]==TRUE) { ?><a href="<?=$Url["admin"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_admin.gif"></a>&nbsp;<? } ?> -->
	</div>
	<div style="float:right;">
		<? if($Url["list"]==TRUE) { ?><a href="javascript:history.back(-1);"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif"></a>&nbsp;<? } ?>
		<!-- <? if($Url["list"]==TRUE) { ?><a href="<?=$Url["list"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif"></a>&nbsp;<? } ?> -->
		<?if($Table == "shop_qna"){?>
		<? if($Url["admin"]==TRUE) { ?>
		<? if($Url["delete"]==TRUE) { ?><a href="javascript:deleteChk();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif"></a>&nbsp;<? } ?>
		<?}?>
	<?}else{?>
		<? if($Url["modify"]==TRUE) { ?><a href="<?=$Url["modify"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_modify.gif"></a>&nbsp;<? } ?>
		<? if($Url["delete"]==TRUE) { ?><a href="javascript:deleteChk();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif"></a>&nbsp;<? } ?>
		<? if($Url["reply"]==TRUE) { ?><a href="<?=$Url["reply"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_reply.gif"></a>&nbsp;<? } ?>
		<? if($Url["write"]==TRUE) { ?><a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif"></a><? } ?>
	<?}?>
	</div>
</div>
<br /><br />
<? if($comm_total>0) { ?>
<!-- 댓글목록 여기부터 -->
<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" class="shop_coment_tb">
	<? for ($i=0; $i<$comm_total; $i++) { ?>
	<tr>
		<th width="80" rowspan="2"><strong><?=$comm[$i]["c_writer"]?></strong></th>
		<td width="*" style="border-bottom:1px solid #e1e1e1;"><a href='javascript:;' onclick="menu('com<?=$i?>')"><?=$comm[$i]["subject"]?></a></td>
		<td width="80" rowspan="2">
		<? if($comm[$i]["combest"]==TRUE) { ?>추천 : <?=$comm[$i]["c_best"]?><br>
		<a href="<?=$comm[$i]["combest"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/icon_u.gif"></a><? } ?>
		<?if($comm[$i]["comdele"]==TRUE){?>
		<img src="<?=$Board_Admin["skin_dir"]?>/images/icon_x.gif" border="0" onclick="ComdeleteChk('<?=$comm[$i]["comdele"]?>');" style="cursor:hand"><?}?>
		</td>
	</tr>
	<tr>
		<td id='com<?=$i?>' style='display:none;'><?=$comm[$i]["content"]?></td>
	</tr>
	<? } ?>
</table>
<!-- 댓글목록 여기까지 -->
<br>
<? } ?>

<? if($Board_Admin["use_comment"]==TRUE) { ?>
<!-- 댓글작성 여기부터 -->
<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" class="shop_coment_tb">
<form name="writeform" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="mode" value="COMFORM">
<input type="hidden" name="tbl" value="<?=$Table?>">
<input type="hidden" name="c_bno" value="<?=$view["b_no"]?>">
<input type="hidden" name="c_member" value="<?=$_SESSION["userid"]?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="c_member" value="<?=$_SESSION["userid"]?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
	<caption></caption>
	<col width="80px;" />
	<col width="*" />
	<col width="80px" />
	<tbody>
	<tr>
		<th>작성자</th>
		<td><input name="c_writer" type="text" style="color:#666666; height:20px; font-size:9pt;" size="23"  value="<?=$_SESSION["nickname"]?>"></td>
		<td><? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666; height:20px; font-size:9pt;" size="23"><?}?>&nbsp;</td>
	</tr>
	<tr>
		<th>제목</th>
		<td colspan="2"><input name="c_subject" type="text" style="width:98%; color:#666666; height:20px; font-size:9pt;" size="23" class="text"></td>
	</tr>
	<tr>
		<th>내용</th>
		<td colspan="2"><textarea name="c_content" style="width:98%; color:#666666; height:50; font-size:9pt; margin:5px 0;"></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2">※ 상업성 글이나 욕설등은 임의로 삭제 될 수 있습니다.<span style="float:right;"><input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" border="0" align="absmiddle"></span></td>
	</tr>
	</tbody>
</form>
</table>
<!-- 댓글작성 여기까지 -->
<? } ?>
<br>

<script type="text/javascript">
<!--
function exe_ajax(tbl,num){
	if(confirm("정말 적용하시겠습니까?")){
		$.ajax({
			type:'POST',
			url:'./board_ajax.php',
			data:{
				'table':tbl,
				'num':num
			},
			cache: false,
			async:false,
			success:false
		});
	}
}
//-->
</script>

<div id="fb-root"></div>

<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/ko_KR/all.js#xfbml=1&appId=480425908660255";
	fjs.parentNode.insertBefore(js, fjs);
	}
(document, 'script', 'facebook-jssdk'));
</script>

<script>
function imgResize()
{
	// DivContents 영역에서 이미지가 maxsize 보다 크면 자동 리사이즈 시켜줌
	maxsize = "730"; // 가로사이즈 ( 다른값으로 지정하면됨)
	var content = document.getElementById("DivContents");
	var img = content.getElementsByTagName("img");
	for(i=0; i<img.length; i++)
	{
		if ( eval('img[' + i + '].width > maxsize') )
		{
			var heightSize = ( eval('img[' + i + '].height')*maxsize )/eval('img[' + i + '].width') ;
			eval('img[' + i + '].width = maxsize') ;
			eval('img[' + i + '].height = heightSize') ;
		}
	}
	}
window.onload = imgResize;
</script>