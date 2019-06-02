
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
</style>
<?if($Board_Admin["use_category"] == TRUE and $Board_Admin["use_category_top"] == TRUE) {?>
<?php 
$CategoryCntSql = " select count(*) as cnt from $BB_table where 1";
$CategoryCntRow = sql_fetch($CategoryCntSql,FALSE);
$Category_total_count = $CategoryCntRow[cnt];
$categoryRES= explode(",",$Board_Admin["category"]);
$categoryCNT = count($categoryRES);
?>
<ul class="sub03_tab clfix mb50">
	<li <?=($category==null)?"class='on'":"class='#none'";?> ><a href="/bbs/board.php?tbl=<?=$Table?>" <?if($category==null){?> class="over"<? } ?>>전체 (<?=$Category_total_count?>)</a></li>
	<?php if($categoryRES[0]){
			for($cs=1; $cs<$categoryCNT+1; $cs++) {
				$j = $cs-1;
				$CategoryCnt_Where = "where b_category = '".$categoryRES[$j]."' ";
				$CategoryCntSql = " select count(*) as cnt from $BB_table $CategoryCnt_Where";
				$CategoryCntRow = sql_fetch($CategoryCntSql,FALSE);
				$Category_total_count = $CategoryCntRow[cnt];
	?>
	<li <?=($category==$categoryRES[$j])?"class='on'":"class='#none'";?> ><a href="/bbs/board.php?tbl=<?=$Table?>&category=<?=$categoryRES[$j]?>" <?if($category==$categoryRES[$j]){?> class="over"<? } ?>><?=($categoryRES[$j])?>(<?=$Category_total_count?>)</a></li>
	<?php 
			}
	   }
	 ?>
</ul>
<?}?>
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


<table cellpadding="0" cellspacing="0" border="0" class="basic_bbs_list">
	<colgroup>
		<col width="8%">
		<? if($Board_Admin["use_category"] == TRUE) { ?>
		<col width="12%">
		<? } ?>
		<col width="52%">
		<col width="10%">
		<col width="10%">
		<col width="8%">
	</colgroup>
	<tr class="tbl_th">
		<th>No.</th>
		<? if($Board_Admin["use_category"] == TRUE) { ?>
		<th>분류</th>
		<? } ?>
		<th><?if($LogAdmin==TRUE){?><input type="checkbox" onclick="List_Checked_Sel(this.form,this);" style="vertical-align:middle;border:0;"> <?}?>제목</th>
		<th>작성자</th>
		<th>작성일</th>
		<th>조회</th>
	</tr>
	<?php for ($i=0; $i<$list_total; $i++) { ?>
	<tr>
		<td><?=$list[$i]["no"]?></td>
		<? if($Board_Admin["use_category"] == TRUE) { ?>
		<td><?=$list[$i]["b_category"]?></td>
		<? } ?>
		<td class="left">
			<?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>' style="vertical-align:middle;border:0;"><?}?>
			<a href="<?=$list[$i]["viewUrl"]?>">
    		<?=$list[$i]["subject"]?>
    		</a>
    		<?=$list[$i]["comment"]?>
			<?=$list[$i]["secret"]?>
			<?=$list[$i]["new"]?>
		</td>
		<td><?=$list[$i]["b_writer"]?></td>
		<td><?=date("y.m.d",strtotime($list[$i]["b_regist"]))?></td>
		<td><?=$list[$i]["hit"]?></td>
	</tr>
	<?php } ?>
	<?php if($i==0) { ?>
	<tr>
		<td height="80" colspan="26" align="center">등록된 게시물이 없습니다.</td>
	</tr>
	<?php }?>
</table>


</form>

<!-- admin_btn -->
<div class="admin_btn mt20">
	<? if($Url["admin"]==TRUE) { ?>
		<a href="<?=$Url["admin"]?>"><div class="btn01">관리모드</div></a>
		<?=AllTable($Table,"document.ListCheck.typedbname")?>
	<? } ?>
	<? if($LogAdmin==TRUE)  { ?>
		<a href="javascript:select_delete();"><div class="btn02 md10">삭제</div></a>
	<? } ?>
	<? if($Url["write"]==TRUE) { ?>
		<a href="<?=$Url["write"]?>"><div class="btn02">글쓰기</div></a>
	<? } ?>
</div>
<!-- //admin_btn -->

<!-- paging -->
<div class="mt50">
	<?=custom_paging($default[page_list] ,$page, $total_page, "$_SERVER[PHP_SELF]?tbl=$Table&$PageNext&$NextUrl&page=") ?>
</div>
<!-- //paging -->

<!-- search -->
<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
<input type=hidden name=tbl value="<?=$Table?>">
<input type=hidden name=mode value="">
<input type=hidden name=page value="<?=$page?>">
	<div class="bbs_search mt50">
		<fieldset>
			<? if($Board_Admin["use_category"] == TRUE) { ?>
			<legend>분류</legend>
			<select name="category" style="width:80px;" title="">
				<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
				<?=$Category_option?>
			</select>
			<?php }?>
			<legend>검색</legend>
			<select name="findType" style="width:80px;" title="제목, 작성자, 내용 검색">
				<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
				<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
				<option value="name" <?if($findType=="name"){?>selected<?}?>>작성자명</option>
				<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
			</select>
			<input type="text" name="findWord" class="input_txt" style="width:300px;" title="검색어" placeholder="검색어를 입력하세요" value="<?=$findword?>" />
			<button class="btn btn_sm default" type="submit">검색</button>
		</fieldset>
	</div>
</form>
<!--// search -->


<style>
.board_search{height:50px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc; vertical-align:middle;}
.board_search input{height:28px; box-sizing:border-box; font-size:13px; vertical-align:middle;}
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; margin:0 5px; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; vertical-align:middle;}
</style>