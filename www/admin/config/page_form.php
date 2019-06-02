<?
include "../head.php";

$PG_table = $GnTable["pageitem"];

$title_page = "페이지";

if ($mode=="W") {
	$title_page .= "입력";

} else if ($mode=="E") {
	$title_page .= "수정";

	$sql = " select * from $PG_table where pg_no = '$pg_no' ";
	$it = sql_fetch($sql);
	$content  = $it[pg_content];

} else {
	alert("잘못된 경로로 접근하셨습니다.");
}

$qstr = "sca=$sca&page=$page";
?>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$title_page?></font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<script language='JavaScript' src='./lib/javascript.js'></script>
<form name=WriteForm method=post action="./page_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="pg_no" value="<?=$pg_no?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
		<td>
			<input type="text"  name="pg_subject" value="<?=$it[pg_subject]?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">페이지코드</td>
		<td>
			<? if ($mode=="W") { ?>
				<input type="text"  name="pg_code" value="<?=$it[pg_code]?>" style="width:100%; height:19px;" class="text">
			<? } else { ?>
				<input type="hidden"  name="pg_code" value="<?=$it[pg_code]?>"><?=$it[pg_code]?>
			<? } ?>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">메뉴</td>
		<td>
			<select name="pg_group">
				<option value="">- 메뉴선택 - </option>
				<?=group_select($it["pg_group"]);?>
			</select>
		</td>
	</tr>
</table>
<br>
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 내용</b>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2">
			<input type="hidden" name="it_explan_html" value="1">
			<textarea name="pg_content" id="pg_content" rows="20" style="width:100%;" class="text"><?=$it[pg_content]?></textarea>
            <font color="#FF9933">
            에디터 사용시 가로 670픽셀 넘지 않도록 엔터로 조절해 주세요
            <br />
            이미지도 670필셀 넘지 않도록 올려 주세요(너무 큰 이미지는 로딩시간이 길어 질 수 있습니다)
            </font>
            <br />
		</td>
	</tr>
	<!--
	<tr bgcolor="#FFFFFF">
		<td width="8%" bgcolor="#F0F0F0" style="padding-left:10px">이미지(대) 1<br /><font color="#FF0000">대표이미지</font></td>
		<td width="92%">
			<input type="file" name="it_limg1" style="width:90%; height:19px;" class="text">
			<?
			$limg1 = "/product/item/{$it[pg_code]}_l1.jpg";
			if (file_exists($_SERVER["DOCUMENT_ROOT"].$limg1)) {
				$size = getimagesize($_SERVER["DOCUMENT_ROOT"].$limg1);
				echo "<img src='$limg1' width=30 height=30><input type=checkbox name=it_limg1_del value='1'>삭제";
			}
			?>
			<? if (function_exists("imagecreatefromjpeg")) { echo "<input type=hidden name=createimage value='1'>"; } ?>
		</td>
	</tr>
	-->
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" border=0>
			<a href="./page_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>

<script language='javascript'>
var f = document.WriteForm;

function fitemformcheck(f)
{
    if (!f.pg_subject.value) {
        alert("제목을 입력해주세요.");
        f.pg_subject.focus();
        return false;
    }
    oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
	return true;
}
</script>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "pg_content",
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
		oEditors.getById["pg_content"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["pg_content"].getIR();
		alert(sHTML);
	}
		
	function submitContents(elClickedObj) {
		oEditors.getById["pg_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("b_content").value를 이용해서 처리하면 됩니다.
		
		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["pg_content"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["pg_content"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>
