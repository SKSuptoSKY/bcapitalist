
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
.tit {font-weight:bold;color:#666;text-align:center;background-color:#f7f7f7;}
.bottom_line { border-bottom:1px solid #EAEAEA; }
.bottom_line2 { border-bottom:2px solid #90b4e4; padding-bottom:3px;}
.bbs_btn{width:80px; height:27px; background:#ffffff; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:25px; display:inline-block;}

.professor .pf_con02 {position:relative; overflow:hidden; width:100%; border-bottom:1px solid #dcdcdc; padding-bottom:50px;}
.professor .pf_con02 .pf_img {width:112px; height:147px; float:left; border:1px solid #ddd; }
.professor .pf_con02 .pf_img img{max-width:110px; max-height:145px; }
.professor .pf_con02 .pf_txt {float:left; margin-left:30px;}
.professor .pf_con02 .pf_txt dl {overflow:hidden; line-height:24px;}
.professor .pf_con02 .pf_txt dt {float:left; width:80px; font-size:13px; font-weight:bold;}
.professor .pf_con02 .pf_txt dd {float:left; width:120px; font-size:13px;}
.professor .pr_content {border-bottom:1px solid #dcdcdc; padding:30px 0;}
</style>



<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
<div class="professor">
	<div class="pf_con02">
		<div class="pf_img">
			<div style="display: table; width: 110px; height: 145px; #position: relative; overflow: hidden;">
				<div style=" #position: absolute; #top: 50%; #left: 50%; display: table-cell; vertical-align: middle; text-align: center;">
					<div style=" #position: relative; #top: -50%; #left: -50%;">
						<?=$resize_new_img[1]?>

					</div>
				</div>
			</div>
		</div>
		<div class="pf_txt">
			<dl>
				<dt>성명</dt>
				<dd><?=$view["b_writer"]?></dd>
			</dl>
			<dl>
				<dt>학위과정</dt>
				<dd><?=$view["b_ex1"]?></dd>
			</dl>
			<dl>
				<dt>이메일</dt>
				<dd style="width: 160px;"><?=$view["b_email"]?></dd>
			</dl>
			<dl>
				<dt>연구분야</dt>
				<dd style="width: 360px;"><?=$view["b_ex3"]?></dd>
			</dl>
		</div>
	</div>
	<div class="pr_content">
		<?=$view["b_ex4"]?>
	</div>
</div>




<!--


<img src="<?=$list[$i]["img_1"]?>" width="<?=$img_width[$i]?>" height="<?=$img_height[$i]?>" border="0">
  <tr>
    <td height="1" bgcolor="#dcdcdc" colspan="6"></td>
  </tr>
  <tr height="35" >
    <td height="35" class="tit">글쓴이</td>
    <td width="1%" height="35"  valign="top"> </td>
    <td width="37%" height="35" align="left" style="padding-left:10px;word-break:break-all;">
      <?=$view["b_writer"]?>
    </td>
    <td width="11%" height="35" class="tit">작성일</td>
    <td width="1%" height="35" valign="top"> </td>
    <td width="37%" height="35" align="left" style="padding-left:10px;">
      <?=$view["b_regist"]?>
    </td>
  </tr>
  <tr><td height="1" bgcolor="#dcdcdc" colspan="6"></td></tr>
  <tr height="35" >
    <td height="35" class="tit"><div align="center">이메일</td>
    <td width="1%" height="35"  valign="top"> </td>
    <td height="35" align="left" style="padding-left:10px;">
      <?=$view["b_email"]?>
    </td>
    <td height="35" class="tit"><div align="center">수정일</td>
    <td width="1%"  valign="top"> </td>
    <td height="35" align="left" style="padding-left:10px;">
      <?=$view["b_modify"]?>
    </td>
  </tr> -->
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
  <!-- <tr>
    <td height="1" bgcolor="#dcdcdc" colspan="6"></td>
  </tr>
  <tr height="35" >
    <td height="35" class="tit">첨부파일</td>
    <td width="1%" height="35" valign="top"> </td>
    <td height="35" colspan="4" align="left" style="padding-left:10px;">
      <?=$downTag?>
    </td>
  </tr> -->
  <? } ?>
  <!-- <tr>
    <td height="2" bgcolor="#dcdcdc" colspan="6"></td>
  </tr>
  <tr >
    <td height="15" colspan="6"></td>
  </tr>
  <tr>
    <td colspan="6"> <?=$imgFile?></td>
  </tr>
  <tr>
    <td colspan="6">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #ddd;">
            <tr>
                <td  style="word-break:break-all;padding:12px;">
                <div id="DivContents" style="line-height:1.4;word-break:break-all;">
                <?=$view["content"]?>

				<img src="<?=$list[$i]["img_1"]?>" width="<?=$img_width[$i]?>" height="<?=$img_height[$i]?>" border="0">
                </div>
            	</td>
            </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td height="5" colspan="6"></td>
  </tr> -->
   <tr>
    <td height="40" colspan="6" align="right">
      <? if($Url["best"]==TRUE) { ?>
      <a href="<?=$Url["best"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_boomup.gif"></a>
      <? } ?>
      <? if($Url["admin"]==TRUE) { ?>
      <!-- <a href="<?=$Url["admin"]?>"><div class="bbs_btn">관리모드</div></a> -->
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


