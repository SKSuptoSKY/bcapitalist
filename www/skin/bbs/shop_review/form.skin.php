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

<?
	// 수정시 빈값이 들어가는걸 막기위해
	if(!$view[b_ex2]) $view[b_ex2] = $_GET[it_id];
	if(!$view[b_ex3]) $view[b_ex3] = $_GET[it_name];
?>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<form name="writeform" id="test" method="post" action="/bbs/process.php?" enctype="multipart/form-data" validate="UTF-8">
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
<input type="hidden" name="shop_flag" value="<?=$shop_flag?>">
<input type="hidden" name="b_ex2" value="<?=$view[b_ex2]?>">
<input type="hidden" name="it_id" value="<?=$_GET[it_id]?>">
<!-- 네임 추가 -->
<input type="hidden" name="b_ex3" value="<?=$view[b_ex3]?>">
<input type="hidden" name="it_name" value="<?=$_GET[it_name]?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<? if($Board_Admin["use_html"]==TRUE){?>
<input type="hidden" name="b_html" value="1">
<? }?>
<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
<input type="hidden" name="typedbname">
<input type="hidden" name="tablecategory">
<!-- 상품 고유 카트 번호 -->
<input type="hidden" name="ct_id" value="<?=$_GET["ct_id"]?>" />


<div id="mainContent" style="height:auto;">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardlist">
		<caption></caption>
		<col width="15%" />
		<col width="*" />
		<tbody>
		<tr>
			<th>작성자</th>
			<td>
			<?if($_SESSION[userid] != ""){?>
			<input type="hidden" name="b_writer" style="width:98%; height:20px;" value="<?=$view["b_writer"]?>" class="text"><?=$view["b_writer"]?>
			<? }else{ ?>
			<?if($mode == "WRITE"){?>
			<input type="text" name="b_writer" style="width:98%; height:20px;" value="<?=$view["b_writer"]?>" class="text">
			<? }else{ ?>
			<input type="hidden" name="b_writer" style="width:98%; height:20px;" value="<?=$view["b_writer"]?>" class="text"><?=$view["b_writer"]?>
			<? } ?>
			<? } ?>
			</td>
		</tr>
		<tr>
			<th>제목</th>
			<td>
				<input type="text" name="b_subject" style="width:98%; height:20px;" value="<?=$view["b_subject"]?>" class="text">
				<?=$Input_Notice?> <?=$Input_Secret?> <?=$Input_Html?>
			</td>
		</tr>
		<?if($Table == "shop_review"){?>
		<?/*?>
		<tr>
			<th>평가</th>
			<td>
			<input type="radio" name="b_ex1" value="5" <?=($view[b_ex1] == "5" || !$view[b_ex1])?"checked":"";?>>★★★★★ &nbsp;
			<input type="radio" name="b_ex1" value="4" <?=($view[b_ex1] == "4")?"checked":"";?>>★★★★☆ &nbsp;
			<input type="radio" name="b_ex1" value="3" <?=($view[b_ex1] == "3")?"checked":"";?>>★★★☆☆ &nbsp;
			<input type="radio" name="b_ex1" value="2" <?=($view[b_ex1] == "2")?"checked":"";?>>★★☆☆☆ &nbsp;
			<input type="radio" name="b_ex1" value="1" <?=($view[b_ex1] == "1")?"checked":"";?>>★☆☆☆☆ &nbsp;
			</td>
		</tr>
		<?*/?>
		<? } ?>
		<tr>
			<th>내용</th>
			<td>
			<textarea name="b_content" id="b_content"  rows="20" style="width:100%;height:300px;" class="text"><?=$content?></textarea></td>
		</tr>
		<? if($Category_option==TRUE) {?>
		<tr>
			<th>분류</th>
			<td>
			<select name="b_category" style='width:80px;' class="text">
				<?=$Category_option?>
			</select>
			</td>
		</tr>
		<? } ?>
		<?
		if($Board_Admin["use_data"]==TRUE) {
			for($i=1; $i<=$Board_Admin["fileupnum"]; $i++) {
		?>
		<tr>
			<th style="border-bottom:1px solid #959595;">첨부파일</th>
			<td style="border-bottom:1px solid #959595;"><input type="file" name="b_file<?=$i?>" style="width:98%; height:20px;" class="text"> <?=$view["b_file".$i]?></td>
		</tr>
		<?
			}
		}
		?>
		<?
		if($Board_Admin["use_spam"]==TRUE) {
			$listNo=1;	# 목록 번호
			$solveNo=1;	# 문제해결 번호
		?>
		<tr>
			<th>스팸방지</th>
			<td ">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="154" style="padding:2px;"><a href="#" onclick="document.getElementById('zsfImg').src='zmSpamFree.php?re&amp;zsfimg='+new Date().getTime(); return false;" title=""><img id="zsfImg" src="zmSpamFree.php?zsfimg" alt="[새로고침]을 클릭해 주세요." style="border: none; " /></a></td>
						<td>
						<input type="text" name="zsfCode" id="zsfCode" style="width:120px;height:19px;text-transform:uppercase;ime-mode:disabled;" class="text">
						<img width="2" height="2" border="0" />
						<br>
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
			<td><input type="password" name="passwd" size="10" style="height:19px; " class="text"> <font color=red>*수정 또는 삭제시 반드시 필요 합니다.</font></td>
		</tr>
		<? } ?>
	
		<tr>
			<td colspan="2">
				<div class="shop_bd_btn2">
					<a href="<?=$Url["list"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif" alt="목록" style="vertical-align:middle;" /></a>
					<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" alt="확인" style="vertical-align:middle;" onclick="return writeChk(writeform)"/>
				</div>
			</td>
		</tr>
		</tbody>
	</table>

</div>

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

<script type="text/javascript">
// 문제 : 아이프레임으로 해당페이지 로딩시 글쓰기화면에 여백이 생기는 문제 -> 익스플러 버전별로 세로길이가 다르게 나오는 문제
// 해결 : 문서가 완전히 로딩됬을때 문서의 보여지는 부분을 감싸는 mainContent 의 세로값을 측정해 다시 정의한다.
//			이페이지를 호출하는 상위페이지인 iframe태그의 온로드 부분은 이페이지가 전부 실행되고 호출된다.
$(document).ready(function(){
	 var height = $("#mainContent").height();
	 var new_height = height + 18;
	 $("#mainContent").css("height",new_height);
});
</script>