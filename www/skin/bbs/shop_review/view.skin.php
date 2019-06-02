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
	return true;
}
function deleteChk(url) {
	yes_no = confirm('삭제하시면 다시 복구하실 수 없습니다.\n\n삭제하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때
		if(url==true) {
		} else {
			location.href='<?=$Url["delete"]?>&it_id=<?=$it_id?>';
		}
	}
}
function ComdeleteChk(url) {
	yes_no = confirm('삭제하시면 다시 복구하실 수 없습니다.\n\n삭제하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때
		location.href=url;
	}
}
function CommodifyChk(tbl,num,cnum) {
	yes_no = confirm('수정하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때
		window.open("commodify.php?tbl="+tbl+"&num="+num+"&cnum="+cnum,"commodify","width=600,height=170").focus();
		//var sub = document.getElementById("iframe_commodify").contentWindow.document;
		//sub.location.href=url;
	}
}
</script>

<div id="mainContent">
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
			<td colspan="3"><strong><?=$view["category"]?><?=$view["subject"]?></strong></td>
		</tr>
		<tr>
			<th>작성자</th>
			<td>
			<?
			// 특정게시판에서는 작성자로 이름이아닌 아이디를 출력한다.
			if ( $Table=="shop_review" or $Table=="shop_qna" or $Table=="contact" ) {
				if ( empty($view["b_member"]) ) {
					echo $view["b_writer"];	// 아이디가 공백이라면 기본값
					}
					else {
					echo $view["b_member"];	// 아이디 출력
					}
				}
				// 아이디를 출력할 게시판일 아닐 경우 작성자 이름을 출력한다.
				else {
				echo $view["b_writer"];
				}
			?>
			</td>
			<th>작성일</th>
			<td><?=$view["b_regist"]?></td>
		</tr>
		<!--
		<tr>
			<td>이메일</td>
			<td><?=$view["b_email"]?></td>
			<td>수정일</td>
			<td><?=$view["b_modify"]?></td>
		</tr-->
		<? if($linkUrl==TRUE) { ?>
		<tr>
			<th>링크</th>
			<td colspan="3"><?=$linkUrl?></td>
		</tr>
		<? } ?>
		<? if($downTag==TRUE) { ?>
		<tr>
			<th>첨부파일</th>
			<td colspan="3"><?=$downTag?></td>
		</tr>
		<? } ?>
		<!-- <tr>
			<td colspan="4" style="padding:10px"><?//=$imgFile?></td>
		</tr> -->
		<tr>
			<td colspan="4" style="padding:10px" id="DivContents">
			<?=nl2br(html_entity_decode(str_replace("&nbsp;","　",str_replace("<br />","",$view["content"]))))?>
			</td>
		</tr>
	</tbody>
	</table>
	<table width="100%">
		<tr>
			<td>
				<div class="shop_bd_btn" style="float:right;">
					<? if($Url["list"]==TRUE) { ?>
					<a href="javascript:history.back(-1);"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif"></a>
					<!-- <a href="<?=$Url["list"]?>&it_name=<?=$_GET[it_name]?>&it_id=<?=$it_id?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif"></a> -->
					<? } ?>
					<? if($Url["modify"]==TRUE) { ?>
					<a href="<?=$Url["modify"]?>&it_id=<?=$it_id?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_modify.gif"></a>
					<? } ?>
					<? if($Url["delete"]==TRUE) { ?>
					<a href="javascript:deleteChk();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif"></a>
					<? } ?>
					<? if($Url["reply"]==TRUE) { ?>
					<a href="<?=$Url["reply"]?>&it_id=<?=$view[b_ex2]?>&it_name=<?=$view[b_ex3]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_reply.gif"></a>
					<? } ?>
					<? if( ($Url["write"]==TRUE) && ($_SESSION["sess"]["userlevel"]<=90) )
					{ ?>
					<a href="<?=$Url["write"]?>&it_id=<?=$it_id?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif"></a>
					<? } ?>
				</div>
			<td>
		</tr>
	</table>

</div>

