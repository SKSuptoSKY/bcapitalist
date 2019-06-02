<?
////////// 게시판 쓰기 페이지 추가코드 여기부터 //////////////////////////

////////// 게시판 쓰기 페이지 추가코드 여기까지 //////////////////////////

/*///// 게시판 변수 안내
스킨경로 : $Board_Admin["skin_dir"]
게시판 너비 : $Board_Admin["width"]
////// 게시판 변수 안내*/
?>

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
}
</script>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<form name="writeform" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
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
<input type="hidden" name="b_html" value="1">
<input type="hidden" name="writedate" value="<?=$writedate?>">

<input type="hidden" name="alim_month" value="<?=$alim_month?>">
<input type="hidden" name="alim_year" value="<?=$alim_year?>">



<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr bgcolor="#496386"><td height="2" colspan="2"></td></tr>
	<tr><td height="3" colspan="2"></td></tr>
	<tr>
		<td width="13%" height="33" class="r_tt">글쓴이</td>
		<td width="87%" style="padding-left:5px;"><input type="text" name="b_writer" style="width:98%; height:19px;" value="<?=$view["b_writer"]?>" class="text"></td>
	</tr>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="2"></td></tr>
	<!--
	<tr>
		<td height="33" class="r_tt">이메일</td>
		<td style="padding-left:5px;"><input type="text" name="b_email" size="70" style="width:98%; height:19px;" value="<?=$view["b_email"]?>" class="text"></td>
	</tr>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="2"></td></tr>-->
	<tr>
		<td height="33" class="r_tt">제목</td>
		<td style="padding-left:5px;">
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
				<tr>
					<td>
						<input type="text" name="b_subject" size="70" style="width:70%; height:19px;" value="<?=$view["b_subject"]?>" class="text">
						<?=$Input_Notice?> <?=$Input_Secret?> <?=$Input_Html?>
					</td>
				</tr>
			</table>
		</td>
	</tr>		
	<tr bgcolor="#e4e0dc"><td height="1" colspan="2"></td></tr>
	<? if($Category_option==TRUE) {?>
	<tr>
		<td height="22" align="center"><div align="right"><img src="<?=$Board_Admin["skin_dir"]?>/images/w5.gif"></div></td>
		<td style="padding-left:5px;">
		<select name="b_category" style='width:80px;' class="text">
		<?=$Category_option?>
		</select>
		</td>
	</tr>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="2"></td></tr>
	<? } ?>
	<?
		/*
		if($LogAdmin == TRUE)
		{
			?>
			<tr>
				<th>날짜</th>
				<td>
					<input type="text" name="b_regist" style="width:30%; height:20px;" value="<?=substr($view["b_regist"],0,10)?>" class="text">
					<span style="font-size:8pt; color:#ff0000;">* 입력형식 : 2014-06-05</span>
				</td>
			</tr>
			<tr>
				<th>조회수</th>
				<td>
					<input type="text" name="b_hit" style="width:30%; height:20px;" value="<?=$view["b_hit"]?>" class="text">
				</td>
			</tr>
			<?
		}
		*/
		?>
	<tr> 
		<td class="r_tt">내용</td>
		<td style="padding-left:5px; padding-top:5px; padding-bottom:5px;">
			<textarea name="b_content" id="b_content" cols="83" style="width:100%; height:550px;"><?=$content?></textarea>
		</td>
	</tr>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="2"></td></tr>
	<?
		if($Board_Admin["use_data"]==TRUE) {
		for($i=1; $i<=$Board_Admin["fileupnum"]; $i++) {
	?>
	<tr>
		<td height="30" bgcolor="#FFFFFF" align="center">
		<div align="right"><img src="<?=$Board_Admin["skin_dir"]?>/images/w6.gif"><?=$i?></div>
		</td>
		<td style="padding-left:5px;"><input type="file" name="b_file<?=$i?>" style="width:98%; height:20px;" class="text"> <?=$view["b_file".$i]?></td>
	</tr>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="2"></td></tr>
	
	<? } } ?>
	<!--
	<tr>
		<td height="33" class="r_tt">링크1</td>
		<td style="padding-left:5px;"><input type="text" name="b_link1" size="70" style="width:98%; height:19px;" value="<?=$view["b_link1"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#e4e0dc" colspan="2"></td></tr>
	<tr>
		<td height="33" class="r_tt">링크2</td>
		<td style="padding-left:5px;"><input type="text" name="b_link2" size="70" style="width:98%; height:19px;" value="<?=$view["b_link2"]?>" class="text"></td>
	</tr>-->
	<tr><td height="1" bgcolor="#496386" colspan="2"></td></tr>
	<? if($Get_Login!=TRUE) {?>
	<tr>
		<td height="33" align="center"><div align="right"><img src="<?=$Board_Admin["skin_dir"]?>/images/w7.gif"></div></td>
		<td style="padding-left:5px;"><input type="password" name="passwd" size="10" style="height:19px; " class="text"> <font color=red>*수정 또는 삭제시 반드시 필요 합니다.</font></td>
	</tr>
	<tr bgcolor="#e4e0dc"><td height="2" colspan="2"></td></tr>
	<? } ?>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="right">
	<tr height="80">
		<td valign="middle">
		<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" style="border:0px;">
		<a href="<?=$Url["list"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif" border="0"></a>
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