<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수
?>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="<?=$charset?>"></script>
<script type="text/javascript">
function form_ch(form){
	oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
	if(form.explan_other.value == ""){
		alert("내용을 입력해주세요");
		return false;
	}
	form.action = "./explan_update.php";
	return true;
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 쇼핑몰 유의사항</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<form name="write_form" method="POST" onsubmit = "return form_ch(this)">
	<tr>
		<td><table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td height="30" style="padding-left:5px;"><table width="20%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td style="text-align:center;"><a href="./explan_trans.php">배송관련</a></td>
						<td><strong>|</strong></td>
						<td style="text-align:center;"><a href="./explan_chan.php">교환/반품/환불안내</a></td>
						<td><strong>|</strong></td>
						<td style="border:1px solid #cccccc;padding:3px;background-color:#F3F3F3;text-align:center;font-weight:bold;">유의사항</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td bgcolor="#747474"></td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td align="center" style="padding-left:20px;"><textarea  name="explan_other" id="explan_other" style="width:100%; height:350" class="text"><?=$GnShop["explan_other"]?></textarea></td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="center"><input type=image src="/btn/btn_modify.gif" border=0></td>
	</tr>
	</form>
</table>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "explan_other",
		sSkinURI: "/editor/SmartEditor3Skin.html",	
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
			}
		},
		fCreator: "createSEditor2"
	});

	function pasteHTML() {
		var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
		oEditors.getById["explan_other"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["explan_other"].getIR();
		alert(sHTML);
	}
		
	function submitContents(elClickedObj) {
		oEditors.getById["explan_other"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("explan_other").value를 이용해서 처리하면 됩니다.
		
		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["explan_other"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["explan_other"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>
