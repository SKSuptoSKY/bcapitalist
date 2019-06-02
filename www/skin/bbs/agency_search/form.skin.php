<script language='javascript'>
function writeChk(form) {

		<? if($Board_Admin["use_html"]==TRUE){?>
			oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
		<? }?>
		if (typeof(form.passwd) != 'undefined') {
			if(!form.passwd.value) {
				alert('비밀번호를 입력하세요. 수정 삭제시 필요합니다.');
				form.passwd.focus();
				return false;
			}
		}

}

	function deleteChk(no) {
		yes_no = confirm('삭제하시면 다시 복구하실 수 없습니다.\n\n삭제하시겠습니까?');
		if(yes_no == true) { // 확인 선택해 했을때
				location.href='/bbs/process.php?tbl=<?=$Table?>&mode=DELETE&num='+no+'&<?=$NextUrl?>';
		}
}

</script>

<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<form name="writeform" id="test" method="post" action="<?=$ssl_url?>/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
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

	<table width="720" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr><td height="2" bgcolor="#999999" colspan="2"></td></tr>
		<tr>

      <td width="90" height="39" bgcolor="#FFFFFF" align="center"  style="color:#555555;">작성자</td>
			<td width="" style="padding-left:5px;"><input type="text" name="b_writer" style="width:98%; height:20px;" value="<?=$view["b_writer"]?>" class="text"></td>
		</tr>
		<!--tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
		<tr>
			<td height="30" bgcolor="#FFFFFF" align="center" style="font-weight:bold;">이메일</td>
			<td style="padding-left:5px;"><input type="text" name="b_email" size="70" style="width:98%; height:20px;" value="<?=$view["b_email"]?>" class="text"></td>
		</tr-->
		<tr><td height="1" bgcolor="#cccccc" colspan="2"></td></tr>
		<tr>
			<td height="39" bgcolor="#FFFFFF" align="center"  style="color:#555555;">대리점명</td>
			<td style="padding-left:5px;">
				<table cellpadding=0 cellspacing=0 border=0 width=100%>
					<tr>
						<td>
							<input type="text" name="b_subject" size="70" style="width:70%; height:20px;" value="<?=$view["b_subject"]?>" class="text" required itemname="대리점명">
							<!-- <?=$Input_Notice?> <?=$Input_Secret?> <?=$Input_Html?> -->
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td height="1" bgcolor="#cccccc" colspan="2"></td></tr>
		<tr>
			<td width="90" height="39" bgcolor="#FFFFFF" align="center"  style="color:#555555;">주 소</td>
			<td width="" style="padding-left:5px;"><input type="text" name="b_ex1" style="width:98%; height:20px;" value="<?=$view["b_ex1"]?>" class="text"></td>
		</tr>
		<tr><td height="1" bgcolor="#cccccc" colspan="2"></td></tr>
		<tr>
			<td width="90" height="39" bgcolor="#FFFFFF" align="center"  style="color:#555555;">전화번호</td>
			<td width="" style="padding-left:5px;"><input type="text" name="b_ex2" style="width:98%; height:20px;" value="<?=$view["b_ex2"]?>" class="text"></td>
		</tr>
		<tr><td height="1" bgcolor="#cccccc" colspan="2"></td></tr>
		<tr>
			<td height="39" bgcolor="#FFFFFF" align="center"  style="color:#555555;">지역명</td>
			<td style="padding-left:5px;">
				<table cellpadding=0 cellspacing=0 border=0 width="100%">
					<tr>
						<td>
							<select name="b_category" id="location" required itemname="지역명">
									<option value="">지역별</option>
									<option value="SU" <?if($category=="SU") { ?>selected="selected"<? } ?>>서울</option>
									<option value="BS" <?if($category=="BS") { ?>selected="selected"<? } ?>>부산</option>
									<option value="DG" <?if($category=="DG") { ?>selected="selected"<? } ?>>대구</option>
									<option value="IC" <?if($category=="IC") { ?>selected="selected"<? } ?>>인천</option>
									<option value="GJ" <?if($category=="GJ") { ?>selected="selected"<? } ?>>광주</option>
									<option value="DJ" <?if($category=="DJ") { ?>selected="selected"<? } ?>>대전</option>
									<option value="US" <?if($category=="US") { ?>selected="selected"<? } ?>>울산</option>
									<option value="GG" <?if($category=="GG") { ?>selected="selected"<? } ?>>경기</option>
									<option value="GW" <?if($category=="GW") { ?>selected="selected"<? } ?>>강원</option>
									<option value="CB" <?if($category=="CB") { ?>selected="selected"<? } ?>>충북</option>
									<option value="CN" <?if($category=="CN") { ?>selected="selected"<? } ?>>충남</option>
									<option value="JB" <?if($category=="JB") { ?>selected="selected"<? } ?>>전북</option>
									<option value="JN" <?if($category=="JN") { ?>selected="selected"<? } ?>>전남</option>
									<option value="GB" <?if($category=="GB") { ?>selected="selected"<? } ?>>경북</option>
									<option value="GN" <?if($category=="GN") { ?>selected="selected"<? } ?>>경남</option>
									<option value="JJ" <?if($category=="JJ") { ?>selected="selected"<? } ?>>제주</option>
								</select>
							</td>
					</tr>
				</table>
				<script type="text/javascript">
				<!--
					<?if($view[b_category] != ""){?>
						document.getElementById("location").value="<?=$view[b_category]?>";
					<? } ?>
				//-->
				</script>
			</td>
		</tr>
		<tr><td height="1" bgcolor="#cccccc" colspan="2"></td></tr>

		<tr>
			<td bgcolor="#FFFFFF" align="center" height="39"  style="color:#555555;">관리내용</td>
			<td style="padding-left:5px; padding-top:5px; padding-bottom:5px;">
            	<textarea name="b_content" id="b_content" rows="20" style="width:100%;" class="text"><?=$content?></textarea>
			</td>
		</tr>
		<tr><td height="1" bgcolor="#cccccc" colspan="2"></td></tr>
