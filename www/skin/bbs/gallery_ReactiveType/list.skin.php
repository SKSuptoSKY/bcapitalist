<!-- <?
////////// 게시판 리스트 페이지 추가코드 여기부터 //////////////////////////

////////// 게시판 리스트 페이지 추가코드 여기까지 //////////////////////////

/*///// 게시판 변수 안내
스킨경로 : $Board_Admin["skin_dir"]
게시판 너비 : $Board_Admin["width"]
/*///// 게시판 변수 안내
?> -->
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
.bbs_btn{width:90px; height:28px; background:#ffffff; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:26px; display:inline-block;}
</style>


<div class="section-block content-inner pt-0">
	<div id="recent-posts" class="grid-container " data-layout-mode="masonry" data-grid-ratio="1" data-animate-resize data-animate-resize-duration="700">
		<div class="grid clfix">
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
				<?
				for ($i=0; $i<$list_total; $i++)
				{
				?>
					<div class="grid-item grid-sizer">
						<a class="overlay-link" href="<?=$list[$i]["viewUrl"]?>">
							<img src="<?=$list[$i]["img_1"]?>" alt=""/>
						</a>
						<p class="img_Title">
						<?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>' style='vertical-align:middle;padding-right:5px;'><?}?>
						<a href="<?=$list[$i]["viewUrl"]?>"><?=$list[$i]["subject"]?></a></p>
					</div><!--// grid-item -->
				<?
				}
				?>
			</form>
		</div><!--// grid -->
	</div>
</div>




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

<div class="board_search mt20 mb50">
	<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
				<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
				<input type=hidden name=tbl value="<?=$Table?>">
				<input type=hidden name=mode value="">
				<input type=hidden name=page value="<?=$page?>">
						<td>
						<? if($Board_Admin["use_category"] == TRUE) { ?>
							<select name="category" style="height:28px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid; font-size:13px;">
								<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
								<?=$Category_option?>
							</select>
						<? } ?>
							<select name="findType">
								<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
								<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
								<option value="name" <?if($findType=="name"){?>selected<?}?>>작성자명</option>
								<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
							</select>
							&nbsp;<input type="text" name="findWord" class="board_search_area" placeholder="검색어를 입력하세요" value="<?=$findword?>">&nbsp;<input type="submit" value="검색" class="board_btn_seach"/>
						</td>
				</form>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>

<style>
.board_search{height:50px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc; vertical-align:middle;}
.board_search input{height:28px; box-sizing:border-box; font-size:13px; vertical-align:middle;}
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; }
</style>
<style>
/* ---- grid ---- */
.grid {
  max-width: 100%;
  margin:0 auto 0;
}
.grid:after {
  content: '';
  display: block;
  clear: both;
}
/* ---- grid-item ---- */
.grid-item {
  width: 32%;
  height: auto;
  float: left;
  border: 1px solid #ddd;
  margin:0.666%;
  padding:2%; 
}
.grid-item img{width:100%; }
.grid-item p.img_Title{word-break:break-all; font-size:13px; color:#555555; line-height:20px; margin-top:8px; display:block; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
.grid-item p.img_Title a{color:#555555;}
@media screen and (max-width : 1023px) {
/* ---- grid ---- */
.grid {
  max-width: 100%;
  margin:0 auto;
}
/* ---- grid-item ---- */
.grid-item {
  width: 32%;
  height: auto;
  float: left;
  /* border: 1px solid #ddd; */
  margin:0.666%;
}
.grid-item img{width:100%; }
}
@media screen and (max-width : 768px) {
/* ---- grid ---- */
.grid {
  max-width: 100%;
  margin:0 auto;
}
/* ---- grid-item ---- */
.grid-item {
  width: 48%;
  height: auto;
  float: left;
  /* border: 1px solid #ddd; */
  margin:1%;
}
.grid-item img{width:100%; }
.grid-item p.img_Title{font-size:12px; }
}
.board_search{height:50px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc; }
.board_search input{height:28px; box-sizing:border-box; font-size:13px; vertical-align:middle;}
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; -webkit-border-radius:0px;  -webkit-appearance:none; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold;
-webkit-border-radius:0px;  -webkit-appearance:none; }
@media screen and (max-width : 768px) {
.board_search .board_search_area{width:48%; text-indent:5px; }
.board_search .board_btn_seach{width:16%; background:#888; border:1px solid #666; color:#fff; font-weight:bold;}
::-webkit-input-placeholder { /* WebKit, Blink, Edge */ color:#555555; font-size:12px; }
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ color:#555555; font-size:12px; opacity:  1;}
::-moz-placeholder { /* Mozilla Firefox 19+ */ color:#555555; font-size:12px; opacity:  1;}
:-ms-input-placeholder { /* Internet Explorer 10-11 */ color:#555555; font-size:12px;}
:placeholder-shown { /* Standard (https://drafts.csswg.org/selectors-4/#placeholder) */ color:#555555; font-size:12px;}
}
</style>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://labs.funkhausdesign.com/examples/masonry/masonry.pkgd.min.js"></script>
<script src="/css/js/timber.master.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		// Start Masonry
		jQuery('.grid').masonry({
			//columnWidth: 150, //너비
			itemSelector: '.grid-item', //ㅇ안에 상자
			//gutter: 20, //간격
			//isFitWidth: true //너비맞출건지 여부
		});
	});
</script>