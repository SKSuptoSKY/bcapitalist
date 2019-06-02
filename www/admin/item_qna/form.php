<?
include "./lib/lib.php";

if($mode=="E") {
	$sql = " select * from $PG_table where b_no = '$b_no' ";
	$view = sql_fetch($sql);
	if($view[b_no]==FALSE) alert("등록된 자료가 없습니다.");

}else if($mode=="R"){

		//$sql = " select b_tno, b_dep, b_subject, b_category, b_content, b_secret from $PG_table where b_no = '$b_no' "; // 일부만 가져온다.
		$sql = " select * from $PG_table where b_no = '$b_no' ";		// 전체 다 가져온다.
		$view = sql_fetch($sql);

		//답글에 >> 표시 해주기
		//$tmp_body = split("\n", $view["b_content"]);
		//for ($R = 0; $R < sizeOf($tmp_body); $R++) { $view["b_content"] .= ">> ".$tmp_body[$R]."\n"; }
		$view["b_content"] = "\n\n===================== 원글 내용 ====================\n\n<br>".$view["b_content"];
		$view["b_subject"] = $view["b_subject"];
}

$Get_File_sql= "select* from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '$b_no' ";
$Get_File_result = sql_query($Get_File_sql,FALSE);
//다운파일이 있으면
for ($i=1; $Get_File=sql_fetch_array($Get_File_result,FALSE); $i++) {
	if($Get_File["bf_no"]) {
		$i = $Get_File["bf_fno"];
		##### 등록파일이 있을경우
		if($Get_File["bf_save_name"]) {
			$getsavename = $Get_File["bf_save_name"];
			$getfilename = $Get_File["bf_real_name"];
			//파일 삭제 선택 INPUT 을 넣어줍니다.
			$view["b_file".$i] = "$getfilename <input type='checkbox' name='file_del[$i]' value='1'> 삭제";
		}
	}
}



$qstr  = "findType=$findType&findword=$findword&type=$type&sca=$sca&page=$page&category=".urlencode($_GET[category]);
?>

<script language="javascript">
function frm_check(f) 
{
		oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
}
</script>

<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$html_title?></font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"></td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="20"></td>
	</tr>
</table>
<form name="writeform" id="writeform" method=post action="./update.php" onsubmit="return frm_check(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="b_no" value="<?=$b_no?>">
<input type="hidden" name="qstr"  value="<?=$qstr?>">
<input type="hidden" name="num" value="<?=$view["b_no"]?>">
<input type="hidden" name="b_tno" value="<?=$view["b_tno"]?>">
<!-- 수정부분 -->
<input type="hidden" name="b_dep" value="<?=$view["b_dep"]?>">
<input type="hidden" name="b_passwd" value="<?=$view["b_passwd"]?>">
<input type="hidden" name="b_secret" value="<?=$view["b_secret"]?>">
<!-- 수정부분 -->
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="b_ex2" value="<?=$view[b_ex2]?>">
<input type="hidden" name="b_ex3" value="<?=$view[b_ex3]?>">
<input type="hidden" name="b_member" value="<?=$_SESSION["userid"]?>">
<input type="hidden" name="b_writer" value="관리자">

<div class="pvspacing"></div>
	<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td valign="top" width="45%">
			<table width="99%" align="center" border="0" cellpadding="6" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">제 목</td>
					<td><input type="text" style="width:95%" name=b_subject value="<?=$view[b_subject]?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">내 용</td>
					<!-- 에디터 사용안함 사용시 태그가 들어가는 문제 ( 쇼핑몰 상세와 똑같이 에디터 적용안함  ) -->
					<td><textarea name="b_content" id="b_content" rows="20" style="width:100%;" class="text"><?=stripslashes($view[b_content])?></textarea></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">첨부파일</td>
					<td><table width="100%" cellpadding="0" cellspacing="0" border="0">
						<?for($i=1; $i <= 1; $i++){?>
							<tr>
								<td align="left">
									<?if($i == 1){?>
									이미지 업로드 권장사이즈 : <span style="color:#FF0000"></span>
								<br>
								<? } ?>
								<input type="file" name="b_file<?=$i?>" size="84" class="input3"> <?=$view["b_file{$i}"]?></td>
							</tr>
						<? } ?>
					</table></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" style="border:0px;">
			<a href="./list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a> 
			<?if($mode != "R"){?>
				<a href="/admin/item_qna/form.php?mode=R&b_no=<?=$view[b_no]?>&<?=$qstr?>"><img  src="/btn/btn_reply.gif" style="border:0px;"></a>
			<? } ?>
		</td>
	</tr>
</table>
</form>
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