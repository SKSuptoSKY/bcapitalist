<?
////////// 게시판 리스트 페이지 추가코드 여기부터 //////////////////////////

////////// 게시판 리스트 페이지 추가코드 여기까지 //////////////////////////
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



<!-- <table  width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td colspan="4">

<a href="/bbs/board.php?tbl=shop_qna" onfocus="this.blur()"><img src="/images/tabbbs/tab1_o.jpg"  border="0"/></a>  &nbsp;
<a href="/bbs/board.php?tbl=bbs52" onfocus="this.blur()"><img src="/images/tabbbs/tab2.jpg" onmouseover="src='/images/tabbbs/tab2_o.jpg'" onmouseout="src='/images/tabbbs/tab2.jpg'"  border="0"/></a>


</td></tr>
<tr><td height="20"></td></tr>
</table> -->


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardtb">
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
<caption></caption>
<col width="10%" />
<col width="65%" />
<col width="15%" />
<col width="10%" />
<tbody>
	<tr height="35">
		<th class="ttal">번호</th>
		<th class="ttal"><?if($LogAdmin==TRUE){?><input type="checkbox" onclick="List_Checked_Sel(this.form,this);"><?}?> 제목</th>
		<th class="ttal">작성일</th>
		<th class="ttal">조회수</th>
	</tr>
	<? for ($i=0; $i<$list_total; $i++) { ?>
	<tr>
		<td class="ttal"><?=$list[$i]["no"]?></td>
		<td><?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>'><?}?><?=($list[$i][b_dep] == "A")?"[<a href='/shop/item.php?it_id=".$list[$i][b_ex2]."' target='_blank'>".$list[$i][b_ex3]."</a>] ":"";?><a href="<?=$list[$i]["viewUrl"]?>"> <?=$list[$i]["subject"]?></a><span class="iconpd"><?=$list[$i]["comment"]?><?=$list[$i]["secret"]?> <?=$list[$i]["new"]?><?=$list[$i]["file_icon"]?></span></td>
		<td class="ttal"><?=cut_str($list[$i]["b_regist"],10,'')?></td>
		<td align="center"><?=$list[$i]["hit"]?></td>
	</tr>
	<? } ?>
	<? if($i==0) { ?>
	<tr>
		<td height="80" colspan="4" align="center" class="last">등록된 게시물이 없습니다.</td>
	</tr>
	<? } ?>
	</tbody>
</form>
</table>

<div class="shop_bd_btn" >
	<? if($Url["admin"]==TRUE) { ?>
	<div class="admin"><a href="<?=$Url["admin"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_admin.gif" alt="관리모드" /></a></div>
	<?=AllTable($Table,"document.ListCheck.typedbname")?>
	<? } ?>
	<div style="float:right;">
	<? if($Url["write"]==TRUE) { ?>
	<?if($Table == "shop_qna"){?>
	<? if($Url["admin"]==TRUE) { ?>
	<!-- <a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif" alt="글쓰기" /></a> -->
	<?}?>
	<?}else{?>
	<a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif" alt="글쓰기" /></a>
	<?	} ?>
	<? } ?>
	<? if ($LogAdmin==TRUE) { ?>
	<?if($Table == "shop_qna"){?>
	<? if($Url["admin"]==TRUE) { ?>
	<a href="javascript:select_delete();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif" alt="삭제" /></a>
	<?}?>
	<?}else{?>
	<a href="javascript:select_delete();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif" alt="삭제" /></a>
	<? } ?>
	<? } ?>
	</div>
</div>

<div class="nblink"><?=$PageLinks?></div>

<div class="shop_baordsc" >
	<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
	<input type=hidden name=tbl value="<?=$Table?>">
	<input type=hidden name=mode value="">
	<input type=hidden name=page value="<?=$page?>">
	<? if($Board_Admin["use_category"] == TRUE) { ?>
	<select name="category" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
		<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
		<?=$Category_option?>
	</select>
	<? } ?>
	<select name="findType" id="jumpMenu" onchange="" style="vertical-align:middle; *margin-top:2px; *height:24px;">
		<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
		<option  value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
		<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
	</select>&nbsp;<input name="findWord" type="text" tabindex="1" class="bginput" value="검색어를 입력하세요." onClick="javascript:if(this.value == '검색어를 입력하세요.'){ this.value = ''};" >&nbsp;<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_search.jpg" style="vertical-align:top;" />
	</form>
</div>