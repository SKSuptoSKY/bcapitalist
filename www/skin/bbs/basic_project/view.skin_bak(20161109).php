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
.tit {font-weight:bold;color:#444;text-align:center; }
.bottom_line { border-bottom:1px solid #EAEAEA; }
.bottom_line2 { border-bottom:1px solid #444444; padding-bottom:3px;}
.bbs_top li{float:left; background:url(/images/bar.jpg) 0 55% no-repeat; padding-left:15px; margin-left:15px;  }
.bbs_top li.bg_none{background:none; margin-left:0; padding-left:20px; }
.bbs_btn{width:90px; height:30px; background:#ffffff; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:30px; display:inline-block; box-sizing:border-box;}
</style>


<div class="sub03view_wrap clfix">
	<div class="sub03_img">
		<script src="/css/js/jquery.bxslider.js"></script>
		<link href="/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
		<ul class="sub03_img_slider">
			<? for( $i=1; $i<=count($view_list_big_src); $i++ ) { ?>
			<li><div class="sub03_img_sizing"><?=$view_list_big_imgFile[$i]?></div></li>
			<? } ?>
		</ul>

		<div id="bx-pager" class="clfix">
			<? 
			$dataindex = 0;
			for( $i=1; $i<=count($view_list_small_src); $i++ ) {
			?>
			<a class="bx-pager-link <?if($dataindex == 0){?>first<?}?>" href="" data-slide-index="<?=$dataindex?>"><div class="sub03_thum"><?=$view_list_small_imgFile[$i]?></div></a>
			<? 
				$dataindex++;
			}
			?>
		</div>

		<script type="text/javascript">
			$('.sub03_img_slider').bxSlider({
			  pagerCustom: '#bx-pager',
			  mode:'fade',
			  autoControls: true
			});
		</script>
	</div>
	<div class="sub03_cont md50">
		<div class="sub03_part1">
			<p><em><?=$view["subject"]?></em></p>
			<p><?=stripslashes($view["b_ex1"])?></p>
		</div>
		<div  class="sub03_part2 mt20">
			<div id="DivContents" style="word-break:break-all;">
			<?=$view["content"]?>
			</div>
		</div>
		<div  id="sub03_part3 ">
			<div class="mt20">
				<table width="100%" cellpadding="0" cellspacing="0" >
			<colgroup>
				<col width="30%" />
				<col width="*" />
			</colgroup>
					<tr>
						<td class="part3_title">Completion</td>
						<td ><?=stripslashes($view["b_ex2"])?></td>
					</tr>
					<tr>
						<td class="part3_title">Location</td>
						<td ><?=stripslashes($view["b_ex3"])?> </td>
					</tr>
					<tr>
						<td class="part3_title">Site Area</td>
						<td ><?=stripslashes($view["b_ex4"])?></td>
					</tr>
					<tr>
						<td class="part3_title">Building Area</td>
						<td ><?=stripslashes($view["b_ex5"])?></td>
					</tr>
					<tr>
						<td class="part3_title">Gross Floor Area</td>
						<td ><?=stripslashes($view["b_ex6"])?></td>
					</tr>
					<tr>
						<td class="part3_title">Type</td>
						<td ><?=stripslashes($view["b_ex7"])?></td>
					</tr>
					<tr>
						<td class="part3_title">Total Floor</td>
						<td ><?=stripslashes($view["b_ex8"])?></td>
					</tr>
				</table>
			</div>
		</div>

	</div>
</div>


<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:50px;">
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