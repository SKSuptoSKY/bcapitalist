
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
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
<input type="hidden" name="typedbname">
<input type="hidden" name="tablecategory">

<ul class="storeList clfix">
	<? for ($i=0; $i<$list_total; $i++): ?>
	<li>
		<div class="store_pic_wrap">
			<a href="<?=$list[$i]["viewUrl"]?>">
				<img src="<?=$list[$i]["img_1"]?>" alt="" />
			</a>
		</div>
		<div class="store_info">
			<?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>' style="vertical-align:middle;border:0;"><?}?>
			<span class="re_Area"><?=$list[$i]["b_category"]?></span>
			<strong>
				<a href="<?=$list[$i]["viewUrl"]?>"><?=$list[$i]["subject"]?></a>
			</strong>
			<ul class="store_info_txt">
				<li><?=$list[$i]["b_ex3"]?></li>
				<li><a href="tel:<?=$list[$i]["b_ex4"]?>" class="mob_tel"><?=$list[$i]["b_ex4"]?></a></li>
				<li>영업시간 : <?=$list[$i]["b_ex5"]?></li>
			</ul>
		</div>
	</li>
	<? endfor; ?>
	<?if($i == 0){?>해당 매장이 없습니다.<?}?>
</ul>



</form>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center" colspan="2">
			<div class="paging_wrap mt20">
				<ul class="paging">
					<?=custom_paging($default[page_list] ,$page, $total_page, "$_SERVER[PHP_SELF]?tbl=$Table&$PageNext&$NextUrl&page=") ?>
				</ul>
			</div>
		<?//=$PageLinks?>
		</td>
	</tr>
</table>




<style>
.tit {font-weight:bold;color:#666666;text-align:center;}
.bbs_categ {line-height:22px;}
.bbs_categ  td {line-height:24px; height:24px; color:#c2c2c2; text-decoration:none;}
.bbs_categ  td a:hover{line-height:24px; height:24px; color:#f26731; text-decoration:none;}
.sub_dot{background:url('/images/sub/sub_dot.jpg') 0 4px no-repeat; padding-left:12px; vertical-align:top;}
.bbs_btn{width:70px; height:25px; background:#ffffff; color:#111; font-weight:bold; border:1px solid #dbdbdb; text-align:center; line-height:23px; display:inline-block;}
p.mobile_regist_date{display:none; }
p.tablet_regist_date{display:none; }

.board_search{height:50px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc; vertical-align:middle;}
.board_search input{height:28px; box-sizing:border-box; font-size:13px; vertical-align:middle;}
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; -webkit-border-radius:0px;  -webkit-appearance:none; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; vertical-align:middle;
-webkit-border-radius:0px;  -webkit-appearance:none; }

@media screen and (max-width : 1000px) {
td.responsive01{vertical-align:top; padding-top:8px; font-size:12px;}
td.responsive04{vertical-align:top; padding-top:8px; font-size:12px;}
td.responsive06{vertical-align:top; padding-top:8px; font-size:12px;}

td.responsive05{display:none; }
td.responsive06{font-size:12px; }
p.tablet_regist_date{display:block; font-size:11px; color:#aaaaaa; margin-top:4px;}
}


@media screen and (max-width : 640px) {
p.tablet_regist_date{display:none; }
p.mobile_regist_date{display:block; font-size:11px; color:#a1a1a1; margin-top:3px;}
td.responsive04{display:none}
td.responsive06{display:none; }

.board_search .board_search_area{width:48%; text-indent:5px; }
.board_search .board_btn_seach{width:16%; background:#888; border:1px solid #666; color:#fff; font-weight:bold;}
::-webkit-input-placeholder { /* WebKit, Blink, Edge */ color:#555555; font-size:12px; }
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ color:#555555; font-size:12px; opacity:  1;}
::-moz-placeholder { /* Mozilla Firefox 19+ */ color:#555555; font-size:12px; opacity:  1;}
:-ms-input-placeholder { /* Internet Explorer 10-11 */ color:#555555; font-size:12px;}
:placeholder-shown { /* Standard (https://drafts.csswg.org/selectors-4/#placeholder) */ color:#555555; font-size:12px;}
}
</style>


