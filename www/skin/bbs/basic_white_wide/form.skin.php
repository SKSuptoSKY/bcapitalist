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

<table cellpadding="0" cellspacing="0" border="0" class="bbs_writing">
	<colgroup>
		<col width="20%">
		<col width="80%">
	</colgroup>
	<tr>
		<th>작성자</th>
		<td><input type="text" name="b_writer" style="width:30%;" value="<?=$view["b_writer"]?>" <?if($view["b_writer"]){?>readonly<?}?>></td>
	</tr>
	<tr>
		<th>제목</th>
		<td><input type="text" name="b_subject" style="width:70%;" value="<?=$view["b_subject"]?>" > <?=$Input_Notice?> <?=$Input_Secret?> <?=$Input_Html?></td>
	</tr>
<? if($Category_option==TRUE) {?>
	<tr>
		<th>분류</th>
		<td>
			<select name="b_category" style='width:80px;'>
				<?=$Category_option?>
			</select>
		</td>
	</tr>
<? } ?>

	<tr>
		<th>내용</th>
		<td><textarea name="b_content" id="b_content" rows="20" style="width:100%;" class="text"><?=$content?></textarea></td>
	</tr>

<?
if($Board_Admin["use_data"]==TRUE) {
for($i=1; $i<=$Board_Admin["fileupnum"]; $i++) {
?>
	<tr>
		<th>첨부파일<?=$i?></th>
		<td><input type="file" name="b_file<?=$i?>" style="width:90%;"> <?=$view["b_file".$i]?></td>
	</tr>
<?
}
}
?>

<?
if($Board_Admin["use_spam"]==TRUE) {

$listNo=1;	# 목록 번호
$solveNo=1;	# 문제해결 번호
?>	<tr>
		<th>스팸방지</th>
		<td>
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
<? } ?>
<? if($Get_Login!=TRUE) {?>
	<tr>
		<th>비밀번호</th>
		<td><input type="password" name="passwd" size="10" class="text"> <font color=red>*수정 또는 삭제시 반드시 필요 합니다.</font></td>
	</tr>
<? } ?>
</table>
<!-- admin_btn -->
<div class="admin_btn mt50">
	<div class="btn_center">
		<button onclick="return writeChk(writeform);" class="btn04">확인</button>
		<a href="<?=$Url["list"]?>"><div class="btn01 md10">목록</div></a>
	</div>
</div>
<!-- //admin_btn -->



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