<!--
<table width="<?=$Board_Admin["width"]?>" border="0" cellpadding="10" cellspacing="0" align="center">
	<col width="60">
	<col width="">
	<tr><td colspan="3" style="border-top:1px solid #cccccc;"></td></tr>
	<tr>
		<td style="border-right:1px solid #cccccc;">이전글</td>
	<td>
	<?=$Url["pre_subject"]?></td>
	</tr>
	<tr><td colspan="3" style="border-top:1px solid #cccccc;"></td></tr>
	<tr>
		<td style="border-right:1px solid #cccccc;">다음글</td>
		<td>
		<?
			/*
			if($_GET[it_id]==$view[b_ex2]) {
				echo $Url["next_subject"];
			}
			*/
		?>
		<?=$Url["next_subject"]?>
		</td>
	</tr>
	<tr><td colspan="3" style="border-top:1px solid #cccccc;"></td></tr>
</table>
-->

<? if($comm_total>0) { ?>
<!-- 댓글목록 여기부터 -->
<table width="<?=$Board_Admin["width"]?>" border="0" cellpadding="3" cellspacing="1" bgcolor="#E1E1E1" align="center" style="table-layout:fixed;">
	<? for ($i=0; $i<$comm_total; $i++) { ?>
	<tr bgcolor="#F9F9F9">
		<td colspan="2" style="padding-left:8px;" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td><?=$comm[$i]["reicon"]?><strong><?=$comm[$i]["c_writer"]?></strong>&nbsp;&nbsp;<?=$comm[$i]["regist"]?>&nbsp;&nbsp;<a href="javascript:;" onclick="menu('comment2_<?=$i?>');"><img src="<?=$Board_Admin["skin_dir"]?>/images/icon_2.jpg">답글</a></td>
				</tr>
				<tr>
					<td style="word-break:break-all;" <?=$comm[$i]["reicon2"]?>><?=nl2br($comm[$i]["content"])?>
					<? if($comm[$i]["comedit"]==TRUE){?><img src="<?=$Board_Admin["skin_dir"]?>/images/icon_m.gif" border="0" onclick="menu('comment_<?=$i?>');" style="cursor:hand"><? }?>
					<? if($comm[$i]["comdele"]==TRUE){?><img src="<?=$Board_Admin["skin_dir"]?>/images/icon_x.gif" border="0" onclick="ComdeleteChk('<?=$comm[$i]["comdele"]?>');" style="cursor:hand"><? }?>&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr id="comment_<?=$i?>" style="display:none;">
		<td colspan="2">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#f8f8f8" align="center">
				<col width="100" />
				<col width="" />
				<col width="200" />
				<form name="writeform_<?=$i?>" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
				<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
				<input type="hidden" name="mode" value="COMMODIFY" />
				<input type="hidden" name="tbl" value="<?=$Table?>" />
				<input type="hidden" name="c_no" value="<?=$comm[$i]["c_no"]?>">
				<input type="hidden" name="c_bno" value="<?=$comm[$i]["c_bno"]?>" />
				<input type="hidden" name="c_tno" value="<?=$comm[$i]["c_tno"]?>" />
				<input type="hidden" name="c_dep" value="<?=$comm[$i]["c_dep"]?>" />
				<input type="hidden" name="c_member" value="<?=$_SESSION["userid"]?>" />
				<input type="hidden" name="category" value="<?=$category?>" />
				<input type="hidden" name="findType" value="<?=$findType?>" />
				<input type="hidden" name="findword" value="<?=$findword?>" />
				<input type="hidden" name="sort1" value="<?=$sort1?>" />
				<input type="hidden" name="sort2" value="<?=$sort2?>" />
				<input type="hidden" name="page" value="<?=$page?>" />
				<input type="hidden" name="c_member" value="<?=$comm[$i]["c_member"]?>" />
				<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
				<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
				<tr>
					<td height="35"><div align="center"><strong>작성자</strong></div></td>
					<td align="left"><input name="c_writer" type="text" style="color:#666666; height:19; font-size:9pt;" size="23" class="text" value="<?=$comm[$i]['c_writer']?>"></td>
					<td style="padding-right:10px" align="right"><? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666; height:19; font-size:9pt;" size="23" class="text"><?}?>&nbsp;</td>
				</tr>
				<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
				<tr>
					<td  valign="top" align="center"><b>내용</b></td>
					<td height="16" colspan="2"><textarea name="c_content" style="width:98%; color:#666666; height:50; font-size:9pt;" class="text">&nbsp;&nbsp;<?=stripslashes($comm[$i]['c_content'])?></textarea></td>
				</tr>
				<tr>
					<td colspan="3" align="center" valign="middle">
						상업성 글이나 욕설등은 임의로 삭제 될 수 있습니다.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" border="0" align="absmiddle">
					</td>
				</tr>
				<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
				</form>
			</table>
		</td>
	</tr>
	<tr id="comment2_<?=$i?>" style="display:none;">
		<td colspan="2">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#f8f8f8" align="center">
				<col width="100" />
				<col width="" />
				<col width="200" />
				<form name="writeform_<?=$i?>" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
				<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
				<input type="hidden" name="mode" value="COMFORM" />
				<input type="hidden" name="tbl" value="<?=$Table?>" />
				<input type="hidden" name="c_no" value="<?=$comm[$i]["c_no"]?>">
				<input type="hidden" name="c_bno" value="<?=$comm[$i]["c_bno"]?>" />
				<input type="hidden" name="c_tno" value="<?=$comm[$i]["c_tno"]?>" />
				<input type="hidden" name="c_dep" value="<?=$comm[$i]["c_dep"]?>" />
				<input type="hidden" name="c_member" value="<?=$_SESSION["userid"]?>" />
				<input type="hidden" name="category" value="<?=$category?>" />
				<input type="hidden" name="findType" value="<?=$findType?>" />
				<input type="hidden" name="findword" value="<?=$findword?>" />
				<input type="hidden" name="sort1" value="<?=$sort1?>" />
				<input type="hidden" name="sort2" value="<?=$sort2?>" />
				<input type="hidden" name="page" value="<?=$page?>" />
				<input type="hidden" name="c_member" value="<?=$comm[$i]["c_member"]?>" />
				<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
				<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
				<tr>
					<td height="35"><div align="center"><strong>작성자</strong></div></td>
					<td align="left"><input name="c_writer" type="text" style="color:#666666; height:19; font-size:9pt;" size="23" value="<?=$_SESSION["username"]?>" class="text"></td>
					<td style="padding-right:10px" align="right"><? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666; height:19; font-size:9pt;" size="23" class="text"><?}?>&nbsp;</td>
				</tr>
				<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
				<tr>
					<td  valign="top" align="center"><b>내용</b></td>
					<td height="16" colspan="2"><textarea name="c_content" style="width:98%; color:#666666; height:50; font-size:9pt;" class="text"></textarea></td>
				</tr>
				<tr>
					<td colspan="3" align="center" valign="middle">
						상업성 글이나 욕설등은 임의로 삭제 될 수 있습니다.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" border="0" align="absmiddle">
					</td>
				</tr>
				<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
				</form>
			</table>
		</td>
	</tr>
	<? } ?>
</table>
<!-- 댓글목록 여기까지 -->
<br>
<? } ?>

