

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.fancybox.pack.js"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.fancybox-buttons.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.fancybox-media.js"></script>

<link rel="stylesheet" href="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=$Board_Admin["skin_dir"]?>/fancybox/jquery.fancybox-thumbs.js"></script>

<script type="text/javascript">

//Different animations - 'fade', 'elastic' and 'none'
//Different title positions - 'outside', 'inside' and 'over'


$(document).ready(function() {
    $(".pop_fancy").fancybox({
    	openEffect : 'none',
    	closeEffect	: 'none',
    	helpers : {
    		title : {
    			type : 'outside'
    		}
    	}
    });
});
</script>




<script language='javascript'>
function check_confirm(str) {
    var f = document.ListCheck;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "list_ck[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete() {
	var f = document.ListCheck;

	str = "삭제";
	if (!check_confirm(str))
		return;

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n원글 삭제시 답변글까지 모두 삭제됩니다.\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
		return;

	f.submit();
}
// 선택한 게시물 삭제
function select_delete() {
	var f = document.ListCheck;

	str = "삭제";
	if (!check_confirm(str))
		return;

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n원글 삭제시 답변글까지 모두 삭제됩니다.\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
		return;

	f.submit();
}
// 선택한 게시물 복사
function bbscopy() {
	var f = document.ListCheck;

	str = "복사";
	if (!check_confirm(str)){ return false;}

	if(!f.typedbname.value&&document.getElementById("dbname_view").style.display=="block"){
		alert('복사/이동할 게시판이 없습니다.\n\n관리자페이지>사이트관리>게시판관리에서     \n체크 하신후 이용 바랍니다.');
		return false;
	}

	if(!f.typedbname.value){
		alert(str+"할 테이블을 선택하여 주십시오");
		document.getElementById("dbname_view").style.display = "block";
		return false;
	}

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?")){ return false;}

	f.mode.value="COPY";
	f.submit();
}
// 선택한 게시물 이동
function bbsmove() {
	var f = document.ListCheck;

	str = "이동";
	if (!check_confirm(str)){ return false;}

	if(!f.typedbname.value&&document.getElementById("dbname_view").style.display=="block"){
		alert('복사/이동할 게시판이 없습니다.\n\n관리자페이지>사이트관리>게시판관리에서     \n체크 하신후 이용 바랍니다.');
		return false;
	}

	if(!f.typedbname.value){
		alert(str+"할 테이블을 선택하여 주십시오");
		document.getElementById("dbname_view").style.display = "block";
		return false;
	}

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?")){ return false;}

	f.mode.value = "MOVE";
	f.submit();
}
</script>

<style>
.tit {font-weight:bold;color:#666666;text-align:center;}
.bbs_categ {line-height:22px;}
.bbs_categ  td {line-height:24px; height:24px; color:#c2c2c2; text-decoration:none;}
.bbs_categ  td a:hover{line-height:24px; height:24px; color:#f26731; text-decoration:none;}
.sub_dot{background:url('/images/sub/sub_dot.jpg') 0 4px no-repeat; padding-left:12px; vertical-align:top;}
.bbs_btn{width:80px; height:27px; background:#ffffff; color:#111; font-weight:bold; border:1px solid #dbdbdb; text-align:center; line-height:25px; display:inline-block;}

.result_area {float:left;width:167px;}
.result_area dt {text-align:center;margin-bottom:10px; height:222px; border:1px solid #ddd;}
.result_area dt img {max-width:165px; max-height:220px; }
.result_area dd {font-size:14px;font-weight:bold;color:#555;text-align:center; height:50px; overflow:hidden; }
.result_area dd a, .result_area dd a:hover {color:#555;}

.cert_area {float:left;width:215px;}
.cert_area dt {text-align:center;margin-bottom:10px;}
.cert_area dt img {border:1px solid #ddd;}
.cert_area dd {font-size:15px;font-weight:bold;color:#555;text-align:center;}
.cert_area dd a, .result_area dd a:hover {color:#555;}
</style>

<form name="ListCheck" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return listChk(this)">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="mode" value="LISTDEL">
<input type="hidden" name="tbl" value="<?=$Table?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="gr_id" value="<?=$gr_id?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
<input type="hidden" name="typedbname">
<input type="hidden" name="tablecategory">

<?php for ($i=0; $i<$list_total; $i++): ?>
	<?=($i%4==0)?"<div class='clfix mb30'>":""?>
		<dl class="result_area <?=($i%4 != 3)?"mr20":""?>">
			<dt>
				<a id="single_3" class="pop_fancy" href="<?=$list[$i]["img_1"]?>"  title="<?=$list[$i]["subject"]?>" style="cursor:pointer;" >
					<table width="165px" height="220px">
						<tr>
							<td><?=img_resize_tag2($list[$i]["img_1"],165,220,"class='small'")?></td>
						</tr>
					</table>
				</a>
			</dt>
			<dd>
				<a <?=($LogAdmin==TRUE)?"href='/bbs/board.php?mode=MODIFY&tbl={$Table}&num={$list[$i][b_no]}'":""?>>
					<?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>' style="vertical-align:middle;border:0;"><?}?>
					<?=$list[$i]["subject"]?>
				</a>
			</dd>
		</dl>
	<?=($i%4==3 and $i!=0 )?"</div>":""?>
<?php endfor; ?>
<?=($i%4!=0 and $i!=0)?"</div>":""?>

<? if($i==0) { ?>
<div class='clfix mb30'>
  등록된 게시물이 없습니다.
 </div>
<? } ?>

</form>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left">
			<? if($Url["admin"]==TRUE) { ?>
            <a href="<?=$Url["admin"]?>"><div class="bbs_btn">관리모드</div></a>
            <?=AllTable($Table,"document.ListCheck.typedbname")?>
            <? } ?>
        </td>
		<td height="50" align="right">
		<? if($Url["write"]==TRUE) { ?>
			<a href="<?=$Url["write"]?>"><div class="bbs_btn">글쓰기</div></a>
		<? } ?>
		<? if ($LogAdmin==TRUE) { ?>
			<a href="javascript:select_delete();"><div class="bbs_btn">삭제</div></a>
		<? } ?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<div class="paginate mt20">
				<ul>
					<?=custom_paging($default[page_list] ,$page, $total_page, "$_SERVER[PHP_SELF]?tbl=$Table&$PageNext&$NextUrl&page=") ?>
				</ul>
			</div>
		<?//=$PageLinks?>
		</td>
	</tr>
</table>

<style>
.board_search{height:30px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc;}
.board_search input{height:28px; box-sizing:border-box; font-size:13px; }
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; }
</style>