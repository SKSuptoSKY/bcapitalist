<?
////////// 게시판 쓰기 페이지 추가코드 여기부터 //////////////////////////

////////// 게시판 쓰기 페이지 추가코드 여기까지 //////////////////////////

/*///// 게시판 변수 안내
스킨경로 : $Board_Admin["skin_dir"]
게시판 너비 : $Board_Admin["width"]
////// 게시판 변수 안내*/
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
//form.submit();
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

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr bgcolor="#496386"><td height="2" colspan="6"></td></tr>
	<tr>
		<td width="14%" height="33" class="r_tt">제목</td>
		<td width="1%"><font color="#e4e0dc">|</font>&nbsp;&nbsp;</td>
		<td width="50%" style="padding-left:5px;"><?=$view["category"]?> <?=$view["subject"]?></td>
		<td width="14%" class="r_tt">조회수</td>
		<td width="1%"><font color="#e4e0dc">|</font>&nbsp;&nbsp;</td>
		<td width="30%"><?=$view["b_hit"]?></td>
	</tr>
	<tr><td height="1" colspan="6" bgcolor="#e4e0dc"></td></tr>
	<tr>
		<td height="33" class="r_tt">글쓴이</td>
		<td width="1%"><font color="#e4e0dc">|</font>&nbsp;&nbsp;</td>
		<td><?=$view["b_writer"]?></td>
		<td class="r_tt">작성일</td>
		<td width="1%"><font color="#e4e0dc">|</font>&nbsp;&nbsp;</td>
		<td><?=$view["b_regist"]?></td>
	</tr>
	<!--
	<tr><td height="1" colspan="6" bgcolor="#e4e0dc"></td></tr>
	<tr height="28" align="center">
		<td  width="120" height="25" bgcolor="#F6F6F6"><img src="<?=$Board_Admin["skin_dir"]?>/images/v4.gif"></td>
		<td align="left" style="padding-left:5px;"><?=$view["b_email"]?></td>
		<td  width="120" bgcolor="#F6F6F6"><img src="<?=$Board_Admin["skin_dir"]?>/images/v5.gif"></td>
		<td align="left" style="padding-left:5px;"><?=$view["b_modify"]?></td>
	</tr>-->
	<? if($linkUrl==TRUE) { ?>
	<!--<tr><td height="1" colspan="6" bgcolor="#e4e0dc"></td></tr>
	<tr height="28" align="center">
		<td  width="120" height="25" bgcolor="#F6F6F6">링크</td>
		<td colspan="3" align="left" style="padding-left:5px;"><?=$linkUrl?></td>
	</tr>-->
	<? } ?>
	<? if($downTag==TRUE) { ?>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="6"></td></tr>
	<tr  align="center">
		<td height="22" bgcolor="#F6F6F6"><div align="right"><img src="<?=$Board_Admin["skin_dir"]?>/images/v6.gif"></div></td>
		<td  colspan="3" align="left" style="padding-left:5px;"><?=$downTag?></td>
	</tr>
	<? } ?>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="6"></td></tr>
	<tr><td height="15" colspan="6"></td></tr>
	<tr>
		<td colspan="6" style="padding:10px">
		<?=$imgFile?>
		<?=$view["content"]?>
	</td>
	</tr>
	<tr><td height="15" colspan="6"></td></tr>
	<tr bgcolor="#496386"><td height="1" colspan="6"></td></tr>
	<tr>
		<td height="40" colspan="6" align="right">
			<? if($Url["best"]==TRUE) { ?><a href="<?=$Url["best"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_boomup.gif"></a><? } ?>
			<!-- <? if($Url["admin"]==TRUE) { ?><a href="<?=$Url["admin"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_admin.gif"></a><? } ?> -->
			<? if($Url["list"]==TRUE) { ?><a href="<?=$Url["list"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif"></a><? } ?>
			<? if($Url["modify"]==TRUE) { ?><a href="<?=$Url["modify"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_modify.gif"></a><? } ?>
			<? if($Url["delete"]==TRUE) { ?><a href="javascript:deleteChk();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif"></a><? } ?>
			<? if($Url["reply"]==TRUE) { ?><a href="<?=$Url["reply"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_reply.gif"></a><? } ?>
			<? if($Url["write"]==TRUE) { ?><a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif"></a><? } ?>
		</td>
	</tr>
</table>
<br>

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
<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="2" bgcolor="#FAFAFA" align="center">
<col width="100" />
<col width="" />
<col width="200" />
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
	<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
	<tr>
		<td height="35"><div align="center"><strong>작성자</strong></div></td>
		<td align="left"><input name="c_writer" type="text" style="color:#666666; height:19; font-size:9pt;" size="23" class="text" value="<?=$_SESSION["nickname"]?>"></td>
		<td style="padding-right:10px" align="right"><? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666; height:19; font-size:9pt;" size="23" class="text"><?}?>&nbsp;</td>
	</tr>
	<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
	<tr>
		<td valign="top" align="center"><b>내용</b></td>
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
<!-- 댓글작성 여기까지 -->
<? } ?>
<br>