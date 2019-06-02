<script language='javascript'>
function writeChk(form) {
	if(!form.b_writer.value) {
		alert('작성자명을 입력하세요');
		form.b_writer.focus();
		return false;
	}
	if(!form.b_subject.value) {
		alert('글 제목을 입력하세요');
		form.b_subject.focus();
		return false;
	}
	<? if($Category_option==TRUE) {?>
		if(!form.b_category.value){
			alert("분류를 선택해주세요");
			return false;
		}
	<? } ?>
	<? if($Board_Admin["use_spam"]==TRUE){?>
	if(!form.zsfCode.value) {
		alert('스팸 방지를 위하여 \n\n이미지에 보이는 글자를 입력하여 주십시오     ');
		form.zsfCode.focus();
		return false;
	}
	<? }?>
    if (typeof(form.passwd) != 'undefined') {
		if(!form.passwd.value) {
			alert('비밀번호를 입력하세요. 수정 삭제시 필요합니다.');
			form.passwd.focus();
			return false;
		}
	}
	<? if($Board_Admin["use_html"]==TRUE){?>
		oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
	<? }?>
	if(!form.b_content.value) {
		alert('글 내용을 입력하세요');
		return false;
	}
	return true;
}
</script>

<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<form name="writeform" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="tbl" value="<?=$Table?>">
<input type="hidden" name="num" value="<?=$view["b_no"]?>">
<input type="hidden" name="b_tno" value="<?=$view["b_tno"]?>">
<input type="hidden" name="b_dep" value="<?=$view["b_dep"]?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="b_member" value="<?=$view["b_member"]?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<? if($Board_Admin["use_html"]==TRUE){?>
<input type="hidden" name="b_html" value="1">
<? }?>
<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
<input type="hidden" name="typedbname">
<input type="hidden" name="tablecategory">

<style>
.tit {font-weight:bold;color:#333;text-align:center;}
.bbs_btn{width:100px; height:32px; background:#f1f1f1;  font-weight:700; border:1px solid #dbdbdb; color:#111111; text-align:center; line-height:30px; vertical-align:top; cursor:pointer; display:inline-block; }
input[type="text"].text{border:1px solid #dddddd; }

</style>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="2" bgcolor="#888888" colspan="2"></td></tr>
	<tr>
		<td width="100" height="40" class="tit">작성자</td>
		<td width="" style="padding-left:5px;"><input type="text" name="b_writer" style="width:98%; height:28px;" value="<?=$view["b_writer"]?>" class="text" <?if($view["b_writer"]){?>readonly<?}?>></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">제목</td>
		<td style="padding-left:5px;">
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
				<tr>
					<td>
						<input type="text" name="b_subject" size="70" style="width:70%; height:28px;" value="<?=$view["b_subject"]?>" class="text">
						<?=$Input_Notice?> <?=$Input_Secret?> <?=$Input_Html?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td class="tit">내용</td>
		<td style="padding-left:5px; padding-top:5px; padding-bottom:5px;">
		<textarea name="b_content" id="b_content" rows="20" style="width:100%;" class="text"><?=$content?></textarea>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<? if($Category_option==TRUE) {?>
	<tr>
		<td height="40" class="tit">분류</td>
		<td style="padding-left:5px;">
			<select name="b_category" style='width:80px;' class="text">
				<?=$Category_option?>
			</select>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<? } ?>
<?
if($Board_Admin["use_data"]==TRUE) {
for($i=1; $i<=$Board_Admin["fileupnum"]; $i++) {
?>
	<tr>
		<td height="40" class="tit">첨부파일<?=$i?></td>
		<td style="padding-left:5px;"><input type="file" name="b_file<?=$i?>" style="width:98%; height:28px;" class="text"> <?=$view["b_file".$i]?></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<?
}
}
?>
	<!--
	<tr>
		<td height="40" class="tit">링크1</td>
		<td style="padding-left:5px;"><input type="text" name="b_link1" size="70" style="width:98%; height:19px;" value="<?=$view["b_link1"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">링크2</td>
		<td style="padding-left:5px;"><input type="text" name="b_link2" size="70" style="width:98%; height:28px;" value="<?=$view["b_link2"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	-->
<?
if($Board_Admin["use_spam"]==TRUE) {

$listNo=1;	# 목록 번호
$solveNo=1;	# 문제해결 번호
?>		<tr>
		<td height="40" class="tit">스팸방지</td>
		<td style="padding-left:5px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="100" style="padding:2px;"><a href="#" onclick="document.getElementById('zsfImg').src='zmSpamFree.php?re&amp;zsfimg='+new Date().getTime(); return false;" title=""><img id="zsfImg" src="zmSpamFree.php?zsfimg" alt="[새로고침]을 클릭해 주세요." style="border: none; " /></a></td>
			<td>
				<input type="text" name="zsfCode" id="zsfCode" style="width:120px;height:28px;text-transform:uppercase;ime-mode:disabled;" class="text">
			    <img width="2" height="2" border="0" />
			    <font color="#FF0000" style="font-size:11px;">이미지에 보이는 글자를 입력하여 주십시오.</font>
			</td>
		  </tr>
	    </table>
	</td>
	</tr>
	<tr><td height="1" bgcolor="#086CC0" colspan="2"></td></tr>
<? } ?>
<? if($Get_Login!=TRUE) {?>
	<tr>
		<td height="40" class="tit">비밀번호</td>
		<td style="padding-left:5px;"><input type="password" name="passwd" size="10" style="height:19px; " class="text"> <font color=red>*수정 또는 삭제시 반드시 필요 합니다.</font></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<? } ?>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="50" valign="middle">
		<td style="padding-left:50px;">
			<input type="submit" border="0" onclick="return writeChk(writeform)" value="확인" class="bbs_btn">&nbsp;
			<a href="<?=$Url["list"]?>"><div class="bbs_btn" style="background:#ffffff">목록</div></a>
		</td>
	</tr>
</table>

</form>
<? if($Board_Admin["use_html"]==TRUE){?>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "b_content",
		sSkinURI: "/editor/SmartEditor3Skin.html",
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
		},
		fCreator: "createSEditor2"
	});

	function pasteHTML() {
		var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
		oEditors.getById["b_content"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["b_content"].getIR();
		alert(sHTML);
	}

	function submitContents(elClickedObj) {
		oEditors.getById["b_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("b_content").value를 이용해서 처리하면 됩니다.

		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["b_content"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["b_content"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>
<? } ?>
