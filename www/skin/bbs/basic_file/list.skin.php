<?
////////// 게시판 리스트 페이지 추가코드 여기부터 //////////////////////////

////////// 게시판 리스트 페이지 추가코드 여기까지 //////////////////////////

/*///// 게시판 변수 안내
스킨경로 : $Board_Admin["skin_dir"]
게시판 너비 : $Board_Admin["width"]
/*///// 게시판 변수 안내
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

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
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

	<tr><td height="2" bgcolor="#888888" colspan="20"></td></tr>
	<tr height="28" align="center" bgcolor="eedbc7">
		<td style="color:#747474;font-weight:bold;">번호</td>
	<? if($Board_Admin["use_category"] == TRUE) { ?>
		<td width="50" style="color:#747474;font-weight:bold;">분류</td>
	<? } ?>
		<td style="color:#747474;font-weight:bold;"><?if($LogAdmin==TRUE){?><input type="checkbox" onclick="List_Checked_Sel(this.form,this);"><?}?>제목</td>
		<td style="color:#747474;font-weight:bold;">첨부</td>
		<td style="color:#747474;font-weight:bold;">글쓴이</td>
		<td style="color:#747474;font-weight:bold;">작성일</td>
		<td style="color:#747474;font-weight:bold;">조회</td>
	<? if($Board_Admin["use_best"] == TRUE) { ?>
		<td style="color:#747474;font-weight:bold;">추천</td>
	<? } ?>
	</tr>
	<tr><td height="1" bgcolor="#888888" colspan="20"></td></tr>
<? for ($i=0; $i<$list_total; $i++) { ?>
	<tr height="25" align="center">
		<td><?=$list[$i]["no"]?></td>
	<? if($Board_Admin["use_category"] == TRUE) { ?>
		<td><?=$list[$i]["b_category"]?></td>
	<? } ?>
		<td align="left">
		<?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>'><?}?>
		<a href="<?=$list[$i]["viewUrl"]?>"><?=$list[$i]["subject"]?></a> <?=$list[$i]["comment"]?> <?=$list[$i]["secret"]?> <?=$list[$i]["new"]?></td>		
		<td><?=$list[$i]["icon"]?></td>
		<td><?=$list[$i]["b_writer"]?></td>
		<td><?=cut_str($list[$i]["b_regist"],10,'')?></td>
		<td><?=$list[$i]["hit"]?></td>
	<? if($Board_Admin["use_best"] == TRUE) { ?>
		<td><?=$list[$i]["best"]?></td>
	<? } ?>
	</tr>
	<tr><td height="1" bgcolor="#F0F0F0" colspan="20"></td></tr>
<? } ?>
<? if($i==0) { ?>
	<tr><td height="80" colspan="20" align="center">등록된 게시물이 없습니다.</td></tr>
<? } ?>
	<tr><td height="1" bgcolor="#666666" colspan="20"></td></tr>
</form>
</table>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left">
			<? if($Url["admin"]==TRUE) { ?>
            <a href="<?=$Url["admin"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_admin.gif"></a>
            <?=AllTable($Table,"document.ListCheck.typedbname")?>
            <? } ?>
        </td>
		<td height="50" align="right">
		<? if($Url["write"]==TRUE) { ?>
			<a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif"></a>
		<? } ?>
		<? if ($LogAdmin==TRUE) { ?>
			<a href="javascript:select_delete();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif" border="0"></a>
		<? } ?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><?=$PageLinks?></td>
	</tr>
</table>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=tbl value="<?=$Table?>">
			<input type=hidden name=mode value="">
			<input type=hidden name=page value="<?=$page?>">
					<td>
					<? if($Board_Admin["use_category"] == TRUE) { ?>
						<select name="category" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
							<?=$Category_option?>
						</select>
					<? } ?>
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
							<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
							<option value="name" <?if($findType=="name"){?>selected<?}?>>작성자명</option>
							<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
						</select>
						<input type="text" name="findWord" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">&nbsp;<input type=image src='/btn/icon_search.gif' align=absmiddle>
					</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
</table>