<? if($Board_Admin["use_comment"]==TRUE) { ?>
<!-- 댓글작성 여기부터 -->
<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" class="viewlist">
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
	<col width="100" />
	<col width="" />
	<col width="200" />
	<tbody>
	<tr>
		<th>작성자</th>
		<td><input name="c_writer" type="text" style="color:#666666; height:19; font-size:9pt;" size="23" class="text" value="<?=$_SESSION["nickname"]?>"></td>
		<td><? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666; height:19; font-size:9pt;" size="23" class="text"><?}?>&nbsp;</td>
	</tr>
	<tr>
		<th>내용</th>
		<td colspan="2"><textarea name="c_content" style="width:98%; color:#666666; height:50; font-size:9pt;" class="text"></textarea></td>
	</tr>
	<tr>
		<td colspan="3">상업성 글이나 욕설등은 임의로 삭제 될 수 있습니다.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" border="0" align="absmiddle"></td>
	</tr>
	</tbody>
</form>
</table>
<!-- 댓글작성 여기까지 -->
<? } ?>


<script>
function imgResize() {
	// DivContents 영역에서 이미지가 maxsize 보다 크면 자동 리사이즈 시켜줌
	maxsize = <?=($Board_Admin["imgsize"]=="")?"500":$Board_Admin["imgsize"];?>; // 가로사이즈 ( 다른값으로 지정하면됨)
	var content = document.getElementById("DivContents");
	var img = content.getElementsByTagName("img");
	for(i=0; i<img.length; i++) {
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