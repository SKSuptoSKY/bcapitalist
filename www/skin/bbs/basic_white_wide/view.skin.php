
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

<table cellpadding="0" cellspacing="0" border="0" class="bbs_view">
	<colgroup>
		<col width="100%">
	</colgroup>
	<tr>
		<th>
			<div class="left">
				<p class="title"><?=$view["category"]?> <?=$view["subject"]?></p>
				<p class="con"><?=$view["b_writer"]?> │ <?=date('Y-m-d',strtotime($view["b_regist"]))?> </p>
				<? if($downTag==TRUE) { ?>
				<p class="con"><?=$downTag?></p>
				<? } ?>
			</div>
			<div class="right">
				<p class="title">HIT</p>
				<p class="con"><?=$view["b_hit"]?></p>
			</div>
		</th>
	</tr>
	<?if($Board_Admin[use_view] == "1"){?>
	<tr>
		<td colspan="6"> <?=$imgFile?></td>
	</tr>
	<?}?>
	<tr>
		<td>
    			<div id="DivContents" style="min-height:300px;line-height:1.7;word-break:break-all; padding:0 20px;">
                    <?=$view["content"]?>
                </div>
		</td>
	</tr>
</table>
<!-- admin_btn -->
<div class="admin_btn mt20">
    <? if($Url["admin"]==TRUE) { ?>
	<a href="<?=$Url["admin"]?>"><div class="btn01">관리모드</div></a>
	<? } ?>
    <? if($Url["list"]==TRUE) { ?>
	<a href="<?=$Url["list"]?>"><div class="btn02 md10">목록</div></a>
	<? } ?>
    <? if($Url["modify"]==TRUE) { ?>
	<a href="<?=$Url["modify"]?>"><div class="btn02 md10">수정</div></a>
	<? } ?>
    <? if($Url["delete"]==TRUE) { ?>
	<a href="javascript:deleteChk();"><div class="btn02 md10">삭제</div></a>
	<? } ?>
    <? if($Url["reply"]==TRUE) { ?>
	<a href="<?=$Url["reply"]?>"><div class="btn02 md10">답글쓰기</div></a>
	<? } ?>
    <? if($Url["write"]==TRUE) { ?>
	<a href="<?=$Url["write"]?>"><div class="btn03 md10">글쓰기</div></a>
	<? } ?>	
</div>
<!-- //admin_btn -->

<br>

