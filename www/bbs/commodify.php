<?
include_once $_SERVER['DOCUMENT_ROOT']."/head.lib.php";

if(!$num||!$cnum) echo "<script>alert('잘못된 경로입니다.');opener.location.reload();window.close();</script>";
$BoardSql = " select* from {$GnTable[bbsconfig]} where dbname = '$tbl' ";
$Board_Admin = sql_fetch($BoardSql);

$BB_table = $GnTable["bbsitem"].$tbl;
$BC_table = $GnTable["bbscomm"].$tbl;

if($_POST[mode]=="MODIFY"){
	sql_query("update $BC_table set c_content='".addslashes($c_content)."' where c_no='$cnum' ");
	echo "<script>alert('수정되었습니다.');opener.location.reload();window.close();</script>";
	exit;
}

$row = sql_fetch("select * from $BC_table where c_bno='$num' and c_no='$cnum'");
if($row[c_content]==""){
	echo "<script>alert('잘못된 경로입니다.');opener.location.reload();window.close();</script>";
}

// 게시판 설정 내용 변수를 설정합니다.
	if($Board_Admin["width"] <=100) $Board_Admin["width"] = $Board_Admin["width"]."%";
	// 페이지 코드를 설정해줍니다.
	if($Board_Admin["page_loc"] == TRUE) $page_loc = $Board_Admin["page_loc"]; else $page_loc = "bbs";
	$Board_Admin["skin_dir"] = "/skin/bbs/{$Board_Admin[skin]}";
?>
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
</script>
<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="2" bgcolor="#f8f8f8" align="center">
<form name="writeform" id="test" method="post" action="<?=$PHP_SELF?>" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="mode" value="MODIFY">
<input type="hidden" name="tbl" value="<?=$tbl?>">
<input type="hidden" name="num" value="<?=$num?>">
<input type="hidden" name="cnum" value="<?=$cnum?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
	<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
	<tr>
		<td width="100" height="35"><div align="center"><strong>작성자</strong></div></td>
		<td width="" align="left"><input name="c_writer" type="text" style="color:#666666; height:19; font-size:9pt;" size="23" class="text" value="<?=$_SESSION["nickname"]?>"></td>
		<td width="200" style="padding-right:10px" align="right"><? if($Get_Login==FALSE) {?><strong>비밀번호</strong> <input name="passwd" type="password" style="color:#666666; height:19; font-size:9pt;" size="23" class="text"><?}?>&nbsp;</td>
	</tr>
	<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
	<tr>
		<td width="100"  valign="top" align="center"><b>제목</b></td>
		<td height="16" colspan="2"><input name="c_subject" type="text" value="<?=$row[c_subject]?>" style="width:98%; color:#666666; height:19; font-size:9pt;" size="23" class="text"></td>
	</tr>
	<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
	<tr>
		<td width="100"  valign="top" align="center"><b>내용</b></td>
		<td height="16" colspan="2"><textarea name="c_content" style="width:98%; color:#666666; height:50; font-size:9pt;" class="text" onKeyUp="updateChar(100,'c_content','textlimit')"><?=$row[c_content]?></textarea></td>
	</tr>
	<tr>
		<td colspan="3" align="center" valign="middle">
        	<div align="right" style="padding-right:4px;"><span id="textlimit" style="color:#FF6600;" class="reply_txt">0</span><span class="reply_txt"> / 100 (한글 50자 / 영문 100자)</span></div>
            상업성 글이나 욕설등은 임의로 삭제 될 수 있습니다.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" border="0" align="absmiddle">
        </td>
	</tr>
	<tr bgcolor="#EEEEEE"><td height="2" colspan="3"></td></tr>
</form>
</table>
<? 
include_once $_SERVER['DOCUMENT_ROOT']."/foot.lib.php";
?>