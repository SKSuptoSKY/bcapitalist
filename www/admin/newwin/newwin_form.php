<?
$page_loc = "site";
include "../head.php";

$PG_table = $GnTable["newwin"];
$JO_table = "";

if($mode=="E") {
	$html_title = "새창 수정";
	$sql = " select * from $PG_table where nw_id = '$nw_id' ";
	$nw = sql_fetch($sql);
	$content = $nw[nw_content];

	if($nw[nw_id]==FALSE) alert("등록된 자료가 없습니다.");
}else{
	$html_title = "팝업 등록";

	//// 게시판 기본설정 값을 입력합니다.
	$nw["nw_disable_hours"] = 24;
	$nw["nw_left"] = 10;
	$nw["nw_top"] = 10;
	$nw["nw_width"]	 = 450;
	$nw["nw_height"] = 500;
	$nw["nw_content_html"] = 2;
	$content = $nw["nw_content"];
}

//include_once('./editor/func_editor.php');
$upload_image = '';
$upload_media = '';

########################################
##스킨 선택
########################################
$dir=opendir("$DOCUMENT_ROOT/skin/newwin/");
$skin_temp = "<select name=nw_skin style='width:120'>";
while($file=readdir($dir)) {
	if($file != "." && $file != ".."){ 
		if($file == $nw[nw_skin]) {
			$skin_temp .= "<option value='".$file."' selected>".$file."</option>"; 
		}else {
			$skin_temp .= "<option value='".$file."'>".$file."</option>";
		}
	}
}
closedir($dir);
$skin_temp .= "</select>";
#######################################

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="javascript">
function frmnewwin_check(f) 
{
    errmsg = "";
    errfld = "";
    check_field(f.nw_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }              

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

<form name="frmnewwin" id="frmnewwin" method=post action="./newwin_update.php" onsubmit="return frmnewwin_check(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="nw_id" value="<?=$nw_id?>">
<input type="hidden" name="qstr"  value="<?=$qstr?>">
<input type="hidden" name="nw_content_html" value=1>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">

	<tr>
		<td width="50%" valign="top">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td width="100" bgcolor="#F0F0F0" style="padding-left:10px">시간</td>
					<td><input type=text class=ed name=nw_disable_hours size=5 value="<?=$nw["nw_disable_hours"]?>"> 시간 동안 다시 띄우지 않음</td>
					<!--<td bgcolor="#F0F0F0" style="padding-left:10px">팝업형태</td>
					<td><input type=checkbox class=ed name=nw_disable_layer value="1" <?=($nw["nw_disable_layer"] == "1")?"checked":"";?>> <span style="color:#990000"> 체크시 레이어팝업</span>-->
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">시작일시</td>
					<td>
						<input type=text class=ed name=nw_begin_time size=21 maxlength=19 value="<?=$nw["nw_begin_time"]?>">
				        <input type=checkbox name=nw_begin_chk value="<? echo date("Y-m-d H:i:s", $now); ?>" onclick="if (this.checked == true) this.form.nw_begin_time.value=this.form.nw_begin_chk.value; else this.form.nw_begin_time.value = this.form.nw_begin_time.defaultValue;">오늘
					</td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">창위치 왼쪽</td>
					<td><input type=text class=ed name=nw_left size=5 value="<?=$nw["nw_left"]?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">창크기 폭</td>
					<td><input type=text class=ed name=nw_width  size=5 value="<?=$nw["nw_width"] ?>"></td>
				</tr>
			</table>
		</td>
		<td width="49%" valign="top">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">팝업형태</td>
					<td><input type=checkbox class=ed name=nw_disable_layer value="1" <?=($nw["nw_disable_layer"] == "1")?"checked":"";?>> <span style="color:#990000"> 체크시 레이어팝업</span>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">종료일시</td>
					<td>
						<input type=text class=ed name=nw_end_time size=21 maxlength=19 value="<?=$nw["nw_end_time"]?>">
				        <input type=checkbox name=nw_end_chk value="<?=date("Y-m-d H:i:s", $now+(60*60*24*7)); ?>" onclick="if (this.checked == true) this.form.nw_end_time.value=this.form.nw_end_chk.value; else this.form.nw_end_time.value = this.form.nw_end_time.defaultValue;">오늘+7일
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">창위치 위</td>
					<td><input type=text class=ed name=nw_top  size=5 value="<?=$nw["nw_top"] ?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">창크기 높이</td>
					<td><input type=text class=ed name=nw_height size=5 value="<?=$nw["nw_height"]?>"></td>
				</tr>
			</table>		
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">스킨</td>
					<td><?=$skin_temp?></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">창제목</td>
					<td><input type=text class=ed name=nw_subject size=80 value="<?=stripslashes($nw[nw_subject]) ?>">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">내용</td>
					<td><textarea name="nw_content" id="nw_content" rows="20" style="width:100%;" class="text"><?=$nw[nw_content]?></textarea></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./newwin_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>
</form>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "nw_content",
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
		oEditors.getById["nw_content"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["nw_content"].getIR();
		alert(sHTML);
	}
		
	function submitContents(elClickedObj) {
		oEditors.getById["nw_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("nw_content").value를 이용해서 처리하면 됩니다.
		
		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["nw_content"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["nw_content"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>