<? if($comm_total>0) { ?>
<!-- 댓글목록 여기부터 -->
<!-- 새로 -->
<div class="reply mt50">
<p class="title">댓글 <span><?=$comm_total?>개</span></p>
<table cellpadding="0" cellspacing="0" border="0" class="bbs_reply mt10">
	<colgroup>
			<col width="50%">
			<col width="50%">
		</colgroup>
	<? for ($i=0; $i<$comm_total; $i++) { ?>
	<!-- 리스트 부분 -->
	<tr>
		<?php if(strlen($comm[$i]["c_dep"]) == 1){?><th><?php }else{?><td><?php }?>
			<div class="con <?=(strlen($comm[$i]["c_dep"])>1)?"md50":""?>">
				<p><em><?=$comm[$i]["c_writer"]?></em>│<span><?=date("Y.m.d",strtotime($comm[$i]["c_regist"]))?></span></p>
				<p class="mt10">
				<?
							// 비밀글
							// 비밀글 사용
							if($comm[$i]["c_ex10"]=="1") {
								if ($_SESSION[userid] == $comm[$i]["c_member"]  || $_SESSION[userid] == $view["b_member"] || $_SESSION[userid] == $comm[$i]["TopCom_writer"]) {
									?>
									<?=nl2br($comm[$i]["content"])?>
										<?php if(strlen($comm[$i]["c_dep"]) <= 1){?> <span style="color:#0d00bd;padding-left:10px;cursor:pointer;" onclick="menu('comment2_<?=$i?>');">댓글</span>
										<?php }?>
									<?
								} else {
									echo "비밀글 입니다.";
								}
							// 공개글
							} else {
								?>
								<?=nl2br($comm[$i]["content"])?>
									<?php if(strlen($comm[$i]["c_dep"]) <= 1){?>
										<span  style="color:#0d00bd;padding-left:10px;cursor:pointer;" onclick="menu('comment2_<?=$i?>');">댓글</span> /
									<?php }?>
								
								<?
							}
							?>
							<? if($comm[$i]["comedit"]==TRUE){?>
							<span  style="color:#0d00bd; padding-left:3px;cursor:pointer;" onclick="menu('comment_<?=$i?>');">수정</span><? }?>
							<? if($comm[$i]["comdele"]==TRUE){?>
							/<span  style="color:#0d00bd;padding-left:3px;cursor:pointer;" onclick="ComdeleteChk('<?=$comm[$i]["comdele"]?>');">삭제</span>
							<? }?>&nbsp;</p>
			</div>
			
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
            
            <div class="reply" id="comment_<?=$i?>"  style="display:none;width: 100%;">
                <div class="people">
                	작성자<input type="text" name="c_writer" style="width:20%;" class="mr50" value="<?=$_SESSION["nickname"]?>"/>
                	<? if($Get_Login==FALSE) {?>비밀번호<input type="password" name="passwd" style="width:20%;" /><?php }?>
                	<span style='font-weight:bold;'>&nbsp;&nbsp;&nbsp;&nbsp;비밀로하기</span> <input type="checkbox" name="c_ex10" value="1" style="vertical-align:middle;border:0;" align="absmiddle">
                	<div class="con">
                		<p>내용<textarea name="c_content" rows="4" cols="80" ><?=stripslashes($comm[$i]['c_content'])?></textarea></p>
                		<button type="submit"><p class="btn">댓글쓰기</p></button>
                	</div>
                </div>
            </div>
            
            </form>
            
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
            
            <div class="reply" id="comment2_<?=$i?>" style="display:none;width: 100%;">
                <div class="people">
                	작성자<input type="text" name="c_writer" style="width:20%;" class="mr50" value="<?=$_SESSION["nickname"]?>"/>
                	<? if($Get_Login==FALSE) {?>비밀번호<input type="password" name="passwd" style="width:20%;" /><?php }?>
                	<span style='font-weight:bold;'>&nbsp;&nbsp;&nbsp;&nbsp;비밀로하기</span> <input type="checkbox" name="c_ex10" value="1" style="vertical-align:middle;border:0;" align="absmiddle">
                	<div class="con">
                		<p>내용<textarea name="c_content" rows="4" cols="80" ></textarea></p>
                		<button type="submit"><p class="btn">댓글쓰기</p></button>
                	</div>
                </div>
            </div>
            </form>
		<?php if(strlen($comm[$i]["c_dep"]) == 1){?></th><?php }else{?></td><?php }?>
	</tr>
	

	<!-- 글 입력부 끝 -->
	<? } ?>
</table>

</div>
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

<div class="reply mt50">
    <div class="people mt20">
    	작성자<input type="text" name="c_writer" style="width:20%;" class="mr50" value="<?=$_SESSION["nickname"]?>"/>
    	<? if($Get_Login==FALSE) {?>비밀번호<input type="password" name="passwd" style="width:20%;" /><?php }?>
    	<span style='font-weight:bold;'>&nbsp;&nbsp;&nbsp;&nbsp;비밀로하기</span> <input type="checkbox" name="c_ex10" value="1" style="vertical-align:middle;border:0;" align="absmiddle">
    	<div class="con">
    		<p>내용<textarea name="c_content" rows="4" cols="80" ></textarea></p>
    		<button type="submit"><p class="btn">댓글달기</p></button>
    	</div>
    </div>
</div>

</form>
<? } ?>


<?if($Board_Admin["view_list"] == FALSE){?>
<table cellpadding="0" cellspacing="0" border="0" class="prev_next mt80">
	<colgroup>
		<col width="20%">
		<col width="80%">
	</colgroup>
	<tr>
		<th>이전글</th>
		<td><span><?=$Url["pre_subject"]?></span> </td>
	</tr>
	<tr>
		<th class="none">다음글</th>
		<td class="none"><span><?=$Url["next_subject"]?></span> </td>
	</tr>
</table>
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