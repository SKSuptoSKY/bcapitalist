
<script language="javascript">
function writeChk(form) {
	if(!form.c_writer.value) {
		alert("댓글작성자를 입력하세요");
		form.c_writer.focus();
		return;
	}
	if(!form.c_content.value) {
		alert("댓글내용을 입력하세요");
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

function CommodifyChk(tbl,num,cnum) {
	yes_no = confirm('수정하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때
		window.open("commodify.php?tbl="+tbl+"&num="+num+"&cnum="+cnum,"commodify","width=600,height=170").focus();
		//var sub = document.getElementById("iframe_commodify").contentWindow.document;
		//sub.location.href=url;
	}
}

</script>
<style type="text/css">
img { border:0; }
.tit {font-weight:bold;color:#444444;text-align:center; }
.bottom_line { border-bottom:1px solid #EAEAEA; }
.bottom_line2 { border-bottom:1px solid #444444; padding-bottom:3px;}
.bbs_top li{float:left; background:url(/images/bar.jpg) 0 55% no-repeat; padding-left:15px; margin-left:15px;  }
.bbs_top li.bg_none{background:none; margin-left:0; padding-left:20px; }
.bbs_btn{width:90px; height:30px; background:#ffffff; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:30px; display:inline-block;}
</style>



<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="2" bgcolor="#555" colspan="6"></td>
  </tr>
  <tr height="45" >
    <td height="45" colspan="6" align="left" style="padding:5px 20px 5px 20px; font-size:14px; color:#333; word-break:break-all;">
      <strong><?=$view["category"]?>
      <?=$view["subject"]?></strong>
    </td>
  </tr>
  <tr>
    <td height="1" bgcolor="#dcdcdc" colspan="6"></td>
  </tr>
   <tr height="40" >
    <td height="40" colspan="6">
		<ul class="bbs_top clfix">
			<li class="bg_none"><em class="tit">글쓴이</em><span style="padding-left:10px;word-break:break-all;"> <?=$view["b_writer"]?></span></li>
			<li><em class="tit">작성일</em><span style="padding-left:10px;word-break:break-all;"> <?=$view["b_regist"]?></span></li>
			<li><em class="tit">조회수</em><span style="padding-left:10px;word-break:break-all;"> <?=$view["b_hit"]?></span></li>
		</ul>
	</td>
  </tr>

  <? if($linkUrl==TRUE) { ?>
	<!--
  <tr>
    <td height="1" bgcolor="#dcdcdc" colspan="6"></td>
  </tr>
  <tr height="35" >
    <td height="35" class="tit">링크</td>
    <td width="1%" height="35" valign="top"> </td>
    <td height="35" colspan="4" align="left" style="padding-left:10px;">
      <?=$linkUrl?>
    </td>
  </tr>
	-->
  <? } ?>
  <? if($downTag==TRUE) { ?>
  <tr>
    <td height="1" bgcolor="#dcdcdc" colspan="6"></td>
  </tr>
  <tr height="40" >
    <td height="40"  colspan="6">
		<em class="tit" style="background:url(/images/bar.jpg) 100% 55% no-repeat; padding:0 15px 0 20px">첨부파일</em>
		<span style="padding-left:10px;word-break:break-all;"><?=$downTag?></span>
    </td>
  </tr>
  <? } ?>
  <tr>
    <td height="1" bgcolor="#aaaaaa" colspan="6"></td>
  </tr>
  <tr >
    <td height="15" colspan="6"></td>
  </tr>
  <tr>
    <td colspan="6"> <?=$imgFile?></td>
  </tr>
  <tr>
    <td colspan="6">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #ddd;">
            <tr>
                <td  style="word-break:break-all;padding:15px;">
					<div id="DivContents" style="line-height:1.6;word-break:break-all;">
					<?=$view["content"]?>
					</div>
            	</td>
            </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td height="5" colspan="6"></td>
  </tr>
  <tr>
    <td height="40" colspan="6" align="right">
      <? if($Url["best"]==TRUE) { ?>
      <a href="<?=$Url["best"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_boomup.gif"></a>
      <? } ?>
      <? if($Url["admin"]==TRUE) { ?>
      <a href="<?=$Url["admin"]?>"><div class="bbs_btn">관리모드</div></a>
      <? } ?>
      <? if($Url["list"]==TRUE) { ?>
      <a href="<?=$Url["list"]?>"><div class="bbs_btn">목록</div></a>
      <? } ?>
      <? if($Url["modify"]==TRUE) { ?>
      <a href="<?=$Url["modify"]?>"><div class="bbs_btn">수정</div></a>
      <? } ?>
      <? if($Url["delete"]==TRUE) { ?>
      <a href="javascript:deleteChk();"><div class="bbs_btn">삭제</div></a>
      <? } ?>
      <? if($Url["reply"]==TRUE) { ?>
      <a href="<?=$Url["reply"]?>"><div class="bbs_btn">답글쓰기</div></a>
      <? } ?>
      <? if($Url["write"]==TRUE) { ?>
      <a href="<?=$Url["write"]?>"><div class="bbs_btn">글쓰기</div></a>
      <? } ?>
    </td>
  </tr>
</table>
<br>

<? if($comm_total>0) { ?>
<!-- 댓글목록 여기부터 -->
<!-- 새로 -->
<table width="<?=$Board_Admin["width"]?>" border="0" align="center">
	<tr>
		<td class="bottom_line2"><strong style="padding-left:15px; color:#333">댓글 <span style="font:size:9pt; color:#0d00bd;"><?=$comm_total?>개</span></strong></td>
	</tr>
	<? for ($i=0; $i<$comm_total; $i++) { ?>
	<!-- 리스트 부분 -->
	<tr>
		<td class="bottom_line">
			<table width="100%" border="0">
				<tr>
					<td style="padding:10px; word-break:break-all;" align="left">
						<div style="float:left;"><?=$comm[$i]["reicon2"]?></div>
						<div style="float:left; padding-left:5px; padding-right:20px;">
							<strong style="color:#333"><?=$comm[$i]["c_writer"]?></strong>
						</div>
						<div style="width:*; float:left;">
							<?
							// 비밀글
							// 비밀글 사용
							if($comm[$i]["c_ex10"]=="1") {
								if ($_SESSION[userid] == $comm[$i]["c_member"]  || $_SESSION[userid] == $view["b_member"] || $_SESSION[userid] == $comm[$i]["TopCom_writer"]) {
									?>
									<?=nl2br($comm[$i]["content"])?>
									<span style="color:#0d00bd;padding-left:10px;cursor:pointer;" onclick="menu('comment2_<?=$i?>');">댓글</span>
									<?
								} else {
									echo "비밀글 입니다.";
								}
							// 공개글
							} else {
								?>
								<?=nl2br($comm[$i]["content"])?>
								<span  style="color:#0d00bd;padding-left:10px;cursor:pointer;" onclick="menu('comment2_<?=$i?>');">댓글</span>
								<?
							}
							?>
							<? if($comm[$i]["comedit"]==TRUE){?>
							/<span  style="color:#0d00bd; padding-left:3px;cursor:pointer;" onclick="menu('comment_<?=$i?>');">수정</span><? }?>
							<? if($comm[$i]["comdele"]==TRUE){?>
							/<span  style="color:#0d00bd;padding-left:3px;cursor:pointer;" onclick="ComdeleteChk('<?=$comm[$i]["comdele"]?>');">삭제</span>
							<? }?>&nbsp;
						</div>
					</td>
					<td width="150"><span style="font-size:10pt; color:#B4B4B4;"><strong><?=$comm[$i]["regist"]?></strong></span></td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- 리스트 부분 -->
	<!-- 글 입력부 -->
	<tr id="comment_<?=$i?>" style="display:none;">
        <td colspan="2">
            <table width="110%" border="0" cellspacing="0" cellpadding="2" bgcolor="#fdfdfd" align="center" style="border-top:1px solid #333;border-right:1px solid #ddd;border-left:1px solid #ddd;border-bottom:1px solid #ddd;">
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
                <tr>
                    <td height="40"><div align="center" style="display:block;line-height:40px;vertical-align:middle;padding:5px;"><strong>작성자</strong></div></td></td>
					<td align="left" colspan="2">
					<input name="c_writer" type="text" style="padding-top:4px;color:#666666;font-size:10pt;border:1px solid #B4B4B4;" size="23" class="text" value="<?=$_SESSION["nickname"]?>">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666;background:#fff; height:21px; border:1px solid #B4B4B4;" size="23" class="text"><?}?>
						&nbsp;<span style='font-weight:bold;'>비밀로하기</span> <input type="checkbox" name="c_ex10" value="1"	style="vertical-align:middle;border:0;" align="absmiddle">
					</td>
                </tr>
				<tr ><td style="border-top:2px solid #dddddd;" height="1" colspan="3"></td></tr>
                <tr>
                    <td width="20%"  height="40" valign="top" align="center" style="padding-top:10px;"><b>내용</b></td>
                    <td height="40" valign="top" style="padding-top:10px;">
						<textarea name="c_content" style="width:500px; color:#666666; height:100px; padding:5px; font-size:9pt; border:1px solid #B4B4B4;" class="text"><?=stripslashes($comm[$i]['c_content'])?></textarea>
					</td><td width="10%"  height="40" valign="middle" align="left" style="padding:10px;">
						<input type="submit" value="댓글쓰기" style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">
					</td>

                </tr>
				<tr>
					<td colspan="3" align="center" valign="middle">
						<p style="font-size:10pt; color:#325f95; font-weight:700; padding:10px 0 8px 0;">* 상업성 글이나 욕설등은 임의로 삭제 될 수 있습니다.</p>
					</td>
				</tr>
                <tr ><td style="border-bottom:2px solid #dddddd;" height="1" colspan="3"></td></tr>
                </form>
            </table>
        </td>
    </tr>
	<tr id="comment2_<?=$i?>" style="display:none;">
        <td colspan="2">
            <table width="110%" border="0" cellspacing="0" cellpadding="2" bgcolor="#fdfdfd" align="center" style="border-top:1px solid #333;border-right:1px solid #ddd;border-left:1px solid #ddd;border-bottom:1px solid #ddd;">
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
                <!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
                <tr>
					<td width="20%" height="40"><div align="center" style="display:block;line-height:40px;vertical-align:middle;padding:5px;"><strong>작성자</strong></div></td></td>
                   <td align="left" colspan="2">
					<input name="c_writer" type="text" style="padding-top:4px;color:#666666;font-size:10pt;border:1px solid #B4B4B4;" size="23" class="text" value="<?=$_SESSION["nickname"]?>">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666;background:#fff; height:21px; border:1px solid #B4B4B4;" size="23" class="text"><?}?>
						&nbsp;<span style='font-weight:bold;'>비밀로하기</span> <input type="checkbox" name="c_ex10" value="1"	style="vertical-align:middle;border:0;" align="absmiddle">
					</td>
                </tr>
				<tr ><td style="border-top:2px solid #dddddd;" height="1" colspan="3"></td></tr>
				<tr>
					<td width="20%"  height="40" valign="top" align="center" style="padding-top:10px;"><b>내용</b></td>
					<td height="40" valign="top" style="padding-top:10px;">
						<textarea name="c_content" style="width:500px; color:#666666; height:100px; padding:5px; font-size:9pt; border:1px solid #B4B4B4;" class="text"></textarea>
					</td>
					<td width="10%"  height="40" valign="middle" align="left" style="padding:10px;">
					<input type="submit" value="댓글쓰기" style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">
					</td>
                </tr>
				<tr>
					<td colspan="3" align="center" valign="middle">
						<p style="font-size:10pt; color:#325f95; font-weight:700; padding:10px 0 8px 0;">* 상업성 글이나 욕설 등은 임의로 삭제될 수 있습니다.</p>
					</td>
				</tr>
				<tr ><td style="border-bottom:2px solid #dddddd;" height="1" colspan="3"></td></tr>
                </form>
            </table>
        </td>
    </tr>

	<!-- 글 입력부 끝 -->
	<? } ?>
</table>
<!-- <table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center" colspan="2"><?=$c_PageLinks2?></td>
	</tr>
</table> -->
<!-- 댓글목록 여기까지 -->
<? } ?>
<?include_once("./sns_share.php");?>
<br>
<br>
<? if($Board_Admin["use_comment"]==TRUE) { ?>
<!-- 댓글작성 여기부터 -->
<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#fefefe" style="border-top:1px solid #333;border-right:1px solid #ddd;border-left:1px solid #ddd;border-bottom:1px solid #ddd;">
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
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
	<tr>
		<td width="20%" height="40"><div align="center" style="display:block;line-height:40px;vertical-align:middle;padding-top:5px;"><strong>작성자</strong></div></td>
		<td align="left" colspan="2">
			<input name="c_writer" type="text" style="padding-top:4px;color:#666666;font-size:10pt;border:1px solid #B4B4B4;" size="23" class="text" value="<?=$_SESSION["nickname"]?>">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666;background:#fff; height:20px; border:1px solid #B4B4B4;" size="23" class="text"><?}?>
			&nbsp;<span style='font-weight:bold;'>&nbsp;&nbsp;&nbsp;&nbsp;비밀로하기</span> <input type="checkbox" name="c_ex10" value="1" style="vertical-align:middle;border:0;" align="absmiddle">
		</td>
	</tr>
	<tr ><td style="border-top:1px solid #dddddd;" height="1" colspan="3"></td></tr>
	<tr>
		<td width="20%"  height="40" valign="top" align="center" style="padding-top:10px;"><b>내용</b></td>
		<td height="40" valign="top" style="padding-top:10px;">
			<textarea name="c_content" style="width:500px; color:#666666; height:100px; padding:5px; font-size:9pt; border:1px solid #B4B4B4;" class="text"></textarea>
		</td>
		<td width="15%"  height="40" valign="middle" align="center" style="padding-top:10px;"><input type="submit" value="댓글쓰기" style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;"></td>
	</tr>
	<tr>
		<td colspan="3" align="center" valign="middle">
			<p style="font-size:10pt; color:#325f95; font-weight:700; padding:10px 0 8px 0;">* 상업성 글이나 욕설등은 임의로 삭제 될 수 있습니다.</p>
		</td>
	</tr>
</form>
</table>
<!-- 댓글작성 여기까지 -->
<? } ?>
<br>
<br>

<?if($Board_Admin["view_list"] == FALSE){?>
<table width="<?=$Board_Admin["width"]?>" border="0" cellpadding="0" cellspacing="0" align="center">
	<colgroup>
		<col width="13%">
		<col width="87%">
	  </colgroup>
	<tr>
		<td height="40" align="center" style="font-weight:bold;border-top:2px solid #555;" class="tit">이전글</td>
		<td style="padding-left:20px;border-top:2px solid #555; background:url(/images/bar.jpg) 0 55% no-repeat;"><?=$Url["pre_subject"]?></td>
	</tr>
	<tr>
		<td height="40" align="center" style="font-weight:bold;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;" class="tit">다음글</td>
		<td style="padding-left:20px;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc; background:url(/images/bar.jpg) 0 55% no-repeat;"><?=$Url["next_subject"]?></td>
	</tr>
</table>
<br>
<?}?>

<script>
function imgResize()
{
    // DivContents 영역에서 이미지가 maxsize 보다 크면 자동 리사이즈 시켜줌
    maxsize = <?=($Board_Admin["imgsize"]=="")?"500":$Board_Admin["imgsize"];?>; // 가로사이즈 ( 다른값으로 지정하면됨)
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