<? if($Category_option==TRUE) {?>
		<tr>
			<td height="30" bgcolor="#FFFFFF" align="center" style="font-weight:bold;">Category</td>
			<td style="padding-left:5px;">
				<select name="b_category" style='width:80px;' class="text">
					<?=$Category_option?>
				</select>
			</td>
		</tr>
		<tr><td height="1" bgcolor="#cccccc" colspan="2"></td></tr>
<? } ?>
<?
if($Board_Admin["use_data"]==TRUE) {
	for($i=1; $i<=$Board_Admin["fileupnum"]; $i++) {
?>
		<tr>
			<td height="39" bgcolor="#FFFFFF" align="center"  style="color:#555555;">파일<?=$i?></td>
			<td style="padding-left:5px;"><input type="file" name="b_file<?=$i?>" style="width:98%; height:20px;" class="text"> <?=$view["b_file".$i]?></td>
		</tr>
		<tr><td height="2" bgcolor="#999999" colspan="2"></td></tr>
<?
	}
}
?>
		<!--tr>
			<td height="30" bgcolor="#FFFFFF" align="center" style="font-weight:bold;">링크1</td>
			<td style="padding-left:5px;"><input type="text" name="b_link1" size="70" style="width:98%; height:19px;" value="<?=$view["b_link1"]?>" class="text"></td>
		</tr>
		<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
		<tr>
			<td height="30" bgcolor="#FFFFFF" align="center" style="font-weight:bold;">링크2</td>
			<td style="padding-left:5px;"><input type="text" name="b_link2" size="70" style="width:98%; height:20px;" value="<?=$view["b_link2"]?>" class="text"></td>
		</tr>
		<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr-->
<?
if($Board_Admin["use_spam"]==TRUE) {

$listNo=1;	# 목록 번호
$solveNo=1;	# 문제해결 번호
?>		<tr>
			<td height="39" bgcolor="#F1F1F1" align="center" style="font-weight:bold;">스팸방지</td>
			<td style="padding-left:5px;">
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
		<tr><td height="1" bgcolor="#086CC0" colspan="2"></td></tr>
<? } ?>
<? if($Get_Login!=TRUE) {?>
		<tr>
			<td height="30" bgcolor="#FFFFFF" align="center" style="font-weight:bold;">Password</td>
			<td style="padding-left:5px;"><input type="password" name="passwd" size="10" style="height:19px; " class="text"> <font color=red>*수정 또는 삭제시 반드시 필요 합니다.</font></td>
		</tr>
		<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<? } ?>
	</table>

	<table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr height="50">
			<td valign="middle">
				<input type="image" src="<?=$Board_Admin["skin_dir"]?>/images/btn_ok.gif" border="0" onclick="return writeChk(writeform)">
				<a href="<?=$Url["list"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_list.gif" border=0></a>
				<!-- <a href="<?=$Board_Admin["skin_dir"]?>/delete.php?<?=$_SERVER[QUERY_STRING] ?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif" border=0></a> -->
				<?
					// 삭제 버튼 출력 여부
					if ( $_GET[mode]=="MODIFY")
					{
						?><a href="javascript:deleteChk(<?=$_GET[num]?>)"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif" border=0></a><?
					}
				?>

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

