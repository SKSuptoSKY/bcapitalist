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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
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
<input type="hidden" name="mobile_flag" value="ok">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
<input type="hidden" name="typedbname">
<input type="hidden" name="tablecategory">
	<tr>
		<td colspan="<?=$Board_Admin["listcount"]?>" style="padding-bottom:5px;"><?if($LogAdmin==TRUE){?>전체선택 <input type="checkbox" onclick="List_Checked_Sel(this.form,this);"><?}?></td>
	</tr>
	<tr>
<?
	for ($i=0; $i<$list_total; $i++) {
		if(!$img_width[$i]){
		$img_width[$i] = $Board_Admin["sum_width"];
		}
		if(!$img_height[$i]){
		$img_height[$i] = $Board_Admin["sum_height"];
		}

?>
	<? if($i!=0 && $i%$Board_Admin["listcount"]==0) {?>
	</tr>
	<tr>
	<? } ?>
		<td valign="top" width="33%"><!--  -->
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:10px;padding-right:10px;">
				<tr>
					<td align="center" valign="middle" style="border:1px solid #e1e1e1;">
						<a href="<?=$list[$i]["viewUrl"]?>">
							<img src="<?=$list[$i]["img_1"]?>" width="100%">
						</a>
					</td>
				</tr>
				<tr><td height="25" ><div align="left" style="padding-left:5px;"><?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>' style='vertical-align:middle;padding-right:5px;'><?}?><a href="<?=$list[$i]["viewUrl"]?>"><font color="767676"><?if($num == $list[$i]["b_no"]){?><span style="color:blue;"><?}?><?=$list[$i]["subject"]?></span></font></a><?=$list[$i][aa]?><?=$list[$i]["comment"]?><?=$list[$i]["secret"]?> <!--<?=$list[$i]["new"]?>--></div></td></tr>
				<tr>
					<td height="25"></td>
				</tr>
			</table>
		</td>
<? }  //for end
  //td 빈칸 채우기
  if(($cnt = $i % $Board_Admin["listcount"]) != 0){
	  for($z=$cnt; $z < $Board_Admin["listcount"]; $z++) echo "<td width='33%'>&nbsp;</td>";
 }

 if($i==0) { ?>
		<td height="180" colspan="<?=$Board_Admin["listcount"]?>" align="center">등록된 게시물이 없습니다.</td>
<? } ?>
	</tr>
</form>
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left">
			<? if($Url["admin"]==TRUE) { ?>
            <a href="<?=$Url["admin"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_admin.gif"></a>
            <?=AllTable($Table,"document.ListCheck.typedbname")?>
            <? } ?>
        </td>
		<td height="50" align="right">
		<? if($Url["write"]==TRUE) { ?><a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif"></a><? } ?>
		<? if ($LogAdmin==TRUE) { ?>
			<a href="javascript:select_delete();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif" border="0"></a>
		<? } ?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><?=$PageLinks?></td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
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
						<input type="text" name="findWord" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">&nbsp;<input type=image src='<?=$Board_Admin["skin_dir"]?>/images/icon_search.gif' align=absmiddle>
					</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
</table>
