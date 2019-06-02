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
.add th{height:20px; border-bottom:1px solid #dfdfdf; color:#fff; background:#7b7b7b; font-size:12px;}
.add td{height:34px; border-bottom:1px solid #e4e4e4; color:#555; font-size:12px; line-height:19px;}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="add">
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
		<td style="height:2px; background:#ccc; border:none;"></td>
	</tr>
	<? for ($i=0; $i<$list_total; $i++) { ?>
		<tr height="32" align="center">
			<td align="left" style="padding:0px 10px;">
				<table>
					<tr>
						<td style="border:none;"><?if($LogAdmin==TRUE){?>
							<input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>'>&nbsp;&nbsp;<a href="<?=$list[$i]["viewUrl"]?>" class="board" style="width:13px; height:13px;">수정</a><?}?>
							<a href='javascript:;' onClick="menu('iv<?=$i?>')" onFocus="this.blur()" class="faq"><img src="<?=$Board_Admin["skin_dir"]?>/images/q.gif"  border="0" style="vertical-align:middle;"></a>
						</td>
						<Td style="border:none; padding-top:4px;"><a href='javascript:;' onClick="menu('iv<?=$i?>')" onFocus="this.blur()" class="faq"><span style="padding-left:10px; color:#888;font-size:13px;"><?=$list[$i]["subject"]?><span></a></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr id="iv<?=$i?>" style="display:none;width:100%" >
			<td colspan="2" width="100%">
				<table width="100%" cellpadding="0" cellspacing="0">
					 <tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td style="border:none;">
										<table width="100%"border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td valign="top" width="50" style="border-bottom:none; margin-left:10px;  *padding-left:0px; padding-top:10px;padding-left:25px; padding-bottom:5px;"><img src="<?=$Board_Admin["skin_dir"]?>/images/a.gif" border="0" style="vertical-align:middle; margin-top:3px;"></td>
												<td style="padding-left:10px; *padding-left:0px; border:none; " ><span><?=stripslashes($list[$i][b_content])?></span></td>
											</tr>
										</table>

									</td>
								</tr>

							</table>

						</td>
					</tr>
				</table>



			</td>
		</tr>
	<? } ?>
	<? if($i==0) { ?>
		<tr><td colspan="7" align="center" style="height:250px;">등록된 게시물이 없습니다.</td></tr>
	<? } ?>
	<tr>
		<td style="height:1px; background:#c2c2c2; border:none;"></td>
	</tr>

</form>
</table>

<style>
.addc td{color:#888;}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left">
			<? if($Url["admin"]==TRUE) { ?>
            <a href="<?=$Url["admin"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_admin.gif" border="0" /></a>
            <a href="javascript:;" onclick="bbscopy();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_copy.gif" border="0" /></a>
            <a href="javascript:;" onclick="bbsmove();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_move.gif" border="0" /></a>
            <?=AllTable($Table,"document.ListCheck.typedbname")?>
            <? } ?>
        </td>
		<td height="50" align="right">
		<? if($Url["write"]==TRUE) { ?>
			<a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif" border="0" /></a>
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