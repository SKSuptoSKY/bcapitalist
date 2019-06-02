<?
////////// 게시판 리스트 페이지 추가코드 여기부터 //////////////////////////

////////// 게시판 리스트 페이지 추가코드 여기까지 //////////////////////////

///// 게시판 변수 안내
//스킨경로 : $Board_Admin["skin_dir"]
//게시판 너비 : $Board_Admin["width"]
///// 게시판 변수 안내
?>
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
<script>
var old='';
function menu(name){

	submenu=eval(name+".style");

	if (old!=submenu)
	{
		if(old!='')
		{
			old.display='none';
		}
		submenu.display='inline';
		old=submenu;
	}
	else
	{
		submenu.display='none';
		old='';
	}
}
</script>

<!-- <link rel="stylesheet" href="/css/board.css" type="text/css"> -->
<style>
.faq_list{width:100%; border-top:2px solid #393939;}
.faq_list a{text-decoration:none; }
.faq_list td{height:35px; border-bottom:1px solid #dfdfdf; font-weight:normal;}
</style>
<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center" class="faq_list">
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
	<? for ($i=0; $i<$list_total; $i++) { ?>
		<tr height="32" align="center">
			<td align="left" style="padding:0px 10px;">
				<table>
					<tr>
						<td align="middle" width="80" style="border:none; "><?if($LogAdmin==TRUE){?>
							<input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>'>&nbsp;&nbsp;<a href="<?=$list[$i]["viewUrl"]?>" class="board" style="width:13px; height:13px;">수정</a><?}?>
							<a href='javascript:;' onClick="menu('iv<?=$i?>')" onFocus="this.blur()" class="faq" ><img src="<?=$Board_Admin["skin_dir"]?>/images/question.png"  border="0" style="vertical-align:middle;"></a>
						</td>
						<td style="border:none; padding:10px 0;"><a href='javascript:;' onClick="menu('iv<?=$i?>')" onFocus="this.blur()" class="faq"><span style="padding-left:10px; color:#777; font-weight:bold"><?=$list[$i]["subject"]?><span></a></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" width="100%"  id="iv<?=$i?>" style="display:none;width:100%; " >
				<div style="width:100%">
					<table width="100%"border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td valign="center" align="right" width="80"  style="background:#f3f3f3; border-bottom:0;"><img src="<?=$Board_Admin["skin_dir"]?>/images/answer.png" border="0" style="vertical-align:middle;"></td>
							<td style="background:#f3f3f3; border-bottom:0; padding:15px 10px 15px 30px"><span><?=stripslashes($list[$i][b_content])?></span></td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	<? } ?>
	<? if($i==0) { ?>
		<tr><td colspan="7" align="center" style="height:250px;">등록된 게시물이 없습니다.</td></tr>
	<? } ?>

</form>
</table>

<style>
.addc td{color:#888;}
.tit {font-weight:bold;color:#666666;text-align:center;}
.sub_dot{background:url('/images/sub/sub_dot.jpg') 0 4px no-repeat; padding-left:12px; vertical-align:top;}
.bbs_btn{width:100px; height:32px; background:#ffffff; color:#111; font-weight:bold; border:1px solid #dbdbdb; text-align:center; line-height:30px; display:inline-block;}
</style>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left">
			<? if($Url["admin"]==TRUE) { ?>
            <a href="<?=$Url["admin"]?>"><div class="bbs_btn">관리모드</div></a>
            <a href="javascript:;" onclick="bbscopy();"><div class="bbs_btn">복사</div></a>
            <a href="javascript:;" onclick="bbsmove();"><div class="bbs_btn">이동</div></a>
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
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; vertical-align:middle;}
</style>